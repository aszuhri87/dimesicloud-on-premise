<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class NodeController extends Controller
{
    public function index(){
        return view('node.index');
    }

    public function dt(){
        $response = PMXConnect::connection(env('PROXMOX_BASE') . '/api2/json/cluster/status', 'GET');

        $data = array();

        if($response->getStatusCode() == 200){
            $clusters = json_decode($response->getBody(), true);

            foreach ($clusters['data'] as $key => $cluster) {
                if($cluster['type'] == 'node'){

                    $response = PMXConnect::connection(env('PROXMOX_BASE') . '/api2/json/nodes/'.$cluster['name'].'/status', 'GET');

                    if($response->getStatusCode() == 200){
                        $status = json_decode($response->getBody(), true);

                        $_data = array(
                            'name' => $cluster['name'],
                            'ip' => $cluster['ip'],
                            'uptime' => gmdate("H:i:s", $status['data']['uptime']),
                            'maxmem' => $status['data']['memory']['total'],
                            'mem' => $status['data']['memory']['used'],
                            'cpu' => $status['data']['cpu'],
                            'maxcpu' => $status['data']['cpuinfo']['cpus'],
                            'status' => $cluster['online'],
                            'maxdisk' => $status['data']['rootfs']['total']
                        );

                        array_push($data,$_data);
                    }
                }
            }
        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function detail($node){
        return view('node_detail.index');
    }

    public function profile($node){
        try {
            $clusters = PMXConnect::connection(env('PROXMOX_BASE') . '/api2/json/cluster/status', 'GET');

            $data = array();

            $response = PMXConnect::connection(env('PROXMOX_BASE') . '/api2/json/nodes/'.$node.'/status', 'GET');

            $cluster = json_decode($clusters->getBody(), true)['data'];

            $ip = null;

            foreach($cluster as $c){
                if($c['name'] == $node){
                    $ip = $c['ip'];
                }
            }

            if($response->getStatusCode() == 200){
                $response = json_decode($response->getBody(), true);

                $resource = $response['data'];

                $data = [
                    'disk_used' => $resource['rootfs']['used'],
                    'disk_total' => $resource['rootfs']['total'],
                    'cpu' => $resource['cpu'],
                    'cpus' => $resource['cpuinfo']['cpus'],
                    'mem' => $resource['memory']['used'],
                    'maxmem' => $resource['memory']['total'],
                    'kernel' => $resource['kversion'],
                    'image' => $resource['current-kernel']['machine'],
                    'ip' => $ip
                ];
            }


            return response()->json([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'data' => $data
            ], 500);
        }
    }

    public function resource($node, $unit, $type){
        try {
            $response = PMXConnect::connection(config('app.proxmox').'/api2/json/nodes/'.$node.'/rrddata?timeframe=' . $unit . '&cf=' . $type, 'GET');

            $config = json_decode($response->getBody(), true);

            $data = array();

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                $list_category = array();
                $cpu_usage = array();
                $mem_usage = array();
                $net_in_usage = array();
                $net_out_usage = array();
                $load = array();

                foreach ($data['data'] as $key => $value) {
                    array_push($list_category, date("Y-m-d H:i:s ", $value['time']));

                    if (array_key_exists('cpu', $value)) {
                        array_push($cpu_usage, number_format($value['cpu'] * 100, 2));
                    }

                    if (array_key_exists('memused', $value)) {
                        array_push($mem_usage, number_format($value['memused'] / $value['memtotal'] * 100, 2));
                    }

                    if (array_key_exists('netin', $value)) {
                        array_push($net_in_usage, number_format($value['netin'], 2));
                    }

                    if (array_key_exists('netout', $value)) {
                        array_push($net_out_usage, number_format($value['netout'], 2));
                    }

                    if (array_key_exists('loadavg', $value)) {
                        array_push($load, $value['loadavg']);
                    }

                }

                return response([
                    'data' => [
                        'category' => $list_category,
                        'cpu' => $cpu_usage,
                        'mem' => $mem_usage,
                        'netin' => $net_in_usage,
                        'netout' => $net_out_usage,
                        'load' => $load,
                    ],
                    'res' => $data
                ]);

            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
