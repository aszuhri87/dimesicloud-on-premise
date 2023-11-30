<?php

namespace App\Http\Controllers;

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
            $auth_data = Session::get('data');

            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                'POST',
                config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/start',
                [
                    'headers' => [
                        'CSRFPreventionToken' => $auth_data['CSRFPreventionToken'],
                        'Cookie' => 'PVEAuthCookie=' . $auth_data['ticket'],
                        "Authorization" => "PVEAPIToken=" . env('PMX_USER') . "!" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                        "User-Agent" => "DimensiCloud",
                    ]
                ]
            );

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
            $auth_data = Session::get('data');

            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                'POST',
                config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/reboot',
                [
                    'headers' => [
                        'CSRFPreventionToken' => $auth_data['CSRFPreventionToken'],
                        'Cookie' => 'PVEAuthCookie=' . $auth_data['ticket'],
                        "Authorization" => "PVEAPIToken=" . env('PMX_USER') . "!" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                        "User-Agent" => "DimensiCloud",
                    ]
                ]
            );

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
            $auth_data = Session::get('data');

            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                'POST',
                config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/stop',
                [
                    'headers' => [
                        'CSRFPreventionToken' => $auth_data['CSRFPreventionToken'],
                        'Cookie' => 'PVEAuthCookie=' . $auth_data['ticket'],
                        "Authorization" => "PVEAPIToken=" . env('PMX_USER') . "!" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                        "User-Agent" => "DimensiCloud",
                    ]
                ]
            );

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
            $auth_data = Session::get('data');

            $client = new \GuzzleHttp\Client([
                'verify' => false
            ]);

            $response = $client->request(
                'POST',
                config('app.proxmox') . '/api2/json/nodes/' . $node . '/qemu/' . $vmid . '/status/stop',
                [
                    'headers' => [
                        'CSRFPreventionToken' => $auth_data['CSRFPreventionToken'],
                        'Cookie' => 'PVEAuthCookie=' . $auth_data['ticket'],
                        "Authorization" => "PVEAPIToken=" . env('PMX_USER') . "!" . env('PMX_TOKEN_ID') . "=" . env('PMX_TOKEN'),
                        "User-Agent" => "DimensiCloud",
                    ]
                ]
            );

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
