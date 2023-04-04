<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
if(intval($web_site['pl3']) == 1) {
    include('close_cp.php');
    exit();
}
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
    <script type="text/javascript" src="js/pl3.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
    <script type="text/javascript">
        if (self == top) {
            top.location = '/main.php';
        }
        var islg =<?=$uid ? 1 : 0?>;
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
            <td>排列三 <span class="sy">当前彩种输赢：</span><span id="user_sy" class="sy_n">0.00</span>
                <input id="gm_mode" type="hidden" value="pl3" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />
            </td>
            <td align="right">
                <table cellspacing="0" cellpadding="0" border="0" class="kj">
                    <tr>
                        <td><span id="numbers">000000</span>期开奖</td>
                        <td id="open_num" class="ssc"></td>
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
        <form name="orders" id="orders" action="order/order.php?type=10" method="post" target="OrderFrame">
            <?php if($type == '两面盘') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4">
                        <tr>
                            <td class="tit" colspan="3">第一球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_1_h11"></td>
                            <td class="bian_td_inp" id="ball_1_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_1_h12"></td>
                            <td class="bian_td_inp" id="ball_1_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_1_h13"></td>
                            <td class="bian_td_inp" id="ball_1_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_1_h14"></td>
                            <td class="bian_td_inp" id="ball_1_t14"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4">
                        <tr>
                            <td class="tit" colspan="3">第二球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_2_h11"></td>
                            <td class="bian_td_inp" id="ball_2_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_2_h12"></td>
                            <td class="bian_td_inp" id="ball_2_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_2_h13"></td>
                            <td class="bian_td_inp" id="ball_2_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_2_h14"></td>
                            <td class="bian_td_inp" id="ball_2_t14"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4">
                        <tr>
                            <td class="tit" colspan="3">第三球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">大</td>
                            <td class="bian_td_odds" id="ball_3_h11"></td>
                            <td class="bian_td_inp" id="ball_3_t11"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">小</td>
                            <td class="bian_td_odds" id="ball_3_h12"></td>
                            <td class="bian_td_inp" id="ball_3_t12"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">单</td>
                            <td class="bian_td_odds" id="ball_3_h13"></td>
                            <td class="bian_td_inp" id="ball_3_t13"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu">双</td>
                            <td class="bian_td_odds" id="ball_3_h14"></td>
                            <td class="bian_td_inp" id="ball_3_t14"></td>
                        </tr>
                    </table>
                </div>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和大</td>
                        <td class="bian_td_odds" id="ball_4_h1"></td>
                        <td class="bian_td_inp" id="ball_4_t1"></td>
                        <td class="bian_td_qiu">总和单</td>
                        <td class="bian_td_odds" id="ball_4_h3"></td>
                        <td class="bian_td_inp" id="ball_4_t3"></td>
                        <td class="bian_td_qiu">龙</td>
                        <td class="bian_td_odds" id="ball_4_h5"></td>
                        <td class="bian_td_inp" id="ball_4_t5"></td>
                        <td class="bian_td_qiu">和</td>
                        <td class="bian_td_odds" id="ball_4_h7"></td>
                        <td class="bian_td_inp" id="ball_4_t7"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">总和小</td>
                        <td class="bian_td_odds" id="ball_4_h2"></td>
                        <td class="bian_td_inp" id="ball_4_t2"></td>
                        <td class="bian_td_qiu">总和双</td>
                        <td class="bian_td_odds" id="ball_4_h4"></td>
                        <td class="bian_td_inp" id="ball_4_t4"></td>
                        <td class="bian_td_qiu">虎</td>
                        <td class="bian_td_odds" id="ball_4_h6"></td>
                        <td class="bian_td_inp" id="ball_4_t6"></td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            <?php } elseif($type == '数字盘') { ?>
                <div class="t_box">
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4 ssc">
                        <tr>
                            <td class="tit" colspan="3">第一球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_1_h1"></td>
                            <td class="bian_td_inp" id="ball_1_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_1_h2"></td>
                            <td class="bian_td_inp" id="ball_1_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_1_h3"></td>
                            <td class="bian_td_inp" id="ball_1_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_1_h4"></td>
                            <td class="bian_td_inp" id="ball_1_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_1_h5"></td>
                            <td class="bian_td_inp" id="ball_1_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_1_h6"></td>
                            <td class="bian_td_inp" id="ball_1_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_1_h7"></td>
                            <td class="bian_td_inp" id="ball_1_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_1_h8"></td>
                            <td class="bian_td_inp" id="ball_1_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_1_h9"></td>
                            <td class="bian_td_inp" id="ball_1_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_1_h10"></td>
                            <td class="bian_td_inp" id="ball_1_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4 ssc">
                        <tr>
                            <td class="tit" colspan="3">第二球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_2_h1"></td>
                            <td class="bian_td_inp" id="ball_2_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_2_h2"></td>
                            <td class="bian_td_inp" id="ball_2_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_2_h3"></td>
                            <td class="bian_td_inp" id="ball_2_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_2_h4"></td>
                            <td class="bian_td_inp" id="ball_2_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_2_h5"></td>
                            <td class="bian_td_inp" id="ball_2_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_2_h6"></td>
                            <td class="bian_td_inp" id="ball_2_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_2_h7"></td>
                            <td class="bian_td_inp" id="ball_2_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_2_h8"></td>
                            <td class="bian_td_inp" id="ball_2_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_2_h9"></td>
                            <td class="bian_td_inp" id="ball_2_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_2_h10"></td>
                            <td class="bian_td_inp" id="ball_2_t10"></td>
                        </tr>
                    </table>
                    <table cellspacing="1" cellpadding="0" border="0" class="tab4 ssc">
                        <tr>
                            <td class="tit" colspan="3">第三球</td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_0"></em></td>
                            <td class="bian_td_odds" id="ball_3_h1"></td>
                            <td class="bian_td_inp" id="ball_3_t1"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_1"></em></td>
                            <td class="bian_td_odds" id="ball_3_h2"></td>
                            <td class="bian_td_inp" id="ball_3_t2"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_2"></em></td>
                            <td class="bian_td_odds" id="ball_3_h3"></td>
                            <td class="bian_td_inp" id="ball_3_t3"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_3"></em></td>
                            <td class="bian_td_odds" id="ball_3_h4"></td>
                            <td class="bian_td_inp" id="ball_3_t4"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_4"></em></td>
                            <td class="bian_td_odds" id="ball_3_h5"></td>
                            <td class="bian_td_inp" id="ball_3_t5"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_5"></em></td>
                            <td class="bian_td_odds" id="ball_3_h6"></td>
                            <td class="bian_td_inp" id="ball_3_t6"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_6"></em></td>
                            <td class="bian_td_odds" id="ball_3_h7"></td>
                            <td class="bian_td_inp" id="ball_3_t7"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_7"></em></td>
                            <td class="bian_td_odds" id="ball_3_h8"></td>
                            <td class="bian_td_inp" id="ball_3_t8"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_8"></em></td>
                            <td class="bian_td_odds" id="ball_3_h9"></td>
                            <td class="bian_td_inp" id="ball_3_t9"></td>
                        </tr>
                        <tr class="tr_txt">
                            <td class="bian_td_qiu"><em class="n_9"></em></td>
                            <td class="bian_td_odds" id="ball_3_h10"></td>
                            <td class="bian_td_inp" id="ball_3_t10"></td>
                        </tr>
                    </table>
                </div>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 ssc">
                    <tr>
                        <td class="tit" colspan="15">跨度</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_0"></em></td>
                        <td class="bian_td_odds" id="ball_6_h1"></td>
                        <td class="bian_td_inp" id="ball_6_t1"></td>
                        <td class="bian_td_qiu"><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_6_h3"></td>
                        <td class="bian_td_inp" id="ball_6_t3"></td>
                        <td class="bian_td_qiu"><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_6_h5"></td>
                        <td class="bian_td_inp" id="ball_6_t5"></td>
                        <td class="bian_td_qiu"><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_6_h7"></td>
                        <td class="bian_td_inp" id="ball_6_t7"></td>
                        <td class="bian_td_qiu"><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_6_h9"></td>
                        <td class="bian_td_inp" id="ball_6_t9"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_6_h2"></td>
                        <td class="bian_td_inp" id="ball_6_t2"></td>
                        <td class="bian_td_qiu"><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_6_h4"></td>
                        <td class="bian_td_inp" id="ball_6_t4"></td>
                        <td class="bian_td_qiu"><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_6_h6"></td>
                        <td class="bian_td_inp" id="ball_6_t6"></td>
                        <td class="bian_td_qiu"><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_6_h8"></td>
                        <td class="bian_td_inp" id="ball_6_t8"></td>
                        <td class="bian_td_qiu"><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_6_h10"></td>
                        <td class="bian_td_inp" id="ball_6_t10"></td>
                    </tr>
                </table>
            <?php } elseif($type == '第一球' || $type == '第二球' || $type == '第三球') { ?>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 ssc">
                    <tr class="tit">
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                        <td>号码</td>
                        <td>赔率</td>
                        <td>金额</td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_0"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h1"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t1"></td>
                        <td class="bian_td_qiu"><em class="n_1"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h2"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t2"></td>
                        <td class="bian_td_qiu"><em class="n_2"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h3"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t3"></td>
                        <td class="bian_td_qiu"><em class="n_3"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h4"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t4"></td>
                        <td class="bian_td_qiu"><em class="n_4"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h5"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t5"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu"><em class="n_5"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h6"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t6"></td>
                        <td class="bian_td_qiu"><em class="n_6"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h7"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t7"></td>
                        <td class="bian_td_qiu"><em class="n_7"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h8"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t8"></td>
                        <td class="bian_td_qiu"><em class="n_8"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h9"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t9"></td>
                        <td class="bian_td_qiu"><em class="n_9"></em></td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h10"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t10"></td>
                    </tr>
                </table>
                <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">大</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h11"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t11"></td>
                        <td class="bian_td_qiu">总和大</td>
                        <td class="bian_td_odds" id="ball_4_h1"></td>
                        <td class="bian_td_inp" id="ball_4_t1"></td>
                        <td class="bian_td_qiu">龙</td>
                        <td class="bian_td_odds" id="ball_4_h5"></td>
                        <td class="bian_td_inp" id="ball_4_t5"></td>
                        <td class="bian_td_qiu">顺子</td>
                        <td class="bian_td_odds" id="ball_5_h2"></td>
                        <td class="bian_td_inp" id="ball_5_t2"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">小</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h12"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t12"></td>
                        <td class="bian_td_qiu">总和小</td>
                        <td class="bian_td_odds" id="ball_4_h2"></td>
                        <td class="bian_td_inp" id="ball_4_t2"></td>
                        <td class="bian_td_qiu">虎</td>
                        <td class="bian_td_odds" id="ball_4_h6"></td>
                        <td class="bian_td_inp" id="ball_4_t6"></td>
                        <td class="bian_td_qiu">对子</td>
                        <td class="bian_td_odds" id="ball_5_h3"></td>
                        <td class="bian_td_inp" id="ball_5_t3"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">单</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h13"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t13"></td>
                        <td class="bian_td_qiu">总和单</td>
                        <td class="bian_td_odds" id="ball_4_h3"></td>
                        <td class="bian_td_inp" id="ball_4_t3"></td>
                        <td class="bian_td_qiu">和</td>
                        <td class="bian_td_odds" id="ball_4_h7"></td>
                        <td class="bian_td_inp" id="ball_4_t7"></td>
                        <td class="bian_td_qiu">半顺</td>
                        <td class="bian_td_odds" id="ball_5_h4"></td>
                        <td class="bian_td_inp" id="ball_5_t4"></td>
                    </tr>
                    <tr class="tr_txt">
                        <td class="bian_td_qiu">双</td>
                        <td class="bian_td_odds" id="ball_<?=$g_i?>_h14"></td>
                        <td class="bian_td_inp" id="ball_<?=$g_i?>_t14"></td>
                        <td class="bian_td_qiu">总和双</td>
                        <td class="bian_td_odds" id="ball_4_h4"></td>
                        <td class="bian_td_inp" id="ball_4_t4"></td>
                        <td class="bian_td_qiu">豹子</td>
                        <td class="bian_td_odds" id="ball_5_h1"></td>
                        <td class="bian_td_inp" id="ball_5_t1"></td>
                        <td class="bian_td_qiu">杂六</td>
                        <td class="bian_td_odds" id="ball_5_h5"></td>
                        <td class="bian_td_inp" id="ball_5_t5"></td>
                    </tr>
                </table>
            <?php } ?>
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
        loadinfo(<?=$g_i?>);
        rf_time(90);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>