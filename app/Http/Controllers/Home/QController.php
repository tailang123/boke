<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\libs\API;


class QController extends Controller
{
    public function QQLogin()
    {
        $qc = new \QC();
        $qc->qq_login();
    }
}
