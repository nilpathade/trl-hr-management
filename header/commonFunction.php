<?php
function getMemberName($memberId){
	$chekcSql = "select firstName,lastName from tlr_sourcingteam where id = ? and isDeleted= ?";
	$resultRow = pdoQuery($chekcSql,array($memberId,'N'));
	return $resultRow[0]['firstName'].' '.$resultRow[0]['lastName'];
}
function getRoleName($roleType,$role){
	$chekcSql = "select roleName from tlr_rolemaster where roleType = ? and id= ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($roleType,$role,'N'));
	return $resultRow[0]['roleName'];

}
function getRequisitionName($reqId){
	$chekcSql = "select designation,reqNo from tlr_requisitions where id  = ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($reqId,'N'));
	return $resultRow[0]['designation'];
}

function getRecuriterName($recuriterId){
	$returnName = 'test Applicant';
	return $returnName;
}
function getTestUrl($testId){
	$chekcSql = "select testUrl from tlr_test_schedule_master where id= ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($testId,'N'));
	return $resultRow[0]['testUrl'];
}
function getUrgencyLevel($urgencyId){

	$chekcSql = "select urgencyLevel from tlr_urgency_level where id= ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($urgencyId,'N'));
	if(count($resultRow) > 0){
		$urgencyLevel = $resultRow[0]['urgencyLevel'];
	}else{
		$urgencyLevel = "-";
	}
	return $urgencyLevel;
}
function getApplicantName($id){
	$chekcSql = "select name from tlr_applicants where id = ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($id,'N'));
	return $resultRow[0]['name'];

}

function getApplicantStatus($id){
	$chekcSql = "select stagesId from tlr_joblog where jobId = ? order by id DESC";
	$resultRow = pdoQuery($chekcSql,array($id));
	if(count($resultRow) > 0){
		$showStatus = getStageName($resultRow[0]['stagesId']);
	}else{
		$showStatus = 'Job Applied';
	}
	return $showStatus;
}

function getApplicantStatusRecuriter($status,$reqId){
	$chekcSql = "select stageName from tlr_selectionstages where id = ? and reqId= ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($id,$reqId,'N'));
	return  $resultRow[0]['stageName'];
}
function getStageName($stagesId){
	$chekcSql = "select stageName from tlr_selectionstages where id = ? and isDeleted =?";
	$resultRow = pdoQuery($chekcSql,array($stagesId,'N'));
	return  $resultRow[0]['stageName'];
}

?>