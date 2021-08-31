<?php
ob_start();
require_once('header/header.php');
if($profileAccess != 3){
   require_once('accesserror.php');
}
$clientId =encrypt_decrypt('decrypt',$_GET['eid']);
$regeditSql = "select * from tlr_client where id = ? and isDeleted= ? and cltId= ?";
$resultRow = pdoQuery($regeditSql,array($userid,'N',$menuid));
if(count($resultRow) > 0){
	header('location:client_profile.php?eid='.$_GET['eid']);
	die;
}else{
	$regeditSql = "select * from tlr_sourcingteam where id = ? and isDeleted= ? and sctId= ?";
	$resultRow = pdoQuery($regeditSql,array($userid,'N',$menuid));
	header('location:source_profile.php?eid='.$_GET['eid']);
	die;
}