<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
defined('PROJECT_ROOT')||define('PROJECT_ROOT',realpath(__DIR__.'/..'));
defined('LIBRARY_PATH')||define('LIBRARY_PATH',PROJECT_ROOT.'/library');
defined('DS')||define('DS',DIRECTORY_SEPARATOR);
set_include_path(
	implode(PATH_SEPARATOR, array(
		get_include_path(),
		PROJECT_ROOT
	))
);
require __DIR__ . '/../vendor/autoload.php';

$config = new \Simple\Core\Config(PROJECT_ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'application.config.php');
$app = new \Simple\Core\Application($config);
$app->run();

//\Util\RunningTimeTrack::end();
//\Util\MemoryTrack::end();
//
//echo sprintf('用时:%ssec</br>',\Util\RunningTimeTrack::usage());
//echo sprintf('使用内存:%sk</br>',\Util\MemoryTrack::usage()/1024);