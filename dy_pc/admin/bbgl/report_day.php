<?php
include_once("../common/login_check.php");
include_once("../../include/mysqli.php");
check_quanxian("bbgl");

$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bdate	=	$bdate==""?date("Y-m-d",time()):$bdate;
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
$username=	$_GET["username"];
$qiantian=	date("Y-m-d",strtotime($bdate)-24*3600);
$cz 	= 	$_GET["cz"];
if(!$cz){
	$cz[1]	=	"tyds";
	$cz[2]	=	"tycg";
	$cz[3]	=	"lhc";
	$cz[4]	=	"cqssc";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome</title>
	<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
	<script type="text/javascript" charset="utf-8" src="/js/jquery.js" ></script>
	<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body>
<div id="pageMain">
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" class="font12" style="border:1px solid #798EB9;">
		<form name="form1" method="get" action="">
		<tr bgcolor="#FFFFFF">
			<td align="left">
				<select name="time" id="time" disabled="disabled">
					<option value="CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
					<option value="EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
				</select>
				&nbsp;开始日期
				<input name="bdate" type="text" id="bdate" value="<?=$bdate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="bhour" id="bhour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="bsecond" id="bsecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
				&nbsp;结束日期
				<input name="edate" type="text" id="edate" value="<?=$edate?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly />
				<select name="ehour" id="ehour">
					<?php
					for($i=0;$i<24;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;时
				<select name="esecond" id="esecond">
					<?php
					for($i=0;$i<60;$i++){
						$list=$i<10?"0".$i:$i;
					?>
					<option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
					<?php } ?>
				</select>&nbsp;分
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td align="left">
				&nbsp;彩种
				<input name="cz[]" type="checkbox" <?=in_array("tyds",$cz)?"checked":""?> id="cz[]" value="tyds" />体育单式
                <input name="cz[]" type="checkbox" <?=in_array("tycg",$cz)?"checked":""?> id="cz[]" value="tycg" />体育串关
                <input name="cz[]" type="checkbox" <?=in_array("cqssc",$cz)?"checked":""?> id="cz[]" value="cqssc" />
                彩票
			</td>
		</tr>
		<tr bgcolor="#FFFFFF">
			<td align="left">
				&nbsp;会员名称
				<input name="username" type="text" id="username" value="<?=$username?>" size="15" maxlength="20"/>
				&nbsp;<input name="find" type="submit" id="find" value="查找"/>
			</td>
		</tr>
		</form>
	</table>
	<?php
	$color 	=	"#FFFFFF";
	$over	=	"#EBEBEB";
	$out	=	"#ffffff";
		
	if($time=="CN"){
		$q_btime	=	date("Y-m-d H:i:s",strtotime($btime)-12*3600);
		$q_etime	=	date("Y-m-d H:i:s",strtotime($etime)-12*3600);
	}else{
		$q_btime	=	$btime;
		$q_etime	=	$etime;
	}
	$cn_q_btime	=	date("Y-m-d H:i:s",strtotime($btime)+12*3600);
	$cn_q_etime	=	date("Y-m-d H:i:s",strtotime($etime)+12*3600);
	
	$sqlwhere	=	"";
	if($username!=""){
		$sqlwhere	.=	" and u.username='$username'";
	}
	
	$sql	=	"select tm.*,su.money as bef_money from (";
	$sql	.=	"select username,money,sum(t1_value) as t1_value,sum(t2_value) as t2_value,sum(t3_value) as t3_value,sum(t4_value) as t4_value,sum(t5_value) as t5_value,sum(t6_value) as t6_value,sum(t1_sxf) as t1_sxf,sum(t2_sxf) as t2_sxf,sum(h_value) as h_value,sum(h_zsjr) as h_zsjr,sum(inmoney) as inmoney,sum(outmoney) as outmoney from (";
	//查询存取款记录
	$sql	.=	"select u.username,u.money,sum(if(m.type=1,m.m_value,0)) as t1_value,sum(if(m.type=2,m.m_value,0)) as t2_value,sum(if(m.type=3,m.m_value,0)) as t3_value,sum(if(m.type=4,m.m_value,0)) as t4_value,sum(if(m.type=5,m.m_value,0)) as t5_value,sum(if(m.type=6,m.m_value,0)) as t6_value,sum(if(m.type=1,m.sxf,0)) as t1_sxf,sum(if(m.type=2,m.sxf,0)) as t2_sxf,0 as h_value, 0 as h_zsjr,0 as inmoney,0 as outmoney from k_money m left outer join k_user u on m.uid=u.uid where m.status=1 and m.m_make_time>='$q_btime' and m.m_make_time<='$q_etime' ".$sqlwhere." group by u.username";
	$sql	.=	" union all ";
	//查询汇款金额	
	$sql	.=	"select u.username,u.money,0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,sum(ifnull(h.money,0)) as h_value,sum(ifnull(h.zsjr,0)) as h_zsjr,0 as inmoney,0 as outmoney from huikuan h left outer join k_user u on h.uid=u.uid where h.status=1 and h.adddate>='$q_btime' and h.adddate<='$q_etime' ".$sqlwhere." group by u.username";
	//查询真人
	$sql	.=	" union all ";
	$sql	.=	"select u.username,u.money,0 as t1_value,0 as t2_value,0 as t3_value,0 as t4_value,0 as t5_value,0 as t6_value,0 as t1_sxf,0 as t2_sxf,0 as h_value,0 as h_zsjr,sum(if(z.zz_type='d',z.zz_money,0)) as inmoney,sum(if(z.zz_type='w',z.zz_money,0)) as outmoney from ag_zhenren_zz z left outer join k_user u on z.uid=u.uid where z.live_type='AG' and z.ok=1 and z.zz_time>='$q_btime' and z.zz_time<='$q_etime' ".$sqlwhere." group by u.username";
	$sql	.=	")temp group by username";
	$sql	.=	")tm left outer join lb3_db.save_user su on tm.username=su.username and su.addtime like ('$qiantian%')";
	$query	=	$mysqli->query($sql);
	?>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">   
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="15"><?=$btime?> 至 <?=$etime?> 财务报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">会员账号</td>
			<td rowspan="2"><?=substr($qiantian,5,5)?>余额</td>
			<td rowspan="2">当前余额</td>
			<td colspan="4">常规存取款</td>
			<td colspan="3">红利派送</td>
			<td rowspan="2">其他情况</td>
			<td colspan="2">手续费(银行转账费用)</td>
			<td colspan="2">真人转账</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td>存款</td>
			<td>汇款</td>
			<td>人工汇款</td>
			<td>提款</td>
			<td>汇款赠送</td>
			<td>彩金派送</td>
			<td>反水派送</td>
			<td>第三方(1%)</td>
			<td>提款手续费</td>
			<td>转入</td>
			<td>转出</td>
		</tr>
		<?php
		$sum_t1_value	=	0;
		$sum_t2_value	=	0;
		$sum_t3_value	=	0;
		$sum_t4_value	=	0;
		$sum_t5_value	=	0;
		$sum_t6_value	=	0;
		$sum_t1_sxf		=	0;
		$sum_t2_sxf		=	0;
		$sum_h_value	=	0;
		$sum_h_zsjr		=	0;
		$sum_inmoney	=	0;
		$sum_outmoney	=	0;
		while($row=$query->fetch_array()){
			$sum_t1_value	+=	$row["t1_value"];
			$sum_t2_value	+=	abs($row["t2_value"]);
			$sum_t3_value	+=	$row["t3_value"];
			$sum_t4_value	+=	$row["t4_value"];
			$sum_t5_value	+=	$row["t5_value"];
			$sum_t6_value	+=	$row["t6_value"];
			$sum_t1_sxf		+=	$row["t1_sxf"];
			$sum_t2_sxf		+=	$row["t2_sxf"];
			$sum_h_value	+=	$row["h_value"];
			$sum_h_zsjr		+=	$row["h_zsjr"];
			$sum_money		+=	$row["money"];
			$sum_bef_money	+=	$row["bef_money"];
			$sum_inmoney	+=	$row["inmoney"];
			$sum_outmoney	+=	$row["outmoney"];
		?>
		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$row["username"]?></td>
			<td><?=sprintf("%.2f",$row["bef_money"])?></td>
			<td><?=sprintf("%.2f",$row["money"])?></td>
			<td><?=sprintf("%.2f",$row["t1_value"])?></td>
			<td><?=sprintf("%.2f",$row["h_value"])?></td>
			<td><?=sprintf("%.2f",$row["t3_value"])?></td>
			<td><?=sprintf("%.2f",abs($row["t2_value"]))?></td>
			<td><?=sprintf("%.2f",$row["h_zsjr"])?></td>
			<td><?=sprintf("%.2f",$row["t4_value"])?></td>
			<td><?=sprintf("%.2f",$row["t5_value"])?></td>
			<td><?=sprintf("%.2f",$row["t6_value"])?></td>
			<td><?=sprintf("%.2f",$row["t1_sxf"])?></td>
			<td><?=sprintf("%.2f",$row["t2_sxf"])?></td>
			<td><?=sprintf("%.2f",$row["inmoney"])?></td>
			<td><?=sprintf("%.2f",$row["outmoney"])?></td>
        </tr>
		<?php } ?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
			<td><?=sprintf("%.2f",$sum_bef_money)?></td>
			<td><?=sprintf("%.2f",$sum_money)?></td>
			<td><?=sprintf("%.2f",$sum_t1_value)?></td>
			<td><?=sprintf("%.2f",$sum_h_value)?></td>
			<td><?=sprintf("%.2f",$sum_t3_value)?></td>
			<td><?=sprintf("%.2f",$sum_t2_value)?></td>
			<td><?=sprintf("%.2f",$sum_h_zsjr)?></td>
			<td><?=sprintf("%.2f",$sum_t4_value)?></td>
			<td><?=sprintf("%.2f",$sum_t5_value)?></td>
			<td><?=sprintf("%.2f",$sum_t6_value)?></td>
			<td><?=sprintf("%.2f",$sum_t1_sxf)?></td>
			<td><?=sprintf("%.2f",$sum_t2_sxf)?></td>
			<td><?=sprintf("%.2f",$sum_inmoney)?></td>
			<td><?=sprintf("%.2f",$sum_outmoney)?></td>
        </tr>
	</table>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;line-height:20px;" bgcolor="#798EB9">
		<tr align="center" style="background:#3C4D82;color:#ffffff;font-weight:bold;">
			<td colspan="11"><?=$btime?> 至 <?=$etime?> 投注报表</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td rowspan="2">会员账号</td>
			<td colspan="6">已结算</td>
			<td colspan="2">未结算</td>
			<td colspan="2">注单统计(未结算+已结算)</td>
		</tr>
		<tr align="center" style="background:#3C4D82;color:#ffffff;">
			<td>笔数</td>
			<td>下注金额</td>
			<td>有效投注</td>
			<td>派彩</td>
			<td>反水</td>
			<td>盈亏</td>
			<td>笔数</td>
			<td>下注金额</td>
			<td>笔数</td>
			<td>下注金额</td>
		</tr>
		<?php
		$sql	=	"select username,sum(y_num) as y_num,sum(y_bet_money) as y_bet_money,sum(yx_bet_money) as yx_bet_money,sum(y_win) as y_win,sum(y_fs) as y_fs,sum(w_num) as w_num,sum(w_bet_money) as w_bet_money from (";
		
		$sql_cz	=	"";
		//体育单式
		if(in_array("tyds",$cz)){
			$sql_cz	=	"select username,if(status<>0,1,0) as y_num,if(status<>0,bet_money,0) as y_bet_money,if(status=1 or status=2 or status=4 or status=5,bet_money,0) as yx_bet_money,if(status<>0,win,0) as y_win,if(status<>0,fs,0) as y_fs,if(status=0,1,0) as w_num,if(status=0,bet_money,0) as w_bet_money from k_bet k left outer join k_user u on k.uid=u.uid where lose_ok=1 and status in (0,1,2,3,4,5,6,7,8) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		}
		//体育串关
		if(in_array("tycg",$cz)){
			if($sql_cz!=""){
				$sql_cz	.=	" union all ";
			}
			$sql_cz	.=	"select username,if(status<>0 and status<>2,1,0) as y_num,if(status<>0 and status<>2,bet_money,0) as y_bet_money,if(status=1,bet_money,0) as yx_bet_money,if(status<>0 and status<>2,win,0) as y_win,if(status<>0 and status<>2,fs,0) as y_fs,if(status=0 or status=2,1,0) as w_num,if(status=0 or status=2,bet_money,0) as w_bet_money from k_bet_cg_group k left outer join k_user u on k.uid=u.uid where k.gid>0 and status in (0,1,2,3,4) and k.bet_time>='$q_btime' and k.bet_time<='$q_etime' ".$sqlwhere;
		}
		
		$sqlwhere	=	"";
		if($username!=""){
			$sqlwhere	.=	" and username='$username'";
		}
		//重庆时时彩
		if(in_array("cqssc",$cz)){
			if($sql_cz!=""){
				$sql_cz	.=	" union all ";
			}
			$sql_cz	.=	"select username,if(js=1,1,0) as y_num,if(js=1,money,0) as y_bet_money,if(js=1 and win<>0,money,0) as yx_bet_money,if(js=1,(case when win<0 then 0 when win=0 then money else win end),0) as y_win,fs as y_fs,if(js=0,1,0) as w_num,if(js=0,money,0) as w_bet_money from c_bet where money>0 and addtime>='$q_btime' and addtime<='$q_etime' ".$sqlwhere;

		}
		
		$sql	.=	$sql_cz;
		$sql	.=	") temp group by username";
		$query	=	$mysqli->query($sql);
		
		$sum_y_num			=	0;
		$sum_y_bet_money	=	0;
		$sum_yx_bet_money	=	0;
		$sum_y_win			=	0;
		$sum_y_fs			=	0;
		$sum_y_yingkui		=	0;
		$sum_w_num			=	0;
		$sum_w_bet_money	=	0;
		
		while($row=$query->fetch_array()){
			$y_yingkui	=	sprintf("%.2f",$row["y_bet_money"]-$row["y_win"]-$row["y_fs"]);
			
			$sum_y_num			+=	$row["y_num"];
			$sum_y_bet_money	+=	$row["y_bet_money"];
			$sum_yx_bet_money	+=	$row["yx_bet_money"];
			$sum_y_win			+=	$row["y_win"];
			$sum_y_fs			+=	$row["y_fs"];
			$sum_y_yingkui		+=	$y_yingkui;
			$sum_w_num			+=	$row["w_num"];
			$sum_w_bet_money	+=	$row["w_bet_money"];
		?>
		<tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>;">
			<td><?=$row["username"]?></td>
			<td><?=$row["y_num"]?></td>
			<td><?=sprintf("%.2f",$row["y_bet_money"])?></td>
			<td><?=sprintf("%.2f",$row["yx_bet_money"])?></td>
			<td><?=sprintf("%.2f",$row["y_win"])?></td>
			<td><?=sprintf("%.2f",$row["y_fs"])?></td>
			<td style="color:<?=$y_yingkui>=0?'#ff0000':'#009900'?>"><?=$y_yingkui?></td>
			<td><?=$row["w_num"]?></td>
			<td><?=sprintf("%.2f",$row["w_bet_money"])?></td>
			<td><?=$row["y_num"]+$row["w_num"]?></td>
			<td><?=sprintf("%.2f",$row["y_bet_money"]+$row["w_bet_money"])?></td>
        </tr>
		<?php } ?>
		<tr align="center" style="background:#ffffff;color:#ff0000;">
			<td>合计</td>
			<td><?=$sum_y_num?></td>
			<td><?=sprintf("%.2f",$sum_y_bet_money)?></td>
			<td><?=sprintf("%.2f",$sum_yx_bet_money)?></td>
			<td><?=sprintf("%.2f",$sum_y_win)?></td>
			<td><?=sprintf("%.2f",$sum_y_fs)?></td>
			<td style="color:<?=$sum_y_yingkui>=0?'#ff0000':'#009900'?>"><?=sprintf("%.2f",$sum_y_yingkui)?></td>
			<td><?=$sum_w_num?></td>
			<td><?=sprintf("%.2f",$sum_w_bet_money)?></td>
			<td><?=$sum_y_num+$sum_w_num?></td>
			<td><?=sprintf("%.2f",$sum_y_bet_money+$sum_w_bet_money)?></td>
        </tr>
	</table>
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="font12" style="margin-top:5px;line-height:20px;">
		<tr>
			<td>
				<p>备注说明：</p>
				<p>1、前一日余额由系统在美东时间当日结束时保存（且只有在后台登陆时才会保存），仅供查账时参考使用</p>
				<p>2、有效投注为有产生输赢的注单统计，可作为周反水等优惠活动的基础数据</p>
				<p>3、第三方支付的手续费统一按1%进行计算，由于各种第三方支付的手续费率和算法不一样，这部分数据仅供参考</p>
			</td>
		</tr>
	</table>
</div>
</div>
</body>
</html>