<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('index');
    }

    public function store()
    {
        return view ('store');
    }

    public function news()
    {
        return view ('news');
    }
}
