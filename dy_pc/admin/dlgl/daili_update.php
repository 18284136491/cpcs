<?php
include_once("../common/login_check.php"); 
check_quanxian("dlgl"); 
include_once("../../include/mysqli.php");

$username	=	$_POST["username"];
$sql		=	"select username from k_user where username='".$username."' limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
if($rs['username']){
	message('用户名已经存在!');
}
$password	=	md5($_POST["password"]);
$cf_password	=	md5($_POST["cf_password"]);
if($password!=$cf_password){
	message('密码输入错误，请重新输入!');
}
$qkpwd		=	'';
$ask		=	'';
$answer		=	'';
$sex		=	$_POST["password"];
$birthday	=	'';
$mobile		=	'';
$email		=	'';
//2014-12-31 add
$zfb		=	'';

$jsr		=	'';
$is_daili   =   1;
$is_stop	=	0;
$pay_name	=	$_POST["truename"];
$gid		=	$_POST["gid"];

$logintime	=	date("Y-m-d H:i:s");

$top_uid	=	0;

/* 正则表达式验证输入 2014.01.14 BEGIN */
if(!preg_match("/^[0-9a-zA-Z]{5,10}$/",$username)){
	message('您在网站的登录帐户，5-10个英文或数字组成');
}

include_once("../../ip.php");
$address	=	iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市

$sql		=	"insert into k_user(username,password,qk_pwd,ask,answer,sex,birthday,mobile,email,reg_ip,login_ip,login_time,pay_name,top_uid,agents,is_stop,gid,lognum,reg_address,zfb,ag_zr_is,is_daili) values ('$username','$password','$qkpwd','$ask','$answer','$sex','$birthday','$mobile','$email','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['REMOTE_ADDR']."','$logintime','$pay_name',$top_uid,'$jsr',$is_stop,$gid,1,'$address','$zfb',0,1)";
//echo $sql;
//exit;
$mysqli->autocommit(FALSE);
$mysqli->query("BEGIN"); //事务开始
try{
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	$id 	=	$mysqli->insert_id; 
	$time	=	time();
	include_once("../../cache/conf.php");
	$sql	=	"insert into `k_user_login` (`login_id`,`uid`,`login_time`,`is_login`,www) VALUES ('$time_$id_$username',$id,'$time',1,'$conf_www')";
	$mysqli->query($sql);
	$q2		=	$mysqli->affected_rows;
	
	$sql	=	"insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES ($id,'$username','".$_SERVER['REMOTE_ADDR']."','$address',now(),'$conf_www')";
	include_once("../../include/mysqlio.php");
	$mysqlio->query($sql);
	$q3		=	$mysqlio->affected_rows;
	
	if($q1 == 1 && $q2 == 1){
			$mysqli->commit(); //事务提交
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"用户ID".$id."获得本网代理资格");
			
			include_once("../../class/user.php");
			user::msg_add($id,$web_site['reg_msg_from'],'恭喜您成为'.$web_site['web_name'].'代理',"您的代理申请已获得".$web_site['web_name']."的批准！<br><br><span onclick=\"javascript:Go(\'agent.php\');return false;\" style=\"color:#0000FF; cursor:pointer;\">&gt;&gt;请点击这里获取推广代码</span>");
			
			$sql = "insert into k_user_daili (uid,about,status,add_time) values ($id,'由管理员".$_SESSION['superadmin']."从后台添加',1,'$logintime')";
			$mysqli->query($sql);
			//$_SESSION["uid"]			=	$id;
			//$_SESSION["username"]		=	$username;
			//$_SESSION["gid"]			=	$gid;
			//$_SESSION["denlu"]			=	'one';
			//$_SESSION['user_login_id']	=	$time.'_'.$id.'_'.$username;
			//user::msg_add($_SESSION["uid"],$web_site['reg_msg_from'],$web_site['reg_msg_title'],$web_site['reg_msg_msg']);
			
			echo "<script>alert(\"代理添加成功!\");window.open('dailist.php?1=1','_self');</script>";
			exit();
	}else{
		
		$mysqli->rollback(); //数据回滚
		message("由于网络堵塞，本次注册失败1。\\n请您稍候再试，或联系在线客服。");
	}
}catch(Exception $e){
	$mysqli->rollback(); //数据回滚
	message("由于网络堵塞，本次注册失败2。\\n请您稍候再试，或联系在线客服。");
}
?>