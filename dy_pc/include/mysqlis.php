<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

unset($mysqlis);
$mysqlis = new MySQLi("mysql","root","root","dy4_db");
$mysqlis->query("set names utf8");
?>