<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['3d']) == 1) {
    include('close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 9;
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
    case '数字盘':
        $g_i = 4;
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
    <script type="text/javascript" src="Js/3d.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>福彩3D</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered">
                        <tr><td class="tit">游戏菜单</td></tr>
                        <tr><td><a href="3D.php?t=两面盘">两面盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="3D.php?t=数字盘">数字盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="3D.php?t=第一球">第一球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="3D.php?t=第二球">第二球</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="3D.php?t=第三球">第三球</a> <i class="icon-angle-right"></i></td></tr>
                    </table>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="ssc"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                <span><?=$type?></span>
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order.php?type=9" method="post" target="OrderFrame">
                    <?php if($type == '两面盘') { ?>
                        <?php for($s = 1; $s <= 3; $s++) { ?>
                            <div class="tz_box">
                                <div class="tit">第<?=ch_num($s)?>球</div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">大</span>
                                                <span class="odds" id="ball_<?=$s?>_h11"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t11"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">小</span>
                                                <span class="odds" id="ball_<?=$s?>_h12"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t12"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">单</span>
                                                <span class="odds" id="ball_<?=$s?>_h13"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t13"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu">双</span>
                                                <span class="odds" id="ball_<?=$s?>_h14"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t14"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="tz_box">
                            <div class="tit">总和两面</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_4_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_4_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_4_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_4_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">龙</span>
                                            <span class="odds" id="ball_4_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">虎</span>
                                            <span class="odds" id="ball_4_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">和</span>
                                            <span class="odds" id="ball_4_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t7"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif($type == '数字盘') { ?>
                        <?php for($s = 1; $s <= 3; $s++) { ?>
                            <div class="tz_box ssc">
                                <div class="tit">第<?=ch_num($s)?>球</div>
                                <?php
                                for($j = 1; $j <= 10; $j++) {
                                    if($j % 2 == 1) {
                                        echo '<ul>';
                                    }
                                    ?>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_<?=$j - 1?>"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h<?=$j?>"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t<?=$j?>"></div>
                                        </div>
                                    </li>
                                    <?php
                                    if($j % 2 == 0) {
                                        echo '</ul>';
                                    }
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="tz_box ssc">
                            <div class="tit">独胆</div>
                            <?php
                            for($s = 1; $s <= 10; $s++) {
                                if($s % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_<?=$s - 1?>"></em></span>
                                            <span class="odds" id="ball_7_h<?=$s?>"></span>
                                        </div>
                                        <div class="inp" id="ball_7_t<?=$s?>"></div>
                                    </div>
                                </li>
                                <?php
                                if($s % 2 == 0) {
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>
                        <div class="tz_box ssc">
                            <div class="tit">跨度</div>
                            <?php
                            for($s = 1; $s <= 10; $s++) {
                                if($s % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_<?=$s - 1?>"></em></span>
                                            <span class="odds" id="ball_6_h<?=$s?>"></span>
                                        </div>
                                        <div class="inp" id="ball_6_t<?=$s?>"></div>
                                    </div>
                                </li>
                                <?php
                                if($s % 2 == 0) {
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>
                    <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球') { ?>
                        <div class="tz_box">
                            <div class="tit"><?=$type?></div>
                            <?php
                            for($s = 1; $s <= 10; $s++) {
                                if($s % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box ssc">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><em class="n_<?=$s - 1?>"></em></span>
                                            <span class="odds" id="ball_<?=$g_i?>_h<?=$s?>"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t<?=$s?>"></div>
                                    </div>
                                </li>
                                <?php
                                if($s % 2 == 0) {
                                    echo '</ul>';
                                }
                            }
                            ?>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">大</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h11"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t11"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">小</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h12"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t12"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">单</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h13"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t13"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">双</span>
                                            <span class="odds" id="ball_<?=$g_i?>_h14"></span>
                                        </div>
                                        <div class="inp" id="ball_<?=$g_i?>_t14"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和大</span>
                                            <span class="odds" id="ball_4_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t1"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和小</span>
                                            <span class="odds" id="ball_4_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t2"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和单</span>
                                            <span class="odds" id="ball_4_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t3"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">总和双</span>
                                            <span class="odds" id="ball_4_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t4"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">龙</span>
                                            <span class="odds" id="ball_4_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t5"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">虎</span>
                                            <span class="odds" id="ball_4_h6"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t6"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">和</span>
                                            <span class="odds" id="ball_4_h7"></span>
                                        </div>
                                        <div class="inp" id="ball_4_t7"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">豹子</span>
                                            <span class="odds" id="ball_5_h1"></span>
                                        </div>
                                        <div class="inp" id="ball_5_t1"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">顺子</span>
                                            <span class="odds" id="ball_5_h2"></span>
                                        </div>
                                        <div class="inp" id="ball_5_t2"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">对子</span>
                                            <span class="odds" id="ball_5_h3"></span>
                                        </div>
                                        <div class="inp" id="ball_5_t3"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">半顺</span>
                                            <span class="odds" id="ball_5_h4"></span>
                                        </div>
                                        <div class="inp" id="ball_5_t4"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">杂六</span>
                                            <span class="odds" id="ball_5_h5"></span>
                                        </div>
                                        <div class="inp" id="ball_5_t5"></div>
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