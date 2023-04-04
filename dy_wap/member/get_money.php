<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);

$sql	=	"select pay_name,pay_card from k_user where uid=$uid limit 1";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if($rs['pay_card'] == ""){
	message("请先绑定银行账号信息","set_card.php");
	exit();
}

if(@$_GET["action"]=="tikuan"){
	$date_s = date("Y-m-d")." 00:00:00";
	$date_e = date("Y-m-d")." 23:59:59";
	$sql = "select count(*) as c from k_money where uid='$uid' and m_value<0 and m_make_time > '$date_s' and m_make_time < '$date_e'";
	$query	=	$mysqli->query($sql);  		
	$one	=	$query->fetch_array();
	if($one[c]>=3){
		message("您的本次提款申请失败，由于银行系统管制，每个帐号每天限制只能提款3次。");exit;
	}
    //验证取款密码
    $qk_pwd	=	md5($_POST["qk_pwd"]);
    $qk_sql	=	"select uid from k_user where uid=$uid and qk_pwd='$qk_pwd'";
	$qk_query	=	$mysqli->query($qk_sql);  		
	$qk_rs		=	$qk_query->fetch_array();
	if(!$qk_rs){
		message('提款密码错误，请重新输入');
		exit();
	}
	
	$pay_value	=	sprintf("%.2f",floatval($_POST["pay_value"]));
	if(($pay_value<0)||($pay_value>$userinfo["money"])){
		message('提款金额错误，请重新输入');
		exit();
	}
    
    if($pay_value<$web_site['qk_limit']){
        message('提款金额不能低于['.$web_site['qk_limit'].']元');
		exit();
    }
    
    $currtime=time()+1*12*3600;
    $c_time=date("Y-m-d H:i",$currtime);
    $qk_time_begin=date("Y-m-d",$currtime)." ".$web_site['qk_time_begin'];
    $qk_time_end=date("Y-m-d",$currtime)." ".$web_site['qk_time_end'];
    if (strtotime($c_time)<strtotime($qk_time_begin) || strtotime($c_time)>strtotime($qk_time_end)) {
        message('很抱歉，不在提款时间段，暂时不能提款');
		exit();
    }
	
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$sql		=	"update k_user set money=money-$pay_value where uid=$uid";
		$mysqli->query($sql);
		$q1			=	$mysqli->affected_rows;
		
		$pay_value	=	0-$pay_value; //把金额置成带符号数字
		$order		=	$_SESSION['username']."_".date("YmdHis");
		$sql		=	"insert into k_money(uid,m_value,status,m_order,pay_card,pay_num,pay_address,pay_name,about,assets,balance,type) values($uid,$pay_value,2,'$order','".$userinfo["pay_card"]."','".$userinfo["pay_num"]."','".$userinfo["pay_address"]."','".$userinfo["pay_name"]."','',".$userinfo["money"].",".($userinfo["money"]+$pay_value).",2)";
		$mysqli->query($sql);
		$q2		=	$mysqli->affected_rows;
		
		if($q1==1 && $q2==1){
			$mysqli->commit(); //事务提交
			message('提款申请已经提交，等待财务人员为您出款','data_t_money.php');
		}else{
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
	}
}
$sub = 2;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>提取现金</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
	<script type="text/javascript">
		//数字验证 过滤非法字符
        function clearNoNum(obj) {
	        obj.value = obj.value.replace(/[^\d.]/g,""); //先把非数字的都替换掉，除了数字和.
	        obj.value = obj.value.replace(/^\./g,""); //必须保证第一个为数字而不是.
	        obj.value = obj.value.replace(/\.{2,}/g,"."); //保证只有出现一个.而没有多个.
	        obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$","."); //保证.只出现一次，而不能出现两次以上
	        if(obj.value != '') {
				var re=/^\d+\.{0,1}\d{0,2}$/;
				if(!re.test(obj.value)) {
					obj.value = obj.value.substring(0,obj.value.length-1);
					return false;
				} 
	        }
        }
		
		function check_submit() {
			if($("#pay_value").val() == "") {
				alert("请输入您的取款金额");
				$("#pay_value").focus();
				return false;
			}
			if($("#pay_value").val() < <?=$web_site['qk_limit']?>) {
				alert("每次最低提款金额为<?=$web_site['qk_limit']?>元");
				$("#pay_value").focus();
				return false;
			}
			if($("#qk_pwd").val() == "") {
				alert("请输入您的取款密码");
				$("#qk_pwd").focus();
				return false;
			}
		}
	</script>
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
            <?php include_once("moneymenu.php"); ?>
            <form onsubmit="return check_submit()" action="?action=tikuan" method="post" name="form1">
                <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="tic" colspan="2"><span class="c_red f_b">请认真填写以下提款单</span></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">用户账号：</td>
                        <td class="c_blue"><?=$userinfo["username"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">可用提款额度：</td>
                        <td class="c_red f_b"><?=sprintf("%.2f",$userinfo["money"])?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款人姓名：</td>
                        <td><?=$userinfo["pay_name"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款银行：</td>
                        <td><?=$userinfo["pay_card"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款账号：</td>
                        <td><?=cutNum($userinfo["pay_num"])?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">收款银行地址：</td>
                        <td><?=cutNum($userinfo["pay_address"])?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">取款金额：</td>
                        <td>
                            <input name="pay_value" type="text" class="input_150" id="pay_value" onkeyup="clearNoNum(this);" maxlength="10"/>
                            <span class="c_red">*</span>
                            <div class="c_blue">最低取款金额<?=$web_site['qk_limit']?>元</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">取款密码：</td>
                        <td>
                            <input name="qk_pwd" type="password" class="input_150" id="qk_pwd" onkeyup="if(isNaN(value))execCommand('undo')" maxlength="6" />
                            <span class="c_red">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right"></td>
                        <td height="50">
                            <button name="SubTran" type="submit" class="submit_108" id="SubTran">申请提款</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>注意：</strong>允许出款时间为 <?=$web_site['qk_time_begin']?> 到 <?=$web_site['qk_time_end']?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>