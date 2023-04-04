<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/website.php");

$lm      = 'route';
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title><?=$web_site['web_title']?></title>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body class="xieyi">
<div class="news">
    <ul>
        <?php
            $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 3";
            $query = $mysqli->query($sql);
            $i = 1;
            while($rs = $query->fetch_array()) {
                ?>
                <li>[<?=$i?>] <?=$rs['msg']?></li>
        <?php
                $i++;
            }
        ?>
    </ul>
</div>
<div class="win">
    <div class="agree">
        <div class="logo"></div>
        <ul>
            <li class="tit">用户协议</li>
            <li class="cont">
                <div class="info">
                    <ul>
                        <li>01. 使用本公司网站的客户，请留意阁下所在的国家或居住地的相关法律规定，如有疑问应就相关问题，寻求当地法律意见。</li>
                        <li>02. 若发生遭黑客入侵破坏行为或不可抗拒之灾害导致网站故障或资料损坏、资料丢失等情况，我们将以本公司之后备资料为最后处理依据；为确保各方利益，请各会员投注后打印资料。本公司不会接受没有打印资料的投诉。</li>
                        <li>03. 为避免纠纷，各会员在投注之后，务必进入下注明细检查及打印资料。若发现任何异常，请立即与代理商联系查证，一切投注将以本公司资料库的资料为准，不得异议。如出现特殊网络情况或线路不稳定导致不能下注或下注失败。本公司概不负责。</li>
                        <li>04. 开奖结果以官方公布的结果为准。</li>
                        <li>05. 如遇到官方停止销售或者开奖结果不确定的情况，本公司将对相关注单进行无效处理，并且返还下注本金。</li>
                        <li>06. 我们将竭力提供准确而可靠的开奖统计等资料，但并不保证资料绝对无误，统计资料只供参考，并非是对客户行为的指引，本公司也不接受关于统计数据产生错误而引起的相关投诉。</li>
                        <li>07. 本公司拥有一切判决及注消任何涉嫌以非正常方式下注之权利，在进行更深入调查期间将停止发放与其有关之任何彩金。客户有责任确保自己的帐户及密码保密，如果客户怀疑自己的资料被盗用，应立即通知本公司，并须更改其个人详细资料。所有被盗用帐号之损失将由客户自行负责。</li>
                        <li>以上协议最终解释权归福运来彩票所有</li>
                        <li>
                            <div class="bar">
                                <span>
									<a href="/logout.php">不同意</a>
                                    <a href="javascript:void(0)" onclick="agree();">同意</a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="btm"></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function agree() {
        var n = $(".news");
        if(n.find("li").length > 0) {
            layer.open({
                type: 1,
                area: '500px',
				shift: -1,
                btn: '知道了',
                title: '重要公告',
                content: n,
                yes: function(i) {
                    layer.close(i);
                    location.replace("/main.php");
                }
            });
        } else {
            location.replace("/main.php");
        }
    }
</script>
</body>
</html>