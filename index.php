<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if(!isset($_SESSION['login'])){
	header("location:login.php");
}else{
	header("location:main.php");
}