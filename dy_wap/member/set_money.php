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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>在线存款</title>
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
            <?php include_once("moneymenu.php"); ?>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr>
                    <td class="tit">在线支付</td>
                </tr>
                <tr>
                    <td style="padding: 5px 10px">
                        <div style="padding: 5px 0">网上银行在线支付，立即到账；推荐您在入款时使用</div>
                        <button type="button" class="btn btn-primary btn-lg disabled" style="width: 100%; margin: 5px 0">请在PC上使用在线支付</button>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr>
                    <td class="tit">公司入款</td>
                </tr>
                <tr>
                    <td style="padding: 5px 10px">
                        <div style="padding: 5px 0">支持网银转账、ATM转账、银行柜台汇款</div>
                        <button type="button" class="btn btn-danger btn-lg" onclick="Go('hk_money.php');" style="width: 100%; margin: 5px 0">公司入款</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>