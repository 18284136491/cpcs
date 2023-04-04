<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myhot';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="activity">
    <div class="banner"></div>
    <div class="con">
        <div class="w1020">
            <div class="t_list">
                <a><em class="icon1"></em>福运来所有游戏</a>
                <a><em class="icon2"></em>投注额每日返水</a>
                <a><em class="icon3"></em>系统自动发放</a>
                <a><em class="icon4"></em>无需任何申请</a>
            </div>
            <div class="con_list">
                <div class="l_ico"><span>1</span></div>
                <div class="r_con">
                    <p>
                        得奖规则：<br>
                        由2012年6月6日开始，长期进行。如果活动终止，将会至少提前48小时做出通知。<br>
                        如何领取：<br>
                        活动无需申请，由系统根据会员在福运来的级别和在各个游戏场馆的投注额自动进行发放。见下列表格说明。
                    </p>
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <thead>
                            <tr>
                                <th>会员级别</th>
                                <th>北京赛车PK10</th>
                                <th>重庆时时彩</th>
                                <th>广东快乐十分</th>
                                <th>幸运农场</th>
                                <th>幸运飞艇</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>VIP会员</td>
                                <td>0.03%</td>
                                <td>0.03%</td>
                                <td>0.03%</td>
                                <td>0.03%</td>
                                <td>0.03%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
</body>
</html>