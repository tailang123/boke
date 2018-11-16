<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Articel;

class IndexController extends Controller
{
    //前台首页
    public function index(Request $request)
    {
        if($request->has('title')){
            $articels = Articel::where('title','like','%'.$request->title.'%')->paginate(3);
        }else{
            $articels = Articel::paginate(3);
        }
        return view('Home.index',[
            'articels' =>$articels
        ]);
    }


}
