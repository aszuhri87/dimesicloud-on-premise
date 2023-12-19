<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use Illuminate\Http\Request;

class CEPHController extends Controller
{
    public function index(){
        return view('ceph.index');
    }

    public function get(){
        // try {
            $response = PMXConnect::connection(env('PMX_HOST').'/api2/json/cluster/ceph/status', 'GET');
            $response = json_decode($response->getBody(), true)['data'];

            $storage = PMXConnect::connection(env('PMX_HOST').'/api2/json/cluster/resources', 'GET');
            $storage = json_decode($storage->getBody(), true)['data'];

            // $raw = 0;

            // foreach($storage as $s){
            //     if($s['type'] == "storage"){
            //         if($s['storage'] == "ceph_storage"){
            //             $raw += $s['maxdisk'];
            //         }
            //     }
            // }

            // dd($response);

            $pg_category = array();
            $pg_count = array();

            foreach($response['pgmap']['pgs_by_state'] as $pg){
                $pg_category[] = $pg['state_name'];
                $pg_count[] = $pg['count'];
            }

            $data = [
                'health' => $response['health']['status'],
                'osd_total' => $response['osdmap']['num_osds'],
                'osd_in' => $response['osdmap']['num_in_osds'],
                'osd_up' => $response['osdmap']['num_up_osds'],
                'mgr_standbys_total' =>  sizeof($response['mgrmap']['standbys']),
                'mgr_standbys' => $response['mgrmap']['standbys'],
                'mgr_active_total' => sizeof($response['mgrmap']['active_addrs']),
                'mgr_active' => $response['mgrmap']['active_name'],
                'pg_category' =>json_encode(array_values($pg_category)),
                'pg_count' => json_encode(array_values($pg_count)),
                'pg_per_osds' => $response['pgmap']['num_objects'],
                'pg_pools' => $response['pgmap']['num_pools'],
                'monitors' => sizeof($response['quorum']).' ('. implode(", ", $response['quorum']). ')',
                'raw_capacity' => $response['pgmap']['bytes_total'],
                'raw_used' => $response['pgmap']['bytes_used'],
                'raw_avail' => $response['pgmap']['bytes_avail'],
                'num_object' => $response['pgmap']['num_objects']
            ];

            // dd($data);

            return response()->json([
                'data' => $data,
                'message' => 'success'
            ], 200);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'message' => 'Server Error'
        //     ], 500);
        // }
    }

}
