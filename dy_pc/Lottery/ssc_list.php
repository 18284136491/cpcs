<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../include/lottery.inc.php");
include ("include/auto_class.php");
include ("include/order_info.php");

$type = is_numeric($_GET['type']) ? $_GET['type'] : 2;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
switch($type) {
    case 2:
        $g_t = 0;
        break;
    case 7:
        $g_t = 1;
        break;
    case 14:
        $g_t = 2;
        break;
}
if($_REQUEST['page'] == '') {
    $_REQUEST['page'] = 1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?=$game_name?>开奖结果</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="css/ssc.css"/>
</head>
<body>
    <div class="kj_jl">
        <?php include_once('list_type.php') ?>
        <table cellspacing="0" cellpadding="0" border="0" class="tb_list">
            <tr class="tit">
                <td width="100">期数</td>
                <td width="100">开奖时间</td>
                <td colspan="5">开出号码</td>
                <td colspan="3">总和</td>
                <td>龙虎</td>
                <td>前三</td>
                <td>中三</td>
                <td>后三</td>
            </tr>
            <?php
                $date = date('Y-m-d', $lottery_time - 6 * 24 * 3600) . ' 00:00:00';
                $sql = "select id from c_auto_$type where datetime>='$date' order by qishu desc";
                $query = $mysqli->query($sql);
                $sum = $mysqli->affected_rows;
                $pagenum = 15;
                $CurrentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $myPage = new pager($sum, intval($CurrentPage), $pagenum);
                $pageStr = $myPage->GetPagerContent();
                $id = '';
                $i = 1;
                $start = ($CurrentPage - 1) * $pagenum + 1;
                $end = $CurrentPage * $pagenum;
                while($row = $query->fetch_array()) {
                    if($i >= $start && $i <= $end) {
                        $id .= $row['id'] . ',';
                    }
                    if($i > $end) break;
                    $i++;
                }
                if($id) {
                    $id	= rtrim($id, ',');
                    $sql = "select * from c_auto_$type where id in($id) order by qishu desc";
                    $query = $mysqli->query($sql);
                    while($row = $query->fetch_array()) {
                        $hm = array();
                        $hm[] = $row['ball_1'];
                        $hm[] = $row['ball_2'];
                        $hm[] = $row['ball_3'];
                        $hm[] = $row['ball_4'];
                        $hm[] = $row['ball_5'];
            ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_4']?>"></em></td>
                            <td class="ssc" width="50"><em class="n_<?=$row['ball_5']?>"></em></td>
                            <td width="50"><?=Ssc_Auto($hm,1)?></td>
                            <td<?=Ssc_Auto($hm,2) == '大' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,2)?></td>
                            <td<?=Ssc_Auto($hm,3) == '双' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,3)?></td>
                            <td<?=Ssc_Auto($hm,4) == '龙' || Ssc_Auto($hm,4) == '和' ? ' class="red"' : ''?> width="50"><?=Ssc_Auto($hm,4)?></td>
                            <td width="50"><?=Ssc_Auto($hm,5)?></td>
                            <td width="50"><?=Ssc_Auto($hm,6)?></td>
                            <td width="50"><?=Ssc_Auto($hm,7)?></td>
                        </tr>
            <?php
                    }
                }
            ?>
            <tr>
                <td colspan="14"><?php echo $pageStr; ?></td>
            </tr>
        </table>
    </div>
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>