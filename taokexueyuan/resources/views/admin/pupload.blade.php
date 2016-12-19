    <div class="container" style="padding-top: 60px;">
        <ul class="nav nav-tabs" role="tablist">

        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="demo" aria-labelledby="demo-tab">

                <div class="row" style="margin-top: 20px;">
                    <input type="hidden" id="domain" value="http://ohr4sjga6.bkt.clouddn.com/">
                    <input type="hidden" id="uptoken_url" class="video_url"  value="uptoken/1">
                    <ul class="tip col-md-12 text-mute">
                       
                        <li>
                            <small>本示例限制最大上传文件1000M。</small>
                        </li>
                    </ul>
                    <div class="col-md-12">
                        <div id="container">
                            <a class="btn btn-default btn-lg" style="width:100%;height:50px" id="pickfiles" href="#" >
                            
                                <i class="glyphicon glyphicon-cloud-upload"></i>
                                <span>请把文件拖放在这里</span>
                            </a>
                        </div>
                    </div>
                    <div style="display:none" id="success" class="col-md-12">
                        <div class="alert-success">
                            队列全部文件处理完毕
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <table class="table table-striped table-hover text-left"   style="margin-top:40px;display:none">
                            <thead>
                              <tr>
                                <th class="col-md-4">文件名</th>
                                <th class="col-md-2">文件大小</th>
                                <th class="col-md-6">上传进度</th>
                              </tr>
                            </thead>
                            <tbody id="fsUploadProgress">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="code" aria-labelledby="code-tab">

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <pre><code>

                        <script type="text/javascript">
                      
                        //引入Plupload 、qiniu.js后
                       // that.uptoken_url
                        var uploader = Qiniu.uploader({
                            runtimes: 'html5,flash,html4',    //上传模式,依次退化
                            browse_button: 'pickfiles',       //上传选择的点选按钮，**必需**
                            uptoken_url: 'http://xueyuan.com/uptoken',            //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
                            // uptoken : '<Your upload token>', //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
                            unique_names:true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
                            // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
                            domain: 'http://ohr4sjga6.bkt.clouddn.com/',   //bucket 域名，下载资源时用到，**必需**
                            get_new_uptoken: false,  //设置上传文件的时候是否每次都重新获取新的token
                            container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
                            max_file_size: '1000mb',           //最大文件体积限制
                            //flash_swf_url: 'js/plupload/Moxie.swf',  //引入flash,相对路径
                            max_retries: 3,                   //上传失败最大重试次数
                            dragdrop: true,                   //开启可拖曳上传
                            drop_element: 'container',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                            chunk_size: '4mb',                //分块上传时，每片的体积
                            auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
                            init: {
                                'FilesAdded': function(up, files) {
                                    plupload.each(files, function(file) {
                                        // 文件添加进队列后,处理相关的事情
                                        console.log(files);

                                    });
                                },
                                'BeforeUpload': function(up, file) {
                                       // 每个文件上传前,处理相关的事情
                                },
                                'UploadProgress': function(up, file) {
                                       // 每个文件上传时,处理相关的事情
                                },
                                'FileUploaded': function(up, file, info) {
                                       // 每个文件上传成功后,处理相关的事情
                                       // 其中 info 是文件上传成功后，服务端返回的json，形式如
                                       // {
                                       //    "hash": "Fh8xVqod2MQ1mocfI4S4KpRL6D98",
                                       //    "key": "gogopher.jpg"
                                       //  }
                                       // 参考http://developer.qiniu.com/docs/v6/api/overview/up/response/simple-response.html
                                       alert('上传成功！');
                                       var domain = up.getOption('domain');
                                       var res = parseJSON(info);
                                       var sourceLink = domain + res.key; //获取上传成功后的文件的Url
                                       console.log(res);
                                       console.log("文件上传成功！");
                                },
                                // 'Error': function(up, err, errTip) {
                                //        //上传出错时,处理相关的事情
                                // },
                                // 'UploadComplete': function() {
                                //        //队列文件处理完毕后,处理相关的事情
                                // },
                                // 'Key': function(up, file) {
                                //     // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                                //     // 该配置必须要在 unique_names: false , save_key: false 时才生效

                                //     var key = "";
                                //     // do something with key here
                                //     return key
                                // }
                            }
                        });


                        
                        // domain 为七牛空间（bucket)对应的域名，选择某个空间后，可通过"空间设置->基本设置->域名设置"查看获取

                        // uploader 为一个plupload对象，继承了所有plupload的方法，参考http://plupload.com/docs
                        </script>

                        <script type="text/javascript">
                            $(function(){
                                   setInterval(function(){
                                    data = $('.upfile').attr('href')
                                        $('[name="pic"]').val(data)
                                    },1000) 
                            })
                        </script>
                        </code></pre>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="log" aria-labelledby="log-tab">
                <pre id="qiniu-js-sdk-log"></pre>
            </div>
        </div>
    </div>
