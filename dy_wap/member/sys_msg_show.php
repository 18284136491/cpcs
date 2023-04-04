<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../class/user.php");
include_once("../common/function.php");

$sql	=	"update k_user_msg set islook=1 where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."'";
$mysqli->query($sql);

$sql	=	"select * from k_user_msg where uid='".intval($_SESSION["uid"])."' and msg_id='".intval($_GET["id"])."' limit 1";
$query	=	$mysqli->query($sql);  		
$rows	=	$query->fetch_array();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<title>系统消息查询</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript" src="images/member.js"></script>
	<!--[if IE 6]><script type="text/javascript" src="images/DD_belatedPNG.js"></script><![endif]-->
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px #FFF solid;">
	<?php 
	include_once("mainmenu.php");
	?>
	<tr>
		<td colspan="2" align="center" valign="middle">
			<?php 
			include_once("usermenu.php");
			?>
			<div class="content">
				<table width="98%" border="0" cellspacing="0" cellpadding="5">
					<tr>
						<th align="center" bgcolor="#F9F9F9" style=" font-size:14px; color:#900"><?=$rows["msg_title"]?></th>
					</tr>
					<tr>
						<td align="left" style="line-height:22px;"><?=str_replace("\r\n","<br />",$rows["msg_info"])?></td>
					</tr>
					<tr>
						<td align="right" style="line-height:22px;" bgcolor="#F9F9F9"><?=$rows["msg_from"]?><br><?=date("Y-m-d",strtotime($rows["msg_time"]))?></td>
					</tr>
				</table>
				<br />
				<input name="submit" type="submit" id="submit" class="submit_108" onclick="Go('sys_msg.php');return false" value="返回上一页"/>
			</div>
		</td>
	</tr>
</table>
</body> 
</html>