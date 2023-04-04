<?php
$C_Patch=$_SERVER['DOCUMENT_ROOT'];
@include_once($C_Patch."/cache/website.php");
@include_once($C_Patch."/cache/conf.php");

if($web_site['close'] == 1) {
	header("Content-type: text/html; charset=utf-8");
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo $web_site['why'];
    exit();
} else {
	header("Location: /");
}
?>