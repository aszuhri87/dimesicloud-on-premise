<?php

namespace App\Http\Controllers;

use App\Library\PMXConnect;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Auth;
use Session;

class PowerManagementController extends Controller
{
    public function start($node, $vmid)
    {
        try {
            $response = PMXConnect::connection( config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/start', 'POST');

            if ($response->getStatusCode() == 200) {
                return response([
                    'message' => 'Success'
                ]);
            }

        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }


    public function reboot($node, $vmid)
    {
        try {
            $response = PMXConnect::connection( config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/reboot', 'POST');

            if ($response->getStatusCode() == 200) {
                return response([
                    'message' => 'Success'
                ]);
            }

        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }

    public function shutdown($node, $vmid)
    {
        try {
            $response = PMXConnect::connection( config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/stop', 'POST');

            if ($response->getStatusCode() == 200) {
                return response([
                    'message' => 'Success'
                ]);
            }

        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }

    public function force_shutdown($node, $vmid)
    {
        try {
            $response = PMXConnect::connection( config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/reboot', 'POST');

            if ($response->getStatusCode() == 200) {
                return response([
                    'message' => 'Success'
                ]);
            }

        } catch (ClientException $e) {
            return response([
                "message" => 'Token Expired'
            ], 401);
        } catch (Exception $e) {
            return response([
                "message" => 'Internal Server Error'
            ], 500);
        }
    }
}
