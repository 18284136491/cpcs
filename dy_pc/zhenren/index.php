<?php
include_once("../cache/website.php");
include_once("../include/mysqli.php");
include ("../include/config.php");

$mycode = 'zryl';
$mysql = "select * from webinfo where code='".$mycode."' limit 1";
$myquery = $mysqli->query($mysql);
$myrows = $myquery->fetch_array();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?=$web_site['web_name']?>-真人娱乐</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
        html { margin: 0; padding: 0; width: 100%; height: 100%; }
        body { margin: 0; padding: 0; width: 100%; height: 100%; }
    </style>
</head>
<body>
	<iframe id="live" name="live" width="100%" height="100%" scrolling="no" frameborder="0" src="<?php echo $myrows["content"] ?>" allowtransparency="true"></iframe>
</body>
</html>