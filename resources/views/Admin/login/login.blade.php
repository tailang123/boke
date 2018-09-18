<!doctype html>
<html lang="en">  
<head>
	<meta charset="UTF-8">
	<title>HongFei.Sun博客后台</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

	  <link rel="icon" href="/timg.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />
    <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">HongFei.Sun博客管理系统登录</div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" id="adminForm">
            <input name="name" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="button" id="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            $('#submit').click(function(){
                $.ajax({
                    type:'POST',
                    data:$('#adminForm').serialize(),
                    url:'{{url("aadmin/dologin")}}',
                    dateTpye:'json',
                    success:function(admin){
                        if(admin.status == 1){
                            layer.msg(admin.msg, {icon: 1});
                            location.href = '{{url("aadmin")}}';
                        }else{
                            layer.alert(admin.msg,1);
                        }
                    }
                });
            });
        })
    </script>
</body>
<script>
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
</html>