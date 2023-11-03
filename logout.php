<?php

session_start();
ob_start();

require 'config/db.php';
$date = date("Y-m-d H:i");
$log = $db->prepare("INSERT INTO logs SET
	user = ?,
	log_text = ?,
	created_at = ?");
	$insert = $log->execute(array(
	    $_SESSION['uid'],
	    "Çıkış Yapıldı",
	    $date
	));
session_destroy();
header("location:index.php");