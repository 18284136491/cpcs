<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("pay/moneyconfig.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
$sub = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css?_<?=time()?>"/>
</head>
<body>
<div class="wrap">
    <?php include_once("moneymenu.php"); ?>
	<div class="s_m">
		<a href="javascript:void(0);" onclick="Go('<?=$input_url?>');">
			<span>
				<i class="upay"></i>
				<em><b>网银充值</b><br/>在线支付，自动入账</em>
			</span>
			<span class="go_pay">去支付</span>
		</a>
		<a href="javascript:void(0);" onclick="Go('wx_pay.php');">
			<span>
				<i class="wxpay"></i>
				<em><b>微信支付</b><br/>扫二维码充值，自动入账</em>
			</span>
			<span class="go_pay">去支付</span>
		</a>
		<a href="javascript:void(0);" onclick="Go('hk_money.php');">
			<span>
				<i class="atm"></i>
				<em><b>银行转账</b><br/>人工转账，需要审核</em>
			</span>
			<span class="go_pay">去支付</span>
		</a>
		<a href="javascript:void(0);" onclick="Go('ali_pay.php');">
			<span>
				<i class="zfb"></i>
				<em><b>支付宝</b><br/>支付宝扫码，立即到账</em>
			</span>
			<span class="go_pay">去支付</span>
		</a>
	</div>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>