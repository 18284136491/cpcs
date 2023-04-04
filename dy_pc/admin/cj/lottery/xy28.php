<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

$curl = &new Curl_HTTP_Client();
$curl->set_referrer("http://www.pc558.com");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.pc558.com/pc28/");
preg_match_all('|<li class=\"kj_white_line\">(\d+?)期[\s\S]+?<b>(\d)\+(\d)\+(\d) = <span style=\"color:red\">(\d+?)</span></b></li>|', $html_data, $html_arr);

//print_r($html_arr);exit;
$m=0;
$i=1;
foreach($html_arr[1] as $key=>$val){
	$addtime 		= date('Y-m-d H:i:s',time()+1*12*3600);
	$qihao		= $val;
	if(strlen($qihao)>0){	
		$hm28_1=$html_arr[2][$key];
		$hm28_2=$html_arr[3][$key];
		$hm28_3=$html_arr[4][$key];
		$hm28_4=$html_arr[5][$key];
		if($i==1){
			$dqihao=$qihao;
			$dhm28_1=$hm28_1;$dhm28_2=$hm28_2;$dhm28_3=$hm28_3;$dhm28_4=$hm28_4;
		}
		$i++;
		//开始幸运28写入号码
		$sql="select id from c_auto_12 where qishu='".$qihao."' ";
		//echo $sql;
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$time   = $addtime;
			$sql 	= "insert into c_auto_12(qishu,datetime,ball_1,ball_2,ball_3,ball_4) values ('$qihao','$time','$hm28_1','$hm28_2','$hm28_3','$hm28_4')";
			//echo $sql;
			$mysqli->query($sql);
			
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
<? $limit= rand(8,15);?>
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
<table width="100%"border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()"><br>
      
      幸运28<br>(<?=$dqihao?>期:<?="$dhm28_1+$dhm28_2+$dhm28_3=$dhm28_4"?>)<br>
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="Js_12.php?qi=<?=$qihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>