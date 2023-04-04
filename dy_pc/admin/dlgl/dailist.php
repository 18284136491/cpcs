<?php
include_once("../common/login_check.php");
check_quanxian("dlgl"); 
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>代理列表</TITLE>
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
.t-title{background:url(/super/images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>

<body>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">代理列表：代理列表</span></font></td>
  </tr>
   <tr>
    <td height="24" align="center" nowrap bgcolor="#FFFFFF"><table width="823">
          <form name="form1" method="get" action="daili.php">
      <tr>
        <td width="124" align="center"><a href="dailist.php?1=1" style="color:#0000FF;">全部代理</a></td>
        <td width="124" align="center"><a href="dailist.php?stop=0" style="color:#009900;">已启用代理</a></td>
        <td width="124" align="center"><a href="dailist.php?stop=1" style="color:#FF0000;">已停用代理</a></td>
        <td width="124" align="center"><a href="daili_add.php" style="color:#00F;">新增代理商</a></td>
        
        <td width="245">用户名：
          <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="20" maxlength="20">
          <label></label>          </td>
        <td width="54" align="center"><input type="submit" name="Submit" value="查找"></td>
      </tr>
          </form>
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF"><table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="10%" ><strong>代理商ID</strong></td>
        <td width="10%" ><strong>用户名/姓名</strong></td>
        <td width="10%" ><strong>电话/Email</strong></td>
        <td width="10%" ><strong>支付宝</strong></td>
        <td width="10%" ><strong>下级总计</strong></td>
        <td width="10%" ><strong>登录次数</strong></td>
        <td width="15%" ><strong>新增日期</strong></td>
        <td width="10%" ><strong>账号状态</strong></td>
        <td width="15%" ><strong>操作</strong></td>
      </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除 ********************/
$did	=	0;
if($_GET['did'] > 0){
	$did	=	$_GET['did'];
}
if ($_GET["action"] == "del" && $did > 0) {
    $sql		=	"delete from k_user where uid=$did";
	$mysqli->query($sql);
}
/******************** 启用/停用 ********************/
if ($_GET["action"] == "stop" && $did > 0) {
    $sql		=	"update k_user set is_stop='{$_GET['isstop']}' where uid=$did";
	$mysqli->query($sql);
}
/******************** 删除 ********************/

$sql		=	"select * from k_user where is_daili=1 ";
if(isset($_GET["stop"])){
	$sql	.=	" and `is_stop`=".$_GET["stop"];
}
if(isset($_GET['username'])){
	$sql	.=	" and username like ('%".$_GET['username']."%')";
}

$sql	.=	" order by uid desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$did		=	'';
$i			=	1; //记录 uid 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$did .=	$row['uid'].',';
  }
  if($i > $end) break;
  $i++;
}
if($did){
	$did	=	rtrim($did,',');
	$sql	=	"select * from k_user where uid in ($did) order by uid asc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'">
              <td><?=$rows["uid"]?></td>
	          <td><a title="单击查看改代理的所有会员" href="../hygl/list.php?top_uid=<?=$rows["uid"]?>"><?=$rows["username"]?></a><br/><?=$rows["pay_name"]?></td>
	          <td><?=@htmlspecialchars($rows["mobile"])?><br/><?=@htmlspecialchars($rows["email"])?></td>
              <td><?=@htmlspecialchars($rows["zfb"])?></td>
              <?php
              		$sqlnum   =   "select count(*) as nums from k_user where top_uid='{$rows['uid']}'";
			  		$querynum	=	$mysqli->query($sqlnum);
			  		$rowsnum  =   $querynum->fetch_array()
			  ?>
	          <td><a title="单击查看改代理的所有会员" href="../hygl/list.php?top_uid=<?=$rows["uid"]?>"><?=$rowsnum['nums']?></a></td>
              <td><?=@htmlspecialchars($rows["lognum"])?></td>
	          <td><?=@htmlspecialchars($rows["reg_date"])?></td>
              <td>
              <?php
			  	if ($rows['is_stop']==0){
					echo "启用";
					}
					else{
						echo "<font color=red>停用</font>";
						}
              ?>
              </td>
              <td> 
              <?
              if($rows["is_stop"]==0){
			  ?>
			  <div>
              	<div style="float:left">
              		<a onClick="return confirm('确认停用该代理？');" href="dailist.php?did=<?=$rows["uid"]?>&action=stop&isstop=1">停用</a></div>
              <?php
			  }
			  else{
			  ?>
           		<div style="float:left">
                	<a onClick="return confirm('确认启用该代理？');" href="dailist.php?did=<?=$rows["uid"]?>&action=stop&isstop=0">启用</a></div>
		   		</div>
              <? }?>
			  	<div style="float:left">
                	&nbsp;/&nbsp;
                </div>
                <div style="float:left">
              		<a href="../hygl/user_show.php?id=<?=$rows["uid"]?>">修改</a>
              	</div>
                <div style="float:left">
                	&nbsp;/&nbsp;
                </div>
                <div style="float:left">
              		<a onClick="return confirm('确定要删除该代理？');" href="dailist.php?did=<?=$rows["d_id"]?>&action=del">删除</a>
              	</div>
              </div></td>
          </tr>   	
<?php
	}
}
?>
    </table>
    </td>
  </tr>
  <tr><td ><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td></tr>
</table>
</body>
</html>