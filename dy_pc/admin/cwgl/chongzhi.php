<?php
include_once("../common/login_check.php");
check_quanxian("cwgl");
$sum = $true = $false = $cl = 0;

$time	=	$_GET["time"];
$time	=	$time==""?"CN":$time;
$status	=	$_GET["status"];
$order	=	$_GET["order"];
$order	=	$order==""?"m_id":$order;
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
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>存款管理</TITLE>
<script language="javascript">
function go(value){
location.href=value;
}
</script>
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
    <td height="24" nowrap background="../images/06.gif"><font ><span class="STYLE2">存款管理：查看所有的用户存款记录</span></font></td>
  </tr>
  <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="100%" cellspacing="0" cellpadding="0" border="0">
     <form name="form1" method="GET" action="chongzhi.php" >
      <tr>
        <td align="left"><select name="order" id="order">
         <option value="m_id" <?=$order=='m_id' ? 'selected' : ''?>>默认排序</option>
        <option value="m_value" <?=$order=='m_value' ? 'selected' : ''?>>存款金额</option>
        </select>
		&nbsp;<select name="status" id="status">
            <option value="2" <?=$status=='2' ? 'selected' : ''?> style="color:#FF9900;">未处理</option>
            <option value="0" <?=$status=='0' ? 'selected' : ''?> style="color:#FF0000;">存款失败</option>
            <option value="1" <?=$status=='1' ? 'selected' : ''?> style="color:#006600;">存款成功</option>
            <option value="3" <?=$status=='3' ? 'selected' : ''?>>全部存款</option>
          </select>
          &nbsp;<select name="time" id="time">
            <option value="CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
            <option value="EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
          </select>
          &nbsp;会员名称
          <input name="username" type="text" id="username" value="<?=@$_GET['username']?>" size="15" maxlength="20"/>
		  </td>
        </tr>
		<tr>
		<td align="left">开始日期
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
		分
		&nbsp;<input name="find" type="submit" id="find" value="查找"/>
		</td>
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
        <td width="10%" ><strong>编号</strong></td>
        <td width="30%" ><strong>系统订单号</strong></td>
        <td width="10%"><strong>存款金额</strong></td>
        <td width="10%"><strong>手续费</strong></td>
        <td width="10%"><strong>查看财务</strong></td>
        <td width="15%" ><strong>申请时间</strong></td>
        <td width="15%" ><strong>操作</strong></td>
        </tr>    
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

$sqlwhere	=	"";
if($status!=3){
	$sqlwhere	.=	" and status=".$status;
}
if($username!=""){
	$sqlwhere	.=	" and uid=(select uid from k_user where username='$username')";
}
if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime)-12*3600);
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime)-12*3600);
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
$sql	=	"select m_id from k_money where `type`=1 ".$sqlwhere." and `m_make_time`>='$q_btime' and `m_make_time`<='$q_etime' order by $order desc";

$query	=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$mid		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$mid .=	$row['m_id'].',';
  }
  if($i > $end) break;
  $i++;
}
$sum	=	$true	=	$sxf_sum	=	$false	=	$cl	=	0;
if($mid){
	$mid	=	rtrim($mid,',');
	$arr	=	array();
	$sql	=	"select k_money.*,k_user.username from k_money left outer join k_user on k_money.uid=k_user.uid where m_id in ($mid) order by $order desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
	  	$sum	+=	abs($rows["m_value"]);
		$sxf_sum+=	$rows["sxf"];
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" >
        <td  height="35" align="center"><?=$rows["m_id"]?></td>
        <td><?=$rows["m_order"]?></td>
        <td><span style="color:#999999;"><?=sprintf("%.2f",$rows["assets"])?></span><br /><?=sprintf("%.2f",abs($rows["m_value"]))?><br /><span style="color:#999999;"><?=sprintf("%.2f",$rows["balance"])?></span></td>
        <td><?=sprintf("%.2f",$rows["sxf"])?></td>
        <td><a href="hccw.php?username=<?=$rows["username"]?>">查看财务</a></td>
        <td><?=$time=='CN' ? get_bj_time($rows["m_make_time"]) : $rows["m_make_time"]?></td>
        <td><? if($rows["status"]==0){
					echo '<span style="color:#FF0000;">存款失败</span>';
					$false	+=	abs($rows["m_value"]);
		 	}else if($rows["status"]==1){
		 			echo "<span style='color:#009900;'>存款成功</span><br/><a href='tixian_show.php?id=".$rows['m_id']."'>详细</a>";
					$true	+=	abs($rows["m_value"]);
		 	}else{
		 		echo "<div style=\"float:left;\"><a onclick=\"return confirm('确定存款成功?')\" href=\"ck_set.php?ok=1&amp;id=".$rows["m_id"]."\">存款成功</a></div><div style=\"float:right;\"><a onclick=\"return confirm('确定存款失败?')\" href=\"ck_set.php?ok=0&amp;id=".$rows["m_id"]."\">存款失败</a></div>";
				$cl	+=	abs($rows["m_value"]);
		 	}
		?></td>
        </tr>
<?php
      }
}
?>
    </table></td>
  </tr>
  <tr>
    <td style="line-height:24px;"><div>总金额：<span style="color:#0000FF"><?=sprintf("%.2f",$sum)?></span>，成功：<span style="color:#006600;"><?=sprintf("%.2f",$true)?></span>，手续费：<span style="color:#FF00FF;"><?=sprintf("%.2f",$sxf_sum)?></span>，失败：<span style="color:#FF0000;"><?=sprintf("%.2f",$false)?></span>，处理中：<span style="color:#FF9900;"><?=sprintf("%.2f",$cl)?></span></div>
	<div><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></div></td>
  </tr>
</table>
</body>
</html>