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
use App\Models\Special;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
class SpecialController extends Controller{
	use AdminController;
	public function index(){
		return Admin::content(function(Content $content){
			$content->header('分类管理');
			$content->description('视频分类添加与管理');
			$content->body($this->grid());
		});
	}


	public function create(){
		return Admin::content(function(Content $content){
			$content->header("分类添加");
			$content->description("分类添加/编辑修改");
			$content->body($this->form());
		});
	}


	public function edit($id){
		return Admin::content(function(Content $content) use ($id){
			$content->header("分类编辑");
			$content->description("分类编辑修改");
			$content->body($this->form()->edit($id));

		});
	}

	protected function grid(){
		return Admin::grid(Special::class,function(Grid $grid){
			$grid->id('分类ID')->sortable();
			$grid->title('专辑名称')->editable();
			$grid->description('专辑描述')->editable();
			$grid->pic('专辑封面')->image();
			$grid->created_at();
		});
	}

	protected function form(){
		return Admin::form(Special::class,function(Form $form){
            $form->special();
			$form->display('id', 'ID');
            $form->hidden('pic');
            $form->text('title','专辑名称');
            $form->text('description','专辑描述');
            $form->display('created_at');
            $form->display('updated_at');
		});
	}

	/**
	 * 文件进度条
	 */
	public function uptoken($id){
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