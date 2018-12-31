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
        echo $qc->qq_callback();
        echo $qc->get_openid();
    }
}
