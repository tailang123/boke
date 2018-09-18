<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\PrivateChannel;
use App\Model\Admin\Articel;
use App\Model\Admin\Admin;
class IndexController extends Controller
{
    // 后台首页
    public function index()
    {
        return view('Admin.index');
    }

    //欢迎页
    public function welcome()
    {
        $auth = Auth::guard('admin')->user();
        $articel = Articel::count();
        $admin = Admin::count();
        return view('Admin.welcome',[
            'auth' => $auth,
            'admin' => $admin,
            'articel' => $articel
        ]);
    }
}
