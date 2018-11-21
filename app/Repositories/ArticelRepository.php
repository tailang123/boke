<?php 
namespace App\Repositories;
use App\Model\Admin\Articel;

class ArticelRepository
{
    // 创建文章
    public function create($request)
    {
        
        $input = $request->all();
        try{
            Articel::create([
                'title' => $input['title'],
                'content' => $input['content1']
            ]);
        }catch(\Exception $e){
            return ['status'=>0,'message'=>$e->getMessage()];
        }
        return ['status'=>1,'message'=>'文章发布成功'];
    }
}