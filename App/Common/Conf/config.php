<?php
return array(
    'DB_TYPE'               =>  'mysql',     // 数据库类型
//    'DB_HOST'               =>  'rm-wz9lwt0u9750jhf9jio.mysql.rds.aliyuncs.com', // 服务器地址
    'DB_HOST'               =>  '127.0.0.1',
    'DB_NAME'               =>  'qxc',   // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'zL4g%GDxGFYTn1]',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'k_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
        //设置左右边界符
    'TMPL_L_DELIM'=>'<{',
    'TMPL_R_DELIM'=>'}>',
   'URL_HTML_SUFFIX'=>'',              //URL伪静态
  // 'SHOW_PAGE_TRACE' =>true, //trace调试信息
   'URL_MODEL' =>2,
   // 'TMPL_EXCEPTION_FILE'   => 'App/Home/View/Public/404.html',
   // 'URL_HTML_SUFFIX'=>'html',
    //权限配置
  //   'AUTH_CONFIG' => array(
  //   'AUTH_ON' => true, //认证开关
  //   'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
  //   'AUTH_GROUP' => 'dsp_auth_group', //用户组数据表名
  //   'AUTH_GROUP_ACCESS' => 'dsp_auth_group_access', //用户组明细表
  //   'AUTH_RULE' => 'dsp_auth_rule', //权限规则表
  //   'AUTH_USER' => 'dsp_consumer'//用户信息表
  // ),

);
