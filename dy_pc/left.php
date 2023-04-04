<?php
@session_start();
include_once("include/config.php");
include_once("include/mysqli.php");
include_once("common/logintu.php");
include_once("class/user.php");
$_SESSION["check_action"] = ''; //检测用户是否用软件打水标识
$uid = @$_SESSION['uid'];
$loginid = @$_SESSION['user_login_id'];
renovate($uid, $loginid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title>Welcome</title>
    <meta http-equiv="Cache-Control" content="max-age=864000"/>
    <script type="text/javascript" src="skin/js2/jquery.js"></script>
    <script type="text/javascript" src="skin/js2/common.js"></script>
    <script type="text/javascript" src="skin/js2/global.js"></script>
    <script type="text/javascript" src="skin/js2/DD_belatedPNG.js"></script>
    <script type="text/javascript" src="skin/js/top.js"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <style type="text/css">
        /* CSS样式表 */
        body {
            margin: 0;
            padding: 0;
            font-family: "微软雅黑", "宋体", Arial;
            color: #783218; /* 菜单字体颜色 */
            position: relative;
            font-size: 12px;
            overflow-x: hidden;
            background-color: #493721;
        }

        /*设立常用标签的外边距，内边距，边框为0，防止在排版时再重复定义和出现怪问题*/
        div, form, ul, ol, li, dl, dt, dd, p, span, img {
            margin: 0;
            padding: 0;
            border: 0;
        }

        /*设立列表样式为无，这样列表前面不带点*/
        li, dl {
            list-style-type: none;
        }

        /*(设立默认全局样式超链接样式)*/
        a {
            text-decoration: none;
            color: #900;
        }

        a:hover {
            text-decoration: underline;
            color: #900;
        }

        /*所有样式*/
        .leftset {
            margin: 0;
            padding: 10px 0 15px;
            text-align: center
        }

        .leftset .main {
            height: auto;
            min-height: 460px;
            overflow: hidden;
            width: 216px;
            margin: 0 auto
        }

        .main .menu {
            background-color: #fef6e4;
            width: 100%;
            height: 42px
        }

        .menu .ord_on {
            background: url("images/sports/order_ord_btn_on.gif") no-repeat scroll left top;
            color: #3b2d1b;
            float: left;
            font-weight: bold;
            height: 32px;
            padding-top: 11px;
            width: 99px;
            cursor: pointer;
        }

        .menu .ord_btn {
            background: url("images/sports/order_ord_btn_out.gif") no-repeat scroll left top;
            color: #e9b567;
            float: left;
            font-weight: bold;
            height: 32px;
            padding-top: 11px;
            width: 99px;
            cursor: pointer;
        }

        .menu .record_btn {
            background: url("images/sports/order_record_btn_out.gif") no-repeat scroll right top;
            color: #e9b567;
            float: right;
            font-weight: bold;
            height: 32px;
            padding-top: 11px;
            width: 117px;
            cursor: pointer;
        }

        .menu .record_on {
            background: url("images/sports/order_record_btn_on.gif") no-repeat scroll right top;
            color: #3b2d1b;
            float: right;
            font-weight: bold;
            height: 32px;
            padding-top: 11px;
            width: 117px;
            cursor: pointer;
        }

        .main .order_div {
            width: 100%;
            background: #e3cfaa url("images/sports/order_none.jpg") no-repeat
        }

        .order_div .tz, .order_div .ls {
            display: none
        }

        .order_div .tz.on, .order_div .ls.on {
            display: block
        }

        .order_div .tz li, .order_div .ls li {
            display: none
        }

        .order_div .tz li.on, .order_div .ls li.on {
            display: block
        }

        .order_div .text {
            text-align: center;
            line-height: 18px;
            font-weight: bold;
            color: #000;
            padding: 70px 0 50px 0
        }

        .main .tit {
            height: 30px;
            line-height: 30px;
            background: url("images/sports/order_msg_tit.gif") no-repeat;
            color: #e9b567;
            font-weight: bold;
            padding: 0 10px;
            text-align: left;
            position: relative;
        }

        .main .tit a {
            color: #fff;
            float: right;
            text-decoration: none
        }

        .main .tit a:hover {
            color: #f8c100
        }

        .main .list {
            background-color: #dfcca8;
            color: #2f2f2f;
            border-left: 1px solid #846d52;
            border-bottom: 1px solid #856c4e;
            border-right: 1px solid #977f62;
        }

        .main .gq_div, .main .info_div {
            margin-top: 15px;
            text-align: left
        }

        .gq_div .list a {
            display: block;
            height: 32px;
            line-height: 32px;
            color: #2f2f2f;
            padding-left: 35px
        }

        .gq_div .list a:hover {
            text-decoration: none
        }

        .gq_div .list em {
            font-style: normal;
            margin-left: 3px
        }

        .gq_div .list a.zq {
            background: url("images/sports/oly_tr_ft.gif") no-repeat;
            border-bottom: 1px solid #856c4e
        }

        .gq_div .list a.zq:hover {
            background-position: 0 -32px
        }

        .gq_div .list a.lq {
            background: url("images/sports/oly_tr_bk.gif") no-repeat
        }

        .gq_div .list a.lq:hover {
            background-position: 0 -32px
        }

        .info_div .m-left {
            padding: 5px 10px;
            cursor: pointer
        }

        .info_div .m-left li {
            padding-bottom: 10px
        }

        .tz_xp {
            display: none;
            margin: 0;
            padding: 22px 0 10px;
            text-align: left;
            color: #302706;
            line-height: 26px
        }

        .tz_xp .tz_left {
            padding: 0 4px
        }

        .tz_left .tz_uid {
        }

        .tz_left .tz_div {
        }

        .tz_left .match_sort {
            background: #f1e3c6 url("images/sports/order_h1_ft.jpg") repeat-x scroll left top;
            color: #2f2f2f;
            height: 22px;
            line-height: 22px;
            padding-left: 5px;
            font-weight: bold;
        }

        .tz_left .match_name {
            background-color: #cfc0a1;
            border-left: 1px solid #937b52;
            border-top: 1px solid #937b52;
            border-right: 1px solid #937b52;
            line-height: 18px;
            padding-left: 5px;
        }

        .tz_left .match_master {
            background-color: #e1d6c2;
            padding-left: 5px;
            border-left: 1px solid #937b52;
            border-right: 1px solid #937b52;
        }

        .tz_left .match_master .match_vs {
            color: red
        }

        .tz_left .match_info {
            background-color: #e1d6c2;
            padding-left: 5px;
            border-left: 1px solid #937b52;
            border-right: 1px solid #937b52;
        }

        .tz_left .match_info.cg{
            border-top: 1px solid #937b52;
            border-bottom: 1px solid #937b52;
            margin-bottom: 5px;
        }

        .tz_left .tz_money {
            background-color: #e1d6c2;
            padding-left: 5px;
            border-left: 1px solid #937b52;
            border-right: 1px solid #937b52;
            border-bottom: 1px solid #937b52;
        }

        .tz_left .tz_money.cg{
            border-top: 1px solid #937b52;
            padding-top: 5px;
        }

        .tz_left .tz_money span {
            display: block
        }

        .tz_left .tz_money .tou_red {
            color: red;
            font-style: normal
        }

        .tz_left .tz_ok {
            display: none;
            color: #F00;
            text-align: center;
            line-height: 25px;
        }

        .tz_left .tz_btn {
            height: 26px;
            margin: 5px 0;
        }

        .tz_left .quxiao {
            background: #3d3d3d url("images/sports/order_btn.gif") no-repeat scroll 0 -80px;
            border: none;
            border-radius: 0;
            color: #fff;
            cursor: pointer;
            float: left;
            font-weight: bold;
            height: 26px;
            margin: 0 1px 0 0;
            width: 85px;
        }

        .tz_left .queren {
            background: #3d3d3d url("images/sports/order_btn.gif") no-repeat;
            border: none;
            border-radius: 0;
            color: #f8c100;
            cursor: pointer;
            float: left;
            font-weight: bold;
            height: 26px;
            margin: 0;
            width: 122px;
        }

        .tz_left .tz_info {
            background-color: #e1d6c2;
            border: 1px solid #937b52;
            padding: 5px;
        }
    </style>
    <script type="text/javascript">
        if (isLessIE6)DD_belatedPNG.fix('*');
        if (self == top) {
            top.location = '/';
        }
        function urlOnclick(url) {
            window.open(url, "rightFrame");
        }
        function urlrule() {
            window.open("sm/sports.php", "_blank");
        }
        function changeMove(obj, type, k) {
            if (type) {
                $(obj).addClass(k + "_1");
            } else {
                if ($("#" + k + "_01_bet").css("display") == "none") {
                    $(obj).removeClass(k + "_1");
                }
            }
        }
        function frmSub() {
            if ($('#cg_msg').css('display') != 'none') {
                if (parseInt($('#cg_num').html(), 10) >= 2) {
                    return check_bet();
                } else {
                    alert('投注失败，请至少选择2场比赛后再进行投注！');
                    return false;
                }
            } else {
                return check_bet();
            }
        }
    </script>
</head>
<body>
<div class="leftset">
    <?php if (isset($_SESSION["uid"], $_SESSION["username"])) { ?>
        <div id="userinfo" style="display:none"><span id="user_money">0.00</span></div>
    <?php } ?>
    <div class="main">
        <div class="menu">
            <div class="ord_on">交易单</div>
            <div class="record_btn" onclick="javascript:menu_url(13);return false;">投注记录</div>
        </div>
        <div class="order_div">
            <div class="tz on">
                <ul>
                    <li class="text on">点击赔率便可将<br>选项加到交易单里。</li>
                    <li>
                        <div id="xp" class="tz_xp">
                            <div id="left" class="tz_left">
                                <div id="usersid" class="tz_uid">会员帐号：<?= $_SESSION["username"]; ?></div>
                                <form action="bet.php" name="form1" id="form1" method="post"
                                      onsubmit="return frmSub();">
                                    <input type="hidden" name="touzhutype" id="touzhutype" value="0"/>

                                    <div id="cg_msg" style="display:none;">已选择 <span id="cg_num"
                                                                                     style="color:red;"></span> 场赛事
                                    </div>
                                    <div id="touzhudiv"></div>
                                    <div class="tz_money">
                                        <span>交易金额：<input type="text" class="tou_input" name="bet_money" id="bet_money"
                                                          autocomplete="off" maxlength="5"
                                                          onkeypress="if((event.keyCode<48 || event.keyCode>57))event.returnValue=false"
                                                          onkeydown="if(event.keyCode==13)return check_bet();"
                                                          onpaste="return false" oncontextmenu="return false"
                                                          oncopy="return false" oncut="return false" size="8"/></span>
                                        <span>可赢金额：<em id="win_span" class="tou_red">0.00</em><input type="hidden"
                                                                                                     value="0"
                                                                                                     name="bet_win"
                                                                                                     id="bet_win"/></span>
                                    </div>
                                    <div id="istz" class="tz_ok">返还金额：<span id="win_span1">0.00</span><br>是否确定交易？</div>
                                    <div class="tz_btn">
                                        <input class="quxiao" type="button" onclick="quxiao_bet()" value="取消交易"/><input
                                            class="queren" id="submitid" type="submit" value="确定交易"/>
                                    </div>
                                    <div class="tz_info">
                                        <?php
                                        include_once("cache/group_" . @$_SESSION["gid"] . ".php"); //加载权限组权限
                                        $ty_zd = @$pk_db['体育最低'];
                                        if ($ty_zd > 0) {
                                            $ty_zd = $ty_zd;
                                        } else {
                                            $ty_zd = 10;
                                        }
                                        ?>
                                        <p>最低限额：<span id="min_ty"><?= $ty_zd ?></span></p>

                                        <p>单注限额：<span id="max_ds_point_span">0</span></p>

                                        <p>单场最高：<span id="max_cg_point_span">0</span></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ls">
                <ul>
                    <li class="text on">您没有未结算的交易。</li>
                </ul>
            </div>
        </div>
        <div class="gq_div">
            <div class="tit">滚球</div>
            <div class="list">
                <a href="javascript:void(0);" onclick="ch_gq('zq')" class="zq">足球<em id="s_zq_gq">(0)</em></a>
                <a href="javascript:void(0);" onclick="ch_gq('lq')" class="lq">蓝球<em id="s_lm_gq">(0)</em></a>
            </div>
        </div>
        <div class="info_div">
            <div class="tit">公告<a href="javascript:void(0);"
                                  onclick="showNewWin('/result/noticle.php', 800, 600)">更多</a></div>
            <div class="list">
                <div id="m-left" class="m-left" onclick="showNewWin('/result/noticle.php', 800, 600)">
                    <div class="bd">
                        <ul>
                            <?php
                            $sql = "select add_time,msg from k_notice where is_show=1 order by `sort` desc,nid desc limit 0,1";
                            $query = $mysqli->query($sql);
                            $str = "";
                            while ($row = $query->fetch_array()) {
                                $str .= "<li>" . $row["msg"] . "</li>";
                            }
                            echo $str;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#m-left").slide({mainCell: ".bd ul", autoPlay: true, effect: "topMarquee", interTime: 100});
    var l_a = $(parent.topFrame.document).find(".rb a");
    function ch_gq(type) {
        var l_p = l_a.parent();
        if (!l_p.hasClass("on")) {
            l_p.siblings().removeClass("on").end().addClass("on");
        }
        var l_i = l_p.index();
        var n_l = l_p.parent().siblings(".nav_list").children();
        if (!n_l.eq(l_i).hasClass("on")) {
            n_l.removeClass("on").eq(l_i).addClass("on");
        }
        n_l.find("a").removeClass("cur");
        if (type == "zq") {
            n_l.eq(l_i).find("a:eq(0)").addClass("cur");
        } else {
            n_l.eq(l_i).find("a:eq(1)").addClass("cur");
        }
        var t_l = l_p.parent().siblings(".nav_type").children();
        if (!t_l.eq(l_i).hasClass("on")) {
            t_l.removeClass("on").eq(l_i).addClass("on");
        }
        t_l.children(".list").removeClass("on").find("a").removeClass("cur");
        if (type == "zq") {
            t_l.eq(l_i).children(".list:eq(0)").addClass("on").find("a:first").addClass("cur").click();
        } else {
            t_l.eq(l_i).children(".list:eq(1)").addClass("on").find("a:first").addClass("cur").click();
        }
    }
    $.getJSON("/leftDao.php?callback=?", function (json) {
        $("#user_money").html(json.user_money);
        $("#s_zq_gq").html("(" + json.zq_gq + ")");
        $("#s_lm_gq").html("(" + json.lm_gq + ")");
    });
</script>
<script type="text/javascript" src="js/touzhu.js"></script>
<script type="text/javascript" src="js/left_mouse.js"></script>
</body>
</html>