<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
defined('DS')||define('DS',DIRECTORY_SEPARATOR);
defined('PROJECT_ROOT')||define('PROJECT_ROOT',realpath(__DIR__.DS.'..'));
defined('LIBRARY_PATH')||define('LIBRARY_PATH',PROJECT_ROOT.DS.'library');
defined('APPLICATION_NAME')||define('APPLICATION_NAME','Application');
set_include_path(
	implode(PATH_SEPARATOR, array(
		get_include_path(),
		PROJECT_ROOT
	))
);
require __DIR__ . '/../vendor/autoload.php';

$config = new \Simple\Core\Config(PROJECT_ROOT.DS.APPLICATION_NAME.DS.'config'.DS.'application.config.php');
$app = new \Simple\Core\Application($config);
$app->run();

//\Util\RunningTimeTrack::end();
//\Util\MemoryTrack::end();
//
//echo sprintf('用时:%ssec</br>',\Util\RunningTimeTrack::usage());
//echo sprintf('使用内存:%sk</br>',\Util\MemoryTrack::usage()/1024);