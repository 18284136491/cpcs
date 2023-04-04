<?php

unset($mysqlis);
$mysqlis = new MySQLi("mysql","root","root","dy4_db");
$mysqlis->query("set names utf8");
?>