<?php
session_start();
include_once("include/config.php");
$display    =    'block';
//if(!intval($_COOKIE['f'])) $display    = 'none';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>1</title>
<link href="css/css_1.css" rel="stylesheet" type="text/css" />
<style>
.fontcolor{float: left;
		   background: url(images/yes.jpg) no-repeat left;
		   line-height: 25px;
		   width: 360px;
		   padding: 0 0 0 26px;
		   height: 25px;
		   color: #000;}

.zhuce_03 {
	float: left;
	background: url(images/no.jpg) no-repeat left;
	line-height: 25px;
	width: 360px;
	padding: 0 0 0 26px;
	height: 25px;
	color: #000;
}

#zhuce_body {
    color:#fff;
}

</style>
</head>
<script language="javascript">
if(self==top){
	top.location='/index.php';
}
</script>
<script language="javascript" src="js/xhr.js"></script>
<script language="javascript" src="js/zhuce.js"></script>
<body id="zhuce_body">
  <div id="bg_000">
  <div id="zhuce_top">
	<form id="form1" name="form1" method="post" action="reg.php" onsubmit="return formsubmit(this);">
	<div class="zhuce_title">登陆资料</div>
	<div class="zhuce_00">
	<div class="zhuce_01">会员账号：</div>
	<div class="zhuce_02"><input name="zcname" class="width_00" type="text" pd="yes" maxlength="16" onfocus="inputFocus(this,0)" id="zcusername" onblur="inputBlur(this,0)" /></div>
	<span class="zhuce_05" id="nameid"> 您在网站的登录帐户，5-16个英文或数字组成 </span>
	</div>
	<div class="zhuce_00">
	<div class="zhuce_01">会员密码：</div>
	<div class="zhuce_02"><input name="zcpwd1" class="width_00" id="pwd1" type="password" maxlength="20" pd="yes" onfocus="inputFocus(this,1)" onblur="inputBlur(this,1),pwStrength(this.value,0);"  onkeyup="pwStrength(this.value,0);" /></div>
	<span class="zhuce_05"> 由6-16位任意字符组成</span>
	</div>
	<div class="zhuce_00">
	<div class="zhuce_01">密码强度：</div>
	<div class="zhuce_02"><table width="200px" height="20" border="0" cellpadding="1" cellspacing="1" bordercolor="#abadb3" bgcolor="#abadb3" style='font-size:12px'> 
	  <tr align="center" bgcolor="#eeeeee">    <td width="33%" id="strength_L0">弱</td>    <td width="33%" id="strength_M0">中</td>    <td width="33%" id="strength_H0">强</td> </tr> </table></div>
	</div>
	<div class="zhuce_00">
	<div class="zhuce_01">确认密码：</div>
	<div class="zhuce_02"><input name="zcpwd2" class="width_00" type="password" pd="yes" maxlength="20" onfocus="inputFocus(this,2)" onblur="inputBlur(this,2)" /></div>
	<span class="zhuce_05"> 由6-20位任意字符组成</span>
	</div>
	<div class="zhuce_title">个人资料</div>
	<div class="zhuce_00">
	<div class="zhuce_01">持卡人姓名：</div>
	<div class="zhuce_02"><input name="zcturename" class="width_00" type="text" pd="yes" onfocus="inputFocus(this,3)" onblur="inputBlur(this,3)" /></div>
	<span class="zhuce_05"> 名字必须与您用于提款及存款的银行户口所用名字相同</span>
	</div>
	<div class="zhuce_00" style="display:none;">
	<div class="zhuce_01" style="display:none;">性别：</div>
	<div class="zhuce_02" style="display:none;">
	      <input class="xingbie" type="radio" name="zcsex" pd="yes" value="男" checked="checked" />男
          <input class="xingbie" type="radio" name="zcsex" pd="yes" value="女" />女
          <input class="xingbie" type="radio" name="zcsex" pd="yes" value="保密" />保密
	  </div>
	<span class="zhuce_05" style="display:none;"> 请选择您的性别</span><span> </span><span> </span>
	</div>
    <div class="zhuce_00" style="display:none;">
	<div class="zhuce_01" style="display:none;">出生年月：</div>
	<div class="zhuce_02" style="display:none;">
	<select name="year" pd="yes">
        <option value="1992">1992</option>
        <option value="1991">1991</option>
        <option value="1990">1990</option>
        <option value="1989">1989</option>
        <option value="1988">1988</option>
        <option value="1987">1987</option>
        <option value="1986">1986</option>
        <option value="1985">1985</option>
        <option value="1984">1984</option>
        <option value="1983">1983</option>
        <option value="1982">1982</option>
        <option value="1981">1981</option>
        <option value="1980">1980</option>
        <option value="1979">1979</option>
        <option value="1978">1978</option>
        <option value="1977">1977</option>
        <option value="1976">1976</option>
        <option value="1975">1975</option>
        <option value="1974">1974</option>
        <option value="1973">1973</option>
        <option value="1972">1972</option>
        <option value="1971">1971</option>
        <option value="1970">1970</option>
        <option value="1969">1969</option>
        <option value="1968">1968</option>
        <option value="1967">1967</option>
        <option value="1966">1966</option>
        <option value="1965">1965</option>
        <option value="1964">1964</option>
        <option value="1963">1963</option>
        <option value="1962">1962</option>
        <option value="1961">1961</option>
        <option value="1960">1960</option>
        <option value="1959">1959</option>
        <option value="1958">1958</option>
        <option value="1957">1957</option>
        <option value="1956">1956</option>
        <option value="1955">1955</option>
        <option value="1954">1954</option>
        <option value="1953">1953</option>
        <option value="1952">1952</option>
        <option value="1951">1951</option>
        <option value="1950">1950</option>
        <option value="1949">1949</option>
        <option value="1948">1948</option>
        <option value="1947">1947</option>
        <option value="1946">1946</option>
        <option value="1945">1945</option>
        <option value="1944">1944</option>
        <option value="1943">1943</option>
        <option value="1942">1942</option>
        <option value="1941">1941</option>
        <option value="1940">1940</option>
        <option value="1939">1939</option>
        <option value="1938">1938</option>
        <option value="1937">1937</option>
        <option value="1936">1936</option>
        <option value="1935">1935</option>
        <option value="1934">1934</option>
        <option value="1933">1933</option>
        <option value="1932">1932</option>
        <option value="1931">1931</option>
        <option value="1930">1930</option>
        <option value="1929">1929</option>
        <option value="1928">1928</option>
        <option value="1927">1927</option>
        <option value="1926">1926</option>
        <option value="1925">1925</option>
        <option value="1924">1924</option>
        <option value="1923">1923</option>
        <option value="1922">1922</option>
        <option value="1921">1921</option>
        <option value="1920">1920</option>
        <option value="1919">1919</option>
        <option value="1918">1918</option>
        <option value="1917">1917</option>
        <option value="1916">1916</option>
        <option value="1915">1915</option>
        <option value="1914">1914</option>
        <option value="1913">1913</option>
        <option value="1912">1912</option>
        <option value="1911">1911</option>
        <option value="1910">1910</option>
        <option value="1909">1909</option>
        <option value="1908">1908</option>
        <option value="1907">1907</option>
        <option value="1906">1906</option>
        <option value="1905">1905</option>
        <option value="1904">1904</option>
        <option value="1903">1903</option>
        <option value="1902">1902</option>
        <option value="1901">1901</option>
        </select>年<select name="maoth" pd="yes">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        </select>月<select name="day" pd="yes">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
        </select>日
	</div>
	<span class="zhuce_05"> 请选择您的出生年月日</span><span> </span><span> </span>
	</div>
	<div class="zhuce_00" style="display:block">
	<div class="zhuce_01">联系电话：</div>
	<div class="zhuce_02"><input name="zctel" class="width_00" type="text" pd="yes" value="" onfocus="inputFocus(this,10)" onblur="inputBlur(this,10)" /></div>
	<span class="zhuce_05"> 请填写您的固定电话或手机</span>
	</div>
	<div class="zhuce_00" style="display:block">
	<div class="zhuce_01">E-mail：</div>
	<div class="zhuce_02"><input name="zcemail" class="width_00" type="text" pd="yes" value="" onfocus="inputFocus(this,11)" onblur="inputBlur(this,11)" /></div>
	<span class="zhuce_05"> 为便于以后我们和您取得联系,请用正确的邮箱</span>
	</div>
	<div class="zhuce_00" style="display:none">
	<div class="zhuce_01">介绍人：</div>
	<div class="zhuce_02"><input name="jsr" class="width_00" type="text" pd="yes" value="lb528"/></div>
	<span class="zhuce_05"> 可不填,如果您是本站会员介绍过来,请填写该会员账号</span>
	</div>

	<div class="zhuce_title" >保密资料</div>
	<div class="zhuce_00" >
	<div class="zhuce_01">密码提示问题：</div>
	<div class="zhuce_02">
    <select name="zcquestion" pd="yes" onfocus="inputFocus(this,13)" onchange="inputBlur(this,13)">
    <option value="您的车牌号码是多少？">您的车牌号码是多少？</option>
    <option value="您初中同桌的名字？">您初中同桌的名字？</option>
    <option value="您就读的第一所学校的名称？">您就读的第一所学校的名称？</option>
    <option value="您第一次亲吻的对象是谁？">您第一次亲吻的对象是谁？</option>
    <option value="少年时代心目中的英雄是谁？">少年时代心目中的英雄是谁？</option>
    <option value="您最喜欢的休闲运动是什么？">您最喜欢的休闲运动是什么？</option>
    <option value="您最喜欢哪支运动队？">您最喜欢哪支运动队？</option>
    <option value="您最喜欢的运动员是谁？">您最喜欢的运动员是谁？</option>
    <option value="您的第一辆车是什么牌子？">您的第一辆车是什么牌子？</option>
    </select></div><span class="zhuce_05"> 请选择密保问题</span>
	</div>
	<div class="zhuce_00"  >
	<div class="zhuce_01">密码问题答案：</div>
	<div class="zhuce_02">
	<input name="zcanswer" type="text" pd="yes" class="width_00" value="" onfocus="inputFocus(this,14)" onblur="inputBlur(this,14)" /></div>
	<span class="zhuce_05"> 请填写您的密保答案</span>
	</div>
	<div class="zhuce_title">取款资料</div>
	<div class="zhuce_00">
	<div class="zhuce_01">取款密码：</div>
	<div class="zhuce_02"><input name="qkpwd1" class="width_00" id="qkpwd1" type="password" maxlength="20" pd="yes" onfocus="inputFocus(this,15)" onblur="inputBlur(this,15),pwStrength(this.value,1);"  onkeyup="pwStrength(this.value,1);" /></div>
	<span class="zhuce_05"> 由6-20位任意字符组成</span>
	</div>
	<div class="zhuce_00">
	<div class="zhuce_01">密码强度：</div>
	<div class="zhuce_02"><table width="200px" height="20" border="0" cellpadding="1" cellspacing="1" bordercolor="#abadb3" bgcolor="#abadb3" style='font-size:12px'> 
	  <tr align="center" bgcolor="#eeeeee">    <td width="33%" id="strength_L1">弱</td>    <td width="33%" id="strength_M1">中</td>    <td width="33%" id="strength_H1">强</td> </tr> </table></div>
	</div>

	<div class="zhuce_00">
	<div class="zhuce_01">确认密码：</div>
	<div class="zhuce_02"><input name="qkpwd2" class="width_00" type="password" pd="yes" maxlength="20" onfocus="inputFocus(this,16)" onblur="inputBlur(this,16)" /></div>
	<span class="zhuce_05"> 由6-20位任意字符组成</span>
	</div>
	<div class="zhuce_00">
	<div class="zhuce_01">验证码：</div>
	<div class="zhuce_02">
	  <table width="180" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><input class="yanzh" name="zcyzm" type="text" pd="yes" maxlength="4" onfocus="inputFocus(this,17),change_zc_yzm('zc_img')" onblur="inputBlur(this,17)" /></td>
          <td><img src="yzm.php" alt="点击刷新" name="zc_img" id="zc_img" style="cursor:pointer;" onclick="change_zc_yzm('zc_img')" /></td>
        </tr>
      </table>
	     </div>
	<span class="zhuce_05"> 请填写验证码</span>
	</div>
	<div class="tiao_00">
	<label>
	<input name="zccheck" type="checkbox" pd="yes" id="ischeck" value="1" />
	</label>
	我同意<a href="tk/tiaokuan.php" target="_blank"><span class="red">【条款及规则】</span></a>，并已经年满18岁，且在此网站所有活动并没有抵触本人所在国家所管辖的法律</div>
	<div class="tiao_01">
	    <input class="ju" type="submit" value="提交" />
		<input name="按钮" type="button" value="重填" onclick="javacript:location.reload();" />
	</div>
	
	</form>
  </div>
  </div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>