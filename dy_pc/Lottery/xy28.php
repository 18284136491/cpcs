<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/function.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
$uid = $_SESSION['uid'];

$type = $_GET['t'];
if(empty($type)) {
    $type = '混合盘';
}

$kj = $_COOKIE['kj_money'];
$cp_zd = $pk_db['彩票最低'];
$cp_zg = $pk_db['彩票最高'];
if($cp_zd <= 0) {
    $cp_zd = 1;
}
if($cp_zg <= 0) {
    $cp_zg = 1000000;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.cookie.js"></script>
    <script type="text/javascript" src="../js/form.min.js"></script>
    <script type="text/javascript" src="../js/marquee.js"></script>
    <script type="text/javascript" src="../js/flash.js"></script>
    <script type="text/javascript" src="../js/layer.js"></script>
    <script type="text/javascript" src="Js/xy28.js"></script>
    <link type="text/css" rel="stylesheet" href="Css/ssc.css"/>
    <script type="text/javascript">
        if (self == top) {
            top.location = '/main.php';
        }
        var islg = <?= $uid ? 1 : 0 ?>;
    </script>
</head>
<body>
    <!--内容开始-->
    <?php
    $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 5";
    $query = $mysqli->query($sql);
    $list = '';
    while($rs = $query->fetch_array()) {
        $list .= $rs['msg'] . ' | ';
    }
    ?>
    <div class="gonggao">
        <div class="list" onclick="gonggao()">
            <div id="gg"><?=$list?></div>
        </div>
        <div class="more"><a title="查看更多" href="javascript:gonggao();"></a></div>
    </div>
    <div class="news">
        <ul>
            <?php
            $query->data_seek(0);
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
    <table cellspacing="0" cellpadding="0" border="0" class="gm_t1">
        <tr>
            <td>PC蛋蛋 <span class="sy">当前彩种输赢：</span><span id="user_sy" class="sy_n">0.00</span>
                <input id="gm_mode" type="hidden" value="xy28" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />
            </td>
            <td align="right">
                <table cellspacing="0" cellpadding="0" border="0" class="kj">
                    <tr>
                        <td><span id="numbers">000000</span>期开奖</td>
                        <td id="open_num" class="xy28"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table cellspacing="0" cellpadding="0" border="0" class="gm_t2">
        <tr>
            <td><span id="open_qihao" class="qihao">000000</span>期 <span class="gm_type"><?=$type?></span></td>
            <td align="right">距离封盘：<span id="fp_time">00:00</span></td>
            <td align="right">距离开奖：<span id="kj_time" class="kj_time">00:00</span></td>
            <td align="right"><span id="rf_time">0秒</span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="Order/Order5.php?type=12" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 xy28">
                <tr class="tit">
                    <td>特码</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>特码</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>特码</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>特码</td>
                    <td>赔率</td>
                    <td>金额</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_0"></em></td>
                    <td class="bian_td_odds" id="ball_1_h1"></td>
                    <td class="bian_td_inp" id="ball_1_t1"></td>
                    <td class="bian_td_qiu"><em class="n_7"></em></td>
                    <td class="bian_td_odds" id="ball_1_h8"></td>
                    <td class="bian_td_inp" id="ball_1_t8"></td>
                    <td class="bian_td_qiu"><em class="n_14"></em></td>
                    <td class="bian_td_odds" id="ball_1_h15"></td>
                    <td class="bian_td_inp" id="ball_1_t15"></td>
                    <td class="bian_td_qiu"><em class="n_21"></em></td>
                    <td class="bian_td_odds" id="ball_1_h22"></td>
                    <td class="bian_td_inp" id="ball_1_t22"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_1"></em></td>
                    <td class="bian_td_odds" id="ball_1_h2"></td>
                    <td class="bian_td_inp" id="ball_1_t2"></td>
                    <td class="bian_td_qiu"><em class="n_8"></em></td>
                    <td class="bian_td_odds" id="ball_1_h9"></td>
                    <td class="bian_td_inp" id="ball_1_t9"></td>
                    <td class="bian_td_qiu"><em class="n_15"></em></td>
                    <td class="bian_td_odds" id="ball_1_h16"></td>
                    <td class="bian_td_inp" id="ball_1_t16"></td>
                    <td class="bian_td_qiu"><em class="n_22"></em></td>
                    <td class="bian_td_odds" id="ball_1_h23"></td>
                    <td class="bian_td_inp" id="ball_1_t23"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_2"></em></td>
                    <td class="bian_td_odds" id="ball_1_h3"></td>
                    <td class="bian_td_inp" id="ball_1_t3"></td>
                    <td class="bian_td_qiu"><em class="n_9"></em></td>
                    <td class="bian_td_odds" id="ball_1_h10"></td>
                    <td class="bian_td_inp" id="ball_1_t10"></td>
                    <td class="bian_td_qiu"><em class="n_16"></em></td>
                    <td class="bian_td_odds" id="ball_1_h17"></td>
                    <td class="bian_td_inp" id="ball_1_t17"></td>
                    <td class="bian_td_qiu"><em class="n_23"></em></td>
                    <td class="bian_td_odds" id="ball_1_h24"></td>
                    <td class="bian_td_inp" id="ball_1_t24"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_3"></em></td>
                    <td class="bian_td_odds" id="ball_1_h4"></td>
                    <td class="bian_td_inp" id="ball_1_t4"></td>
                    <td class="bian_td_qiu"><em class="n_10"></em></td>
                    <td class="bian_td_odds" id="ball_1_h11"></td>
                    <td class="bian_td_inp" id="ball_1_t11"></td>
                    <td class="bian_td_qiu"><em class="n_17"></em></td>
                    <td class="bian_td_odds" id="ball_1_h18"></td>
                    <td class="bian_td_inp" id="ball_1_t18"></td>
                    <td class="bian_td_qiu"><em class="n_24"></em></td>
                    <td class="bian_td_odds" id="ball_1_h25"></td>
                    <td class="bian_td_inp" id="ball_1_t25"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_4"></em></td>
                    <td class="bian_td_odds" id="ball_1_h5"></td>
                    <td class="bian_td_inp" id="ball_1_t5"></td>
                    <td class="bian_td_qiu"><em class="n_11"></em></td>
                    <td class="bian_td_odds" id="ball_1_h12"></td>
                    <td class="bian_td_inp" id="ball_1_t12"></td>
                    <td class="bian_td_qiu"><em class="n_18"></em></td>
                    <td class="bian_td_odds" id="ball_1_h19"></td>
                    <td class="bian_td_inp" id="ball_1_t19"></td>
                    <td class="bian_td_qiu"><em class="n_25"></em></td>
                    <td class="bian_td_odds" id="ball_1_h26"></td>
                    <td class="bian_td_inp" id="ball_1_t26"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_5"></em></td>
                    <td class="bian_td_odds" id="ball_1_h6"></td>
                    <td class="bian_td_inp" id="ball_1_t6"></td>
                    <td class="bian_td_qiu"><em class="n_12"></em></td>
                    <td class="bian_td_odds" id="ball_1_h13"></td>
                    <td class="bian_td_inp" id="ball_1_t13"></td>
                    <td class="bian_td_qiu"><em class="n_19"></em></td>
                    <td class="bian_td_odds" id="ball_1_h20"></td>
                    <td class="bian_td_inp" id="ball_1_t20"></td>
                    <td class="bian_td_qiu"><em class="n_26"></em></td>
                    <td class="bian_td_odds" id="ball_1_h27"></td>
                    <td class="bian_td_inp" id="ball_1_t27"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_6"></em></td>
                    <td class="bian_td_odds" id="ball_1_h7"></td>
                    <td class="bian_td_inp" id="ball_1_t7"></td>
                    <td class="bian_td_qiu"><em class="n_13"></em></td>
                    <td class="bian_td_odds" id="ball_1_h14"></td>
                    <td class="bian_td_inp" id="ball_1_t14"></td>
                    <td class="bian_td_qiu"><em class="n_20"></em></td>
                    <td class="bian_td_odds" id="ball_1_h21"></td>
                    <td class="bian_td_inp" id="ball_1_t21"></td>
                    <td class="bian_td_qiu"><em class="n_27"></em></td>
                    <td class="bian_td_odds" id="ball_1_h28"></td>
                    <td class="bian_td_inp" id="ball_1_t28"></td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr class="tr_txt">
                    <td class="bian_td_qiu">大</td>
                    <td class="bian_td_odds" id="ball_2_h1"></td>
                    <td class="bian_td_inp" id="ball_2_t1"></td>
                    <td class="bian_td_qiu">单</td>
                    <td class="bian_td_odds" id="ball_2_h3"></td>
                    <td class="bian_td_inp" id="ball_2_t3"></td>
                    <td class="bian_td_qiu">大单</td>
                    <td class="bian_td_odds" id="ball_2_h6"></td>
                    <td class="bian_td_inp" id="ball_2_t6"></td>
                    <td class="bian_td_qiu">大双</td>
                    <td class="bian_td_odds" id="ball_2_h5"></td>
                    <td class="bian_td_inp" id="ball_2_t5"></td>
                    <td class="bian_td_qiu">极大</td>
                    <td class="bian_td_odds" id="ball_2_h9"></td>
                    <td class="bian_td_inp" id="ball_2_t9"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">小</td>
                    <td class="bian_td_odds" id="ball_2_h2"></td>
                    <td class="bian_td_inp" id="ball_2_t2"></td>
                    <td class="bian_td_qiu">双</td>
                    <td class="bian_td_odds" id="ball_2_h4"></td>
                    <td class="bian_td_inp" id="ball_2_t4"></td>
                    <td class="bian_td_qiu">小单</td>
                    <td class="bian_td_odds" id="ball_2_h8"></td>
                    <td class="bian_td_inp" id="ball_2_t8"></td>
                    <td class="bian_td_qiu">小双</td>
                    <td class="bian_td_odds" id="ball_2_h7"></td>
                    <td class="bian_td_inp" id="ball_2_t7"></td>
                    <td class="bian_td_qiu">极小</td>
                    <td class="bian_td_odds" id="ball_2_h10"></td>
                    <td class="bian_td_inp" id="ball_2_t10"></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">红波</td>
                    <td class="bian_td_odds" id="ball_3_h1"></td>
                    <td class="bian_td_inp" id="ball_3_t1"></td>
                    <td class="bian_td_qiu">绿波</td>
                    <td class="bian_td_odds" id="ball_3_h2"></td>
                    <td class="bian_td_inp" id="ball_3_t2"></td>
                    <td class="bian_td_qiu">蓝波</td>
                    <td class="bian_td_odds" id="ball_3_h3"></td>
                    <td class="bian_td_inp" id="ball_3_t3"></td>
                    <td class="bian_td_qiu">豹子</td>
                    <td class="bian_td_odds" id="ball_4_h1"></td>
                    <td class="bian_td_inp" id="ball_4_t1"></td>
                    <td colspan="3"></td>
                </tr>
            </table>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>快速金额</label>
                        <input id="kj_money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" />
                        <a href="javascript:void(0);" onclick="kjNum('d');">删除</a>
                        <a href="javascript:void(0);" onclick="kjNum('s');">保存</a>
                        <input id="qi_num" type="hidden" name="qi_num" value=""/>
                    </div>
                    <button type="button" title="重填" onclick="formReset();">重填</button>
                    <button type="button" title="下注" onclick="order();" class="ml10">下注</button>
                </div>
            </div>
        </form>
    </div>
    <div id="play_sound"></div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript">
        loadinfo();
        rf_time(90);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>