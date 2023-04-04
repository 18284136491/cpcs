<div id="u_nav" style="display: none">
    <ul class="u_bar">
        <li>
            <span>账号：<?=$_SESSION['username']?><br>余额：<em id="money"><?=$userinfo['money']?> 元</em></span>
        </li>
        <li><a href="/main.php">主　　页</a> <i class="icon-angle-right"></i></li>
        <?php if($_SESSION['username'] == 'guest') { ?>
            <li><a href="/myreg.php">正式开户</a> <i class="icon-angle-right"></i></li>
        <?php } else { ?>
            <li><a href="/member/set_money.php">在线充值</a> <i class="icon-angle-right"></i></li>
            <li><a href="/member/get_money.php">在线提款</a> <i class="icon-angle-right"></i></li>
            <li><a href="/member/data_money.php">存取记录</a> <i class="icon-angle-right"></i></li>
        <?php } ?>
        <li><a href="/member/userinfo.php">会员资料</a> <i class="icon-angle-right"></i></li>
        <li><a href="/member/password.php">修改密码</a> <i class="icon-angle-right"></i></li>
        <li><a href="/member/record_ss.php">未结明细</a> <i class="icon-angle-right"></i></li>
        <li><a href="/member/cha_cp.php?rad=ygsds&cn_begin=<?=$t_day?>&cn_end=<?=$t_day?>&t=y">今日已结</a> <i class="icon-angle-right"></i></li>
        <?php if($_SESSION['username'] != 'guest') { ?>
            <li><a href="/member/report.php">账户历史</a> <i class="icon-angle-right"></i></li>
        <?php } ?>
        <li><a href="javascript:void(0);" onclick="gm_open(<?=$gm?>);">历史开奖</a> <i class="icon-angle-right"></i></li>
        <li><a href="javascript:void(0);" onclick="gm_rules(<?=$gm?>);">游戏规则</a> <i class="icon-angle-right"></i></li>
		<li><a href="http://api.pop800.com/chat/248315" target="_blank">在线客服</a> <i class="icon-angle-right"></i></li>
        <li><a href="/logout.php">安全退出</a> <i class="icon-angle-right"></i></li>
    </ul>
</div>