<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index()
    {
        // Homepage displays hero section only
        return view('home');
    }
}
