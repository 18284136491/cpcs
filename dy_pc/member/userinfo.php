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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员中心</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css">
</head>
<body>
    <div class="wrap">
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td colspan="2" class="tit">账户信息</td>
            </tr>
            <tr>
                <td class="bg" width="22%" align="right">会员账户：</td>
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
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="../js/cp.js"></script>
    <script type="text/javascript" src="../js/left_mouse.js"></script>
</body>
</html>