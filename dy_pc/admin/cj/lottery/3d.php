<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

$curl = new Curl_HTTP_Client();
$curl->set_referrer("http://www.1680180.com/lottery/2002.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=2002&_=0.3424344145450467");
$a=array('(',')');
$b=array('[',']');

$msg = str_replace($a,$b,$html_data);
$msg = preg_replace('/("l_t":)(\d{9,})/i', '${1}"${2}"', $msg);
//echo $msg;
	$arr= json_decode($msg,true);
//var_dump($arr);

$i=1;
if($arr['l_r']){

	$qishu		= $arr['l_t'];
	$tempNum=explode(",",$arr['l_r']);
	$num1		= $tempNum[0];
	$num2		= $tempNum[1];
	$num3		= $tempNum[2];
	//echo $qishu."<br>";
	if(strlen($qishu)>0){
		if($i==1){
			$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;
		}
		$sql="select id from c_auto_9 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql 	= "select kaijiang from `c_opentime_9` where qishu='1'";
			//echo $sql;
			$query 	= $mysqli->query($sql);
			$rs		= $query->fetch_array();
			$time   = date("Y-m-d ").$rs['kaijiang'];
			$sql 	= "insert into c_auto_9(qishu,datetime,ball_1,ball_2,ball_3) values ('$qishu','$time','$num1','$num2','$num3')";
			
			$mysqli->query($sql);
			
		}
		$m=$m+1;
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
      3D<br>采集到<?=$m?>期(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_9.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>