<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
include "include/lottery.inc.php";
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$stype = $_REQUEST['stype'];

if(intval($web_site['ssl'])==1)
{
	message('上海时时乐系统维护，暂停下注！');
	exit();
}

if($stype=="" || $stype>6){
	$stype=1;
	}
$sql = "select id,class1,class2,class3,odds,modds,locked from lottery_odds where class1='ssl' and class2='和值' order by ID asc";
$query		=	$mysqli->query($sql);
while ($row = $query->fetch_array()){
$pl=$pl."|".$row['odds'];
}
$plrr=explode("|",$pl);

$tsql = "select * from lottery_t_ssl where kaipan<'2010-06-01 ".$ssc_time."' and fengpan>'2010-06-01 ".$ssc_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <script type="text/javascript">
        if (self == top) { location = '/'; } 
        if (window.location.host != top.location.host) { top.location = window.location; } 
    </script>
    <style type="text/css">
        html{
            margin:0px auto;
        }
        body{
            width:100%;
            padding:0;
            margin:0px auto;
            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            background: #CCCCCA;
        }
		.wrapmain{width:742px; margin:0px auto; padding:0px; padding-top:5px;}
		.left_lottery_bg1{background-color:#900; height:30px; line-height:30px; color:#FF0; font-size:14px; text-align:center;}
		.left_lottery_bg2{background-color:#EDF7F9; height:30px; line-height:30px;text-align:center; border-top:1px #02385A solid;}
		.left_lottery_bg3{background-color:#02385A; height:30px; line-height:30px;text-align:center; border-top:1px #02385A solid; color:#FFF; font-weight:bold;}
		.bottom{
			width: 976px;
			margin: auto;
			background:#244356;
			height:30px;
			border-top:1px solid #FFF;
			color:#FFF;
			line-height:30px;
			padding:0 10px;}
		.bottom span{color:#CCC; float:right;}
		.bet_redbg{ background-color:#900; color:#FFF;cursor:pointer;}
		.bet_bluebg{ background-color:#02385A; color:#FFF;cursor:pointer;}
		.bet_greenbg{ background-color:#060; color:#FFF;cursor:pointer;}
		.bet_heibg{ background-color:#000; color:#FFF;cursor:pointer;}
		.bet_redbg{ background-color:#900; color:#FFF;cursor:pointer;border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.bet_bluebg{ background-color:#02385A; color:#FFF;cursor:pointer;border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.bet_greenbg{ background-color:#060; color:#FFF;cursor:pointer;border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.bet_heibg{ background-color:#000; color:#FF0;cursor:pointer;border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.bet_zibg{ background-color:#639; color:#FFF;cursor:pointer;border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.bet_nobg{ background-color:#CCC;color:#666;cursor:pointer;}
		.six_menu{ padding:0; margin:0; width:503px;}
		.six_menu ul{list-style-type: none;width:501px;height:28px;overflow:hidden;background:url(skin/MenuBG.jpg) 0 0 repeat-x;padding:0;margin:0;float:left; border-top:1px solid #CCE5FC;border-left:1px solid #CCE5FC;border-right:1px solid #CCE5FC;border-bottom:1px solid #011F31;}
		.six_menu li {float:left;background:url(skin/MenuBG.jpg) 0 0 repeat-x;text-align:center;}
		.six_menu li a {display:block;color:#002F4A;line-height:28px;font-weight:bold; width:80px; border-right:1px solid #011F31;}
		.six_menu li a:hover {background:#024467 url(skin/loginbg.gif) no-repeat; font-weight:bold; color:#FFF;}
		.six_menu li.current a{background:#024467 url(skin/loginbg.gif) no-repeat; font-weight:bold; color:#FFF;}
		.mybordertd { border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC; }
		.mybordertable { border-top: 5px solid #CCE5FC; border-left: 5px solid #CCE5FC; }
	</style>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="skin/js/common.js?_=171"></script>
    <script type="text/javascript" src="skin/js/upup.js?_=171"></script>
    <script type="text/javascript" src="skin/js/float.js?_=171"></script>
    <script type="text/javascript" src="skin/js/swfobject.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jquery.cookie.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jingcheng.js?_=171"></script>
    <script type="text/javascript" src="skin/js/top.js?_=171"></script>
    <link href='skin/css/jingcheng.css?_=171' rel="stylesheet" type="text/css" />
    <link href="skin/css/standard.css?_=171" rel="stylesheet" type="text/css" />
	<script src="box/artDialog.js?skin=idialog"></script>
	<script src="box/plugins/iframeTools.js"></script>
	<script language="javascript">
	var xh = new Array() ;
	for(i=0;i<30;i++){
	xh[i]=false;
	}
	var hz = new Array() ;
	for(i=0;i<28;i++){
	hz[i]=false;
	}
	function xh_chk(sb){
	if($(document).find("#username").length == 0){ //没有登录
		alert("登录后才能进行此操作");
		return ;
	}

	<? if($stype==4){?>
	if(sb<=9){
		img=sb;
		type='a';
		}
	if(sb>9 && sb<=19){
		img=sb-10;
		type='h';
		}
	if(sb>19){
		img=sb-20;
		type='c';
		}
	if(eval("xh["+sb+"]")==false){
	if(sb<=9){
		if(eval(xh[sb*1+20*1])==true){
			return false;
			}
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1+20*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		eval("xh["+sb+"]=true");
		}else{
		if(eval(xh[sb*1-20*1])==true){
			return false;
			}
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1-20*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		eval("xh["+sb+"]=true");
	}
	}else{

	if(sb<=9){
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1+20*1).src="images/Lotteyr/bet_"+img+"_c.jpg";
		eval("xh["+sb+"]=false");
		}else{
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1-20*1).src="images/Lotteyr/bet_"+img+"_a.jpg";
		eval("xh["+sb+"]=false");
	}
	}
	<? }elseif($stype==5){?>
	if(sb<=9){
		img=sb;
		type='a';
		}
	if(sb>9 && sb<=19){
		img=sb-10;
		type='b';
		}
	if(sb>19){
		img=sb-20;
		type='c';
		}
	if(eval("xh["+sb+"]")==false){
	if(sb<=9){
		if(eval(xh[sb*1+10*1])==true || eval(xh[sb*1+20*1])==true){
			return false;
			}
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1+20*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		eval("xh["+sb+"]=true");
		}else if(sb>9 && sb<=19){
		if(eval(xh[sb-10])==true || eval(xh[sb*1+10*1])==true){
			return false;
			}
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		eval("xh["+sb+"]=true");
		}else{
		if(eval(xh[sb-10])==true || eval(xh[sb-20])==true){
			return false;
			}
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		document.getElementById(sb*1-20*1).src="images/Lotteyr/bet_"+img+"_h.jpg";
		eval("xh["+sb+"]=true");
	}
	}else{

	if(sb<=9){
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_b.jpg";
		document.getElementById(sb*1+20*1).src="images/Lotteyr/bet_"+img+"_c.jpg";
		eval("xh["+sb+"]=false");
		}else if(sb>9 && sb<=19){
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_a.jpg";
		document.getElementById(sb*1+10*1).src="images/Lotteyr/bet_"+img+"_c.jpg";
		eval("xh["+sb+"]=false");
		}else{
		document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
		document.getElementById(sb*1-10*1).src="images/Lotteyr/bet_"+img+"_b.jpg";
		document.getElementById(sb*1-20*1).src="images/Lotteyr/bet_"+img+"_a.jpg";
		eval("xh["+sb+"]=false");
	}
	}
	<? }else{?>
	if(sb<=9){
		img=sb;
		type='a';
		}
	if(sb>9 && sb<=19){
		img=sb-10;
		type='b';
		}
	if(sb>19){
		img=sb-20;
		type='c';
		}
	if(eval("xh["+sb+"]")==false){
	document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_x.jpg";
	eval("xh["+sb+"]=true");
	}else{
	document.getElementById(sb).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
	eval("xh["+sb+"]=false");
	}
	<? }?>
	var bwsum = 0;
	var bwnum = '';	
	var swsum = 0;
	var swnum = '';	
	var gwsum = 0;
	var gwnum = '';	
	for(i=0;i<30;i++){
	if(i<=9){
		if (eval("xh[" + i + "]") == true){
		bwsum += 1;
		bwnum = bwnum + i +",";
		}
		document.getElementById("bwnums").innerHTML = "百位：" + bwnum;
		}
	if(i>9 && i<=19){
		if (eval("xh[" + i + "]") == true){
		swsum += 1;
		swnum = swnum + (i-10) +",";
		}<? if($stype==4){?>
		document.getElementById("swnums").innerHTML = "十位：" + bwnum;<? }else{?>
		document.getElementById("swnums").innerHTML = "十位：" + swnum;<? }?>
		}
	if(i>19){
		if (eval("xh[" + i + "]") == true){
		gwsum += 1;
		gwnum = gwnum + (i-20) +",";
		}
		document.getElementById("gwnums").innerHTML = "个位：" + gwnum;
		}
	}
	<? if($stype==1){?>
	var classname = "";
	if(bwnum!="" && swnum!="" && gwnum!=""){
		classname = "3D";
		}else if(bwnum!="" && swnum=="" && gwnum==""){
			classname = "1D 百位";
			}else if(bwnum=="" && swnum!="" && gwnum==""){
			classname = "1D 十位";
			}else if(bwnum=="" && swnum=="" && gwnum!=""){
			classname = "1D 个位";
			}else if(bwnum!="" && swnum!="" && gwnum==""){
			classname = "2D 百位 个位";
			}else if(bwnum!="" && swnum=="" && gwnum!=""){
			classname = "2D 百位 个位";
			}else if(bwnum=="" && swnum!="" && gwnum!=""){
			classname = "2D 十位 个位";
			}
	<? }?>
	<? if($stype==2){?>
	var classname = "组一";
	<? }?>
	<? if($stype==3){?>
	var classname = "组二";
	<? }?>
	<? if($stype==4){?>
	var classname = "组三";
	<? }?>
	<? if($stype==5){?>
	var classname = "组六";
	<? }?>
	function addbet(){
		document.getElementById("classnames").innerHTML = classname;
		art.dialog({
		content: document.getElementById('addbets'),
		id: 'adds',
		padding:'0px 0px',
		left:100
	});
		}
	function closeadd(){
		var list = art.dialog.list;
		for (var i in list) {
		list[i].close();
		};
		}
	<? if($stype==1 || $stype==2){?>
	if(bwsum==0 && swsum==0 && gwsum==0){
		closeadd()
		}else{
			closeadd()
			addbet()
			}
	<? }?>
	<? if($stype==3){?>
	if(bwnum=="" || swnum==""){
		closeadd()
		}else{
			closeadd()
			addbet()
			}
	<? }?>
	<? if($stype==4){?>
	if(bwnum=="" || gwnum==""){
		closeadd()
		}else{
			closeadd()
			addbet()
			}
	<? }?>	
	<? if($stype==5){?>
	if(bwnum=="" || swnum=="" || gwnum==""){
		closeadd()
		}else{
			closeadd()
			addbet()
			}
	<? }?>
	}
	function closeadds(){
		var lists = art.dialog.list;
		for (var i in lists) {
		lists[i].close();
		};
		for(i=0;i<30;i++){
			xh[i]=false;
			if(i<=9){
		img=i;
		<? if($stype==1 || $stype==3 || $stype==4 || $stype==5){?>
		type='a';
		<? }?>
		<? if($stype==2){?>
		type='h';
		<? }?>
		}
	if(i>9 && i<=19){
		img=i-10;
		<? if($stype==1 || $stype==2 || $stype==3 || $stype==5){?>
		type='b';
		<? }?>
		<? if($stype==4){?>
		type='h';
		<? }?>
		}
	if(i>19){
		img=i-20;
		<? if($stype==1 || $stype==4 || $stype==5){?>
		type='c';
		<? }?>
		<? if($stype==2 || $stype==3){?>
		type='h';
		<? }?>
		}
	document.getElementById(i).src="images/Lotteyr/bet_"+img+"_"+type+".jpg";
			}
		}
	function addzhbet(){
		if($(document).find("#username").length == 0){ //没有登录
			alert("登录后才能进行此操作");
			return ;
		}
		
		var bwhm = document.getElementById("bwnums").innerHTML;
		var swhm = document.getElementById("swnums").innerHTML;
		var gwhm = document.getElementById("gwnums").innerHTML;
		bwhm = bwhm.replace("百位：","");
		swhm = swhm.replace("十位：","");
		gwhm = gwhm.replace("个位：","");
		closeadds()
		<? if($stype==1){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=1&bw="+bwhm+"&sw="+swhm+"&gw="+gwhm+"",
		<? }?>
		<? if($stype==2){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=2&sw="+swhm+"",
		<? }?>
		<? if($stype==3){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=3&bw="+bwhm+"&sw="+swhm+"",
		<? }?>
		<? if($stype==4){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=4&bw="+bwhm+"&sw="+swhm+"&gw="+gwhm+"",
		<? }?>
		<? if($stype==5){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=5&bw="+bwhm+"&sw="+swhm+"&gw="+gwhm+"",
		<? }?>
		<? if($stype==6){?>
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=6&bw="+bwhm+"",
		<? }?>
		{
			id:'opens',
			lock:true,
			width:900,


			top:0
			}
			);
		}
	function hz_add(id){
		if($(document).find("#username").length == 0){ //没有登录
			alert("登录后才能进行此操作");
			return ;
		}
		
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=7&content="+id+"",
		{
			id:'opens',
			fixed: true,
			lock:true,
			width:300,
			height:200
			}
			);
		}
	function dsdx_add(class3,id){
		if($(document).find("#username").length == 0){ //没有登录
			alert("登录后才能进行此操作");
			return ;
		}
		
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=8&class3="+class3+"&content="+id+"",
		{
			id:'opens',
			fixed: true,
			lock:true,
			width:300,
			height:200
			}
			);
		}
	function kd_add(id){
		if($(document).find("#username").length == 0){ //没有登录
			alert("登录后才能进行此操作");
			return ;
		}
		
		art.dialog.open("buy_lottery/ssl.php?uid=<?=$uid?>&stype=6&content="+id+"",
		{
			id:'opens',
			fixed: true,
			lock:true,
			width:300,
			height:200
			}
			);
		}
	function memberinfo(url){
		art.dialog.open("account/"+url+"?uid=<?=$uid?>",
		{
			id:'memberinfo',
			lock:true
			}


			);
		}
	function lotteryinfo(url){
		art.dialog.open("lottery/"+url+"?uid=<?=$uid?>&stype=3d",
		{
			id:'lotteryinfo',
			lock:true
			}
			);
		}
	</script>
</head>
<body> 
<?php if ($uid) { ?>
<div id="username" style="display:none;"></div>
<?php } ?> 
<div class="wrapmain">
<div style="float:right; width:742px;">
<div style="float:left; width:503px; background-color:#FFF">
<div class="six_menu"><ul>
	<li <? if($stype==1){?>class="current"<? }?>><a href="?stype=1" title="直选投注">直 选</a></li>
	<li <? if($stype==2){?>class="current"<? }?>><a href="?stype=2" title="组一投注">组 一</a></li>
	<li <? if($stype==3){?>class="current"<? }?>><a href="?stype=3" title="组二投注">组 二</a></li>
	<li <? if($stype==4){?>class="current"<? }?>><a href="?stype=4" title="组三投注">组 三</a></li>
	<li <? if($stype==5){?>class="current"<? }?>><a href="?stype=5" title="组六投注">组 六</a></li>
	<li <? if($stype==6){?>class="current"<? }?>><a href="?stype=6" title="跨度投注">跨 度</a></li>
    </ul></div>
<div class="clear"></div>
<? if($stype==1){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_b.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_a.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_s.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_b.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_g.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_c.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
                 <? if($stype==2){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_b.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
              <? if($stype==3){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_a.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_b.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
             <? if($stype==4){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_a.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_c.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
	        <? if($stype==5){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_a.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_b.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_b.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_0_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_1_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_2_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_3_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_4_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_5_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_6_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_7_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_8_c.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" onclick="xh_chk(this.id);" src="images/Lotteyr/bet_9_c.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
           <? if($stype==6){?><table border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="0" onclick="kd_add(this.id);" src="images/Lotteyr/bet_0_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="1" onclick="kd_add(this.id);" src="images/Lotteyr/bet_1_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="2" onclick="kd_add(this.id);" src="images/Lotteyr/bet_2_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="3" onclick="kd_add(this.id);" src="images/Lotteyr/bet_3_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="4" onclick="kd_add(this.id);" src="images/Lotteyr/bet_4_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="5" onclick="kd_add(this.id);" src="images/Lotteyr/bet_5_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="6" onclick="kd_add(this.id);" src="images/Lotteyr/bet_6_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="7" onclick="kd_add(this.id);" src="images/Lotteyr/bet_7_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="8" onclick="kd_add(this.id);" src="images/Lotteyr/bet_8_a.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="9" onclick="kd_add(this.id);" src="images/Lotteyr/bet_9_a.jpg" style="cursor:pointer;"/></td>
  </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="10" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="11" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="12" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="13" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="14" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="15" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="16" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="17" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="18" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="19" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 <tr>
                   <td align="center" bgcolor="#000000" class="mybordertd"><img src="images/Lotteyr/bet_k.jpg"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="20" src="images/Lotteyr/bet_0_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="21" src="images/Lotteyr/bet_1_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="22" src="images/Lotteyr/bet_2_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="23" src="images/Lotteyr/bet_3_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="24" src="images/Lotteyr/bet_4_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="25" src="images/Lotteyr/bet_5_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="26" src="images/Lotteyr/bet_6_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="27" src="images/Lotteyr/bet_7_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="28" src="images/Lotteyr/bet_8_h.jpg" style="cursor:pointer;"/></td>
                   <td width="40" align="center" bgcolor="#000000" class="mybordertd"><img id="29" src="images/Lotteyr/bet_9_h.jpg" style="cursor:pointer;"/></td>
                 </tr>
                 </table><? }?>
<div class="line5"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCE5FC" class="mybordertable">
                   <tr>
                     <td height="25" colspan="7" align="center" class="bet_heibg"><font color="#FFFFFF">和 值</font></td>
                   </tr>
                   <tr>
                     <td width="66" height="25" align="center" class="bet_zibg" onClick="hz_add('0');">0</td>
                     <td width="66" align="center" class="bet_zibg" onClick="hz_add('4');">4</td>
                     <td width="65" align="center" class="bet_zibg" onClick="hz_add('8');">8</td>
                     <td width="66" align="center" class="bet_zibg" onClick="hz_add('12');">12</td>
                     <td width="65" align="center" class="bet_zibg" onClick="hz_add('16');">16</td>
                     <td width="66" align="center" class="bet_zibg" onClick="hz_add('20');">20</td>
                     <td width="66" align="center" class="bet_zibg" onClick="hz_add('24');">24</td>
                   </tr>
                   <tr>
                     <td height="25" align="center" class="bet_zibg" onClick="hz_add('1');">1</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('5');">5</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('9');">9</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('13');">13</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('17');">17</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('21');">21</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('25');">25</td>
                   </tr>
                   <tr>
                     <td height="25" align="center" class="bet_zibg" onClick="hz_add('2');">2</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('6');">6</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('10');">10</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('14');">14</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('18');">18</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('22');">22</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('26');">26</td>
                   </tr>
                   <tr>
                     <td height="25" align="center" class="bet_zibg" onClick="hz_add('3');">3</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('7');">7</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('11');">11</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('15');">15</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('19');">19</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('23');">23</td>
                     <td align="center" class="bet_zibg" onClick="hz_add('27');">27</td>
                   </tr>
                   <tr>
                     <td height="25" align="center" onClick="hz_add('0,1,2,3');" class="bet_zibg">X<?=number_format($plrr[29],2)?></td>
                     <td align="center" onClick="hz_add('4,5,6,7');" class="bet_zibg">X<?=number_format($plrr[30],2)?></td>
                     <td align="center" onClick="hz_add('8,9,10,11');" class="bet_zibg">X<?=number_format($plrr[31],2)?></td>
                     <td align="center" onClick="hz_add('12,13,14,15');" class="bet_zibg">X<?=number_format($plrr[32],2)?></td>
                     <td align="center" onClick="hz_add('16,17,18,19');" class="bet_zibg">X<?=number_format($plrr[33],2)?></td>
                     <td align="center" onClick="hz_add('20,21,22,23');" class="bet_zibg">X<?=number_format($plrr[34],2)?></td>
                     <td align="center" onClick="hz_add('24,25,26,27');" class="bet_zibg">X<?=number_format($plrr[35],2)?></td>
                   </tr>
                 </table>
<div class="line5"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCE5FC" class="mybordertable">
  <tr>
    <td height="25" colspan="5" align="center" class="bet_heibg"><font color="#FFFFFF">单 双 大 小</font></td>
  </tr>
  <tr>
    <td width="20%" height="25" align="center" class="bet_redbg">百位</td>
    <td width="20%" align="center" class="bet_redbg" onClick="dsdx_add('百位','DAN')">单</td>
    <td width="20%" align="center" class="bet_redbg" onClick="dsdx_add('百位','SHUANG')">双</td>
    <td width="20%" align="center" class="bet_redbg" onClick="dsdx_add('百位','DA')">大</td>
    <td width="20%" align="center" class="bet_redbg" onClick="dsdx_add('百位','XIAO')">小</td>
    </tr>
  <tr>
    <td height="25" align="center" class="bet_bluebg">十位</td>
    <td align="center" class="bet_bluebg" onClick="dsdx_add('十位','DAN')">单</td>
    <td align="center" class="bet_bluebg" onClick="dsdx_add('十位','SHUANG')">双</td>
    <td align="center" class="bet_bluebg" onClick="dsdx_add('十位','DA')">大</td>
    <td align="center" class="bet_bluebg" onClick="dsdx_add('十位','XIAO')">小</td>
    </tr>
  <tr>
    <td height="25" align="center" class="bet_greenbg">个位</td>
    <td align="center" class="bet_greenbg" onClick="dsdx_add('个位','DAN')">单</td>
    <td align="center" class="bet_greenbg" onClick="dsdx_add('个位','SHUANG')">双</td>
    <td align="center" class="bet_greenbg" onClick="dsdx_add('个位','DA')">大</td>
    <td align="center" class="bet_greenbg" onClick="dsdx_add('个位','XIAO')">小</td>
    </tr>
  <tr>
    <td height="25" align="center" class="bet_zibg">和值</td>
    <td align="center" class="bet_zibg" onClick="hz_add('DAN');">单</td>
    <td align="center" class="bet_zibg" onClick="hz_add('SHUANG');">双</td>
    <td align="center" class="bet_zibg" onClick="hz_add('DA');">大</td>
    <td align="center" class="bet_zibg" onClick="hz_add('XIAO');">小</td>
    </tr>
  </table>
</div>
<div style="float:right; width:235px;">
<div style="background-color:#CCE5FC; padding:5px;">
<div class="left_lottery_bg1"><? if($tcou>0){?>上海时时乐第 <font color="#00FF00"><?=$ssc_date.$trow['qihao']?></font> 期<? }else{?>期数未开盘<? }?></div>
<div class="left_lottery_bg2"><? if($tcou>0){?>北京时间：<?=bjssc($trow['fengpan'])?><? }else{?>北京时间：暂停下注<? }?></div>
<div class="left_lottery_bg2"><? if($tcou>0){?>美东时间：<?=mdssc($trow['fengpan'])?><? }else{?>美东时间：暂停下注<? }?></div>
<div class="left_lottery_bg3"><? if($tcou>0){?>
<span id="endtime" style="color:#FFF; font-weight:bold;"><?=strtotime(bjssc($trow['fengpan']))-strtotime($l_time)?></span>
<script type="text/javascript">
var CID = "endtime";
if(window.CID != null)
{
    var iTime = document.getElementById(CID).innerText;
    var Account;
    RemainTime();
}
function RemainTime()
{
    var iDay,iHour,iMinute,iSecond;
    var sDay="",sHour="",sMinute="",sSecond="",sTime="";
    if (iTime >= 0)
    {
        iDay = parseInt(iTime/24/3600);
        if (iDay > 0 && iDay < 10)
        {
            sDay = "0" +iDay + "天";
        }
		if (iDay > 10)
        {
            sDay = iDay + "天";
        }
        iHour = parseInt((iTime/3600)%24);
        if (iHour > 0 && iHour < 10){
            sHour = "0" + iHour + "小时";
        }
		if (iHour > 10){
            sHour = iHour + "小时";
        }
        iMinute = parseInt((iTime/60)%60);
        if (iMinute > 0 && iMinute < 10){
            sMinute = "0" + iMinute + "分钟";
        }
		if (iMinute > 10){
            sMinute = iMinute + "分钟";
        }
        iSecond = parseInt(iTime%60);
        if (iSecond >= 0 && iSecond <10 ){
            sSecond = "0" +iSecond + "秒";
        }
		if (iSecond >= 10 ){
            sSecond = iSecond + "秒";
        }
        if ((sDay=="")&&(sHour=="")){
            sTime="距离封盘：" + sMinute+sSecond + "";
        }
        else
        {
            sTime="距离封盘：" + sDay+sHour+sMinute+sSecond;
        }
        if(iTime==0){
            clearTimeout(Account);
              sTime="本期已经封盘，即将开始下一期";			  
        }
		if(iTime==-5){
            clearTimeout(Account);
              sTime="开始下一期";
        }
        else
        {
            Account = setTimeout("RemainTime()",1000);
        }
        iTime=iTime-1;
    }
    else
    {
            sTime="开始下一期";
			alert('本期投注已结束，点击开始下一期投注!');window.location.reload();
    }
    document.getElementById(CID).innerHTML = sTime;
}
</script><? }else{?>-<? }?></div>
</div>
<div class="clear" style="margin-top:8px;"></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#CCE5FC" class="mybordertable">
           <tr style="color:#FF0">
             <td height="25" align="center" bgcolor="#000000" class="mybordertd">开奖期数</td>
             <td align="center" bgcolor="#000000" class="mybordertd">百</td>
             <td align="center" bgcolor="#000000" class="mybordertd">十</td>
             <td align="center" bgcolor="#000000" class="mybordertd">个</td>
             <td align="center" bgcolor="#000000" class="mybordertd">和值</td>
           </tr>
<?
$sqlk = "select * from lottery_k_ssl where ok=1 order by id desc limit 10";
$resultk = $mysqli->query($sqlk);
while ($rowk = $resultk->fetch_array()){
$hmhz=$rowk['hm1']+$rowk['hm2']+$rowk['hm3'];
if ($hmhz>13){
$hzdx="大";
}else{
$hzdx="小";
}
if ($hmhz % 2==0){
$hzds="双";
}else{
$hzds="单";
}
?>
           <tr style="color:#FFF;">
             <td height="25" align="center" bgcolor="#230000" class="mybordertd"><?=$rowk['qihao']?></td>
             <td align="center" bgcolor="#230000" class="mybordertd"><?=$rowk['hm1']?></td>
             <td align="center" bgcolor="#230000" class="mybordertd"><?=$rowk['hm2']?></td>
             <td align="center" bgcolor="#230000" class="mybordertd"><?=$rowk['hm3']?></td>
             <td align="center" bgcolor="#230000" class="mybordertd"><?=$hzdx?><?=$hzds?></td>
           </tr>
<?
}
?>
           </table>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div id="addbets" style="display:none; width:300px; height:200px; background-image:url(/images/Lotteyr/kk_dd_bg.jpg)">
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" id="classnames" style=" font-size:14px; font-weight:bold; color:#900;padding:5px;">玩法</td>
      </tr>
      <tr>
        <td style="padding:5px;">注单内容：</td>
      </tr>
      <tr>
        <td style="border-bottom:1px #000 solid;padding:5px;" id="bwnums">百位：</td>
      </tr>
      <tr>
        <td style="border-bottom:1px #000 solid;padding:5px;" id="swnums">十位：</td>
      </tr>
      <tr>
        <td style="border-bottom:1px #000 solid;padding:5px;" id="gwnums">个位：</td>
      </tr>
      <tr>
        <td align="center" style="padding:5px;"><img onClick="closeadds();" src="/images/Lotteyr/buy_1.jpg"> <img onClick="addzhbet();" src="/images/Lotteyr/buy_3.jpg"></td>
      </tr>
    </table>
</div>
</body>
</html>
