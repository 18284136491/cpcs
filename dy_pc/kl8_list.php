<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
include "include/lottery.inc.php";

/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}

$sumday = $_GET["d"];
if ($sumday == "") {
    $sumday = 0;
}
$qday = date("Y-m-d",$lottery_time-$sumday*24*3600);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>北京快乐8开奖结果</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="skin/js/common.js?_=171"></script>
    <script type="text/javascript" src="skin/js/upup.js?_=171"></script>
    <script type="text/javascript" src="skin/js/float.js?_=171"></script>
    <script type="text/javascript" src="skin/js/swfobject.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jquery.cookie.js?_=171"></script>
    <script type="text/javascript" src="skin/js/jingcheng.js?_=171"></script>
    <script type="text/javascript" src="skin/js/top.js?_=171"></script>
    <link type="text/css" rel="stylesheet" href="skin/css/list.css"/>
</head>
<body>
<div class="wrapmain">
<div style="float:left; width:140px;background-color:#CCE5FC; padding:5px;">
<div class="left_lottery_bg1">北京快乐8</div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=0"><?=date("Y年m月d日",$lottery_time);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=1"><?=date("Y年m月d日",$lottery_time-1*24*3600);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=2"><?=date("Y年m月d日",$lottery_time-2*24*3600);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=3"><?=date("Y年m月d日",$lottery_time-3*24*3600);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=4"><?=date("Y年m月d日",$lottery_time-4*24*3600);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=5"><?=date("Y年m月d日",$lottery_time-5*24*3600);?></a></div>
<div class="left_lottery_bg2"><a href="kl8_list.php?d=6"><?=date("Y年m月d日",$lottery_time-6*24*3600);?></a></div>
<div class="left_lottery_bg3">开奖结果</div>
</div>
<div style="float:right; width:792px;"><table class="mybordertable" width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE5FC" style="color:#FFF;">
             <tr style="color: #FFFF00;">
               <td class="mybordertd" height="22" align="center" bgcolor="#000000" rowspan="2">期号</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000" colspan="20"><?=$qday?> 开奖号码</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000" colspan="3" rowspan="2">总和</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000" rowspan="2">上<br />下<br />盘</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000" rowspan="2">奇<br />偶<br />盘</td>
             </tr>
             <tr style="color: #FFFF00;">
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">01</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">02</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">03</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">04</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">05</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">06</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">07</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">08</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">09</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">10</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">11</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">12</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">13</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">14</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">15</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">16</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">17</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">18</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">19</td>
               <td class="mybordertd" height="22" align="center" bgcolor="#000000">20</td>
             </tr>
             <?php
             $sql = "select * from lottery_k_kl8 where ok=1 and DATEDIFF(kaipan, '$qday')=0 order by id desc";
             $query = $mysqli->query($sql);
             while ($row = $query->fetch_array()){
             $sum = $row["hm1"] + $row["hm2"] + $row["hm3"] + $row["hm4"] + $row["hm5"] + $row["hm6"] + $row["hm7"] + $row["hm8"] + $row["hm9"] + $row["hm10"] + $row["hm11"] + $row["hm12"] + $row["hm13"] + $row["hm14"] + $row["hm15"] + $row["hm16"] + $row["hm17"] + $row["hm18"] + $row["hm19"] + $row["hm20"];
             if ($sum % 2 == 0) {
                 $hzds = "<font color='#32fc6b'>双</font>";
             } else {
                 $hzds = "单";
             }
             if ($sum > 810) {
                 $hzdx = "<font color='#32fc6b'>大</font>";
             } else if ($sum < 810) {
                 $hzdx = "小";
             } else {
                 $hzdx = "<font color='#c6fe6f'>和</font>";
             }
             $spsum = 0;
             $jpsum = 0;
             for ($i = 1; $i <= 20; $i++) {
                 if ($row["hm".$i] <= 40) {
                     $spsum++;
                 }
                 if ($row["hm".$i] % 2 != 0) {
                     $jpsum++;
                 }
             }
             if ($spsum > 10) {
                 $sxp = "上";
             } else if ($spsum < 10) {
                 $sxp = "<font color='#32fc6b'>下</font>";
             } else {
                 $sxp = "<font color='#c6fe6f'>中</font>";
             }
             if ($jpsum > 10) {
                 $jop = "奇";
             } else if ($jpsum < 10) {
                 $jop = "<font color='#32fc6b'>偶</font>";
             } else {
                 $jop = "<font color='#c6fe6f'>和</font>";
             }
             ?>
             <tr>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$row["qihao"]?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm1"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm2"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm3"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm4"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm5"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm6"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm7"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm8"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm9"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm10"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm11"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm12"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm13"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm14"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm15"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm16"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm17"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm18"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm19"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=BuLing($row["hm20"])?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$sum?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$hzdx?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$hzds?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$sxp?></td>
               <td class="mybordertd" height="22" align="center" bgcolor="#02385A"><?=$jop?></td>
             </tr>
             <?php } ?>
      </table>
</div>
<div class="clear"></div>
</div>
</body>
</html>
