<?php
$msg    =    "";
$sql    =    "select msg from k_notice where end_time>now() and is_show=1 order by sort desc,nid desc limit 0,5";
$query    =    $mysqli->query($sql);
while($rs = $query->fetch_array()){
    $msg    .=    $rs['msg']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
<div class="head">
    <div class="top">
        <div class="w1020">
            <div class="time">官方网站：www.fyl99.com</div>
            <div class="top_news">
                <div class="tnews_ico"></div>
                <a href="javascript:void(0)" class="prev"></a>
                <a href="javascript:void(0)" class="next"></a>
                <div class="bd">
                    <ul>
                        <li><a href="javascript:void(0)">持有菲律宾执照·业界赔率最高！</a></li>
                        <li><a href="javascript:void(0)">支持微信在线扫码支付！</a></li>
                        <li><a href="javascript:void(0)">幸运飞艇正式上线！</a></li>
                    </ul>
                </div>
            </div>
            <div class="top_right">
                <a href="/login.php">[登录]</a>
                <a href="/myreg.php">[注册]</a>
                <a href="/guest.php">[试玩]</a>
            </div>
        </div>
    </div>
    <div class="nav">
        <div class="w1020">
            <div class="logo"><a href="/"><img src="newindex/dy/logo.png"></a></div>
            <div class="top_nav">
                <ul>
                    <li>
                        <a href="/">网站首页</a>
                    </li>
                    <li>
                        <a href="#">彩票中心<em></em></a>
                        <div class="nav_show">
                            <div class="w1020">
                                <div class="list" onclick="location.href='/main.php?t=4'">
                                    <div class="list_top">
                                        <div class="top_ico1"></div>
                                        <div class="top_text">
                                            <span>北京赛车PK10</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                                <div class="list" onclick="location.href='/main.php?t=5'">
                                    <div class="list_top">
                                        <div class="top_ico2"></div>
                                        <div class="top_text">
                                            <span>幸运飞艇</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                                <div class="list" onclick="location.href='/main.php?t=1'">
                                    <div class="list_top">
                                        <div class="top_ico3"></div>
                                        <div class="top_text">
                                            <span>重庆时时彩</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                                <div class="list" onclick="location.href='/main.php?t=7'">
                                    <div class="list_top">
                                        <div class="top_ico4"></div>
                                        <div class="top_text">
                                            <span>广东快乐十分</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                                <div class="list" onclick="location.href='/main.php?t=6'">
                                    <div class="list_top">
                                        <div class="top_ico5"></div>
                                        <div class="top_text">
                                            <span>极速赛车</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                                <div class="list" onclick="location.href='/main.php?t=11'">
                                    <div class="list_top">
                                        <div class="top_ico6"></div>
                                        <div class="top_text">
                                            <span>六合彩</span>
                                            <i>GO</i>
                                        </div>
                                    </div>
                                    <div class="list_bottom">进入游戏</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="nav_links" href="/myreg.php">开户注册</a>
                    </li>
                    <li>
                        <a class="nav_links" href="/myagent.php">代理加盟</a>
                    </li>
                    <li>
                        <a class="nav_links" target="_blank" href="http://m.fyl99.com">手机投注</a>
                    </li>
                    <li>
                        <a class="nav_links" href="/myhot.php">优惠活动</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery(".top_news").slide({mainCell: ".bd ul", autoPlay: true, effect: "topLoop"});
        $(function() {
            $(".top_nav li").hover(function() {
                $(this).children(".nav_show").show();
            }, function() {
                $(this).children(".nav_show").hide();
            });
        });
    </script>
</div>