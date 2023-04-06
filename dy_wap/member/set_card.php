<?php
session_start();
include_once("../include/config.php"); 
include("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

//设置银行卡信息
if($_GET["action"]=="save"){
	$pay_card=htmlEncode($_POST["pay_card"]);
	$pay_num=htmlEncode($_POST["pay_num"]);
	$pay_address=htmlEncode($_POST["pay_address"]);
	$vlcodes=$_POST["vlcodes"];
	
	if($vlcodes!=$_SESSION["randcode"]){   
		message("验证码错误，请重新输入");
	}
	$_SESSION["randcode"]=rand(10000,99999); //更换一下验证码
    if($pay_card==""){
		message("请输入您的收款银行");
	}
	if($pay_num==""){
		message("请输入您正确的银行账号");
	}
	if($pay_address==""){
		message("请输入您的开户行地址");
	}
	
	if(user::update_paycard($_SESSION["uid"],$pay_card,$pay_num,$pay_address,$userinfo["pay_name"],$_SESSION["username"])){
		message('恭喜你，银行绑定成功','get_money.php');
		exit();
	}else{
		message('设置出错，请重新设置你的银行卡信息','set_card.php');
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
            <form action="?action=save" method="post" name="form1" onsubmit="return check_submit_pay();">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td colspan="2" class="tit">绑定银行账号</td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">会员账号：</td>
                        <td class="c_red"><?=$_SESSION["username"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款人姓名：</td>
                        <td class="c_red"><?=$userinfo["pay_name"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款银行：</td>
                        <td>
                            <input name="pay_card" type="text" class="input_150" id="pay_card"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">例如：工商银行</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">银行账号：</td>
                        <td>
                            <input name="pay_num" type="text" class="input_150" id="pay_num"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">请输入您的银行账号</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">开户行地址：</td>
                        <td>
                            <input name="pay_address" type="text" class="input_150" id="pay_address"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">如 "辽宁省沈阳市"</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">验证码：</td>
                        <td>
                            <input name="vlcodes" type="text" class="input_80" id="vlcodes" maxlength="4" style="width: 95px"/>
                            <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="width: 50px; height: 30px; cursor: pointer; position: relative; bottom: 1px" onclick="next_checkNum_img()" />
                            <span class="c_red">*</span>
                            <div class="c_blue">请输入验证码</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50">
                            <button name="submit" type="submit" id="submit" class="submit_108">确认修改</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="c_blue">注意事项：</span><br>
                            1、银行账户持有人姓名必须与注册时输入的姓名一致，否则无法申请提款。<br>
                            2、每位客户只可以使用一张银行卡进行提款，如需要更换银行卡请与客服人员联系；否则提款将被拒绝。<br>
                            3、为保障客户资金安全，<?=$web_site['reg_msg_from']?>有可能需要用户提供电话单，银行对账单或其它资料验证，以确保客户资金不会被冒领。<br>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>