<?php
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
$userinfo=user::getinfo($_SESSION["uid"]);
$lm = 3;

$cn_begin = $_GET["cn_begin"];
$s_begin_h = $_GET["s_begin_h"];
$s_begin_i = $_GET["s_begin_i"];
$cn_begin = $cn_begin == "" ? date("Y-m-d", time()) : $cn_begin;
$s_begin_h = $s_begin_h == "" ? "00" : $s_begin_h;
$s_begin_i = $s_begin_i == "" ? "00" : $s_begin_i;

$cn_end = $_GET["cn_end"];
$s_end_h = $_GET["s_end_h"];
$s_end_i = $_GET["s_end_i"];
$cn_end = $cn_end == "" ? date("Y-m-d", time()) : $cn_end;
$s_end_h = $s_end_h == "" ? "23" : $s_end_h;
$s_end_i = $s_end_i == "" ? "59" : $s_end_i;

$begin_time = $cn_begin . " " . $s_begin_h . ":" . $s_begin_i . ":00";
$end_time = $cn_end . " " . $s_end_h . ":" . $s_end_i . ":59";

$money = 0;
$ky = 0;
$jine = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>彩票历史记录</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css"/>
    <link type="text/css" rel="stylesheet" href="images/member.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>会员中心</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../Lottery/gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <?php include_once("historymenu.php"); ?>
            <div class="content">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr class="tic">
                        <td width="25%">彩种</td>
                        <td width="25%">详情</td>
                        <td width="25%">金额</td>
                        <td width="25%">结果</td>
                    </tr>
                    <?php
                    $sql = "select id from c_bet where js<>0 and uid=$uid and addtime>='$begin_time' and addtime<='$end_time' order by addtime desc";
                    $query	=	$mysqli->query($sql);
                    $sum	=	$mysqli->affected_rows; //总页数
                    $thisPage	=	1;
                    if(@$_GET['page']){
                        $thisPage	=	$_GET['page'];
                    }
                    $page		=	new newPage();
                    $perpage	= 	10;
                    $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
                    $id		=	'';
                    $i		=	1;
                    $start	=	($thisPage-1)*$perpage+1;
                    $end	=	$thisPage*$perpage;
                    while($row = $query->fetch_array()){
                        if($i >= $start && $i <= $end){
                            $id .=	$row['id'].',';
                        }
                        if($i > $end) break;
                        $i++;
                    }
                    if(!$id) {
                        ?>
                        <tr align="center">
                            <td colspan="4">暂无记录！</td>
                        </tr>
                        <?php
                    } else {
                        $id = rtrim($id,',');
                        $sql = "select * from c_bet where id in($id) order by id desc";
                        $query	=	$mysqli->query($sql);
                        while($rows = $query->fetch_array()) {
                            $money += $rows["money"];
                            $win = $rows["win"] > 0 ? $rows["win"] - $rows["money"] : $rows["win"];
                            $ky += $win + $rows["fs"];
                            ?>
                            <tr class="list f_12">
                                <td>
                                    <div><?= $rows['type'] ?></div>
                                    <div><?php echo date('m-d H:i:s', strtotime($rows["addtime"])); ?></div>
                                </td>
                                <td>
                                    <div>第 <?= $rows["qishu"] ?> 期</div>
                                    <hr>
                                    <div>
                                        <? if ($rows['type'] == '香港六合彩') { ?>
                                            <?= $rows["mingxi_1"] ?><br><span class="c_red"><?= $rows["mingxi_2"] ?></span><br>@ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } else { ?>
                                            <?= $rows["mingxi_1"] ?>【<span class="c_red"><?= $rows["mingxi_2"] ?></span>】 @ <span class="c_red"><?= $rows["odds"] ?></span>
                                        <? } ?>
                                    </div>
                                </td>
                                <td>
                                    <span><?= $rows["money"] ?></span>
                                    <hr>
                                    <?= $rows["win"] > 0 ? '<span class="c_red">全赢</span>' : '<span class="c_green">全输</span>' ?>
                                    <hr>
                                    <span class="c_blue"><?= $rows["fs"] ?></span>
                                </td>
                                <td>
                                    <?php
                                    $jine = 0;
                                    $jine = $rows["win"] > 0 ? $rows["win"] + $rows["fs"] : $rows["fs"];
                                    if ($rows["js"] == 0) {
                                        echo '待结算';
                                    } else {
                                        echo double_format($jine);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } ?>
                </table>
                <table cellspacing="0" cellpadding="0" border="0" class="page">
                    <tr>
                        <td align="right"><?=$page->get_htmlPage("cha_cp.php?rad=ygsds&cn_begin=$cn_begin&cn_end=$cn_end&t=y");?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>