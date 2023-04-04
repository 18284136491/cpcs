<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("cache/website.php");
$lm = 'login';

if($_POST["act"] == "login") {

    $uid = user::login(htmlEncode($_POST["username"]), htmlEncode($_POST["passwd"]));

    if(!$uid) {
        echo '2'; //用户名或密码错误
        exit;
    }
    echo '1'; //成功
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$web_site['web_title']?></title>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="skin/js/form.min.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
	<style type="text/css">
		@media (max-width:1440px){
			body{min-height: 811px}
		}
		@media (max-width:1366px){
			body{min-height: 768px}
			.log_win .log_fot{margin-top: 3em}
		}
		@media (max-width:1280px){
			body{min-height: 711px}
			.log_win .log_fot{margin-top: 0.5em}
		}
		@media (max-width:1024px){
			body{min-height: 675px}
			.log_win .log_frm{width: 37%}
			.log_win .log_fot{margin-top: 3em}
		}
		@media (max-width:768px){
			body{min-height: 929px}
			.log_win{padding-top: 12%}
			.log_win .log_frm{width: 50%}
		}
		@media (max-width:640px){
			.log_win{padding-top: 20%}
			.log_win .log_frm{width: 60%}
		}
		@media (max-width:480px){
			.log_win .log_frm{width: 80%}
		}
		@media (max-width:320px){
			body{min-height: 504px}
			.log_win{padding-top: 10%}
			.log_win .log_frm{width: 90%}
			.log_win .log_frm .m_inp input{width: 62%; padding: 1.2em 2em .5em 2.5em; font-size: 17px}
			.log_win .log_frm .m_inp input.u_name{margin-top: 0.5em}
			.log_win .log_frm .m_inp input.u_pwd{margin-top: 0.5em; margin-bottom: 2em; background: url("newindex/dy/key.png") no-repeat 8px 23px}
			.log_win .log_frm .m_logo{padding-top: 1.1em}
			.log_win .log_frm .top{height: 35px; line-height: 35px}
			.log_win .log_fot{margin-top: 2em}
			.log_win .log_frm .loginBtn{font-size: 28px; padding: 10px 0}
			.kefu{display: none}
		}
	</style>
</head>
<body>
	<div class="log_bg">
		<img src="newindex/dy/log_bg.jpg" width="100%" height="100%">
	</div>
	<div class="log_win">
		<div class="log_frm">
			<form id="loginForm" name="form1" action="#" method="post" onsubmit="return check_login();">
				<div class="top">
					<div class="t_l">快捷登录</div>
					<div class="t_r">
						<a href="/myreg.php">[立即注册]</a>
						<a href="/guest.php" class="test">[免费试玩]</a>
					</div>
				</div>
				<div class="mid">
					<div class="m_logo"><img src="newindex/dy/logo.png"></div>
					<div class="m_inp">
						<input id="username" name="username" type="text" placeholder="用户名" class="u_name">
						<input id="passwd" name="passwd" type="password" placeholder="密码" class="u_pwd">
					</div>
				</div>
				<div class="btm">
					<input type="hidden" name="act" value="login">
                    <input id="loginBtn" type="submit" class="loginBtn" value="立即登录">
				</div>
			</form>
		</div>
		<div class="log_fot">Copyright © <?=date('Y', time())?> 福运来彩票 All rights reserved.</div>
	</div>
	<?php include_once("mykefu.php"); ?>
	<script type="text/javascript">
		function check_login() {
			var frm = $("#loginForm");
			var opt = {
				beforeSubmit: function() {
					if($("#username").val() == "") {
						layer.alert('请输入您的账号！', function(i) {
							$("#username").focus();
							layer.close(i);
						});
						return false;
					}
					if($("#passwd").val() == "") {
						layer.alert('请输入您的密码！', function(i) {
							$("#passwd").focus();
							layer.close(i);
						});
						return false;
					}
					$("#loginBtn").attr("disabled", true);
				},
				success: function(data) {
					if(data.indexOf("3") >= 0) {
						layer.alert('账号异常无法登陆，如有疑问请联系在线客服！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("2") >= 0) {
						layer.alert('账号或密码错误，请重新输入！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("1") >= 0) {
						top.location.href = "/route.php";
					}
				}
			};
			frm.ajaxSubmit(opt);
			return false;
		}
	</script>
</body>
</html>