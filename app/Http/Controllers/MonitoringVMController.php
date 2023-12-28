<?php

namespace App\Http\Controllers;

use App\Library\Influx;
use App\Library\PMXConnect;
use App\Models\AccessManager;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Session;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Log;

class MonitoringVMController extends Controller
{
    public function __construct() {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index(Request $request)
    {
        return view('virtual_machine.index');
    }

    public function dt()
    {
        $response = PMXConnect::connection(env('PMX_HOST') . '/api2/json/cluster/resources', 'GET');

        if ($response->getStatusCode() == 200) {
            $virtual_machines = json_decode($response->getBody(), true);
            $type = null;
            $data = array();
            foreach ($virtual_machines['data'] as $key => $virtual_machine) {
                if ($virtual_machine['type'] == 'qemu' || $virtual_machine['type'] == 'lxc' ) {

                    if($virtual_machine['type'] == 'qemu'){
                        $type = 'qemu';
                    } else {
                        $type = 'lxc';
                    }

                    $response = PMXConnect::connection(env('PMX_HOST') . '/api2/json/nodes/' . $virtual_machine['node'] . '/'.$virtual_machine['type'].'/' . $virtual_machine['vmid'] . '/config', 'GET');

                    if ($response->getStatusCode() == 200) {
                        $config = json_decode($response->getBody(), true);

                        $ip = null;
                        if (array_key_exists("ipconfig0", $config['data'])) {
                            $ipconfig = explode('/', $config['data']['ipconfig0']);
                            $ip = explode('=', $ipconfig[0])[1];
                        }

                        $_data = array(
                            'name' => $virtual_machine['name'],
                            'status' => $virtual_machine['status'],
                            'uptime' => gmdate("H:i:s", $virtual_machine['uptime']),
                            'node' => $virtual_machine['node'],
                            'vmid' => $virtual_machine['vmid'],
                            'maxdisk' => $virtual_machine['maxdisk'],
                            'maxmem' => $virtual_machine['maxmem'],
                            'mem' => $virtual_machine['mem'],
                            'cpu' => $virtual_machine['cpu'],
                            'vmid' => $virtual_machine['vmid'],
                            'maxcpu' => $virtual_machine['maxcpu'],
                            'type' => $type,
                            'ip' => $ip
                        );
                        if (array_key_exists('pool', $virtual_machine)) {
                            $_data['pool'] = $virtual_machine['pool'];
                        }

                        array_push($data, $_data);
                    }
                }
            }


        }
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function detail($node, $vmid)
    {
        return response(view('virtual_machine_detail.index'));

    }

    public function graph()
    {
        return view('pages.virtual_machine.graph.index');
    }
    public function power()
    {
        return view('pages.virtual_machine.power.index');
    }

    public function network($node, $vmid, $type){
        try {
            $response = PMXConnect::connection(config('app.proxmox').'/api2/json/nodes/'.$node.'/'.$type.'/'.$vmid.'/config', 'GET');

            if($response->getStatusCode() == 200){
                $config = json_decode($response->getBody(), true);

                $ip = '-';
                if(array_key_exists("ipconfig0",$config['data'])){
                    $ipconfig = explode('/',$config['data']['ipconfig0']);
                    $ip = explode('=', $ipconfig[0])[1];
                }

                return response([
                    'data' => [
                        'ip' => $ip
                    ]
                ]);
            }
        } catch (ClientException $e){
            return response([
                "message"      => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message"      => 'Internal Server Error'
            ], 500);
        }
    }

    public function current($node, $vmid, $type)
    {
        try {
            $response = PMXConnect::connection(config('app.proxmox') . '/api2/json/nodes/' . $node . '/'.$type.'/' . $vmid . '/status/current', 'GET');

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                return $data;
            }
        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }

    public function os_info($node, $vmid, $type)
    {
        try {
            $response = PMXConnect::connection(config('app.proxmox') . '/api2/json/nodes/' . $node . '/'.$type.'/' . $vmid . '/agent/get-osinfo', 'GET');

            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                return response([
                    'data' => $data['data']['result']
                ]);
            }

        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response([
                "message" => "Server can't get os info"
            ], 500);
        }
    }

    public function series($node, $vmid, $unit, $type, $node_type)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');

            $response = PMXConnect::connection(config('app.proxmox') . '/api2/json/nodes/' . $node . '/'.$node_type.'/' . $vmid . '/rrddata?timeframe=' . $unit . '&cf=' . $type, 'GET');

            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                $list_category = array();
                $cpu_usage = array();
                $mem_usage = array();
                $net_in_usage = array();
                $net_out_usage = array();
                $disk_read_usage = array();
                $disk_write_usage = array();


                foreach ($data['data'] as $key => $value) {
                    array_push($list_category, date("Y-m-d H:i:s ", $value['time']));

                    if (array_key_exists('cpu', $value)) {
                        array_push($cpu_usage, number_format($value['cpu'] * 100, 2));
                    }

                    if (array_key_exists('mem', $value)) {
                        array_push($mem_usage, number_format($value['mem'] / $value['maxmem'] * 100, 2));
                    }

                    if (array_key_exists('netin', $value)) {
                        array_push($net_in_usage, number_format($value['netin'], 2));
                    }

                    if (array_key_exists('netout', $value)) {
                        array_push($net_out_usage, number_format($value['netout'], 2));
                    }

                    if (array_key_exists('diskwrite', $value)) {
                        array_push($disk_write_usage, $value['diskwrite']);
                    }

                    if (array_key_exists('diskread', $value)) {
                        array_push($disk_read_usage, $value['diskread']);
                    }

                }

                return response([
                    'data' => [
                        'category' => $list_category,
                        'cpu' => $cpu_usage,
                        'mem' => $mem_usage,
                        'netin' => $net_in_usage,
                        'netout' => $net_out_usage,
                        'diskread' => $disk_read_usage,
                        'diskwrite' => $disk_write_usage

                    ],
                    'res' => $data
                ]);
            }
        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }

    public function series_disk($node, $vmid, $unit, $type, $node_type)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');

            $response = PMXConnect::connection(config('app.proxmox') . '/api2/json/nodes/' . $node . '/'.$node_type.'/' . $vmid . '/rrddata?timeframe=' . $unit . '&cf=' . $type, 'GET');

            $data = json_decode($response->getBody(), true);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                $list_category = array();
                $cpu_usage = array();
                $mem_usage = array();
                $net_in_usage = array();
                $net_out_usage = array();
                $disk_read_usage = array();
                $disk_write_usage = array();


                foreach ($data['data'] as $key => $value) {
                    array_push($list_category, date("Y-m-d H:i:s ", $value['time']));

                    if (array_key_exists('cpu', $value)) {
                        array_push($cpu_usage, number_format($value['cpu'] * 100, 2));
                    }

                    if (array_key_exists('mem', $value)) {
                        array_push($mem_usage, number_format($value['mem'] / $value['maxmem'] * 100, 2));
                    }

                    if (array_key_exists('netin', $value)) {
                        array_push($net_in_usage, number_format($value['netin'], 2));
                    }

                    if (array_key_exists('netout', $value)) {
                        array_push($net_out_usage, number_format($value['netout'], 2));
                    }

                    if (array_key_exists('diskwrite', $value)) {
                        array_push($disk_write_usage, $value['diskwrite']);
                    }

                    if (array_key_exists('diskread', $value)) {
                        array_push($disk_read_usage, $value['diskread']);
                    }

                }

                return response([
                    'data' => [
                        'category' => $list_category,
                        'cpu' => $cpu_usage,
                        'mem' => $mem_usage,
                        'netin' => $net_in_usage,
                        'netout' => $net_out_usage,
                        'diskread' => $disk_read_usage,
                        'diskwrite' => $disk_write_usage

                    ],
                    'res' => $data
                ]);
            }
        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }

    public function user_list($node, $vmid, $type){
        $response = PMXConnect::connection(env('PMX_HOST').'/api2/json/nodes/'.$node.'/'.$type.'/'.$vmid.'/config', 'GET');

        $response = json_decode($response->getBody(), true)['data'];

        $ssh = explode(PHP_EOL, urldecode($response['sshkeys']));
        $data = array();
        $result = array();
        $_result = array();

        foreach($ssh as $s){
            $name = null;
            $raw = explode(" ",$s);
            if(array_key_exists(2, $raw)){
                if(explode(" ",$s)[2] != " " || explode(" ",$s)[2] != null){
                    $name = explode(" ",$s)[2];
                } else {
                    $name = "-";
                }
            } else {
                $name = "-";
            }

            if($s != ""){
                $access = AccessManager::where('sshkey', $s)->first();
                if($access != null){
                    $_data = [
                        'name' =>  $access->name,
                        'sshkey' => $s
                    ];
                    array_push($data, $_data);
                }
            }

        }


        return DataTables::of($data)->addIndexColumn()->make(true);

    }
}
