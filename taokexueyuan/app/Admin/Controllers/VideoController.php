<?php
namespace App\Admin\Controllers;
require app_path().'/Admin/Tools/qiniusdk/autoload.php';
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Controllers\AdminController;
use App\Models\Video;
use App\Models\Special;
use Illuminate\Support\Manager;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Encore\Admin\Widgets\Box;
class VideoController extends Controller{
	use AdminController;
	public function index(){
		return Admin::content(function(Content $content){
			$content->header('视频管理');
			$content->description("视频管理添加修改删除");
			$content->body($this->grid());
		});	
	}	

	public function create(){
		return Admin::content(function(Content $content){
			$content->header("视频上传");
			$content->description("视频淘客助手视频上传");
			$content->body($this->box());
		});
	}

	public function edit($id){
		return Admin::content(function(Content $content) use ($id){
			$content->header("编辑视频");
			$content->description("编辑视频修改上传");
			$content->body($this->form()->edit($id));
		});	
	}

	protected function grid(){
		return Admin::grid(Video::class, function (Grid $grid) {
			$grid->id('ID')->sortable();
			$grid->title("视频标题")->editable();
			$grid->description('视频描述');
			$grid->video_url('视频地址')->file();
			$grid->thumb_pic("封面缩略图")->image();
			$grid->created_at('发布时间');
		});	
	}

	protected function form(){
		return Admin::form(Video::class, function (Form $form) {
            // $form->display('id', 'ID');
            $form->pupload();
            // $form->select('special_id',"专辑分类")->options(Special::all()->pluck('title','id'));
            // $form->text('title','视频标题');
            // $form->text('description','视频描述');
            // $form->file('video_url', '视频文件:')->rules('required')->uniqueName();
            // $form->image('thumb_pic',"封面缩略图")->rules('required')->uniqueName();
            // $form->display('created_at');
            // $form->display('updated_at');
        });

	}

	protected function box(){
		$box = new Box('Box标题', 'Box内容');
		return $box->content($this->form());
	}

	/**
	 * 文件进度条
	 */
	public function token(){
		$accessKey = 'eAsEAzWWpfjojQ2Q7qjF47wc0KNv7ci4Bpu0MIqd';
	    $secretKey = 'OrIsS7zwYjC_XlP2H_4773cVTa7qNDJyUtXUVXL0';
	    $auth = new Auth($accessKey, $secretKey);
	    // 要上传的空间
	    $bucket = 'hezone';
	    // 生成上传 Token
	    $token = $auth->uploadToken($bucket);
	    return ['uptoken'=>$token];
		
	}

}