<?php
//ini_set('display_errors','yes');
include_once("../../include/config.php"); 
include_once("../common/login_check.php");
check_quanxian("jkkk");
include_once("../../include/mysqli.php");

if($_GET["action"]=="save"){
	include_once("../../class/money.php");
	
	$uid	=	$_POST["uid"];
	$uname	=	$_POST["username"];
	$money	=	sprintf("%.2f",floatval($_POST["m_value"]));
	$money_type	=	intval($_POST["money_type"]);
	$about	=	$_POST["about"];
	$order	=	$uname."_".$web_site['reg_msg_from']."_".date("YmdHis");
	
	if($money<=0){
		message('请输入大于0的金额');
		exit();
	}
	
	if($money_type==0){
		message('请选择类型');
		exit();
	}
	
	$sql	 =	"select money from k_user where uid=$uid limit 1"; //取汇款前会员余额
	$query	 =	$mysqli->query($sql);
	$rows	 =	$query->fetch_array();
	$assets	 =	$rows['money'];
	
	if($_POST["type"]=="add"){ //加钱
		if(money::chongzhi($uid,$order,$money,$assets,1,$about."[管理员结算]",$money_type)){
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"对用户ID".$uid."的账户金额增加了".$money.",理由".$about);
			$mysqli->commit(); //事务提交
			if($_POST['zsjf']==1){
			include_once("../../class/user.php");
			$ball_sort='充值赠送';
			$jifen=$web_site['jf_tzjf']*$money;
			$about="充值:$money 元<br>[管理员结算]";
			$re=user::jifen_add($uid,$order,$about,$jifen,2,$ball_sort);
			$sql	=	"update k_money set `jifen`=$jifen where m_order='$order' and `status`=1";
			//echo $sql;exit;
			$mysqli->query($sql);
			}
			message('加钱成功','man_money.php?username='.$uname);
			return true;
			
		}else{
			message('加钱失败');
		}
	}else{//扣钱
		if(money::tixian($uid,$money,$assets,$web_site['reg_msg_from'],'888888','美国',$web_site['reg_msg_from'],$order,1,$about."[管理员结算]",$money_type)){	
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"对用户ID".$uid."的账户金额扣除了".$money.",理由".$about);
			message('扣钱成功','man_money.php?username='.$uname);
		}else{
			message('扣钱失败');
		}
	}
}
$sql	=	"select username from k_user where uid=".$_GET["uid"]." limit 1";
$query	=	$mysqli->query($sql);
$t		=	$query->fetch_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户手工结算金额</title>
<style type="text/css">
<!--
.STYLE3 {color: #FF0000}
-->
</style>
</head>
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
.STYLE5 {color: #999999}
</style>
<body>
 <table align="center"  width="100%" >
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;用户余额手工结算</font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
    <form name="form1"  method="post" action="<?=$_SERVER['PHP_SELF']?>?action=save">
  
    <table width="116%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
  <tr>
    <td width="16%" height="45" align="right">用户名：</td>
    <td width="84%" align="left"><font color="Red"><?=$t["username"]?></font><input  type="hidden" name="uid" value="<?=$_GET["uid"]?>"/>
      <input name="username" type="hidden" id="username" value="<?=$t["username"]?>" /></td>
  </tr>
  <tr>
    <td height="49" align="right">加/减款：</td>
    <td align="left">
    <input name="type" type="radio" value="add" <?=$_GET['type']=='add' ? 'checked="checked"' : ''?>/><span style="color:#009900">加钱</span>&nbsp;&nbsp;&nbsp;&nbsp; 
    <input type="radio" name="type" value="min" <?=$_GET['type']=='min' ? 'checked="checked"' : ''?>/><span style="color:#FF0000">扣钱</span></td>
  </tr>
  <tr>
    <td height="49" align="right">赠送积分：</td>
    <td align="left">
    <input name="zsjf" type="checkbox" value="1" /> * 只限加款</td>
  </tr>
  <tr>
     <td height="47" align="right">类型：</td>
     <td align="left">
	   <select name="money_type" id="money_type">
	     <option value="0">==请选择类型==</option>
	     <option value="3">人工汇款</option>
	     <option value="4">彩金派送</option>
	     <option value="5">反水派送</option>
	     <option value="6">其他情况</option>
	   </select></td>
  </tr>
  <tr>
     <td height="47" align="right">金额：</td>
     <td align="left"><input name="m_value" type="text" size="10" maxlength="10" />     
       <span class="STYLE3">*</span><span class="STYLE5">必须为数字</span></td>
  </tr>
    <tr>
     <td height="44" align="right">理由：</td>
     <td align="left"> <input name="about" type="text" size="40" maxlength="100" /> 
       &nbsp;为了方便财务对账，请填写说明！</td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left"><input name="submit" type="submit" style="width:100px;"  onclick="return confirm('确定提交?');" value="确定"/></td>
  </tr>
</table>  
    </form>
</td>
  </tr>
</table>
</body>
</html>