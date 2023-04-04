<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

$type = intval($_GET['t']);
if ($type < 1) $type = 1;
switch ($type) {
    case 1:
        $mainFrame = "Lottery/Cqssc.php";
        break;
    case 10:
        $mainFrame = "Six/Six_7_1.php";
        break;
    default:
        $mainFrame = "Lottery/Cqssc.php";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="skin/js/top.js"></script>
    <script type="text/javascript" src="skin/js/tab.js?_=171"></script>
    <script type="text/javascript" src="newindex/DD_belatedPNG_0.0.9a-min.js"></script>
    <!--[if IE 6]>
    <script type="text/javascript">
        $(function () {
            DD_belatedPNG.fix('.pngfix');
            document.execCommand("BackgroundImageCache", false, true);
        });
    </script>
    <![endif]-->
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
        function urlOnclick(url) {
            window.open(url,"mainFrame");
        }
    </script>
</head>
<body>
    <?php include_once("myhead.php"); ?>
    <div class="about_bg caipiao">
        <div class="about_main">
            <div class="about_con">
                <div class="nav_bar">
                    <a<?=$type == 1 ? ' class="cur"' : ''?> href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php');">重庆时时彩</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php');">天津时时彩</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php');">新疆时时彩</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/Pk10.php');">北京赛车PK拾</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xyft.php');">幸运飞艇</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php');">重庆幸运农场</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php');">广东快乐十分</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php');">北京快乐8</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php');">福彩3D</a>
                    <a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php');">排列三</a>
                    <a<?=$type == 10 ? ' class="cur"' : ''?> href="javascript:void(0);" onclick="urlOnclick('Six/Six_7_1.php');">香港六合彩</a>
                    <!--<a href="javascript:void(0);">PC蛋蛋</a>
                    <a href="javascript:void(0);">加拿大28</a>-->
                </div>
                <div class="con_box">
                    <iframe frameborder="0" scrolling="auto" noresize="noresize" allowtransparency="true" src="<?= $mainFrame ?>" id="mainFrame" name="mainFrame"></iframe>
                </div>
            </div>
            <script type="text/javascript">
                $(".nav_bar a").click(function() {
                    if(!$(this).hasClass("cur")) {
                        $(this).addClass("cur").siblings().removeClass("cur");
                    }
                });
            </script>
        </div>
    </div>
    <?php include_once("mybottom.php"); ?>
</body>
</html>