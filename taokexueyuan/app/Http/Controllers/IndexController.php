<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Special;
use Illuminate\Http\Request;
//use Illuminate\Pagination\Paginator;
use Cache;
use Session;
class IndexController extends Controller{
	public function index(Special $special){
		$specials = $this->GetDuration( $special->all());
		return view('index',compact("specials"));
	}

	/**
	 * 播放页面
	 */
	public function play($id){
		$video_list = Video::where('special_id',$id)->get();
		if(!$video_list->isEmpty()){
			$video_list = Video::where('id',$id)->first();
			$video_list = Video::where('special_id',$video_list->special_id)->get();
		}else{
			return '云端视频未找到！可能已经删除 <a href="'.url('/').'">点击返回首页</a>';
		}
		
		foreach ($video_list as $key => $value) {
			$json = json_decode($this->video_time($value['video_url']),true);
			if(isset($json['error']) && $json['error'] == 'Document not found'){
				return '云端视频未找到！可能已经删除 <a href="'.url('/').'">点击返回首页</a>';
			}
			$video_list[$key]['time'] = $json['streams'][0]['duration'];
		}
		return view('playpage',compact('video_list'));
	}

	/**
	 * 搜索页面
	 */
	public function search(Request $request){
		$key = $request->input('key');
		//组合专辑和单个视频
		$arr = [];
		$special['class'] = Special::where('description','like','%'.$key.'%')->orWhere('title','like','%'.$key.'%')->get()->toArray();
		$special['video'] = Video::where('description','like','%'.$key.'%')->orWhere('title','like','%'.$key.'%')->get()->toArray();
		$special = $this->Unrepeat($special);
		return view('searchpage',compact('special'));
	}

	/**
	 * 七牛获取视频元信息
	 *@param str $file_name 七牛视频路径
	 */
	protected function video_time($file_name){
		$re = curl_init();
		curl_setopt($re,CURLOPT_URL,"http://ohr4sjga6.bkt.clouddn.com/".$file_name."?avinfo");
		curl_setopt($re,CURLOPT_RETURNTRANSFER,true);
		$res = curl_exec($re);
		curl_close($re);
		return $res;
	}

	protected function GetDuration($special){
		//获取专辑  ?vframe/jpg/offset/20获得缩略图
		$arr = [];
		foreach ($special as $key => $value) {
			$Video = Video::where('special_id',$value['id'])->get();
			if ($Video->count()) {
				foreach ($Video as $k => $v) {
					$arr[$value['id']] = $value;
					$arr[$value['id']]['count'] = $Video->count();
					$json = json_decode($this->video_time($v['video_url']),true);
					if(!isset($json['error'])){
						$arr[$value['id']]['duration'] += $json['streams'][0]['duration'];
					}
					
					
				}	
			}
			
		}
		return $arr;
	}

	protected function SDuration($special){
		//获取专辑  ?vframe/jpg/offset/20获得缩略图
		$arr = [];
		foreach ($special as $key => $value) {
			$Video = Video::where('special_id',$value['id'])->get();
			if ($Video->count()) {
				foreach ($Video as $k => $v) {
					$arr[$value['id']] = $value;
					$arr[$value['id']]['count'] = $Video->count();
					$json = json_decode($this->video_time($v['video_url']),true);
					$arr[$value['id']]['duration'] = $json['streams'][0]['duration'];
				}	
			}
			
		}
		return $arr;
	}
 
	protected function Unrepeat($special){
		$arr = [];
		foreach ($special as $key => $value) {
			foreach ($special['class'] as $k => $v) {
				$arr[$v['id']] = $v;
				$arr[$v['id']]['count'] = Video::where('special_id',$v)->count();
				$grop = $this->SDuration($special['class']);

			}
			foreach ($special['video'] as $k => $v) {
				$arr[$v['id']] = $v;
				$tmp_time = json_decode($this->video_time($v['video_url']),true);
				$arr[$v['id']]['time'] = $tmp_time['streams'][0]['duration'];
			}
			
		}
		return $arr;
	}

	/**
	 * 数组手动分页
	 */
	protected function page(){
		function userList(Request $request) {
		  $users = [
		    ['username'=>'zhangsan', 'age'=>26],
		    ['username'=>'lisi', 'age'=>23],
		    ['username'=>'wangwu', 'age'=>62],
		    ['username'=>'zhaoliu', 'age'=>46],
		    ['username'=>'wangmazi', 'age'=>25],
		    ['username'=>'lanzi', 'age'=>24],
		    ['username'=>'pangzi', 'age'=>21]
		  ];
		  $perPage = 3;
		  if ($request->has('page')) {
		      $current_page = $request->input('page');
		      $current_page = $current_page <= 0 ? 1 :$current_page;
		  } else {
		      $current_page = 1;
		  }
		  $item = array_slice($users, ($current_page-1)*$perPage, $perPage); //注释1
		  $total = count($users);
		  $paginator =new LengthAwarePaginator($item, $total, $perPage, $currentPage, [
		      'path' => Paginator::resolveCurrentPath(), //注释2
		      'pageName' => 'page',
		  ]);
		  $userlist = $paginator->toArray()['data'];
		  return view('userlist', compact('userlist', 'paginator'));
		}
	}
	
}