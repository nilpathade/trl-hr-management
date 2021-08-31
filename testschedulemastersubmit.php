<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddtest")){
	$testName = $_POST['testName'] ? $_POST['testName'] : '';
	$testUrl = $_POST['testUrl'] ? $_POST['testUrl'] : '';
	$createdBy = $_SESSION['menuid'];
	$checkSql = "select * from tlr_test_schedule_master where isDeleted = ? and testName= ? and testUrl= ?";
	$checkRow = pdoQuery($checkSql,array('N',$testName,$testUrl));
	if(count($checkRow)==0){
		$insertSql = "insert into tlr_test_schedule_master (`testName`,`testUrl`,`createdBy`, `isDeleted`) VALUES (?,?,?,?)";
		$resultRow = pdoQuery($insertSql,array($testName,$testUrl,$createdBy,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	header('location:testschedulegridmaster.php?message='.md5($message));

}else if($registration == md5("tlredittest")){

	$testName = $_POST['testName'] ? $_POST['testName'] : '';
	$testId = $_POST['testId'] ? $_POST['testId'] : '';
	$testUrl = $_POST['testUrl'] ? $_POST['testUrl'] : '';
	$createdBy = $_SESSION['menuid'];
	$checkSql = "select * from tlr_test_schedule_master where isDeleted = ? and testName= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$testName,$testId));
	if(count($checkRow) == 1){
		$editquery = "UPDATE tlr_test_schedule_master SET testName = ?, testUrl = ?, createdBy= ? WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($testName,$testUrl,$createdBy,$testId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from tlr_test_schedule_master where isDeleted = ? and testName= ?";
		$checkRow = pdoQuery($checkSql,array('N',$testName));
		if(count($checkRow)==0){
			$editquery = "UPDATE tlr_test_schedule_master SET testName = ? , createdBy= ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($testName,$createdBy,$testId,'N'));
		if($resultRow){
				$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:testschedulegridmaster.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_test_schedule_master SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:testschedulegridmaster.php?message='.md5($message));
}else{
		$message = "error";
		header('location:testschedulegridmaster.php?message='.md5($message));
}

?>