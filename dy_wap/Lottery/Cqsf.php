<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['xync']) == 1) {
    include('close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 6;
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
switch($type) {
    case '第一球':
        $g_i = 1;
        break;
    case '第二球':
        $g_i = 2;
        break;
    case '第三球':
        $g_i = 3;
        break;
    case '第四球':
        $g_i = 4;
        break;
    case '第五球':
        $g_i = 5;
        break;
    case '第六球':
        $g_i = 6;
        break;
    case '第七球':
        $g_i = 7;
        break;
    case '第八球':
        $g_i = 8;
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
    <script type="text/javascript" src="Js/cq_sf.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>重庆幸运农场</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered">
                        <tr><td class="tit">游戏菜单</td></tr>
                        <tr><td><a href="Cqsf.php?t=两面盘">两面盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第一球">第一球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第二球">第二球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第三球">第三球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第四球">第四球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第五球">第五球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第六球">第六球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第七球">第七球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Cqsf.php?t=第八球">第八球</a> <i class="icon-angle-right"></i></td></tr>
                    </table>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="gdsf"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                <span><?=$type?></span>
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order3.php?type=11" method="post" target="OrderFrame">
                    <?php if($type == '两面盘') { ?>
                        <div class="tz_box">
                            <div class="tit">总和、龙虎</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_9_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_9_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_9_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_9_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和尾大</span>
                                            <span class="odds" id="ball_9_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和尾小</span>
                                            <span class="odds" id="ball_9_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">龙</span>
                                            <span class="odds" id="ball_9_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t7"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">虎</span>
                                            <span class="odds" id="ball_9_h8"></span>
                                        </div>
                                        <div class="inp" id="ball_9_t8"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php for($s = 1; $s <= 8; $s++) { ?>
                            <div class="tz_box">
                                <div class="tit">第<?=ch_num($s)?>球</div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">大</span>
                                                <span class="odds" id="ball_<?=$s?>_h21"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t21"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">小</span>
                                                <span class="odds" id="ball_<?=$s?>_h22"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t22"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">单</span>
                                                <span class="odds" id="ball_<?=$s?>_h23"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t23"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">双</span>
                                                <span class="odds" id="ball_<?=$s?>_h24"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t24"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">尾大</span>
                                                <span class="odds" id="ball_<?=$s?>_h25"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t25"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">尾小</span>
                                                <span class="odds" id="ball_<?=$s?>_h26"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t26"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">合单</span>
                                                <span class="odds" id="ball_<?=$s?>_h27"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t27"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">合双</span>
                                                <span class="odds" id="ball_<?=$s?>_h28"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t28"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                    <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球' || $type == '第四球' || $type == '第五球' || $type == '第六球' || $type == '第七球' || $type == '第八球') { ?>
                        <div class="tz_box">
                            <div class="tit"><?=$type?></div>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_1"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h1">></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t1">></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_2"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h2">></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_3"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_4"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_5"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_6"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_7"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t7"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_8"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h8"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t8"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_9"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h9"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t9"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_10"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h10"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t10"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_11"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h11"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t11"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_12"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h12"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t12"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_13"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h13"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t13"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_14"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h14"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t14"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_15"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h15"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t15"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_16"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h16"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t16"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_17"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h17"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t17"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_18"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h18"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t18"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_19"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h19"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t19"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box gdsf">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_20"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h20"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t20"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">大</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h21"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t21"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">小</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h22"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t22"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">单</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h23"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t23"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">双</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h24"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t24"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">尾大</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h25"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t25"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">尾小</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h26"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t26"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">合单</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h27"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t27"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">合双</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h28"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t28"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">东</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h29"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t29"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">南</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h30"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t30"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">西</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h31"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t31"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">北</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h32"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t32"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">中</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h33"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t33"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">发</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h34"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t34"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">白</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h35"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t35"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                    <div class="tool">
                        <div class="kj_box">
                            <div class="kuaisu">
                                <input id="kj_money" class="kj_inp" type="text" placeholder="快速金额" value="" />
                                <input id="qi_num" type="hidden" name="qi_num" value=""/>
                            </div>
                            <button type="button" title="重填" onclick="formReset();" class="btn btn-danger">重填</button>
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

