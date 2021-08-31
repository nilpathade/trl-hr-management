<?php
require_once('header/dbconnection.php');
$jobid	= $_POST['jobid'] ? $_POST['jobid'] : '';
$userid	= $_POST['userid'] ? $_POST['userid'] : '';

if(!empty($jobid) && !empty($userid)){
	$insertSql = "Insert into tlr_applyjob (`applicantId`,`requisitionId`, `status` ,`appliedDate`) VALUES (?,?,?,?)";
	$resultRow = pdoQuery($insertSql,  array($userid,  $jobid,  true,  date('Y-m-d H:i:s')));

	if($resultRow){
		echo "You have applyed job successfully. HR will get back to you very soon.";
	}
} else {
	echo "something wrongs..";
}