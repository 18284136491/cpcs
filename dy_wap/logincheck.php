<?php
session_start();
header("Content-type: text/html; charset=utf-8");
if(@$_POST["action"]=="login"){
	$yzm	=	strtolower($_POST["vlcodes"]);
	if($yzm!=	$_SESSION["randcode"]){
		echo '1'; //验证码错误
		exit;
	}
	$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
	
	include_once("include/mysqli.php");
	include_once("class/user.php");
	include_once("common/function.php");
    $uid	=	user::login(htmlEncode($_POST["username"]),htmlEncode($_POST["password"]));
	
    if(!$uid){
		echo '2'; //用户名称或密码错误
		exit;
	}
	user::is_daili($uid);
	echo '4'; //成功
	exit;
}
echo '1'; //验证码错误
exit;
?>