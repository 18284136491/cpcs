<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
include("../../include/mysqli.php");
include ("../../Lottery/include/order_info.php");
if(is_numeric($_REQUEST['gameId'])){
	$gameId=intval($_REQUEST['gameId']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=2;
$gameName=get_gameName($gameId);

$type = $_REQUEST['type'];
$save = $_REQUEST['save'];
if($type==''){$type=1;}
$type=='1' ? $se1 = '#FF0' : $se1 = '#FFF';
$type=='2' ? $se2 = '#FF0' : $se2 = '#FFF';
$type=='3' ? $se3 = '#FF0' : $se3 = '#FFF';
$type=='4' ? $se4 = '#FF0' : $se4 = '#FFF';
$type=='5' ? $se5 = '#FF0' : $se5 = '#FFF';
$type=='6' ? $se6 = '#FF0' : $se6 = '#FFF';
$type=='7' ? $se7 = '#FF0' : $se7 = '#FFF';
$type=='8' ? $se8 = '#FF0' : $se8 = '#FFF';
$type=='9' ? $se9 = '#FF0' : $se9 = '#FFF';
$type=='10' ? $se10 = '#FF0' : $se10 = '#FFF';
$type=='11' ? $se11 = '#FF0' : $se11 = '#FFF';
if($save=='ok'){
	if($type<6){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14']." where type='ball_".$type."'";
		$mysqli->query($sql);
		//Alert("赔率修改完毕！","odds.php?type=".$type."");
        echo "<script>alert(\"赔率修改完毕！\");window.open('odds.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>";
		exit;
	}
	if($type==6){
		$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7']." where type='ball_".$type."'";
		$mysqli->query($sql);
		//Alert("赔率修改完毕！","odds.php?type=".$type."");
        echo "<script>alert(\"赔率修改完毕！\");window.open('odds.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
		exit;
	}
	if($type>6){
		if($type==10){
			$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9'].",h10=".$_REQUEST['Num_10'].",h11=".$_REQUEST['Num_11'].",h12=".$_REQUEST['Num_12'].",h13=".$_REQUEST['Num_13'].",h14=".$_REQUEST['Num_14'].",h15=".$_REQUEST['Num_15']." where type='ball_".$type."'";
			$mysqli->query($sql);
			//Alert("赔率修改完毕！","odds.php?type=".$type."");
			echo "<script>alert(\"赔率修改完毕！\");window.open('odds.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
			exit;
		}elseif($type==11){
			$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8']." where type='ball_".$type."'";
			$mysqli->query($sql);
			//Alert("赔率修改完毕！","odds.php?type=".$type."");
			echo "<script>alert(\"赔率修改完毕！\");window.open('odds.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
			exit;
		}else{
			$sql	=	"update c_odds_$gameId set h1=".$_REQUEST['Num_1'].",h2=".$_REQUEST['Num_2'].",h3=".$_REQUEST['Num_3'].",h4=".$_REQUEST['Num_4'].",h5=".$_REQUEST['Num_5'].",h6=".$_REQUEST['Num_6'].",h7=".$_REQUEST['Num_7'].",h8=".$_REQUEST['Num_8'].",h9=".$_REQUEST['Num_9']." where type='ball_".$type."'";
			$mysqli->query($sql);
			//Alert("赔率修改完毕！","odds.php?type=".$type."");
			echo "<script>alert(\"赔率修改完毕！\");window.open('odds.php?type=".$type."&gameId=".$gameId."','mainFrame');</script>"; 
			exit;
		}
	}

}
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
</head>
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script type="text/javascript">
//读取当前期数盘口赔率与投注总额
function loadinfo(){
	$.post("get_odds_<?=$gameId?>.php", {type : <?=$type?>,gameId : <?=$gameId?>}, function(data)
		{
			for(var key in data.oddslist){
			odds = data.oddslist[key];
			$("#Num_"+key).val(odds);
			}
		}, "json");
}
function UpdateRate(num ,i){
	$.post("updaterate_<?=$gameId?>.php", {type : <?=$type?>,gameId : <?=$gameId?> ,num : num ,i : i}, function(data)
		{
			odds = data.oddslist[num];
			xodds = $("#Num_"+num).val();
			if(odds != xodds){
				$("#Num_"+num).css("color","red");
			}
			$("#Num_"+num).val(odds);
		}, "json");
}
</script>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
      <?php include_once("Menu_Odds.php"); ?>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9">
      <tr>
        <td align="center" bgcolor="#3C4D82" style="color:#FFF">
        <a href="?type=1&gameId=<?=$gameId?>" style="color:<?=$se1?>; font-weight:bold;">第一球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=2&gameId=<?=$gameId?>" style="color:<?=$se2?>; font-weight:bold;">第二球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=3&gameId=<?=$gameId?>" style="color:<?=$se3?>; font-weight:bold;">第三球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=4&gameId=<?=$gameId?>" style="color:<?=$se4?>; font-weight:bold;">第四球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=5&gameId=<?=$gameId?>" style="color:<?=$se5?>; font-weight:bold;">第五球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=6&gameId=<?=$gameId?>" style="color:<?=$se6?>; font-weight:bold;">总和、龙虎和</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=7&gameId=<?=$gameId?>" style="color:<?=$se7?>; font-weight:bold;">前三球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=8&gameId=<?=$gameId?>" style="color:<?=$se8?>; font-weight:bold;">中三球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
        <a href="?type=9&gameId=<?=$gameId?>" style="color:<?=$se9?>; font-weight:bold;">后三球</a>&nbsp;&nbsp;-&nbsp;&nbsp;
		<a href="?type=10&gameId=<?=$gameId?>" style="color:<?=$se10?>; font-weight:bold;">斗牛</a>&nbsp;&nbsp;-&nbsp;&nbsp;
		<a href="?type=11&gameId=<?=$gameId?>" style="color:<?=$se11?>; font-weight:bold;">梭哈</a></td>
        </tr>   
    </table>
        <?php if($type<6){?>
                    <table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&gameId=<?=$gameId?>&save=ok">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/0.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/1.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/2.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/3.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/4.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/5.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/6.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/7.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/8.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF"><img src="/lottery/images/ball_2/9.png" /></td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('10','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('10','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('11','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('11','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('12','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('12','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('13','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('13','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('14','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('14','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                          <td align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }else if($type==6){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok&gameId=<?=$gameId?>">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">总和大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">总和双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">龙</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">虎</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">和</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td colspan="2" align="center"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
				<?php }else if($type==10){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok&gameId=<?=$gameId?>">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">没牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛4</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛8</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('12','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_12" id="Num_12" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('12','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">牛1</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛5</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛9</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('10','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_10" id="Num_10" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('10','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">牛小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('13','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_13" id="Num_13" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('13','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
						 <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">牛2</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛6</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛牛</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('11','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_11" id="Num_11" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('11','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                           <td align="center"bgcolor="#FFFFFF">牛单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('14','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_14" id="Num_14" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('14','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
						  <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">牛3</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">牛7</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF" colspan="2"></td>
                          
                           <td align="center"bgcolor="#FFFFFF">牛双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('15','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_15" id="Num_15" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('15','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
						 
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
				<?php }else if($type==11){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok&gameId=<?=$gameId?>">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">五条</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">四条</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">葫芦</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">顺子</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">三条</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">两对</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">一对</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_7" id="Num_7" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                         <td align="center"bgcolor="#FFFFFF">散号</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" colspan="8" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table>
				<?php }else if($type>6){?><table border="0"align="center" cellspacing="1" cellpadding="5" width="100%" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
                    <form name="form1" method="post" action="?type=<?=$type?>&save=ok&gameId=<?=$gameId?>">
                        <tr style="background-color:#3C4D82; color:#FFF">
                          <td width="50" height="22" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                          <td width="50" align="center"><strong>号码</strong></td>
                          <td align="center"><strong>当前赔率</strong></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">豹子</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_1" id="Num_1" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('1','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">顺子</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_2" id="Num_2" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('2','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">对子</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_3" id="Num_3" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('3','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">半顺</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_4" id="Num_4" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('4','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">杂六</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_5" id="Num_5" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('5','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="28" align="center"bgcolor="#FFFFFF">大</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_6" id="Num_6" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('6','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">小</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="7" size="4" value="0" name="Num_7" id="Num_7" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('7','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                          <td align="center"bgcolor="#FFFFFF">单</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','0');"><img src="../Images/bvbv_02.gif" width="19" height="18" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_8" id="Num_8" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('8','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                            </tr>
                          </table></td>
                         <td align="center"bgcolor="#FFFFFF">双</td>
                          <td align="center"bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="3">
                            <tr>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','0');"><img src="../Images/bvbv_02.gif" width="19" height="17" /></a></td>
                              <td align="center"><input class="input1" maxlength="6" size="4" value="0" name="Num_9" id="Num_9" /></td>
                              <td align="center"><a style="cursor:hand" onClick="UpdateRate('9','1');"><img src="../Images/bvbv_01.gif" width="19" height="17" /></a></td>
                              
                            </tr>
                          </table></td>
                          <td colspan="2"bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="28" colspan="10" align="center"bgcolor="#FFFFFF"><input type="submit"  class="submit80" name="Submit" value="确认修改" /></td>
                        </tr></form>
                </table><?php }?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">loadinfo();</script> 
</body>
</html>