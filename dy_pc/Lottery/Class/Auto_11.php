<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/auto_fun.php");
include ("../include/auto_class3.php");
include ("../include/lottery_time.php");

$uid = $_SESSION['uid'];
$ball = intval($_REQUEST['ball']);
$xync = array('单', '双', '大', '小', '尾大', '尾小', '合数单', '合数双');
$xync_a = array('龙', '虎', '总和大', '总和小', '总和单', '总和双', '总和尾大', '总和尾小');

//用户输赢
$sql = "select round(SUM(money), 2) as yk from c_bet where type='幸运农场' and uid='$uid'";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(win), 2) as yk from c_bet where type='幸运农场' and uid='$uid' and win >= 0";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk'];
$sy = round($z_win - $z_money, 2);

if($ssc_time >= '00:00:00' && $ssc_time <= '02:10:00') {
    $s_time = $lottery_ssc_time - 3600 * 24;
    $e_time = $lottery_ssc_time;
} else {
    $s_time = $lottery_ssc_time;
    $e_time = $lottery_ssc_time + 3600 * 24;
}
$startDate = date('Y-m-d', $s_time) . ' 09:50';
$endDate = date('Y-m-d', $e_time) . ' 02:10';
$date = "datetime > '$startDate' and datetime < '$endDate'";
$sql = "select ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8 from c_auto_11 where $date and ok=1 order by id asc";
$query = $mysqli->query($sql);
$history = array();
while($row = $query->fetch_row()) {
    $history[] = $row;
}
$tj = null;
//路珠
if($ball >= 1 && $ball <= 8) {
    $qiu = $ball - 1;
    $tj = sum_ball_count($history, $qiu); //统计
    $luzhu[] = sum_str_s($history, $qiu); //第1-8号球-号码
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 3); //第1-8号球-大小
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 1); //第1-8号球-单双
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 5, NULL, 0); //第1-8号球-尾数大小
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 7, NULL, 0); //第1-8号球-合数单双
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 8); //第1-8号球-方位
    $luzhu[] = sum_str_s($history, $qiu, 25, false, 9); //第1-8号球-中发白
}
$luzhu[] = sum_str_s($history, null, 25, false, false, 2, 0); //总和大小
$luzhu[] = sum_str_s($history, null, 25, false, false, 4, 0); //总和单双
$luzhu[] = sum_str_s($history, null, 25, false, false, 6, 0); //总和尾数大小
$luzhu[] = sum_str_s($history, null, 25, true); //龙虎
//长龙
$cl_arr = sum_ball_count_1($xync, $xync_a, $history, 2);

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8 from c_auto_11 where ok=1 order by id desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list,
    'tongji' => $tj,
    'luzhu' => $luzhu,
    'cl_list' => $cl_arr
);
echo json_encode($result);