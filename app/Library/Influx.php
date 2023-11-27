<?php

namespace App\Library;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;

class Influx {

    public static function connection(){

        $token = getenv('DOCKER_INFLUXDB_INIT_ADMIN_TOKEN');
        $org = getenv('DOCKER_INFLUXDB_INIT_ORG');
        $bucket = getenv('DOCKER_INFLUXDB_INIT_BUCKET');

        $client = new Client(
            [
                "url" => "http://172.16.200.11:8086/",
                "token" => $token,
                "bucket" => $bucket,
                "org" => $org,
                "precision" => WritePrecision::NS,
            ]
        );

        $client->close();

        return $client;
    }
}
