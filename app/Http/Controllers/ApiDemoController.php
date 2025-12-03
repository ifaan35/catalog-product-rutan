<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDemoController extends Controller
{
    public function index()
    {
        return view('demo.api-indonesia');
    }
}
