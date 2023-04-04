<?php
include_once("../common/login_check.php"); 
check_quanxian("hygl");
include_once("../../include/mysqli.php");

$id = '0';
if(isset($_GET["id"])){
	$id		=	$_GET["id"];
	$sql	=	"select * from `k_group` where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
<TITLE>用户组编辑页面</TITLE>
<link rel="stylesheet" href="Images/CssAdmin.css">
 
<style type="text/css">
<STYLE>
BODY {
SCROLLBAR-FACE-COLOR: rgb(255,204,0);
 SCROLLBAR-3DLIGHT-COLOR: rgb(255,207,116);
 SCROLLBAR-DARKSHADOW-COLOR: rgb(255,227,163);
 SCROLLBAR-BASE-COLOR: rgb(255,217,93)
}
.STYLE2 {font-size: 12px}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
td{font:13px/120% "宋体";padding:3px;}
a{

	color:#F37605;

	text-decoration: none;

}
.t-title{background:url(../images/06.gif);height:24px;}
.t-tilte td{font-weight:800;}
</STYLE>
</HEAD>
<script type="text/javascript">
    var v;
	var num;
    function check(obj){
	    if(obj.name.value==""){
		    alert("请您输入会员组名称..");
			obj.name.focus();
			return false;
		}
		return true;
	}
	
	function isnum(obj){
	    v = obj.value;
		if(v == (parseInt(v)*1)){
		     num = v.indexOf(".");
			 if(num == -1) return true;
			 else{
		        alert("限额只能为正整数..");
			    obj.select();
			    return false;
		     }
		}else{
		    alert("限额只能为正整数..");
			obj.focus();
			return false;
		}
	}
</script>
<body>
<form name="form1" id="form1" method="post" action="group_save.php" onSubmit="return check(this);">
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td height="24" nowrap background="../images/06.gif"><font >&nbsp;<span class="STYLE2">用户组权限管理：编辑用户组信息</span></font></td>
  </tr>
  <tr>
    <td height="24" align="left" nowrap bgcolor="#FFFFFF">&nbsp;&nbsp;<a href="group.php">&lt;&lt;返回会员组</a></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
   
  <tr>
    <td height="24" valign="top" nowrap bgcolor="#FFFFFF">
    
<table width="100%" border="1" bgcolor="#FFFFFF" bordercolor="#96B697" cellspacing="0" cellpadding="0" style="border-collapse: collapse; color: #225d9c;" id=editProduct   idth="100%" >
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td width="25%" align="right">用户组名称：</td>
              <td colspan="3" align="left"><label>
                <input name="name" type="text" id="name" value="<?=@$rs['name']?>" size="20" maxlength="20">
              </label></td>
          </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>足球</strong></td>
        </tr>
	        <tr align="center">
	          <td width="25%" align="center"><strong>类型</strong></td>
	          <td width="25%" align="center"><strong>额度</strong></td>
              <td width="25%" align="center"><strong>类型</strong></td>
              <td width="25%" align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">全场让球单注限额：</td>
	          <td align="left"><label>
	            <input name="qc_rqdz" type="text" id="qc_rqdz" value="<?=@$rs['qc_rqdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" >
	          </label></td>
              <td align="right">全场让球单场限额：</td>
              <td align="left"><input name="qc_rqdc" type="text" id="qc_rqdc" value="<?=@$rs['qc_rqdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">全场单双单注限额：</td>
	          <td align="left"><input name="qc_dsdz" type="text" id="qc_dsdz" value="<?=@$rs['qc_dsdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">全场单双单场限额：</td>
              <td align="left"><input name="qc_dsdc" type="text" id="qc_dsdc" value="<?=@$rs['qc_dsdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">全场大小单注限额：</td>
	          <td align="left"><input name="qc_dxdz" type="text" id="qc_dxdz" value="<?=@$rs['qc_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">全场大小单场限额：</td>
              <td align="left"><input name="qc_dxdc" type="text" id="qc_dxdc" value="<?=@$rs['qc_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">全场独赢单注限额：</td>
	          <td align="left"><input name="qc_dydz" type="text" id="qc_dydz" value="<?=@$rs['qc_dydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">全场独赢单场限额：</td>
              <td align="left"><input name="qc_dydc" type="text" id="qc_dydc" value="<?=@$rs['qc_dydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">上半让球单注限额：</td>
	          <td align="left"><input name="sb_rqdz" type="text" id="sb_rqdz" value="<?=@$rs['sb_rqdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">上半让球单场限额：</td>
              <td align="left"><input name="sb_rqdc" type="text" id="sb_rqdc" value="<?=@$rs['sb_rqdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">上半大小单注限额：</td>
	          <td align="left"><input name="sb_dxdz" type="text" id="sb_dxdz" value="<?=@$rs['sb_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">上半大小单场限额：</td>
              <td align="left"><input name="sb_dxdc" type="text" id="sb_dxdc" value="<?=@$rs['sb_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">上半独赢单注限额：</td>
	          <td align="left"><input name="sb_dydz" type="text" id="sb_dydz" value="<?=@$rs['sb_dydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">上半独赢单场限额：</td>
              <td align="left"><input name="sb_dydc" type="text" id="sb_dydc" value="<?=@$rs['sb_dydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">波胆单注限额：</td>
	          <td align="left"><input name="bd_dz" type="text" id="bd_dz" value="<?=@$rs['bd_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">波胆单场限额：</td>
              <td align="left"><input name="bd_dc" type="text" id="bd_dc" value="<?=@$rs['bd_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">入球数单注限额：</td>
	          <td align="left"><input name="rqs_dz" type="text" id="rqs_dz" value="<?=@$rs['rqs_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">入球数单场限额：</td>
              <td align="left"><input name="rqs_dc" type="text" id="rqs_dc" value="<?=@$rs['rqs_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">半全场单注限额：</td>
	          <td align="left"><input name="bqc_dz" type="text" id="bqc_dz" value="<?=@$rs['bqc_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">半全场单场限额：</td>
              <td align="left"><input name="bqc_dc" type="text" id="bqc_dc" value="<?=@$rs['bqc_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球全场让球单注限额：</td>
	          <td align="left"><input name="gq_qcrqdz" type="text" id="gq_qcrqdz" value="<?=@$rs['gq_qcrqdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球全场让球当场限额：</td>
              <td align="left"><input name="gq_qcrqdt" type="text" id="gq_qcrqdt" value="<?=@$rs['gq_qcrqdt']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球全场大小单注限额：</td>
	          <td align="left"><input name="gq_qcdxdz" type="text" id="gq_qcdxdz" value="<?=@$rs['gq_qcdxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球全场大小单场限额：</td>
              <td align="left"><input name="gq_qcdxdc" type="text" id="gq_qcdxdc" value="<?=@$rs['gq_qcdxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球上半让球单注限额：</td>
	          <td align="left"><input name="gq_sbrqdz" type="text" id="gq_sbrqdz" value="<?=@$rs['gq_sbrqdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球上半让球单场限额：</td>
              <td align="left"><input name="gq_sbrqdc" type="text" id="gq_sbrqdc" value="<?=@$rs['gq_sbrqdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球上半大小单注限额：</td>
	          <td align="left"><input name="gq_sbdxdz" type="text" id="gq_sbdxdz" value="<?=@$rs['gq_sbdxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球上半大小单场限额：</td>
              <td align="left"><input name="gq_sbdxdc" type="text" id="gq_sbdxdc" value="<?=@$rs['gq_sbdxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球全场独赢单注限额：</td>
	          <td align="left"><input name="gq_qcdydz" type="text" id="gq_qcdydz" value="<?=@$rs['gq_qcdydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球全场独赢单场限额：</td>
              <td align="left"><input name="gq_qcdydc" type="text" id="gq_qcdydc" value="<?=@$rs['gq_qcdydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球上半独赢单注限额：</td>
	          <td align="left"><input name="gq_sbdydz" type="text" id="gq_sbdydz" value="<?=@$rs['gq_sbdydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球上半独赢单场限额：</td>
              <td align="left"><input name="gq_sbdydc" type="text" id="gq_sbdydc" value="<?=@$rs['gq_sbdydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>篮球</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">篮球单双单注限额：</td>
	          <td align="left"><input name="lq_dsdz" type="text" id="lq_dsdz" value="<?=@$rs['lq_dsdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
	          <td align="right">篮球单双单场限额：</td>
	          <td align="left"><input name="lq_dsdc" type="text" id="lq_dsdc" value="<?=@$rs['lq_dsdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">篮球让分单注限额：</td>
	          <td align="left"><input name="lq_rfdz" type="text" id="lq_rfdz" value="<?=@$rs['lq_rfdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
	          <td align="right">篮球让分单场限额：</td>
	          <td align="left"><input name="lq_rfdc" type="text" id="lq_rfdc" value="<?=@$rs['lq_rfdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">篮球大小单注限额：</td>
	          <td align="left"><input name="lq_dxdz" type="text" id="lq_dxdz" value="<?=@$rs['lq_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
	          <td align="right">篮球大小单场限额：</td>
	          <td align="left"><input name="lq_dxdc" type="text" id="lq_dxdc" value="<?=@$rs['lq_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球让分单注限额：</td>
	          <td align="left"><input name="gq_rfdz" type="text" id="gq_rfdz" value="<?=@$rs['gq_rfdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球让分单场限额：</td>
              <td align="left"><input name="gq_rfdc" type="text" id="gq_rfdc" value="<?=@$rs['gq_rfdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">滚球大小单注限额：</td>
	          <td align="left"><input name="gq_dxdz" type="text" id="gq_dxdz" value="<?=@$rs['gq_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">滚球大小单场限额：</td>
              <td align="left"><input name="gq_dxdc" type="text" id="gq_dxdc" value="<?=@$rs['gq_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>网球</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">网球独赢单注限额：</td>
	          <td align="left"><input name="wq_dydz" type="text" id="wq_dydz" value="<?=@$rs['wq_dydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">网球独赢单场限额：</td>
              <td align="left"><input name="wq_dydc" type="text" id="wq_dydc" value="<?=@$rs['wq_dydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">网球让盘单注限额：</td>
	          <td align="left"><input name="wq_rbdz" type="text" id="wq_rbdz" value="<?=@$rs['wq_rbdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">网球让盘单场限额：</td>
              <td align="left"><input name="wq_rbdc" type="text" id="wq_rbdc" value="<?=@$rs['wq_rbdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">网球单双单注限额：</td>
	          <td align="left"><input name="wq_dsdz" type="text" id="wq_dsdz" value="<?=@$rs['wq_dsdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">网球单双单场限额：</td>
              <td align="left"><input name="wq_dsdc" type="text" id="wq_dsdc" value="<?=@$rs['wq_dsdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">网球大小单注限额：</td>
	          <td align="left"><input name="wq_dxdz" type="text" id="wq_dxdz" value="<?=@$rs['wq_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">网球大小单场限额：</td>
              <td align="left"><input name="wq_dxdc" type="text" id="wq_dxdc" value="<?=@$rs['wq_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>排球</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">排球独赢单注限额：</td>
	          <td align="left"><input name="pq_dydz" type="text" id="pq_dydz" value="<?=@$rs['pq_dydz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">排球独赢单场限额：</td>
              <td align="left"><input name="pq_dydc" type="text" id="pq_dydc" value="<?=@$rs['pq_dydc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">排球让盘单注限额：</td>
	          <td align="left"><input name="pq_rpdz" type="text" id="pq_rpdz" value="<?=@$rs['pq_rpdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">排球让盘单场限额：</td>
              <td align="left"><input name="pq_rpdc" type="text" id="pq_rpdc" value="<?=@$rs['pq_rpdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
	        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">排球大小单注限额：</td>
	          <td align="left"><input name="pq_dxdz" type="text" id="pq_dxdz" value="<?=@$rs['pq_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">排球大小单场限额：</td>
              <td align="left"><input name="pq_dxdc" type="text" id="pq_dxdc" value="<?=@$rs['pq_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">排球单双单注限额：</td>
	          <td align="left"><input name="pq_dsdz" type="text" id="pq_dsdz" value="<?=@$rs['pq_dsdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">排球单双单场限额：</td>
              <td align="left"><input name="pq_dsdc" type="text" id="pq_dsdc" value="<?=@$rs['pq_dsdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>棒球</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">棒球让分单注限额：</td>
	          <td align="left"><input name="bp_rfdz" type="text" id="bp_rfdz" value="<?=@$rs['bp_rfdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">棒球让分单场限额：</td>
              <td align="left"><input name="bp_rfdc" type="text" id="bp_rfdc" value="<?=@$rs['bp_rfdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">棒球大小单注限额：</td>
	          <td align="left"><input name="bp_dxdz" type="text" id="bp_dxdz" value="<?=@$rs['bp_dxdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">棒球大小单场限额：</td>
              <td align="left"><input name="bp_dxdc" type="text" id="bp_dxdc" value="<?=@$rs['bp_dxdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">棒球单双单注限额：</td>
	          <td align="left"><input name="bp_dsdz" type="text" id="bp_dsdz" value="<?=@$rs['bp_dsdz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">棒球单双单场限额：</td>
              <td align="left"><input name="bp_dsdc" type="text" id="bp_dsdc" value="<?=@$rs['bp_dsdc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>冠军</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">冠军单注限额：</td>
	          <td align="left"><input name="gj_dz" type="text" id="gj_dz" value="<?=@$rs['gj_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">冠军单场限额：</td>
              <td align="left"><input name="gj_dc" type="text" id="gj_dc" value="<?=@$rs['gj_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>金融</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">金融单注限额：</td>
	          <td align="left"><input name="jr_dz" type="text" id="jr_dz" value="<?=@$rs['jr_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">金融单场限额：</td>
              <td align="left"><input name="jr_dc" type="text" id="jr_dc" value="<?=@$rs['jr_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>串关</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">串关单注限额：</td>
	          <td align="left"><input name="gg_dz" type="text" id="gg_dz" value="<?=@$rs['gg_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">串关单天限额：</td>
              <td align="left"><input name="gg_dc" type="text" id="gg_dc" value="<?=@$rs['gg_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left" bgcolor="#CCCCCC"><strong>未定义</strong></td>
        </tr>
	        <tr align="center">
              <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
	          <td align="center"><strong>类型</strong></td>
	          <td align="center"><strong>额度</strong></td>
        </tr>
	        <tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
	          <td align="right">未定义单注限额：</td>
	          <td align="left"><input name="wdy_dz" type="text" id="wdy_dz" value="<?=@$rs['wdy_dz']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
              <td align="right">未定义单场限额：</td>
              <td align="left"><input name="wdy_dc" type="text" id="wdy_dc" value="<?=@$rs['wdy_dc']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
		<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
			<td align="right">体育最低下注：</td>
			<td align="left"><input name="ty_zd" type="text" id="ty_zd" value="<?=@$rs['ty_zd']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
			<td align="right"></td>
			<td align="left"></td>
        </tr>
		<tr align="center">
			<td colspan="4" align="left" bgcolor="#CCCCCC"><strong>彩票</strong></td>
        </tr>
		<tr align="center">
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
        </tr>
		<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
			<td align="right">彩票最低下注：</td>
			<td align="left"><input name="cp_zd" type="text" id="cp_zd" value="<?=@$rs['cp_zd']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
			<td align="right">彩票最高下注：</td>
			<td align="left"><input name="cp_zg" type="text" id="cp_zg" value="<?=@$rs['cp_zg']?>" size="20" maxlength="10" onBlur="return isnum(this);" ></td>
        </tr>
        <tr align="center">
			<td colspan="4" align="left" bgcolor="#CCCCCC"><strong>返水</strong><a name="fs"></a></td>
        </tr
        ><tr align="center">
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
			<td align="center"><strong>类型</strong></td>
			<td align="center"><strong>额度</strong></td>
        </tr>
		<tr align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="background-color:#FFFFFF;">
			<td align="right">体育返水：</td>
			<td align="left"><input name="zqfsbl" type="text" id="zqfsbl" value="<?=@$rs['zqfsbl']*100?>" size="20" maxlength="10" >%</td>
			<td align="right">彩票返水：</td>
			<td align="left"><input name="cpfsbl" type="text" id="cpfsbl" value="<?=@$rs['cpfsbl']*100?>" size="20" maxlength="10"  >%</td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="left"><input name="hf_id" type="hidden" id="hf_id" value="<?=$id?>">&nbsp;</td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="center">
	            <input name="tj" type="submit" id="tj" value="提 交">
	          &nbsp;&nbsp;&nbsp;&nbsp;　
	          <input type="button" name="cx" value="取 消" onClick="window.location.href='group.php'">
	          </td>
        </tr>
	        <tr align="center">
	          <td colspan="4" align="center">&nbsp;</td>
        </tr>   	
    </table>
    </td>
  </tr>
</table>
</form>
</body>
</html>