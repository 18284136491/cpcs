<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include ("Auto_Class3.php");
$qi 		= floatval($_REQUEST['qi']);
//获取开奖号码
$sql		= "select * from c_auto_3 where ok=0 ";
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
//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='广东快乐10分' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	//开始结算第一球
	if($rows['mingxi_1']=='第一球'){
		$ds = Klsf_Ds($rs['ball_1']);
		$dx = Klsf_Dx($rs['ball_1']);
		$wdx = Klsf_Wdx($rs['ball_1']);
		$hds = Klsf_Hdx($rs['ball_1']);
		$zfb = Klsf_Zfb($rs['ball_1']);
		$dnxb = Klsf_Dnxb($rs['ball_1']);
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算第二球
	if($rows['mingxi_1']=='第二球'){
		$ds = Klsf_Ds($rs['ball_2']);
		$dx = Klsf_Dx($rs['ball_2']);
		$wdx = Klsf_Wdx($rs['ball_2']);
		$hds = Klsf_Hdx($rs['ball_2']);
		$zfb = Klsf_Zfb($rs['ball_2']);
		$dnxb = Klsf_Dnxb($rs['ball_2']);
		if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算第三球
	if($rows['mingxi_1']=='第三球'){
		$ds = Klsf_Ds($rs['ball_3']);
		$dx = Klsf_Dx($rs['ball_3']);
		$wdx = Klsf_Wdx($rs['ball_3']);
		$hds = Klsf_Hdx($rs['ball_3']);
		$zfb = Klsf_Zfb($rs['ball_3']);
		$dnxb = Klsf_Dnxb($rs['ball_3']);
		if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算第四球
	if($rows['mingxi_1']=='第四球'){
		$ds = Klsf_Ds($rs['ball_4']);
		$dx = Klsf_Dx($rs['ball_4']);
		$wdx = Klsf_Wdx($rs['ball_4']);
		$hds = Klsf_Hdx($rs['ball_4']);
		$zfb = Klsf_Zfb($rs['ball_4']);
		$dnxb = Klsf_Dnxb($rs['ball_4']);
		if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算第五球
	if($rows['mingxi_1']=='第五球'){
		$ds = Klsf_Ds($rs['ball_5']);
		$dx = Klsf_Dx($rs['ball_5']);
		$wdx = Klsf_Wdx($rs['ball_5']);
		$hds = Klsf_Hdx($rs['ball_5']);
		$zfb = Klsf_Zfb($rs['ball_5']);
		$dnxb = Klsf_Dnxb($rs['ball_5']);
		if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
    //开始结算第六球
	if($rows['mingxi_1']=='第六球'){
		$ds = Klsf_Ds($rs['ball_6']);
		$dx = Klsf_Dx($rs['ball_6']);
		$wdx = Klsf_Wdx($rs['ball_6']);
		$hds = Klsf_Hdx($rs['ball_6']);
		$zfb = Klsf_Zfb($rs['ball_6']);
		$dnxb = Klsf_Dnxb($rs['ball_6']);
		if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
    //开始结算第七球
	if($rows['mingxi_1']=='第七球'){
		$ds = Klsf_Ds($rs['ball_7']);
		$dx = Klsf_Dx($rs['ball_7']);
		$wdx = Klsf_Wdx($rs['ball_7']);
		$hds = Klsf_Hdx($rs['ball_7']);
		$zfb = Klsf_Zfb($rs['ball_7']);
		$dnxb = Klsf_Dnxb($rs['ball_7']);
		if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
    //开始结算第八球
	if($rows['mingxi_1']=='第八球'){
		$ds = Klsf_Ds($rs['ball_8']);
		$dx = Klsf_Dx($rs['ball_8']);
		$wdx = Klsf_Wdx($rs['ball_8']);
		$hds = Klsf_Hdx($rs['ball_8']);
		$zfb = Klsf_Zfb($rs['ball_8']);
		$dnxb = Klsf_Dnxb($rs['ball_8']);
		if($rows['mingxi_2']==$rs['ball_8'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx || $rows['mingxi_2']==$wdx || $rows['mingxi_2']==$hds || $rows['mingxi_2']==$zfb || $rows['mingxi_2']==$dnxb){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算总和大小
	if($rows['mingxi_2']=='总和大' || $rows['mingxi_2']=='总和小'){
		$zonghe = Klsf_Auto($hm,2);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else if($zonghe=='总和和'){
            //和视为不中奖，但退本金
			$msql="update c_bet set win=0,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
            //和退本金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
        }else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算总和单双
	if($rows['mingxi_2']=='总和单' || $rows['mingxi_2']=='总和双'){
		$zonghe = Klsf_Auto($hm,3);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算总和尾大小
	if($rows['mingxi_2']=='总和尾大' || $rows['mingxi_2']=='总和尾小'){
		$zonghe = Klsf_Auto($hm,4);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
	//开始结算龙虎
	if($rows['mingxi_2']=='龙' || $rows['mingxi_2']=='虎'){
		$longhu = Klsf_Auto($hm,5);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于第一球开奖号码，则视为中奖
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
    $msql="update c_bet set jieguo='".$rs['ball_1'].",".$rs['ball_2'].",".$rs['ball_3'].",".$rs['ball_4'].",".$rs['ball_5'].",".$rs['ball_6'].",".$rs['ball_7'].",".$rs['ball_8']."' where id=".$rows['id']."";
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
$msql="update c_auto_3 set ok=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");
if ($_GET['t']==1)    {
echo "<script>window.location.href='../../Lottery/auto_3.php';</script>";
}
}
?>