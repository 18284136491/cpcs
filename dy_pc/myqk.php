<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myqk';
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
                    <p style="font-size: 25px">取款幫助</p>

                    <div class="large-callout">
                        <p><strong>取款方法</strong></p>
                        <br>
                        <p>1．会员登入后点击右上方“线上取款”。</p>
                        <p>2．输入提款“金额”和“取款密码”，确认提款人姓名与您银行账号持有人相符。</p>
                        <p>3．支持出款银行： 工商银行、农业银行、北京银行、交通银行、中国银行、建设银行、光大银行、兴业银行、民生银行、招商银行、中信银行、广东发展银行、中国邮政、深圳发展银行、上海浦东发展银行等银行。 取款￥100万元人民币以内，可24小时提出申请，并享受5-15分钟内到帐。</p>
                        <p>4．如有任何问题，请您联系我们的24小时在线客服，我们将在第一时间为您解答问题。</p>
                        <br>
                        <p><strong>【取款注意事项】</strong></p>
                        <br>
                        <p>最低取款为$100人民币，普通会员每日最高取款为￥1,000,000人民币,VIP会员每日最高取款为￥5,000,000人民币)，所有会员提款次数不限，提款手续费全免。</p>
                        <p>请注意：各游戏和局/未接受/取消注单，不纳入有效投注计算。运动博弈游戏项目，大赔率玩法计算有效投注金额，小赔率玩法计算输赢金额为有效投注。</p>
                        <p>大赔率产品包括: 过关、波胆、总入球、半全场、双胜彩、冠军赛。</p>
                        <p>澳门永利娱乐城相关优惠，请详见"优惠活动"</p>
                        <p>如有任何问题，请您联系24小时在线客服！</p>
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