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

if(intval($web_site['kl8'])==1)
{
	message('北京快乐8系统维护，暂停下注！');
	exit();
}

if($stype=="" || $stype>6){
	$stype=1;
	}
$sql = "select id,class1,class2,class3,odds,modds,locked from lottery_odds where class1='kl8' order by ID asc";
$query		=	$mysqli->query($sql);
while ($row = $query->fetch_array()){
$pl=$pl."|".$row['odds'];
}
$plrr=explode("|",$pl);

$tsql = "select * from lottery_k_kl8 where kaipan<'".$l_time."' and fengpan>'".$l_time."'";
$tresult = $mysqli->query($tsql);
$trow = $tresult->fetch_array();
$tcou = $mysqli->affected_rows;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
		.left_lottery_bg1 a{background-color:#900; height:30px; line-height:30px; color:#FF0; font-size:14px; text-align:center;text-decoration: none;}
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
		.bet_redbg span{ float:right; color:#FF0;}
		.bet_bluebg span{ float:right; color:#FF0;}
		.bet_greenbg span{ float:right; color:#FF0;}
		.bet_heibg span{ float:right; color:#FF0;}
		.six_menu{ padding:0; margin:0; width:742px;}
		.six_menu ul{list-style-type: none;width:740px;height:28px;overflow:hidden;background:url(skin/MenuBG.jpg) 0 0 repeat-x;padding:0;margin:0;float:left; border-top:1px solid #CCE5FC;border-left:1px solid #CCE5FC;border-right:1px solid #CCE5FC;border-bottom:1px solid #011F31;}
		.six_menu li {float:left;background:url(skin/MenuBG.jpg) 0 0 repeat-x;text-align:center;}
		.six_menu li a {display:block;color:#002F4A;line-height:28px;font-weight:bold; width:80px; border-right:1px solid #011F31;}
		.six_menu li a:hover {background:#024467 url(skin/loginbg.gif) no-repeat; font-weight:bold; color:#FFF;}
		.six_menu li.current a{background:#024467 url(skin/loginbg.gif) no-repeat; font-weight:bold; color:#FFF;}
		.ltype_ok{ width:190px; height:30px; line-height:30px; margin-top:5px;}
		.ltype_ok ul{ padding:0; margin:0; float:left; text-align:center;}
		.ltype_ok ul li{ width:190px;height:30px;list-style-type:none;background-color:#333;}
		.ltype_ok ul li a{ color:#FFF; font-weight:bold}
		.ltype_ok ul li a:hover{ color:#F00;font-weight:bold}
		.ltype_ok ul li .current {color:#F00;}
		.klb_bg{ font-size:16px; font-weight:bold;cursor:pointer; color:#FFF; border-right: 5px solid #CCE5FC; border-bottom: 5px solid #CCE5FC;}
		.klb_bg span{ font-size:14px; color: #FF0;}
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
	var num = new Array() ;
	for(i=1;i<81;i++){
	num[i]=false;
	}
	function img_chk(sb){
	if($(document).find("#username").length == 0){ //没有登录
		alert("登录后才能进行此操作");
		return ;
	}

	if(eval("num["+sb+"]")==false){
	var ddsum = 0;
	for(i=1;i<81;i++){
		if (eval("num[" + i + "]") == true){
			ddsum += 1;
		}
	}
	if (ddsum>4){
	alert("最多選擇5個號碼!");
	return false;
	}else{
	document.getElementById(sb).bgColor="#990000";
	document.getElementById(sb).style.color="#ffffff";
	eval("num["+sb+"]=true");}
	}else{
	document.getElementById(sb).bgColor="#02385A";
	document.getElementById(sb).style.color="#ffffff";
	eval("num["+sb+"]=false");
	}
	var hmsum = 0;
	var hmnum = '';	
	for(i=1;i<81;i++){
		if (eval("num[" + i + "]") == true){
			hmsum += 1;
			hmnum = hmnum + i +",";
		}
		document.getElementById("hmnums").innerHTML = hmnum;
	}
	var classname = "";
	if(hmsum==1){
		classname = "選1";
		oddsname = "中1賠率：<font color='#FF0000'><?=$plrr[1]?></font>";
		}else if(hmsum==2){
			classname = "選2";
			oddsname = "中2賠率：<font color='#FF0000'><?=$plrr[2]?></font>";
			}else if(hmsum==3){
			classname = "選3";
			oddsname = "中2賠率：<font color='#FF0000'><?=$plrr[3]?></font> 中3賠率：<font color='#FF0000'><?=$plrr[4]?></font>";
			}else if(hmsum==4){
			classname = "選4";
			oddsname = "中2賠率：<font color='#FF0000'><?=$plrr[5]?></font> 中3賠率：<font color='#FF0000'><?=$plrr[6]?></font> 中4賠率：<font color='#FF0000'><?=$plrr[7]?></font>";
			}else if(hmsum==5){
			classname = "選5";
			oddsname = "中3賠率：<font color='#FF0000'><?=$plrr[8]?></font> 中4賠率：<font color='#FF0000'><?=$plrr[9]?></font> 中5賠率：<font color='#FF0000'><?=$plrr[10]?></font>";
			}else{
			classname = "未知";
			}
	function addbet(){
		document.getElementById("classnames").innerHTML = classname;
		document.getElementById("oddsnames").innerHTML = oddsname;
		art.dialog({
		content: document.getElementById('addbets'),
		id: 'adds',
		padding:'0px 0px',
		left:100
	});
		}
	if(hmsum==0){
		closeadd()
		}else if(hmsum<6){
			closeadd()
			addbet()
			}
	}
	function closeadd(){
		var list = art.dialog.list;
		for (var i in list) {
		list[i].close();
		};
		}
	function closeadds(){
		var lists = art.dialog.list;
		for (var i in lists) {
		lists[i].close();
		};
		for(i=1;i<81;i++){
			num[i]=false;
			document.getElementById(i).bgColor="#02385A";
			document.getElementById(i).style.color="#ffffff";
			}
		}
	function addzhbet(){
		var hms = document.getElementById("hmnums").innerHTML;
		closeadds()
		art.dialog.open("buy_lottery/kl8.php?uid=<?=$uid?>&stype=1&hm="+hms+"",
		{
			id:'opens',
			lock:true,
			width:300,
			height:200
			}
			);
		}
	function addbet(class2,class3){
		if($(document).find("#username").length == 0){ //没有登录
			alert("登录后才能进行此操作");
			return ;
		}

		art.dialog.open("buy_lottery/kl8.php?uid=<?=$uid?>&stype=2&class2="+class2+"&class3="+class3+"",
		{
			id:'opens',
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
		art.dialog.open("lottery/"+url+"?uid=<?=$uid?>&stype=kl8",
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
<div style="background-color:#CCE5FC; padding:5px;">
<div class="left_lottery_bg1"><? if($tcou>0){?>北京快乐8第 <font color="#00FF00"><?=$trow['qihao']?></font> 期<? }else{?>期数未开盘<? }?></div>
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
<table class="mybordertable" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" style="color:#FFF;">
 <tr>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="1" onClick="img_chk(this.id);" style="cursor:pointer;">01</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="2" onClick="img_chk(this.id);" style="cursor:pointer;">02</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="3" onClick="img_chk(this.id);" style="cursor:pointer;">03</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="4" onClick="img_chk(this.id);" style="cursor:pointer;">04</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="5" onClick="img_chk(this.id);" style="cursor:pointer;">05</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="6" onClick="img_chk(this.id);" style="cursor:pointer;">06</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="7" onClick="img_chk(this.id);" style="cursor:pointer;">07</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="8" onClick="img_chk(this.id);" style="cursor:pointer;">08</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="9" onClick="img_chk(this.id);" style="cursor:pointer;">09</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="10" onClick="img_chk(this.id);" style="cursor:pointer;">10</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="11" onClick="img_chk(this.id);" style="cursor:pointer;">11</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="12" onClick="img_chk(this.id);" style="cursor:pointer;">12</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="13" onClick="img_chk(this.id);" style="cursor:pointer;">13</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="14" onClick="img_chk(this.id);" style="cursor:pointer;">14</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="15" onClick="img_chk(this.id);" style="cursor:pointer;">15</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="16" onClick="img_chk(this.id);" style="cursor:pointer;">16</td>
 </tr>
 <tr>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="17" onClick="img_chk(this.id);" style="cursor:pointer;">17</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="18" onClick="img_chk(this.id);" style="cursor:pointer;">18</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="19" onClick="img_chk(this.id);" style="cursor:pointer;">19</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="20" onClick="img_chk(this.id);" style="cursor:pointer;">20</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="21" onClick="img_chk(this.id);" style="cursor:pointer;">21</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="22" onClick="img_chk(this.id);" style="cursor:pointer;">22</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="23" onClick="img_chk(this.id);" style="cursor:pointer;">23</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="24" onClick="img_chk(this.id);" style="cursor:pointer;">24</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="25" onClick="img_chk(this.id);" style="cursor:pointer;">25</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="26" onClick="img_chk(this.id);" style="cursor:pointer;">26</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="27" onClick="img_chk(this.id);" style="cursor:pointer;">27</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="28" onClick="img_chk(this.id);" style="cursor:pointer;">28</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="29" onClick="img_chk(this.id);" style="cursor:pointer;">29</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="30" onClick="img_chk(this.id);" style="cursor:pointer;">30</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="31" onClick="img_chk(this.id);" style="cursor:pointer;">31</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="32" onClick="img_chk(this.id);" style="cursor:pointer;">32</td>
 </tr>
 <tr>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="33" onClick="img_chk(this.id);" style="cursor:pointer;">33</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="34" onClick="img_chk(this.id);" style="cursor:pointer;">34</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="35" onClick="img_chk(this.id);" style="cursor:pointer;">35</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="36" onClick="img_chk(this.id);" style="cursor:pointer;">36</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="37" onClick="img_chk(this.id);" style="cursor:pointer;">37</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="38" onClick="img_chk(this.id);" style="cursor:pointer;">38</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="39" onClick="img_chk(this.id);" style="cursor:pointer;">39</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="40" onClick="img_chk(this.id);" style="cursor:pointer;">40</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="41" onClick="img_chk(this.id);" style="cursor:pointer;">41</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="42" onClick="img_chk(this.id);" style="cursor:pointer;">42</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="43" onClick="img_chk(this.id);" style="cursor:pointer;">43</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="44" onClick="img_chk(this.id);" style="cursor:pointer;">44</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="45" onClick="img_chk(this.id);" style="cursor:pointer;">45</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="46" onClick="img_chk(this.id);" style="cursor:pointer;">46</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="47" onClick="img_chk(this.id);" style="cursor:pointer;">47</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="48" onClick="img_chk(this.id);" style="cursor:pointer;">48</td>
 </tr>
 <tr>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="49" onClick="img_chk(this.id);" style="cursor:pointer;">49</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="50" onClick="img_chk(this.id);" style="cursor:pointer;">50</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="51" onClick="img_chk(this.id);" style="cursor:pointer;">51</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="52" onClick="img_chk(this.id);" style="cursor:pointer;">52</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="53" onClick="img_chk(this.id);" style="cursor:pointer;">53</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="54" onClick="img_chk(this.id);" style="cursor:pointer;">54</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="55" onClick="img_chk(this.id);" style="cursor:pointer;">55</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="56" onClick="img_chk(this.id);" style="cursor:pointer;">56</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="57" onClick="img_chk(this.id);" style="cursor:pointer;">57</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="58" onClick="img_chk(this.id);" style="cursor:pointer;">58</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="59" onClick="img_chk(this.id);" style="cursor:pointer;">59</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="60" onClick="img_chk(this.id);" style="cursor:pointer;">60</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="61" onClick="img_chk(this.id);" style="cursor:pointer;">61</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="62" onClick="img_chk(this.id);" style="cursor:pointer;">62</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="63" onClick="img_chk(this.id);" style="cursor:pointer;">63</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="64" onClick="img_chk(this.id);" style="cursor:pointer;">64</td>
 </tr>
 <tr>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="65" onClick="img_chk(this.id);" style="cursor:pointer;">65</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="66" onClick="img_chk(this.id);" style="cursor:pointer;">66</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="67" onClick="img_chk(this.id);" style="cursor:pointer;">67</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="68" onClick="img_chk(this.id);" style="cursor:pointer;">68</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="69" onClick="img_chk(this.id);" style="cursor:pointer;">69</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="70" onClick="img_chk(this.id);" style="cursor:pointer;">70</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="71" onClick="img_chk(this.id);" style="cursor:pointer;">71</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="72" onClick="img_chk(this.id);" style="cursor:pointer;">72</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="73" onClick="img_chk(this.id);" style="cursor:pointer;">73</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="74" onClick="img_chk(this.id);" style="cursor:pointer;">74</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="75" onClick="img_chk(this.id);" style="cursor:pointer;">75</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="76" onClick="img_chk(this.id);" style="cursor:pointer;">76</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="77" onClick="img_chk(this.id);" style="cursor:pointer;">77</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="78" onClick="img_chk(this.id);" style="cursor:pointer;">78</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="79" onClick="img_chk(this.id);" style="cursor:pointer;">79</td>
   <td class="mybordertd" height="22" align="center" bgcolor="#02385A" id="80" onClick="img_chk(this.id);" style="cursor:pointer;">80</td>
 </tr>
</table>
<div class="line5"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
<tr>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('HEZHI','DA');">和值大<span>x<?=$plrr[11]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('HEZHI','XIAO');">和值小<span>x<?=$plrr[12]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('HEZHI','810');">和值810<span>x<?=$plrr[13]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('HEZHI','DAN');">和值单<span>x<?=$plrr[14]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('HEZHI','SHUANG');">和值双<span>x<?=$plrr[15]?></span></td>
</tr>
</table>
<div class="line5"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" class="mybordertable">
<tr>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('JIHEOU','JI');">奇盘<span>x<?=$plrr[19]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('JIHEOU','HE');">和盘<span>x<?=$plrr[20]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('JIHEOU','OU');">偶盘<span>x<?=$plrr[21]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('SHANGZHONGXIA','SHANG');">上盘<span>x<?=$plrr[16]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('SHANGZHONGXIA','ZHONG');">中盘<span>x<?=$plrr[17]?></span></td>
<td height="35" align="center" bgcolor="#000000" class="klb_bg" onClick="addbet('SHANGZHONGXIA','XIA');">下盘<span>x<?=$plrr[18]?></span></td>
</tr>
</table>

<div class="clear"></div>
</div>
 	<div class="clear"></div>

<div id="addbets" style="display:none; width:300px; height:200px; background-image:url(/images/Lotteyr/kk_dd_bg.jpg)">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center" id="classnames" style=" font-size:14px; font-weight:bold; color:#900;padding:5px;">玩法</td>
      </tr>
      <tr>
        <td style="padding:5px;">注單內容：</td>
      </tr>
      <tr>
        <td style="border-bottom:1px #000 solid;padding:5px;" id="hmnums"></td>
      </tr>
      <tr>
        <td style="border-bottom:1px #000 solid;padding:5px;" id="oddsnames"></td>
      </tr>
      <tr>
        <td align="center" style="padding:5px;"><img onClick="closeadds();" src="/images/Lotteyr/buy_1.jpg"> <img onClick="addzhbet();" src="/images/Lotteyr/buy_3.jpg"></td>
      </tr>
    </table>
</div>
</body>
</html>
