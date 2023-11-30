<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Influx;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function get()
    {

    }

}
