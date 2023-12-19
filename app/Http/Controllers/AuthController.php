<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Session;
class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);


        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->request(
            'POST',
            config('app.proxmox').'/api2/extjs/access/ticket',
            [
                'form_params' => [
                    'username' => $request->username,
                    'password' => $request->password,
                    'realm' => 'pam'
                ]
            ]
        );
        if($response->getStatusCode() == 200){
            $response = json_decode($response->getBody(), true);

            if(!is_null($response['data'])){
                Session::put('login',TRUE);
                Session::put('data',$response['data']);
                return redirect('/dashboard');
            }
            return Redirect::back()->withErrors(['message' => 'Username atau password salah.']);
        }
    }

    public function logout()
    {
        if(Session::get('login')) {
            Session::flush();
        }

        return redirect('/');
    }
}
