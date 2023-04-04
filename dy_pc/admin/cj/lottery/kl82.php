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
$curl = new Curl_HTTP_Client();
$curl->set_referrer("http://www.1680180.com/lottery/10014.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=10014");

$arr= json_decode($html_data,true);
//echo $datetime;
$m=0;
$i=1;

if(is_array($arr['list'])) {
	foreach($arr['list'] as $val){
		$v=explode(",",$val['c_r']);
		array_splice($v,-1,1);
		sort($v);
		$addtime 		= date('Y-m-d H:i:s');
		$qihao		= $val['c_t'];
		$hm1		= $v[0];
		$hm2		= $v[1];
		$hm3		= $v[2];
		$hm4		= $v[3];
		$hm5		= $v[4];
		$hm6		= $v[5];
		$hm7		= $v[6];
		$hm8		= $v[7];
		$hm9		= $v[8];
		$hm10		= $v[9];
		$hm11		= $v[10];
		$hm12		= $v[11];
		$hm13		= $v[12];
		$hm14		= $v[13];
		$hm15		= $v[14];
		$hm16		= $v[15];
		$hm17		= $v[16];
		$hm18		= $v[17];
		$hm19		= $v[18];
		$hm20		= $v[19];
		if(strlen($qihao)>0){
			$sql="select id from c_auto_1 where qishu='".$qihao."' ";
			$tquery = $mysqli->query($sql);
			$tcou	= $mysqli->affected_rows;
			if($tcou==0){
				$sql = "insert into c_auto_1(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10,ball_11,ball_12,ball_13,ball_14,ball_15,ball_16,ball_17,ball_18,ball_19,ball_20) 
				  values ('$qihao','$addtime','$hm1','$hm2','$hm3','$hm4','$hm5','$hm6','$hm7','$hm8','$hm9','$hm10','$hm11','$hm12','$hm13','$hm14','$hm15','$hm16','$hm17','$hm18','$hm19','$hm20')";	
				$mysqli->query($sql);
				$m=$m+1;
			}
			
			$hm28_1=($hm1+$hm2+$hm3+$hm4+$hm5+$hm6) %10;
			$hm28_2=($hm7+$hm8+$hm9+$hm10+$hm11+$hm12) %10;
			$hm28_3=($hm13+$hm14+$hm15+$hm16+$hm17+$hm18) %10;
			$hm28_4=$hm28_1+$hm28_2+$hm28_3;
			if($i==1){
				$dqihao=$qihao;
				$dhm1=$hm1;$dhm2=$hm2;$dhm3=$hm3;$dhm4=$hm4;$dhm5=$hm5;$dhm6=$hm6;$dhm7=$hm7;$dhm8=$hm8;$dhm9=$hm9;$dhm10=$hm10;
				$dhm11=$hm11;$dhm12=$hm12;$dhm13=$hm13;$dhm14=$hm14;$dhm15=$hm15;$dhm16=$hm16;$dhm17=$hm17;$dhm18=$hm18;$dhm19=$hm19;$dhm20=$hm20;
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
				
				$mysqli->query($sql);
				
			}
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
<table width="100%"border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()"><br>
      北京快乐8<br>(<?=$dqihao?>期:<?="$dhm1,$dhm2,$dhm3,$dhm4,$dhm5,$dhm6,$dhm7,$dhm8,$dhm9,$dhm10,$dhm11,$dhm12,$dhm13,$dhm14,$dhm15,$dhm16,$dhm17,$dhm18,$dhm19,$dhm20"?>)<br>
      <span>幸运28<br>(<?=$dqihao?>期:<?="$dhm28_1+$dhm28_2+$dhm28_3=$dhm28_4"?>)<br></span>
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="Js_1.php?qi=<?=$dqihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
<iframe src="Js_12.php?qi=<?=$dqihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>