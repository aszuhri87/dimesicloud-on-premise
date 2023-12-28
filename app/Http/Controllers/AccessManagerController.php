<?php

namespace App\Http\Controllers;

use App\Models\AccessManager;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\Facades\DataTables;

class AccessManagerController extends Controller
{
    public function index(){
        return view('management_access.index');
    }

    public function dt(){
        $data = DB::table('access_managers')
        ->select([
            'id',
            'name',
            'sshkey'
        ]);

        return DataTables::query($data)->addIndexColumn()->make(true);

    }

    public function store(Request $request){
        try {

            $check = AccessManager::where('sshkey', $request->sshkey)->first();

            if ($check){
                return response()->json([
                    "message" => 'Already exist!',
                    "code"=> 400
                ], 400);
            }

            AccessManager::create([
                'name' => $request->name,
                'sshkey' => $request->sshkey
            ]);

            return response()->json([
                "message" => 'Success',
                "code"=> 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "server error",
                "code"=> 500
            ], 500);
        }
    }

    public function destroy($id){
        try {
            //code...
            AccessManager::find($id)->delete();
            return response()->json([
                "message" => 'Success',
                "code"=> 200
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "message" => 'Server Error',
                "code"=> 500
            ], 500);
        }
    }
}
