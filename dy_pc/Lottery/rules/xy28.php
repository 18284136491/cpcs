<?php
$g_t = 11;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PC蛋蛋 - 游戏规则</title>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/ssc.css"/>
</head>
<body>
    <div class="yx_gz">
        <?php include_once('type.php') ?>
        <div class="guize">
            <p class="f20">PC蛋蛋规则说明</p>
            <p class="b m_tb">简介</p>
            <p>PC蛋蛋开奖结果来源于国家福利彩票北京快乐8(官网)开奖号码，从早上9:05至23:55，每5分钟一期不停开奖。北京快乐8每期开奖共开出20个数字，PC蛋蛋将这20个开奖号码按照由小到大的顺序依次排列；取其1-6位开奖号码相加，和值的末位数作为PC蛋蛋开奖第一个数值；取其7-12位开奖号码相加，和值的末位数作为PC蛋蛋开奖第二个数值，取其13-18位开奖号码相加，和值的末位数作为PC蛋蛋开奖第三个数值；三个数值相加即为PC蛋蛋最终的开奖结果。</p>
            <p class="b m_tb">游戏玩法</p>
            <p class="c_t m_b">大小玩法：</p>
            <p>数字14-27为大，数字0-13为小</p>
            <p class="c_t m_tb">单双玩法：</p>
            <p>数字1，3，5，~27为单，数字0，2，4~26为双</p>
            <p class="c_t m_tb">极值玩法：</p>
            <p>[极小0-5]，[极大22-27]</p>
            <p class="c_t m_tb">组合玩法：</p>
            <p>数字14，16，~26为大双，数字0，2，4，~12为小双</p>
            <p>数字15，17，~27为大单，数字1，3，5，~13为小单</p>
            <p class="c_t m_tb">定位玩法：</p>
            <p>从数字0-27中选取一个数字</p>
        </div>
    </div>
    <?php include_once('../r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>