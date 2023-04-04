<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/logintu.php");
include_once("common/function.php");
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
$lm = 'myagent';

if($_GET["action"]=="save"){
	$bdate	=	date("Y-m-d")." 00:00:00";
	$edate	=	date("Y-m-d")." 23:59:59";
	$sql	=	"select d_id from k_user_daili where uid='$uid' and add_time>='$bdate' and add_time<='$edate'";
	$query	=	$mysqli->query($sql);
	if($query->fetch_array()){
		message('代理每天只能申请一次，您今天已经提交申请了，请等待客服人员联系和确认');
	}

	$r_name	=	htmlEncode(trim($_POST["pay_name"]));
	$mobile	=	htmlEncode(trim($_POST["mobile"]));
	$email	=	htmlEncode(trim($_POST["email"]));
    $qq     =   htmlEncode(trim($_POST['qq']));
	$about	=	htmlEncode(trim($_POST["about"]));
	$sqlset	=	"";
	if($mobile) {
		$sqlset	.= ",mobile='$mobile'";
	}
	if($email) {
		$sqlset	.= ",email='$email'";
	}
    if($qq) {
        $sqlset .= ",msn_qq='$qq'";
    }
	$sql	=	"insert into k_user_daili set uid='$uid',r_name='$r_name',about='$about' $sqlset";
	$mysqli->autocommit(FALSE);
	$mysqli->query("BEGIN");
	try{
		$mysqli->query($sql);
		$q1	=	$mysqli->affected_rows;
		if($q1 == 1){
			$mysqli->commit();
			message('你的申请已经提交，请等待客服人员联系和确认');
		}else{
			$mysqli->rollback();
			message('代理申请提交失败，请稍后重试');
		}
	}catch(Exception $e){
		$mysqli->rollback();
		message('代理申请提交失败，请稍后重试');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body>
<?php include_once("myhead.php"); ?>
<div class="main">
    <div class="m_c1">
        <div class="w1020">
            <div class="c_t1">您需要了解一下福运来彩票合作伙伴的优势</div>
            <div class="c_t2">合作伙伴拥有自己的账户，可随时查看了解推广情况，我们相信诚信是双方长期合作的基础。</div>
            <div class="c_list">
                <ul>
                    <li>
                        <div class="ico a1"></div>
                        <div class="text">强大的品牌优势，多年业界运营实际经验，资源丰富</div>
                    </li>
                    <li>
                        <div class="ico a2"></div>
                        <div class="text">信誉卓越，资金保障，多年赔付保证，无任何负面消息，玩家评价优良。</div>
                    </li>
                    <li>
                        <div class="ico a5"></div>
                        <div class="text">24小时全年无休服务，多种支付渠道，存提款处理迅速，业界一流，可亲自体验。</div>
                    </li>
                    <li>
                        <div class="ico a8"></div>
                        <div class="text">专注品牌建设，诚信为先，用心做好与合作伙伴的沟通，致力双赢</div>
                    </li>
                </ul>
            </div>
            <div class="c_t3">请加入：如果您的更好的其他合作方案，请直接联系我们的代理专员详谈</div>
        </div>
    </div>
    <div class="m_c2">
        <div class="w1020">
            <div class="dl_left">
                <div class="tit"><em></em>注册代理账号，成为福运来代理商</div>
				<div style="color: #333">
					<p style="font-size: 20px; padding-left: 50px">第一步：请先注册会员</p>
					<p style="font-size: 20px; padding: 30px 0 0 50px">第二步：在会员中心提交代理申请</p>
					<p style="font-size: 20px; padding: 30px 0 0 50px">第三步：我们工作人员24小时内通过</p>
				</div>
            </div>
            <div class="dl_right">
                <div class="tit"><em></em>联系福运来彩票合作伙伴事业部</div>
                <div class="cont">
                    <p>
                        　　邮箱：<em style="color: red">49823458@qq.com</em><br>
                        　　代理QQ号：<em style="color: red">49823458</em><br>
                        　　工作时间：<em style="color: red">周一至周五 11：00/21：00GMT+8</em><br>
                        工作时间内1小时内尽快回复邮件，其他时间24小时内尽快回复
                    </p>
                </div>
                <div class="bj_img"></div>
            </div>
        </div>
    </div>
</div>
<?php include_once("mybottom.php"); ?>
<script type="text/javascript">
    function check_form() {
        var r_name = $("#pay_name");
        if(r_name.val() == "") {
            layer.tips('请输入您的姓名！', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            layer.tips('请输入正确的姓名！', r_name, {tips: [2, 'red']});
            r_name.select();
            return false;
        }
        var mob = $("#mobile");
        var email = $("#email");
        var qq = $("#qq");
        if(mob.val() == "" && email.val() == "" && qq.val() == "") {
            layer.msg('请至少输入一项您的联系方式！');
            mob.focus();
            return false;
        }
        var about = $("#about");
        if(about.val() == "") {
            layer.tips('请输入您的申请理由！', about, {tips: [2, 'red']});
            about.focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>