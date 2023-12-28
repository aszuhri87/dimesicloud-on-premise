<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\App;
use Aws\Credentials\Credentials;
use Storage;

class ObjectStorageController extends Controller
{
    public function index(){

        //Listing all S3 Bucket
        // $s3Client = App::make('aws')->createClient('s3');
        // // Call listBuckets with no parameters
        // $buckets = $s3Client->listBuckets();

        // dd($buckets);

        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $config = array(
            'region'  => 'us-east-1',
            'version' => 'latest',
            'credentials' => $credentials,
            'base_url' => env('AWS_HOST'),
            // 'command.params' => ['PathStyle' => true]
        );

        // $s3 = S3Client::factory([
        //     'region'  => 'us-east-1',
        //     'version' => 'latest',
        //     'credentials  ' => $credentials,
        //     // 'base_url' => env('AWS_HOST'),
        //     'command.params' => ['PathStyle' => true]
        // ]);

        $s3 = new S3Client($config);

        dd($s3->listBucketsAsync());

        // dd(Storage::disk('s3'));

        return view('object_storage.index');
    }
}
