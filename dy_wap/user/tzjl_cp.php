<?php
session_start();
include_once("../common/login_check.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../include/config.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];

$bet_money	=	0;
$i			=	0;
$ky			=	0;
$jine		=	0;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>万丰国际</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/ucenter.css">
	<script src="/assets/jquery.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head> 
<script language="javascript">
if(self==top){
    top.location='/index.php';
}
</script>
<body>
<div class="h10"></div>
<div class="ucenter">
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">未结注单 <span class="pull-right" ><a href="xm.php">历史报表</a></span></h3>
			  </div>

			  <div class="panel-body">
			    <div role="tabpanel">
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs nav-tile" role="tablist">
				    <li ><a href="tzjl.php?ac=ty">体育单式</a></li>
				    <li><a href="tzjl_cg.php">体育串关</a></li>
				    <li class="active"><a href="tzjl_cp.php">彩票游戏</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active">
				    	<div class="table-responsive">
						  <table class="table table-bordered">
						    <tr class="success">
							  <td class="zd_item_header">时间/单号</td>
							  <td class="zd_item_header">投注详细</td>
							  <td class="zd_item_header">金额</td>
							</tr>
							<?php
							$sql	=	"select * from c_bet where js=0 and uid=$uid order by addtime desc";
	$query	=	$mysqli->query($sql);
	$sum	=	$mysqli->affected_rows; //总页数
	$thisPage	=	1;
	if(@$_GET['page']){
		$thisPage	=	$_GET['page'];
	}
	$page		=	new newPage();
	$perpage	= 	10;
	$thisPage	=	$page->check_Page($thisPage,$sum,$perpage);

	$id		=	'';
	$i		=	1; //记录 uid 数
	$start	=	($thisPage-1)*$perpage+1;
	$end	=	$thisPage*$perpage;
	while($row = $query->fetch_array()){
		if($i >= $start && $i <= $end){
			$id .=	$row['id'].',';
		}
		if($i > $end) break;
		$i++;
	}
							if(!$id){
							?>	
							<tr align="center" bgcolor="#FFFFFF">
						    <td colspan="3" valign="middle" bgcolor="#FFFFFF"><p class="bg-danger">暂无记录</p></td>
						    </tr>
							<?php
							}else{
		$id		=	rtrim($id,',');
		$sql	=	"select * from c_bet where id in($id) order by id desc";
		$query	=	$mysqli->query($sql);
		$i		=	1;
		while($rows = $query->fetch_array()){
			$money+=$rows["money"];
			$ky+=$rows["win"];
			if(($i%2)==0) $bgcolor="#FFFFFF";
			else $bgcolor="#F5F5F5";
			$i++;
							?>
						    <tr bgcolor="<?=$bgcolor?>" align="center" onMouseOver="this.style.backgroundColor='#FFFFCC'" onMouseOut="this.style.backgroundColor='<?=$bgcolor?>'" style="height:60px;" >
							  <td>
							  <span style="color:#46AF98"><?=$rows["addtime"]?></span><br><span style="color:#0DC4FF"><?=$rows['type']?></span><br>第<span style="color:#F30"><?=$rows["qishu"]?></span>期<br><span style="color:#F90"><?=$rows["id"]?></span>
							  </td>
							  
							  
							  <td valign="middle"><? if($rows['type']=='香港六合彩'){?><?=$rows["mingxi_1"]?><br><font color="#FF0000"><?=$rows["mingxi_2"]?></font>@ <font color="#FF0000"><?=$rows["odds"]?></font><? }else{?><?=$rows["mingxi_1"]?>【<font color="#FF0000"><?=$rows["mingxi_2"]?></font>】 @ <font color="#FF0000"><?=$rows["odds"]?></font><? }?></td>
							  <td ><span style="color:#46AF98">下注:</span><br><?=$rows["money"]?><br><span style="color:#0DC4FF">可赢:</span><br><?php
		  echo double_format($rows["win"]+$rows["fs"]);
	?></td>
						      </tr>
						    <?
		unset($score);
		}
	}
	?>
						  </table>
                          <div class="panel-footer">  	
  	<ul class="pagination"><?=$page->get_htmlPage($_SERVER["REQUEST_URI"]);?> <li><a href="javascript:;">总投注金额：<span style="color:#FF0000"><?=@$money?></span>，最高可赢金额：<span style="color:#FF0000"><?=double_format(@$ky)?></span></a></li></ul>
  </div>
						</div>
				    </div>
				  </div>

				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" language="javascript" src="/js/left_mouse.js"></script>
</body>
</html>