<?php
    session_start();
	unset($_SESSION["uid"]);
	unset($_SESSION["is_daili"]);
	unset($_SESSION["gid"]); 
	unset($_SESSION["username"]);
	unset($_SESSION['user_login_id']);	
?>
<script>window.open('/','_top')</script>
