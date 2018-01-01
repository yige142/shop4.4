<?php
return array(
    //设置模版替换变量
    'TMPL_PARSE_STRING' => array(
        '__EASYUI__'=>__ROOT__.'/Public/Admin/easyui',
        '__CSS__'=>__ROOT__.'/Public/Admin/css',
        '__IMG__'=>__ROOT__.'/Public/Admin/img',
        '__JS__'=>__ROOT__.'/Public/Admin/js',
        '__WEBUPLOADER__'=>__ROOT__.'/Public/webuploader',
        '__EDITOR__'=>__ROOT__.'/Public/kindeditor',
        '__UPLOADIFY__'=>__ROOT__.'/Public/uploadify',
        //uploadify上传图片路径
        'UPLOAD_PATH'=>'./Public/Uploads/'
    ),
);