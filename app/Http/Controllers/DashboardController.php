<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Influx;


class DashboardController extends Controller
{
    public function index(){
        $conn = Influx::connection();

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

        $host_query = "from(bucket: \"proxmox\")
        |> range(start: -1h)
        |> keys()
        |> keep(columns: [\"host\"])
        |> distinct()";

        $get_host = $conn->createQueryApi()->query($host_query);

        $host_arr = [];
        foreach($get_host as $g){
            $host_arr[] = $g->records[0]->values['host'];
        }

        // $host_json = json_encode($host_arr);
        $host_json = json_encode(["anto-vm1"]);

        $mem_query = "
        servers = $host_json
        mem = from(bucket: \"proxmox\")
        |> range(start: -1h)
        |> filter(fn: (r) => r[\"_measurement\"] == \"system\")
        |> filter(fn: (r) => r[\"_field\"] == \"mem\")
        |> filter(fn: (r) => r[\"object\"] == \"qemu\")
        |> filter(fn: (r) => r[\"_value\"] > 0)
        |> filter(fn: (r) => contains(value: r[\"host\"], set: servers))
        |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)

      maxmem = from(bucket: \"proxmox\")
        |> range(start: -1h)
        |> filter(fn: (r) => r[\"_measurement\"] == \"system\")
        |> filter(fn: (r) => r[\"_field\"] == \"maxmem\")
        |> filter(fn: (r) => r[\"object\"] == \"qemu\")
        |> filter(fn: (r) => r[\"_value\"] > 0)
        |> filter(fn: (r) => contains(value: r[\"host\"], set: servers))
        |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)

      join(
        tables: {mem: mem, maxmem: maxmem},
        on: [\"_time\", \"_stop\", \"_start\", \"host\"]
      )
      |> map(fn: (r) => ({
        _time: r._time,
        _value: float(v: r._value_mem) / float(v: r._value_maxmem) * float(v: 100),
        host: r.host
      }))
      |> group(columns: [\"host\"])";

      $get_mem = $conn->createQueryApi()->query($mem_query);

      $mem_arr = [];
      foreach($get_mem as $g){
          $mem_arr[] = $g->records[0]->values;
      }

    //   $cpu_query = "
    //   servers = $host_json

    //   maxdisk = from(bucket: \"proxmox\")
    //     |> range(start: -1h)
    //     |> filter(fn: (r) => r[\"_measurement\"] == \"system\")
    //     |> filter(fn: (r) => r[\"_field\"] == \"maxdisk\")
    //     |> filter(fn: (r) => r[\"object\"] == \"qemu\")
    //     |> filter(fn: (r) => r[\"_value\"] > 0, onEmpty: \"drop\")
    //     |> filter(fn: (r) => contains(value: r[\"host\"], set: servers))
    //     |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)
    //     |> yield(name: \"mean\")

    //     maxdisk |> map(fn: (r) => ({
    //       _time: r._time,
    //       _value: float(v: r._value_maxdisk) * float(v: 100),
    //       host: r.host
    //     }))
    //   |> group(columns: [\"host\"])";

    // disk = from(bucket: \"proxmox\")
    // |> range(start: -1h)
    // |> filter(fn: (r) => r[\"_measurement\"] == \"system\")
    // |> filter(fn: (r) => r[\"_field\"] == \"disk\")
    // |> filter(fn: (r) => r[\"object\"] == \"qemu\")
    // |> filter(fn: (r) => contains(value: r[\"host\"], set: servers))
    // |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)
    $cpu_query = "
    servers = $host_json

  maxdisk = from(bucket: \"proxmox\")
    |> range(start: -1h)
    |> filter(fn: (r) => r[\"_measurement\"] == \"system\")
    |> filter(fn: (r) => r[\"_field\"] == \"maxdisk\")
    |> filter(fn: (r) => r[\"object\"] == \"qemu\")
    |> filter(fn: (r) => r[\"_value\"] > 0, onEmpty: \"drop\")
    |> filter(fn: (r) => contains(value: r[\"host\"], set: servers))
    |> aggregateWindow(every: 10s, fn: mean, createEmpty: false)
    |> yield(name: \"mean\")

    ";
    //   join(
    //     tables: {disk: disk, maxdisk: maxdisk},
    //     on: [\"_time\", \"host\"]
    //   )
    //   |> map(fn: (r) => ({
    //     _time: r._time,
    //     _value: float(v: r._value_disk) / float(v: r._value_maxdisk) * float(v: 100),
    //     host: r.host
    //   }))
    //   |> distinct()
    //   |> group(columns: [\"host\"])

    $get_cpu = $conn->createQueryApi()->query($cpu_query);

    $cpu_arr = [];
    foreach($get_cpu as $g){
        $cpu_arr[] = $g->records[0]->values;
    }

    dd($cpu_arr);

        return view('dashboard.index');
    }

    public function get(){
            $conn = Influx::connection();

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

    $query = "from(bucket: \"proxmox\")
    |> range(start: -1h)
      |> keys()
      |> keep(columns: [\"host\"])
      |> distinct()";

    $get = $conn->createQueryApi()->query($query);
    dd($get);
    }

}
