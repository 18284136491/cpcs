<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");
if(intval($web_site['pk10']) == 1) {
    include('close_cp.php');
    exit();
}
$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 4;
$type = $_GET['t'];
if(empty($type)) {
    $type = '两面盘';
}
$t_day = date('Y-m-d', $lottery_time);
$w_tit = array('冠军', '亚军', '第三名', '第四名', '第五名', '第六名', '第七名', '第八名', '第九名', '第十名');
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
    <script type="text/javascript" src="Js/pk10.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>北京赛车PK拾</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered">
                        <tr><td class="tit">游戏菜单</td></tr>
                        <tr><td><a href="Pk10.php?t=两面盘">两面盘</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Pk10.php?t=冠亚和">冠亚和</a> <i class="icon-angle-right"></i></td></tr>
                        <tr><td><a href="Pk10.php?t=1~10名">1~10名</a> <i class="icon-angle-right"></i></td></tr>
                    </table>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="pk10"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                <span><?=$type?></span>
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="order/order4.php?type=4" method="post" target="OrderFrame">
                    <?php if($type == '两面盘') { ?>
                        <div class="tz_box">
                            <div class="tit">冠亚军和</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚大</span>
                                            <span class="odds" id="ball_1_h18"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t18"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚小</span>
                                            <span class="odds" id="ball_1_h19"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t19"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚单</span>
                                            <span class="odds" id="ball_1_h20"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t20"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚双</span>
                                            <span class="odds" id="ball_1_h21"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t21"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php for($s = 2; $s <= 11; $s++) { ?>
                            <div class="tz_box">
                                <div class="tit"><?=$w_tit[$s - 2]?></div>
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
                                <?php if($s <= 6) { ?>
                                    <ul>
                                        <li>
                                            <div class="wf_box">
                                                <div class="wf_info">
                                                    <input class="chk" type="checkbox">
                                                    <span class="qiu">龙</span>
                                                    <span class="odds" id="ball_1<?=$s?>_h1"></span>
                                                </div>
                                                <div class="inp" id="ball_1<?=$s?>_t1"></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="wf_box">
                                                <div class="wf_info">
                                                    <input class="chk" type="checkbox">
                                                    <span class="qiu">虎</span>
                                                    <span class="odds" id="ball_1<?=$s?>_h2"></span>
                                                </div>
                                                <div class="inp" id="ball_1<?=$s?>_t2"></div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } elseif($type == '冠亚和') { ?>
                        <div class="tz_box">
                            <div class="tit">冠、亚军和</div>
                            <?php
                            for($s = 1; $s <= 17; $s++) {
                                if($s % 2 == 1) {
                                    echo '<ul>';
                                }
                                ?>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu"><?=$s + 2?></span>
                                            <span class="odds" id="ball_1_h<?=$s?>"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t<?=$s?>"></div>
                                    </div>
                                </li>
                            <?php
                                if($s % 2 == 0 || $s == 17) {
                                    echo '</ul>';
                                }
                            }
                            ?>
                        </div>
                        <div class="tz_box">
                            <div class="tit">冠亚和两面</div>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚大</span>
                                            <span class="odds" id="ball_1_h18"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t18"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚小</span>
                                            <span class="odds" id="ball_1_h19"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t19"></div>
                                    </div>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚单</span>
                                            <span class="odds" id="ball_1_h20"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t20"></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="wf_box">
                                        <div class="wf_info">
                                            <input class="chk" type="checkbox">
                                            <span class="qiu">冠亚双</span>
                                            <span class="odds" id="ball_1_h21"></span>
                                        </div>
                                        <div class="inp" id="ball_1_t21"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    <?php } elseif($type == '1~10名') { ?>
                        <?php for($s = 2; $s <= 11; $s++) { ?>
                            <div class="tz_box pk10">
                                <div class="tit"><?=$w_tit[$s - 2]?></div>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_1"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h1"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t1"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_2"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h2"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t2"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_3"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h3"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t3"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_4"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h4"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t4"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_5"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h5"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t5"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_6"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h6"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t6"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_7"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h7"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t7"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_8"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h8"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t8"></div>
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_9"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h9"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t9"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wf_box">
                                            <div class="wf_info">
                                                <input class="chk" type="checkbox">
                                                <span class="qiu"><em class="n_10"></em></span>
                                                <span class="odds" id="ball_<?=$s?>_h10"></span>
                                            </div>
                                            <div class="inp" id="ball_<?=$s?>_t10"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php } ?>
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
        loadinfo();
        rf_time(90);
    </script>
</body>
</html>