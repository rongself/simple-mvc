<?php
error_reporting(E_ALL);
ini_set('display_errors','on');
defined('APPLICATION_ROOT')||define('PROJECT_ROOT',realpath(__DIR__.'/..'));
defined('LIBRARY_PATH')||define('LIBRARY_PATH',PROJECT_ROOT.'/library');
set_include_path(
	implode(PATH_SEPARATOR, array(
		get_include_path(),
		PROJECT_ROOT,
		realpath(LIBRARY_PATH)
	))
);

spl_autoload_register(function($className){
	include str_replace('\\',DIRECTORY_SEPARATOR,$className).'.php';
});

\Util\MemoryTrack::start();
\Util\RunningTimeTrack::start();

$config = new \Core\Config(PROJECT_ROOT.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'application.config.php');
\Core\Application::run($config);

\Util\RunningTimeTrack::end();
\Util\MemoryTrack::end();

echo sprintf('用时:%ssec</br>',\Util\RunningTimeTrack::usage());
echo sprintf('使用内存:%sk</br>',\Util\MemoryTrack::usage()/1024);