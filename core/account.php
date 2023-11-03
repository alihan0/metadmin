<?php

require "../class/account.class.php";

if($_POST){
	switch ($_POST['request']) {
		case 'register':
	 		$firstname  = $_POST['firstname'];
	 		$username   = $_POST['username'];
	 		$lastname   = $_POST['lastname'];
	 		$email		= $_POST['email'];
	 		$password	= $_POST['password'];
	 		Account::registerUser(["firstname"=>$firstname,"lastname"=>$lastname,"username"=>$username,"email"=>$email,"password"=>$password]);
	 	break;
	 	case 'login':
	 		$username	= $_POST['username'];
	 		$password	= $_POST['password'];
	 		Account::loginUser(["username"=>$username,"password"=>$password]);
	 	break;
	 	case 'delete':
	 		$id = $_POST["id"];
	 		Account::deleteUser(["id"=>$id]);
	 	break;
	 }
}	