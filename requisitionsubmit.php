<?php
require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddrequisitions")){
	$designation = $_POST['designation'] ? $_POST['designation'] : '';
	$experienceMin = $_POST['experienceMin'] ? $_POST['experienceMin'] : '';
	$experienceMax = $_POST['experienceMax'] ? $_POST['experienceMax'] : '';
	$ctcRangeMin = $_POST['ctcRangeMin'] ? $_POST['ctcRangeMin'] : '';
	$ctcRangeMax = $_POST['ctcRangeMax'] ? $_POST['ctcRangeMax'] : '';
	$noticePeriod = $_POST['noticePeriod'] ? $_POST['noticePeriod'] : '';
	$countryId = $_POST['country'] ? $_POST['country'] : '101';
	$stateId = $_POST['state'] ? $_POST['state'] : '';
	$cityId = $_POST['city'] ? $_POST['city'] : '';
	$resourceCount = $_POST['resourceCount'] ? $_POST['resourceCount'] : '';
	$startDate = $_POST['startDate'] ? date('Y-m-d',strtotime($_POST['startDate'])) : '';
	$endDate = $_POST['endDate'] ? date('Y-m-d',strtotime($_POST['endDate'])) : '';
	$keyTechnicalSkills = $_POST['keyTechnicalSkills'] ? $_POST['keyTechnicalSkills'] : '';
	$otherSkill = $_POST['otherSkill'] ? $_POST['otherSkill'] : '';
	$comment = $_POST['comment'] ? $_POST['comment'] : '';
	$jdUpload = $_POST['jdUpload'] ? $_POST['jdUpload'] : '';
	
	$iptest = $_POST['iptest'] ? $_POST['iptest'] : '';
	$stages = $_POST['stages'] ? $_POST['stages'] : '';
	$stageids='';
	foreach($stages as $stageid){
		$stageids .= $stageid.',';
	}
	$stageids = rtrim($stageids,',');
	$updateBy = encrypt_decrypt('decrypt',$_SESSION['userid']);
	$today=date('Y-m-d H:i:s');
	$reqSql = "select * from tlr_requisitions where isDeleted= ? order by id DESC limit 1";
	$reqResult =  pdoQuery($reqSql,array('N'));
	if(count($reqResult) > 0){
		$reqArr = explode('req',$reqResult[0]['reqNo']);
		$reqNo = $reqArr[1] + 1;
	}else{
		$reqNo  = 101;
	}

	/*if (move_uploaded_file($_FILES["uploadContract"]["tmp_name"],
	      "uploadsow/" . $_FILES["uploadContract"]["name"])){
		  $uploadContract = "uploadsow/" . $_FILES["uploadContract"]["name"];
	}else{
		$uploadContract = '';
	}*/
	
	$insertSql = "insert into tlr_requisitions (`reqNo`, `designation`, `experienceMin`, `experienceMax`, `ctcRangeMin`, `ctcRangeMax`, `noticePeriod`, `country`, `state`, `city`, `resourceCount`, `startDate`, `endDate`, `keyTechnicalSkills`, `otherSkill`, `comment`, `jdUpload`,`iptest`, `updatedBy`,`updatedDate`, `clientId`,`isDeleted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$resultRow = pdoQuery($insertSql,array('req'.$reqNo,$designation,$experienceMin,$experienceMax,$ctcRangeMin,$ctcRangeMax,$noticePeriod,$countryId,$stateId,$cityId,$resourceCount,$startDate,$endDate,$keyTechnicalSkills,$otherSkill,$comment,$jdUpload,$iptest,$updateBy,$today,$updateBy,'N'));
	if($resultRow){
		$message = "success";
		}else{
			$message = "error";
		}
	header('location:requisitionsgridregistration.php?message='.md5($message));

}else if($registration == md5("tlreditrequisitions")){

	$reqId = $_POST['reqId'] ? $_POST['reqId'] : '';
	$designation = $_POST['designation'] ? $_POST['designation'] : '';
	$experienceMin = $_POST['experienceMin'] ? $_POST['experienceMin'] : '';
	$experienceMax = $_POST['experienceMax'] ? $_POST['experienceMax'] : '';
	$ctcRangeMin = $_POST['ctcRangeMin'] ? $_POST['ctcRangeMin'] : '';
	$ctcRangeMax = $_POST['ctcRangeMax'] ? $_POST['ctcRangeMax'] : '';
	$noticePeriod = $_POST['noticePeriod'] ? $_POST['noticePeriod'] : '';
	$countryId = $_POST['country'] ? $_POST['country'] : '101';
	$stateId = $_POST['state'] ? $_POST['state'] : '';
	$cityId = $_POST['city'] ? $_POST['city'] : '';
	$resourceCount = $_POST['resourceCount'] ? $_POST['resourceCount'] : '';
	$startDate = $_POST['startDate'] ? date('Y-m-d',strtotime($_POST['startDate'])) : '';
	$endDate = $_POST['endDate'] ? date('Y-m-d',strtotime($_POST['endDate'])) : '';
	$keyTechnicalSkills = $_POST['keyTechnicalSkills'] ? $_POST['keyTechnicalSkills'] : '';
	$otherSkill = $_POST['otherSkill'] ? $_POST['otherSkill'] : '';
	$comment = $_POST['comment'] ? $_POST['comment'] : '';
	$jdUpload = $_POST['jdUpload'] ? $_POST['jdUpload'] : '';
	
	$iptest = $_POST['iptest'] ? $_POST['iptest'] : '';
	$stages = $_POST['stages'] ? $_POST['stages'] : '';
	$stageids ='';
	foreach($stages as $stageid){
		$stageids .= $stageid.',';
	}
	$stageids = rtrim($stageids,',');
	$updateBy = encrypt_decrypt('decrypt',$_SESSION['userid']);
	$today=date('Y-m-d H:i:s');
	$editquery = "UPDATE tlr_requisitions SET designation = ?,`experienceMin` = ?,`experienceMax` = ?,ctcRangeMin = ?,`ctcRangeMax` = ?,`noticePeriod` = ?,`country` = ?,`state` = ?,`city` = ?,`resourceCount` = ?,`startDate` = ?,`endDate` = ?,`keyTechnicalSkills` = ?,`otherSkill` = ?,`comment` = ?,jdUpload = ?, iptest =?,`stages` = ?,`updatedBy` = ?,updatedDate = ?, clientId =?   WHERE `id` = ? and `isDeleted` = ?";
	$resultRow = pdoQuery($editquery,array($designation,$experienceMin,$experienceMax,$ctcRangeMin,$ctcRangeMax,$noticePeriod,$countryId,$stateId,$cityId,$resourceCount,$startDate,$endDate,$keyTechnicalSkills,$otherSkill,$comment,$jdUpload,$iptest,$stageids,$updateBy,$today,$updateBy,$reqId,'N'));

	if($resultRow){
		$message = "success";
		}else{
			$message = "error";
		}
	header('location:requisitionsgridregistration.php?message='.md5($message));
}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_requisitions SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:requisitionsgridregistration.php?message='.md5($message));
}else{
		$message = "error";
		header('location:requisitionsgridregistration.php?message='.md5($message));
}
	
?>