<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['kl8']) == 1) {
    include('close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 8;
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
switch($type) {
    case '选一':
        $g_i = 1;
        break;
    case '选二':
        $g_i = 2;
        break;
    case '选三':
        $g_i = 3;
        break;
    case '选四':
        $g_i = 4;
        break;
    case '选五':
        $g_i = 5;
        break;
    default:
        $g_i = 0;
}
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
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="Css/ssc.css"/>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="Js/kl8.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>北京快乐8</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered">
                        <tr><td class="tit">游戏菜单</td></tr>
                        <tr><td><a href="kl8.php?t=两面盘">两面盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="kl8.php?t=选一">选一</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="kl8.php?t=选二">选二</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="kl8.php?t=选三">选三</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="kl8.php?t=选四">选四</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="kl8.php?t=选五">选五</a> <i class="icon-angle-right"></i></td></tr>
                    </table>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="kl8"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                <span><?=$type?></span>
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=1" method="post" target="OrderFrame">
                    <?php if($type == '两面盘') { ?>
                        <div class="tz_box">
                            <div class="tit">组合</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_6_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_6_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_6_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_6_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和810</span>
                                            <span class="odds" id="ball_6_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">上盘</span>
                                            <span class="odds" id="ball_7_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_7_t1"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">中盘</span>
                                            <span class="odds" id="ball_7_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_7_t2"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">下盘</span>
                                            <span class="odds" id="ball_7_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_7_t3"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">奇盘</span>
                                            <span class="odds" id="ball_8_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_8_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">和盘</span>
                                            <span class="odds" id="ball_8_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_8_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">偶盘</span>
                                            <span class="odds" id="ball_8_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_8_t3"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif($type == '选一' || $type == '选二' || $type == '选三' || $type == '选四' || $type == '选五') { ?>
                        <div class="tz_box kl8">
                            <div class="tit"><?=$type?></div>
                            <?php
                            for($s = 1; $s <= 80; $s++) {
                                if($s % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <?= $type == '选一' ? '<input class="chk" type="checkbox">' : '' ?>
                                            <span class="qiu"><em class="n_<?=$s?>"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h<?=$s?>"></span>
                                            <?= $type == '选一' ? '' : '<span class="s_inp" id="ball_' . $g_i . '_t' . $s . '"></span>' ?>
                                        </div>
                                        <?= $type == '选一' ? '<div class="inp" id="ball_' . $g_i . '_t' . $s . '"></div>' : '' ?>
                                    </div>
                                </li>
                                <?php
                                if($s % 2 == 0) {
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <div class="tool">
                        <div class="kj_box">
                            <div class="kuaisu">
                                <input id="kj_money"<?=$g_i > 1 ? ' name="ball_xx"' : ''?> class="kj_inp" type="text" placeholder="快速金额" value="" />
                                <input id="qi_num" type="hidden" name="qi_num" value=""/>
                            </div>
                            <button type="button" title="<?=$g_i > 1 ? '重选' : '重填'?>" onclick="formReset();" class="btn btn-danger"><?=$g_i > 1 ? '重选' : '重填'?></button>
                            <button type="button" title="下注" onclick="order();" class="btn btn-primary">下注</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
    <script type="text/javascript">
        loadinfo(<?=$g_i?>);
        rf_time(90);
    </script>
</body>
</html>