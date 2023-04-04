<?php
include_once("include/lottery.inc.php");
include_once("cache/website.php");
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
<div class="container-fluid reg">
    <div class="head">
        <a class="f_l" href="javascript:history.back();" style="width: 30px;font-size: 30px"><i class="icon-angle-left"></i></a>
        <a>账号注册</a>
        <a class="f_r" href="/" style="width: 40px;font-size: 25px"><i class="icon-home"></i></a>
    </div>
    <div class="con">
        <form id="form1" onsubmit="return regcheck();" action="reg.php" method="post" name="form1">
            <ul>
                <li><input id="zcname" name="zcname" type="text" placeholder="用户名(6-15位字符)" maxlength="15" class="form-control input-lg"></li>
                <li><input id="passwd" name="passwd" type="password" placeholder="密码" maxlength="20" class="form-control input-lg"></li>
                <li><input id="passwdse" name="passwdse" type="password" placeholder="再次输入密码" maxlength="20" class="form-control input-lg"></li>
                <li><input id="realname" name="realname" type="text" placeholder="真实姓名(与银行卡开户人相同)" maxlength="10" class="form-control input-lg"></li>
                <li><input id="paypasswd" name="paypasswd" type="password" placeholder="提款密码(6位纯数字)" maxlength="6" class="form-control input-lg"></li>
                <li><input name="regBtn" type="submit" class="btn btn-danger btn-lg" value="立即注册"></li>
                <li><a href="/login.php" class="btn btn-danger btn-lg">已有账号，登陆！</a></li>
                <li class="f_pwd">
                    <strong>注意：</strong>
                    <p>1、提款密码必须为6位数的数字；</p>
                    <p>2、姓名必须与你用于提款的银行户口名字一致，否则无法提款。</p>
                </li>
            </ul>
        </form>
    </div>
</div>
<?php include_once("modules/foot.php"); ?>
<script type="text/javascript">
    function regcheck() {
        var name = $("#zcname");
        if(name.val() == "") {
            var e = function() {
                name.focus();
            };
            lay_msg('请输入用户名！', e);
            return false;
        }
		var n_reg = /^[a-zA-Z0-9_]{6,15}$/;
		if(!n_reg.test(name.val())) {
			var e = function() {
                name.focus();
            };
            lay_msg('用户名只能为6-15位的字母数字下划线组合！', e);
            return false;
		}
        var o_pd = $("#passwd");
        if(o_pd.val() == "") {
            var e = function() {
                o_pd.focus();
            };
            lay_msg('请设置密码！', e);
            return false;
        }
        if(o_pd.val().length < 6) {
            var e = function() {
                o_pd.focus();
            };
            lay_msg('密码至少需要6个字符！', e);
            return false;
        }
        var n_pd = $("#passwdse");
        if(n_pd.val() != o_pd.val()) {
            var e = function() {
                n_pd.focus();
            };
            lay_msg('两次密码输入不一样！', e);
            return false;
        }
        var r_name = $("#realname");
        if(r_name.val() == "") {
            var e = function() {
                r_name.focus();
            };
            lay_msg('请输入您的真实姓名！', e);
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            var e = function() {
                r_name.focus();
            };
            lay_msg('请输入正确的姓名！', e);
            return false;
        }
        var p_pd = $("#paypasswd");
        var p_reg = /^\d{6}$/;
        if(p_pd.val() == "") {
            var e = function() {
                p_pd.focus();
            };
            lay_msg('请设置提款密码！', e);
            return false;
        }
        if(!p_reg.test(p_pd.val())) {
            var e = function() {
                p_pd.focus();
            };
            lay_msg('提款密码只能为6个数字！', e);
            return false;
        }
        return true;
    }
</script>
</body>
</html>