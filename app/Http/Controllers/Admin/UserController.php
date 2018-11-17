<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //管理员列表页
    public function index()
    {
        $admin = Admin::paginate(7);
        $count = Admin::count();
        return view('Admin.user.index',[
            'admins' => $admin,
            'count' => $count
        ]);
    }
    
    //管理添加页
    public function create()
    {
        return view('Admin.user.create');
    }

    //管理添加操作
    public function store(Request $request)
    {
        $input = $request->all();
        $messages = [
            'name.required' => '用户名不能为空',
            'name.unique' => '用户名不能重复',
            'pass.unique' => '密码不能为空'
        ];
        $validator = Validator::make($input, [
            'name' => 'required|unique:admin',
            'pass' => 'required'
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['status' => 0, 'msg' => $errors->first()];
        }
        try{
            Admin::create([
                'name' => $input['name'],
                'password' => bcrypt($input['pass']),
            ]);
        }catch(\Exception $e){
            
            return ['status' => 0, 'msg'=>$e->getMessage()];
        }
        return ['status' => 1, 'msg' => '添加成功'];
    }

    //管理员修改页
    public function edit($id)
    {
        $name = Admin::select('name','id')->find($id);
        return view('Admin.user.edit',[
            'name' => $name
        ]);
    }

    //管理员修改操作
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $messages = [
            'pass.unique' => '密码不能为空'
        ];
        $validator = Validator::make($input, [
            'pass' => 'required',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['status' => 0, 'msg' => $errors->first()];
        }
        try {
            Admin::where('id',$id)->update([
                'password' => bcrypt($input['pass']),
            ]);
        } catch (\Exception $e) {
            return ['status' => 0, 'msg' => $e->getMessage()];
        }
        return ['status' => 1, 'msg' => '添加成功'];
    }

    //管理员删除操作
    public function destroy($id)
    {
        try{
            Admin::destroy($id);
        }catch( \Exception $e ){
            return ['status' => 0, 'msg' => '删除成功'];
        }
        return ['status' => 1, 'msg' => '删除成功'];
    }

    // 批量删除用户
    public function destroyAll(Request $request)
    {
        $input = $request->all();
        $id = ltrim($input['id'],',');
        $d = explode(',',$id);
        try{
            Admin::whereIn('id',$d)->delete();
        }catch(\Exception $e){
            return ['status' => 0, 'msg' => '删除失败'];
        }  
        return ['status' => 1, 'msg' => '删除成功'];
    }
}
