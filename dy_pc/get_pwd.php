<?php
session_start();
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("common/function.php");
message("忘记账号密码，请联系在线客服人员取回！");
$action	=	"get_ask";
if(@$_GET["action"]=="get_ask"){
	$username	=	str_replace('\'','',$_POST["username"]);
    $yzm		=	strtolower($_POST["vlcodes"]);
	if($yzm!=$_SESSION["randcode"]){   
		message("验证码错误,请重新输入",'get_pwd.php');
	}
	$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
	
	$sql	=	"select ask from k_user where username='$username' limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	if($rs['ask']){
		$ask	=	$rs['ask'];
		$action	=	"post_answer";
	}else{
		message("用户名不存在",'get_pwd.php');
	}
}
if(@$_GET["action"]=="post_answer"){
	$username	=	str_replace('\'','',$_POST["username"]);
    $yzm		=	strtolower($_POST["vlcodes"]);
	if($yzm!=$_SESSION["randcode"]){   
		message("验证码错误,请重新输入",'get_pwd.php');
	}
	$_SESSION["randcode"]	=	rand(10000,99999); //更换一下验证码
	
	$sql	=	"select uid from k_user where username='$username' and answer='".$_POST['answer']."' limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
	if($rs['uid']){   
		$password	=	date("His").rand(0,1000);
		$sql		=	"update k_user set password='".md5($password)."' where uid=".$rs['uid'];
		$mysqli->autocommit(FALSE);
		$mysqli->query("BEGIN"); //事务开始
		try{
			$mysqli->query($sql);
			$q1		=	$mysqli->affected_rows;
			if($q1 == 1){
				$mysqli->commit(); //事务提交
				message('您的新密码为：'.$password,'get_pwd.php');
			}else{
				$mysqli->rollback(); //数据回滚
				message("由于网络堵塞,密码修改失败.\\n请您稍候再试,或联系在线客服.".$password,'get_pwd.php');
			}
		}catch(Exception $e){
			$mysqli->rollback(); //数据回滚
			message("由于网络堵塞,密码修改失败.\\n请您稍候再试,或联系在线客服.".$password,'get_pwd.php');
		}
	}else{
		message("回答错误",'get_pwd.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>修改资料</title>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript">
function next_checkNum_img(){
	document.getElementById("checkNum_img").src = "yzm.php?"+Math.random();
	return false;
}

function check(){
	if($("#username").val() == ''){
		$("#username").focus();
		return false;
	}
    <? if(isset($ask)){?>
	if($("#answer").val() == ''){
		$("#answer").focus();
		return false;
	}
	<? }?>
	if($("#vlcodes").val().length < 4){
		$("#vlcodes").select();
		return false;
	}
	
	return true;
}
</script>
<style> 
</style> 
<link href="css/bcss.css" rel="stylesheet" type="text/css" />
</head> 
<body id="zhuce_body"> 
<div>
  <!--替换内容部分--> 

  <div  id="zhuce_top" style="background:none repeat scroll 0 0;"> 
     <form  action="get_pwd.php?action=<?=$action?>" method="post" onsubmit="return check();" >
    <div class="re_b3">找回密码</div>
    <div class="re_30"  style="margin-top:10px;">
      <div class="re_33">用户名：</div>
    <span class="zhuce_02">
        <input type="text" id="username"  name="username" value="<?=@$username?>"/>
    </span>
      </div> 
       <? if(isset($ask)){?>
    <div class="re_30" style="margin-top:10px;">
	  <div class="re_33">密码提示问题：</div>
	  <div class="ziliao_02">&nbsp;<font color="#000000"><?=$ask?></font></div> 
	</div>
	<div class="re_30" style="margin-top:10px;">
	  <div class="re_33">密码问题答案：</div>
	  <span class="zhuce_02"><input name="answer" type="text" id="answer" value="" /></span>
    </div>
    <? }?>
        <div class="re_30" style="margin-top:10px;">
      <div class="re_33">验证码：</div>
      <span class="zhuce_02"><input name="vlcodes" id="vlcodes"  type="text"  style="width: 90px" class="re_a1" maxlength="4" onfocus="next_checkNum_img()" /> <img src="../yzm.php" alt="点击更换" name="checkNum_img" id="checkNum_img" style="cursor:pointer; position:relative; top:3px;" onclick="next_checkNum_img()" /></span></div> 
  <div class="tiao_02" style="margin-top:10px;"> 
    
    <input name="tj" type="submit" style="width:80px;text-align:center;display:block;background:url(images/nav_c_af.jpg); margin-left:100px;"  id="tj" value="下一步" title="下一步"/> 
  </div> 
 </form>
  </div> 
   <!-- 替换内容部分 --> 
</div>
</body> 
</html>