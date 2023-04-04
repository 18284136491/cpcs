<?php
include_once("../common/login_check.php");
check_quanxian("xtgl");

include_once("../../include/mysqli.php");
	
/**
* 过滤html代码
**/
function htmlEncode($string) { 
	$string=trim($string); 
	$string=str_replace("\'","'",$string); 
	$string=str_replace("&amp;","&",$string); 
	$string=str_replace("&quot;","\"",$string); 
	$string=str_replace("&lt;","<",$string); 
	$string=str_replace("&gt;",">",$string); 
	$string=str_replace("&nbsp;"," ",$string); 
	$string=nl2br($string); 
	//$string=mysql_real_escape_string($string);
	return $string;
}

if(@$_GET["action"]=="save"){
	$sql	=	"update web_config set web_name='".$_POST["web_name"]."',conf_www='".$_POST["conf_www"]."',close='".intval($_POST["close"])."',why='".$_POST["why"]."',reg_msg_title='".$_POST["reg_msg_title"]."',reg_msg_info='".$_POST["reg_msg_info"]."',reg_msg_from='".$_POST["reg_msg_from"]."',ck_limit='".$_POST["ck_limit"]."',qk_limit='".$_POST["qk_limit"]."',qk_time_begin='".$_POST["qk_time_begin"]."',qk_time_end='".$_POST["qk_time_end"]."'";
	//echo $sql;
    $mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN"); //事务开始
	try{
		$mysqli->query($sql);
		$q1		=	$mysqli->affected_rows;
		$q1=1;
		if($q1 == 1){
			include_once("../../class/admin.php");
			admin::insert_log($_SESSION["adminid"],"修改了系统参数配置");
	
            //写配置
			$str	 =	"<?php \r\n";
			$str	.=	"unset(\$web_site);\r\n";
			$str	.=	"\$web_site			=	array();\r\n";
			$str	.=	"\$web_site['close']	=	".intval($_POST["close"]).";\r\n";
			$str	.=	"\$web_site['web_name']	=	'".htmlEncode($_POST["web_name"])."';\r\n";
			$str	.=	"\$web_site['why']	=	'".htmlEncode($_POST["why"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_from']	=	'".htmlEncode($_POST["reg_msg_from"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_title']	=	'".htmlEncode($_POST["reg_msg_title"])."';\r\n";
			$str	.=	"\$web_site['reg_msg_msg']	=	'".htmlEncode($_POST["reg_msg_info"])."';\r\n";
			$str	.=	"\$web_site['ck_limit']	=	'".htmlEncode($_POST["ck_limit"])."';\r\n";
			$str	.=	"\$web_site['qk_limit']	=	'".htmlEncode($_POST["qk_limit"])."';\r\n";
			$str	.=	"\$web_site['jf_tzjf']	=	".htmlEncode($_POST["jf_tzjf"]).";\r\n";
			$str	.=	"\$web_site['jf_czjf']	=	".htmlEncode($_POST["jf_czjf"]).";\r\n";
			$str	.=	"\$web_site['jf_min']	=	".htmlEncode(is_numeric($_POST["jf_min"]) ? $_POST["jf_min"] : 0).";\r\n";
			$str	.=	"\$web_site['qk_time_begin']	=	'".htmlEncode($_POST["qk_time_begin"])."';\r\n";
			$str	.=	"\$web_site['qk_time_end']	=	'".htmlEncode($_POST["qk_time_end"])."';\r\n";
			$str	.=	"\$web_site['cqssc']	=	".intval($_POST["cqssc"]).";\r\n";
			$str	.=	"\$web_site['jxssc']	=	".intval($_POST["jxssc"]).";\r\n";
			$str	.=	"\$web_site['xjssc']	=	".intval($_POST["xjssc"]).";\r\n";
			$str	.=	"\$web_site['gdklsf']	=	".intval($_POST["gdklsf"]).";\r\n";
			$str	.=	"\$web_site['xync']	=	".intval($_POST["xync"]).";\r\n";
			$str	.=	"\$web_site['pk10']	=	".intval($_POST["pk10"]).";\r\n";
			$str	.=	"\$web_site['xyft']	=	".intval($_POST["xyft"]).";\r\n";
			$str	.=	"\$web_site['kl8']	=	".intval($_POST["kl8"]).";\r\n";
			$str	.=	"\$web_site['six']	=	".intval($_POST["six"]).";\r\n";
			$str	.=	"\$web_site['3d']	=	".intval($_POST["3d"]).";\r\n";
			$str	.=	"\$web_site['pl3']	=	".intval($_POST["pl3"]).";\r\n";
			$str	.=	"\$web_site['web_title']	=	'".htmlEncode($_POST["web_title"])."';\r\n";
			$str	.=	"\$web_site['zr_url']	=	'".htmlEncode($_POST["zr_url"])."';\r\n";
			$str	.=	"\$web_site['zh_low']	=	'".intval($_POST["zh_low"])."';\r\n";
			$str	.=	"\$web_site['zh_high']	=	'".intval($_POST["zh_high"])."';\r\n";
			$str	.=	"\$web_site['pk10_ktime']	=	'".$_POST["des_pk10time"]."';\r\n";
			$str	.=	"\$web_site['pk10_knum']	=	'".intval($_POST["des_pk10num"])."';\r\n";
			$str	.=	"\$web_site['kl8_ktime']	=	'".$_POST["des_kl8time"]."';\r\n";
			$str	.=	"\$web_site['kl8_knum']	=	'".intval($_POST["des_kl8num"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou1']	=	'".intval($_POST["zrwh_zhou1"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou2']	=	'".intval($_POST["zrwh_zhou2"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou3']	=	'".intval($_POST["zrwh_zhou3"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou4']	=	'".intval($_POST["zrwh_zhou4"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou5']	=	'".intval($_POST["zrwh_zhou5"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou6']	=	'".intval($_POST["zrwh_zhou6"])."';\r\n";
			$str	.=	"\$web_site['zrwh_zhou7']	=	'".intval($_POST["zrwh_zhou7"])."';\r\n";
			$str	.=	"\$web_site['zrwh_begin']	=	'".htmlEncode($_POST["zrwh_begin"])."';\r\n";
			$str	.=	"\$web_site['zrwh_end']	=	'".htmlEncode($_POST["zrwh_end"])."';\r\n";
			 
			
			if(!write_file("../../cache/website.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设/website.php文件权限为：0777");
			}
            
            $str2     =    "<?php \r\n";
            $str2    .=    "unset(\$conf_www);\r\n";
            $str2    .=    "\$conf_www            =    '".htmlEncode($_POST["conf_www"])."';\r\n";
              
            
            if(!write_file("../../cache/conf.php",$str2.'?>')){ //写入缓存失败
                message("缓存文件写入失败！请先设/conf.php文件权限为：0777");
            }
			//手机缓存
			/*
			if(!write_file($m_file."cache/website.php",$str.'?>')){ //写入缓存失败
				message("缓存文件写入失败！请先设/website.php文件权限为：0777");
			}
            if(!write_file($m_file."cache/conf.php",$str2.'?>')){ //写入缓存失败
                message("缓存文件写入失败！请先设/conf.php文件权限为：0777");
            }
			*/
			$mysqli->commit(); //事务提交
            message("网站设置成功!");
		}else{
			$mysqli->rollback(); //数据回滚
		}
	}catch(Exception $e){
		$mysqli->rollback(); //数据回滚
	}
}

$sql	=	"select * from web_config limit 1";
$query	=	$mysqli->query($sql);
$rows	=	$query->fetch_array();
include_once("../../cache/website.php");
?>
<HTML> 
<HEAD> 
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" /> 
<TITLE>网站信息设置</TITLE> 
<link rel="stylesheet" href="../Images/CssAdmin.css">
<style type="text/css"> 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size: 12px;
}
</style> 
<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</HEAD> 
 
<body> 
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <tr> 
    <td height="24" nowrap background="../images/06.gif"><img src="../images/Explain.gif" width="18" height="18" border="0" align="absmiddle">&nbsp;系统管理：添加，修改站点的相关信息</td> 
  </tr> 
  <tr> 
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
  <form action="set_site.php?action=save" method="post" name="editForm1" id="editForm1" > 
  <tr> 
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="0" cellpadding="0" cellspacing="0" id=editProduct idth="100%"> 
      <tr> 
        <td width="160" height="30" align="right">&nbsp;</td> 
        <td width="816"><input name="close" type="checkbox" id="close" style='HEIGHT: 13px;width: 13px;' value="1"  <?=$rows["close"]==1 ? 'checked' : ''?> >
          网站关闭&nbsp;（出现攻击时请先关闭再排查）</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 网站标题：</td> 
        <td><input name="web_title" type="text" class="textfield" id="web_title"  value="<?=$web_site["web_title"]?>" size="100" >&nbsp;*</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 网站名称：</td> 
        <td><input name="web_name" type="text" class="textfield" id="web_name"  value="<?=$rows["web_name"]?>" size="40" >&nbsp;*</td> 
      </tr> 
      <tr> 
        <td height="30" align="right">  <img src="../images/07.gif" width="12" height="12"> 网站域名：</td> 
        <td><input name="conf_www" type="text" class="textfield" id="conf_www"  value="<?=$rows["conf_www"]?>" size="40" >&nbsp;*&nbsp;不要加http://  </td> 
      </tr>
	          <tr> 
        <td height="30" align="right" >  注册消息标题：</td> 
        <td><input name="reg_msg_title" type="text" class="textfield" id="reg_msg_title" value="<?=$rows["reg_msg_title"]?>" size="40"></td> 
      </tr> 
	          <tr> 
        <td height="20" align="right" >  注册消息内容：</td> 
        <td>
		<textarea name="reg_msg_info" cols="80" rows="10" class="textfield"><?=$rows["reg_msg_info"]?></textarea></td> 
      </tr> 
	          <tr> 
        <td height="30" align="right" >  注册消息发送者：</td> 
        <td><input name="reg_msg_from" type="text" class="textfield" id="reg_msg_from" value="<?=$rows["reg_msg_from"]?>" size="40"></td> 
      </tr> 
	          <tr> 
        <td height="20" align="right" >  网站关闭原因：</td> 
        <td>
		<textarea name="why" cols="80" class="textfield" rows="2" id="why" ><?=$rows["why"]?></textarea></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  可取款时间：</td> 
        <td>
            <input name="qk_time_begin" type="text" class="textfield" maxlength="5" id="qk_time_begin" value="<?=$rows["qk_time_begin"]?>" size="4">
            ~
            <input name="qk_time_end" type="text" class="textfield" maxlength="5" id="qk_time_end" value="<?=$rows["qk_time_end"]?>" size="4">
        </td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  在线支付最低存款：</td> 
        <td><input name="ck_limit" type="text" class="textfield" maxlength="10" id="ck_limit" value="<?=$rows["ck_limit"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  最低取款：</td> 
        <td><input name="qk_limit" type="text" class="textfield" maxlength="10" id="qk_limit" value="<?=$rows["qk_limit"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  投注积分：</td> 
        <td>投注<strong style="color:#F00">1元</strong>赠送 <input name="jf_tzjf" type="text" class="textfield" maxlength="10" id="jf_tzjf" value="<?=$web_site["jf_tzjf"]?>" size="5">积分</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  充值积分：</td> 
        <td>充值<strong style="color:#F00">1元</strong>赠送 
          <input name="jf_czjf" type="text" class="textfield" maxlength="10" id="jf_czjf" value="<?=$web_site["jf_czjf"]?>" size="5">积分</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  最低兑换积分：</td> 
        <td> <input name="jf_min" type="text" class="textfield" maxlength="10" id="jf_min" value="<?=$web_site["jf_min"]?>" size="5"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  采种关闭：</td> 
        <td><input name="cqssc" type="checkbox" <?=$web_site['cqssc']==1 ? 'checked' : ''?> id="cqssc" value="1" />重庆时时彩
			<input name="jxssc" type="checkbox" <?=$web_site['jxssc']==1 ? 'checked' : ''?> id="jxssc" value="1" />江西时时彩
            <input name="xjssc" type="checkbox" <?=$web_site['xjssc']==1 ? 'checked' : ''?> id="xjssc" value="1" />新疆时时彩
			<input name="pk10" type="checkbox" <?=$web_site['pk10']==1 ? 'checked' : ''?> id="pk10" value="1" />北京赛车PK拾
            <input name="xyft" type="checkbox" <?=$web_site['xyft']==1 ? 'checked' : ''?> id="xyft" value="1" />幸运飞艇
            <input name="gdklsf" type="checkbox" <?=$web_site['gdklsf']==1 ? 'checked' : ''?> id="gdklsf" value="1" />广东快乐十分
             <input name="xync" type="checkbox" <?=$web_site['xync']==1 ? 'checked' : ''?> id="xync" value="1" />幸运农场
			<input name="kl8" type="checkbox" <?=$web_site['kl8']==1 ? 'checked' : ''?> id="kl8" value="1" />北京快乐8
			<input name="3d" type="checkbox" <?=$web_site['3d']==1 ? 'checked' : ''?> id="3d" value="1" />福彩3D
			<input name="pl3" type="checkbox" <?=$web_site['pl3']==1 ? 'checked' : ''?> id="pl3" value="1" />排列三
            <input name="six" type="checkbox" <?=$web_site['six']==1 ? 'checked' : ''?> id="six" value="1" />香港乐透 </td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  北京赛车期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['pk10_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_pk10time" id="des_pk10time" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['pk10_knum']?>" size="10" name="des_pk10num" id="des_pk10num" />(例如:2013-06-30开的最后一期是369979)</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  快乐8期数校对：</td> 
        <td>开奖时间:<input type="text" class="textfield" value="<?=$web_site['kl8_ktime']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" name="des_kl8time" id="des_kl8time" readonly/>开奖期号:<input type="text" class="textfield" value="<?=$web_site['kl8_knum']?>" size="10" name="des_kl8num" id="des_kl8num" />(例如:2013-05-30开的最后一期是569859)</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  真人网址：</td> 
        <td><input name="zr_url" type="text" class="textfield" maxlength="40" id="zr_url" value="<?=$web_site["zr_url"]?>" size="40">&nbsp;&nbsp;不要加http://</td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  真人维护：</td> 
        <td>
			<input name="zrwh_zhou1" type="checkbox" <?=$web_site['zrwh_zhou1']==1 ? 'checked' : ''?> id="zrwh_zhou1" value="1" />周一
			<input name="zrwh_zhou2" type="checkbox" <?=$web_site['zrwh_zhou2']==2 ? 'checked' : ''?> id="zrwh_zhou2" value="2" />周二
			<input name="zrwh_zhou3" type="checkbox" <?=$web_site['zrwh_zhou3']==3 ? 'checked' : ''?> id="zrwh_zhou3" value="3" />周三
			<input name="zrwh_zhou4" type="checkbox" <?=$web_site['zrwh_zhou4']==4 ? 'checked' : ''?> id="zrwh_zhou4" value="4" />周四
			<input name="zrwh_zhou5" type="checkbox" <?=$web_site['zrwh_zhou5']==5 ? 'checked' : ''?> id="zrwh_zhou5" value="5" />周五
			<input name="zrwh_zhou6" type="checkbox" <?=$web_site['zrwh_zhou6']==6 ? 'checked' : ''?> id="zrwh_zhou6" value="6" />周六
			<input name="zrwh_zhou7" type="checkbox" <?=$web_site['zrwh_zhou7']==7 ? 'checked' : ''?> id="zrwh_zhou7" value="7" />周日
			维护时间:<input name="zrwh_begin" type="text" class="textfield" maxlength="5" id="zrwh_begin" value="<?=$web_site["zrwh_begin"]?>" size="4">
            ~
            <input name="zrwh_end" type="text" class="textfield" maxlength="5" id="zrwh_end" value="<?=$web_site["zrwh_end"]?>" size="4"><br>
		</td> 
      </tr>
	  <tr> 
        <td height="30" align="right" >  额度转换最低：</td> 
        <td><input name="zh_low" type="text" class="textfield" maxlength="10" id="zh_low" value="<?=$web_site["zh_low"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right" >  额度转换最高：</td> 
        <td><input name="zh_high" type="text" class="textfield" maxlength="10" id="zh_high" value="<?=$web_site["zh_high"]?>" size="10"></td> 
      </tr>
      <tr> 
        <td height="30" align="right">&nbsp;</td> 
        <td valign="bottom"><input name="submitSaveEdit" type="submit" class="button"  id="submitSaveEdit" value="保存" style="width: 60;" ></td> 
      </tr> 
      <tr> 
        <td height="20" align="right">&nbsp;</td> 
        <td valign="bottom">&nbsp;</td> 
      </tr> 
    </table></td> 
  </tr> 
  </form> 
</table></td> 
  </tr> 
</table> 
</body> 
</html> 