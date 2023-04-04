<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

if($_SESSION["username"] == 'guest') {
    message('试玩账户不能修改密码！');
    exit;
}

//设置登录密码
if($_GET["action"]=="pass"){
	$oldpass=trim($_POST["oldpass"]);
	$newpass=trim($_POST["newpass"]);
	
    if($oldpass==""){
		message("请输入您的原登录密码");
	}
	if(strlen($newpass)<6 || strlen($newpass)>20){
		message("新登录密码只能是6-20位");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldpass,$newpass,'password')){
		message('登陆密码修改成功','password.php');
	}else{
		message('登陆密码修改失败，请检查您的输入','password.php');
	}
}

//设置取款密码
if($_GET["action"]=="moneypass"){
	$oldmoneypass=trim($_POST["oldmoneypass"]);
    $newmoneypass=trim($_POST["newmoneypass"]);

    if($oldmoneypass==""){
		message("请输入您的原取款密码");
	}
	if(strlen($newmoneypass)!=6){
		message("请输入6位新取款密码");
	}
	
	if(user::update_pwd($_SESSION["uid"],$oldmoneypass,$newmoneypass,'qk_pwd')){
		message('取款密码修改成功','password.php');
	}else{
		message('取款密码修改失败，请检查您的输入','password.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>会员中心</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>会员中心</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../Lottery/gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <form action="?action=pass" method="post" name="form1" onsubmit="return check_submit_login();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td colspan="2" class="tit">修改登录密码</td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">原登录密码：</td>
                        <td>
                            <input name="oldpass" type="password" class="input_150" id="oldpass" maxlength="20"/>
                            <span  class="c_red">*</span>
                            <div id="oldpass_txt" class="c_red"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">新登录密码：</td>
                        <td>
                            <input name="newpass" type="password" class="input_150" id="newpass" maxlength="20"/>
                            <span class="c_red">*</span>
                            <div id="newpass_txt" class="c_red"><em class="c_blue">请输入6-20位新密码</em></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">确认新密码：</td>
                        <td>
                            <input name="newpass2" type="password" class="input_150" id="newpass2" maxlength="20"/>
                            <span class="c_red">*</span>
                            <div id="newpass2_txt" class="c_red"><em class="c_blue">重复输入一次新密码</em></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50"><button name="submit" type="submit" id="submit" class="submit_108">确认修改</button></td>
                    </tr>
                </table>
            </form>
            <form action="?action=moneypass" method="post" name="form1" onsubmit="return check_submit_money();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr>
                        <td colspan="2" class="tit">修改取款密码</td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">原取款密码：</td>
                        <td>
                            <input name="oldmoneypass" type="password" class="input_150" id="oldmoneypass"/>
                            <span  class="c_red">*</span>
                            <div id="oldmoneypass_txt" class="c_red"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">新取款密码：</td>
                        <td>
                            <input name="newmoneypass" type="password" class="input_150" id="newmoneypass"/>
                            <span  class="c_red">*</span>
                            <div id="newmoneypass_txt" class="c_red"><em class="c_blue">请输入6位数字的新密码</em></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50"><button name="submit" type="submit" id="submit" class="submit_108">确认修改</button></td>
                    </tr>
                </table>
            </form>
            <div class="info">
                <p><strong>忘记密码？</strong></p>
                <p>如果您忘记了密码，请与客服联系。</p>
                <p>为了保证会员的资金安全，请您谅解要扫描身份证件验证您的身份。</p>
                <p>也请您放心，您的资料绝对保密，谢谢您对福运来的支持！</p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>