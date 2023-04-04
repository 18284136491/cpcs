<?php
session_start();
include_once("include/mysqli.php");
include_once("include/lottery.inc.php");
include_once("common/function.php");
include_once("cache/website.php");

$uid = $_SESSION["uid"];

if(isset($_GET['f'])) {
	$sql    =    "select uid from k_user where username='".htmlEncode($_GET['f'])."' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        echo '<script>location.href="/myreg.php";</script>';
		exit;
    }
}

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$list = $rs['msg'];

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
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/touchslide.js"></script>
    <script type="text/javascript" src="js/marquee.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <script type="text/javascript" src="js/base.js"></script>
</head>
<body>
<?php include_once("modules/header.php"); ?>
<div id="slide" class="container-fluid slide">
    <ul class="bd">
        <li><a href="#"><img class="carousel-inner" src="images/dy/banner1.jpg"></a></li>
        <li><a href="#"><img class="carousel-inner" src="images/dy/banner2.jpg"></a></li>
        <li><a href="#"><img class="carousel-inner" src="images/dy/banner3.jpg"></a></li>
    </ul>
    <ul class="hd"></ul>
</div>
<div class="container-fluid notice">
    <div class="list">
        <div id="news" class="move"><?=$list?></div>
    </div>
</div>
<div class="container-fluid games">
	<div class="col">
        <a class="logo pk10" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(4);' : 'info();' ?>"></a>
        <span class="gm_txt">北京赛车PK10</span>
    </div>
    <div class="col">
        <a class="logo xyft" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(5);' : 'info();' ?>"></a>
        <span class="gm_txt">幸运飞艇</span>
    </div>
    <div class="col">
        <a class="logo cqssc" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(1);' : 'info();' ?>"></a>
        <span class="gm_txt">重庆时时彩</span>
    </div>
	<div class="col">
        <a class="logo gdsf" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(7);' : 'info();' ?>"></a>
        <span class="gm_txt">广东快乐十分</span>
    </div>
	<div class="col">
        <a class="logo xync" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(6);' : 'info();' ?>"></a>
        <span class="gm_txt">重庆幸运农场</span>
    </div>
	<div class="col">
        <a class="logo six" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(11);' : 'info();' ?>"></a>
        <span class="gm_txt">香港六合彩</span>
    </div>
	<div class="col">
		<a class="logo ty" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(14);' : 'info();' ?>"></a>
        <span class="gm_txt">体育赛事</span>
	</div>
    <div class="col">
        <a class="logo tjssc" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(2);' : 'info();' ?>"></a>
        <span class="gm_txt">天津时时彩</span>
    </div>
    <div class="col">
        <a class="logo xjssc" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(3);' : 'info();' ?>"></a>
        <span class="gm_txt">新疆时时彩</span>
    </div>
    <div class="col">
        <a class="logo kl8" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(8);' : 'info();' ?>"></a>
        <span class="gm_txt">北京快乐8</span>
    </div>
    <div class="col">
        <a class="logo fc3d" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(9);' : 'info();' ?>"></a>
        <span class="gm_txt">福彩3D</span>
    </div>
    <div class="col">
        <a class="logo pl3" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(10);' : 'info();' ?>"></a>
        <span class="gm_txt">排列三</span>
    </div>
    <div class="col">
        <a class="logo xy28" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(12);' : 'info();' ?>"></a>
        <span class="gm_txt">PC蛋蛋</span>
    </div>
    <div class="col">
        <a class="logo jnd28" href="javascript:void(0);" onclick="<?= intval($uid) > 0 ? 'onUrl(13);' : 'info();' ?>"></a>
        <span class="gm_txt">加拿大28</span>
    </div>
	<div class="col">
        <a class="logo zr" href="javascript:void(0);" onclick="alert('即将上线敬请期待！');"></a>
        <span class="gm_txt">真人娱乐</span>
    </div>
</div>
<?php include_once("modules/foot.php"); ?>
<script type="text/javascript">
    TouchSlide({
        slideCell: "#slide",
        mainCell: ".bd",
        titCell: ".hd",
        effect: "leftLoop",
        autoPage: true,
        autoPlay: true
    });
    $("#news").marquee({duration: 10000});
    var info = function() {
        lay_msg('请登录后操作！', null);
    };
    var g_login = function() {
        var e = function() {
            location.replace("/guest.php");
        };
        lay_msg('试玩账号，登录成功！', e);
    };
    var onUrl = function(t) {
        t = Number(t) > 0 ? Number(t) : 1;
        location.replace('/route.php?t=' + t);
    };
</script>
</body>
</html>

