<?php
session_start();
include_once("include/mysqli.php");
include_once("include/mysqlis.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("include/lottery.inc.php");
include_once("cache/website.php");

$uid = $_SESSION["uid"];
	
	//投注金额 
	if($uid && $uid>0){ //已登陆
		$sql		=	"SELECT sum(bet_money) as s FROM `k_bet` where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	=	$rs['s'];
		
		$sql		=	"select sum(bet_money) as s from k_bet_cg_group where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	+=	$rs['s'];
		
		
		$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_num	=	$rs['s'];
		
		$sql		=	"select money as s from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
	}
	unset($mysqlis);	

	$display_foot_text = true;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<title><?=$web_site['web_title']?></title>
	<link rel="stylesheet" href="/css/bootstrap_s.min.css">
	<link rel="stylesheet" href="/css/font-awesome_s.min.css">
	<link rel="stylesheet" href="/css/ui-dialog.css">
	<link rel="stylesheet" href="/styles/ezweb.css">
	<script type="text/javascript" src="/assets/jquery.js"></script>
	<script type="text/javascript" src="/js/bootstrap_s.min.js"></script>
	<script type="text/javascript" src="/js/dialog-min.js"></script>
	<script type="text/javascript" src="/js/top.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/zhuce.js"></script>
	<script type="text/javascript" src="/scripts/slider.js"></script>
</head>
<body>
<?php include_once("modules/headers.php"); ?>
	<div class="page-slide">
		<div id="J_p1" class="page active index-page">	
			<div id="J_p2">
				<div class="main dashboard sports">
					<div class="container">
						<iframe class="topbet" id="s_betiframe" name="s_betiframe" src="/betiframe.php" frameborder="0" width="100%" height="0" scrolling="no"></iframe>
						<div class="h10 clearfix"></div>
						<div class="btn-group btn-group-lg btn-group-justified" role="group">
							<a href="/mysports.php" class="btn btn-green">体育赛事</a>
							<a href="/main.php" class="btn btn-default">彩票游戏</a>
							<a href="/Six/Six_7_3.php" class="btn btn-default">香港乐透</a>
						</div>
						<div class="h10 clearfix"></div>
						<iframe id="J_SportsIFrame" src="left.php" frameborder="0" width="100%" height="100%" scrolling="no"></iframe>
					</div>
					<div class="bg2"></div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once("modules/foots.php"); ?>	
	<?php include_once("modules/scripts.php"); ?>
</body>
</html>

