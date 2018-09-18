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
							<div class="item-box  layer-photos-demo1 layer-photos-demo">
								<h3><a href="#">{{$articel->title}}</a></h3>
								<h5>发布于：<span>刚刚</span></h5>
								{!!$articel->content!!}
							</div>
							<div class="comment count">
								<a href="#">评论</a>
								<a href="javascript:;" class="like">点赞</a>
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
		<div class="footer">
			<p>
				<span>&copy; 2018</span>
				<span><a href="" target="_blank">www.shongfei.top</a></span> 
			</p>
			<p><span>人生就是一场修行</span></p>
		</div>
@endsection