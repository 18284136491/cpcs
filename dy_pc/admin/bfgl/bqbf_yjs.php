<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");
$page_date		=	date("m-d");

if(isset($_GET["date"])){
	$page_date	=	$_GET["date"];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>已结算注单</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
<script language="javascript">
function $(_sId){
	return document.getElementById(_sId);
}

function gopage(url)
{
location.href=url;
}
function re_load()
{
location.reload();
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='mid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("s_action").value;
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}
		if(action=="2") document.form1.action="ft_list.php?type=baseball_match&php=bqbf_yjs";
		if(action=="1") document.form1.action="re_jiesuan.php?type=baseball_match&php=bqbf_yjs";
		if(action=="3") document.form1.action="set_wpb_score.php?type=baseball_match&php=bqbf_yjs";
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}

</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF"> 
<form id="form1" name="form1" method="post" action="re_jiesuan.php" onSubmit="return check();">
<table width="900" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200" height="24">选择日期：
          <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1"><?php
for ($i=0;$i<=10;$i++){
	$s		=	strtotime("-$i day");
	$date	=	date("m-d",$s);
?>
        <option value="<?=$_SERVER['PHP_SELF']?>?date=<?=$date?>" <?=$page_date==$date ? 'selected' : ''?>><?=$date?></option>
<?php
}
?>
      </select></td>
        <td width="200"><a href="bqbf.php?date=<?=$page_date?>" style="font-size:13px;">&lt;&lt;返回未结算</a></td>
        <td width="200" align="center"><input type="button" name="Submit" value="刷新棒球" onClick="window.location.reload();"></td>
        <td width="300" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="3">录入比分</option>
        <option value="1">重新结算</option>
        <option value="2">查看未结算注单</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
  </table>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="190" height="24" align="middle"> 
       <?=$page_date?> </td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="210">主场队伍</td>
      <td align="middle" width="210">客场队伍</td>
      <td width="100" align="middle">上半场</td>
      <td align="middle" width="100">全场比分</td>
      <td width="32" align="middle"><input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/></td>
    </tr>
    <?php
   $sql			=	"SELECT Match_ID,Match_Time,Match_Master,Match_Guest,Match_Name,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR FROM baseball_match where match_js=1 and match_Date='$page_date' order by Match_CoverDate,match_name,Match_Master desc";
    $query		=	$mysqlis->query($sql);
	while($rows	=	$query->fetch_array()){
    ?>
    <tr class="m_cen" align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
      <td width="190"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="50"><?=$rows["Match_Time"]?></td>
      <td width="210"><div align="right" style="padding-right:5px;"><?=$rows["Match_Master"]?></div></td>
      <td width="210"><div align="left" style="padding-left:5px;"><?=$rows["Match_Guest"]?></div></td>
      <td width="100"> 
        <?if($rows["MB_Inball_HR"]<0){ echo "比赛无效"; }else {?>
        <?=$rows["MB_Inball_HR"]?>：<?=$rows["TG_Inball_HR"] ?>
        <?}?>      <a href="set_bet_score.php?mid=<?=$rows["Match_ID"]?>"></a></td>
     <td> 
       <?if($rows["MB_Inball"]<0){ echo "比赛无效"; }else {?> <?=$rows["MB_Inball"]?>：<?=$rows["TG_Inball"]?>
       <?}?>      </td>
      <td><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td>
    </tr>
    <?}?>
</table>
</form>
</body>
</html>