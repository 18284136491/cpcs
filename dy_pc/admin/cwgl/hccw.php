<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");

$time	=	$_GET["time"];
$time	=	$time==""?"CN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()+12*3600):$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()+12*3600):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$username=	$_GET["username"];
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
$type	=	$_GET["type"];
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>财务核查</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
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
</STYLE>
</HEAD>

<body>
<script language="JavaScript" src="../../js/calendar.js"></script>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">财务核查</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF">
	 <table width="100%" cellspacing="0" cellpadding="0" border="0">
     <form name="form1" method="GET" action="hccw.php" >
      <tr>
        <td>
		<select name="time" id="time">
            <option value="CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
            <option value="EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
          </select>
		  &nbsp;开始日期
          <input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
		  <select name="bhour" id="bhour">
			<?php
			for($i=0;$i<24;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		时
		<select name="bsecond" id="bsecond">
			<?php
			for($i=0;$i<60;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		分
		&nbsp;结束日期
          <input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
		  <select name="ehour" id="ehour">
			<?php
			for($i=0;$i<24;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		时
		<select name="esecond" id="esecond">
			<?php
			for($i=0;$i<60;$i++){
				$list=$i<10?"0".$i:$i;
			?>
			<option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
			<?php } ?>
		</select>
		分</td>
	 </tr>
	 <tr>
        <td>
		<select name="type" id="type">
            <option value="" <?=$type==''?'selected':''?>>全部</option>
            <option value="1" <?=$type=='1'?'selected':''?>>存款</option>
            <option value="7" <?=$type=='7'?'selected':''?>>汇款</option>
            <option value="2" <?=$type=='2'?'selected':''?>>取款</option>
			<option value="3" <?=$type=="3"?"selected":""?>>人工汇款</option>
			<option value="4" <?=$type=="4"?"selected":""?>>彩金派送</option>
			<option value="5" <?=$type=="5"?"selected":""?>>反水派送</option>
			<option value="6" <?=$type=="6"?"selected":""?>>其他情况</option>
          </select>
			&nbsp;会员名称
          <input name="username" type="text" id="username" value="<?=$username?>" size="20" maxlength="20"/>
        &nbsp;<input name="find" type="submit" id="find" value="查找"/></td>
      </tr>
	</form>
    </table></td>
  </tr>
</table>
<br>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
      <tr bgcolor="efe" class="t-title" align="center">
        <td width="5%" height="24" ><strong>编号</strong></td>
        <td width="10%" ><strong>用户名</strong></td>
        <td width="8%" ><strong>类型</strong></td>
        <td width="25%" ><strong>系统订单号</strong></td>
        <td ><strong>汇款银行</strong></td>
        <td width="20%"><strong>金额</strong></td>
        <td width="15%" ><strong>提交时间</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");

$arr		=	array();
$arr_m		=	array();
$arr_m[1]	=	0; //存款
$arr_m[2]	=	0; //取款
$arr_m[3]	=	0; //汇款
$arr_m[4]	=	0; //人工汇款
$arr_m[5]	=	0; //彩金派送
$arr_m[6]	=	0; //反水派送
$arr_m[7]	=	0; //其他情况

$sqlwhere	=	"";
if($username!=""){
	$sqlwhere	.=	" and u.username='$username'";
}
if($type!=""){
	$sqlwhere	.=	" and m.type=$type";
}
if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime)-12*3600);
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime)-12*3600);
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
//所有该会员的存款取款记录以及加减款
$sql		=	"select m.m_value,m.m_order,m.m_make_time,m.about,m.m_id,m.assets,m.balance,m.type,u.username from k_money m left join k_user u on m.uid=u.uid where m.`status`=1 ".$sqlwhere." and m.`m_make_time`>='$q_btime' and m.`m_make_time`<='$q_etime' order by m.m_id desc";

$query	=	$mysqli->query($sql);
while($row = $query->fetch_array()){
	$arr_key	=	strtotime($row['m_make_time']);
	while(array_key_exists($arr_key,$arr)){
		$arr_key++;
	}
	$arr[$arr_key]['username']	=	$row['username'];
	if($row['type'] == 1){ //存款
		$arr[$arr_key]['type']		=	'<span style="color:#006600;">存款</span>';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[1]				+=	$row['m_value'];
	}else if($row['type'] == 2){ //取款
		$arr[$arr_key]['type']		=	'<span style="color:#FF0000;">取款</span>';
		$arr[$arr_key]['money']	=	abs($row['m_value']);
		$arr_m[2]				+=	abs($row['m_value']);
	}else if($row['type']==3){ //人工汇款
		$arr[$arr_key]['type']		=	'人工汇款';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[4]				+=	$row['m_value'];
	}else if($row['type']==4){ //彩金派送
		$arr[$arr_key]['type']		=	'彩金派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[5]				+=	$row['m_value'];
	}else if($row['type']==5){ //反水派送
		$arr[$arr_key]['type']		=	'反水派送';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[6]				+=	$row['m_value'];
	}else if($row['type']==6){ //其他情况
		$arr[$arr_key]['type']		=	'其他情况';
		$arr[$arr_key]['money']	=	$row['m_value'];
		$arr_m[7]				+=	$row['m_value'];
	}
	$arr[$arr_key]['time'] 	=	$time=='CN'?get_bj_time($row["m_make_time"]):$row["m_make_time"];
	$arr[$arr_key]['lsh'] 		=	$row['m_order'];
	$arr[$arr_key]['uid'] 		=	$row['uid'];
	$arr[$arr_key]['about'] 	=	$row['about'];
	$arr[$arr_key]['assets'] 	=	$row['assets'];
	$arr[$arr_key]['balance'] 	=	$row['balance'];
	$arr[$arr_key]['url'] 		=	'../cwgl/tixian_show.php?id='.$row['m_id'];
}

$sqlwhere	=	"";
if($username!=""){
	$sqlwhere	.=	" and u.username='$username'";
}
if($type!="" && $type!=7){
	$sqlwhere	.=	" and 1=2";
}
//取出汇款记录
$sql	=	"select m.money,m.lsh,m.adddate,m.id,m.assets,m.balance,m.bank,u.username from huikuan m left join k_user u on m.uid=u.uid where m.`status`=1 ".$sqlwhere." and m.`adddate`>='$q_btime' and m.`adddate`<='$q_etime' order by m.id desc";
$query	=	$mysqli->query($sql);
while($row = $query->fetch_array()){
	$arr_key	=	strtotime($row['adddate']);
	while(array_key_exists($arr_key,$arr)){
		$arr_key++;
	}
	$arr[$arr_key]['username']	=	$row['username'];
	$arr[$arr_key]['type']		=	'<span style="color:#FF9900;">汇款</span>';
	$arr[$arr_key]['money']	=	$row['money'];
	$arr_m[3]				+=	$row['money'];
	$arr[$arr_key]['time'] 	=	$time=='CN'?get_bj_time($row["adddate"]):$row["adddate"];
	$arr[$arr_key]['lsh'] 		=	$row['lsh'];
	$arr[$arr_key]['bank'] 	=	$row['bank'];
	$arr[$arr_key]['assets'] 	=	$row['assets'];
	$arr[$arr_key]['balance'] 	=	$row['balance'];
	$arr[$arr_key]['url'] 		=	'../cwgl/hk_look.php?id='.$row['id'];
}
krsort($arr);
$i	=	1;
foreach($arr as $k=>$v){
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td  height="35" align="center" ><?=$i++?></td>
        <td><?=$v["username"]?><br><a href="../bbgl/report_day.php?username=<?=$v["username"]?>" target="_blank">核查会员</a></td>
        <td><?=$v["type"]?></td>
        <td><a href="<?=$v["url"]?>"><?=$v["lsh"]?></a><?php
		if($v["about"]) echo '<br/>'.'<span style="color:#FF0000;">'.$v["about"].'</span>';
		?></td>
        <td><?=$v["bank"]?><br><a href="../hygl/lsyhxx.php?action=1&username=<?=$v["username"]?>" target="_blank">历史银行卡信息</a></td>
        <td>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="33%" style="color:#999999;"><?=$v["assets"]?></td>
              <td width="34%" align="center" style="color:#225d9c;"><?=$v["money"]?></td>
              <td width="33%" align="right" style="color:#999999;"><?=$v["balance"]?></td>
            </tr>
          </table>          </td>
        <td><?=$v["time"]?></td>
        </tr>
      <?
	}
      ?>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:24px;">存款：<span style="color:#006600;"><?=sprintf("%.2f",$arr_m[1])?></span>，取款：<span style="color:#FF0000;"><?=sprintf("%.2f",$arr_m[2])?></span>，汇款：<span style="color:#CC9900;"><?=sprintf("%.2f",$arr_m[3])?></span>，人工汇款：<?=sprintf("%.2f",$arr_m[4])?>，彩金派送：<?=sprintf("%.2f",$arr_m[5])?>，反水派送：<?=sprintf("%.2f",$arr_m[6])?>，其他情况：<?=sprintf("%.2f",$arr_m[7])?></td>
  </tr>
</table>
</body>
</html>