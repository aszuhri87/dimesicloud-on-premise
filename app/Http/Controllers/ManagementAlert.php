<?php

namespace App\Http\Controllers;

use App\Models\NotificationReceipt;
use Illuminate\Http\Request;

class ManagementAlert extends Controller
{
    public function index(){
        return view('management_alert.index');
    }

    public function store(Request $request){
        try {
            $exist = NotificationReceipt::whereNull('deleted_at')->first();

            if(!$exist){
                NotificationReceipt::create([
                    'type' => $request->type,
                    'value' => $request->email
                ]);

                return response()->json([
                    'message' => "Success",
                    'code' => 200
                ], 200);
            }

            $update = NotificationReceipt::whereNull('deleted_at')->where('id', $exist->id);
            $update->update([
                'type' => $request->type,
                'value' => $request->email
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
}
