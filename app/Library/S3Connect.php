<?php

namespace App\Library;

use Aws\S3\S3Client;
use Aws\Credentials\Credentials;

class S3Connect {
    public static function client(){
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $config = array(
            'region'  => 'us-east-1',
            'credentials' => $credentials,
            'endpoint' => env('AWS_HOST'),
        );

        $s3 = new S3Client($config);

        return $s3;
    }
}
