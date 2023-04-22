<?php
spl_autoload_register('autoloader');

function autoloader($class)
{
$url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if(strpos($url,'includes')!==false)
{
	$path='../../classes/';
}
else
{
	$path='../classes/';
	$extension='.class.php';
}
$fullpath = $path.$class.$extension;
require_once $fullpath; 
}