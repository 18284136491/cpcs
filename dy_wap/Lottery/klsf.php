<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

if(intval($web_site['gdklsf'])==1)
{
	include('close_cp.php');
	exit();
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WelCome</title>
    <script type="text/javascript" src="/js/jquery.js?_=171"></script>  
    <script type="text/javascript" src="/box/jquery.jBox-2.3.min.js"></script>
	<script type="text/javascript" src="/box/jquery.jBox-zh-CN.js"></script>
    <script type="text/javascript" src="js/gd_klsf.js"></script>
    <script language="javascript" src="/js/mouse.js"></script>
    <link type="text/css" rel="stylesheet" href="../box/Green/jbox.css"/>
    <link type="text/css" rel="stylesheet" href="css/klsf.css"/>
</head>
<body>
<div class="lottery_main">
<div class="ssc_right">
  <div id="auto_list"></div>
</div>
<div class="ssc_left">
    <div class="flash">
      <div class="f_left">
 <span id='cqc_sound' off='0' class="laba" laba_c><img src='images/on.png' title='关闭/打开声音'/></span>
        <div class="time minute">
          <span><img src='images/time/0.png'></span><span><img src='images/time/0.png'></span>
        </div>
        <div class="colon">
          <img src='images/time/10.png'>
        </div>
        <div class="time second">
          <span><img src='images/time/0.png'></span><span><img src='images/time/0.png'></span>
        </div>
        <div class="qh">第 <span id="open_qihao">00000000-000</span> 期 </div>
      </div>
      <div class="f_right">
        <div class="top">广东快乐10分倒计时<span id="downtime" style="color: #F9E101;">00:00:00</span><span>第 <font id='numbers' class="red number">00000000-000</font> 期</span></div>
        <div class="kick "><img src='images/Ball_3/x.png'></div>
        <div class="kick er"><img src='images/Ball_3/x.png'></div>
        <div class="kick san"><img src='images/Ball_3/x.png'></div>
        <div class="kick si"><img src='images/Ball_3/x.png'></div>
        <div class="kick wu"><img src='images/Ball_3/x.png'></div>
        <div class="kick liu"><img src='images/Ball_3/x.png'></div>
        <div class="kick qi"><img src='images/Ball_3/x.png'></div>
        <div class="kick ba"><img src='images/Ball_3/x.png'></div>
        <div class="fot" id="autoinfo">开奖数据获取中...</div>
      </div>
    </div>
    <div class="touzhu">
<form id="orders" name="orders" action="order/order3.php?type=3&class=1" method="post" target="OrderFrame">
    	<ul id="menu_hm">
        	<li class="current" onclick="hm_odds(1)">第一球<span></span></li>
            <li class="current_n" onclick="hm_odds(2)">第二球<span></span></li>
            <li class="current_n" onclick="hm_odds(3)">第三球<span></span></li>
            <li class="current_n" onclick="hm_odds(4)">第四球<span></span></li>
            <li class="current_n" onclick="hm_odds(5)">第五球<span></span></li>
            <li class="current_n" onclick="hm_odds(6)">第六球<span></span></li>
            <li class="current_n" onclick="hm_odds(7)">第七球<span></span></li>
            <li class="current_n" onclick="hm_odds(8)">第八球<span></span></li>
		</ul>
<table class="bian" border="0" cellpadding="0" cellspacing="1">
            <tr class="bian_tr_title">
                <td>号</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号</td>
                <td>赔率</td>
                <td width="70">金额</td>
                <td>号</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>号</td>
              <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_4/01.png" /></td>
                <td class="bian_td_odds" id="ball_1_h1" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t1"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/02.png" /></td>
                <td class="bian_td_odds" id="ball_1_h2" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t2"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/03.png" /></td>
                <td class="bian_td_odds" id="ball_1_h3" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t3"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/04.png" /></td>
                <td class="bian_td_odds" id="ball_1_h4" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t4"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/05.png" /></td>
                <td class="bian_td_odds" id="ball_1_h5" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t5"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_4/06.png" /></td>
                <td class="bian_td_odds" id="ball_1_h6" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t6"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/07.png" /></td>
                <td class="bian_td_odds" id="ball_1_h7" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t7"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/08.png" /></td>
                <td class="bian_td_odds" id="ball_1_h8" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t8"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/09.png" /></td>
                <td class="bian_td_odds" id="ball_1_h9" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t9"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/10.png" /></td>
              <td class="bian_td_odds" id="ball_1_h10" width="40"></td>
              <td class="bian_td_inp" id="ball_1_t10"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_4/11.png" /></td>
                <td class="bian_td_odds" id="ball_1_h11" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t11"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/12.png" /></td>
                <td class="bian_td_odds" id="ball_1_h12" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t12"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/13.png" /></td>
                <td class="bian_td_odds" id="ball_1_h13" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t13"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/14.png" /></td>
                <td class="bian_td_odds" id="ball_1_h14" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t14"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/15.png" /></td>
              <td class="bian_td_odds" id="ball_1_h15" width="40"></td>
              <td class="bian_td_inp" id="ball_1_t15"></td>
            </tr>
            <tr class="bian_tr_txt">
                <td class="bian_td_qiu"><img src="images/ball_4/16.png" /></td>
                <td class="bian_td_odds" id="ball_1_h16" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t16"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/17.png" /></td>
                <td class="bian_td_odds" id="ball_1_h17" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t17"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/18.png" /></td>
                <td class="bian_td_odds" id="ball_1_h18" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t18"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/19.png" /></td>
                <td class="bian_td_odds" id="ball_1_h19" width="40"></td>
                <td class="bian_td_inp" id="ball_1_t19"></td>
                <td class="bian_td_qiu"><img src="images/ball_4/20.png" /></td>
              <td class="bian_td_odds" id="ball_1_h20" width="40"></td>
              <td class="bian_td_inp" id="ball_1_t20"></td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu">大</td>
              <td class="bian_td_odds" id="ball_1_h21"></td>
              <td class="bian_td_inp" id="ball_1_t21"></td>
              <td class="bian_td_qiu">小</td>
              <td class="bian_td_odds" id="ball_1_h22"></td>
              <td class="bian_td_inp" id="ball_1_t22"></td>
              <td class="bian_td_qiu">单</td>
              <td class="bian_td_odds" id="ball_1_h23"></td>
              <td class="bian_td_inp" id="ball_1_t23"></td>
              <td class="bian_td_qiu">双</td>
              <td class="bian_td_odds" id="ball_1_h24"></td>
              <td class="bian_td_inp" id="ball_1_t24"></td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu">尾大</td>
              <td class="bian_td_odds" id="ball_1_h25"></td>
              <td class="bian_td_inp" id="ball_1_t25"></td>
              <td class="bian_td_qiu">尾小</td>
              <td class="bian_td_odds" id="ball_1_h26"></td>
              <td class="bian_td_inp" id="ball_1_t26"></td>
              <td class="bian_td_qiu">合单</td>
              <td class="bian_td_odds" id="ball_1_h27"></td>
              <td class="bian_td_inp" id="ball_1_t27"></td>
              <td class="bian_td_qiu">合双</td>
              <td class="bian_td_odds" id="ball_1_h28"></td>
              <td class="bian_td_inp" id="ball_1_t28"></td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu">东</td>
              <td class="bian_td_odds" id="ball_1_h29"></td>
              <td class="bian_td_inp" id="ball_1_t29"></td>
              <td class="bian_td_qiu">南</td>
              <td class="bian_td_odds" id="ball_1_h30"></td>
              <td class="bian_td_inp" id="ball_1_t30"></td>
              <td class="bian_td_qiu">西</td>
              <td class="bian_td_odds" id="ball_1_h31"></td>
              <td class="bian_td_inp" id="ball_1_t31"></td>
              <td class="bian_td_qiu">北</td>
              <td class="bian_td_odds" id="ball_1_h32"></td>
              <td class="bian_td_inp" id="ball_1_t32"></td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr class="bian_tr_txt">
              <td class="bian_td_qiu">中</td>
              <td class="bian_td_odds" id="ball_1_h33"></td>
              <td class="bian_td_inp" id="ball_1_t33"></td>
              <td class="bian_td_qiu">发</td>
              <td class="bian_td_odds" id="ball_1_h34"></td>
              <td class="bian_td_inp" id="ball_1_t34"></td>
              <td class="bian_td_qiu">白</td>
              <td class="bian_td_odds" id="ball_1_h35"></td>
              <td class="bian_td_inp" id="ball_1_t35"></td>
              <td colspan="6">&nbsp;</td>
            </tr>
      </table>
    	<table class="bian" border="0" cellpadding="0" cellspacing="1" style="margin-top: 20px;">
            <tr class="bian_tr_bg"><td colSpan="12">总和 龙虎</td></tr>
            <tr class="bian_tr_title">
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
                <td width="70">金额</td>
              <td>选项</td>
                <td>赔率</td>
              <td width="70">金额</td>
            </tr>
            <tr class="bian_tr_txt">
                    <td class="bian_td_qiu">总和大</td>
                    <td class="bian_td_odds" id="ball_9_h1"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t1"></td>
                    <td class="bian_td_qiu">总和小</td>
                    <td class="bian_td_odds" id="ball_9_h2"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t2"></td>
                    <td class="bian_td_qiu">总和单</td>
                    <td class="bian_td_odds" id="ball_9_h3"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t3"></td>
                    <td class="bian_td_qiu">总和双</td>
                    <td class="bian_td_odds" id="ball_9_h4"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t4"></td>
              </tr>
              <tr class="bian_tr_txt">
                    <td class="bian_td_qiu">总和尾大</td>
                    <td class="bian_td_odds" id="ball_9_h5"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t5"></td>
                    <td class="bian_td_qiu">总和尾小</td>
                    <td class="bian_td_odds" id="ball_9_h6"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t6"></td>
                    <td class="bian_td_qiu">龙</td>
                    <td class="bian_td_odds" id="ball_9_h7"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t7"></td>
                    <td class="bian_td_qiu">虎</td>
                    <td class="bian_td_odds" id="ball_9_h8"></td>
                    <td width="70" class="bian_td_inp" id="ball_9_t8"></td>
              </tr>
           </table>
      <div class="button_body"><table boder=0 width=100%><tr><td><font color=red style="font-size:14px"><b>快捷下注：</b></font><input id="autoInput" name="autoInput" onkeyup="digitOnly(this)" size="5"/><font color=red>在此填写下注金额，然后点击需要下注的选项</font></td>
	  <td><a onclick="reset()" class="button again" title="重填"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="button submit" onclick="order();" title="下注"></a></td></tr></table></div>
      </form>
    </div>
    <div class="lottery_clear"></div>
</div>
</div>
<div id="endtime"></div>
<script type="text/javascript">loadinfo()</script>
<IFRAME id="OrderFrame" name="OrderFrame" border=0 marginWidth=0 frameSpacing=0 src="" frameBorder=0 noResize width=0 scrolling=AUTO height=0 vspale="0" style="display:none"></IFRAME>
<div style="display:none" id="look"></div>
<div style='width:1px;height:1px;overflow:hidden;'>
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
           codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" 
           width="1" height="1" id="swfcontent" align="middle">
      <param name="allowScriptAccess" value="sameDomain" />
      <param name="movie" value="play.swf" />
      <param name="quality" value="high" />
      <param name="bgcolor" value="#ffffff" />
      <embed src="play.swf" quality="high" bgcolor="#ffffff" width="550" 
             height="400" name="swfcontent" align="middle" allowScriptAccess="sameDomain" 
             type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
    </object>
  </div>
</body>
</html>