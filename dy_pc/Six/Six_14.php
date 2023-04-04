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
                <span class="gm_type">尾数连</span>
                <input id="gm_mode" type="hidden" value="six_14" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
            </td>
            <td align="center">开奖时间：<span id="kj_time">0000-00-00 00:00:00</span></td>
            <td align="right">距离封盘时间：<span><em id="hour_show">0 时</em> <em id="minute_show">0 分</em> <em id="second_show">0 秒</em></span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=0&class=14" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six_1">
                <tr class="tit">
                    <td>尾数连</td>
                </tr>
                <tr class="tr_txt">
                    <td>
                        <input name='ball_14' type="radio" value='1'/> 二尾连中
                        <input name='ball_14' type="radio" value='2' style="margin-left: 20px"/> 三尾连中
                        <input name='ball_14' type="radio" value='3' style="margin-left: 20px"/> 四尾连中
                        <input name='ball_14' type="radio" value='4' style="margin-left: 20px"/> 五尾连中
                    </td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six bg">
                <tr class="tit">
                    <td>尾数</td>
                    <td>赔率</td>
                    <td>选择</td>
                    <td>所属号码</td>
                    <td>尾数</td>
                    <td>赔率</td>
                    <td>选择</td>
                    <td>所属号码</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">0尾</td>
                    <td class="bian_td_odds" id="ball_14_o1">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="1"/></td>
                    <td class="bian_td_hms">
                        <em class="n_10"></em>
                        <em class="n_20"></em>
                        <em class="n_30"></em>
                        <em class="n_40"></em>
                    </td>
                    <td class="bian_td_qiu">1尾</td>
                    <td class="bian_td_odds" id="ball_14_o2">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="2"/></td>
                    <td class="bian_td_hms">
                        <em class="n_1"></em>
                        <em class="n_11"></em>
                        <em class="n_21"></em>
                        <em class="n_31"></em>
                        <em class="n_41"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">2尾</td>
                    <td class="bian_td_odds" id="ball_14_o3">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="3"/></td>
                    <td class="bian_td_hms">
                        <em class="n_2"></em>
                        <em class="n_12"></em>
                        <em class="n_22"></em>
                        <em class="n_32"></em>
                        <em class="n_42"></em>
                    </td>
                    <td class="bian_td_qiu">3尾</td>
                    <td class="bian_td_odds" id="ball_14_o4">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="4"/></td>
                    <td class="bian_td_hms">
                        <em class="n_3"></em>
                        <em class="n_13"></em>
                        <em class="n_23"></em>
                        <em class="n_33"></em>
                        <em class="n_43"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">4尾</td>
                    <td class="bian_td_odds" id="ball_14_o5">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="5"/></td>
                    <td class="bian_td_hms">
                        <em class="n_4"></em>
                        <em class="n_14"></em>
                        <em class="n_24"></em>
                        <em class="n_34"></em>
                        <em class="n_44"></em>
                    </td>
                    <td class="bian_td_qiu">5尾</td>
                    <td class="bian_td_odds" id="ball_14_o6">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="6"/></td>
                    <td class="bian_td_hms">
                        <em class="n_5"></em>
                        <em class="n_15"></em>
                        <em class="n_25"></em>
                        <em class="n_35"></em>
                        <em class="n_45"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">6尾</td>
                    <td class="bian_td_odds" id="ball_14_o7">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="7"/></td>
                    <td class="bian_td_hms">
                        <em class="n_6"></em>
                        <em class="n_16"></em>
                        <em class="n_26"></em>
                        <em class="n_36"></em>
                        <em class="n_46"></em>
                    </td>
                    <td class="bian_td_qiu">7尾</td>
                    <td class="bian_td_odds" id="ball_14_o8">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="8"/></td>
                    <td class="bian_td_hms">
                        <em class="n_7"></em>
                        <em class="n_17"></em>
                        <em class="n_27"></em>
                        <em class="n_37"></em>
                        <em class="n_47"></em>
                    </td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">8尾</td>
                    <td class="bian_td_odds" id="ball_14_o9">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="9"/></td>
                    <td class="bian_td_hms">
                        <em class="n_8"></em>
                        <em class="n_18"></em>
                        <em class="n_28"></em>
                        <em class="n_38"></em>
                        <em class="n_48"></em>
                    </td>
                    <td class="bian_td_qiu">9尾</td>
                    <td class="bian_td_odds" id="ball_14_o10">-</td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="10"/></td>
                    <td class="bian_td_hms">
                        <em class="n_9"></em>
                        <em class="n_19"></em>
                        <em class="n_29"></em>
                        <em class="n_39"></em>
                        <em class="n_49"></em>
                    </td>
                </tr>
            </table>
            <div class="tool">
                <div class="wrap">
                    <div class="kuaisu">
                        <label>六合快速金额</label>
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
    <script type="text/javascript" src="js/class_14.js"></script>
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