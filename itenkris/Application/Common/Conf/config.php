<?php
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST' => 'Home,Admin',  //项目分组设定
	'DEFAULT_GROUP'  => 'Admin',       //默认分组
	//配置样式和图片的路径
	'TMPL_PARSE_STRING'  =>array(     
	    '__ACSS__' => '/Public/Admin/Styles',     
		'__AIMG__' => '/Public/Admin/Images', 
		'__AJS__'  => '/Public/Admin/Js',
		'__HCSS__' => '/Public/Home/css',     
		'__HIMG__' => '/Public/Home/img', 
		'__HJS__'  => '/Public/Home/js',
		'__UPLOAD__'  => '/Public/Uploads',
    ),
	'DEFAULT_FILTER'        =>  'trim,htmlspecialchars', // 去掉输入空格
	 
	/* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型mysql mysqli pdo
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'itenkris',    // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => '',          // 密码
    'DB_PORT'               => '3306',      // 端口
	'DB_PREFIX'             => '',          // 数据库表前缀
	/*
    //图片相关配置
	'IMAGE_CONFIG' => array(
	    'maxSize' => 1024*1024,
		//设置附件上传类型
		'exts' => array('jpg', 'gif', 'png', 'jpeg'),
		//上传图片的路径--php要使用的路径,硬盘上的路径
		'rootPath' =>  './Public/Uploads/',
		//显示图片时的路径--浏览器用的路径,相对网站根目录
		'viewPath' =>  '/Public/Uploads/'
	),
	*/
);
?>