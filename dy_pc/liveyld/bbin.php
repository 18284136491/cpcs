<?php 
function curl_file_get_contents($durl){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $durl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($ch);
	curl_close($ch);
	return $r;
}
?>
<?php 
header("Content-type: text/html; charset=utf-8");
session_start();
$uid = intval(@$_SESSION['uid']);
$username = @$_SESSION["username"];
include_once("config.php");
if(!$username){
	echo "<script>alert('请登录后再试！');window.close();</script>";exit;
}
if(!$isBB){
	echo "<script>alert('未开通BB!');window.close();</script>";exit;
}

$sign = md5($plantform."_".$merID."_".$key."_".$username);

$page_site = $_REQUEST["site"];
if(!$page_site){
	$page_site = "live";
}


$pUrl = "bbinUrl";
$pUrl = "bbinUrl";
$pTime = "urltime";
//echo $pUrl."".$pTime;exit;
if(@$_SESSION[$pUrl] != null && @$_SESSION[$pTime] > (time() - 60)){
	if(@$_SESSION['bbinType'] != $page_site){
		echo "<script>alert('您的登陆过于频繁，请1分钟后在试！！');window.close();</script>";exit;
	}else{
		$url = $_SESSION[$pUrl];
		$_SESSION[$pTime]=time();
	}
}else{
	$url = $fenjieHost."/bb!login.do?plantform=".$plantform."&username=".$username."&page_site=".$page_site."&sign=".$sign;
	$url = curl_file_get_contents($url);
	if(strpos($url, "alert") > 0){
		echo "<script>alert('您的登陆过于频繁，请1分钟后在试！');window.close();</script>";exit;
	}else{
		$_SESSION[$pTime]=time();
		$_SESSION[$pUrl]=$url;
		$_SESSION['bbinType']=$page_site;
	}
}
echo $url;
?>