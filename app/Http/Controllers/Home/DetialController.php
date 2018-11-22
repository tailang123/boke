<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Articel;
use App\Model\Home\Detial;
use Illuminate\Support\Facades\Validator;
use App\Repositories\DetialRepository;
class DetialController extends Controller
{
    protected $repo;

    public function __construct(DetialRepository $repo)
    {
        $this->repo = $repo;
    }
    // 详情页
    public function index($id)
    {
        $detial = $this->repo->DetialAll($id);
        $articel = $this->repo->ArticelFind($id);
        // 阅读数量+1
        $this->repo->add($id);
        
        return view('Home.detial.index',[
            'articel' => $articel,
            'detial' => $detial
        ]);
    }
    
    // 评论操作
    public function create(Request $request,$id)
    {
        return $this->repo->create($request,$id);
    }
}
