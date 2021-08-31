<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddrole")){
	$roleName = $_POST['rolename'] ? $_POST['rolename'] : '';
	$roleType = $_POST['roletype'] ? $_POST['roletype'] : '';
	$checkSql = "select * from tlr_rolemaster where isDeleted = ? and roleName= ?";
	$checkRow = pdoQuery($checkSql,array('N',$roleName));
	if(count($checkRow)==0){
		$insertSql = "insert into tlr_rolemaster (`roleName`, `roleType`, `isDeleted`) VALUES (?,?,?)";
		$resultRow = pdoQuery($insertSql,array($roleName,$roleType,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	header('location:rolemasterregistration.php?message='.md5($message));

}else if($registration == md5("tlreditrole")){

	$roleName = $_POST['rolename'] ? $_POST['rolename'] : '';
	$roleType = $_POST['roletype'] ? $_POST['roletype'] : '';
	$roleId = $_POST['roleId'] ? $_POST['roleId'] : '';
	$editquery = "UPDATE tlr_rolemaster SET roleName = ?,`roleType` = ? WHERE `id` = ? and `isDeleted` = ?";
	$resultRow = pdoQuery($editquery,array($roleName,$roleType,$roleId,'N'));
	if($resultRow){
		$message = "success";
		}else{
			$message = "error";
		}
	header('location:rolemastergridregistration.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_rolemaster SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:rolemastergridregistration.php?message='.md5($message));
}else{
		$message = "error";
		header('location:rolemastergridregistration.php?message='.md5($message));
}

?>