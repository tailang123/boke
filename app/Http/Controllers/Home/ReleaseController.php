<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Release;
use Illuminate\Support\Facades\Validator;

class ReleaseController extends Controller
{
    // 留言版块
    public function index()
    {
        $releases = Release::orderBy('id','desc')->get();
        return view('Home.release.index',[
            'releases' => $releases
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $messages = [
            'text.required' => '留言不能为空',
        ];
        $validator = Validator::make($input, [
            'text' => 'required',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['status' => 0, 'msg' => $errors->first()];
        }
        try {
            Release::create([
                'text' => $input['text'],
            ]);
        } catch (\Exception $e) {
            return ['status' => 0, 'msg' => $e->getMessage()];
        }
        return ['status' => 1, 'msg' => '添加成功'];
    }
}
