<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddstage")){
	$stageName = $_POST['stageName'] ? $_POST['stageName'] : '';
	$requistionId = $_POST['requistionId'] ? $_POST['requistionId'] : '';
	$checkSql = "select * from tlr_selectionstages where isDeleted = ? and stageName= ? and reqId= ?";
	$checkRow = pdoQuery($checkSql,array('N',$stageName,$requistionId));
	if(count($checkRow)==0){
		$insertSql = "insert into tlr_selectionstages (`stageName`,`reqId`, `isDeleted`) VALUES (?,?,?)";
		$resultRow = pdoQuery($insertSql,array($stageName,$requistionId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	header('location:stagegridmaster.php?message='.md5($message));

}else if($registration == md5("tlreditstage")){

	$stageName = $_POST['stageName'] ? $_POST['stageName'] : '';
	$stageId = $_POST['stageId'] ? $_POST['stageId'] : '';
	$reqId = $_POST['requistionId'] ? $_POST['requistionId'] : '';
	$checkSql = "select * from tlr_selectionstages where isDeleted = ? and stageName= ? and reqId= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$stageName,$reqId,$stageId));
	if(count($checkRow) == 1){
		$editquery = "UPDATE tlr_selectionstages SET stageName = ?, reqId = ? WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($stageName,$reqId,$stageId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from tlr_selectionstages where isDeleted = ? and stageName= ?";
		$checkRow = pdoQuery($checkSql,array('N',$stageName));
		if(count($checkRow)==0){
			$editquery = "UPDATE tlr_selectionstages SET stageName = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($stageName,$stageId,'N'));
		if($resultRow){
				$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:stagegridmaster.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_selectionstages SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:stagegridmaster.php?message='.md5($message));
}else{
		$message = "error";
		header('location:stagegridmaster.php?message='.md5($message));
}

?>