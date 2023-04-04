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
$mainHeight = 850;
switch ($type) {
    case 1:
        $mainFrame = "Lottery28/xy28_list.php";
        break;
    case 2:
        $mainFrame = "Lottery28/jnd28_list.php";
        break;
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
    <script type="text/javascript" src="skin/js/tab.js?_=171"></script>
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
    <!--[if IE 6]>
    <style type="text/css">
        html {
            overflow-x: hidden;
        }
        body {
            padding-right: 1em;
        }
    </style>
    <script type="text/javascript" src="newindex/DD_belatedPNG_0.0.9a-min.js"></script>
    <script type="text/javascript">
        $(function () {
            DD_belatedPNG.fix('.pngfix');
        });
        //修正ie6 bug
        try {
            document.execCommand("BackgroundImageCache", false, true);
        } catch (err) {
        }
    </script>
    <![endif]-->
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="about_bg sports">
    <div class="about_main">
        <div class="about_con">
            <div class="main">
                <iframe frameborder="0" scrolling="auto" noresize="noresize" allowtransparency="true" src="<?= $mainFrame ?>" id="mainFrame" name="mainFrame"></iframe>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
<script type="text/javascript">
    function SetCwinHeight() {
        var iframeid = document.getElementById("mainFrame"); //框架页id
        if (document.getElementById) {
            if (iframeid && !window.opera) {
                if (navigator.userAgent.indexOf("Firefox") > 0) {//Firefox
                    iframeid.height = document.documentElement.scrollHeight - 190;
                } else if (navigator.userAgent.indexOf("Gecko") > 0) {//Mozilla,Chrome
                    iframeid.height = document.documentElement.clientHeight - 190;
                }
                else {//IE
                    if (navigator.appVersion.match(/6./i) == "6.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/7./i) == "7.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/8./i) == "8.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/9./i) == "9.") {
                        alert("IE 9");
                    } else {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }

                }
            }
        }
    }
    function SetLeftHeight() {
        var iframeid = document.getElementById("leftFrame"); //框架页id
        if (document.getElementById) {
            if (iframeid && !window.opera) {
                if (navigator.userAgent.indexOf("Firefox") > 0) {//Firefox
                    iframeid.height = document.documentElement.scrollHeight - 190;
                } else if (navigator.userAgent.indexOf("Gecko") > 0) {//Mozilla,Chrome
                    iframeid.height = document.documentElement.clientHeight - 190;
                }
                else {//IE
                    if (navigator.appVersion.match(/6./i) == "6.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/7./i) == "7.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/8./i) == "8.") {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }
                    else if (navigator.appVersion.match(/9./i) == "9.") {
                        alert("IE 9");
                    } else {
                        iframeid.height = document.documentElement.clientHeight - 190;
                    }

                }
            }
        }
    }
    //每隔2s设置一次，主要为了兼容子页面加载完毕之后高度再变化
    setTimeout(SetCwinHeight, 1000);
    setTimeout(SetLeftHeight, 1000);
</script>
</body>
</html>