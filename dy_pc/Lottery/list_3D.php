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

$type = is_numeric($_GET['type']) ? $_GET['type'] : 9;
$game_name = get_gameName($type);
$game_smname = get_gamesmName($type);
switch($type) {
    case 9:
        $g_t = 8;
        break;
    case 10:
        $g_t = 9;
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
                <td width="88">期数</td>
                <td width="100">开奖时间</td>
                <td colspan="3">开出号码</td>
                <td colspan="3">总和</td>
                <td>龙虎</td>
                <td>三连</td>
                <td>跨度</td>
            </tr>
            <?php
                if($type == 10) {
                    $qh = date('y', $lottery_time) . '001';
                } else {
                    $qh = date('Y', $lottery_time) . '001';
                }
                $sql = "select id from c_auto_$type where qishu>='$qh' order by qishu desc";
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
                        $hm 		= array();
                        $hm[]		= $row['ball_1'];
                        $hm[]		= $row['ball_2'];
                        $hm[]		= $row['ball_3'];
                        $zh_dx      = str_replace('总和', '', FC3D_Auto($hm, 7));
                        $zh_ds      = str_replace('总和', '', FC3D_Auto($hm, 8));
                        ?>
                        <tr class="list">
                            <td><?=$row['qishu']?></td>
                            <td><?=date('m-d H:i', strtotime($row['datetime']))?></td>
                            <td width="68" class="ssc"><em class="n_<?=$row['ball_1']?>"></em></td>
                            <td width="68" class="ssc"><em class="n_<?=$row['ball_2']?>"></em></td>
                            <td width="68" class="ssc"><em class="n_<?=$row['ball_3']?>"></em></td>
                            <td width="68"><?=FC3D_Auto($hm, 0);?></td>
                            <td width="68"<?=$zh_dx == '大' ? ' class="red"' : ''?>><?=$zh_dx?></td>
                            <td width="68"<?=$zh_ds == '双' ? ' class="red"' : ''?>><?=$zh_ds?></td>
                            <td width="68"<?=FC3D_Auto($hm, 9) == '龙' || FC3D_Auto($hm, 9) == '和' ? ' class="red"' : ''?>><?=FC3D_Auto($hm, 9)?></td>
                            <td width="68"><?=FC3D_Auto($hm, 10);?></td>
                            <td width="68"><?=FC3D_Auto($hm, 11);?></td>
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
    <?php include_once('r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>