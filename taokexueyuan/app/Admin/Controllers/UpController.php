<?php
namespace App\Admin\Controllers;
require app_path().'/Admin/Tools/qiniusdk/autoload.php';
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\Video;
use App\Models\Special;

class UpController extends Controller{
	use AdminController;

	public function index(){
		return Admin::content(function(Content $content){
			$content->header('视频管理');
			$content->description("视频管理添加修改删除");
			$content->body($this->grid());
		});	
	}

	protected function grid(){
		return Admin::grid(Video::class, function (Grid $grid) {
			$grid->id('ID')->sortable();
			$grid->title("视频标题")->editable();
			$grid->description('视频描述');
			$grid->video_url('视频地址')->file();
			$grid->display('视频缩略图')->image();
			$grid->created_at('发布时间');
		});	
	}
		
	protected function form(){
		return Admin::form(Video::class, function (Form $form) {
	            $form->pupload();
	            $form->select('special_id',"专辑分类")->options(Special::all()->pluck('title','id'));
	            $form->text('title','视频标题');
	            $form->text('description','视频描述');
	            $form->hidden('video_url')->value('test');
	            $form->display('created_at');
	            $form->display('updated_at');
	        });
		}	

	public function create(){
		return Admin::content(function(Content $content){
			$content->header("视频上传");
			$content->description("视频淘客助手视频上传");
			$content->body($this->form());
		});
	}

	public function edit($id){
		return Admin::content(function(Content $content) use ($id){
			$content->header("编辑视频");
			$content->description("编辑视频修改上传");
			$content->body($this->form()->edit($id));
		});	
	}

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