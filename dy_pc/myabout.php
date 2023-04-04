<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myabout';
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
                    <p style="font-size: 25px">公司简介</p>

                    <div class="large-callout">
                        <p>&#12288;&#12288;澳门葡京娱乐场是英属维京群岛合法注册的博彩公司并持有菲律宾政府卡格扬经济特区 First Cagayan leisure and Resort
                            Corporation颁发的体育博彩与线上赌场执照。
                            <br>&#12288;&#12288;网站所提供的所有产品和服务由菲律宾政府卡格扬经济特区First Cagayan leisure and Resort Corporation
                            (www.firstcagayan.com) 所授权和监管。
                            <br>&#12288;&#12288;澳门葡京娱乐场为全球博彩爱好者提供最优惠的赔率和最优质的服务，并正发展成为最受欢迎的网上体育博彩公司。澳门葡京娱乐场的商标在运动博彩界中站在最前线，持有创新的市场概念和有价值观的开价令澳门葡京娱乐场在业界享有最佳声誉,至今澳门葡京娱乐场作为知名的线上博彩公司，为来自亚洲各国的初级和资深博彩爱好者提供特有的服务。我们的经营理念是通过向我们的顾客提供最佳的体育博彩娱乐体验来发展我们的业务。
                        </p>
                        <br>
                        <i>具备安全及隐私性的环境</i>

                        <p>&#12288;&#12288;我们提供安全端口（SSL 128 bit encryption
                            Standard）并存放在公众无法进入的保密环境之下。所有数据的内部出入都受到限制及严密的监控，并保证决不将您的资料出售或透露给第三方。</p>
                        <br>
                        <i>优质的客户服务</i>

                        <p>&#12288;&#12288;我们的客户服务部将为您提供365天×24小时不间的断友善和专业客户咨询服务。</p>
                        <br>
                        <i>迅捷安全存取款</i>

                        <p>&#12288;&#12288;我们提供各种安全简便的存款及提款选择给我们的会员。我们一直坚持&quot;了解我们的会员（KYC）&quot;和 反洗钱(AML)的原则，
                            并与第三方的财务管理当局合作以确保最大范围的遵从相关的法律法规。
                            <br>&#12288;&#12288;我们对我们所建立的公司深感自豪，并希望所有的用户能够在一个安全愉快的环境下享受我们精心设计的产品和服务并能够从中获利。
                            我们提供最迅捷最安全的提款手续，会员365天×24小时均可申请提款，30分钟内到帐。</p>
                        <br>
                        <i>最佳赔率</i>

                        <p>&#12288;&#12288;■我们体育博彩项目提供1.99超高水位，让会员享受最有价值的投注。
                            <br>&#12288;&#12288;■我们体育博彩、即时彩票、香港乐透项目均提供1%超高返水。
                            <br>&#12288;&#12288;■我们提供全世界的400多个不同联赛的大小赛事。
                            <br>&#12288;&#12288;■我们香港乐透提供48倍超高赔率。 </p>
                        <br>
                        <i>多样化产品</i>

                        <p>&#12288;&#12288;每一个用户只能拥有相对应的唯一的账户，我们将会通过进行不定时的安全检查来维护系统的完整性及公平性。
                            如果我们发现任何用户有欺诈行为，我们将立即关闭及取消他的账户。
                            根据本公司的相关章程条例，任何通过欺诈行为而获取的资金将有可能被没收和被追回。</p>
                        <br>
                        <i>负责任博彩</i>

                        <p>&#12288;&#12288;我们承诺提供&quot;负责任的博彩&quot;。我们确信我们的客户将会与我们一起享受到投注的乐趣。
                            但是我们也清楚小部分的用户有时候会无法控制他们的投注行为，因此在这些情况下我们鼓励这些用户及时通知我们，以便我们可以尽可能及时地向他们提供帮助以及及时地暂停他们的投注账户。</p>
                        <br><br>
                        <i>澳门葡京娱乐场，绝对是玩家最明智的选择!</i>

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