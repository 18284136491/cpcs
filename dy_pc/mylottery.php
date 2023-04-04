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
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
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
    <link href="newindex/standard.css?_=171" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="skin/js/tab.js?_=171"></script>
    <script type="text/javascript">
        if (self == top) { location = '/'; } 
        if (window.location.host != top.location.host) { top.location = window.location; } 
    </script>
    <script type="text/javascript" src="newindex/xinpj.js"></script>
    <link href="newindex/xinpj.css" rel="stylesheet" type="text/css">
    <!--[if IE 6]>
	<style type="text/css">
		html { overflow-x: hidden;}
		body { padding-right: 1em; }
	</style>
	<script type="text/javascript" src="newindex/DD_belatedPNG_0.0.9a-min.js"></script>
	<script type="text/javascript">
		$(function(){
			DD_belatedPNG.fix('.pngfix');
		});
		//修正ie6 bug
		try {
			document.execCommand("BackgroundImageCache", false, true);
		} catch(err) {}
	</script>
	<![endif]-->
    <link href="newindex/fckeditor.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="bgPage" class="bg">
	<div id="pageindex">
		<?php include_once("myhead.php"); ?>
		<div class="inside-headout2">
        	<div style="display:block; height:193px; width:1000px; margin:0 auto; background: url(/newindex/title_welcome.png) center top no-repeat;">
            </div>
			<!---->
            <div id="divMarquee" class="indexmarqueebg"> 
				<div class="welcome">
					<div id="myMarquee" style="width:850px;overflow:hidden;padding-left:150px;padding-right:30px;line-height:40px;">
						<marquee scrollamount="3" scrolldelay="150" direction="left" id="msgNews" onmouseover="this.stop();" onmouseout="this.start();" onclick="HotNewsHistory();" style="cursor:pointer;color:#FFF;" height="40" width="820"><?=$msg?></marquee>
					</div>
				</div>
			</div>
            <!---->
            
		<div class="content">
			<!--div class="content_side_top"></div-->
			<div class="content_side">
				<div class="casino_con2">
					<dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(3);return false"><img alt="" src="newindex/lhc.png"/></a></dt>
						<dd><a class="game_name" href="/sm/6hc.php" target="_blank">香港六合彩介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(3);return false">立即游戏</a--></dd>
					</dl>
                    <dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(19);return false"><img alt="" src="newindex/bjsc.png"/></a></dt>
						<dd><a class="game_name" href="/sm/bjsc.php" target="_blank">北京PK拾介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(19);return false">立即游戏</a--></dd>
					</dl>
                    <dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(7);return false"><img alt="" src="newindex/pl3.png"/></a></dt>
						<dd><a class="game_name" href="/sm/pl3.php" target="_blank">排列三介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(7);return false">立即游戏</a--></dd>
					</dl>
                    <dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(6);return false"><img alt="" src="newindex/kl8.png"/></a></dt>
						<dd><a class="game_name" href="/sm/kl8.php" target="_blank">北京快乐8介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(6);return false">立即游戏</a--></dd>
					</dl>
					<dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(4);return false"><img alt="" src="newindex/cqssc.png"/></a></dt>
						<dd><a class="game_name" href="/sm/ssc.php" target="_blank">重庆时时彩介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(4);return false">立即游戏</a--></dd>
					</dl>					
					<dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(8);return false"><img alt="" src="newindex/shssc.png"/></a></dt>
						<dd><a class="game_name" href="/sm/ssl.php" target="_blank">上海时时乐介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(8);return false">立即游戏</a--></dd>
					</dl>
					<dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(5);return false"><img alt="" src="newindex/fc3d.png"/></a></dt>
						<dd><a class="game_name" href="/sm/3d.php" target="_blank">福彩3D介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(5);return false">立即游戏</a--></dd>
					</dl>
                    <dl>
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(18);return false"><img alt="" src="newindex/gdkl.png"/></a></dt>
						<dd><a class="game_name" href="/sm/klsf.php" target="_blank">广东十分彩介绍</a><!--a class="play" href="javascript:void(0);" onclick="javascript:menu_url(18);return false">立即游戏</a--></dd>
					</dl>
                    <dl class="last">
						<dt><a href="javascript:void(0);" onclick="javascript:menu_url(75);return false"><img alt="" src="newindex/jsk3.png"/></a></dt>
						<dd><a class="game_name" href="/sm/jsk3.php" target="_blank">江苏快3介绍</a></dd>
					</dl>
					<div class="clear"></div>
				</div>
			</div>
			<!--div class="content_side_bottom"></div-->
		</div>
        </div>
	</div>
	<?php include_once("mybottom.php"); ?>
</div>
</body>
</html>
<?php if($uid){?>
<script language="javascript">
    function top_money(){
        $.post("/top_money_data.php",function (data){ 
            var strs= new Array(); 
            var strs = data.split("|");
            $("#user_money").html(strs[0]);
            $("#user_num").html(strs[1]);
            $("#tz_money").html(strs[2]);
        });
        setTimeout("top_money()",5000);
    }
    top_money();
</script>
<? }?>