<?php
require_once("lefupay_function.php");
class lefupay_notify{
	function notify_verify($key,$signType){
		if(empty($_POST)) {
		return false;
	}else{
		$post          = para_filter($_POST);
		$sort_post     = arg_sort($post);
		$mysign  = build_mysign($sort_post,$key,$signType);
		if ($mysign == $_POST["sign"]){
			return true;
		}else{
			return false;
		}
	}
}

function return_verify($key,$signType){
	if(empty($_GET)) {
		return false;
	}else {
		$post          = para_filter($_GET);
		$sort_post     = arg_sort($post);
		$mysign  = build_mysign($sort_post,$key,$signType);
	if ($mysign == $_GET["sign"]) {
		return true;
	}else {
	return false;
	}
}
}
}
?>