<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myproblem';
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
                    <p style="font-size: 25px">常见问题</p>

                    <div class="large-callout">

                        <i>1. 我怎么样才能在澳门葡京娱乐场 注册一个账户？</i>

                        <p>&#12288;&#12288;开启您的澳门葡京娱乐场 账户其实非常简单、快捷且安全。
                            <br>&#12288;&#12288;在主页的上方点击"免费开户" 按钮，填写详细的注册信息后，点击"提交" 就可很简单的完成澳门葡京娱乐场 账户注册。 </p>
                        <br>
                        <i>2.在贵公司进行游戏是否安全？ </i>

                        <p>&#12288;&#12288;本公司系统绝对安全。我们决不泄漏客户的个人资料给任何商业机构。此外，我们亦要求有交易往来的银行，信用卡中转代理等严格保密客户的资料。所有的存款将视为贸易户口，并不会交给其它的人士进行。</p>
                        <br>
                        <i>3.网上博彩是否合法？ </i>

                        <p>
                            &#12288;&#12288;有的国家或地区当地法律禁止博彩，在这种情况下，请您务必遵守当地法律，如有任何疑问，请寻求当地法律部门的意见。本公司不能亦不会接受任何人士违犯当地法律所引致之任何责任。</p>
                        <br>
                        <i>4.在澳门葡京娱乐场进行投注是否有年龄限制？</i>

                        <p>&#12288;&#12288;是的，投注合法年龄必须年满18岁。</p>
                        <br>
                        <i>5.开户是否要填写真实姓名？</i>

                        <p>&#12288;&#12288;基于安全理由，提款时财务部会按照注册姓名进行审核，银行卡户名必须与注册姓名相同方可提款，所以请您在开户时填写的姓名必须与您提款的户名相同。</p>
                        <br>
                        <i>6.忘记密码怎么办？</i>

                        <p>&#12288;&#12288;如果您忘记了您的帐户密码，我们需要您确认您澳门葡京娱乐场 帐户的帐号细节，请您立即联系在线客服。</p>
                        <br>
                        <i>7.存款帮助？</i>

                        <p>&#12288;&#12288;一、 银行卡划款:
                            <br>&#12288;&#12288;提供中国建设银行、中国工商银行、中国农业银行三间银行与支付宝转帐方式可选择，同行互转存款到帐时间约为三到五分钟。
                            <br>&#12288;&#12288;跨行划款需依据银行划款作业时间为基准，我们将于确认到帐后立刻为您游戏帐户充值。</p>
                        <br>

                        <p>&#12288;&#12288;二、 线上支付:
                            <br>&#12288;&#12288;提供：中国民生银行总行,中国工商银行,中国建设银行,兴业银行,中国光大银行,深圳发展银行,中国邮政,华夏银行,上海浦东发展银行,中国银行,上海银行,交通银行,广东发展银行,北京银行,中信银行,深圳平安银行,中国农业银行,招商银行等在线支付。
                            <br>&#12288;&#12288;进入网络银行页面﹐请确实填写您银行账号信息﹐支付成功﹐额度将在3分钟内系统处理完成，充值金额立即加入您的澳门葡京娱乐场会员账户中。</p>
                        <br>
                        <b>&#12288;&#12288;存款需知:</b>

                        <p>&#12288;&#12288;■ 澳门葡京娱乐场单笔最低存款在线支付为￥100人民币，公司入款为￥100人民币，在线支付单笔最高存款上限为￥50000人民币，公司入款无上限。

                        <p>&#12288;&#12288;■ 会员通过公司入款方式系统将自动赠送1.0%存款优惠，次次存，次次送，

                        <p>&#12288;&#12288;■ 会员通过公司入款或线上支付方式系统将自动赠送1.0%积分，次次存，次次送，无上限。
                            <br>&#12288;&#12288;■ 未开通网银的会员，请亲洽您的银行柜台办理。</p>
                        <br>
                        <i>8.取款帮助？</i>

                        <p>&#12288;&#12288;取款提供以下银行:
                            <br>&#12288;&#12288;工商银行、农业银行、建设银行、招商银行、中国银行、交通银行、中信银行、光大银行、华夏银行、民生银行、广东发展银行、深圳发展银行、邮政储蓄。</p>

                        <br>
                        <b>&#12288;&#12288;取款需知:</b>

                        <p>&#12288;&#12288;■ 澳门葡京娱乐场最低取款为￥100人民币，单笔最高提款上限￥500000人民币。

                        <p>&#12288;&#12288;■ 每个帐号每24小时只能提款一次。

                        <p>&#12288;&#12288;■ 提款30分钟内本公司将资金汇入您所绑定的银行帐号。工商银行、建设银行、农业银行即时到帐，其它银行为跨行转帐24小时内到帐。
                            <br>&#12288;&#12288;■ 提款不收取任何手续费的。</p>

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