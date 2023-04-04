<?php
session_start();
$_SESSION['SitePath'] = dirname(__FILE__);
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("include/mobile_detect.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/conf.php");
include_once("cache/website.php");

/**
* 地区限制功能
*/
include_once("ip.php");
include_once("cache/dqxz.php");
$address    =    '='.iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
foreach($dqxz as $k=>$v){
    if(strpos($address,$v)){
        header("location:lndex.php");
        exit;
    }
}

$indexurl = "myhome.php";

function prefix_url(){
         $s = !isset($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
            
         $protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
         $protocol = substr($protocol,0,strpos($protocol,'/')).$s.'://';
            
         $port     = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];
            
         $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
                        getenv('SERVER_NAME').$port;
         return $server_name;
}

if(isset($_GET['f'])){
    $sql    =    "select uid from k_user where username='".htmlEncode($_GET['f'])."' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        $indexurl = "myreg.php";
    }
} else{
	$arr = explode('.',prefix_url()); //用 . 号截取url分割

    $f = $arr[0];


    if($f!='www' && $f!='' && $f!='wap'){
       $sql    =    "select uid from k_user where username='".htmlEncode($f)."' and is_daili=1 limit 1";
        $query    =    $mysqli->query($sql); //要是代理
        $rs        =    $query->fetch_array();
        if(intval($rs["uid"])){
            setcookie('f',intval($rs["uid"]));
            setcookie('tum',htmlEncode($f));
            $indexurl = "myreg.php";
        }
    }
}

$detect = new Mobile_Detect;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?=$web_site['web_title']?></title>
	<link rel="shortcuticon" href="/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<script language="JavaScript">
		function closeErrors() {    
			return true;    
		}    
		window.onerror=closeErrors; 
		var str='欢迎光临【'+'<?=$web_site['web_name']?>'+'】,请记住我们的网址http://'+'<?=$conf_www?>';
		window.status = str;
		<?php if($detect->isMobile()) { ?>
			var r = confirm("系统判断您是手机访问，是否切换到手机版？");
			if(r) {
				location.href = "http://m.fyl99.com";
			}
		<?php } ?>
	</script>
	<style> 
		html{width: 100%;height: 100%;}
		body{width: 100%;height: 100%;margin: 0;padding:0;overflow:hidden;overflow-x: auto;*overflow:visible;*overflow-x:visible;_overflow:hidden;_overflow-x:auto;}
		iframe{margin: 0;padding:0}
	</style>
</head>
<body>
    <iframe id="index" name="index" src="<?=$indexurl?>" frameborder="0" width="100%" height="100%" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
</body>
</html>