<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
include_once("function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
$userinfo=user::getinfo($_SESSION["uid"]);

$cn_begin=$_GET["cn_begin"];
$s_begin_h=$_GET["s_begin_h"];
$s_begin_i=$_GET["s_begin_i"];
$cn_begin=$cn_begin==""?date("Y-m-d",time()):$cn_begin;
$s_begin_h=$s_begin_h==""?"00":$s_begin_h;
$s_begin_i=$s_begin_i==""?"00":$s_begin_i;

$cn_end=$_GET["cn_end"];
$s_end_h=$_GET["s_end_h"];
$s_end_i=$_GET["s_end_i"];
$cn_end=$cn_end==""?date("Y-m-d",time()):$cn_end;
$s_end_h=$s_end_h==""?"23":$s_end_h;
$s_end_i=$s_end_i==""?"59":$s_end_i;

$begin_time=$cn_begin." ".$s_begin_h.":".$s_begin_i.":00";
$end_time=$cn_end." ".$s_end_h.":".$s_end_i.":59";

$zz_type=$_GET["zz_type"];
$subsub = 5;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>额度转换记录</title>
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/mmenu.all.css">
    <link type="text/css" rel="stylesheet" href="../Lottery/Css/ssc.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/mmenu.all.min.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css">
</head>
<body mode="gm">
    <div class="container-fluid gm_main">
        <div class="head">
            <a class="f_l" href="#u_nav">导航</a>
            <span>会员中心</span>
            <a class="f_r" href="#type">游戏</a>
        </div>
        <?php include_once('../Lottery/u_nav.php') ?>
        <div id="type" style="display: none">
            <ul class="g_type">
                <li>
                    <span></span>
                    <?php include_once('../Lottery/gm_list.php') ?>
                </li>
            </ul>
        </div>
        <div class="wrap">
            <?php include_once("moneysubmenu.php"); ?>
            <form id="form1" name="form1" action="?query=true" method="get">
                <table cellspacing="0" cellpadding="0" border="0" class="tab1">
                    <tr>
                        <td class="bg" align="right">转账类型：</td>
                        <td>
                            <select name="zz_type" id="zz_type">
                                <option value="" <?=$zz_type==""?"selected":""?>>全部</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">开始日期：</td>
                        <td>
                            <input name="cn_begin" type="text" id="cn_begin" class="input_150 laydate-icon" readonly="readonly" value="<?=$cn_begin?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer; margin-bottom: 5px"/>
                            <div>
                                <select name="s_begin_h" id="s_begin_h">
                                    <?php
                                    for($bh_i=0;$bh_i<24;$bh_i++){
                                        $b_h_value=$bh_i<10?"0".$bh_i:$bh_i;
                                        ?>
                                        <option value="<?=$b_h_value?>" <?=$s_begin_h==$b_h_value?"selected":""?>><?=$b_h_value?></option>
                                    <?php } ?>
                                </select> 时
                                <select name="s_begin_i" id="s_begin_i">
                                    <?php
                                    for($bh_j=0;$bh_j<60;$bh_j++){
                                        $b_i_value=$bh_j<10?"0".$bh_j:$bh_j;
                                        ?>
                                        <option value="<?=$b_i_value?>" <?=$s_begin_i==$b_i_value?"selected":""?>><?=$b_i_value?></option>
                                    <?php } ?>
                                </select> 分
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg" align="right">结束日期：</td>
                        <td>
                            <input name="cn_end" type="text" id="cn_end" class="input_150 laydate-icon" readonly="readonly" value="<?=$cn_end?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: false, max: laydate.now()});" style="cursor: pointer; margin-bottom: 5px"/>
                            <div>
                                <select name="s_end_h" id="s_end_h">
                                    <?php
                                    for($eh_i=0;$eh_i<24;$eh_i++){
                                        $e_h_value=$eh_i<10?"0".$eh_i:$eh_i;
                                        ?>
                                        <option value="<?=$e_h_value?>" <?=$s_end_h==$e_h_value?"selected":""?>><?=$e_h_value?></option>
                                    <?php } ?>
                                </select> 时
                                <select name="s_end_i" id="s_end_i">
                                    <?php
                                    for($eh_j=0;$eh_j<60;$eh_j++){
                                        $e_i_value=$eh_j<10?"0".$eh_j:$eh_j;
                                        ?>
                                        <option value="<?=$e_i_value?>" <?=$s_end_i==$e_i_value?"selected":""?>><?=$e_i_value?></option>
                                    <?php } ?>
                                </select> 分
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg"></td>
                        <td><button type="submit" name="query" class="btn btn-primary" style="width: 150px">查　询</button></td>
                    </tr>
                </table>
            </form>
            <table cellspacing="1" cellpadding="0" border="0" class="tab1 mt10">
                <tr class="tic">
                    <td width="33.333%">转账时间</td>
                    <td width="33.333%">类型/金额</td>
                    <td width="33.333">转换状态</td>
                </tr>
                <?php
                if($zz_type != "") {
                    $sqlwhere = " and type='".$zz_type."'";
                }
                $begin_time = strtotime($begin_time);
                $end_time = strtotime($end_time);
                $sql	=	"select id from zz_info where uid=$uid ".$sqlwhere." and actionTime>='$begin_time' and actionTime<='$end_time' order by id desc";
                $query	=	$mysqli->query($sql);
                $sum	=	$mysqli->affected_rows; //总页数
                $thisPage	=	1;
                if(@$_GET['page']){
                    $thisPage	=	$_GET['page'];
                }
                $page		=	new newPage();
                $perpage	=   15;
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
                    $sql	=	"select * from zz_info where id in($id) order by id desc";
                    $query	=	$mysqli->query($sql);
                    $okmoney	=	0;
                    $nomoney	=	0;
                    while($rows = $query->fetch_array()) {
                        ?>
                        <tr class="list f_12">
                            <td><?=date("Y-m-d H:i:s",$rows["actionTime"]+1*12*3600)?></td>
                            <td><span class="c_blue"><?=$rows["info"]?></span> @ <span class="c_red"><?=sprintf("%.2f",$rows["amount"])?></span></td>
                            <td><?=$rows["result"]?></td>
                        </tr>
                        <?php
                        $okmoney += abs($rows["amount"]);
                    }
                } else { ?>
                    <tr align="center">
                        <td colspan="3">暂无转账记录！</td>
                    </tr>
                <?php } ?>
            </table>
            <table border="0" cellspacing="0" cellpadding="0" class="page">
                <tr>
                    <td align="right"><?=$page->get_htmlPage("zr_data_money.php?cn_begin=".$cn_begin."&s_begin_h=".$s_begin_h."&s_begin_i=".$s_begin_i."&cn_end=".$cn_end."&s_end_h=".$s_end_h."&s_end_i=".$s_end_i."&zz_type=".$zz_type);?></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="../js/base.js"></script>
</body>
</html>