<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("auto_class.php");
//获取开奖号码
$sql		= "select * from c_auto_6 where ok=0";
$query		= $mysqli->query($sql);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='江苏快3' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	
	$dianshu = $hm[0]+$hm[1]+$hm[2];
	//开始结算点数
	if($rows['mingxi_1']=='点数'){
		
		
		
		if($rows['mingxi_2']==$dianshu){
			//如果投注内容等于点数，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算双面
	if($rows['mingxi_1']=='双面'){
		$ds = $dx = '';
		
		if($dianshu>=4 && $dianshu <= 10){
			$dx = '点数小';
		}
		if($dianshu>=11 && $dianshu <= 17){
			$dx =  '点数大';
		}
		
		//点数单双
		if($dianshu%2==0){
			$ds = '点数双';
		}else{
			$ds = '点数单';
		}
		
		
		if($rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){

			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算三军
	if($rows['mingxi_1']=='三军'){
		
		if(in_array(intval($rows['mingxi_2']), $hm)){
			//如果投注内容存在于开奖号码中，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算围骰
	if($rows['mingxi_1']=='围骰'){
		
		$ws = "0".$hm[0]."0".$m[1]."0".$m[2];
		
		if($rows['mingxi_2']==$ws){
			
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算长牌
	if($rows['mingxi_1']=='长牌'){
		
		$tmphm = $hm;
		sort($tmphm);
		
		$cp1 = "0".$tmphm[0]."0".$tmphm[1];
		$cp2 = "0".$tmphm[1]."0".$tmphm[2];
		$cp3 = "0".$tmphm[0]."0".$tmphm[2];
		
		if($rows['mingxi_2']==$cp1 || $rows['mingxi_2']==$cp2 || $rows['mingxi_2']==$cp3){
			
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	
	//开始结算短牌
	if($rows['mingxi_1']=='短牌'){
		
		$tmphm = $hm;
		sort($tmphm);
		
		$cp1 = "0".$tmphm[0]."0".$tmphm[1];
		$cp2 = "0".$tmphm[1]."0".$tmphm[2];
		$cp3 = "0".$tmphm[0]."0".$tmphm[2];
		
		if($rows['mingxi_2']==$cp1 || $rows['mingxi_2']==$cp2 || $rows['mingxi_2']==$cp3){
			
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//==============返水开始============
	$sql_f	=	"select cpfsbl from k_group left join k_user ON k_group.id=k_user.gid where k_user.uid='".$rows['uid']."' limit 1";
	$query_f	=	$mysqli->query($sql_f);
	$rows_f	=	$query_f->fetch_array();
	$cpfsbl=$rows_f["cpfsbl"];//反水比例
	if(!is_numeric($cpfsbl))$cpfsbl=0;
	$fs=$rows['money']*$cpfsbl;
	$sql	=	"update k_user set money=money+$fs where uid='".$rows['uid']."' limit 1";
	$query	=	$mysqli->query($sql);
	$msql="update c_bet set fs='$fs' where id='".$rows['id']."'";
	$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
	//==============返水结束============
}
$msql="update c_auto_6 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
if ($_GET['t']==1)    {
echo "<script>window.location.href='../../Lottery/auto_6.php';</script>";
}
}
?>