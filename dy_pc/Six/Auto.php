<?php
session_start();
include_once("../include/mysqli.php");
include_once("../include/config.php");
include_once("../include/pager.class.php");
include_once("../common/login_check.php");
include_once("../include/lottery.inc.php");
include("class/auto_class.php");

$g_t = 10;
if($_REQUEST['page'] == '') {
    $_REQUEST['page'] = 1;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>香港六合彩开奖结果</title>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <link type="text/css" rel="stylesheet" href="../Lottery/css/ssc.css"/>
</head>
<body>
    <div class="kj_jl">
        <?php include_once('../Lottery/list_type.php') ?>
        <table cellspacing="0" cellpadding="0" border="0" class="tb_list">
            <tr class="tit">
                <td width="100">期数</td>
                <td width="100">开奖时间</td>
                <td width="300" colspan="6">平码</td>
                <td>特码</td>
                <td>生肖</td>
                <td>总分</td>
            </tr>
            <?php
                $qishu = date('Y', $lottery_time) . '001';
                $sql = "select id from c_auto_0 where qishu>='$qishu' and ok=1 order by id desc";
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
                    $sql = "select * from c_auto_0 where id in($id) order by id desc";
                    $query = $mysqli->query($sql);
                    while($row = $query->fetch_array()) {
                        $tm_sx = Get_ShengXiao($rs['ball_7']);
                        $zh = $row['ball_1'] + $row['ball_2'] + $row['ball_3'] + $row['ball_4'] + $row['ball_5'] + $row['ball_6'] + $row['ball_7'];
                        ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td class="six"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_4']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_5']?>"></em></td>
                            <td class="six"><em class="n_<?=$row['ball_6']?>"></em></td>
                            <td class="six" width="100"><em class="n_<?=$row['ball_7']?>"></em></td>
                            <td width="100"><?=$tm_sx?></td>
                            <td width="100"><?=$zh?></td>
                        </tr>
                        <?php
                    }
                }
            ?>
            <tr>
                <td colspan="11"><?php echo $pageStr; ?></td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>