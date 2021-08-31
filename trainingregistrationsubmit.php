<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddtrainingsubmit")){
	$firstname = $_POST['firstname'] ? $_POST['firstname'] : '';
	$lastname = $_POST['lastname'] ? $_POST['lastname'] : '';
	$email = $_POST['email'] ? $_POST['email'] : '';
	$password = $_POST['password'] ? $_POST['password'] : '';
	$confirmpassword = $_POST['confirmpassword'] ? $_POST['confirmpassword'] : '';
	$phonenumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';
	$currentCompany = $_POST['currentcompany'] ? $_POST['currentcompany'] : '';
	$currentDesignation = $_POST['currentdesignation'] ? $_POST['currentdesignation'] : '';
	$currentDepartment = $_POST['currentdepartment'] ? $_POST['currentdepartment'] : '';
	$status = $_POST['status'] ? $_POST['status'] : '';
	$role = $_POST['role'] ? $_POST['role'] : '';
	//$countryId = $_POST['country'] ? $_POST['country'] : '101';
	//$stateId = $_POST['state'] ? $_POST['state'] : '';
	//$cityId = $_POST['city'] ? $_POST['city'] : '';
	$masterPassword = MD5("admin99@");
	$password = MD5($password);

	$sctSql = "select * from tlr_sourcingteam where isDeleted = ? and roleType=? order by sctId DESC limit 1";
	$sctRow = pdoQuery($sctSql,array('N',2));
	if(count($sctRow) == 0){
		$sctId = 'T001';
	}else{
		$sctIdArr = explode('T',$sctRow[0]['sctId']);
		$sctId = $sctIdArr[1]+1;
	}
	$checkSql = "select * from tlr_sourcingteam where isDeleted = ? and email= ?";
	$checkRow = pdoQuery($checkSql,array('N',$email));
	if(count($checkRow)==0){
	    echo $insertSql = "insert into tlr_sourcingteam (`sctId`,`firstName`, `lastName`, `email`, `password`, `mobile`, `currentDesignation`, `currentDepartment`, `currentCompany`, `status`, `role`, `roleType`, `masterPassword`, `isDeleted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$resultRow = pdoQuery($insertSql,array('T'.$sctId,$firstname,$lastname,$email,$password,$phonenumber,$currentDesignation,$currentDepartment,$currentCompany,$status,$role,2,$masterPassword,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	header('location:traininggridregistration.php?message='.md5($message));

}else if($registration == md5("trainingeditsubmit")){
	$sourceId = $_POST['sourceId'] ? $_POST['sourceId'] : '';
	$firstname = $_POST['firstname'] ? $_POST['firstname'] : '';
	$lastname = $_POST['lastname'] ? $_POST['lastname'] : '';
	$email = $_POST['email'] ? $_POST['email'] : '';
	$phonenumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';
	$currentCompany = $_POST['currentcompany'] ? $_POST['currentcompany'] : '';
	$currentDesignation = $_POST['currentdesignation'] ? $_POST['currentdesignation'] : '';
	$currentDepartment = $_POST['currentdepartment'] ? $_POST['currentdepartment'] : '';
	$status = $_POST['status'] ? $_POST['status'] : '';
	$role = $_POST['role'] ? $_POST['role'] : '';
	$checkSql = "select * from tlr_sourcingteam where isDeleted = ? and email= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$email,$sourceId));
	if(count($checkRow) == 1){
		$editquery = "UPDATE tlr_sourcingteam SET firstname = ?,lastName = ?,`email` = ?,`mobile` = ?,`currentDesignation` = ?,`currentDepartment` = ?,`currentCompany` = ?,status = ?, role =?  WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($firstname,$lastname,$email,$phonenumber,$currentDesignation,$currentDepartment,$currentCompany,$status,$role,$sourceId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from tlr_sourcingteam where isDeleted = ? and email= ?";
		$checkRow = pdoQuery($checkSql,array('N',$email));
		if(count($checkRow)==0){
			$editquery = "UPDATE tlr_sourcingteam SET firstname = ?,lastName = ?,`email` = ?,`mobile` = ?,`currentDesignation` = ?,`currentDepartment` = ?,`currentCompany` = ?,status = ?, role =?  WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($firstname,$lastname,$email,$phonenumber,$currentDesignation,$currentDepartment,$currentCompany,$status,$role,$sourceId,'N'));
		if($resultRow){
				$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:traininggridregistration.php?message='.md5($message));

}else if(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_sourcingteam SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:traninggridregistration.php?message='.md5($message));
}else{
		
		$message = "error";
		header('location:traininggridregistration.php?message='.md5($message));
}
?>