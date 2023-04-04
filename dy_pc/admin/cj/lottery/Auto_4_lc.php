<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");
function ob2ar($obj) {
    if(is_object($obj)) {
        $obj = (array)$obj;
        $obj = ob2ar($obj);
    } elseif(is_array($obj)) {
        foreach($obj as $key => $value) {
            $obj[$key] = ob2ar($value);
        }
    }
    return $obj;
}
$is_js=0;
$curl = &new Curl_HTTP_Client();
$html_data = $curl->fetch_url("http://baidu.lecai.com/lottery/draw/view/557");
		//获取开奖数据
		preg_match_all("/latest_draw_result = \{(.+?)\}/is",$html_data,$t);
		$temp = (str_replace("latest_draw_result = ","",$t[0][0]));
		$ball_1=(substr($temp,9,2));
		$ball_2=(substr($temp,14,2));
		$ball_3=(substr($temp,19,2));
		$ball_4=(substr($temp,24,2));
		$ball_5=(substr($temp,29,2));
		$ball_6=(substr($temp,34,2));
		$ball_7=(substr($temp,39,2));
		$ball_8=(substr($temp,44,2));
		$ball_9=(substr($temp,49,2));
		$ball_10=(substr($temp,54,2));
		//获取时间数据
		preg_match_all("/latest_draw_time = \'(.+?)\'/is",$html_data,$t);
		$time = $t[1][0];
		
		//获取开奖期数
		preg_match_all("/latest_draw_phase = \'(.+?)\'/is",$html_data,$t);
		$qishu = $t[1][0];


	if(strlen($qishu)>0 && is_numeric($ball_1)){
		$is_js=1;
		$sql="select id from c_auto_4 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$sql	=	"insert into c_auto_4(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5','$ball_6','$ball_7','$ball_8','$ball_9','$ball_10')";
			//echo $sql."<br>";
			$mysqli->query($sql);
			$m=$m+1;
		}else{
			$usql="update c_auto_4 set ball_1=$ball_1,ball_2=$ball_2,ball_3=$ball_3,ball_4=$ball_4,ball_5=$ball_5,ball_6=$ball_6,ball_7=$ball_7,ball_8=$ball_8,ball_9=$ball_9,ball_10=$ball_10,datetime='".$time."' where qishu='".$qishu."'";
			//echo $usql."<br>";
			$mysqli->query($usql);
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
var limit="10" 
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
      北京赛车PK拾<br>(<?=$qishu?>期:<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5,$ball_6,$ball_7,$ball_8,$ball_9,$ball_10"?>)<br><span id="timeinfo"></span>
	  </td>
      
  </tr>
</table>
<? if($is_js){?>
<iframe src="js_4.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<? }?>
</body>
</html>