<?php
require_once('header/dbconnection.php');
$email = $_POST['email'] ? $_POST['email'] : '';
$password = $_POST['password'] ? $_POST['password'] : '';
if(!empty($email) && !empty($password)){
	$password = MD5($password);
	$loginSql = "select * from tlr_client where email = ? and password = ? and isDeleted= ?";
	$resultRow = pdoQuery($loginSql,array($email,$password,'N'));
	if(count($resultRow) == 0){
		$loginSql = "select * from tlr_sourcingteam where email = ? and password = ? and isDeleted= ?";
		$resultRow = pdoQuery($loginSql,array($email,$password,'N'));
	}
	if(count($resultRow) == 0){
		$loginSql = "select * from tlr_applicants where email = ? and password = ? and isDeleted= ?";
		$resultRow = pdoQuery($loginSql,array($email,$password,'N'));
	}
	if(count($resultRow) > 0){
		$username = $resultRow[0]['clientName'] ? $resultRow[0]['clientName']: $resultRow[0]['firstName'];
		$userid = encrypt_decrypt('encrypt',$resultRow[0]['id']);
		if(empty($resultRow[0]['cltId'])){
			if(empty($resultRow[0]['sctId'])){
				if(!empty($resultRow[0]['applicationNo'])){

					$menuid = $resultRow[0]['applicationNo'];
					$username = $resultRow[0]['name'];
					$profilepage = md5("applicant");
				}
			}else{
				$menuid = $resultRow[0]['sctId'];
				$profilepage = md5("source");
			}
		}else{
			$menuid = $resultRow[0]['cltId'];
			$profilepage = md5("client");
		}
		session_regenerate_id();
		$_SESSION['loggedin'] = true;
		$_SESSION['name'] = $username;
		$_SESSION['userid'] = $userid;
		$_SESSION['menuid'] = $menuid;
		$_SESSION['profilepage'] = $profilepage;
		header('location:dashboard.php');
		die;
	}else{
		$message = MD5('error');
		header('location:login.php?message='.$message);
		die;
	}
}else{
	$message = MD5('error');
	header('location:login.php?message='.$message);
	die;
}

?>
