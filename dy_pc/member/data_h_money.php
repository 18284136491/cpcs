<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$subsub = 2;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
<div class="wrap">
    <?php include_once("moneysubmenu.php"); ?>
    <table cellspacing="1" cellpadding="0" border="0" class="tab1">
        <tr class="tic">
            <td width="15%">汇款时间</td>
            <td width="20%">流水号</td>
            <td width="15%">充值金额</td>
            <td width="10%">赠送金额</td>
            <td width="10%">赠送积分</td>
            <td width="10%">汇款银行</td>
            <td width="10%">汇款方式</td>
            <td width="10%">状态</td>
        </tr>
        <?php
        $sql	=	"select id from huikuan where uid=$uid order by id desc";
        $query	=	$mysqli->query($sql);
        $sum	=	$mysqli->affected_rows; //总页数
        $thisPage	=	1;
        if(@$_GET['page']){
            $thisPage	=	$_GET['page'];
        }
        $page		=	new newPage();
        $perpage	= 	15;
        $thisPage	=	$page->check_Page($thisPage,$sum,$perpage,5);
        $id		=	'';
        $i		=	1; //记录 uid 数
        $start	=	($thisPage-1)*$perpage+1;
        $end	=	$thisPage*$perpage;
        while($row = $query->fetch_array()){
            if($i >= $start && $i <= $end){
                $id .=	$row['id'].',';
            }
            if($i > $end) break;
            $i++;
        }
        if($id) {
            $id		=	rtrim($id,',');
            $sql	=	"select * from huikuan where id in($id) order by id desc";
            $query	=	$mysqli->query($sql);
            $sum_money	=	0;
            $sum_zsjr	=	0;
            while($rows = $query->fetch_array()) {
                ?>
                <tr class="list">
                    <td><?=date("Y-m-d H:i:s",strtotime($rows["adddate"]))?></td>
                    <td><?=$rows["lsh"]?></td>
                    <td><?=sprintf("%.2f",$rows["money"])?></td>
                    <td><?=sprintf("%.2f",$rows["zsjr"])?></td>
                    <td><?=sprintf("%.2f",$rows["jifen"])?></td>
                    <td><?=$rows["bank"]?></td>
                    <td><?=$rows["manner"]?></td>
                    <td>
                        <?php
                        if($rows["status"] == 1) {
                            $sum_money += $rows["money"];
                            $sum_zsjr += $rows["zsjr"];
                            echo '<span class="c_red">成功</span>';
                        } else if($rows["status"] == 2) {
                            echo '<span>失败</span>';
                        } else {
                            echo '<span class="c_blue">系统审核中</span>';
                        }
                        ?>
                    </td>
                </tr>
        <?php
            }
        } else { ?>
            <tr align="center">
                <td colspan="8">暂无汇款记录！</td>
            </tr>
        <?php } ?>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" class="page">
        <tr>
            <td align="left">本页汇款成功总金额：<span class="c_red"><?=sprintf("%.2f",$sum_money)?></span> RMB</td>
            <td align="right"><?=$page->get_htmlPage("data_h_money.php?")?></td>
        </tr>
    </table>
</div>
<?php include_once('../Lottery/r_bar.php') ?>
<script type="text/javascript" src="/js/cp.js"></script>
<script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>
