<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

unset($mysqlio);
$mysqlio = new MySQLi("mysql","root","root","dy3_db");
$mysqlio->query("set names utf8");
?>