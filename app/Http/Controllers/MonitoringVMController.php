<?php

namespace App\Http\Controllers;

use App\Library\Influx;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Session;
use Exception;
use DataTables;


class MonitoringVMController extends Controller
{

    public function index(Request $request){
        return view('virtual_machine.index');
    }

    public function dt(){
        $headers = [
            "Authorization" => "PVEAPIToken=" . env('PMX_USER') ."!" .  env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
            "User-Agent"=> "DimensiCloud",
        ];

        $auth_data = Session::get('data');
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->request(
            'GET',
            env('PROXMOX_BASE').'/api2/json/cluster/resources',
            [
                'headers' => [
                    'Cookie' => 'PVEAuthCookie='.$auth_data['ticket'],
                    "Authorization" => "PVEAPIToken=" . env('PMX_USER') ."!" .  env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                    "User-Agent"=> "DimensiCloud",
                ]
            ]
        );

        if($response->getStatusCode() == 200){
            $virtual_machines = json_decode($response->getBody(), true);

            $data = array();

            foreach ($virtual_machines['data'] as $key => $virtual_machine) {
                if($virtual_machine['type'] == 'qemu'){
                    $response = $client->request(
                        'GET',
                        env('PROXMOX_BASE').'/api2/json/nodes/'.$virtual_machine['node'].'/qemu/'.$virtual_machine['vmid'].'/config',
                        [
                            'headers' => [
                                'Cookie' => 'PVEAuthCookie='.$auth_data['ticket'],
                                "Authorization" => "PVEAPIToken=" . env('PMX_USER') ."!" .  env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                                "User-Agent"=> "DimensiCloud",
                            ]
                        ]
                    );

                    if($response->getStatusCode() == 200){
                        $config = json_decode($response->getBody(), true);

                        $ip = null;
                        if(array_key_exists("ipconfig0",$config['data'])){
                            $ipconfig = explode('/',$config['data']['ipconfig0']);
                            $ip = explode('=', $ipconfig[0])[1];
                        }


                        $_data = array(
                            'name' => $virtual_machine['name'],
                            'status' => $virtual_machine['status'],
                            'uptime' => gmdate("H:i:s", $virtual_machine['uptime']),
                            'node' => $virtual_machine['node'],
                            'vmid' => $virtual_machine['vmid'],
                            'maxdisk' => number_format($virtual_machine['maxdisk'] / pow(1024, 3), 1)." G",
                            'maxmem' => number_format($virtual_machine['maxmem'] / pow(1024, 3), 1)." G",
                            'mem' => number_format($virtual_machine['mem'] / pow(1024, 3), 1)." G",
                            'cpu' => number_format($virtual_machine['cpu'] / pow(1024, 3), 1)." G",
                            'vmid' => $virtual_machine['vmid'],
                            'maxcpu' => number_format($virtual_machine['maxcpu'] / pow(1024, 3), 1)." G",
                            'ip' => $ip
                        );
                        if(array_key_exists('pool',$virtual_machine)){
                            $_data['pool'] = $virtual_machine['pool'];
                        }

                        array_push($data,$_data);
                    }
                }
            }

        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function detail()
    {
    	return view('virtual_machine_detail.index');
    }


    public function graph()
    {
    	return view('pages.virtual_machine.graph.index');
    }

    public function console()
    {
    	return view('pages.virtual_machine.console.index');
    }

    public function power()
    {
        return view('pages.virtual_machine.power.index');
    }

    public function network($node, $vmid){
        try {
            $headers = [
                "Authorization" => "PVEAPIToken=" . env('PMX_USER') ."!" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                "User-Agent"=> "DimensiCloud",
            ];
            $auth_data = Session::get('data');
            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                            'GET',
                            config('app.proxmox').'/api2/json/nodes/'.$node.'/qemu/'.$vmid.'/config',
                            [
                                $headers
                            ]
                        );

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

    public function current($node, $vmid){
        try {
            $headers = [
                "Authorization" => "PVEAPIToken=" . env('PMX_USER') ."!" .  env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                "User-Agent"=> "DimensiCloud",
            ];
            $auth_data = Session::get('data');
            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                            'GET',
                            config('app.proxmox').'/api2/json/nodes/'.$node.'/qemu/'.$vmid.'/status/current',
                            [
                                // 'headers' => [
                                //     'Cookie' => 'PVEAuthCookie='.$auth_data['ticket'],
                                // ]
                                $headers
                            ]
                        );

            if($response->getStatusCode() == 200){
                $data = json_decode($response->getBody(), true);

                return $data;
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

    public function os_info($node, $vmid){
        try {
            $auth_data = Session::get('data');
            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                            'GET',
                            config('app.proxmox').'/api2/json/nodes/'.$node.'/qemu/'.$vmid.'/agent/get-osinfo',
                            [
                                'headers' => [
                                    'Cookie' => 'PVEAuthCookie='.$auth_data['ticket'],
                                ]
                            ]
                        );

            if($response->getStatusCode() == 200){
                $data = json_decode($response->getBody(), true);

                return response([
                    'data' => $data['data']['result']
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

    public function series($node, $vmid, $unit, $type){
		try {
            date_default_timezone_set('Asia/Jakarta');

			$auth_data = Session::get('data');
			$client = new \GuzzleHttp\Client([
			    'verify' => false
			]);

			$response = $client->request(
                'GET',
                config('app.proxmox').'/api2/json/nodes/'.$node.'/qemu/'.$vmid.'/rrddata?timeframe='.$unit.'&cf='.$type,
                [
                    'headers' => [
				        'Cookie' => 'PVEAuthCookie='.$auth_data['ticket'],
				    ]
                ]
            );

            if($response->getStatusCode() == 200){
                $data = json_decode($response->getBody(), true);

                $list_category = array();
                $cpu_usage = array();
                $mem_usage = array();
                $net_in_usage = array();
                $net_out_usage = array();
                $disk_read_usage = array();
                $disk_write_usage = array();


                foreach ($data['data'] as $key => $value) {
                	array_push($list_category, date("Y-m-d H:i:s ",$value['time']));

                	if (array_key_exists('cpu', $value)){
                        array_push($cpu_usage, number_format($value['cpu'] * 100, 2));
                    }

                	if(array_key_exists('mem', $value)){
                        array_push($mem_usage, number_format($value['mem'] / $value['maxmem'] * 100, 2));
                    }

                	if(array_key_exists('netin', $value)){
                        array_push($net_in_usage, number_format($value['netin'], 2));
                    }

                    if(array_key_exists('netout', $value)){
                	   array_push($net_out_usage, number_format($value['netout'], 2));
                    }

                    if(array_key_exists('diskwrite', $value)){
                	   array_push($disk_write_usage, $value['diskwrite']);
                    }

                    if(array_key_exists('diskread', $value)){
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
}