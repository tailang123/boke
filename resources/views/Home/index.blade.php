@extends('Home.public.index')
@section('content')
<div class="container-wrap">
			<div class="container">
					<div class="contar-wrap">
						<center>
							{{ $articels->links() }}
						</center>
						<h4 class="item-title">
							<p><i class="layui-icon layui-icon-speaker"></i>公告：<span>欢迎来到HongFei.Sun的轻博客</span></p>
						</h4>
						@foreach($articels as $articel)
						<div class="item">
							<div class="item-box  layer-photos-demo1 layer-photos-demo" >
								<h3><a href="{{url('detial/'.$articel->id)}}">{{$articel->title}}</a></h3>
								<h5>发布于：<span>{{$articel->created_at}}</span></h5>
								{!!$articel->content!!}
							</div>
							<div class="comment count">
								<a href="{{url('detial/'.$articel->id)}}">评论</a>
								<a href="{{url('detial/'.$articel->id)}}">查看</a>
								<!-- <a href="javascript:;" class="like">点赞</a> -->
							</div>
						</div>
						@endforeach
					</div>
						<center>
							{{ $articels->links() }}
						</center>
					</div>
			</div>
		</div>
		
@endsection