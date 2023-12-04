<?php

namespace App\Library;

use Session;

class PMXConnect {

    public static function connection($url, $method){

        $headers = [
            "Authorization" => "PVEAPIToken=" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN')
        ];

        $auth_data = Session::get('data');
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->request(
            $method,
            $url,
            [
                'headers' => $headers
            ]
        );

        return $response;
    }
}
