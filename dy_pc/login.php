<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");
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
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="skin/js/form.min.js"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="l_main">
    <div class="w1020">
        <div class="l_con">
            <div class="c_top">
                <div class="c_t1">用户登录</div>
                <div class="c_t2">如果还没有账号请【<a href="/myreg.php">点击注册</a>】</div>
                <form id="loginForm" name="form1" action="#" method="post" onsubmit="return check_login();">
                    <div class="opt p1"><input id="username" name="username" type="text" placeholder="账号"></div>
                    <div class="opt p2"><input id="passwd" name="passwd" type="password" placeholder="密码"></div>
                    <input type="hidden" name="act" value="login">
                    <input id="loginBtn" type="submit" class="loginBtn" value="立即登录">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="m_c1">
        <div class="w1020">
            <div class="c_t1">福运来彩票 - 天天迎财神，期期福运来</div>
            <div class="c_t2"></div>
            <div class="c_list">
                <ul>
                    <li>
                        <div class="ico a1"></div>
                        <div class="text">强大的品牌优势，多年业界运营实际经验，资源丰富</div>
                    </li>
                    <li>
                        <div class="ico a2"></div>
                        <div class="text">信誉卓越，资金保障，多年赔付保证，无任何负面消息，玩家评价优良。</div>
                    </li>
                    <li>
                        <div class="ico a5"></div>
                        <div class="text">24小时全年无休服务，多种支付渠道，存提款处理迅速，业界一流，可亲自体验。</div>
                    </li>
                    <li>
                        <div class="ico a8"></div>
                        <div class="text">专注品牌建设，诚信为先，用心做好与合作伙伴的沟通，致力双赢</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
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