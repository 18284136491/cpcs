<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'noticle';
$msg = "";
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 0,5";
$query = $mysqli->query($sql);
while ($rs = $query->fetch_array()) {
    $msg .= $rs['msg'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--[if lte IE 6]>
<html class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="skin/js/common.js?_=171"></script>
    <script type="text/javascript" src="skin/js/upup.js?_=171"></script>
    <script type="text/javascript" src="skin/js/float.js?_=171"></script>
    <script type="text/javascript" src="skin/js/swfobject.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jquery.cookie.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jingcheng.js?_=171"></script>
    <script type="text/javascript" src="skin/js/top.js?_=171"></script>
    <script type="text/javascript" src="box/jquery.jBox-2.3.min.js"></script>
    <script type="text/javascript" src="box/jquery.jBox-zh-CN.js"></script>
    <link type="text/css" rel="stylesheet" href="box/Green/jbox.css"/>
    <link href="newindex/standard.css?_=171" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/primary-red.css"/>
    <script type="text/javascript" src="skin/js/tab.js?_=171"></script>
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
    <link rel="stylesheet" href="css/IE.css"/>
    <script src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE.js"></script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="help about_wel"></div>
<div class="help about_bg">
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
                <?php include_once("myleft.php"); ?>
                <div class="about_right">
                    <p style="font-size: 25px">历史公告</p>

                    <div class="large-callout">

                        <iframe name="regFrame" id="regFrame" width="720" height="650" scrolling="no" frameborder="0"
                                src="result/noticle.php" allowtransparency="true"></iframe>
                        <script>
                            function IframeHeight() {
                                mainheight = $("#regFrame").contents().find("body").height() + 30;
                                $("#regFrame").height(mainheight);
                            }
                            $(document).ready(function () {
                                setInterval("IframeHeight()", 100);
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
        <div class="about_bottom"></div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
</body>
</html>