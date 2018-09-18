@extends('Admin.index')
@section('content')
<body>
<div class="x-body layui-anim layui-anim-up">
    <form class="layui-form" id="userForm">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="name"" required="" lay-verify="name"
                autocomplete="off" class="layui-input" value="{{$name->name}}" disabled>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的登入名
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_pass" class="layui-form-label">
                <span class="x-red">*</span>密码
            </label>
            <div class="layui-input-inline">
                <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                6到16个字符
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
                <span class="x-red">*</span>确认密码
            </label>
            <div class="layui-input-inline">
                <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
        
        //自定义验证规则
        form.verify({
        nikename: function(value){
            if(value.length < 5){
            return '昵称至少得5个字符啊';
            }
        }
        ,pass: [/(.+){6,12}$/, '密码必须6到12位']
        ,repass: function(value){
            if($('#L_pass').val()!=$('#L_repass').val()){
                return '两次密码不一致';
            }
        }
        });
    
        //监听提交
        form.on('submit(add)', function(data){
        //发异步，把数据提交给php
        $.ajax({
            type:'PUT',
            url:'{{url("aadmin/user/".$name->id)}}',
            data:$('#userForm').serialize(),
            datatype:'json',
            success:function(data){
                if(data.status == 1){
                    layer.alert(data.msg, {icon: 6},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        var a = parent.layer.close(index);
                    });
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            }
        })

        
        return false;
        });
    });
</script>
@endsection