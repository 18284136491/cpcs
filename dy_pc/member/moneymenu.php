<?php
include_once("zr_conf.php"); 
?>
<div class="nav">
	<ul>
    	<li <?=$sub==7?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>hk_money.php');return false">会员存款</a></li>
		<li <?=$sub==1?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>set_money.php');return false">在线存款</a></li>
		<li <?=$sub==2?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>get_money.php');return false">提取现金</a></li>
        <?php if($zr_open==1){ ?>
		<li <?=$sub==4?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>zr_money.php');return false">娱乐场转帐</a></li>
		<?php } ?>
        <li <?=$sub==6?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>set_jifen.php');return false">积分兑换</a></li>
		<li <?=$sub==3?"class='current'":""?>><a href="javascript:void(0);" onclick="Go('<?=$full_url?>data_money.php');return false">财务明细</a></li>
	</ul>
</div>