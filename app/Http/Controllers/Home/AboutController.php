<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    // 关于页
    public function index()
    {
        return view('Home.about.index');
    }
}
