<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/login_check.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("include/lottery.inc.php");
include_once("cache/website.php");

$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 0;
$t_day = date('Y-m-d', $lottery_time);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$web_site['web_title']?></title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <link type="text/css" rel="stylesheet" href="Lottery/Css/ssc.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/mmenu.all.min.js"></script>
    <style type="text/css">
        .mm-page{position: static}
        .footer{background-color: #eee; z-index: 0}
    </style>
</head>
<body>
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">菜单</a>
            <span>福运来彩票</span>
            <a class="f_r" href="/logout.php">退出</a>
        </div>
        <?php include_once('Lottery/u_nav.php') ?>
        <div class="games">
			<div class="col">
                <a class="logo pk10" href="Lottery/Pk10.php"></a>
                <span class="gm_txt">北京赛车PK10</span>
            </div>
            <div class="col">
                <a class="logo xyft" href="Lottery/Xyft.php"></a>
                <span class="gm_txt">幸运飞艇</span>
            </div>
            <div class="col">
                <a class="logo cqssc" href="Lottery/Cqssc.php"></a>
                <span class="gm_txt">重庆时时彩</span>
            </div>
			<div class="col">
                <a class="logo gdsf" href="Lottery/gdsf.php"></a>
                <span class="gm_txt">广东快乐十分</span>
            </div>
			<div class="col">
                <a class="logo xync" href="Lottery/Cqsf.php"></a>
                <span class="gm_txt">重庆幸运农场</span>
            </div>
			<div class="col">
                <a class="logo six" href="Six/Six_7_3.php"></a>
                <span class="gm_txt">香港六合彩</span>
            </div>
			<div class="col">
                <a class="logo ty" href="mysports.php"></a>
                <span class="gm_txt">体育赛事</span>
            </div>
            <div class="col">
                <a class="logo tjssc" href="Lottery/Jxssc.php"></a>
                <span class="gm_txt">天津时时彩</span>
            </div>
            <div class="col">
                <a class="logo xjssc" href="Lottery/Xjssc.php"></a>
                <span class="gm_txt">新疆时时彩</span>
            </div>
            <div class="col">
                <a class="logo kl8" href="Lottery/kl8.php"></a>
                <span class="gm_txt">北京快乐8</span>
            </div>
            <div class="col">
                <a class="logo fc3d" href="Lottery/3D.php"></a>
                <span class="gm_txt">福彩3D</span>
            </div>
            <div class="col">
                <a class="logo pl3" href="Lottery/pl3.php"></a>
                <span class="gm_txt">排列三</span>
            </div>
            <div class="col">
                <a class="logo xy28" href="Lottery/xy28.php"></a>
                <span class="gm_txt">PC蛋蛋</span>
            </div>
            <div class="col">
                <a class="logo jnd28" href="Lottery/jnd28.php"></a>
                <span class="gm_txt">加拿大28</span>
            </div>
			<div class="col">
                <a class="logo zr" href="javascript:void(0);" onclick="alert('即将上线敬请期待！');"></a>
                <span class="gm_txt">真人娱乐</span>
            </div>
        </div>
		<div class="news">
			<div class="tit">最新公告</div>
			<div class="n_l">
				<ul>
					<?php
					$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 3";
					$query = $mysqli->query($sql);
					$i = 1;
					while($rs = $query->fetch_array()) {
						?>
						<li>[<?=$i?>] <?=$rs['msg']?></li>
						<?php
						$i++;
					}
					?>
				</ul>
			</div>
		</div>
    </div>
    <?php include_once("modules/foot.php"); ?>
    <script type="text/javascript" src="js/base.js"></script>
</body>
</html>