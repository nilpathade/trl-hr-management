<?php
require_once('header/dbconnection.php');
error_reporting(1);
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlrassignadd")){
	$requisitionsId = $_POST['requisitionsId'] ? $_POST['requisitionsId'] : '';
	$roleType = $_POST['roleType'] ? $_POST['roleType'] : '';
	$roleslist = $_POST['roleslist'] ? $_POST['roleslist'] : '';
	$memberlist = $_POST['memberlist'] ? $_POST['memberlist'] : '';
	$updateBy = encrypt_decrypt('decrypt',$_SESSION['userid']);
	$today=date('Y-m-d H:i:s');
	$status=$_POST['status'] ? $_POST['status'] : '1';
	$reAssigned = $_POST['reassigned'] ? $_POST['reassigned'] : '';
	foreach($memberlist as $memberid){
		$insertSql = "insert into tlr_assignteam (`sourceId`, `requisitionId`, `roleType`, `roleId`, `status`, `reAssigned`, `updatedBy`, `updatedDate`,`isDeleted`) VALUES (?,?,?,?,?,?,?,?,?)";
		$resultRow = $assignId = pdoQuery($insertSql,array($memberid,$requisitionsId,$roleType,$roleslist,$status,$reAssigned,$updateBy,$today,'N'));
		sleep(1);
		if($resultRow){
			$assignSql = "select * from tlr_assignteam where isDeleted = ? order by id DESC limit 1";
			$assignResult = pdoQuery($assignSql,array('N'));
			$assignId = $assignResult[0]['id'];
		}
	 $logSql = "insert into tlr_assignteam_log (`assignteamId`, `status`, `reAssigned`, `updatedBy`) VALUES (?,?,?,?)";
	 $logRow = pdoQuery($logSql,array($assignId,$status,$reAssigned,$updateBy));
	}
	if($resultRow){
		$message = "success";
		/*$menuid = $_SESSION['menuid'];
		$menuSql = "insert into tlr_menu_page_rel (`adminId`, `menuId`, `accessId`, `priorityOrder`, `isDeleted`) VALUES (?,?,?,?,?)";
		$menuRow = pdoQuery($menuSql,array($menuid,'17','2','5','N'));*/
		}else{
			$message = "error";
		}
	header('location:assigngridrecruiters.php?message='.md5($message));

}else if($registration == md5("tlrassignedit")){

	$assignId = $_POST['assignId'] ? $_POST['assignId'] : '';
	$requisitionsId = $_POST['requisitionsId'] ? $_POST['requisitionsId'] : '';
	$roleType = $_POST['roleType'] ? $_POST['roleType'] : '';
	$roleslist = $_POST['roleslist'] ? $_POST['roleslist'] : '';
	$memberlist = $_POST['memberlist'] ? $_POST['memberlist'] : '';
	$updateBy = encrypt_decrypt('decrypt',$_SESSION['userid']);
	$today=date('Y-m-d H:i:s');
	$status=$_POST['status'] ? $_POST['status'] : '1';
	$reAssigned = $_POST['reassigned'] ? $_POST['reassigned'] : '';
	print_r($_POST);
	$checkSql = "select * from tlr_assignteam where requisitionId=? and isDeleted= ?";
	$checkResult = pdoQuery($checkSql,array($requisitionsId,'N'));
	foreach($checkResult as $checkValue){
		$temp = 0;
		foreach($memberlist as $memberid){
			if($checkValue['id'] == $memberid){
				$editquery = "UPDATE tlr_assignteam SET `roleType` = ?,`roleId` = ?,`status` = ?,`reAssigned` = ?,`updatedBy` = ?,`updatedDate` = ? WHERE `requisitionId` = ? and id = ? and `isDeleted` = ?";
				$resultRow = pdoQuery($editquery,array($roleType,$roleslist,$status,$reAssigned,$updateBy,$today,$requisitionsId,$memberid,'N'));
				sleep(1);
				$logSql = "insert into tlr_assignteam_log (`assignteamId`, `status`, `reAssigned`, `updatedBy`) VALUES (?,?,?,?)";
				$logRow = pdoQuery($logSql,array($memberid,$status,$reAssigned,$updateBy));
				$temp =1;
			}
		}
		if($temp == 0){
			echo $checkValue['id'];
			$deleteSql = "UPDATE tlr_assignteam SET isDeleted = ?, `updatedBy` = ?,`updatedDate` = ? where `requisitionId` = ? and id = ? and `isDeleted` = ?";
			$deleteRow = pdoQuery($deleteSql,array('Y',$updateBy,$today,$requisitionsId,$checkValue['id'],'N'));
			sleep(1);
			$logSql = "insert into tlr_assignteam_log (`assignteamId`, `status`, `reAssigned`, `updatedBy`) VALUES (?,?,?,?)";
			$logRow = pdoQuery($logSql,array($checkValue['id'],$status,$reAssigned,$updateBy));
		}
		
	}
	if($resultRow){
		$message = "success";
		}else{
			$message = "error";
		}
	header('location:assigngridrecruiters.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_assignteam SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:assigngridrecruiters.php?message='.md5($message));
}else{
		$message = "error";
		header('location:assigngridrecruiters.php?message='.md5($message));
}
	
?>