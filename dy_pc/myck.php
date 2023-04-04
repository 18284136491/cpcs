<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myck';
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
                    <p style="font-size: 25px">存款幫助</p>

                    <div class="large-callout">
                        <p><strong>您现在可以透过以下方式存款给澳门永利娱乐城：</strong></p>
                        <br>
                        <p><strong>1、银行卡入款（强烈推荐使用）</strong></p>
                        <br>
                        <p>（1） 我们有支持银联转账，请与在线客服联系取得入款账户。</p>
                        <p>（2） 目前提供中国工商银行、中国建设银行、中国农业银行三间银行可选择，同行互转存款到帐时间约为一到三分钟，跨行划款需依据银行划款作业时间为基准，我们将于确认到帐后立刻为您游戏账户充值。</p>
                        <p>?（注：凡通过银行卡入款我们公司一律返还1.2%的彩金作为银行转账手续费用，本项优惠可以跟其他优惠同时进行不起任何冲突。）</p>
                        <br>
                        <p><strong>2、 在线支付</strong></p>
                        <br>
                        <p>（1） 会员登入后点选”在线付款”。（在你第一次入款时，需先绑定你的出款银行）</p>
                        <p>（2） 选择入款额度，并请确实填写”联络电话”，如有任何问题，方便银行与澳门永利娱乐城客服第一时间与您联系。</p>
                        <p>（3） 选择”支付银行”</p>
                        <p>（4） 支援借记卡：中国民生银行总行,中国工商银行,中国建设银行,兴业银行,中国光大银行,深圳发展银行,中国邮政,华夏银行,上海浦东发展银行,中国银行,上海银行,交通银行,广东发展银行,北京银行,中信银行,深圳平安银行,中国农业银行,招商银行。</p>
                        <p>（5） 确认送出后﹐将请您确认您的支付订单无误，并建议您记录您的支付订单号后，确认送出，并耐心等待加载网络银行页面﹐传输中已将您账户数据加密﹐请耐心等待。</p>
                        <p>（6） 进入网络银行页面﹐请确实填写您银行账号信息﹐支付成功﹐额度将在2分钟内系统处理完成，立即加入您的会员账户。</p>
                        <br>
                        <p><strong>存款需知:</strong></p>
                        <br>
                        <p>澳门永利娱乐城单笔最低存款为100人民币，单笔最高存款上限为1000000人民币。未开通网银的会员，请亲洽您的银行柜台办理。如有任何问题，请洽24小时在线客服，谢谢。</p>
                        <br>
                        <p style="text-align:center;background-color:#262509;margin-top: 10px;padding: 5px 0;font-weight: bold">
                            澳门永利娱乐城真诚欢迎您的加入您的满意是我们最大的荣幸！
                        </p>

                    </div>
                    <!-- END large-callout -->

                    <!-- END tour-pagination-links -->
                </div>
            </div>
        </div>
        <div class="about_bottom"></div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
</body>
</html>