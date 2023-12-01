<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function statistic_resources()
	{
		try {
			$client = new \GuzzleHttp\Client([
			    'verify' => false
			]);

            $headers = [
                "Authorization" => "PVEAPIToken=" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN')
            ];

			$response = $client->request(
                'GET',
                env('PMX_HOST').'/api2/json/cluster/resources',
                [
                    'headers' => $headers
                ]
            );

            if($response->getStatusCode() == 200){
                $resources = json_decode($response->getBody(), true);

                $data = array();
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

					if($resource['type'] == 'qemu'){

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
                        ]
					]
                ]);
            }
		}catch (\Exception $e) {
            dd($e);
			return response([
				"message"      => 'Internal Server Error'
			], 500);
		}
	}

}
