<?php
@session_start();
//print_r($_COOKIE);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>Welcome</title>
</head>
<body>
<?php
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("common/logintu.php");
include_once("class/user.php");
$uid    	=	@$_SESSION['uid'];
$loginid	=	@$_SESSION['user_login_id'];
if(!isset($uid) || !isset($_SESSION["username"])){
    echo "<script type=\"text/javascript\" language=\"javascript\">window.location.href='/';</script>";
    exit();
}

//获取真人
$sql		=	"select money as s,is_stop,ag_zr_money+ag_zr_vipmoney as zr_s from k_user where uid=$uid limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_money	=	sprintf("%.2f",$rs['s']);
$zr_money	=	sprintf("%.2f",$rs['zr_s']);

/* 踢掉停用的用户 BEGIN 2013.11.20 */
if(intval($rs['is_stop'])==1)
{
	if ($_SESSION['uid'])
	{
		$mysqli->query("update `k_user_login` set `is_login`=0 WHERE `uid`='".$_SESSION['uid']."'");
		unset($_SESSION["uid"],$_SESSION["gid"],$_SESSION["username"]);
		session_destroy();
		echo "<script type=\"text/javascript\" language=\"javascript\">window.location.href='/';</script>";
		exit();
	}
}
/* 踢掉停用的用户 END */

/* 踢掉被踢线的会员 BEGIN 2014.01.12 */
$sql	=	"select id from k_user_login where uid='$uid' and is_login=1 limit 1";
$query	=	$mysqli->query($sql);
$rs		=	$query->fetch_array();
if(!$rs){
	$mysqli->query("update `k_user_login` set `is_login`=0 WHERE `uid`='$uid'");
	unset($_SESSION["uid"],$_SESSION["gid"],$_SESSION["username"]);
	session_destroy();
	echo "<script type=\"text/javascript\" language=\"javascript\">window.location.href='/';</script>";
	exit();
}
/* 踢掉被踢线的会员 END 2014.01.12 */

//获取短消息
$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_num	=	$rs['s'];
//获取还没有结算的注单投注额
$sql		=	"SELECT sum(bet_money) as s FROM `k_bet` where uid=$uid and status=0";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$tz_money	=	$rs['s'];
		
$sql		=	"select sum(bet_money) as s from k_bet_cg_group where uid=$uid and status=0";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$tz_money	+=	$rs['s'];
$tz_money	=	sprintf("%.2f",$tz_money);
?>
<?=$user_money?>|<?=$user_num?>|<?=$zr_money?>

<?php
/* 删除30分钟没有动的用户 */
$intimes = time();
$outtimes = $intimes - 1800;
$mysqli->query("update `k_user_login` set `is_login`=0 WHERE login_time<$outtimes and `is_login`>0");
if ($_SESSION['uid'])
{
    $mysqli->query("update `k_user_login` set `login_id`='$intimes".'_'.$_SESSION['uid'].'_'.$_SESSION["username"]."',`login_time`='$intimes',`is_login`=1 WHERE `uid`='".$_SESSION['uid']."'");
}
?>
</body>
</html>