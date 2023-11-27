<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function get(){
            // $conn = Influx::connection();

    // $point = Point::measurement('temp_c')
    // ->addTag('location', 'Melbourne')
    // ->addField('degrees', 14)
    // ->addField('humidity', 0.57)
    // ->time(microtime(true));

    // $tex = $conn->createWriteApi()->write($point, WritePrecision::S, "dimensi-test", "varx");
    // $bucket = getenv('DOCKER_INFLUXDB_INIT_BUCKET');

    // $query = "from(bucket: \"proxmox\")
    // |> range(start: -1h)
    // |> filter(fn: (r) => r[\"_measurement\"] == \"cpustat\")
    // |> filter(fn: (r) => r[\"_field\"] == \"avg1\")
    // |> filter(fn: (r) => r[\"host\"] == \"R230\")
    // |> filter(fn: (r) => r[\"object\"] == \"nodes\")
    // |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)
    // |> yield(name: \"mean\")";

    // $get = $conn->createQueryApi()->query($query);
    }
}
