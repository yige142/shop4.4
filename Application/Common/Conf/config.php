<?php
return array(
	//'配置项'=>'配置值'
    'MODULE_ALLOW_LIST'     =>  array('Home'),
    //设置可访问目录
    'MODULE_ALLOW_LIST'=>array('Home','Admin'),
    //设置默认目录
    'DEFAULT_MODULE'=>'Home',
    //设置默认主题目录
    'DEFAULT_THEME'=>'Default',
    //数据库配置
    'DB_TYPE'    => 'mysql',         // 数据库类型
    'DB_HOST'    => 'localhost',    // 服务器地址
    'DB_NAME'    => 'shop',      // 数据库名
    'DB_USER'    => 'root',         // 用户名
    'DB_PWD'     => '',             // 密码
    'DB_PORT'    => '3306',        // 端口
    'DB_PREFIX'  => 'shop_',       // 数据库表前缀
    //拒绝强制小写
    'DB_PARAMS'             =>  array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
    'URL_MODEL'             =>  2,
    //下发upload_path开启，上传路径更改为./Public/Uploads/
    //'UPLOAD_PATH'=>'./Public/Uploads/'
    //指定首页加载CSS公告文件路径
    '__PUBLIC__'=>__ROOT__.'/Public'
);