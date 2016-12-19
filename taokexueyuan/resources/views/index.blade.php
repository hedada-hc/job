@extends('layouts.header')
@section('css')
<title>淘客学院首页</title>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="{{asset('project/css/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('project/css/resetcom.css')}}">
<script src="{{asset('project/js/jquery-1.10.1.min.js')}}"></script>
<script src="{{asset('project/js/common.js')}}"></script>



@endsection
@section('content')
	<div class="banner">
		<div class="image wth">
			<img src="{{asset('project/images/main.png')}}">
			<div class="tit">
				<h1>淘客学院</h1>
				<h2>专业的淘客学习网站，全方位视频教程学习</h2>
				<h2>专业的淘客学习网</h2>
			</div>
		</div>
	</div>
	<div class="video clearfix">
		<div class="wth">
			<div class="title">淘客助手学院，多套教程帮你快速上手折扣搜索ABC</div>
				<ul>
				@foreach($specials as $key=>$value)
					<li>
						<div class="videoimg">
							<img src="{{'http://ohr4sjga6.bkt.clouddn.com/'.$value['pic']}}">
							<a href="{{url('/play/'.$value['id'])}}">
								<div class="transfrom">
									<img src="{{asset('project/images/click.png')}}">
									<div class="fnt">{{$value['title']}}</div>
								</div>
							</a>
						</div>
						<h2><a href="./playpage.html">{{$value['title']}}</a></h2>
						<div class="videoinfro">{{$value['description']}}</div>
						<div class="videotime">
							<p class="fl"><a href="#">共&nbsp;{{$value['count']}}&nbsp;个视频</a></p>
						 	<p class="fr">{{date("i分s秒",round($value['duration']))}}</p>
						</div>
					</li>
				@endforeach	
				</ul>
		</div><!--vid结束-->
	</div>
<script type="text/javascript">
	
</script>	
@endsection	
