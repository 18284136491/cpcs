<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/conf.php");
include_once("cache/website.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="slide">
    <div class="bd">
        <ul>
            <li style="background: #d01214 url('newindex/dy/1.jpg') no-repeat center"><a href="#"></a></li>
			<li style="background: #000 url('newindex/dy/5.jpg') no-repeat center"><a href="#"></a></li>
            <li style="background: #000 url('newindex/dy/2.jpg') no-repeat center"><a href="#"></a></li>
            <li style="background: #04072a url('newindex/dy/3.jpg') no-repeat center"><a href="#"></a></li>
            <li style="background: #350201 url('newindex/dy/4.jpg') no-repeat center"><a href="#"></a></li>
        </ul>
    </div>
    <div class="hd">
        <ul></ul>
    </div>
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>
</div>
<div class="i_c1">
    <div class="w1020">
        <ul>
            <li>
                <div class="c1_ico1"></div>
                <div class="c1_title">专属于您的会员特权</div>
            </li>
            <li>
                <div class="c1_ico2"></div>
                <div class="c1_title">手机也能随时玩</div>
            </li>
            <li>
                <div class="c1_ico3"></div>
                <div class="c1_title">VIP高达0.03%返水</div>
            </li>
            <li>
                <div class="c1_ico4"></div>
                <div class="c1_title">给您最快的开奖直播</div>
            </li>
        </ul>
    </div>
</div>
<div class="i_c2">
    <div class="c2_main">
        <div class="c2_bj">
            <div class="c2_left">
                <div class="left_con">
                    <div class="con_text">　　福运来彩票于2010年成立于菲律宾，专业经营各项博彩业务，主营北京赛车PK10、幸运飞艇、重庆时时彩、广东快乐十分、幸运农场、六合彩等项目，自主开户，现金开户，安全稳定，下注简单，服务优质。</div>
                </div>
            </div>
            <div class="c2_right">
                <div class="right_top">
                    <div class="vs">两面盘</div>
                    <div class="game"><img src="newindex/dy/ball.png"></div>
                    <div class="vs">定位盘</div>
                </div>
                <div class="right_bottom">
                    <div class="vs">
                        <div class="scorebox">1.993</div>
                        <div class="scoreboxsm">业界最高</div>
                    </div>
                    <div class="game">
                        <div class="nowplay"><a href="/guest.php">试玩体验</a></div>
                    </div>
                    <div class="vs">
                        <div class="scorebox">9.93</div>
                        <div class="scoreboxsm">业界最高</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="i_c3">
    <div class="w1020">
        <div class="c3_left">
            <div class="tit">提现英雄榜</div>
            <div class="list">
                <ul>
                    <?php
                        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
                        for($i = 0; $i < 4; $i++) {
                            $u_name = '';
                            for($j = 0; $j < 3; $j++) {
                                $u_name .= $chars[mt_rand(0, strlen($chars) - 1)];
                            }
                            $m = mt_rand(3000, 1000000);
                            ?>
                            <li>
                                <div class="pm">
                                    <span><?=$i + 1?></span>
                                    <em>名</em>
                                </div>
                                <div class="tx">
                                    <div class="t1">
                                        <a href="#">恭喜：<?=$u_name?>*** 在福运来彩票提现￥<em><?=$m?></em></a>
                                    </div>
                                    <div class="t2">恭喜[<?=$u_name?>***]，祝您天天迎财神 期期福运来</div>
                                </div>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="c3_right">
            <div class="gm_tit">热门游戏</div>
            <div class="gm_list">
                <ul>
                    <li>
                        <div class="gm_img"><a href="/guest.php"><img src="newindex/dy/g1.jpg"></a></div>
                        <div class="gm_text">北京赛车PK10</div>
                    </li>
                    <li>
                        <div class="gm_img"><a href="/guest.php"><img src="newindex/dy/g2.jpg"></a></div>
                        <div class="gm_text">时时彩</div>
                    </li>
                    <li>
                        <div class="gm_img"><a href="/guest.php"><img src="newindex/dy/g3.jpg"></a></div>
                        <div class="gm_text">香港六合彩</div>
                    </li>
                </ul>
            </div>
            <div class="buy_list">
                <div class="b_tit">人来人往</div>
                <div class="bd">
                    <ul>
                        <?php
                            $gms = array(
                                array('type' => 'pk', 'name' => '北京赛车PK10'),
                                array('type' => 'xyft', 'name' => '幸运飞艇'),
                                array('type' => 'ssc', 'name' => '重庆时时彩'),
                                array('type' => 'gdsf', 'name' => '广东快乐十分'),
                                array('type' => 'jssc', 'name' => '极速赛车'),
                                array('type' => 'lhc', 'name' => '六合彩')
                            );
                            for($i = 0; $i < 20; $i++) {
                                $u_name = '';
                                for($j = 0; $j < 3; $j++) {
                                    $u_name .= $chars[mt_rand(0, strlen($chars) - 1)];
                                }
                                $n = mt_rand(0, 5);
                                $m = mt_rand(500, 30000);
                                ?>
                                <li>
                                    <div class="gm_ico <?=$gms[$n]['type']?>"></div>
                                    <div class="buyer">
                                        <div class="t1"><?=$u_name?>***在<?=$gms[$n]['name']?>，赢得￥<?=$m?></div>
                                        <div class="t2"><?=$u_name?>***在<?=$gms[$n]['name']?>，赢得￥<?=$m?></div>
                                    </div>
                                </li>
                        <?php } ?>
                    </ul>
                </div>
                <a class="prev" href="javascript:void(0)"></a>
                <a class="next" href="javascript:void(0)"></a>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
<script type="text/javascript">
    $(".slide").hover(function() {
        $(".prev", $(this)).fadeIn(200);
        $(".next", $(this)).fadeIn(200);
    }, function() {
        $(".prev", $(this)).fadeOut(100);
        $(".next", $(this)).fadeOut(100);
    });
    jQuery(".slide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"fold",  autoPlay:true, autoPage:true, trigger:"click" });
    jQuery(".buy_list").slide({mainCell: ".bd ul", autoPage: true, effect: "topLoop", autoPlay: true, interTime: 1000, vis: 4});
</script>
<?php
    $mysql = "select * from webinfo where code='wzgg' limit 1";
    $myquery = $mysqli->query($mysql);
    $myrows = $myquery->fetch_array();
    $mymessage = trim($myrows["content"]);
    if($mymessage != "") {
        echo "<script type='text/javascript'>";
        echo "alert('" . $mymessage . "')";
        echo "</script>";
    }
?>
</body>
</html>