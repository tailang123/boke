<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Articel;
use App\Model\Home\Ip;

class IndexController extends Controller
{
    //前台首页
    public function index(Request $request)
    {
     
        $ip = $request->getClientIp();
        // ip记录 30 分钟通同一个ip记录一次,如果没有此ip直接写入
        Ip::create([
            'ip' => $ip,
        ]);
        if($request->has('title')){
            $articels = Articel::where('title','like','%'.$request->title.'%')->orderBy('id','desc')->paginate(3);
        }else{
            $articels = Articel::orderBy('id','desc')->paginate(3);
        }

        return view('Home.index',[
            'articels' =>$articels
        ]);
    }
}