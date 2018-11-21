<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Articel;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ArticelRepository;
use App\Http\Requests\Requests\ArticelRequest;
class ArticelController extends Controller
{

    protected $repo;

    public function __construct(ArticelRepository $repo)
    {
        $this->repo = $repo;
    }

    // 文章列表页
    public function index()
    {
        $count = Articel::count();
        $articels = Articel::orderBy('id','desc')->paginate(7);
        return view('Admin.articel.index',[
            'count' => $count,
            'articels' => $articels
        ]);
    }
    
    // 文章添加页
    public function create()
    {
        return view('Admin.articel.create');
    }

    // 文章添加操作
    public function store(Request $request)
    {
        $messages = [
            'title.unique' => '标题不能为空',
            'content1.unique' => '文章不能为空'
        ];
        $validator = Validator::make($input, [
            'title' => 'required',
            'content1' => 'required',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['status' => 0, 'msg' => $errors->first()];
        }
        
        // 创建数据
        return $this->repo->create($request);
    }

    // 图片添加操作
    public function image(Request $request)
    {
        if($request->hasFile('imgFile')){
            $disk = \Storage::disk('public');
            $image = $disk->put('avatar', $request->file('imgFile'));
            return ['error'=>0,'url'=>'/public/app/'.$image];
        }
        return ['error'=>1,'message'=>'没有上传图片'];
    }

    // 文章修改页
    public function edit($id)
    {
        $articel = Articel::find($id);
        return view('Admin.articel.edit',[
            'articel'=>$articel
        ]);
    }

    // 文章修改操作
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $messages = [
            'title.unique' => '标题不能为空',
            'content1.unique' => '文章不能为空'
        ];
        $validator = Validator::make($input, [
            'title' => 'required',
            'content1' => 'required',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['status' => 0, 'msg' => $errors->first()];
        }
        try {
            Articel::where('id',$id)->update([
                'title' => $input['title'],
                'content' => $input['content1']
            ]);
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => $e->getMessage()];
        }
        return ['status' => 1, 'message' => '修改文章成功'];
    }

    // 文章删除操作
    public function destroy($id)
    {
        try{
            Articel::destroy($id); 
        }catch(\Exception $e){
            return ['status' => 0];
        }
        return ['status' => 1];
    }
}
