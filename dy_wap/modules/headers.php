<iframe id="topFrame" name="topFrame" frameborder="0" scrolling="no" width="0" height="0" src="top.php" style="display:none"></iframe>
 <?php
include_once("include/mysqli.php");
include_once("common/logintu.php");
$uid		= 	$_SESSION["uid"];
$sql		=	"select money as s from k_user where uid=$uid limit 1";
$query		=	$mysqli->query($sql);
$rs			=	$query->fetch_array();
$user_money	=	sprintf("%.2f",$rs['s']);
?>
<div class="header">
    <div class="blackbar">
        <div class="container">
            <p class="pull-right" style="margin-top:5px;">
                <a href="/member/record_ty.php" class="btnheader btn-green">投注记录</a> 
                <a href="/logout.php" class="btnheader btn-red">退出</a>
                <script language="javascript">	
					function refresh_money(){
						$.ajax({
							cache: false,
							url: "/get_money.php",
							success:function(data){
								if(data != "") {
									$data_arr=data.split("||");
									$("#user_money").html($data_arr[0]);
								}
							}
						}); 
						window.setTimeout("refresh_money();", 15000); 
					}
					refresh_money();
				</script> 
            </p>
            <p>
                <a id="tlogo" href="/main.php" class="brand active"><img src="/images/home.png"></a> 
				<a href="/member/userinfo.php" class="btnheader btn-orange">会员中心</a> 
				<a href="/member/set_money.php" class="btnheader btn-green">￥:<span id="user_money"><?=$user_money?></span></a> 
            </p>
        </div>
    </div>		
</div>