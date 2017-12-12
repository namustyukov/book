<?php

if (preg_match ("/www/i", $_SERVER['HTTP_HOST']))
{
	$str=str_replace('www.', '', $_SERVER['HTTP_HOST']);
	header("HTTP/1.1 301 Moved Permanently");
	header ('Location: http://'.$str.$_SERVER['REQUEST_URI']);
	die();
}

// this contains the application parameters that can be maintained via GUI
return array(
	'adminEmail'=>'bookone@mail.ru',
	'dateFormat'=>'d.m.Y',
);
