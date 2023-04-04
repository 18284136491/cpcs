<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("function.php");

$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid); //验证是否登陆
$userinfo=user::getinfo($_SESSION["uid"]);
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
            <table cellspacing="1" cellpadding="0" border="0" class="tab1">
                <tr>
                    <td colspan="2" class="tit">账户信息</td>
                </tr>
                <tr>
                    <td class="bg" align="right">会员账户：</td>
                    <td><?=$userinfo["username"]?> <span class="c_blue">(<?=$userinfo["is_daili"] == 1 ? "代理" : "会员"?>)</span></td>
                </tr>
                <tr>
                    <td class="bg" align="right">注册时间：</td>
                    <td><?=$userinfo["reg_date"]?></td>
                </tr>
                <tr>
                    <td class="bg" align="right">最后登陆时间：</td>
                    <td><?=$userinfo["login_time"]?></td>
                </tr>
                <tr>
                    <td class="bg" align="right">网站余额：</td>
                    <td class="c_red f_b"><?=sprintf("%.2f",$userinfo["money"])?></td>
                </tr>
                <tr>
                    <td class="bg" align="right">当前积分：</td>
                    <td><span class="c_green"><?=sprintf("%.2f",$userinfo["jifen"])?></span></td>
                </tr>
                <?php if($userinfo["username"] != 'guest') { ?>
                    <tr>
                        <td class="bg" align="right">提款银行：</td>
                        <td>
                            <?php if($userinfo["pay_card"] == "") { ?>
                                <a href="javascript:void(0);" onclick="urlOnclick('set_card.php');" class="c_blue">点击设置您的银行资料</a>
                            <?php } else {
                                echo $userinfo["pay_card"];
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">开户姓名：</td>
                        <td><?=$userinfo["pay_name"]?></td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">银行账号：</td>
                        <td>
                            <?php if($userinfo["pay_card"] == "") { ?>
                                <a href="javascript:void(0);" onclick="urlOnclick('set_card.php');" class="c_blue">点击设置您的银行资料</a>
                            <?php } else {
                                echo cutNum($userinfo["pay_num"]);
                            } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>