<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QController extends Controller
{
    public function QQLogin()
    {
        $qc = new \QC();
        $qc->qq_login();
    }

    public function callback()
    {
        $qc = new \QC();
        $callbak = $qc->qq_callback();    //返回的验证值
        $openid = $qc->get_openid();        //qq分配的用户id
         
        $qq = new \QC($callbak,$openid);
        $result = $qq->get_user_info(); //获取用户信息
    }
}
