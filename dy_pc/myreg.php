<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/website.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myreg';
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title><?=$web_site['web_title']?></title>
	<script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
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
<div class="main">
    <div class="m_c1">
        <div class="w1020">
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
    <div class="m_c2">
        <div class="w1020">
            <div class="reg">
                <div class="reg_top">
                    <div class="tit">新朋友您好</div>
                    <div class="kf">
                        <a onclick="window.open('fu66666.com','','width=800,height=500');" href="javascript:;">
                            <div class="kf_ico"></div>
                            <div class="kf_text">在线客服</div>
                        </a>
                    </div>
                </div>
                <div>
                    <form id="form1" onsubmit="return regcheck();" action="reg.php" method="post" name="form1">
                        <div class="reg_main">
                            <div class="text">如您已有帐户，立刻在此
                                <a style="color:red;" href="/login.php">登录</a>
                            </div>
                            <div class="opt">
                                <label>用户名：</label>
                                <input id="zcname" name="zcname" type="text" placeholder="请输入6-15位的字母数字下划线组合" size="40" maxlength="15">
                            </div>
                            <div class="opt">
                                <label>密 码：</label>
                                <input id="passwd" name="passwd" type="password" placeholder="请输入至少6位的字母数字组合密码" size="40" maxlength="20">
                            </div>
                            <div class="opt">
                                <label>确认密码：</label>
                                <input id="passwdse" name="passwdse" type="password" placeholder="请再次输入密码" size="40" maxlength="20">
                            </div>
                            <div class="tit">
                                <fieldset>
                                    <legend>个人信息（必填项）</legend>
                                </fieldset>
                            </div>
                            <div class="opt">
                                <label>真实姓名：</label>
                                <input id="realname" name="realname" type="text" placeholder="请输入真实姓名(与银行卡开户姓名相同)" maxlength="10" size="40">
                            </div>
                            <div class="opt">
                                <label>取款密码：</label>
                                <input id="paypasswd" name="paypasswd" type="password" placeholder="请输入6位的数字组合密码" maxlength="6" size="40">
                            </div>
                            <div class="opt">
                                <label>验证码：</label>
                                <input id="vcode" name="vcode" type="text" maxlength="4" value="" style="width: 211px">
                                <img id="zc_img" src="yzm.php" alt="点击刷新" title="点击刷新" style="cursor: pointer; vertical-align: bottom" onclick="change_zc_yzm('zc_img')" />
                            </div>
                            <div class="opt">
                                <label></label>
                                <label style="width: auto; font-size: 16px">我已届满18岁合法博彩年龄﹐且同意各项开户条约。</label>
                            </div>
                            <div class="reg_btn">
                                <input name="regBtn" type="submit" class="btn" value="立即注册">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
<script type="text/javascript">
    function change_zc_yzm(id) {
        $("#" + id).attr("src", "yzm.php?" + Math.random());
        $("#vcode").val("").focus();
        return false;
    }
    function regcheck() {
        var name = $("#zcname");
        if(name.val() == "") {
            layer.tips('请输入用户名！', name, {tips: [2, 'red']});
            name.focus();
            return false;
        }
		var n_reg = /^[a-zA-Z0-9_]{6,15}$/;
		if(!n_reg.test(name.val())) {
			layer.tips('用户名只能为6-15位的字母数字下划线组合！', name, {tips: [2, 'red']});
            name.focus();
            return false;
		}
        var o_pd = $("#passwd");
        if(o_pd.val() == "") {
            layer.tips('请设置密码！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        if(o_pd.val().length < 6) {
            layer.tips('密码至少需要6个字符！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        var n_pd = $("#passwdse");
        if(n_pd.val() != o_pd.val()) {
            layer.tips('两次密码输入不一样！', n_pd, {tips: [2, 'red']});
            n_pd.focus();
            return false;
        }
        var r_name = $("#realname");
        if(r_name.val() == "") {
            layer.tips('请输入您的真实姓名，需要与银行卡开户人一样！', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            layer.tips('请输入正确姓名，需要和银行开户人一样', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var p_pd = $("#paypasswd");
        var p_reg = /^\d{6}$/;
        if(p_pd.val() == "") {
            layer.tips('请设置取款密码！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
        if(!p_reg.test(p_pd.val())) {
            layer.tips('取款密码只能为6个数字！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
        var code = $("#vcode");
        if(code.val() == "") {
            layer.tips('请输入验证码！', code, {tips: [2, 'red']});
            code.focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>