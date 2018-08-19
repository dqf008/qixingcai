
<?php

// define('APP_DEBUG',True); // 开启调试模式
// define('APP_PATH','./Application/');
// define('THINK_PATH',realpath('./ThinkPHP').'/');
// require THINK_PATH.'ThinkPHP.php';
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
session_start();

// 应用入口文件
	header('content-type:text/html;charset=utf-8');
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

 // 关闭调试模式
 define('APP_DEBUG',True);


// 定义应用目录
define('APP_PATH','./App/');
define('BIND_MODULE', 'Home');

// 引入ThinkPHP入口文件
require 'ThinkPHP/ThinkPHP.php';

