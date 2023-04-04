<?php
session_start();
include_once("../include/mysqlis.php");
include_once("../include/config.php");

$date	=	date('Y-m-d',time());
if($_GET['ymd']) $date	=	$_GET['ymd'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>万丰国际</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/css/footable.core.min.css">
  <link href="../css/jquery_dialog.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="/styles/ucenter.css">
  <script src="/assets/jquery.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/footable.min.js"></script>
  <style type="text/css">
  .panel-body{padding: 5px;}
</style>
</head>
<body>
<input type="button" value="<<返回" class="btn btn-warning pull-right" onclick="$('#J_SportsIFrame',parent.document).attr('src','left.php');"><div class="h10"></div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>篮球结果 >></h3>
  </div>
  <div class="panel-body">
    <ul class="pagination"><?php
for($i=0;$i<7;$i++){
  $d  = date('Y-m-d',time()-$i*86400);
  $dd = date('m-d',time()-$i*86400);
  if($d==$date ){
?>
    <li class="active"><a href="#"><?=$dd?></a></li>
        <? }else{ ?>
        <li><a href="?ymd=<?=$d?>"><?=$dd?></a></li>
     
        <? } ?>
<?php
}
?></ul>

      <table class="table table-bordered table-hover">
      <thead><tr class="success">
  <th data-toggle="true">赛程<br>点击每行展开</th>
    <th>开赛时间<br>主场/客场</th>
    <th data-hide="phone,tablet">1</th>
    <th data-hide="phone,tablet">2</th>
    <th data-hide="phone,tablet">3</th>
    <th data-hide="phone,tablet">4</th>
    <th data-hide="phone,tablet">上半</th>
    <th data-hide="phone,tablet">下半</th>
    <th data-hide="phone,tablet">加时</th>
    <th data-hide="phone,tablet">全场</th>
  </tr></thead><tbody>
<?php
$sql  = "select Match_Date,Match_Time, match_name,match_master,match_guest,MB_Inball_1st,TG_Inball_1st,MB_Inball_2st,TG_Inball_2st,MB_Inball_3st,TG_Inball_3st,MB_Inball_4st,TG_Inball_4st,MB_Inball_HR,  TG_Inball_HR,MB_Inball_ER,TG_Inball_ER,MB_Inball,TG_Inball,MB_Inball_Add,TG_Inball_Add from  lq_match where MB_Inball_OK is not null and  match_Date='".date('m-d',strtotime($date))."' and match_js=1 order by match_coverdate,match_id asc";
$query  = $mysqlis->query($sql);      
$rows = $query->fetch_array();
if(!$rows){
  echo "<tr><td height='100' colspan='10' align='center' bgcolor='#FFFFFF'>暂无任何赛果</td></tr>";
}else{
  do{
?>
 <tr>
    <td><strong><?=$rows["match_name"]?></strong></td>
    <td><span class="red"><?=$rows["Match_Date"]?> <?=$rows["Match_Time"]?></span><br><span class="zhu"><?=$rows["match_master"]?></span>-<span class="ke"><?=$rows["match_guest"]?></span></td>
    <td><? if($rows["MB_Inball_1st"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_1st"] ?></span>-<span class="ke"><?=$rows["TG_Inball_1st"]?></span>
      <?php } ?></td>
    <td><? if($rows["MB_Inball_2st"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_2st"] ?></span>-<span class="ke"><?=$rows["TG_Inball_2st"]?></span>
      <?php } ?></td>
    <td><? if($rows["MB_Inball_3st"]<0) {?>
      <span class="zhu">无效</span>-<span class="ke">无效</span>
      <?php }else{ ?>
    <span class="zhu"><?=$rows["MB_Inball_3st"]?></span>-<span class="ke"><?=$rows["TG_Inball_3st"]?></span>
      <?php } ?></td>
    <td><? if($rows["MB_Inball_4st"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_4st"] ?></span>-<span class="ke"><?=$rows["TG_Inball_4st"]?></span>
      <?php } ?></td>
      <td><? if($rows["MB_Inball_HR"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_HR"] ?></span>-<span class="ke"><?=$rows["TG_Inball_HR"]?></span>
      <?php } ?></td>
      <td><? if($rows["MB_Inball_ER"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_ER"] ?></span>-<span class="ke"><?=$rows["TG_Inball_ER"]?></span>
      <?php } ?></td>
      <td><? if($rows["MB_Inball_Add"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball_Add"] ?></span>-<span class="ke"><?=$rows["TG_Inball_Add"]?></span>
      <?php } ?></td>
      <td><? if($rows["MB_Inball"]<0) { ?>
        <span class="zhu">无效</span>-<span class="ke">无效</span>
       <?php }else{?>
    <span class="zhu"><?=$rows["MB_Inball"] ?></span>-<span class="ke"><?=$rows["TG_Inball"]?>
      <?php } ?></span></td>
  </tr>

<?php
  }while($rows = $query->fetch_array());
}
?></tbody>
</table>
  </div>
</div>
<script language="javascript" src="/js/mouse.js"></script>
<script language="javascript" src="/js/ifsports.js"></script>
<script type="text/javascript">
  $(function () {
    $('.table').footable();
  });
</script>
</body>
</html>