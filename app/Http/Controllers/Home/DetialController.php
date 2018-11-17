<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Articel;
use App\Model\Home\Detial;
use Illuminate\Support\Facades\Validator;

class DetialController extends Controller
{
    // 详情页
    public function index($id)
    {
        
        $articel = Articel::find($id);
        $detial = Detial::where('articel_id',$id)->get();
        
        Articel::where('id',$id)->update([
            'read' => $articel->read + 1
        ]);
        return view('Home.detial.index',[
            'articel' => $articel,
            'detial' => $detial
        ]);
    }
    
    // 评论操作
    public function create( $request,$id)
    {
        $input = $request->all();
        $messages = [
            'content.required' => '不能为空'
        ];
        $validator = Validatormake($input, [
            'content' => 'required'
        ], $messages);
        if ($validator->fails) {
            $errors = $validator->errors();

            return ['status', 'msg' => $errors->first()];
        }
        try{
            Detial::create([
                'content' => $input['content'],
                'articel_id' => $id
            ]);
        }catch(\Exception $e){
            return ['status'=>0,'message'=>$e->getMessage()];
        }
        return ['status'=>1,'message'=>'评论成功'];
    }
}
