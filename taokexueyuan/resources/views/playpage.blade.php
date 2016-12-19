@extends('layouts.header')	
@section('css')
	<title>视频播放页</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="{{asset('project/css/playpage.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('project/css/resetcom.css')}}">
@endsection

@section('content')
<div id="app-5">
	<div class="video">
		<div class="wth" >

			<div class="list"><i></i>我的位置：<a href="./index.html">首页</a>&nbsp;&gt;&nbsp;Hezone_test</div>
			<p class="title" v-on:clicl="reverseMessage">@{{title}}</p>	
			<a href="javascript:;" class="videomain">
				<video  style="width:100%;height:100%" id="my-player" autoplay="true" class="video-js" controls preload="auto" :poster="play" data-setup='{}' :src="message">
					  <source  :src="message" type="video/mp4"></source>
					  
				</video>

				 <video-player :options="videoOptions"></video-player>
			</a>
			<div class="class-list">
				<h3>课时列表</h3>
				<ul>
				@foreach($video_list as $key=>$value)
					<li>
						<i class="play">
							<em>{{$value['id']}}</em>
						</i>
						<p class="vtitle"><a  v-on:click="reverseMessage('{{$value['video_url']}}','{{$value['title']}}')" href="javascript:;"   class="fontcolor">{{$value['title']}}</a></p>
						<p class="vinfro">{{$value['description']}}</p>
						<span class="playtime">{{date("i:s",round($value['time']))}}</span>
					</li>
				@endforeach	
				</ul>
			</div>
			</div>
		</div>
		<!-- 多说评论框 start -->
		<div class="ds-thread" data-thread-key="请将此处替换成文章在你的站点中的ID" data-title="请替换成文章的标题" data-url="{{url('')}}"></div>
	<!-- 多说评论框 end -->
	<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
	<script type="text/javascript">
	var duoshuoQuery = {short_name:"hedada"};
		(function() {
			var ds = document.createElement('script');
			ds.type = 'text/javascript';ds.async = true;
			ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.unstable.js';
			ds.charset = 'UTF-8';
			(document.getElementsByTagName('head')[0] 
			 || document.getElementsByTagName('body')[0]).appendChild(ds);
		})();
		</script>
	<!-- 多说公共JS代码 end -->
	</div>
	<script type="text/javascript">
		var app5 = new Vue({
		  el: '#app-5',
		  data: {
		    message: 'http://ohr4sjga6.bkt.clouddn.com/{{$video_list[0]['video_url']}}',
		    play:'http://ohr4sjga6.bkt.clouddn.com/{{$video_list[0]['video_url']}}?vframe/jpg/offset/20',
		    title:'{{$video_list[0]['title']}}',
		  },
		  methods: {
		    reverseMessage: function (events,title) {
		      	this.message = "http://ohr4sjga6.bkt.clouddn.com/"+events
		      	this.play = "http://ohr4sjga6.bkt.clouddn.com/"+events+"?vframe/jpg/offset/20"
		      	this.title = title
		    },
		  }
		})
		
	</script>
@endsection	
