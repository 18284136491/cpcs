<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../../include/http.class.php");
include ("../include/lottery_time.php");

//开始读取赔率
$sql = "select * from c_odds_13 order by id asc";
$query = $mysqli->query($sql);
$list = array();
$s = 1;
while ($odds = $query->fetch_array()) {
    for ($i = 1; $i < 29; $i++) {
        $list['ball'][$s][$i] = $odds['h' . $i];
    }
    $s++;
}

//开始读取期数
$curl = new Curl_HTTP_Client();

$curl->set_referrer("http://www.1680180.com/lottery/10041.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=10041");
$arr= json_decode($html_data, true);
if(empty($arr['n_t']) || empty($arr['n_d'])) {
	$html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=10041");
	$arr= json_decode($html_data, true);
}
$qishu = $arr['n_t'];
$kaijiang = strtotime($arr['n_d']) - $lottery_time;
$fengpan  = $kaijiang - 60;

$arr = array(
    'number' => $qishu,
    'endtime' => $fengpan,
    'opentime' => $kaijiang,
    'oddslist' => $list,
);
$json_string = json_encode($arr);
echo $json_string;