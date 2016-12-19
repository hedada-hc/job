<!DOCTYPE html>
<html>
<head>
	
	@yield('css')	
	<link href="{{asset('project/css/video-js.min.css')}}" rel="stylesheet">
	<script src="{{asset('project/js/video.min.js')}}"></script>
	<script src="{{asset('project/js/vue.js')}}"></script>


	<!--[if (gte IE 6)&(lte IE 8)]>
      <script type="text/javascript" src="js/selectivizr.js"></script>
	<![endif]--> 
</head>
<body>
	<div class="head wth clearfix">
		<h1 class="head_left fl"><a href="{{url('/')}}"><img src="{{asset('project/images/logo.png')}}" alt="淘客助手"></a></h1>
		<div class="head_search fl">
		<form method="get" action="{{url('/search')}}">
			<input type="text" class="search_text fl" name="key" placeholder="搜索课程或关键词">
			<input type="submit" value="搜 索"  class="search_btn fl">
		</form>	
			</div>
		<div class="head_right fr"><a href="#">登录</a>|<a href="#">注册</a></div>	
	</div>


@yield('content')

	<div class="foot">
		<div class="foot1 wth clearfix">
			<ul>
			<li><img src="{{asset('project/images/erweima.png')}}" alt="二维码"></li>
			<li>帮助中心
				<ul><li><a href="#">淘宝助手安装指南</a></li></ul>
			</li>
			<li>常见问题
				<ul>
					<li><a href="#">招商规则</a></li>
					<li><a href="#">违规商家处罚</a></li>
					<li><a href="#">商家如何报名</a></li>
				</ul>
			</li>
			<li>投诉意见
				<ul>
					<li><a href="#">招商违规投诉</a></li>
					<li><a href="#">应用建议</a></li>
				</ul>
			</li>
			<li>关于我们
				<ul>
					<li><a href="#">关于我们</a></li>
					<li><a href="#">联系我们</a></li>
				</ul>
			</li>
			<li class="images_ft02"></li>
			</ul>
		</div>
		<div class="foot2">
			<div class="foot2_image wth">
				<ul>
					<li class="imageone"></li>
					<li class="imagetwo"></li>
					<li class="imagethree"></li>
					<a href="#"><li class="install"></li></a>	
				</ul>	
			</div>
		</div>
	</div><!--foot结束-->
</body>
</html>	