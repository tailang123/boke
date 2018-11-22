<?php 
namespace App\Repositories;

use App\Model\Admin\Articel;

use App\Model\Home\Detial;

use Illuminate\Support\Facades\Validator;


class DetialRepository 
{

    public function DetialAll($id)
    {
        return Detial::where('articel_id',$id)->get();
    }

    public function ArticelFind($id)
    {
        return Articel::find($id);
    }

    public function DetialFind($id)
    {
        return Detial::find($id);
    }

    public function add($id)
    {
        $articel = $this->ArticelFind($id);
        $articel->update([
            'read' => $articel->read + 1
        ]);
    }
    
    public function create($request,$id)
    {
        $input = $request->all();
        $messages = [
            'content.required' => '不能为空'
        ];
        $validator = Validator::make($input, [
            'content' => 'required'
        ], $messages);
        if ($validator->fails()) {
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