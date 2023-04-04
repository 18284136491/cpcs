<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myjoin';
$msg = "";
$sql = "select msg from k_notice where end_time>now() and is_show=1 order by `sort` desc,nid desc limit 0,5";
$query = $mysqli->query($sql);
while ($rs = $query->fetch_array()) {
    $msg .= $rs['msg'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!--[if lte IE 6]>
<html class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="skin/js/common.js?_=171"></script>
    <script type="text/javascript" src="skin/js/upup.js?_=171"></script>
    <script type="text/javascript" src="skin/js/float.js?_=171"></script>
    <script type="text/javascript" src="skin/js/swfobject.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jquery.cookie.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jingcheng.js?_=171"></script>
    <script type="text/javascript" src="skin/js/top.js?_=171"></script>
    <script type="text/javascript" src="box/jquery.jBox-2.3.min.js"></script>
    <script type="text/javascript" src="box/jquery.jBox-zh-CN.js"></script>
    <link type="text/css" rel="stylesheet" href="box/Green/jbox.css"/>
    <link href="newindex/standard.css?_=171" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/primary-red.css"/>
    <script type="text/javascript" src="skin/js/tab.js?_=171"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
    <script type="text/javascript" src="newindex/zb.js"></script>
    <link href="newindex/zb.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/IE.css"/>
    <script src="js/html5.js"></script>
    <script type="text/javascript" src="js/IE.js"></script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="help about_wel"></div>
<div class="help about_bg">
    <div class="about_main">
        <div class="about_top">
            <div id="m-left" class="m-left" onclick="deng.gourl('','noticle')">
                <div class="bd">
                    <ul>
                        <?php
                        $sql = "select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,5";
                        $query = $mysqli->query($sql);
                        $str = "";
                        while ($row = $query->fetch_array()) {
                            $str .= "<li>";
                            $str .= "★ " . $row["msg"];
                            $str .= "</li>";
                        }
                        echo $str;
                        ?>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                $("#m-left").slide({mainCell: ".bd ul", autoPlay: true, effect: "leftMarquee", interTime: 25});
            </script>
        </div>
        <div class="about_con">
            <div class="about_con_top"></div>
            <div class="about_text">
                <?php include_once("myleft.php"); ?>
                <div class="about_right">

                    <div style="width: 690px; margin: 0 auto; text-align: left;padding-bottom: 20px" id="articles">

                        <style type="text/css">
                            ul.mtab-menual {
                                list-style: none;
                                border-bottom: 3px solid #AAA;
                                margin-top: 10px;
                            }

                            ul.mtab-menual li {
                                color: #d4d4d4;
                                background-color: #404040;
                                display: inline-block;
                                margin-right: 4px;
                                padding: 1px 10px;
                                cursor: pointer;
                                border-radius: 5px 5px 0 0;
                                transition: background-color .4s;
                            }
                        </style>
                        <div id="Union">
                            <ul class="mtab-menual">
                                <li style="background-position: 0% 0%;" class="mtab" sort="0">联盟方案</li>
                                <li style="background-position: 0% 0%;" class="" sort="1">联盟协议</li>
                            </ul>
                            <div style="display: block;" id="Union0">
                                <p>	<strong>◎联盟方案</strong> </p><p style="margin-left:4.5pt;">	澳门永利娱乐城。拥有多元化的产品，使用最公平、公正、公开的系统，在市场上的众多博彩网站中，我们自豪的提供会员最优惠的回馈，给予合作伙伴最优势的营利回报! 无论您拥有的是网路资源，或是人脉资源，都欢迎您来加入<span>澳门永利娱乐城</span>合作伙伴的行列， 无须负担任何费用，就可以开始无上限的收入。<span>澳门永利娱乐城</span>，绝对是您最理智的选择!</p><p>	<strong>◎注册申请</strong> </p><p style="margin-left:4.5pt;">	请随时向<span>澳门永利娱乐城</span>客服、或线上留言提出申请，并确实填写联系方式，一定要确实留下有效电邮。澳门永利娱乐城会评估审核联盟申请讯息，            并将通知申请结果，包括您的注册帐号、密码,及链接。<span style="color:#FF0000;">立即联络我们</span>!</p><table cellspacing="1" cellpadding="1" border="1" style="width:612px;height:226px;color:white;">	<tbody>		<tr>			<td width="152" style="text-align:center;background-color:#996600;" rowspan="2">				<span style="color:#FFFFFF;"><strong>当月营利</strong></span> 			</td>			<td width="181" style="text-align:center;background-color:#996600;" rowspan="2">				<span style="color:#FFFFFF;"> <strong>当月最低有效会员</strong> </span> 			</td>
                                        <td colspan="4" style="text-align:center;background-color:#996600;">				<span style="color:#FFFFFF;"> <strong>当月退佣比例</strong> </span> 			</td>		</tr>		<tr>			<td width="73" style="text-align:center;background-color:#996600;">				<span style="color:#FFFFFF;"><strong>真人视讯</strong></span> 			</td>			<td width="71" style="text-align:center;background-color:#996600;">				<span style="color:#FFFFFF;"><strong>体育投注</strong></span> 			</td>			<td width="50" style="text-align:center;background-color:#996600;">				<span style="color:#FFFFFF;"><strong>机率</strong></span> 			</td>			<td width="52" style="text-align:center;background-color:#996600;">				<span style="color:#FFFFFF;"><strong>彩票</strong></span> 			</td>		</tr>		<tr>			<td style="text-align:center;">				1~50000			</td>			<td style="text-align:center;">				5或以上			</td>			<td style="text-align:center;">				30%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				30%			</td>			<td rowspan="5" style="text-align:center;">				0.1%			</td>		</tr>		<tr>			<td style="text-align:center;">				50001~300000			</td>			<td style="text-align:center;">				10或以上			</td>			<td style="text-align:center;">				35%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				35%			</td>		</tr>		<tr>			<td style="text-align:center;">				300001~800000			</td>			<td style="text-align:center;">				30或以上			</td>			<td style="text-align:center;">				40%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				40%			</td>		</tr>		<tr>			<td style="text-align:center;">				800001~1200000			</td>			<td style="text-align:center;">				50或以上			</td>			<td style="text-align:center;">				45%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				45%			</td>		</tr>		<tr>			<td style="text-align:center;">				1500000以上			</td>			<td style="text-align:center;">				80或以上			</td>			<td style="text-align:center;">				50%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				50%			</td>		</tr>	</tbody></table>
                                <p>	<span style="color:#FF0000;">注：请谨记任何使用不诚实方法以骗取代理佣金者将取消代理资格并永久冻结账户，佣金一概不给予派发！</span> </p><p>	<strong>◎回馈/佣金计算</strong> </p><p style="margin-left:9.1pt;">	● 请注意，视讯(包括AG娱乐城视讯)、体育投注、机率、彩票等专案，以报表中【派彩】栏位，扣除相应费用后，依照上表门槛 X 佣金百分比。对战(包括AG娱乐城对战)专案以报表中【总额公点】栏位，扣除相应费用后，依照上表门槛 X 佣金百分比。</p><p style="margin-left:9.1pt;">	● 当月联盟体系【派彩/总额公点金额】，依照:视讯、体育投注、机率、彩票、对战等顺序扣除相应费用。</p><p style="margin-left:9.1pt;">	● 相应费用包括：为会员优惠、存取款相应费用（请留意：<span>澳门永利娱乐城</span>会员重复出款手续费/未达100%投注出款的手续费由会员承受，不纳入计算）</p><p style="margin-left:9.1pt;">	●&nbsp;<span style="color:#FF0000;">【当月最低有效会员】定义为，在月结区间内进行过最500元有效投注的会员，</span>如联盟体系当月未达【当月最低有效会员】最低门槛5人，则该月无法领取佣金回馈。联盟体系当月营利达到标准，而【当月最低有效会员】人数未达相应最低门槛，则该月佣金比例依照【当月最低有效会员】人数所达门槛相应的百分 比进行退佣。</p><p style="margin-left:9pt;">	● 例：体系当月营利为￥200001，而当月有效会员人数为5人，联盟虽达到营利为￥200001，却未达到有效会员10人以上，故依照联盟有效会员人数5人的门槛的退佣比例核算。</p><table cellspacing="1" cellpadding="1" border="1" style="width:510px;height:63px;">	<tbody>		<tr>			<td width="121" style="text-align:center;background-color:#996600;">				<strong><span style="color:#FFFFFF;">真人视讯</span></strong> 			</td>			<td width="122" style="text-align:center;background-color:#996600;">				<strong><span style="color:#FFFFFF;">体育投注</span></strong> 			</td>			<td width="122" style="text-align:center;background-color:#996600;">				<strong><span style="color:#FFFFFF;">彩票</span></strong> 			</td>			<td width="122" style="text-align:center;background-color:#996600;">				<strong><span style="color:#FFFFFF;">机率</span></strong> 			</td>		</tr>		<tr>			<td style="text-align:center;">				30%			</td>			<td style="text-align:center;">				10%			</td>			<td style="text-align:center;">				0.1%			</td>			<td style="text-align:center;">				30%			</td>		</tr>	</tbody></table>
                                <p>	●例：<br>联盟体系当月最低有效会员达12人，当月派彩：视讯￥300000，球类￥-120000，机率￥20000，彩票有效投注￥800000。如联盟体系当月相应费用统计为￥14000</p><p>	<span><strong>当月佣金计算：</strong><br>(总派彩金额￥200000，退佣百分比为30%)<br>&nbsp;(￥200000派彩 - ￥14000 相应费用) x 30% = ￥55800 佣金<br>￥55800 佣金 + ￥800000 彩票投注 x 0.1% 返点百分比 = ￥56600 总退佣金额</span><br><span style="color:#FF0000;">●佣金百分比，依未扣除相应费用前之"总派彩"金额为准。</span> </p><p>	<span style="color:#FF0000;">●<span>澳门永利赌场</span>为回馈各合作伙伴的大力支持，如当月产生营利为负数或者将不予以累计!</span> </p><p>	<strong>◎回馈/佣金支付</strong> </p><p>	联盟佣金计算，结算区间为本月第一个礼拜一至下月第一个礼拜一前的周日，将会员盈利，以联盟方案分红公式计算，查看佣金请登陆合营端的退佣统计，扣除联盟体系会员相应的优惠、行政费用后，<span style="color:#FF0000;">佣金于每个月的第一个礼拜三</span>开始与代理专员确认金额后，在3个工作天内将佣金直接汇入代理联盟登记之银行帐号。每月代理联盟业绩于结算候归零重新开始。</p>
                            </div>
                            <div style="display: none;" id="Union1">
                                <p>	<strong>◎联盟协议</strong></p><p>	一、澳门永利娱乐城对代理联盟的权利与义务</p><ol>	<li>		澳门永利娱乐城的客服部会登记联盟的会员并会观察他们的投注状况。联盟及会员必须同意并遵守澳门永利娱乐城的会员条例，政策及操作程式。                澳门永利娱乐城保留拒绝或冻结联盟/会员帐户权利。	</li>	<li>		代理联盟可随时登入介面观察旗下会员的下注状况及会员在网站的活动概况。澳门永利娱乐城的客服部会根据代理联盟旗下的会员计算所得的佣金。	</li>	<li>		澳门永利娱乐城保留可以修改合约书上的任何条例，包括: 现有的佣金范围、佣金计划、付款程式、及参考计划条例的权力，                澳门永利娱乐城会以电邮、网站公告等方法通知代理联盟。代理联盟对于所做的修改有异议，代理联盟可选择终止合约，或洽客服人员反映意见。                如修改后代理联盟无任何异议，便视作默认合约修改，代理联盟必须遵守更改后的相关规定。	</li></ol><p>	二、代理联盟对澳门永利娱乐城的权力及义务</p><ol>	<li>		代理联盟应尽其所能，广泛地宣传、销售及推广澳门永利娱乐城，                使代理本身及澳门永利娱乐城的利润最大化。代理联盟可在不违反法律下，以正面形象宣传、销售及推广澳门永利娱乐城，                并有责任义务告知旗下会员所有澳门永利娱乐城的相关优惠条件及产品。	</li>	<li>		代理联盟选择的澳门永利娱乐城推广手法若需付费，则代理应承担该费用。	</li>	<li>		任何澳门永利娱乐城相关资讯包括: 标志、报表、游戏画面、图样、文案等，代理联盟不得私自复制、公开、分发有关材料，澳门永利娱乐城保留法律追诉权。                如代理在做业务推广有相关需要，请随时洽澳门永利娱乐城。	</li></ol><p>	三、规则条款</p><ol>	<li>		各阶层代理联盟不可在未经澳门永利娱乐城许可情况下开设双/多个的代理帐号，也不可从澳门永利娱乐城帐户或相关人士赚取佣金。                请谨记任何阶层代理不能用代理帐户下注，澳门永利娱乐城有权终止并封存帐号及所有在游戏中赚取的佣金。	</li>	<li>		为确保所有澳门永利娱乐城会员帐号隐私与权益，澳门永利娱乐城不会提供任何会员密码，或会员个人资料。各阶层代理联盟亦不得以任何方式取得会员资料，                或任意登入下层会员帐号，如发现代理联盟有侵害澳门永利娱乐城会员隐私行为，澳门永利娱乐城有权取消代理联盟红利，并取消代理联盟帐号。	</li>	<li>		代理联盟旗下的会员不得开设多于一个的帐户。澳门永利娱乐城有权要求会员提供有效的身份证明以验证会员的身份，并保留以IP判定是否重复会员的权利。                如违反上述事项，澳门永利娱乐城有权终止玩家进行游戏并封存帐号及所有于游戏中赚取的佣金。	</li>	<li>		如代理联盟旗下的会员因为违反条例而被禁止享用澳门永利娱乐城的游戏，或澳门永利娱乐城退回存款给会员，澳门永利娱乐城将不会分配相应的佣金给代理联盟。                如代理联盟旗下会员存款用的信用卡、银行资料须经审核，澳门永利娱乐城保留相关佣金直至审核完成。	</li>	<li>		合约内的条件会以澳门永利娱乐城通知接受代理联盟加入后开始执行。澳门永利娱乐城及代理联盟可随时终止此合约，在任何情况下，代理联盟如果想终止合约，                都必须以书面/电邮方式提早于七日内通知澳门永利娱乐城。代理联盟的表现会3个月审核一次，如代理联盟已不是现有的合作成员则本合约书可以在任何时间终止。                如合作伙伴违反合约条例澳门永利娱乐城有权立即终止合约。	</li>	<li>		在没有澳门永利娱乐城许可下，代理联盟不能透露及授权澳门永利娱乐城相关密资料，包括代理联盟所获得的回馈、佣金报表、计算等；代理联盟有义务在合约终止后仍执行机密档及资料的保密。	</li>	<li>		在合约终止后，代理联盟及澳门永利娱乐城将不须要履行双方的权利及义务。终止合约并不会解除代理联盟于终止合约前应履行的义务。	</li>	<li>		代理联盟不可为自己或其他联盟下的有效投注会员,只能是公司直属下的有效投注会员, 代理每月需有5个下线有效投注（有效投注最低为500元方成为有效会员），如有违反联盟协议澳门永利娱乐城有权终止并封存帐号及所有在游戏中赚取的佣金。	</li>	<li>		代理的当期佣金是建立在该代理的在当期盈利的基础上的，如该代理的当期结算中总派彩金额为负，那么代理的退佣金额无论多少均将视为零！	</li></ol>
                            </div>

                        </div>
                        <script>
                            $(function () {
                                $("#Union .mtab-menual li").click(function () {
                                    var i = $(this).attr("sort");
                                    $("#Union div").css("display", "none");
                                    $("#Union" + i).css("display", "block");
                                    $("#Union .mtab-menual li").attr("class", "");
                                    $(this).attr("class", "mtab");
                                });
                            })
                        </script>
                    </div>

                </div>
            </div>
        </div>
        <div class="about_bottom"></div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
</body>
</html>