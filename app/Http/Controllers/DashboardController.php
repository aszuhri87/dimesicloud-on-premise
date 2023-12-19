<?php

namespace App\Http\Controllers;
use App\Library\PMXConnect;
use Illuminate\Support\Facades\Cache;
use Session;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function statistic_resources()
	{
		try {
            $response = PMXConnect::connection(env('PMX_HOST').'/api2/json/cluster/resources', 'GET');

            if($response->getStatusCode() == 200){
                $resources = json_decode($response->getBody(), true);

                $top_cpu = array();
                $top_memory = array();
				$cpu_usage = 0;
				$cpu = 0;

				$memory_usage = 0;
				$memory = 0;

				$disk_usage = 0;
				$disk = 0;

				$vm_running = 0;
				$vm_stopped = 0;

				$node_running = 0;
				$node_stopped = 0;
                foreach ($resources['data'] as $key => $resource) {
                	if($resource['type'] == 'node'){
						$cpu_usage += $resource['cpu'];
						$cpu += $resource['maxcpu'];

						$memory_usage += $resource['mem'];
						$memory += $resource['maxmem'];

						$disk_usage += $resource['disk'];
						$disk += $resource['maxdisk'];

						// Node Statistic
						if($resource['status'] == 'online'){
							$node_running = $node_running + 1;
						}else{
							$node_stopped = $node_stopped + 1;
						}
					}

					if($resource['type'] == 'qemu' || $resource['type'] == 'lxc'){

                        $vm_cpu_usage = number_format($resource['cpu'] * 100, 2);
                        $vm_mem_usage = number_format($resource['mem'] / $resource['maxmem'] * 100, 2);

                        $_data = array(
                            'name' => $resource['name'],
                            'status' => $resource['status'],
                            'uptime' => gmdate("H:i:s", $resource['uptime']),
                            'node' => $resource['node'],
                            'vmid' => $resource['vmid'],
                            'maxdisk' => number_format($resource['maxdisk'] / pow(1024, 3), 1) . " G",
                            'maxmem' => number_format($resource['maxmem'] / pow(1024, 3), 1) . " G",
                            'mem' => number_format($resource['mem'] / pow(1024, 3), 1) . " G",
                            'cpu' => $vm_cpu_usage . " %",
                            'mem_usage' => $vm_mem_usage ." %",
                            'vmid' => $resource['vmid'],
                            'maxcpu' => $resource['maxcpu'],
                        );

                        if($vm_cpu_usage > 80){
                            array_push($top_cpu, $_data);
                        }

                        if($vm_mem_usage > 80){

                            array_push($top_memory, $_data);
                        }

						// Virtual Machine Statistic
						if($resource['status'] == 'running'){
							$vm_running++;
						}else{
							$vm_stopped++;
						}
					}

					if($resource['type'] == 'storage'){
						$disk_usage += $resource['disk'];
						$disk += $resource['maxdisk'];
					}
                }

                return response([
                	'data' => [
						'cpu' => [
                            "total" => $cpu,
                            "usage" => $cpu_usage
                        ],
						'memory' => [
                            "total" => $memory,
                            "usage" => $memory_usage
                        ],
						'disk' => [
                            "total" => $disk,
                            "usage" => $disk_usage
                        ],
						'vm_status' => [
                            "total" => $vm_running + $vm_stopped,
                            "running" => $vm_running,
                            "stopped" =>  $vm_stopped
                        ],
						'node_status' => [
                            "total" => $node_running + $node_stopped,
                            "running" => $node_running,
                            "stopped" => $node_stopped
                        ],
                        'top_cpu' => $top_cpu,
                        'top_memory' => $top_memory
					]
                ]);
            }
		}catch (\Exception $e) {
			return response([
				"message"      => 'Internal Server Error'
			], 500);
		}
	}


    public function top_disk_weareout()
    {
        $seconds = env('CACHE_LIFETIME');
        $nodes = Cache::remember('nodes', $seconds,  function () {
            $response = PMXConnect::connection(env('PMX_HOST') . '/api2/json/cluster/status', 'GET');

            $data = array();

            if($response->getStatusCode() == 200){
                $clusters = json_decode($response->getBody(), true);

                foreach ($clusters['data'] as $key => $cluster) {
                    if($cluster['type'] == 'node'){

                        $response = PMXConnect::connection(env('PMX_HOST') . '/api2/json/nodes/'.$cluster['name'].'/status', 'GET');

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

            return $data;
        });

        $data = array();
        foreach ($nodes as $key => $node) {
            $response = PMXConnect::connection(env('PMX_HOST') . '/api2/json/nodes/'.$node['name'].'/disks/list', 'GET');

            if($response->getStatusCode() == 200){
                $response = json_decode($response->getBody(), true);

                $resource = $response['data'];

                foreach($resource as $r){
                    $wearout_raw = $r['wearout'];

                    if(is_numeric($wearout_raw) == 1){
                        $wearout = (100 - (int)$wearout_raw);

                        if($wearout > 80){
                            $_data = [
                                "node" => $node['name'],
                                "model" => $r['model'],
                                "used" => $r['used'],
                                "gpt" => $r['gpt'],
                                "type" => $r['type'],
                                "devpath" => $r['devpath'],
                                "serial" => $r['serial'],
                                "osdid-list" =>['osdid-list'],
                                "health" => $r['health'],
                                "wwn" => $r['wwn'],
                                "wearout" => $wearout.' %',
                                "osdid" => $r['osdid'],
                                "vendor" => $r['vendor'],
                                "by_id_link" => $r['by_id_link'],
                                "size" => $r['size'],
                                "rpm" => $r['rpm']
                            ];

                            array_push($data, $_data);
                        }

                    }
                }
            }
        }

        return DataTables::of($data)->addIndexColumn()->make(true);


    }

}
