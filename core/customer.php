<?php

require "../class/customer.class.php";

if($_POST){
	switch ($_POST['request']) {
		case 'add':
	 		$firstname  = $_POST['firstname'];
	 		$phone      = $_POST['phone'];
	 		$lastname   = $_POST['lastname'];
	 		$ilce		= $_POST['ilce'];
	 		$il  		= $_POST['il'];
	 		$address	= $_POST['address'];
	 		Customer::addCustomer(["firstname"=>$firstname,"lastname"=>$lastname,"phone"=>$phone,"il"=>$il, "ilce"=>$ilce, "address"=>$address]);
	 	break;
	 	case 'update':
	 		$firstname  = $_POST['firstname'];
	 		$phone      = $_POST['phone'];
	 		$lastname   = $_POST['lastname'];
	 		$ilce		= $_POST['ilce'];
	 		$il  		= $_POST['il'];
	 		$address	= $_POST['address'];
	 		$id 		= $_POST['id'];
	 		Customer::updateCustomer(["id"=>$id,"firstname"=>$firstname,"lastname"=>$lastname,"phone"=>$phone,"il"=>$il, "ilce"=>$ilce, "address"=>$address]);
	 	break;
	 	case 'delete':
	 		$id = $_POST["id"];
	 		Customer::deleteCustomer(["id"=>$id]);
	 	break;
	 }
}	