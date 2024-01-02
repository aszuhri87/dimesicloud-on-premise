<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use Aws\S3\S3Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\App;
use Aws\Credentials\Credentials;
use Storage;
use Aws\Macie2\Macie2Client;
class ObjectStorageController extends Controller
{
    public function index(){
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $config = array(
            'region'  => 'us-east-1',
            'credentials' => $credentials,
            'endpoint' => env('AWS_HOST'),
        );


        $s3 = new S3Client($config);

        $results = $s3->getPaginator('ListObjectsV2', [
            'Bucket' => 'examplebucket'
         ]);

        $data = array();
        $res = array();

        foreach ($results as $result) {
            foreach ($result['Contents'] as $object) {
                 $res = ([
                    'file' => $object['Key'] . PHP_EOL
                 ]);

                }
            array_push($data, $res);
        }

        return view('object_storage.index');
    }

    public function dt(){
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $config = array(
            'region'  => 'us-east-1',
            'credentials' => $credentials,
            'endpoint' => env('AWS_HOST'),
        );


        $s3 = new S3Client($config);
        $list_buckets = $s3->listBuckets();

        $data = array();
        $buckets = $list_buckets->toArray()['Buckets'];

        // $bucket = $s3->buck

        // $obj_data = $s3->headObject([
        //     'Bucket' => 'examplebucket',
        //     'Key'    => 'tx00000b581fb1d7b157665-00658d1cbd-fab9-default'
        //  ]);

        //  dd($obj_data);

        foreach($buckets as $b){
            $time = strtotime(strval($b['CreationDate']));

            $date = date('d/m/Y',$time);

            $_data = ([
                'name' => $b['Name'],
                'updated_at' => $date
            ]);

            array_push($data, $_data);
        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function detail_list(){
        return view('object_storage_detail.index');
    }

    public function detail($bucket){
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
        $config = array(
            'region'  => 'us-east-1',
            'credentials' => $credentials,
            'endpoint' => env('AWS_HOST'),
        );


        $s3 = new S3Client($config);

        $results = $s3->getPaginator('ListObjectsV2', [
            'Bucket' => $bucket
         ]);


        //  dd($results);

        $data = array();
        $res = array();

        foreach ($results as $result) {
            foreach ($result['Contents'] as $object) {
                $time = strtotime(strval($object['LastModified']));

                $date = date('d/m/Y',$time);

                 $res = ([
                    'name' => $object['Key'] . PHP_EOL,
                    'last_modified' => $date,
                    'size' => $object['Size']
                 ]);
            }

            array_push($data, $res);
        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }
}
