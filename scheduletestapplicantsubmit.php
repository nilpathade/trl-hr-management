<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddscheduletest")){
	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '1';
	$scheduletestId = $_POST['scheduletestId'] ? $_POST['scheduletestId'] : '';
	$startDate = $_POST['startDate'] ? $_POST['startDate'] : '';
	$endDate = $_POST['endDate'] ? $_POST['endDate'] : '';
	$createdBy = $_SESSION['menuid'];
	$checkSql = "select * from ltr_schedule_test_applicant where isDeleted = ? and applicantId= ? and testScheduleId= ? and startDate= ? and endDate= ?";
	$checkRow = pdoQuery($checkSql,array('N',$applicantId,$scheduletestId,$startDate,$endDate));
	if(count($checkRow)==0){
		$insertSql = "insert into ltr_schedule_test_applicant (`applicantId`,`testScheduleId`,`startDate`,`endDate`,`createdBy`, `isDeleted`) VALUES (?,?,?,?,?,?)";
		$resultRow = pdoQuery($insertSql,array($applicantId,$scheduletestId,$startDate,$endDate,$createdBy,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	header('location:scheduletestgridapplicant.php?message='.md5($message));

}else if($registration == md5("tlreditscheduletest")){

	$scheduleId = $_POST['scheduleId'] ? $_POST['scheduleId'] : '';
	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$scheduletestId = $_POST['scheduletestId'] ? $_POST['scheduletestId'] : '';
	$startDate = $_POST['startDate'] ? $_POST['startDate'] : '';
	$endDate = $_POST['endDate'] ? $_POST['endDate'] : '';
	$createdBy = $_SESSION['menuid'];
	$checkSql = "select * from ltr_schedule_test_applicant where isDeleted = ? and applicantId= ? and testScheduleId= ? and startDate= ? and endDate= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$applicantId,$scheduletestId,$startDate,$endDate,$scheduleId));
	if(count($checkRow) == 1){
		$editquery = "UPDATE ltr_schedule_test_applicant SET testName = ?, testUrl = ?, createdBy= ? WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($testName,$testUrl,$createdBy,$testId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from ltr_schedule_test_applicant where isDeleted = ? and applicantId= ? and testScheduleId= ? and startDate= ? and endDate= ?";
		$checkRow = pdoQuery($checkSql,array('N',$applicantId,$scheduletestId,$startDate,$endDate));
		if(count($checkRow)==0){
			$editquery = "UPDATE ltr_schedule_test_applicant SET applicantId = ?, testScheduleId = ?, startDate = ?, endDate = ?, createdBy= ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($applicantId,$scheduletestId,$startDate,$endDate,$createdBy,$scheduleId,'N'));
		if($resultRow){
				$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:scheduletestgridapplicant.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE ltr_schedule_test_applicant SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:scheduletestgridapplicant.php?message='.md5($message));
}else{
		$message = "error";
		header('location:scheduletestgridapplicant.php?message='.md5($message));
}

?>