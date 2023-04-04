<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
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
    <link href="newindex/fckeditor.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="about_bg">
		<div class="about_main">
			<div class="about_con">
				<div class="sx-box">
					<div class="sx-box-top"></div>
					<div class="sx-box-wrap">
						<div class="lv_list">
							<? if ($uid) { ?>
								<a class="ag" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
								<a class="bbin" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
								<a class="og" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
								<a class="ct" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
								<a class="ds" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
								<a class="mg" href="###" target="_blank"><em class="pho"></em><em class="tit"></em></a>
							<? } else { ?>
								<a class="ag" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
								<a class="bbin" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
								<a class="og" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
								<a class="ct" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
								<a class="ds" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
								<a class="mg" href="javascript:void(0);" onclick="alert('请登录后操作！')"><em class="pho"></em><em class="tit"></em></a>
							<? } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>