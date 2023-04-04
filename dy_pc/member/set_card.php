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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <form action="?action=save" method="post" name="form1" onsubmit="return check_submit_pay();">
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td colspan="2" class="tit">绑定银行账号</td>
            </tr>
            <tr>
                <td class="bg" width="22%" align="right">会员账号：</td>
                <td class="c_red"><?=$_SESSION["username"]?></td>
            </tr>
            <tr>
                <td class="bg" align="right">收款人姓名：</td>
                <td class="c_red"><?=$userinfo["pay_name"]?></td>
            </tr>
            <tr>
                <td class="bg" align="right">收款银行：</td>
                <td>
                    <input name="pay_card" type="text" class="input_250" id="pay_card"/>
                    <span class="c_red" style="margin-left: 15px">* <em class="c_blue">例如：工商银行</em></span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">银行账号：</td>
                <td>
                    <input name="pay_num" type="text" class="input_250" id="pay_num"/>
                    <span class="c_red" style="margin-left: 15px">* <em class="c_blue">请输入您的银行账号</em></span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">开户行地址：</td>
                <td>
                    <input name="pay_address" type="text" class="input_250" id="pay_address"/>
                    <span class="c_red" style="margin-left: 15px">* <em class="c_blue">请输入省份及城市，如 "辽宁省沈阳市"</em></span>
                </td>
            </tr>
            <tr>
                <td class="bg" align="right">验证码：</td>
                <td>
                    <input name="vlcodes" type="text" class="input_80" id="vlcodes" maxlength="4" style="width: 144px"/>
                    <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="width: 52px; height: 22px; cursor: pointer; position: relative; bottom: 1px" onclick="next_checkNum_img()" />
                    <span class="c_red" style="margin-left: 15px">* <em class="c_blue">请输入验证码</em></span>
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
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>