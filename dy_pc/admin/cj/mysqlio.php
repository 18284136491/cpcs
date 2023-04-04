<?php

unset($mysqlio);
$mysqlio = new MySQLi("mysql","root","usbw","lb3_db",3307);
$mysqlio->query("set names utf8");
?>