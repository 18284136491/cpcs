<?php
include_once("../common/login_check.php"); 
check_quanxian("xxgl");
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>投诉建议</TITLE>
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
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">投诉建议列表</span></font></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" nowrap bgcolor="#FFFFFF">
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >       <tr style="background-color: #EFE" class="t-title"  align="center">
        <td width="5%"  height="20"><strong>编号</strong></td>
        <td width="57%" ><strong>标 题</strong></td>
        <td width="16%" ><strong>发表时间</strong></td>
        <td width="12%" ><strong>发表人</strong></td>
        <td ><strong>状态</strong></td>
        <td ><strong>删除</strong></td>
        </tr>
<?php
include_once("../../include/mysqli.php");
include_once("../../include/newpage.php");

/******************** 删除 ********************/
$id	=	0;
if($_GET['id'] > 0){
	$id	=	$_GET['id'];
}
if ($_GET["action"] == "del" && $id > 0) {
    $sql		=	"delete from message where id=$id";
	$mysqli->query($sql);
}
/******************** 删除 ********************/

$sql		=	"select id from message order by id desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$page		=	new newPage();
$thisPage	=	$page->check_Page($thisPage,$sum,20,40);

$id			=	'';
$i			=	1; //记录 id 数
$start		=	($thisPage-1)*20+1;
$end		=	$thisPage*20;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($id){
	$id		=	rtrim($id,',');
	$sql	=	"select m.id,m.uid,m.title,u.username,m.addtime,m.islook from message m,k_user u where m.uid=u.uid and m.id in ($id) order by m.islook asc,m.id desc";
	$query	=	$mysqli->query($sql);
	while($rows = $query->fetch_array()){
?>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'" style="background-color:#ffffff">
	          <td><?=$rows['id']?></td>
              <td align="left"><a href="tsjylook.php?id=<?=$rows['id']?>" ><?=$rows['title']?></a></td>
	          <td><?=strftime("%Y-%m-%d %H:%M:%S",$rows['addtime'])?></td>
	          <td><a href="../hygl/user_show.php?id=<?=$rows["uid"]?>"><?=$rows['username']?></a></td>
	          <td><?=$rows['islook']==1 ? '已查看' : '<span style="color:#FF0000;">未查看</span>'?></td>
              <td><a href="tsjy.php?id=<?=$rows["id"]?>&action=del" onClick="return confirm('您确定要删除这条投诉建议吗？');">删除</a></td>
            </tr>  	
<?php
	}
}
?>
	        <tr>
	          <td colspan="6" align="left" bgcolor="#CCCCCC"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?></td>
        </tr> 
    </table></td>
  </tr>
</table>
</body>
</html>