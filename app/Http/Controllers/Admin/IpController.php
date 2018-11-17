<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Ip;

class IpController extends Controller
{
    // ip列表页
    public function index()
    {
        $ip = Ip::orderBy('id','desc')->paginate(20);
        $count = Ip::count();
        return view('Admin.Ip.index',[
            'ip' => $ip,
            'count' => $count
        ]);
    }
}
