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

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "agent_reg.php");
}
$sub = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
                <td class="tic c_red f_b" colspan="2">请使用以下推广网址进行推广</td>
            </tr>
            <tr>
                <td class="bg" width="22%" align="right">推广网址：</td>
                <td class="c_blue f_b">http://<?= $_SERVER['SERVER_NAME']?>/?f=<?=$_SESSION["username"]?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="f_b">备注说明：</span><br/>
                    1、代理申请成功后，请使用以上推广网址进行推广；<br/>
                    2、通过推广网址注册来的会员将会成为您的下线会员。
                </td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>