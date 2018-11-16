@extends('Home.public.index')
@section('content')
<div class="container-wrap">
			<div class="container container-message container-details container-comment">
					<div class="contar-wrap">
						<div class="item">
							<div class="item-box  layer-photos-demo1 layer-photos-demo">
								<h3>{{$articel->title}}</h3>
								<h5>发布于：<span>{{$articel->created_at}}</span></h5>
								{!! $articel->content !!}
								<div class="count layui-clear">
									<span class="pull-left">阅读 <em>{{$articel->read}}</em></span>
									<!-- <span class="pull-right like"><i class="layui-icon layui-icon-praise" id="like"></i><em>999</em></span> -->
								</div>
							</div>
						</div>	
						<form class="layui-form" action=""  id="form">
							<div class="layui-form-item layui-form-text">
								<textarea  class="layui-textarea"  style="resize:none" name="content" placeholder="写点什么啊"></textarea>
							</div>
							<div class="btnbox">
									<a href="javascript:;"  id="sure">
							  		确定
							  	</a>
							</div>
						</form>
						<div id="LAY-msg-box">
							@foreach($detial as $detials)
							<div class="info-item">
								<img class="info-img" src="{{asset('t0135402036fe6cee92.jpg')}}" width="85" alt="">
								<div class="info-text">
									<p class="title count">
										<span class="name">匿名用户</span>
										<!-- <span class="info-img like"><i class="layui-icon layui-icon-praise"></i>5.8万</span> -->
									</p>
									<p class="info-intr">{{$detials->content}}</p>
								</div>
							</div>	
							@endforeach
						</div>
					</div>
			</div>
		</div>
@endsection
@section('js')
$('#sure').click(function(){
	$.ajax({
		type:'POST',
		url:'{{"/detial/".$articel->id}}',
		data:$('#form').serialize(),
		dataType:'JSON',
		success:function(data){
			if(data.status == 1){
				layer.msg('评论成功',{icon:1});
				setTimeout(function(){
					location.reload();
				},500);
			}else{
				layer.msg(data.msg,{icon:5});
			}
		}
		
	})
})
$('#like').click(function(){
	$.ajax({
		type:'POST',
		url:'{{url("/detial/".$articel->id."/like")}}',
		dataType:'JSON',
		seccess:function(data){
			if(data.status == 1){
				layer.msg('点赞成功',{icon:1});

			}
		}
	})
})
@endsection