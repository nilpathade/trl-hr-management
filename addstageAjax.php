<?php 
require_once('header/dbconnection.php');
try{
		$stageName = !empty($_POST['stagevalue']) ? $_POST['stagevalue'] : '';
		$reqId = !empty($_POST['reqId']) ? $_POST['reqId'] : '';
		$checksql = "select * from tlr_selectionstages where stageName = ? and reqId = ? and isDeleted = ?";
		$checkRow = pdoQuery($checksql,array($stageName,$reqId,'N'));
		if(!empty($stageName) && !empty($reqId)){
			if(count($checkRow) == 0){
				$insertSql = "insert into tlr_selectionstages (`stageName`,`reqId`, `isDeleted`) VALUES (?,?,?)";
				$resultRow = pdoQuery($insertSql,array($stageName,$reqId,'N'));
				$data['code'] = '200';
				$data['message'] = "stage has successfully added";
			}else{
				$data['code'] = '201';
				$data['message'] = "Stage name has already exists!";
			}	
		}else{
			$data['code'] = '201';
			$data['message'] = "stage name can not be empty!";
		}
	}catch(Exception $e){
				echo "something went worng!";
	}
	echo json_encode($data);
?>