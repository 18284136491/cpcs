<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
//手机目录
$m_file='E:/webRoot/yl_wap/';
unset($mysqli);
$mysqli	=	new MySQLi("mysql","root","root","dy1_db");
$mysqli->query("set names utf8");
?>