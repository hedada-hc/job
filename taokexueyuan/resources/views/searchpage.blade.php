@extends('layouts.header')	
@section('css')
	<title>视频搜索结果页</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{asset('project/css/searchpage.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('project/css/resetcom.css')}}">
	<script src="{{asset('project/js/jquery-1.10.1.min.js')}}"></script>
	<script src="{{asset('project/js/common.js')}}"></script>
@endsection

@section('content')

	<div class="searchresults clearfix">
		<div class="main wth clearfix">
			<div class="title">
				<p>课程</p>
			</div>
			<div class="searchinfro fl">
				<ul>
			@foreach($special as $key=>$value)		
				@if(!isset($value['video_url']))	
					<li class="videotitle clearfix">
						<a href="{{url('/play/'.$value['id'])}}"><img src="{{asset('project/images/classa.png')}}" alt="淘客学院"></a>
						<div class="videoinfro fl">
							<p><a href="{{url('/play/'.$value['id'])}}">{{$value['title']}}</a></p>
							<p>{{$value['description']}}</p>
							<div class="playinfro">
								<span class="icon1"><i></i>{{$value['count']}}课时</span>
								<span class="icon2"><i></i>共32分钟</span>
							</div>
						</div>
					</li>
				@else	
					<li class="video2">
						<span class="playlist">
							<em>2</em>
						</span>
						<p><a href="{{url('/play/'.$value['id'])}}">{{$value['title']}}</a></p>
						<span clss="videotime">{{date("i分s秒",round($value['time']))}}</span>
						<p>{{$value['description']}}</p>
					</li>
				@endif	
			@endforeach		
				</ul>
			</div>
			<div class="prompt fl">
				<p>抱歉，未找到相关课程</p>
			</div>
			<div class="recommend fl">
				<p>热门课程</p>
				<ul>
					<li><a href="#">快速上手淘客助手插件</a></li>
					<li><a href="#">如何设置PID</a></li>
					<li><a href="#">巧用淘客助手插件生成推广链接</a></li>
					<li><a href="#">快速上手淘客助手插件</a></li>
				</ul>
			</div>	
		</div>
	</div>
@endsection