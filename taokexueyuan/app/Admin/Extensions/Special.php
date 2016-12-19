<?php
namespace App\Admin\Extensions;
use Encore\Admin\Form\Field;
class Special extends Field{
	protected $view = 'admin.special';

    protected static $css = [
        '/packages/admin/jssdk/demo/styles/main.css',
        '/packages/admin/jssdk/demo/styles/highlight.css',
    ];

    protected static $js = [
        //'/packages/admin/jssdk/bootstrap.min.js',
        '/packages/admin/jssdk/moxie.js',
        '/packages/admin/jssdk/plupload.js',
        '/packages/admin/jssdk/plupload.dev.js',
        '/packages/admin/jssdk/zh_CN.js',
        '/packages/admin/jssdk/demo/scripts/ui.js',
        '/packages/admin/jssdk/src/qiniu.js',
        '/packages/admin/jssdk/demo/scripts/multiple.js',
        '/packages/admin/jssdk/demo/scripts/highlight.js',
        '/packages/admin/jssdk/demo/scripts/main.js',
        
    ];

    public function render()
    {
        
//         $this->script = <<<EOT
// CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
//     lineNumbers: true,
//     mode: "text/x-php",
//     extraKeys: {
//         "Tab": function(cm){
//             cm.replaceSelection("    " , "end");
//         }
//      }
// });
// EOT;
        return parent::render();

    }
}