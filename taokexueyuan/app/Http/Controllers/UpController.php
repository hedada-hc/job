<?php
namespace App\Http\Controllers;
require app_path().'/Tools/qiniusdk/autoload.php';
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
class UpController extends Controller{
	public function index(){
	   
		return view("admin/up");
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