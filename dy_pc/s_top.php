<?php 
@session_start();
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("common/logintu.php");
include_once("class/user.php");
$_SESSION["check_action"]=''; //检测用户是否用软件打水标识
$uid    	=	@$_SESSION['uid'];
$loginid	=	@$_SESSION['user_login_id'];
renovate($uid,$loginid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>Welcome</title>
	<meta http-equiv="Cache-Control" content="max-age=864000" />
    <script type="text/javascript" src="skin/js2/jquery.js"></script>
    <script type="text/javascript" src="skin/js2/common.js"></script>
    <script type="text/javascript" src="skin/js2/global.js"></script>
    <script type="text/javascript" src="skin/js/top.js"></script>
    <script type="text/javascript" src="skin/js2/DD_belatedPNG.js"></script>
    <script type="text/javascript">if(isLessIE6)DD_belatedPNG.fix('*'); </script>
	<style type="text/css">
		/* CSS样式表 */
		 body{
			margin:0;
			padding:0;
			font-family: "微软雅黑","宋体", Arial;
			color:#783218;  /* 菜单字体颜色 */
			position: relative;
			font-size:12px;
			overflow-x: hidden;
		}
		/*设立常用标签的外边距，内边距，边框为0，防止在排版时再重复定义和出现怪问题*/
		div,form,ul,ol,li,dl,dt,dd,p,span,img{
			margin: 0;
			padding: 0;
			border:0;
		}
		/*设立列表样式为无，这样列表前面不带点*/
		li,dl{
			list-style-type:none;
		}
		/*(设立默认全局样式超链接样式)*/
		a{text-decoration:none;color:#900;}
		a:hover{ text-decoration:underline;color:#900;}
		/*所有样式*/
        .bodyset {
            background: #8a4102 url("images/sports/head_bg_ft.jpg") repeat-x scroll left top;
            height: 118px;
            margin: 0;
            overflow: hidden;
            padding: 27px 0 0 0;
        }
        .bodyset em{font-style: normal; margin-left: 3px}
        .bodyset a:hover{color: #f8c100;text-decoration: none}
        .bodyset .mem_box{color: #fff;text-align: center;width: 240px;float: left}
        .bodyset .mem_box .mem_info{height: 34px;line-height: 16px}
        .bodyset .mem_box .mem_tool{
            width: 100%;
            height: 52px;
            padding-top: 5px;
            border-top: 1px solid #fff;
            background-color: #493721;
        }
        .mem_tool .his{padding-right: 25px}
        .mem_tool .wag{padding-left: 25px}
        .mem_tool .credit_main{
            background: url("images/sports/head_credit_icon.gif") no-repeat scroll 12px top;
            font-weight: bold;
            height: 24px;
            line-height: 24px;
            margin-top: 5px;
            padding: 0 12px 0 40px;
        }
        .mem_tool .credit_main .re_credit{
            background: url("images/sports/head_credit_refresh.gif") no-repeat;
            border: none;
            cursor: pointer;
            height: 16px;
            margin: 2px 0 0 10px;
            position: relative;
            width: 16px;
        }
        .mem_tool .credit_main .re_credit:hover{background: url("images/sports/head_credit_refresh.gif") no-repeat scroll 0 -20px;}
        .mem_tool a{color: #fff}
        .bodyset .nav_box{width: 100%}
        .nav_box ul{overflow: hidden}
        .nav_box .level li{
            float: left;
            font-size: 14px;
            line-height: 34px;
            list-style: outside none none;
            margin-right: 3px;
            text-align: center;
            white-space: nowrap;
        }
        .nav_box .level li.rb{background: url("images/sports/head_rb_btn.gif") no-repeat scroll left top; width: 107px;}
        .nav_box .level li.rb.on{background: url("images/sports/head_rb_btn.gif") no-repeat scroll 0 -40px; color: #f8c100; width: 107px;}
        .nav_box .level li.today{background: url("images/sports/head_today_btn.gif") no-repeat scroll left top; width: 128px;}
        .nav_box .level li.today.on{background: url("images/sports/head_today_btn.gif") no-repeat scroll 0 -40px; color: #f8c100; width: 128px;}
        .nav_box .level li.early{background: url("images/sports/head_early_btn.gif") no-repeat scroll left top; width: 114px;}
        .nav_box .level li.early.on{background: url("images/sports/head_early_btn.gif") no-repeat scroll 0 -40px; color: #f8c100; width: 114px;}
        .nav_box .level a{color: #e7b565; display: block; font-weight: bold;}
        .nav_box .level li.on a{color: #f8c100}
        .nav_box .nav_list{
            background: #d7d7c1 url("images/sports/head_nav_bg_ft.gif") repeat-x;
            border-left: 1px solid #fff;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #fff;
            white-space: nowrap;
        }
        .nav_box .nav_list li{display: none}
        .nav_box .nav_list li.on{display: inline}
        .nav_box .nav_list .list li{
            background: url("images/sports/head_nav_arr.gif") no-repeat scroll 0 50%;
            float: left;
            font-size: 12px;
            line-height: 22px;
            text-align: center;
            white-space: nowrap;
            display: inline;
        }
        .nav_box .nav_list .list li:first-child{background: none}
        .nav_box .nav_list span{display: block}
        .nav_box .nav_list .ft{background: url("images/sports/head_ball_ft.gif") no-repeat scroll 10px 50%;}
        .nav_box .nav_list .bk{background: url("images/sports/head_ball_bk.gif") no-repeat scroll 10px 50%;}
        .nav_box .nav_list .tn{background: url("images/sports/head_ball_tn.gif") no-repeat scroll 10px 50%;}
        .nav_box .nav_list .vb{background: url("images/sports/head_ball_vb.gif") no-repeat scroll 10px 50%;}
        .nav_box .nav_list .bs{background: url("images/sports/head_ball_bs.gif") no-repeat scroll 10px 50%;}
        .nav_box .nav_list a{padding: 4px 10px 4px 32px;display: block;color: #fff}
        .nav_box .nav_list a.cur{color: #f8c100}
        .nav_box .nav_list a:hover{color: #f8c100}
        .nav_box .nav_type{
            background: #260707 url("images/sports/head_type_bg_ft.gif") repeat-x;
            border-left: 1px solid #fff;
            padding: 0 10px;
            white-space: nowrap;
        }
        .nav_box .nav_type li{display: none}
        .nav_box .nav_type li.on{display: inline}
        .nav_box .nav_type .list{display: none}
        .nav_box .nav_type .list.on{display: inline}
        .nav_box .nav_type .list li{
            background: url("images/sports/head_nav_arr.gif") no-repeat scroll 0 50%;
            float: left;
            font-size: 12px;
            line-height: 26px;
            text-align: center;
            white-space: nowrap;
            display: inline;
        }
        .nav_box .nav_type .list li:first-child{background: none}
        .nav_box .nav_type .list li.result{background: none;float: right}
        .nav_box .nav_type li a{color: #fff;padding: 0 15px;display: block}
        .nav_box .nav_type li a.cur{color: #f8c100}
        .nav_box .nav_type li a:hover{color: #f8c100}
	</style>
    <script type="text/javascript">
		if(self==top){
			top.location='/';
		}
		function urlOnclick(url){
			window.open(url,"rightFrame");
		}
		function urlrule(){
			window.open("sm/sports.php","_blank");
		}
        function changeMove(obj,type,k) {
            if(type) {
                $(obj).addClass(k+"_1");
            } else {
                if ($("#"+k+"_01_bet").css("display")=="none")
                    $(obj).removeClass(k+"_1");
            }
        }
        function refresh() {
            $.getJSON("/leftDao.php?callback=?", function(d) {
                $("#user_money").text(d.user_money);
            });
        }
	</script>
</head>
<body>
<div class="bodyset">
    <div class="mem_box">
        <div class="mem_info">
            <?php if (isset($_SESSION["uid"],$_SESSION["username"])) { ?>
                <span style="display: block">您好, <?=$_SESSION["username"];?></span>
            <?php } ?>
            <span id="timeZoom" data-now="<?=date('Y/m/d H:i:s',time())?>"></span>
            <script type="text/javascript">
                var timezoom = $("#timeZoom");
                var now = new Date(timezoom.attr("data-now")).valueOf();
                timezoom.removeAttr("data-now");
                (function() {
                    function safeYear(year) {
                        year = year.getYear();
                        if (year < 2000)
                            year += 1900;
                        return year;
                    }
                    function safeDouble(val) {
                        return val > 9 ? val : '0' + val;
                    }
                    function timer() {
                        now += 1000;
                        var nowDate = new Date(now);
                        timezoom.text('美东：' + safeYear(nowDate) + '年' + safeDouble(nowDate.getMonth() + 1) + '月' + safeDouble(nowDate.getDate()) + '日 ' + safeDouble(nowDate.getHours()) + ':' + safeDouble(nowDate.getMinutes()) + ':' + safeDouble(nowDate.getSeconds()));
                    }
                    timer();
                    setInterval(timer, 1000);
                })();
            </script>
        </div>
        <div class="mem_tool">
            <?php if (isset($_SESSION["uid"],$_SESSION["username"])) { ?>
                <div class="mem_main">
                    <span class="his"><a href="javascript:void(0);" onclick="javascript:menu_url(14);return false;">帐户历史</a></span>
                    |
                    <span class="wag"><a href="javascript:void(0);" onclick="javascript:menu_url(13);return false;">交易状况</a></span>
                </div>
                <div class="credit_main">
                    <span id="user_money">¥0.00</span>
                    <input class="re_credit" type="button" value="" onclick="refresh();">
                </div>
            <?php } else { ?>
                <div class="mem_main">
                    <span class="his"><a onclick="alert('请先登录！')" href="javascript:;">帐户历史</a></span>
                    |
                    <span class="wag"><a onclick="alert('请先登录！')" href="javascript:;">交易状况</a></span>
                </div>
                <div class="credit_main">
                    <span>未登录</span>
                    <input class="re_credit" type="button" value=""  onclick="alert('请先登录！')">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="nav_box">
        <ul class="level">
            <li class="rb"><a href="javascript:void(0);">滚球</a></li>
            <li class="today on"><a href="javascript:void(0);">今日赛事</a></li>
            <li class="early"><a href="javascript:void(0);">早盘</a></li>
        </ul>
        <ul class="nav_list">
            <li>
                <div class="list">
                    <ul>
                        <li><span class="ft"><a href="javascript:void(0);">足球<em id="s_zq_gq">(0)</em></a></span></li>
                        <li><span class="bk"><a href="javascript:void(0);">蓝球<em id="s_lm_gq">(0)</em></a></span></li>
                    </ul>
                </div>
            </li>
            <li class="on">
                <div class="list">
                    <ul>
                        <li><span class="ft"><a class="cur" href="javascript:void(0);">足球<em id="s_zq">(0)</em></a></span></li>
                        <li><span class="bk"><a href="javascript:void(0);">蓝球<em id="s_lm">(0)</em></a></span></li>
                        <li><span class="tn"><a href="javascript:void(0);">网球<em id="s_wq">(0)</em></a></span></li>
                        <li><span class="vb"><a href="javascript:void(0);">排球<em id="s_pq">(0)</em></a></span></li>
                        <li><span class="bs"><a href="javascript:void(0);">棒球<em id="s_bq">(0)</em></a></span></li>
                        <li><span><a href="javascript:void(0);" style="padding-left: 10px">其他<em id="s_gj">(0)</em></a></span></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="list">
                    <ul>
                        <li><span class="ft"><a href="javascript:void(0);">足球<em id="s_zqzc">(0)</em></a></span></li>
                        <li><span class="bk"><a href="javascript:void(0);">蓝球<em id="s_lmzc_ds">(0)</em></a></span></li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="nav_type">
            <li>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_gunqiu.html')">足球滚球</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/bk_gunqiu.html')">篮球滚球</a></li>
                    </ul>
                </div>
            </li>
            <li class="on">
                <div class="list on">
                    <ul>
                        <li><a class="cur" href="javascript:void(0);" onclick="urlOnclick('show/ft_danshi.html')">单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_danshi.html')" class="cg">串关单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_shangbanchang.html')">上半场</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_shangbanchang.html')" class="cg">串关上半场</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_bodan.html')">全场波胆</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_shangbanbodan.html')">上半场波胆</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_ruqiushu.html')">独赢 & 总入球</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ft_banquanchang.html')">半场 / 全场</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('result/bet_match.php')">足球赛果</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/bk_danshi.html')">单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/bk_danshi.html')" class="cg">串关单式</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('result/lq_match.php')">篮球赛果</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/tennis_danshi.html')">单式</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('result/tennis_match.php')">网球赛果</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/volleyball_danshi.html')">单式</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('result/volleyball_match.php')">排球赛果</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/baseball_danshi.html')">单式</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('result/baseball_match.php')">棒球赛果</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/guanjun.html')">足球冠军</a></li>
                        <li class="result"><a href="javascript:void(0);" onclick="urlOnclick('show/guanjun_result.php')">冠军赛果</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_danshi.html')">单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_danshi.html')" class="cg">串关单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_shangbanchang.html')">上半场</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_shangbanchang.html')" class="cg">串关上半场</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_bodan.html')">全场波胆</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_shangbanbodan.html')">上半场波胆</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_ruqiushu.html')">独赢 & 总入球</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/ftz_banquanchang.html')">半场 / 全场</a></li>
                    </ul>
                </div>
                <div class="list">
                    <ul>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/bkz_danshi.html')">单式</a></li>
                        <li><a href="javascript:void(0);" onclick="urlOnclick('show/bkz_danshi.html')" class="cg">串关单式</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    var l_a = $(".level a");
    var n_l = $(".nav_list").children("li");
    var n_a = n_l.find("a");
    var t_l = $(".nav_type").children("li");
    var t_a = t_l.find("a");
    l_a.click(function() {
        var p = $(this).parent();
        if(!p.hasClass("on")) {
            p.siblings().removeClass("on").end().addClass("on");
        }
        var p_i = p.index();
        n_l.removeClass("on").eq(p_i).addClass("on");
        n_l.find("a").removeClass("cur").end().filter(".on").find("a:first").addClass("cur");
        t_l.removeClass("on").eq(p_i).addClass("on");
        t_l.children(".list").removeClass("on").end().filter(".on").children(".list:first").addClass("on");
        t_l.find("a").removeClass("cur").end().filter(".on").find("a:first").addClass("cur");
        t_l.filter(".on").find("a.cur:first").click();
    });
    n_a.click(function() {
        if(!$(this).hasClass("cur")) {
            n_a.removeClass("cur");
            $(this).addClass("cur");
        }
        var p_i = $(this).closest("li").index();
        var list = t_l.filter(".on").children(".list");
        list.removeClass("on").eq(p_i).addClass("on");
        list.find("a").removeClass("cur").end().filter(".on").find("a:first").addClass("cur");
        list.filter(".on").find("a.cur:first").click();
    });
    t_a.click(function() {
        if(!$(this).hasClass("cur")) {
            t_a.removeClass("cur");
            $(this).addClass("cur");
        }
        var tt = $(parent.leftFrame.document).find("#touzhutype");
        if($(this).hasClass("cg")) {
            tt.val(1);
        } else {
            tt.val(0);
        }
    });
	setInterval(refresh, 5000);
</script>
<script type="text/javascript" src="js/s_top.js"></script>
<script type="text/javascript" src="js/left_mouse.js"></script>
</body>
</html>