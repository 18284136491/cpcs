<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.1396b.com/shishicai/");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.1396b.com/shishicai/ajax?ajaxhandler=GetCqsscAwardData&t=0.5839603158047366");
$arr= json_decode($html_data,true);
//print_r($arr);
$i=1;
$is_js=0;
if($arr['current']['awardNumbers']){
	$v=explode(",",$arr['current']['awardNumbers']);
	$time 		=  $arr['current']['awardTime'];
	$qishu		=$arr['current']['periodDate'];
	$ball_1		= $v[0];
	$ball_2		= $v[1];
	$ball_3		= $v[2];
	$ball_4		= $v[3];
	$ball_5		= $v[4];
	
	if(strlen($qishu)>0){
		$is_js=1;
		$sql="select id from c_auto_2 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql	=	"insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5')";
			$mysqli->query($sql) or die("error add");
			$m=$m+1;
		}else{
			$usql="update c_auto_2 set ball_1=$ball_1,ball_2=$ball_2,ball_3=$ball_3,ball_4=$ball_4,ball_5=$ball_5,datetime='".$time."' where qishu='".$qishu."'";
			$mysqli->query($usql) or die("error update");
		}
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
<? $limit= rand(10,50);?>
var limit="<?=$limit?>" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      重庆时时彩票<br>(<?=$qishu?>期:<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<? if($is_js){?>
<iframe src="js_2.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<? }?>
</body>
</html>