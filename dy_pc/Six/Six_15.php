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
                <span class="gm_type">全不中</span>
                <input id="gm_mode" type="hidden" value="six_15" />
                <input id="u_name" type="hidden" value="<?=$_SESSION['username']?>" />
            </td>
            <td align="center">开奖时间：<span id="kj_time">0000-00-00 00:00:00</span></td>
            <td align="right">距离封盘时间：<span><em id="hour_show">0 时</em> <em id="minute_show">0 分</em> <em id="second_show">0 秒</em></span></td>
        </tr>
    </table>
    <div class="touzhu">
        <form name="orders" id="orders" action="order/order.php?type=0&class=15" method="post" target="OrderFrame">
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt5 six_1">
                <tr class="tit">
                    <td>类型</td>
                    <td>赔率</td>
                    <td>选择</td>
                    <td>类型</td>
                    <td>赔率</td>
                    <td>选择</td>
                    <td>类型</td>
                    <td>赔率</td>
                    <td>选择</td>
                    <td>类型</td>
                    <td>赔率</td>
                    <td>选择</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">五不中</td>
                    <td class="bian_td_odds" id="ball_15_o1">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='1'/></td>
                    <td class="bian_td_qiu">六不中</td>
                    <td class="bian_td_odds" id="ball_15_o2">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='2'/></td>
                    <td class="bian_td_qiu">七不中</td>
                    <td class="bian_td_odds" id="ball_15_o3">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='3'/></td>
                    <td class="bian_td_qiu">八不中</td>
                    <td class="bian_td_odds" id="ball_15_o4">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='4'/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu">九不中</td>
                    <td class="bian_td_odds" id="ball_15_o5">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='5'/></td>
                    <td class="bian_td_qiu">十不中</td>
                    <td class="bian_td_odds" id="ball_15_o6">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='6'/></td>
                    <td class="bian_td_qiu">十一不中</td>
                    <td class="bian_td_odds" id="ball_15_o7">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='7'/></td>
                    <td class="bian_td_qiu">十二不中</td>
                    <td class="bian_td_odds" id="ball_15_o8">-</td>
                    <td class="bian_td_no"><input name='ball_15' type="radio" value='8'/></td>
                </tr>
            </table>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10 six">
                <tr class="tit">
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                    <td>号码</td>
                    <td>选择</td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_1"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="1"/></td>
                    <td class="bian_td_qiu"><em class="n_11"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="11"/></td>
                    <td class="bian_td_qiu"><em class="n_21"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="21"/></td>
                    <td class="bian_td_qiu"><em class="n_31"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="31"/></td>
                    <td class="bian_td_qiu"><em class="n_41"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="41"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_2"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="2"/></td>
                    <td class="bian_td_qiu"><em class="n_12"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="12"/></td>
                    <td class="bian_td_qiu"><em class="n_22"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="22"/></td>
                    <td class="bian_td_qiu"><em class="n_32"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="32"/></td>
                    <td class="bian_td_qiu"><em class="n_42"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="42"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_3"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="3"/></td>
                    <td class="bian_td_qiu"><em class="n_13"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="13"/></td>
                    <td class="bian_td_qiu"><em class="n_23"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="23"/></td>
                    <td class="bian_td_qiu"><em class="n_33"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="33"/></td>
                    <td class="bian_td_qiu"><em class="n_43"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="43"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_4"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="4"/></td>
                    <td class="bian_td_qiu"><em class="n_14"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="14"/></td>
                    <td class="bian_td_qiu"><em class="n_24"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="24"/></td>
                    <td class="bian_td_qiu"><em class="n_34"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="34"/></td>
                    <td class="bian_td_qiu"><em class="n_44"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="44"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_5"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="5"/></td>
                    <td class="bian_td_qiu"><em class="n_15"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="15"/></td>
                    <td class="bian_td_qiu"><em class="n_25"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="25"/></td>
                    <td class="bian_td_qiu"><em class="n_35"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="35"/></td>
                    <td class="bian_td_qiu"><em class="n_45"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="45"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_6"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="6"/></td>
                    <td class="bian_td_qiu"><em class="n_16"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="16"/></td>
                    <td class="bian_td_qiu"><em class="n_26"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="26"/></td>
                    <td class="bian_td_qiu"><em class="n_36"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="36"/></td>
                    <td class="bian_td_qiu"><em class="n_46"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="46"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_7"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="7"/></td>
                    <td class="bian_td_qiu"><em class="n_17"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="17"/></td>
                    <td class="bian_td_qiu"><em class="n_27"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="27"/></td>
                    <td class="bian_td_qiu"><em class="n_37"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="37"/></td>
                    <td class="bian_td_qiu"><em class="n_47"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="47"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_8"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="8"/></td>
                    <td class="bian_td_qiu"><em class="n_18"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="18"/></td>
                    <td class="bian_td_qiu"><em class="n_28"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="28"/></td>
                    <td class="bian_td_qiu"><em class="n_38"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="38"/></td>
                    <td class="bian_td_qiu"><em class="n_48"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="48"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_9"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="9"/></td>
                    <td class="bian_td_qiu"><em class="n_19"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="19"/></td>
                    <td class="bian_td_qiu"><em class="n_29"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="29"/></td>
                    <td class="bian_td_qiu"><em class="n_39"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="39"/></td>
                    <td class="bian_td_qiu"><em class="n_49"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="49"/></td>
                </tr>
                <tr class="tr_txt">
                    <td class="bian_td_qiu"><em class="n_10"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="10"/></td>
                    <td class="bian_td_qiu"><em class="n_20"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="20"/></td>
                    <td class="bian_td_qiu"><em class="n_30"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="30"/></td>
                    <td class="bian_td_qiu"><em class="n_40"></em></td>
                    <td class="bian_td_no"><input name="ball[]" type="checkbox" value="40"/></td>
                    <td colspan="2" class="bian_td_no"><input type="hidden" name="o_num" value="0"></td>
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
    <script type="text/javascript" src="js/class_15.js"></script>
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