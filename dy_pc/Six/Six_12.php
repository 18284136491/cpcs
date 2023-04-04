<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
include("class/number_sx.php");
$uid = $_SESSION['uid'];
if (intval($web_site['six']) == 1) {
    include('../Lottery/close_cp.php');
    exit();
}
$kj = $_COOKIE['six_money'];

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
                <span class="gm_type">合肖</span>
                <input id="gm_mode" type="hidden" value="six_12" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
            </td>
            <td align="center">开奖时间：<span id="kj_time">0000-00-00 00:00:00</span></td>
            <td align="right">距离封盘时间：<span><em id="hour_show">0 时</em> <em id="minute_show">0 分</em> <em id="second_show">0 秒</em></span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=0&class=12" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six bg">
                <tr class="tit">
                    <td>生肖</td>
                    <td width="56">选择</td>
                    <td width="314">所属号码</td>
                    <td>生肖</td>
                    <td width="56">选择</td>
                    <td width="314">所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">鼠</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="1"/></td>
                    <td class="bian_td_hms"><?= $sx_01 ?></td>
                    <td class="bian_td_qiu">牛</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="2"/></td>
                    <td class="bian_td_hms"><?= $sx_02 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="3"/></td>
                    <td class="bian_td_hms"><?= $sx_03 ?></td>
                    <td class="bian_td_qiu">兔</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="4"/></td>
                    <td class="bian_td_hms"><?= $sx_04 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="5"/></td>
                    <td class="bian_td_hms"><?= $sx_05 ?></td>
                    <td class="bian_td_qiu">蛇</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="6"/></td>
                    <td class="bian_td_hms"><?= $sx_06 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">马</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="7"/></td>
                    <td class="bian_td_hms"><?= $sx_07 ?></td>
                    <td class="bian_td_qiu">羊</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="8"/></td>
                    <td class="bian_td_hms"><?= $sx_08 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">猴</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="9"/></td>
                    <td class="bian_td_hms"><?= $sx_09 ?></td>
                    <td class="bian_td_qiu">鸡</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="10"/></td>
                    <td class="bian_td_hms"><?= $sx_10 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">狗</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="11"/></td>
                    <td class="bian_td_hms"><?= $sx_11 ?></td>
                    <td class="bian_td_qiu">猪</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="12"/></td>
                    <td class="bian_td_hms"><?= $sx_12 ?></td>
                </tr>
                <tr class="tr_txt">
                    <td colspan="6">
                        <span>赔率：</span>
                        <span id="odds" class="bian_td_odds">-</span>
                    </td>
                </tr>
            </table>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>合肖下注金额</label>
                        <input id="kj_money" name="money" class="kj_inp" type="text" value="<?=$kj > 0 ? $kj : ''?>" />
                        <a href="javascript:void(0);" onclick="kjNum('six_d');">删除</a>
                        <a href="javascript:void(0);" onclick="kjNum('six_s');">保存</a>
                        <input id="qi_num" type="hidden" name="qi_num" value=""/>
                    </div>
                    <button type="button" title="重选" onclick="formReset();">重选</button>
                    <button type="button" title="下注" onclick="order();" class="ml10">下注</button>
                </div>
            </div>
        </form>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="js/class_12.js"></script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
    <script type="text/javascript">
        loadInfo();
        $("#gg").liMarquee({
			circular: false
		});
    </script>
</body>
</html>