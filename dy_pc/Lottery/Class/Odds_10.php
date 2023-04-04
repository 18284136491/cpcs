<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
//开始读取赔率
$sql		= "select * from c_odds_10 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<15; $i++){
			$list['ball'][$s][$i] = $odds['h'.$i];
		}
	$s++;
}

//开始读取期数
$sql		= "select * from c_opentime_10 where qishu=1 order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
if($qs){
	if(date('H',$lottery_time)>20){$day=strtotime('+1 day',$lottery_time);}
	else $day=$lottery_time;
	$l_date=date("Y-m-d",$day);
	$pk10_date = '2016-03-26';
	$pk10_qi = 79;
	$holidays =array("4月5日","4月6日","4月7日","5月1日","5月2日","5月3日","5月31日","6月1日","6月2日","9月6日","9月7日","9月8日");
	$pk10_t = (strtotime($l_date)-strtotime($pk10_date))/86400;
	$pk10_t = $pk10_t+$pk10_qi;
	$pk10_t = $pk10_t > 100?$pk10_t:"0".$pk10_t;
	$qishu = date("y",$lottery_time).$pk10_t;
	$fengpan	= strtotime(date("Y-m-d",$day).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$day).' '.$qs['kaijiang'])-$lottery_time;
}else{
	$qishu		= -1;
	$fengpan	= -1;
	$kaijiang	= -1;
}
$arr = array(   
    'number' => $qishu, 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,
	'oddslist' => $list
);  
$json_string = json_encode($arr);   
echo $json_string; 
?> 