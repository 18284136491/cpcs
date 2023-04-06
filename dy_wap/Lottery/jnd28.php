<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include("../common/login_check.php");
include_once("../common/function.php");
include_once("../class/user.php");
include_once("../cache/website.php");
include_once("include/Lottery_Time.php");

$uid = $_SESSION['uid'];
$userinfo = user::getinfo($uid);

$gm = 13;
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
    <script type="text/javascript" src="Js/jnd28.js"></script>
    <script type="text/javascript">
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body mode="gm">
    <!--内容开始-->
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>加拿大28</span>
            <a class="f_r" href="#type">类型</a>
        </div>
        <?php include_once('u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span>当前彩种输赢：<em id="user_sy" class="sy_n">0.00</em></span>
                    <?php include_once('gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <div class="kj">
                <span><em id="numbers">000000</em>期开奖</span>
                <span id="open_num" class="xy28"></span>
            </div>
            <div class="pk">
                <span id="open_qihao">000000</span>期
                封盘剩：<span id="fp_time">00:00</span>
            </div>
            <div class="tz">
                <form name="orders" id="orders" action="Order/Order5.php?type=13" method="post" target="OrderFrame">
                    <div class="tz_box xy28">
                        <div class="tit">特码</div>
                        <?php
                        for($s = 1; $s <= 28; $s++) {
                            if($s % 2 == 1) {
                                echo '<ul>';
                            }
                            ?>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu"><em class="n_<?=$s - 1?>"></em></span>
                                        <span class="odds" id="ball_1_h<?=$s?>"></span>
                                    </div>
                                    <div class="inp" id="ball_1_t<?=$s?>"></div>
                                </div>
                            </li>
                            <?php
                            if($s % 2 == 0) {
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                    <div class="tz_box">
                        <div class="tit">混合</div>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">大</span>
                                        <span class="odds" id="ball_2_h1"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t1"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">小</span>
                                        <span class="odds" id="ball_2_h2"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t2"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">单</span>
                                        <span class="odds" id="ball_2_h3"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t3"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">双</span>
                                        <span class="odds" id="ball_2_h4"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t4"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">大双</span>
                                        <span class="odds" id="ball_2_h5"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t5"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">大单</span>
                                        <span class="odds" id="ball_2_h6"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t6"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">小双</span>
                                        <span class="odds" id="ball_2_h7"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t7"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">小单</span>
                                        <span class="odds" id="ball_2_h8"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t8"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">极大</span>
                                        <span class="odds" id="ball_2_h9"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t9"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">极小</span>
                                        <span class="odds" id="ball_2_h10"></span>
                                    </div>
                                    <div class="inp" id="ball_2_t10"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">红波</span>
                                        <span class="odds" id="ball_3_h1"></span>
                                    </div>
                                    <div class="inp" id="ball_3_t1"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">绿波</span>
                                        <span class="odds" id="ball_3_h2"></span>
                                    </div>
                                    <div class="inp" id="ball_3_t2"></div>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">蓝波</span>
                                        <span class="odds" id="ball_3_h3"></span>
                                    </div>
                                    <div class="inp" id="ball_3_t3"></div>
                                </div>
                            </li>
                            <li>
                                <div class="wf_box">
                                    <div class="wf_info">
                                        <input class="chk" type="checkbox">
                                        <span class="qiu">豹子</span>
                                        <span class="odds" id="ball_4_h1"></span>
                                    </div>
                                    <div class="inp" id="ball_4_t1"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
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