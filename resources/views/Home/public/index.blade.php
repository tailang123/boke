<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="Keywords" content="hongfei,博客,shongfei博客,轻博客,shongfei,鸿飞，鸿飞博客"/>
	<meta name="Description" content="hongfei博客"/>
	<title>HongFei.Sun轻博客</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('hhome/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{asset('hhome/static/css/mian.css')}}">
	<meta name="baidu-site-verification" content="Y913AzkCGm" />
	<meta name="csrf-token" content="{{ csrf_token()}}">

	<meta name="baidu-site-verification" content="Y913AzkCGm" />
	<script src="{{asset('jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('layer\layer\layer.js')}}"></script>
	<link rel="icon" href="/timg.ico" type="image/x-icon" />
</head>
<body class="lay-blog">
		<div class="header">
			<div class="header-wrap">
				<h4 class="logo pull-left" style="   margin-top: 22px;">
					<a href="{{url('/')}}">
						<img src="{{asset('hhome/static/images/logo.png')}}" alt="" class="logo-img">
						<span style="color:white; ">HongFei.Sun博客</span>
					</a>
				</h4>
				<form class="layui-form blog-seach pull-left" action="{{url('/')}}">
					<div class="layui-form-item blog-sewrap">
					    <div class="layui-input-block blog-sebox">
					      <i class="layui-icon layui-icon-search"></i>
					      <input type="text" name="title" lay-verify="title" autocomplete="off"  class="layui-input">
					    </div>
					</div>
				</form>
				
				<div class="blog-nav pull-right">
					<ul class="layui-nav pull-left">
					@section('navigation')
					  <li class="layui-nav-item layui-this"><a href="{{url('/')}}">首页</a></li>
					  <li class="layui-nav-item"><a href="{{url('release')}}">留言</a></li>
					  <li class="layui-nav-item"><a href="{{url('about')}}">关于</a></li>
					@show
					</ul>
					<a href="#" class="personal pull-left">
						<i class="layui-icon layui-icon-username"></i>
					</a>
				</div>
				<div class="mobile-nav pull-right" id="mobile-nav">
					<a href="javascript:;">
						<i class="layui-icon layui-icon-more"></i>
					</a>
				</div>
			</div>
			<ul class="pop-nav" id="pop-nav" >
				<li><a href="{{url('/')}}">首页</a></li>
				<li><a href="{{url('release')}}">留言</a></li>
				<li><a href="{{url('about')}}">关于</a></li>
			</ul>
		</div>
		@yield('content')
		<div class="footer"> 
			<p>
				<span>版权所有：浙ICP备18021754号</span>
				<span><a href="" target="_blank">www.shongfei.top</a></span> 
			</p>
			<p><span>人生就是一场修行</span></p>
		</div>
	<script src="{{asset('hhome/layui/layui.js')}}"></script>
	<script>
		layui.config({
		  base: '{{asset("hhome/static/js")}}' 
		}).use('/blog');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});	
		@yield('js')
	</script>

</body>
</html>