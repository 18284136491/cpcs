<?php
session_start();

header('Content-type: text/json; charset=utf-8');
include_once("include/config.php");
$uid		= @$_SESSION["uid"];
$callback	= $_GET['callback'];

	include_once("include/mysqli.php");
	include_once("include/mysqlis.php");
	include_once("common/logintu.php");
	
	$md		=	date("m-d");

	//sessionNum($uid,4,$callback);
	
	$zq		=	$zq_ds		=	$zq_gq		=	$zq_sbc		=	$zq_sbbd	=	$zq_bd		=	$zq_rqs		=	$zq_bqc	=	$zq_jg	=	0; //足球
	$zqzc	=	$zqzc_ds	=	$zqzc_sbc	=	$zqzc_sbbd	=	$zqzc_bd	=	$zqzc_rqs	=	$zqzc_bqc	=0	; //足球早餐
	$lm		=	$lm_ds		=	$lm_dj		=	$lm_gq		=	$lm_jg		=	0; //篮美
	$lmzc	=	$lmzc_ds	=	$lmzc_dj	=	0; //篮美早餐
	$wq		=	$wq_ds		=	$wq_bd		=	$wq_jg		=	0; //网球
	$pq		=	$pq_ds		=	$pq_bd		=	$pq_jg		=	0; //排球
	$bq		=	$bq_ds		=	$bq_zdf		=	$bq_jg		=	0; //棒球
	$jr		=	$jr_jr		=	$jr_jg		=	0; //金融
	$gj		=	$gj_gj		=	$gj_jg		=	0; //冠军
	$tz_money=	$user_num	=	$user_money	=	0; //投注
	
	//足球-单式
	$sql	=	"SELECT count(*) as s FROM Bet_Match  WHERE Match_Type=1 AND Match_CoverDate>now() AND Match_Date='$md' and Match_HalfId is not null";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_ds	=	$rs['s'];
	
	//足球-滚球
	include_once("cache/zqgq.php");
	if(time()-$lasttime > 3) $zq_gq = 0;
	else{
		$zq_gq = count($zqgq);
	}
	
	//足球-上半场
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_Type=1 and match_date='$md' AND Match_CoverDate>now() and (Match_BHo+Match_BAo<>0 or Match_Bdpl+Match_Bxpl<>0) and Match_IsShowb=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_sbc	=	$rs['s'];
	
	//足球-上半波胆
	$sql	=	"SELECT count(*) as s FROM Bet_Match where match_date='$md' and  Match_CoverDate>now() and Match_Hr_Bd10>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_sbbd=	$rs['s'];
	
	//足球-波胆
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_Type=1 and Match_IsShowbd=1 and  Match_CoverDate>now() and Match_Bd21>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_bd	=	$rs['s'];
	
	//足球-入球数
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_Type=1 and Match_IsShowt=1 and Match_Total01Pl>0 AND Match_CoverDate>now()";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_rqs	=	$rs['s'];
	
	//足球-半全场
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_CoverDate>now() and Match_BqMM>0 and Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_bqc	=	$rs['s'];
	
	//足球-结果
	$sql	=	"SELECT count(*) as s FROM Bet_Match where match_Date='$md' and (MB_Inball is not null or MB_Inball_HR is not NULL) and (match_js=1 or match_sbjs=1)";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zq_jg	=	$rs['s'];
	
	$zq		=	$zq_ds+$zq_gq+$zq_sbc+$zq_sbbd+$zq_bd+$zq_rqs+$zq_bqc+$zq_jg; //足球
	
	
	//足球早餐-单式
	$sql	=	"SELECT count(*) as s FROM Bet_Match WHERE Match_Type=0 AND Match_CoverDate>now()";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_ds=	$rs['s'];
	
	//足球早餐-上半场
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_CoverDate>now() and match_date!='$md' and (Match_BHo+Match_BAo<>0 or Match_Bdpl+Match_Bxpl<>0) and Match_IsShowb=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_sbc=	$rs['s'];
	
	//足球早餐-上半波胆 
	$sql	=	"SELECT count(*) as s FROM Bet_Match where match_date!='$md' and Match_CoverDate>now() and Match_Hr_Bd10>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_sbbd=	$rs['s'];
	
	//足球早餐-波胆
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_Type=0 and Match_IsShowbd=1 and   Match_CoverDate>now() and Match_Bd21>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_bd=	$rs['s'];
	
	//足球早餐-入球数
	$sql	=	"SELECT count(*) as s FROM Bet_Match where Match_Type=0 and Match_IsShowt=1 AND Match_CoverDate>now() and Match_Total01Pl>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_rqs=	$rs['s'];
	
	//足球早餐-半全场
	$sql	=	"SELECT count(*) as s FROM Bet_Match WHERE Match_Date<>'$md' and Match_CoverDate>now() and Match_BqMM>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$zqzc_bqc=	$rs['s'];
	
	$zqzc	=	$zqzc_ds+$zqzc_sbc+$zqzc_sbbd+$zqzc_bd+$zqzc_rqs+$zqzc_bqc; //足球早餐
	
	
	//篮美-所有
	$sql	=	"SELECT count(*) as s FROM lq_match WHERE Match_CoverDate>now() AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$lm_ds	=	$rs['s'];
	
	//篮美-单节
	$sql	=	"SELECT count(*) as s FROM lq_match WHERE Match_Type=3 AND Match_CoverDate>=now() AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$lm_dj	=	$rs['s'];
	
	//篮美-结果
	$sql	=	"SELECT count(*) as s FROM lq_match WHERE MB_Inball_OK is not null and  match_Date='$md' and match_js=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$lm_jg	=	$rs['s'];
	
	//篮美-滚球
	include_once("cache/lqgq.php");
	if(time()-$lasttime > 3) $lm_gq = 0;
	else{
		$lm_gq	=	count($lqgq);
	}
	
	$lm		=	$lm_ds+$lm_gq+$lm_jg; //篮美
	
	
	//篮美早餐-所有
	$sql	=	"SELECT count(*) as s FROM lq_match WHERE Match_CoverDate>now() AND Match_Date<>'$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$lmzc_ds=	$rs['s'];
	
	//篮美早餐-单节
	$sql	=	"SELECT count(*) as s FROM lq_match WHERE Match_Type=3 AND Match_CoverDate>now() AND Match_Date<>'$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$$lmzc_dj=	$rs['s'];
	
	$lmzc	=	$lmzc_ds; //篮美早餐
	
	
	//网球-单式
	$sql	=	"SELECT count(*) as s FROM tennis_match WHERE Match_Type=1 AND Match_CoverDate>now() AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$wq_ds	=	$rs['s'];
	
	//网球-波胆
	$sql	=	"SELECT count(*) as s FROM tennis_match where Match_Type=10 and Match_CoverDate>now() and Match_Bd21>0";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$wq_bd	=	$rs['s'];
	
	//网球-结果
	$sql	=	"SELECT count(*) as s FROM tennis_match where MB_Inball is not null and  match_Date='$md' and match_js=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$wq_jg	=	$rs['s'];
	
	$wq		=	$wq_ds+$wq_bd+$wq_jg; //网球
	
	
	//排球-单式 
	$sql	=	"SELECT count(*) as s FROM  volleyball_match WHERE Match_Type=1 AND Match_CoverDate>now() AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$pq_ds	=	$rs['s'];
	
	//排球-波胆 
	$sql	=	"SELECT count(*) as s FROM volleyball_match where Match_Type=10 and Match_CoverDate>now()";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$pq_bd	=	$rs['s'];
	
	//排球-结果
	$sql	=	"SELECT count(*) as s FROM volleyball_match where MB_Inball is not null and  match_Date='$md' and match_js=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$pq_jg	=	$rs['s'];
	
	$pq		=	$pq_ds+$pq_bd+$pq_jg; //排球
	
	
	//棒球-单式 
	$sql	=	"SELECT count(*) as s FROM baseball_match WHERE Match_Type=1 AND Match_CoverDate>now() 
	AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$bq_ds	=	$rs['s'];
	
	//棒球-总得分 
	$sql	=	"SELECT count(*) as s FROM baseball_match WHERE Match_Type=1 AND Match_CoverDate>now() and Match_BzM>0 AND Match_Date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$bq_zdf	=	$rs['s'];
	
	//棒球-结果 
	$sql	=	"SELECT count(*) as s FROM baseball_match WHERE MB_Inball is not null and  match_Date='$md' and match_js=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$bq_jg	=	$rs['s'];
	
	$bq		=	$bq_ds+$bq_zdf+$bq_jg; //棒球
	
	
	//冠军-冠军 
	$sql	=	"SELECT count(*) as s FROM t_guanjun WHERE Match_CoverDate>now() and x_result is null and match_type=1";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$gj_gj	=	$rs['s'];
	
	//冠军-冠军结果 
	$sql	=	"SELECT count(*) as s FROM t_guanjun where x_result is not null and match_type=1 and match_date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$gj_jg	=	$rs['s'];
	
	$gj		=	$gj_gj+$gj_jg; //冠军
	
	
	//金融-金融
	$sql	=	"SELECT count(*) as s FROM t_guanjun WHERE Match_CoverDate>now() and x_result is null and match_type=2";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$jr_jr	=	$rs['s'];
	
	//金融-金融结果 
	$sql	=	"SELECT count(*) as s FROM t_guanjun where x_result is not null and match_type=2 and match_date='$md'";
	$query	=	$mysqlis->query($sql);
	$rs		=	$query->fetch_array();
	$jr_jg	=	$rs['s'];
	
	$jr		=	$jr_jr+$jr_jg; //金融
	
	
	//投注金额 
	if($uid && $uid>0){ //已登陆
		$sql		=	"SELECT sum(bet_money) as s FROM `k_bet` where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	=	$rs['s'];
		
		$sql		=	"select sum(bet_money) as s from k_bet_cg_group where uid=$uid and status=0";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$tz_money	+=	$rs['s'];
		
		$sql		=	"select count(*) as s from k_user_msg where uid=$uid and islook=0"; //未查看消息
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_num	=	$rs['s'];
		
		$sql		=	"select money as s,jifen from k_user where uid=$uid limit 1";
		$query		=	$mysqli->query($sql);
		$rs			=	$query->fetch_array();
		$user_money	=	sprintf("%.2f",$rs['s']);
		$jifen	=	$rs['jifen'];
	}
	unset($mysqlis);
	
	$json['zq']				= $zq;
	$json['zq_ds']			= $zq_ds;
	$json['zq_gq']			= $zq_gq;
	$json['zq_sbc']			= $zq_sbc;
	$json['zq_sbbd']		= $zq_sbbd;
	$json['zq_bd']			= $zq_bd;
	$json['zq_rqs']			= $zq_rqs;
	$json['zq_bqc']			= $zq_bqc;
	$json['zq_jg']			= $zq_jg;
	$json['zqzc']			= $zqzc;
	$json['zqzc_ds']		= $zqzc_ds;
	$json['zqzc_sbc']		= $zqzc_sbc;
	$json['zqzc_sbbd']		= $zqzc_sbbd;
	$json['zqzc_bd']		= $zqzc_bd;
	$json['zqzc_rqs']		= $zqzc_rqs;
	$json['zqzc_bqc']		= $zqzc_bqc;
	$json['lm']				= $lm;
	$json['lm_ds']			= $lm_ds;
	$json['lm_dj']			= $lm_dj;
	$json['lm_gq']			= $lm_gq;
	$json['lm_jg']			= $lm_jg;
	$json['lmzc']			= $lmzc;
	$json['lmzc_ds']		= $lmzc_ds;
	$json['lmzc_dj']		= $lmzc_dj;
	$json['wq']				= $wq;
	$json['wq_ds']			= $wq_ds;
	$json['wq_bd']			= $wq_bd;
	$json['wq_jg']			= $wq_jg;
	$json['pq']				= $pq;
	$json['pq_ds']			= $pq_ds;
	$json['pq_bd']			= $pq_bd;
	$json['pq_jg']			= $pq_jg;
	$json['bq']				= $bq;
	$json['bq_ds']			= $bq_ds;
	$json['bq_zdf']			= $bq_zdf;
	$json['bq_jg']			= $bq_jg;
	$json['gj']				= $gj;
	$json['gj_gj']			= $gj_gj;
	$json['gj_jg']			= $gj_jg;
	$json['jr']				= $jr;
	$json['jr_jr']			= $jr_jr;
	$json['jr_jg']			= $jr_jg;
	$json['tz_money']		= $tz_money." RMB";
	$json['user_money']		= $user_money." RMB";
	$json['jifen']		= $jifen;
	$json['user_num']		= $user_num;

echo $callback."(".json_encode($json).");";
exit;
?>