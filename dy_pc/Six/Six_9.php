<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include_once("../cache/group_" . $_SESSION['gid'] . ".php");
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
                <span class="gm_type">总和</span>
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
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5">
                <tr class="tit">
                    <td>总和</td>
                    <td>赔率</td>
                    <td>金额</td>
                    <td>总和</td>
                    <td>赔率</td>
                    <td>金额</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">大</td>
                    <td class="bian_td_odds" id="ball_9_o1">-</td>
                    <td class="bian_td_inp" id="ball_9_m1">&nbsp;</td>
                    <td class="bian_td_qiu">单</td>
                    <td class="bian_td_odds" id="ball_9_o3">-</td>
                    <td class="bian_td_inp" id="ball_9_m3">&nbsp;</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">小</td>
                    <td class="bian_td_odds" id="ball_9_o2">-</td>
                    <td class="bian_td_inp" id="ball_9_m2">&nbsp;</td>
                    <td class="bian_td_qiu">双</td>
                    <td class="bian_td_odds" id="ball_9_o4">-</td>
                    <td class="bian_td_inp" id="ball_9_m4">&nbsp;</td>
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
        loadInfo(9);
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>