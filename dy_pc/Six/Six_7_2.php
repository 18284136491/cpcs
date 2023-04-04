<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
include("class/number_sx.php");
$uid = $_SESSION['uid'];
if (intval($web_site['six']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$kj = $_COOKIE['six_money'];
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
    <script type="text/javascript" src="js/class_1.js"></script>
    <link type="text/css" rel="stylesheet" href="../Lottery/css/ssc.css"/>
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
    <table cellspacing="0" cellpadding="0" border="0" class="gm_t3">
        <tr>
            <td height="27">
                <span>当前期数:【第</span><span id="open_qihao">0000000</span><span>期】</span>
                <span class="gm_type">波色&特肖</span>
                <input id="gm_mode" type="hidden" value="six_1" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
                <input id="cp_min" type="hidden" value="<?=$cp_zd?>" />
                <input id="cp_max" type="hidden" value="<?=$cp_zg?>" />
            </td>
            <td align="center">开奖时间：<span id="kj_time">0000-00-00 00:00:00</span></td>
            <td align="right">距离封盘时间：<span><em id="hour_show">0 时</em> <em id="minute_show">0 分</em> <em id="second_show">0 秒</em></span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=0" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six bg">
                <tr class="tit">
                    <td width="50">波色</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">红波</td>
                    <td class="bian_td_odds" id="ball_7_o62">-</td>
                    <td class="bian_td_inp" id="ball_7_m62">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_1"></em>
                        <em class="n_2"></em>
                        <em class="n_7"></em>
                        <em class="n_8"></em>
                        <em class="n_12"></em>
                        <em class="n_13"></em>
                        <em class="n_18"></em>
                        <em class="n_19"></em>
                        <em class="n_23"></em>
                        <em class="n_24"></em>
                        <em class="n_29"></em>
                        <em class="n_30"></em>
                        <em class="n_34"></em>
                        <em class="n_35"></em>
                        <em class="n_40"></em>
                        <em class="n_45"></em>
                        <em class="n_46"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">蓝波</td>
                    <td class="bian_td_odds" id="ball_7_o63">-</td>
                    <td class="bian_td_inp" id="ball_7_m63">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_3"></em>
                        <em class="n_4"></em>
                        <em class="n_9"></em>
                        <em class="n_10"></em>
                        <em class="n_14"></em>
                        <em class="n_15"></em>
                        <em class="n_20"></em>
                        <em class="n_25"></em>
                        <em class="n_26"></em>
                        <em class="n_31"></em>
                        <em class="n_36"></em>
                        <em class="n_37"></em>
                        <em class="n_41"></em>
                        <em class="n_42"></em>
                        <em class="n_47"></em>
                        <em class="n_48"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">绿波</td>
                    <td class="bian_td_odds" id="ball_7_o64">-</td>
                    <td class="bian_td_inp" id="ball_7_m64">&nbsp;</td>
                    <td class="bian_td_hms">
                        <em class="n_5"></em>
                        <em class="n_6"></em>
                        <em class="n_11"></em>
                        <em class="n_16"></em>
                        <em class="n_17"></em>
                        <em class="n_21"></em>
                        <em class="n_22"></em>
                        <em class="n_27"></em>
                        <em class="n_28"></em>
                        <em class="n_32"></em>
                        <em class="n_33"></em>
                        <em class="n_38"></em>
                        <em class="n_39"></em>
                        <em class="n_43"></em>
                        <em class="n_44"></em>
                        <em class="n_49"></em>
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg">
                <tr class="tit">
                    <td width="50">生肖</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                    <td width="50">生肖</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鼠</td>
                    <td class="bian_td_odds" id="ball_7_o65">-</td>
                    <td class="bian_td_inp" id="ball_7_m65">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_01 ?></td>
                    <td class="bian_td_qiu">牛</td>
                    <td class="bian_td_odds" id="ball_7_o66">-</td>
                    <td class="bian_td_inp" id="ball_7_m66">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_02 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_odds" id="ball_7_o67">-</td>
                    <td class="bian_td_inp" id="ball_7_m67">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_03 ?></td>
                    <td class="bian_td_qiu">兔</td>
                    <td class="bian_td_odds" id="ball_7_o68">-</td>
                    <td class="bian_td_inp" id="ball_7_m68">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_04 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_odds" id="ball_7_o69">-</td>
                    <td class="bian_td_inp" id="ball_7_m69">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_05 ?></td>
                    <td class="bian_td_qiu">蛇</td>
                    <td class="bian_td_odds" id="ball_7_o70">-</td>
                    <td class="bian_td_inp" id="ball_7_m70">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_06 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">马</td>
                    <td class="bian_td_odds" id="ball_7_o71">-</td>
                    <td class="bian_td_inp" id="ball_7_m71">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_07 ?></td>
                    <td class="bian_td_qiu">羊</td>
                    <td class="bian_td_odds" id="ball_7_o72">-</td>
                    <td class="bian_td_inp" id="ball_7_m72">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_08 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猴</td>
                    <td class="bian_td_odds" id="ball_7_o73">-</td>
                    <td class="bian_td_inp" id="ball_7_m73">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_09 ?></td>
                    <td class="bian_td_qiu">鸡</td>
                    <td class="bian_td_odds" id="ball_7_o74">-</td>
                    <td class="bian_td_inp" id="ball_7_m74">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_10 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">狗</td>
                    <td class="bian_td_odds" id="ball_7_o75">-</td>
                    <td class="bian_td_inp" id="ball_7_m75">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_11 ?></td>
                    <td class="bian_td_qiu">猪</td>
                    <td class="bian_td_odds" id="ball_7_o76">-</td>
                    <td class="bian_td_inp" id="ball_7_m76">&nbsp;</td>
                    <td class="bian_td_hms"><?= $sx_12 ?></td>
                </tr>
            </table>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>六合快速金额</label>
                        <input id="kj_money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" />
                        <a href="javascript:void(0);" onclick="kjNum('six_d');">删除</a>
                        <a href="javascript:void(0);" onclick="kjNum('six_s');">保存</a>
                        <input id="qi_num" type="hidden" name="qi_num" value=""/>
                    </div>
                    <button type="button" title="重填" onclick="formReset();">重填</button>
                    <button type="button" title="下注" onclick="order();" class="ml10">下注</button>
                </div>
            </div>
        </form>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript">
        loadInfo(7);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>