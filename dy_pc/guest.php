<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");

$lm = 'guest';
$username = 'guest';
$password = 'guest+123456';
$uid = user::login(htmlEncode($username), htmlEncode($password));
if(!$uid) {
    message("试玩账号异常，请联系在线客服处理！", "/");
}
echo '<script>location.replace("/route.php");</script>';
?>