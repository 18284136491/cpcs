<?php 
@session_start();
include_once("include/config.php");
$_SESSION["check_action"]=''; //检测用户是否用软件打水标识
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>Welcome</title>
	<meta http-equiv="Cache-Control" content="max-age=864000" />
	<style type="text/css">
		/* CSS样式表 */
		 body{
			margin:0px;
			padding:0px;
			font-family: "宋体", Arial;
			color:#783218;  /* 菜单字体颜色 */
			background:#FFF; /* 菜单背景颜色 */
			position: relative;
			font-size:12px;
			overflow-x: hidden;
		}
		html {
			overflow-x: hidden;
		}
		h1,h2,h3,h4,h5{
			padding:0;
			margin:0;
			font-size:25px;
			color:#900;
		}
		/*设立常用标签的外边距，内边距，边框为0，防止在排版时再重复定义和出现怪问题*/
		div,form,ul,ol,li,dl,dt,dd,p,span,img
		 {
			margin: 0;
			padding: 0;
			border:0;
		}
		/*设立列表样式为无，这样列表前面不带点*/
		li,dl{
			list-style-type:none;
		}
		/*(设立默认全局样式超链接样式)*/
		a{text-decoration:none;color:#900;}
		a:hover{ text-decoration:underline;color:#900;}
		/*所有样式*/
		.clear {clear: both;}
		.line10{height:10px;}
		.line5{height:5px;overflow:hidden;}
		.main{margin:0 auto; padding:0px; width:220px; background-color:#FFF;float:left;}
		.menulink_0{height:0px;margin:0px auto 0 auto; line-height:20px; background-image:url(skin/sports/div_left_02.gif);}
		.menulink_00{height:10px;margin:0px auto 0 auto; line-height:20px; background-image:url(skin/sports/div_left_02.gif);}
		.ds_z{float:left; width: 10px; height: 34px; background-image:url(skin/sports/div_left_03.gif);}
		.ds_r{float:left; width: 10px; height: 34px; background-image:url(skin/sports/div_left_07.gif);}
		.ds_1{float:left; width: 67px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_05.gif); line-height:34px; text-align:center; color:#000;}
		.cg_1{float:left; width: 67px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_04.gif); line-height:34px; text-align:center; color:#000;}
		.gq_1{float:left; width: 67px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_04.gif); line-height:34px; text-align:center; color:#000;}
		.ds_2{float:left; width: 66px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_04.gif); line-height:34px; text-align:center; color:#000;}
		.cg_2{float:left; width: 68px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_05.gif); line-height:34px; text-align:center; color:#000;}
		.gq_2{float:left; width: 67px; height: 34px; cursor: pointer; background-image:url(skin/sports/div_left_04.gif); line-height:34px; text-align:center; color:#000;}
		.menulink_1{height:35px;margin:0px auto 0 auto; line-height:35px; padding:0px 23px 0px 23px; background-image:url(skin/sports/div_left_10.gif);color:#860009;cursor: pointer; font-weight:bold;}
		.menulink_2{height:35px;margin:0px auto 0 auto; line-height:35px; padding:0px 23px 0px 23px; background-image:url(skin/sports/div_left_16.gif);cursor: pointer; color:#860009; font-weight:bold;}
		.betlink_1{height:25px;margin:0 auto; background-image:url(skin/sports/div_left_11.gif);line-height:25px; padding:0px 23px 0px 23px;border-bottom:0px #e2d1c1 solid;cursor: pointer;}
		.betlink_2{height:25px;margin:0 auto; background-image:url(skin/sports/div_left_12.gif);line-height:25px; padding:0px 23px 0px 23px;border-bottom:0px #e2d1c1 solid;cursor: pointer;}
		.menulink_3{height:20px;margin:0px auto 0 auto; line-height:20px; background-image:url(skin/sports/div_left_17.gif);}
		
		
		.f_right{ float:right;}
		.touzhu_3 {
            
			margin: 0px 0 0 20px;
			line-height:25px;

		}
		.touzhu_6 {
			height: auto;
			background-image:url(skin/sports/div_left_08.gif);
			padding: 3px 0 4px 0;
			color:#000;
		}
		.touzhu_61 {
			height: auto;
			background-image:url(skin/sports/div_left_08_2.gif);
			padding: 8px 0 10px 0;
			color:#000;
		}
		
		.touzhu_8 {
			height:60;
			background-image:url(skin/sports/div_left_08.gif);
			padding: 4px 0 4px 0;
			color:#FFF;
		}
		.touzhu_4 {
			height:30px;
			background-image:url(skin/sports/div_left_09.gif);
			color:#9b0d1b;
			font-weight:bold;
			line-height:30px;
			text-align:center;
		}
		.tou_input {
			width: 80px;
			border: 1px solid #e9b9ad;
			height:16px;
		}
		.touzhu_7 {
			width: 60px;
			float: left;
			padding: 0 10px 0 10px;
		}
		.quxiao{float:left;margin:0 0 0 30px; width:60px;}
		.queren{float:right;margin:0 35px 0 0; width:60px;}
		.toua_1 {
			background: url(skin/sports/touzhu_2.jpg) no-repeat;
			width: 60px;
			height: 22px;
			border: 0px;
			cursor:pointer;
		}
		.toua_2 {
			background: url(skin/sports/touzhu_3.jpg) no-repeat;
			width: 60px;
			height: 22px;
			border: 0px;
			cursor:pointer;
		}
		.match_msg{line-height:20px; padding:5px; height:auto; background-color:#ffefa1; border:1px #9C9895 solid; margin:5px 0px;}
	</style>
	<script language="JavaScript">
		window.onerror=function(){return true;}
		if(self==top){
			top.location='/';
		}

		function urlOnclick(url){
			window.open(url,"mainFrame");
		}
		
		function urlrule(){
			window.open("sm/sports.php","_blank");
		}
	</script>
</head>
<body>
<?php
include_once("include/mysqli.php");
include_once("common/logintu.php");
include_once("class/user.php");
$uid    	=	@$_SESSION['uid'];
$loginid	=	@$_SESSION['user_login_id'];
renovate($uid,$loginid);
?>
<script type="text/javascript" src="skin/js2/jquery.js"></script>
<script type="text/javascript" src="skin/js2/common.js"></script>
<script type="text/javascript" src="skin/js2/global.js"></script>
<script type="text/javascript" src="skin/js2/DD_belatedPNG.js"></script> 
<script type="text/javascript">if(isLessIE6)DD_belatedPNG.fix('*'); </script>
<script>
	function changeMove(obj,type,k)
	{
		if(type)
		{
			$(obj).addClass(k+"_1");
		}
		else
		{
			if ($("#"+k+"_01_bet").css("display")=="none")
				$(obj).removeClass(k+"_1");
		}
	}
</script>
<div class="main">
	<?php
	if (isset($_SESSION["uid"],$_SESSION["username"])){
	?>
	<div id="userinfo" style="display:none;">
		<table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-bottom:5px;">
			<tr>
				<td bgcolor="#FFFFFF">会员账号：<?=$_SESSION["username"];?></td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">账户余额：<span class="tou_h" id="user_money2">0.00</span></td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">投注额度：<span class="tou_h" id="tz_money">0</span></td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">站内消息：<a href="javascript:void(0);" onclick="urlOnclick('user/sys_msg.php?1=1')"><span id="user_num">0</span></a></td>
			</tr>
		</table>
	</div>
	<?php
	}
	?>
	<div id="ds_01_bet">
		<div id="left_1" style="display:none">
			<div class="ds_z"></div>
			<div class="ds_1" onclick="$('#ds_01_bet').fadeIn();$('#cg_01_bet').hide();" title="点击进入单式下注">单式投注</div>
			<div id="button_chuanguan" class="cg_1" onclick="$('#ds_01_bet').hide();$('#cg_01_bet').fadeIn();" title="点击进入串关下注">串关投注</div>
			<div class="ds_2" onclick="$('#ds_01_bet').fadeIn();$('#cg_01_bet').hide();urlOnclick('show/ft_gunqiu.html');" title="点击进入滚球下注">滚球投注</div>
			<div class="ds_r"></div>
			<div class="clear"></div>
		</div>
		<div class="menulink_2" id="en0" onclick="ShowHidden(0);"><span class="f_right" id="s_zq">(0)</span>足球</div>
		<div id="Label0">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_danshi.html')"><span class="f_right" id="s_zq_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_shangbanchang.html')"><span class="f_right" id="s_zq_sbc">(0)</span>上半场</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_gunqiu.html')"><span class="f_right" id="s_zq_gq">(0)</span>足球滚球</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_bodan.html')"><span class="f_right" id="s_zq_bd">(0)</span>全场波胆</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_shangbanbodan.html')"><span class="f_right" id="s_zq_sbbd">(0)</span>上半场波胆</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_ruqiushu.html')"><span class="f_right" id="s_zq_rqs">(0)</span>独赢 & 总入球</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_banquanchang.html')"><span class="f_right" id="s_zq_bqc">(0)</span>半场/全场</div>
            <div id="button_chuanguan2" class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="$('#ds_01_bet').hide();$('#cg_01_bet').fadeIn();"><span class="f_right" id="cg_f2">(0)</span>综合过关</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('result/bet_match.php')"><span class="f_right" id="s_zq_jg">(0)</span>足球结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en1" onclick="ShowHidden(1)"><span class="f_right" id="s_zqzc">(0)</span>足球早餐</div>
		<div id="Label1" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_danshi.html')"><span class="f_right" id="s_zqzc_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_shangbanchang.html')"><span class="f_right" id="s_zqzc_sbc">(0)</span>上半场</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_bodan.html')"><span class="f_right" id="s_zqzc_bd">(0)</span>全场波胆</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_shangbanbodan.html')"><span class="f_right" id="s_zqzc_sbbd">(0)</span>上半场波胆</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_ruqiushu.html')"><span class="f_right" id="s_zqzc_rqs">(0)</span>独赢 & 总入球</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_banquanchang.html')"><span class="f_right" id="s_zqzc_bqc">(0)</span>半场/全场</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en2" onclick="ShowHidden(2);"><span class="f_right" id="s_lm">(0)</span>篮球</div>
		<div id="Label2" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/bk_danshi.html')"><span class="f_right" id="s_lm_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/bk_gunqiu.html')"><span class="f_right" id="s_lm_gq">(0)</span>篮球滚球</div>
            <div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/bkz_danshi.html')"><span class="f_right" id="s_lmzc_ds">(0)</span>篮球早餐</div>
            <div id="button_chuanguan2" class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="$('#ds_01_bet').hide();$('#cg_01_bet').fadeIn();"><span class="f_right" id="s_lm_ds2">(0)</span>综合过关</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('result/lq_match.php')"><span class="f_right" id="s_lm_jg">(0)</span>篮球结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en3" onclick="ShowHidden(3)"><span class="f_right" id="s_wq">(0)</span>网球</div>
		<div id="Label3" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/tennis_danshi.html')"><span class="f_right" id="s_wq_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('result/tennis_match.php')"><span class="f_right" id="s_wq_jg">(0)</span>网球结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en4" onclick="ShowHidden(4)"><span class="f_right" id="s_pq">(0)</span>排球</div>
		  <div id="Label4" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/volleyball_danshi.html')"><span class="f_right" id="s_pq_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('result/volleyball_match.php')"><span class="f_right" id="s_pq_jg">(0)</span>排球结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en5" onclick="ShowHidden(5)"><span class="f_right" id="s_bq">(0)</span>棒球</div>
		<div id="Label5" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/baseball_danshi.html')"><span class="f_right" id="s_bq_ds">(0)</span>单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('result/baseball_match.php')"><span class="f_right" id="s_bq_jg">(0)</span>棒球结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en6" onclick="ShowHidden(6)"><span class="f_right" id="s_gj">(0)</span>冠军</div>
		<div id="Label6" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/guanjun.html')"><span class="f_right" id="s_gj_gj">(0)</span>足球冠军</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/guanjun_result.php')"><span class="f_right" id="s_gj_jg">(0)</span>冠军结果</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
        <div class="menulink_3"></div>
	</div>
	<div id="cg_01_bet" style="display:none">
		<div id="left_1">
			<div class="ds_z"></div>
			<div id="button_danshi" class="ds_2" onclick="$('#ds_01_bet').fadeIn();$('#cg_01_bet').hide();" title="点击进入单式下注">单式投注</div>
			<div class="cg_2" onclick="$('#ds_01_bet').hide();$('#cg_01_bet').fadeIn();" title="点击进入串关下注">串关投注</div>
			<div class="ds_2" onclick="$('#ds_01_bet').fadeIn();$('#cg_01_bet').hide();urlOnclick('show/ft_gunqiu.html');" title="点击进入滚球下注">滚球投注</div>
			<div class="ds_r"></div>
			<div class="clear"></div>
		</div>
		<div class="menulink_2" id="en_0" onclick="ShowHidden_c(0)"><span class="f_right" id="cg_f">(0)</span>今日赛事</div>
		<div id="Label_0">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_danshi.html')"><span class="f_right" id="cg_f_0">(0)</span>足球单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ft_shangbanchang.html')"><span class="f_right" id="cg_f_1">(0)</span>足球上半场</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/bk_danshi.html')"><span class="f_right" id="cg_f_2">(0)</span>篮美单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
		<div class="menulink_1" id="en_1" onclick="ShowHidden_c(1)"><span class="f_right"  id="cg_f1">(0)</span>早餐赛事</div>
		<div id="Label_1" style="display:none">
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_danshi.html')"><span class="f_right" id="cg_f1_0">(0)</span>足球单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/ftz_shangbanchang.html')"><span class="f_right" id="cg_f1_1">(0)</span>足球上半场</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlOnclick('show/bkz_danshi.html')"><span class="f_right" id="cg_f1_2">(0)</span>篮美单式</div>
			<div class="betlink_1" onmouseover="this.className='betlink_2'" onmouseout="this.className='betlink_1'" onclick="urlrule()">游戏规则</div>
		</div>
        <div class="menulink_3"></div>
	</div>
	<div id="xp" style="display:none;margin:0">
    <div id="left">
    <div class="menulink_00" ></div>
	<div class="touzhu_2" id="usersid">
         <div class="touzhu_6">
        <div class="touzhu_3">会员帐号：<?=$_SESSION["username"];?></div>
        <div class="touzhu_3">可用额度：<span class="red" id="user_money">0</span></div>
        <div class="touzhu_3">使用币种：人民币(RMB) </div>
        </div> 
    </div>  
    <div class="touzhu_6">  
        <form action="bet.php" name="form1" id="form1" method="post" onsubmit="if($('#cg_msg').css('display')!='none') {if (parseInt($('#cg_num').html(),10)>=2) {return check_bet();}else{alert('投注失败，请至少选择2场比赛后再进行投注！');return false;}}else{return check_bet();}" style="margin:0 0 0 0;">
        <input type="hidden" name="touzhutype" id="touzhutype" value="0" />
        <div class="touzhu_4" id="cg_msg" style="display:none;">已选择 <span id="cg_num" style="color:#000;"></span> 场赛事</div>
        <div id="touzhudiv" style="text-align:center; width: 196px; padding: 0px 0px 0px 12px;" >
        </div>
        <div class="touzhu_6">
        <div class="touzhu_3">交易金额：<input type="text" class="tou_input" name="bet_money" id="bet_money" autocomplete="off" maxlength="5" onkeypress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false"  onkeydown="if(event.keyCode==13)return check_bet();" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" size="8"/></div>
        <div class="touzhu_3">可赢金额：<span id="win_span" class="tou_red">0.00</span><input type="hidden" value="0" name="bet_win" id="bet_win"  /></div>
				<?php
				include_once("cache/group_".@$_SESSION["gid"].".php"); //加载权限组权限
				$ty_zd = @$pk_db['体育最低'];
				if ($ty_zd > 0) {
					$ty_zd = $ty_zd;
				} else {
					$ty_zd = 10;
				}
				?>
		<div class="touzhu_3">最低限额：<span id="min_ty"><?=$ty_zd?></span></div>
        <div class="touzhu_3">单注限额：<span id="max_ds_point_span">0</span></div>
        <div class="touzhu_3">单场最高：<span id="max_cg_point_span">0</span></div>
			<div id="istz" style="display:none; color: #F00; text-align:center; line-height:25px;">
				返还金额：<span id="win_span1">0.00</span><br>是否确定交易？
		    </div> 
        </div><div class="touzhu_8">     
        <div class="quxiao"><input class="toua_2" name="" type="button" onclick="quxiao_bet()" value=""/></div>
        <div class="queren"><input class="toua_1"  id="submitid" name=""  type="submit" value=""/></div>
        <div class="clear"></div>
        </div>
        <div class="menulink_3" ></div> 
        </form>
		</div>
        
		
	</div>
</div>
<script type="text/javascript" language="javascript" src="js/left.js"></script>
<script type="text/javascript" language="javascript" src="skin/js2/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/touzhu.js"></script>
<script type="text/javascript" language="javascript" src="js/left_mouse.js"></script>
<script language="javascript">
	function ResumeError() {
		return true;
	}
	window.onerror = ResumeError; 
</script>
</body>
</html>