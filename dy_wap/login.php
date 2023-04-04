<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("include/lottery.inc.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("cache/website.php");

if($_POST["act"] == "login") {
    $uid = user::login(htmlEncode($_POST["username"]), htmlEncode($_POST["passwd"]));
    if(!$uid) {
        echo '2'; //用户名或密码错误
        exit;
    }
    echo '1'; //成功
    exit;
}
$f_class = ' abs';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/form.min.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <script type="text/javascript" src="js/base.js"></script>
</head>
<body>
<div class="container-fluid login">
    <div class="head">
        <a class="f_l" href="javascript:history.back();" style="width: 30px;font-size: 30px"><i class="icon-angle-left"></i></a>
        <a>用户登录</a>
        <a class="f_r" href="/" style="width: 40px;font-size: 25px"><i class="icon-home"></i></a>
    </div>
    <div class="con">
        <form id="loginForm" name="form1" action="#" method="post" onsubmit="return check_login();">
            <ul>
                <li>
                    <input id="username" name="username" type="text" placeholder="账号" class="form-control input-lg inp">
                    <i class="icon-user icon-large form-control-feedback ico"></i>
                </li>
                <li>
                    <input id="passwd" name="passwd" type="password" placeholder="密码" class="form-control input-lg inp">
                    <i class="icon-lock icon-large form-control-feedback ico"></i>
                </li>
                <li>
                    <input type="hidden" name="act" value="login">
                    <input id="loginBtn" type="submit" class="btn btn-danger btn-lg" value="立即登录">
                </li>
                <li>
                    <a class="f_l ft_18" href="/myreg.php">新人注册</a>
                    <a class="f_r ft_18 f_pwd" href="javascript:alert('遗忘密码，请联系客服人员！');">忘记密码？</a>
                </li>
            </ul>
        </form>
    </div>
</div>
<?php include_once("modules/foot.php"); ?>
<script type="text/javascript">
    function check_login() {
        var frm = $("#loginForm");
        var opt = {
            beforeSubmit: function() {
                if($("#username").val() == "") {
                    var e = function() {
                        $("#username").focus();
                    };
                    lay_msg('请输入您的账号！', e);
                    return false;
                }
                if($("#passwd").val() == "") {
                    var e = function() {
                        $("#passwd").focus();
                    };
                    lay_msg('请输入您的密码！', e);
                    return false;
                }
                $("#loginBtn").attr("disabled", true);
            },
            success: function(data) {
                if(data.indexOf("3") >= 0) {
                    var e = function() {
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                    };
                    lay_msg('账号异常无法登陆，如有疑问请联系在线客服！', e);
                } else if(data.indexOf("2") >= 0) {
                    var e = function() {
                        $("#passwd").val("");
                        $("#username").val("").focus();
                        $("#loginBtn").attr("disabled", false);
                    };
                    lay_msg('账号或密码错误，请重新输入！', e);
                } else if(data.indexOf("1") >= 0) {
                    var e = function() {
                        location.replace("/index.php");
                    };
                    lay_msg('登录成功！', e);
                }
            }
        };
        frm.ajaxSubmit(opt);
        return false;
    }
</script>
</body>
</html>