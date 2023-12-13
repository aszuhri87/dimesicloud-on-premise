<?php

namespace App\Http\Controllers;

use App\Models\NotificationReceipt;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;

class ManagementAlert extends Controller
{
    public function index(){
        return view('management_alert.index');
    }

    public function dt_email(){
        $data = DB::table('notification_receipts')
        ->select([
            'id',
            'value',
            'type'
        ])
        ->where('type', 'email')
        ->whereNull('deleted_at');

        return DataTables::query($data)->addIndexColumn()->make(true);
    }

    public function dt_telegram(){
        $data = DB::table('notification_receipts')
        ->select([
            'id',
            'value',
            'type'
        ])
        ->where('type', 'telegram')
        ->whereNull('deleted_at');

        return datatables::query($data)->addIndexColumn()->make(true);

    }

    public function store(Request $request){
        try {

            $check = NotificationReceipt::where('value', $request->value)->whereNull('deleted_at')->first();

            if($check){
                return response()->json([
                    'message' => ucwords($request->type)." already exist!",
                    'code' => 400
                ], 400);
            }

            NotificationReceipt::create([
                'type' => $request->type,
                'value' => $request->value
            ]);

            return response()->json([
                'message' => "Success",
                'code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Error",
                'code' => 500
            ], 500);
        }
    }

    public function delete($id){
        try {
            $data = NotificationReceipt::find($id);
            $data->delete();

            return response()->json([
                'message' => "Success",
                'code' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Error",
                'code' => 500
            ], 500);
        }
    }
}
