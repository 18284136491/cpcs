<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

//exit;
$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://cp.360.cn/");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://cp.360.cn/sscjx/?menu&r_a=bAfQ3a");
//echo $html_data;
$reg='/<div class="mod-aside mod-aside-xssckj">[\s\S]*?id="open_issue">(\d+)<\/em>[\s\S]*?((?:<li class=".*?">\d+<\/li> ){5})[\s\S]*?<\/ul>/';
preg_match_all($reg,$html_data,$arr);
//print_r($arr);
$i=1;
if($arr[2][0]){
	$qishu		= date('Y').$arr[1][0];
	$qishunum 	= substr($qishu,-3);
	//echo $arr[2][0];
	preg_match_all('/<li class=".*?">(\d+)<\/li>[\s\S]*?/',$arr[2][0],$tempNum);
	//print_r($tempNum);exit;
	$num1		= $tempNum[1][0];
	$num2		= $tempNum[1][1];
	$num3		= $tempNum[1][2];
	$num4		= $tempNum[1][3];
	$num5		= $tempNum[1][4];
	$time 		=  $arr['l_d'];
	$time =date('Y-m-d H:i:s',strtotime($time));
	//echo $qishu."<br>";
	if(strlen($qishu)>0 && $num1<10 && $num2<10 && $num3<10 && $num4<10 && $num5<10){
		if($i==1){
			$ball_1=$num1;$ball_2=$num2;$ball_3=$num3;$ball_4=$num4;$ball_5=$num5;
		}
		$sql="select id from c_auto_7 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql 	= "select kaijiang from `c_opentime_7` where qishu='".intval($qishunum)."'";
			//echo $sql;
			$query 	= $mysqli->query($sql);
			$rs		= $query->fetch_array();
			//$time   = "20$Y-$M-$D ".$rs['kaijiang'];
			$sql 	= "insert into c_auto_7(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5')";
			
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
      江西时时彩<br>采集到<?=$m?>期(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_7.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>