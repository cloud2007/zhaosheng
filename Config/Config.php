<?php
session_start();
date_default_timezone_set('PRC');
//全站通用配置文件
//header("Content-Type: text/html; charset=utf-8");
// 报错级别设定,一般在开发环境中用E_ALL,这样能够看到所有错误提示
// 系统正常运行后,直接设定为E_ALL || ~E_NOTICE,取消错误显示
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define( 'BASEDIR', strtr(dirname(__FILE__) . DIRECTORY_SEPARATOR, "\\", '/') );
define( 'ROOT_PATH', realpath(BASEDIR . '../') . DIRECTORY_SEPARATOR );
define( 'LIB_PATH', realpath(BASEDIR . '../Lib') . DIRECTORY_SEPARATOR );
define( 'STATIC_PATH', realpath(BASEDIR . '../Static') . DIRECTORY_SEPARATOR );
define( 'UPLOADS_PATH', realpath(BASEDIR . '../Uploads') . DIRECTORY_SEPARATOR );
define( 'APP_PATH', realpath(BASEDIR . '../App') . DIRECTORY_SEPARATOR );
define( 'ADMIN_PATH', realpath(BASEDIR . '../Admin') . DIRECTORY_SEPARATOR );
?>