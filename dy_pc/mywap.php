<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myhot';
$msg = "";
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 0,5";
$query = $mysqli->query($sql);
while ($rs = $query->fetch_array()) {
    $msg .= $rs['msg'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>手机投注</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="skin/js/common.js"></script>
    <script type="text/javascript" src="skin/js/upup.js"></script>
    <script type="text/javascript" src="skin/js/float.js"></script>
    <script type="text/javascript" src="skin/js/swfobject.js"></script>
    <script type="text/javascript" src="skin/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="skin/js/jingcheng.js"></script>
    <script type="text/javascript" src="skin/js/top.js"></script>
    <script language="javascript" src="box/artDialog.js"></script>
    <script language="javascript" src="box/plugins/iframeTools.js"></script>
    <script type="text/javascript" src="box/jquery.jBox-2.3.min.js"></script>
    <script type="text/javascript" src="box/jquery.jBox-zh-CN.js"></script>
    <link type="text/css" rel="stylesheet" href="box/Green/jbox.css">
    <link href="skin/css/standard.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/primary-red.css"/>
    <script type="text/javascript" src="skin/js/tab.js"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
    <script type="text/javascript" src="newindex/zb.js"></script>
    <link href="newindex/zb.css" rel="stylesheet" type="text/css">
    <link href="newindex/fckeditor.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/IE.css"/>
    <script src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE.js"></script>
    <style type="text/css" media="screen">#ele-logo-wrap {
            visibility: hidden
        }

        #loop_flash {
            visibility: hidden
        }</style>
</head>
<body>
<!--[if IE 6]>
<style>
    .png {
        position: relative;
    }

    html {
        overflow-x: hidden;
    }

    body {
        padding-right: 1em;
    }
</style>
<script src="newindex/DD_belatedPNG_0.0.9a-min.js"></script>
<script>
    $(function () {
        DD_belatedPNG.fix('.png');
    });
    //修正ie6 bug
    try {
        document.execCommand("BackgroundImageCache", false, true);
    } catch (err) {
    }
</script>
<![endif]-->
<?php include_once("myhead.php"); ?>
<div class="help about_wel"></div>
<div class="act about_bg">
    <div class="about_main">
        <div class="about_top">
            <div id="m-left" class="m-left" onclick="deng.gourl('','noticle')">
                <div class="bd">
                    <ul>
                        <?php
                        $sql = "select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,5";
                        $query = $mysqli->query($sql);
                        $str = "";
                        while ($row = $query->fetch_array()) {
                            $str .= "<li>";
                            $str .= "★ " . $row["msg"];
                            $str .= "</li>";
                        }
                        echo $str;
                        ?>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                $("#m-left").slide({mainCell: ".bd ul", autoPlay: true, effect: "leftMarquee", interTime: 25});
            </script>
        </div>
        <div class="about_con">
            <div class="about_con_top"></div>
            <div class="about_text">
                <div class="img-frame full-banner">
                    <img src="newindex/mobile1.png" width="1040" height="583"/>
                </div>
                <div class="img-frame full-banner">
                    <img src="newindex/mobile2.png" width="1040" height="514"/>
                </div>
                <div class="img-frame full-banner">
                    <img src="newindex/mobile3.png" width="1040" height="420"/>
                </div>
            </div>
        </div>
        <div class="about_bottom"></div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
</body>
</html>
