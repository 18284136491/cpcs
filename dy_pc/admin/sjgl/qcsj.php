<?php
include_once("../common/login_check.php");
check_quanxian("sjgl");

$msg	=	"&nbsp;";
$action	=	$_POST['hf_action'];
if($action == "ss"){
	include_once("../../include/mysqlis.php");
	$time	=	strtotime(date("Y-m-d"));
	$time	=	strftime("%Y-%m-%d",$time-6*24*3600).' 00:00:00';
	$sql	=	"Delete From `bet_match` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
	$mysqlis->query($sql);
	$q1		=	$mysqlis->affected_rows;
	if($q1){
	    $msg=	"足球：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg=	"足球：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	$sql	=	"Delete From `lq_match` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
	$mysqlis->query($sql);
	$q1		=	$mysqlis->affected_rows;
	if($q1){
	    $msg.=	"篮球：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"篮球：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	$sql	=	"Delete From `tennis_match` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
	$mysqlis->query($sql);
	$q1		=	$mysqlis->affected_rows;
	if($q1){
	    $msg.=	"网球：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"网球：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	$sql	=	"Delete From `volleyball_match` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
	$mysqlis->query($sql);
	$q1		=	$mysqlis->affected_rows;
	if($q1){
	    $msg.=	"排球：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"排球：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	$sql	=	"Delete From `baseball_match` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
	$mysqlis->query($sql);
	$q1		=	$mysqlis->affected_rows;
	if($q1){
	    $msg.=	"棒球：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"棒球：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	$sql	=	"select x_id from `t_guanjun` where Match_CoverDate<'$time'";
	$query	=	$mysqlis->query($sql);
	$xid	=	'';
	while($rows = $query->fetch_array()){
		$xid .= $rows['x_id'].',';
	}
	if($xid){
		$xid	=	rtrim($xid,',');
		$sql	=	"Delete From `t_guanjun_team` Where xid in($xid)"; //删除7天之前的所有记录
		$mysqlis->query($sql);
		$sql	=	"Delete From `t_guanjun` Where Match_CoverDate<'$time'"; //删除7天之前的所有记录
		$mysqlis->query($sql);
		$q1		=	$mysqlis->affected_rows;
		if($q1){
			$msg.=	"金融冠军：恭喜您，本次共删除：$q1 条记录！";
		}else{
			$msg.=	"金融冠军：您的数据库已经优化好了，本次无记录删除！";
		}
	}else{
		$msg.=	"金融冠军：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    
    /* 删除其他彩种数据 */
	include_once("../../include/mysqli.php");
    //删除公告
    $sql	=	"Delete From `k_notice` Where end_time<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"公告：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"公告：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除重庆时时彩
    $sql	=	"Delete From `c_auto_2` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"重庆时时彩：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"重庆时时彩：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除广东快乐10分
    $sql	=	"Delete From `c_auto_3` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"广东快乐10分：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"广东快乐10分：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除北京赛车PK拾
    $sql	=	"Delete From `c_auto_4` Where datetime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"北京赛车PK拾：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"北京赛车PK拾：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除北京快乐8
    $sql	=	"Delete From `lottery_k_kl8` Where fengpan<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"北京快乐8：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"北京快乐8：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除上海时时乐
    $sql	=	"Delete From `lottery_k_ssl` Where addtime<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"上海时时乐：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"上海时时乐：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
	//删除站内消息
	$sql	=	"Delete From `k_user_msg` Where msg_time<'$time'";
	$mysqli->query($sql);
	$q1		=	$mysqli->affected_rows;
	if($q1){
	    $msg.=	"站内消息：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"站内消息：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //3D和排列三数据较少，没有删除
    
    /* 删除db3 */
	include_once("../../include/mysqlio.php");
    //删除管理员登陆日志
    $sql	=	"Delete From `admin_login` Where login_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"管理员登陆日志：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"管理员登陆日志：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除会员历史登陆记录
    $sql	=	"Delete From `history_login` Where login_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"会员历史登陆记录：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"会员历史登陆记录：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
    //删除系统日志
    $sql	=	"Delete From `sys_log` Where log_time<'$time'";
	$mysqlio->query($sql);
	$q1		=	$mysqlio->affected_rows;
	if($q1){
	    $msg.=	"系统日志：恭喜您，本次共删除：$q1 条记录！";
	}else{
		$msg.=	"系统日志：您的数据库已经优化好了，本次无记录删除！";
	}
	$msg	.=	"<br />";
}

/*删除注单*/
if ($action == "del")
{
	include_once("../../include/mysqli.php");
    
	$time = strtotime(date("Y-m-d"));
	$time = strftime("%Y-%m-%d",$time-30*24*3600).' 00:00:00';
	$cz = array();
	$cw = array();
    $cz = @$_POST["cz"];
    $cw = @$_POST["cw"];
	$meg = "";
	
    if ($cz)
    {
        
        if (in_array("tyds", $cz))
        {
            $sql = "delete from k_bet where status <> 0 and match_coverdate <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "体育单式：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "体育单式：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("tycg", $cz))
        {
            $sql = "select gid from k_bet_cg_group where status <> 0 and match_coverdate <= '$time'";
            $query = $mysqli->query($sql);
            $gid = "";
            
            while ($rows = $query->fetch_array())
            {
                $gid .= $rows["gid"].",";
            }
            
            if ($gid != "")
            {
                $gid = rtrim($gid, ",");
                $sql = "delete from k_bet_cg where gid in ($gid)";
                $mysqli->query($sql);
                $sql = "delete from k_bet_cg_group where gid in ($gid)";
                $mysqli->query($sql);
                $count = $mysqli->affected_rows;
                
                if ($count)
                {
                    $meg .= "体育串关：恭喜您，本次共删除：$count 条记录！";
                }
                else
                {
                    $meg .= "体育串关：您的数据库已经优化好了，本次无记录删除！";
                }
            
            }
            else
            {
                $meg .= "体育串关：您的数据库已经优化好了，本次无记录删除！";
            }
                
            $meg .= "<br />";
        }
        
        if (in_array("lhc", $cz))
        {
            $sql = "delete from lb2_db.ka_tan where checked = 1 and adddate <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "香港六合彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "香港六合彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("cqssc", $cz))
        {
            $sql = "delete from c_bet where js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "重庆时时彩：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "重庆时时彩：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("gdklsf", $cz))
        {
            $sql = "delete from c_bet where type = '广东快乐10分' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "广东快乐10分：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "广东快乐10分：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("bjsc", $cz))
        {
            $sql = "delete from c_bet where type = '北京赛车PK拾' and js = 1 and addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "北京赛车PK拾：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "北京赛车PK拾：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("kl8", $cz))
        {
            $sql = "delete from lottery_data where atype = 'kl8' and bet_ok = 1 and bet_time <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "北京快乐8：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "北京快乐8：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("ssl", $cz))
        {
            $sql = "delete from lottery_data where atype = 'ssl' and bet_ok = 1 and bet_time <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "上海时时乐：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "上海时时乐：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("3d", $cz))
        {
            $sql = "delete from lottery_data where atype = '3d' and bet_ok = 1 and bet_time <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "福彩3D：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "福彩3D：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
        
        if (in_array("pl3", $cz))
        {
            $sql = "delete from lottery_data where atype = 'pl3' and bet_ok = 1 and bet_time <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "排列三：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "排列三：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("live", $cz))
        {
            $sql = "delete from agbetdetail where betTime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "真人下注记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "真人下注记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
    }
	if ($cw)
	{
		if (in_array("cqk", $cw))
        {
            $sql = "delete from huikuan where status <> 0 and adddate <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            $sql = "delete from k_money where status <> 2 and m_make_time <= '$time'";
            $mysqli->query($sql);
            $count += $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "存取款：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "存取款：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("lishi", $cw))
        {
            $sql = "delete from lb3_db.save_user where addtime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "会员历史余额：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "会员历史余额：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("live", $cw))
        {
            $sql = "delete from agaccounttransfer where creationTime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "真人额度记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "真人额度记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
		
		if (in_array("fs", $cw))
        {
            $sql = "delete from fs_account where fs_uptime <= '$time'";
            $mysqli->query($sql);
            $count = $mysqli->affected_rows;
            
            if ($count)
            {
                $meg .= "返水记录：恭喜您，本次共删除：$count 条记录！";
            }
            else
            {
                $meg .= "返水记录：您的数据库已经优化好了，本次无记录删除！";
            }
            
            $meg .= "<br />";
        }
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清除数据</title>
<link rel="stylesheet" href="../Images/CssAdmin.css">
<script language="JavaScript" src="../../js/jquery.js"></script>
<script language="JavaScript" src="../../js/calendar.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="qcsj.php" onsubmit="return(confirm('您确定要清除一周前数据'))">
  <div align="center">
    <input type="submit" name="Submit" value="一键自动清除一周前数据" />
    <input name="hf_action" type="hidden" id="hf_action" value="ss" />
  </div>
</form>
<p align="center">一键自动清除数据，只会清除7天之前的所有采集来的数据和系统日志！</p>
<p align="center"><?=$msg?></p>
<br /><br />
<form id="form3" name="form3" method="post" action="qcsj.php" onsubmit="return checkdel();">
    <table width="100%" border="0">
        <tr>
            <td align="right" width="10%">删除时间：</td>
            <td width="90%">删除30天之前的数据</td>
        </tr>
        <tr>
            <td align="right">删除彩种：</td>
            <td>
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="tyds" />体育单式
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="tycg" />体育串关
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="lhc" />香港六合彩
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="cqssc" />重庆时时彩
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="gdklsf" />广东快乐10分
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="bjsc" />北京赛车PK拾
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="kl8" />北京快乐8
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="ssl" />上海时时乐
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="3d" />福彩3D
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="pl3" />排列三
                <input name="cz[]" type="checkbox" checked="checked" id="cz[]" value="live" />真人下注记录
            </td>
        </tr>
        <tr>
            <td align="right">删除财务：</td>
            <td>
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="cqk" />存取款记录
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="lishi" />会员历史余额
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="live" />真人额度记录
                <input name="cw[]" type="checkbox" checked="checked" id="cw[]" value="fs" />返水记录
            </td>
        </tr>
        <tr>
            <td align="right"></td>
            <td>
                <input name="hf_action" type="hidden" id="hf_action" value="del" />
                <input name="Submit3" type="submit" id="Submit3" value="一键删除" />
            </td>
        </tr>
    </table>
</form>
<p align="center"><?=$meg?></p>
</body>
</html>