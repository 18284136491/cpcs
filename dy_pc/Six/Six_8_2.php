<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/login_check.php");
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
    <script type="text/javascript" src="js/class_2.js"></script>
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
                <span class="gm_type">过关</span>
                <input id="gm_mode" type="hidden" value="six_2" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
            </td>
            <td align="center">开奖时间：<span id="kj_time">0000-00-00 00:00:00</span></td>
            <td align="right">距离封盘时间：<span><em id="hour_show">0 时</em> <em id="minute_show">0 分</em> <em id="second_show">0 秒</em></span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=0&class=8" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six_1">
                <tr class="tit">
                    <td>过关</td>
                    <td>大码</td>
                    <td>小码</td>
                    <td>单码</td>
                    <td>双码</td>
                    <td>合大</td>
                    <td>合小</td>
                    <td>合单</td>
                    <td>合双</td>
                    <td>尾大</td>
                    <td>尾小</td>
                    <td>红波</td>
                    <td>蓝波</td>
                    <td>绿波</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正一</td>
                    <td><input name='ball_1' type="radio" value='1_50'/> <span class="bian_td_odds" id="ball_1_o50">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_51'/> <span class="bian_td_odds" id="ball_1_o51">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_52'/> <span class="bian_td_odds" id="ball_1_o52">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_53'/> <span class="bian_td_odds" id="ball_1_o53">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_54'/> <span class="bian_td_odds" id="ball_1_o54">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_55'/> <span class="bian_td_odds" id="ball_1_o55">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_56'/> <span class="bian_td_odds" id="ball_1_o56">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_57'/> <span class="bian_td_odds" id="ball_1_o57">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_58'/> <span class="bian_td_odds" id="ball_1_o58">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_59'/> <span class="bian_td_odds" id="ball_1_o59">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_62'/> <span class="bian_td_odds" id="ball_1_o62">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_63'/> <span class="bian_td_odds" id="ball_1_o63">-</span></td>
                    <td><input name='ball_1' type="radio" value='1_64'/> <span class="bian_td_odds" id="ball_1_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正二</td>
                    <td><input name='ball_2' type="radio" value='2_50'/> <span class="bian_td_odds" id="ball_2_o50">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_51'/> <span class="bian_td_odds" id="ball_2_o51">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_52'/> <span class="bian_td_odds" id="ball_2_o52">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_53'/> <span class="bian_td_odds" id="ball_2_o53">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_54'/> <span class="bian_td_odds" id="ball_2_o54">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_55'/> <span class="bian_td_odds" id="ball_2_o55">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_56'/> <span class="bian_td_odds" id="ball_2_o56">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_57'/> <span class="bian_td_odds" id="ball_2_o57">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_58'/> <span class="bian_td_odds" id="ball_2_o58">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_59'/> <span class="bian_td_odds" id="ball_2_o59">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_62'/> <span class="bian_td_odds" id="ball_2_o62">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_63'/> <span class="bian_td_odds" id="ball_2_o63">-</span></td>
                    <td><input name='ball_2' type="radio" value='2_64'/> <span class="bian_td_odds" id="ball_2_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正三</td>
                    <td><input name='ball_3' type="radio" value='3_50'/> <span class="bian_td_odds" id="ball_3_o50">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_51'/> <span class="bian_td_odds" id="ball_3_o51">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_52'/> <span class="bian_td_odds" id="ball_3_o52">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_53'/> <span class="bian_td_odds" id="ball_3_o53">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_54'/> <span class="bian_td_odds" id="ball_3_o54">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_55'/> <span class="bian_td_odds" id="ball_3_o55">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_56'/> <span class="bian_td_odds" id="ball_3_o56">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_57'/> <span class="bian_td_odds" id="ball_3_o57">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_58'/> <span class="bian_td_odds" id="ball_3_o58">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_59'/> <span class="bian_td_odds" id="ball_3_o59">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_62'/> <span class="bian_td_odds" id="ball_3_o62">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_63'/> <span class="bian_td_odds" id="ball_3_o63">-</span></td>
                    <td><input name='ball_3' type="radio" value='3_64'/> <span class="bian_td_odds" id="ball_3_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正四</td>
                    <td><input name='ball_4' type="radio" value='4_50'/> <span class="bian_td_odds" id="ball_4_o50">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_51'/> <span class="bian_td_odds" id="ball_4_o51">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_52'/> <span class="bian_td_odds" id="ball_4_o52">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_53'/> <span class="bian_td_odds" id="ball_4_o53">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_54'/> <span class="bian_td_odds" id="ball_4_o54">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_55'/> <span class="bian_td_odds" id="ball_4_o55">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_56'/> <span class="bian_td_odds" id="ball_4_o56">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_57'/> <span class="bian_td_odds" id="ball_4_o57">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_58'/> <span class="bian_td_odds" id="ball_4_o58">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_59'/> <span class="bian_td_odds" id="ball_4_o59">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_62'/> <span class="bian_td_odds" id="ball_4_o62">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_63'/> <span class="bian_td_odds" id="ball_4_o63">-</span></td>
                    <td><input name='ball_4' type="radio" value='4_64'/> <span class="bian_td_odds" id="ball_4_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正五</td>
                    <td><input name='ball_5' type="radio" value='5_50'/> <span class="bian_td_odds" id="ball_5_o50">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_51'/> <span class="bian_td_odds" id="ball_5_o51">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_52'/> <span class="bian_td_odds" id="ball_5_o52">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_53'/> <span class="bian_td_odds" id="ball_5_o53">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_54'/> <span class="bian_td_odds" id="ball_5_o54">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_55'/> <span class="bian_td_odds" id="ball_5_o55">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_56'/> <span class="bian_td_odds" id="ball_5_o56">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_57'/> <span class="bian_td_odds" id="ball_5_o57">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_58'/> <span class="bian_td_odds" id="ball_5_o58">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_59'/> <span class="bian_td_odds" id="ball_5_o59">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_62'/> <span class="bian_td_odds" id="ball_5_o62">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_63'/> <span class="bian_td_odds" id="ball_5_o63">-</span></td>
                    <td><input name='ball_5' type="radio" value='5_64'/> <span class="bian_td_odds" id="ball_5_o64">-</span></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">正六</td>
                    <td><input name='ball_6' type="radio" value='6_50'/> <span class="bian_td_odds" id="ball_6_o50">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_51'/> <span class="bian_td_odds" id="ball_6_o51">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_52'/> <span class="bian_td_odds" id="ball_6_o52">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_53'/> <span class="bian_td_odds" id="ball_6_o53">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_54'/> <span class="bian_td_odds" id="ball_6_o54">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_55'/> <span class="bian_td_odds" id="ball_6_o55">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_56'/> <span class="bian_td_odds" id="ball_6_o56">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_57'/> <span class="bian_td_odds" id="ball_6_o57">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_58'/> <span class="bian_td_odds" id="ball_6_o58">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_59'/> <span class="bian_td_odds" id="ball_6_o59">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_62'/> <span class="bian_td_odds" id="ball_6_o62">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_63'/> <span class="bian_td_odds" id="ball_6_o63">-</span></td>
                    <td><input name='ball_6' type="radio" value='6_64'/> <span class="bian_td_odds" id="ball_6_o64">-</span></td>
                </tr>
            </table>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>过关下注金额</label>
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
    <script type="text/javascript">
        loadInfo();
        $("#gg").liMarquee({
			circular: false
		});
    </script>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>