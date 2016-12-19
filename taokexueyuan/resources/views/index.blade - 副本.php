@extends('layouts.header')
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
				@foreach($v_data as $key=>$value)
					<li>
						<div class="videoimg" style="width:313px;height: 216px;overflow: hidden;">
						<video style="width:100%;height:100%" id="my-player" class="video-js" controls preload="auto" poster="//vjs.zencdn.net/v/oceans.png" data-setup='{}'>
						  <source src="{{asset('http://ohr4sjga6.bkt.clouddn.com/'.$value['video_url'])}}" type="video/mp4"></source>
						  <p class="vjs-no-js">
						    To view this video please enable JavaScript, and consider upgrading to a
						    web browser that
						    <a href="http://videojs.com/html5-video-support/" target="_blank">
						      supports HTML5 video
						    </a>
						  </p>
						</video>
							
						</div>
						<h2><a href="./playpage.html">{{$value['title']}}</a></h2>
						<div class="videoinfro">{{$value['description']}}</div>
						<div class="videotime">
							<p class="fl"><a href="#">共&nbsp;3&nbsp;个视频</a></p>
						 	<p class="fr">02分41秒</p>
						</div>
					</li>
				@endforeach	
				</ul>
		</div><!--vid结束-->
	</div>
@endsection	
