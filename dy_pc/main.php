<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("include/lottery.inc.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("cache/website.php");

$lm      = 'main';
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
$userinfo = user::getinfo($uid);

$type = intval($_GET['t']);
if ($type < 1) $type = 4;
switch ($type) {
    case 1:
        $mainFrame = "Lottery/Cqssc.php";
        break;
    case 2:
        $mainFrame = "Lottery/Jxssc.php";
        break;
    case 3:
        $mainFrame = "Lottery/Xjssc.php";
        break;
    case 4:
        $mainFrame = "Lottery/Pk10.php";
        break;
    case 5:
        $mainFrame = "Lottery/Xyft.php";
        break;
    case 6:
        $mainFrame = "Lottery/Cqsf.php";
        break;
    case 7:
        $mainFrame = "Lottery/gdsf.php";
        break;
    case 8:
        $mainFrame = "Lottery/kl8.php";
        break;
    case 9:
        $mainFrame = "Lottery/3D.php";
        break;
    case 10:
        $mainFrame = "Lottery/pl3.php";
        break;
    case 11:
        $mainFrame = "Six/Six_7_1.php";
        break;
    case 12:
        $mainFrame = "Lottery/xy28.php";
        break;
    case 13:
        $mainFrame = "Lottery/jnd28.php";
        break;
	case 14:
		$mainFrame = "sports.php";
		break;
	case 15:
		$mainFrame = "mylive.php";
		break;
    default:
        $mainFrame = "Lottery/Pk10.php";
}
$t_day = date('Y-m-d', $lottery_time);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title><?=$web_site['web_title']?></title>
    <link rel="shortcuticon" href="/favicon.ico" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/form.min.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <script type="text/javascript" src="js/cp.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
</head>
<body>
<div class="gm_head">
    <div class="wrp">
		<div class="top">
			<div class="logo"></div>
			<div class="b_box">
				<div class="bar">
					<ul>
						<li><a href="javascript:void(0);" onclick="urlOnclick('member/userinfo.php');">会员资料</a></li>
						<li><a href="javascript:void(0);" onclick="urlOnclick('member/password.php')">修改密码</a></li>
						<li><a href="javascript:void(0);" onclick="urlOnclick('member/record_ss.php');">未结明细</a></li>
						<li><a href="javascript:void(0);" onclick="urlOnclick('member/cha_cp.php?rad=ygsds&cn_begin=<?=$t_day?>&cn_end=<?=$t_day?>&t=y')">今日已结</a></li>
						<?php if($_SESSION['username'] != 'guest') { ?>
							<li><a href="javascript:void(0);" onclick="urlOnclick('member/report.php');">账户历史</a></li>
						<?php } ?>
						<li><a href="javascript:void(0);" onclick="urlOnclick('member/agent.php');">代理中心</a></li>
						<li><a id="lskj" href="javascript:void(0);" onclick="gm_open(<?=$type?>);">历史开奖</a></li>
						<li><a id="yxgz" href="javascript:void(0);" onclick="gm_rules(<?=$type?>);">游戏规则</a></li>
						<li><a href="/logout.php">退出</a></li>
						<?php if($_SESSION['username'] == 'guest') { ?>
							<li><a class="reg" href="/myreg.php">正式开户</a></li>
						<?php } else { ?>
							<li><a class="reg" href="javascript:void(0);" onclick="urlOnclick('member/set_money.php');">在线充值</a></li>
							<li><a class="reg" href="javascript:void(0);" onclick="urlOnclick('member/get_money.php');">在线提款</a></li>
							<li><a class="reg" href="javascript:void(0);" onclick="urlOnclick('member/data_money.php');">存取记录</a></li>
							<li><a class="bak" href="javascript:void(0);">备用网址</a></li>
						<?php } ?>
					</ul>
				</div>
				<div class="nav">
					<ul>
						<li<?=$type == 4 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Pk10.php');" d_num="4">北京赛车PK拾</a></li>
						<li<?=$type == 5 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xyft.php');" d_num="5">幸运飞艇</a></li>
						<li<?=$type == 1 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php');" d_num="1">重庆时时彩</a></li>
						<li<?=$type == 7 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php');" d_num="7">广东快乐十分</a></li>
						<li<?=$type == 6 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php');" d_num="6">重庆幸运农场</a></li>
						<li<?=$type == 11 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_7_1.php');" d_num="11">香港六合彩</a></li>
						<li<?=$type == 14 ? ' class="cur"' : ''?>><a href="javascript:void(0);" onclick="urlOnclick('sports.php');" d_num="14">体育赛事</a></li>
						<li class="m_li<?=$type == 2 || $type == 3 || $type == 8 || $type == 9 || $type == 10 || $type == 12 || $type == 13 || $type == 15 ? ' cur' : ''?>">
							<span class="m_game">更多游戏 <em class="arrow"></em></span>
							<div class="m_div">
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php');" d_num="2">天津时时彩</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php');" d_num="3">新疆时时彩</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php');" d_num="8">北京快乐8</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php');" d_num="9">福彩3D</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php');" d_num="10">排列三</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/xy28.php');" d_num="12">PC蛋蛋</a>
								<a href="javascript:void(0);" onclick="urlOnclick('Lottery/jnd28.php');" d_num="13">加拿大28</a>
								<a href="javascript:void(0);" onclick="alert('即将上线敬请期待！');" d_num="15">真人娱乐</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
        <div class="type">
            <ul<?=$type == 1 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=数字盘');">数字盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=第三球');">第三球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=第四球');">第四球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqssc.php?t=第五球');">第五球</a></li>
            </ul>
            <ul<?=$type == 2 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=数字盘');">数字盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=第三球');">第三球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=第四球');">第四球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Jxssc.php?t=第五球');">第五球</a></li>
            </ul>
            <ul<?=$type == 3 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=数字盘');">数字盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=第三球');">第三球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=第四球');">第四球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xjssc.php?t=第五球');">第五球</a></li>
            </ul>
            <ul<?=$type == 4 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Pk10.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Pk10.php?t=冠,亚军 组合');">冠,亚军 组合</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Pk10.php?t=1~10定位');">1~10定位</a></li>
            </ul>
            <ul<?=$type == 5 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xyft.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xyft.php?t=冠,亚军 组合');">冠,亚军 组合</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Xyft.php?t=1~10定位');">1~10定位</a></li>
            </ul>
            <ul<?=$type == 6 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第三球');">第三球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第四球');">第四球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第五球');">第五球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第六球');">第六球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第七球');">第七球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=第八球');">第八球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/Cqsf.php?t=总和、龙虎');">总和、龙虎</a></li>
            </ul>
            <ul<?=$type == 7 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第三球');">第三球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第四球');">第四球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第五球');">第五球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第六球');">第六球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第七球');">第七球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=第八球');">第八球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/gdsf.php?t=总和、龙虎');">总和、龙虎</a></li>
            </ul>
            <ul<?=$type == 8 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=选一');">选一</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=选二');">选二</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=选三');">选三</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=选四');">选四</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/kl8.php?t=选五');">选五</a></li>
            </ul>
            <ul<?=$type == 9 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php?t=数字盘');">数字盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/3D.php?t=第三球');">第三球</a></li>
            </ul>
            <ul<?=$type == 10 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php?t=两面盘');">两面盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php?t=数字盘');">数字盘</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php?t=第一球');">第一球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php?t=第二球');">第二球</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/pl3.php?t=第三球');">第三球</a></li>
            </ul>
            <ul<?=$type == 11 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_7_1.php')">特码</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_8_3.php')">正码</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_1.php')">正码特</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_8_2.php')">过关</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_9.php')">总和</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_10.php')">一肖/尾数</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_7_2.php')">波色&特肖</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_11.php')">连码</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_12.php')">合肖</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_13.php')">生肖连</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_14.php')">尾数连</a></li>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Six/Six_15.php')">全不中</a></li>
            </ul>
            <ul<?=$type == 12 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/xy28.php?t=混合盘')">混合盘</a></li>
            </ul>
            <ul<?=$type == 13 ? ' class="on"' : ''?>>
                <li><a href="javascript:void(0);" onclick="urlOnclick('Lottery/jnd28.php?t=混合盘')">混合盘</a></li>
            </ul>
			<ul<?=$type == 14 ? ' class="on"' : ''?>></ul>
			<ul<?=$type == 15 ? ' class="on"' : ''?>></ul>
        </div>
    </div>
</div>
<div class="gm_left">
    <div id="info">
        <table cellspacing="0" cellpadding="0" border="0">
            <thead>
                <tr>
                    <th colspan="2">账户信息</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="30%">会员账号：</td>
                    <td><?=$_SESSION['username']?></td>
                </tr>
                <tr>
                    <td>可用金额：</td>
                    <td id="money"><?=$userinfo['money']?> 元</td>
                </tr>
            </tbody>
        </table>
        <table id="kj_info" cellspacing="0" cellpadding="0" border="0"<?= $type > 13 ? ' style="display: none"' : '' ?>>
            <thead>
                <tr>
                    <th><span id="gm_name"></span>最近十期开奖结果<span id="yc" class="yc">[隐藏]</span></th>
                </tr>
            </thead>
        </table>
        <table id="kj_list" cellspacing="0" cellpadding="0" border="0"></table>
    </div>
    <div id="user_order"></div>
</div>
<div class="gm_main">
    <iframe id="mainFrame" name="mainFrame" frameborder="0" scrolling="auto" src="<?= $mainFrame ?>"></iframe>
</div>
<script type="text/javascript">
    function get_money() {
        $.getJSON("/leftDao.php?callback=?", function(json) {
            $("#money").html(json.user_money);
        });
        setTimeout(get_money, 5000);
    }
    get_money();
	$(".m_game").click(function() {
		$(".m_div").toggle();
	});
    $(".nav a").click(function() {
        var p = $(this).closest("li");
        var i = $(this).attr("d_num");
		if(i == 15) {return false;}
        if(!p.hasClass("cur")) {
            p.addClass("cur").siblings().removeClass("cur");
        }
		$(".m_div").hide();
        $(".type ul").removeClass("on").eq(i - 1).addClass("on");
        $("#lskj").attr("onclick", "gm_open(" + i + ");");
        $("#yxgz").attr("onclick", "gm_rules(" + i + ");");
		if(i > 13) {
			$("#kj_info").hide();
			$("#kj_list").html("");
			$("#user_order").html("");
		} else {
			$("#kj_info").show();
		}
    });
    $("#yc").click(function() {
        if($(this).text() == '[隐藏]') {
            $(this).text('[显示]');
        } else {
            $(this).text('[隐藏]');
        }
        $("#kj_list").toggle();
    });
</script>
</body>
</html>
