<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
include($_SERVER['DOCUMENT_ROOT'] . "/include/lottery.inc.php");
require ("curl_http.php");

$curl = new Curl_HTTP_Client();
$curl->set_referrer("http://www.1680180.com/lottery/10041.html");
$curl->set_user_agent("Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.3.4000 Chrome/30.0.1599.101");
$html_data = $curl->fetch_url("http://www.1680180.com/Open/CurrentOpen?code=10041");
$arr= json_decode($html_data, true);

$rf_time = rand(10, 20);
if($arr['l_r']) {
    $qihao = $arr['l_t'];
    $time = $arr['l_d'];
    if(strlen($qihao) > 0) {
        $n_time = strtotime($arr['n_d']) - $lottery_time + $rf_time;
        if($n_time >= 0) {
            $rf_time = $n_time;
        }
        $hm = explode(',', $arr['l_r']);
        $ball_1 = ($hm[1] + $hm[4] + $hm[7] + $hm[10] + $hm[13] + $hm[16]) % 10;
        $ball_2 = ($hm[2] + $hm[5] + $hm[8] + $hm[11] + $hm[14] + $hm[17]) % 10;
        $ball_3 = ($hm[3] + $hm[6] + $hm[9] + $hm[12] + $hm[15] + $hm[18]) % 10;
        $ball_4 = $ball_1 + $ball_2 + $ball_3;
        //开始加拿大28写入号码
        $sql = "select id from c_auto_13 where qishu='" . $qihao . "'";
        $t_query = $mysqli->query($sql);
        $t_cou = $mysqli->affected_rows;
        if($t_cou == 0){
            $sql = "insert into c_auto_13(qishu,datetime,ball_1,ball_2,ball_3,ball_4) values ('$qihao','$time','$ball_1','$ball_2','$ball_3','$ball_4')";
            $mysqli->query($sql);
        }
    }
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <style type="text/css">
    body,td,th {font-size: 12px}
    body {margin: 0}
    </style>
</head>
<body>
    <script type="text/javascript">
        var limit = "<?=$rf_time?>";
        if(document.images) {
            var parselimit = limit;
        }
        function beginrefresh() {
            if(!document.images) {
                return;
            }
            if(parselimit == 0) {
                window.location.reload();
            } else {
                parselimit -= 1;
                document.getElementById("timeInfo").innerText = parselimit + "秒后自动获取!";
                setTimeout("beginrefresh()", 1000);
            }
        }
        window.onload = beginrefresh;
    </script>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left">
            <input type=button name=button value="刷新" onClick="window.location.reload()"><br>
            加拿大28<br>(<?=$qihao?>期:<?="$ball_1+$ball_2+$ball_3=$ball_4"?>)<br>
            <span id="timeInfo"></span>
        </td>
      </tr>
    </table>
    <iframe src="Js_13.php?qi=<?=$qihao?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>