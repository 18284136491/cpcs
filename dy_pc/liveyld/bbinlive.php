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

$pUrl = "bbinUrl";
$pUrl = "bbinUrl";
$pTime = "urltime";
//echo $pUrl."".$pTime;exit;
if(@$_SESSION[$pUrl] != null && @$_SESSION[$pTime] > (time() - 99)){
		$url = $_SESSION[$pUrl];
		$_SESSION[$pTime]=time();
}else{
	$urlx = $fenjieHost."/bb!fast.do?plantform=".$plantform."&username=".$username."&sign=".$sign."&resultType=json";
	$rx = curl_file_get_contents($urlx);
	//echo $url;exit;
	$json = json_decode($rx);
	if(!$json->result){
		echo "<script>alert('您的登陆过于频繁，请30秒后在试！');window.close();</script>";exit;
	}else{
		$_SESSION[$pTime]=time();
		$_SESSION[$pUrl]=$json->url;
		$url=$json->url;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>bbin</title></head><body><iframe src="<?=$url ?>" id="mem_index" security="restricted" sandbox=""  width="100%" height="500px" frameborder="0" width="100%" height="400px" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
</body><script>var iframe = document.getElementById("mem_index");
	if(iframe.attachEvent){iframe.attachEvent("onload", function(){location.href="http://777.apibox.info/cl/?module=System&method=LiveTop&target=blank";});
	}else{iframe.onload = function(){location.href="http://777.apibox.info/cl/?module=System&method=LiveTop&target=blank";};}
	function ccc(){var iframe = document.getElementById("mem_index");alert(iframe.src);}
</script>
</html>