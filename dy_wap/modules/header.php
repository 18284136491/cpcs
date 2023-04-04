<div class="header">
    <div class="container-fluid pd_lr_5">
        <div class="f_l"><a href="/"><img src="images/dy/logo.png" height="50"></a></div>
        <div class="f_r">
            <?php if(empty($_SESSION["uid"]) || empty($_SESSION["username"])) { ?>
                <a href="/login.php">登录</a>
                <a href="/myreg.php">注册</a>
                <a href="javascript:void(0);" onclick="g_login();">试玩</a>
            <?php } elseif($_SESSION["username"] == 'guest') { ?>
                <a>试玩模式</a>
                <a href="/logout.php">退出</a>
            <?php } else { ?>
                <a href="/member/userinfo.php"><?=$_SESSION["username"]?></a>
                <a href="/logout.php">退出</a>
            <?php } ?>
        </div>
    </div>
</div>