<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use App\Library\S3Connect;
use Aws\S3\S3Client;
use Aws\Credentials\Credentials;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\App;
use Aws\Credentials\CredentialsInterface;
use Storage;
use Aws\Macie2\Macie2Client;
class ObjectStorageController extends Controller
{
    public function index(){
        $s3 = S3Connect::client();

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
        $s3 = S3Connect::client();

        $list_buckets = $s3->listBuckets();

        $data = array();
        $buckets = $list_buckets->toArray()['Buckets'];

        if($buckets){
            foreach($buckets as $b){
                $time = strtotime(strval($b['CreationDate']));

                $date = date('d/m/Y',$time);

                $_data = ([
                    'name' => $b['Name'],
                    'updated_at' => $date
                ]);

                array_push($data, $_data);
            }
        }

        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function detail_list(){
        return view('object_storage_detail.index');
    }

    public function detail($bucket){
        $s3 = S3Connect::client();

        $results = $s3->listObjects(['Bucket' => $bucket]);

        $data = array();
        $res = array();

        if ($results['Contents']){
            foreach ($results['Contents'] as $object) {
                $time = strtotime(strval($object['LastModified']));

                $date = date('d/m/Y',$time);

                $res = ([
                   'name' => $object['Key'] . PHP_EOL,
                   'last_modified' => $date,
                   'size' => $object['Size'],
                //    'acl' => $acl
                ]);

                array_push($data, $res);
            }
        }


        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function create(Request $request){
        try {
            $s3 = S3Connect::client();

            $result = $s3->createBucket([
                'Bucket' => $request->name,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function bucket_privacy(Request $request, $bucket){
        $s3 = S3Connect::client();
        // 'private|public-read|public-read-write|authenticated-read',
        $s3->putBucketAcl([
            'ACL' => $request->privacy,
            'Bucket' => $bucket,
        ]);
    }

    public function delete($bucket){
        try {
            $s3 = S3Connect::client();

            $result = $s3->deleteBucket([
                'Bucket' => $bucket,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function create_object(Request $request, $bucket){
        try {
            $s3 = S3Connect::client();

            $file = $request->file('file');

            $type = null;

            if(!$request->type || $request->type != 'on'){
                $type = 'public-read';
            } else {
                $type = 'private';
            }

            if(!$file){
                return response()->json([
                    'code' => 400,
                    'message' => 'file not found!',
                ], 400);
            }

            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key' => $file->getClientOriginalName(),
                'ACL' => $type,
                'SourceFile' => $request->file('file')
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function privacy_object(Request $request, $bucket, $key){
        try {
            //'public-read' | 'private'
            $s3 = S3Connect::client();

            $s3->putObjectAcl([
                'Bucket' => $bucket,
                'Key' => $key,
                'ACL' => $request->type
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function delete_object($bucket, $key){
        try {
            $s3 = S3Connect::client();

            $result = $s3->deleteObject([
                'Bucket' => $bucket,
                'Key' => $key
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function share_object($bucket, $key, Request $request){
        try {
            $s3 = S3Connect::client();

            $plain_url = $s3->getObjectUrl($bucket, $key);

            $secret_plans_cmd = $s3->getCommand('GetObject', ['Bucket' => $bucket, 'Key' => $key]);
            $presigned_url = $s3->createPresignedRequest($secret_plans_cmd, '+'.$request->timeout.' '.$request->time);

            $data = ([
                'plain_url' => $plain_url,
                'presigned_url' => $presigned_url->getUri().PHP_EOL
            ]);

            return response()->json([
                'code' => 200,
                'data' => $data,
                'message' => 'Success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => 'error',
            ], 500);
        }
    }

    public function show_object($bucket, $key, Request $request){
            $s3 = S3Connect::client();

            $plain_url = $s3->getObjectUrl($bucket, $key);

            $secret_plans_cmd = $s3->getCommand('GetObject', ['Bucket' => $bucket, 'Key' => $key]);
            $presigned_url = $s3->createPresignedRequest($secret_plans_cmd, $request->timeout);

            return \Redirect::to($plain_url);
    }
}
