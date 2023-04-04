<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("Auto_Class4.php");
$qi 		= floatval($_REQUEST['qi']);
//获取开奖号码
$sql		= "select * from c_auto_8 where ok=0 ";
$query		= $mysqli->query($sql);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm 		= array();
$hm[]		= $rs['ball_1'];
$hm[]		= $rs['ball_2'];
$hm[]		= $rs['ball_3'];
$hm[]		= $rs['ball_4'];
$hm[]		= $rs['ball_5'];
$hm[]		= $rs['ball_6'];
$hm[]		= $rs['ball_7'];
$hm[]		= $rs['ball_8'];
$hm[]		= $rs['ball_9'];
$hm[]		= $rs['ball_10'];
//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='幸运飞艇' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	//开始结算冠军
	if($rows['mingxi_1']=='冠军'){
		$ds = Bjsc_Ds($rs['ball_1']);
		$dx = Bjsc_Dx($rs['ball_1']);
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于冠军开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算亚军
	if($rows['mingxi_1']=='亚军'){
		$ds = Bjsc_Ds($rs['ball_2']);
		$dx = Bjsc_Dx($rs['ball_2']);
		if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于亚军开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第三名
	if($rows['mingxi_1']=='第三名'){
		$ds = Bjsc_Ds($rs['ball_3']);
		$dx = Bjsc_Dx($rs['ball_3']);
		if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第三名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第四名
	if($rows['mingxi_1']=='第四名'){
		$ds = Bjsc_Ds($rs['ball_4']);
		$dx = Bjsc_Dx($rs['ball_4']);
		if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第四名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算第五名
	if($rows['mingxi_1']=='第五名'){
		$ds = Bjsc_Ds($rs['ball_5']);
		$dx = Bjsc_Dx($rs['ball_5']);
		if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第五名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第六名
	if($rows['mingxi_1']=='第六名'){
		$ds = Bjsc_Ds($rs['ball_6']);
		$dx = Bjsc_Dx($rs['ball_6']);
		if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第六名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第七名
	if($rows['mingxi_1']=='第七名'){
		$ds = Bjsc_Ds($rs['ball_7']);
		$dx = Bjsc_Dx($rs['ball_7']);
		if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第七名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第八名
	if($rows['mingxi_1']=='第八名'){
		$ds = Bjsc_Ds($rs['ball_8']);
		$dx = Bjsc_Dx($rs['ball_8']);
		if($rows['mingxi_2']==$rs['ball_8'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第八名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第九名
	if($rows['mingxi_1']=='第九名'){
		$ds = Bjsc_Ds($rs['ball_9']);
		$dx = Bjsc_Dx($rs['ball_9']);
		if($rows['mingxi_2']==$rs['ball_9'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第九名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第十名
	if($rows['mingxi_1']=='第十名'){
		$ds = Bjsc_Ds($rs['ball_10']);
		$dx = Bjsc_Dx($rs['ball_10']);
		if($rows['mingxi_2']==$rs['ball_10'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第十名开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算冠、亚军和
	if($rows['mingxi_1']=='冠、亚军和' && $rows['mingxi_2']>=3 && $rows['mingxi_2']<=19){
		$zonghe = Bjsc_Auto($hm,1);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算冠、亚军和大小
	if($rows['mingxi_2']=='冠亚大' || $rows['mingxi_2']=='冠亚小'){
		$zonghe = Bjsc_Auto($hm,2);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算冠、亚军和单双
	if($rows['mingxi_2']=='冠亚双' || $rows['mingxi_2']=='冠亚单'){
		$zonghe = Bjsc_Auto($hm,3);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算1V10 龙虎
	if($rows['mingxi_1']=='1V10 龙虎'){
		$longhu = Bjsc_Auto($hm,4);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算2V9 龙虎
	if($rows['mingxi_1']=='2V9 龙虎'){
		$longhu = Bjsc_Auto($hm,5);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算3V8 龙虎
	if($rows['mingxi_1']=='3V8 龙虎'){
		$longhu = Bjsc_Auto($hm,6);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算4V7 龙虎
	if($rows['mingxi_1']=='4V7 龙虎'){
		$longhu = Bjsc_Auto($hm,7);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算5V6 龙虎
	if($rows['mingxi_1']=='5V6 龙虎'){
		$longhu = Bjsc_Auto($hm,8);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    
    //
    //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$rs['ball_1'].",".$rs['ball_2'].",".$rs['ball_3'].",".$rs['ball_4'].",".$rs['ball_5'].",".$rs['ball_6'].",".$rs['ball_7'].",".$rs['ball_8'].",".$rs['ball_9'].",".$rs['ball_10']."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
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
$msql="update c_auto_8 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
if ($_GET['t']==1)    {
echo "<script>window.location.href='../../Lottery/auto_4.php';</script>";
}
}
?>