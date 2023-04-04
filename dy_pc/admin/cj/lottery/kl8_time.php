<?
header('Content-Type:text/html; charset=utf-8');
require ("../mysqli.php");
require ("curl_http.php");
require ("../../../cache/website.php");


if(1==1){
$st_time=strtotime("2010-06-01 08:59:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=179;$i++){
	echo $i."===";
	$sqls="select * from lottery_t_kl8 where qihao='$i'";
	echo $sqls."===";
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	if($rs['qihao']){
		$actiontime=date("2010-06-01 H:i:s",$st_time);
		$fengpan=date("2010-06-01 H:i:s", $st_time+5*60);
		$kaijiang=date("2010-06-01 H:i:s", $st_time+5*60);
		$strSqls="UPDATE `lottery_t_kl8` SET `kaipan`='$actiontime',`fengpan`='$fengpan' WHERE (`qihao`='".$rs['qihao']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		$st_time+=60*5;
	}
}}
?>
