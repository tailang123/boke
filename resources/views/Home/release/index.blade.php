@extends('Home.public.index')
@section('navigation')
	<li class="layui-nav-item "><a href="{{url('/')}}">首页</a></li>
	<li class="layui-nav-item layui-this"><a href="{{url('release')}}">留言</a></li>
	<li class="layui-nav-item"><a href="{{url('about')}}">关于</a></li>
@endsection
@section('content')
		<div class="container-wrap">
			<div class="container container-message">
				<div class="contar-wrap" id="contar-wrap">
					<form class="layui-form" action="" id="uForm">
						<div class="layui-form-item layui-form-text">
							  <textarea  class="layui-textarea" id="LAY-msg-content" style="resize:none" name="text"></textarea>
						</div>
					</form>
					<div class="item-btn">
						<button class="layui-btn layui-btn-normal" id="item-btn">提交</button>
					</div>
					@foreach($releases as $release)
					<div id="LAY-msg-box">
						<div class="info-box">
							<div class="info-item">
								<img class="info-img" src="{{asset('t0135402036fe6cee92.jpg')}}" width="85" alt="">
								<div class="info-text">
									<p class="title count">
										<span class="name">匿名：A{{$release->id}}&nbsp;&nbsp;&nbsp;</span>
										<span class="name">{{$release->created_at}}</span>
										<span class="info-img like"><i class="layui-icon layui-icon-praise"></i>{{$release->like}}</span>
									</p>
									<p class="info-intr">{{$release->text}}</p>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					

					<!-- 分页 -->
				</div>
			</div>
		</div>
@endsection
@section('js')
	$(function(){
		$('#item-btn').click(function(){
			$.ajax({
				type:'POST',
				url:'{{url("/")}}',
				data:$('#uForm').serialize(),
				dateType:'json',
				success:function(data){
					if(data.status == 1){
						layer.msg(data.msg,{icon:1});
						setTimeout(function(){
							location.href="{{url('/release')}}"
						},1000);
					}else{
						layer.msg(data.msg,{icon:5});
					}
				}
			})
		});
	});
@endsection