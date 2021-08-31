<?php
require_once('header/dbconnection.php');
$email = $_POST['email'] ? $_POST['email'] : '';
if(!empty($email)){
	$loginSql = "select * from tlr_client where email = ? and isDeleted= ?";
	$resultRow = pdoQuery($loginSql,array($email'N'));
	if(count($resultRow) == 0){
		$loginSql = "select * from tlr_sourcingteam where email = ? and isDeleted= ?";
		$resultRow = pdoQuery($loginSql,array($email'N'));
	}
	if(count($resultRow) > 0){
		
	}
}else{
	$message = MD5('error');
	header('location:login.php?message='.$message);
	die;
}

?>