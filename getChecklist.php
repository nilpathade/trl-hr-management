<?php 
require_once('header/dbconnection.php');
$stateAction = !empty($_POST['stateAction']) ? $_POST['stateAction'] : '';
switch ($stateAction) {
	case 'checkstagename':
		try{
				$stageName = !empty($_POST['stageName']) ? $_POST['stageName'] : '';
				$stageId = !empty($_POST['stageId']) ? $_POST['stageId'] : '';
				$reqId = !empty($_POST['reqId']) ? $_POST['reqId'] : '';
				$data= array();
				if(!empty($stageName) && !empty($stageId) && !empty($reqId)){
					//for edit stage name checking 
					$stageSql = "select * from tlr_selectionstages where isDeleted= ? and stageName = ? and reqId = ? and id= ?";
					$totalResult = pdoQuery($stageSql,array('N',$stageName,$reqId,$stageId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "stage name is available";
					}else{
						if(!empty($stageName) && !empty($reqId)){
							$stageSql = "select * from tlr_selectionstages where isDeleted= ? and stageName = ? and reqId = ?";
							$totalResult = pdoQuery($stageSql,array('N',$stageName,$reqId));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "stage name already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "stage name is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "stage name can not be empty!";
						}
					}
				}else{
					//for Add stage checking stage name
					if(!empty($stageName)){
						$stageSql = "select * from tlr_selectionstages where isDeleted= ? and stageName = ? and reqId = ?";
						$totalResult = pdoQuery($stageSql,array('N',$stageName,$reqId));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "stage name already exists!";
						}else{
							$data['code'] = '200';
							$data['message'] = "stage name is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "stage name can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;
	case 'checkrolename':
		try{
				$roleName = !empty($_POST['roleName']) ? $_POST['roleName'] : '';
				$roleId = !empty($_POST['roleId']) ? $_POST['roleId'] : '';
				$data= array();
				if(!empty($roleName) && !empty($roleId)){
					//for edit stage name checking 
					$stageSql = "select * from tlr_rolemaster where isDeleted= ? and roleName = ? and id= ?";
					$totalResult = pdoQuery($stageSql,array('N',$roleName,$roleId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "role name is available";
					}else{
						if(!empty($roleName)){
							$stageSql = "select * from tlr_rolemaster where isDeleted= ? and roleName = ?";
							$totalResult = pdoQuery($stageSql,array('N',$roleName));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "role name already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "role name is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "role name can not be empty!";
						}
					}
				}else{
					//for Add stage checking stage name
					if(!empty($roleName)){
						$stageSql = "select * from tlr_rolemaster where isDeleted= ? and roleName = ?";
						$totalResult = pdoQuery($stageSql,array('N',$roleName));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "role name already exists!45";
						}else{
							$data['code'] = '200';
							$data['message'] = "role name is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "role name can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;
	case 'checkemailtraning':
		try{
				$emailAddress = !empty($_POST['emailAddress']) ? $_POST['emailAddress'] : '';
				$trainingId = !empty($_POST['trainingId']) ? $_POST['trainingId'] : '';
				$data= array();
				if(!empty($emailAddress) && !empty($trainingId)){
					//for edit stage name checking 
					$stageSql = "select * from tlr_sourcingteam where isDeleted= ? and email = ? and id= ?";
					$totalResult = pdoQuery($stageSql,array('N',$emailAddress,$trainingId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "email address is available";
					}else{
						if(!empty($emailAddress)){
							$stageSql = "select * from tlr_sourcingteam where isDeleted= ? and email = ?";
							$totalResult = pdoQuery($stageSql,array('N',$emailAddress));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "email address already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "email address is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "email address can not be empty!";
						}
					}
				}else{
					//for Add stage checking stage name
					if(!empty($emailAddress)){
						$stageSql = "select * from tlr_sourcingteam where isDeleted= ? and email = ?";
						$totalResult = pdoQuery($stageSql,array('N',$emailAddress));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "email address already exists!";
						}else{
							$data['code'] = '200';
							$data['message'] = "email address is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "email address can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;
		case 'checkemailclient':
		try{
				$emailAddress = !empty($_POST['emailAddress']) ? $_POST['emailAddress'] : '';
				$clientId = !empty($_POST['clientId']) ? $_POST['clientId'] : '';
				$data= array();
				if(!empty($emailAddress) && !empty($clientId)){
					//for edit stage name checking 
					$stageSql = "select * from tlr_client where isDeleted= ? and email = ? and id= ?";
					$totalResult = pdoQuery($stageSql,array('N',$emailAddress,$clientId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "email address is available";
					}else{
						if(!empty($emailAddress)){
							$stageSql = "select * from tlr_client where isDeleted= ? and email = ?";
							$totalResult = pdoQuery($stageSql,array('N',$emailAddress));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "email address already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "email address is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "email address can not be empty!";
						}
					}
				}else{
					//for Add stage checking stage name
					if(!empty($emailAddress)){
						$stageSql = "select * from tlr_client where isDeleted= ? and email = ?";
						$totalResult = pdoQuery($stageSql,array('N',$emailAddress));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "email address already exists!";
						}else{
							$data['code'] = '200';
							$data['message'] = "email address is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "email address can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;


		case 'checktestname':
		try{
				$testName = !empty($_POST['testName']) ? $_POST['testName'] : '';
				$testUrl = !empty($_POST['testUrl']) ? $_POST['testUrl'] : '';
				$testId = !empty($_POST['testId']) ? $_POST['testId'] : '';
				$data= array();
				if(!empty($testName) && !empty($testId) && !empty($testUrl)){
					//for edit stage name checking 
					$testSql = "select * from tlr_test_schedule_master where isDeleted= ? and testUrl=? and testName = ? and id= ?";
					$totalResult = pdoQuery($testSql,array('N',$testUrl,$testName,$testId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "test name is available";
					}else{
						if(!empty($testName)){
							$testSql = "select * from tlr_test_schedule_master where isDeleted= ? and testName = ?";
							$totalResult = pdoQuery($testSql,array('N',$testName));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "test name already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "test name is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "test name can not be empty!";
						}
					}
				}else{
					//for Add schedule test checking
					if(!empty($testName)){
						$testSql = "select * from tlr_test_schedule_master where isDeleted= ? and testName = ?";
						$totalResult = pdoQuery($testSql,array('N',$testName));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "test name already exists!";
						}else{
							$data['code'] = '200';
							$data['message'] = "test name is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "test name can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;

			case 'checkemailapplicant':
		try{
				$emailAddress = !empty($_POST['emailAddress']) ? $_POST['emailAddress'] : '';
				$applicantId = !empty($_POST['applicantId']) ? $_POST['applicantId'] : '';
				$data= array();
				if(!empty($emailAddress) && !empty($applicantId)){
					//for edit stage name checking 
					$appSql = "select * from tlr_applicants where isDeleted= ? and email = ? and id= ?";
					$totalResult = pdoQuery($appSql,array('N',$emailAddress,$applicantId));
					if(count($totalResult) == 1){
						$data['code'] = '200';
						$data['message'] = "email address is available";
					}else{
						if(!empty($emailAddress)){
							$appSql = "select * from tlr_applicants where isDeleted= ? and email = ?";
							$totalResult = pdoQuery($appSql,array('N',$emailAddress));
							if(count($totalResult) > 0){
								$data['code'] = '201';
								$data['message'] = "email address already exists!";
							}else{
								$data['code'] = '200';
								$data['message'] = "email address is available";
							}
						}else{
							$data['code'] = '201';
							$data['message'] = "email address can not be empty!";
						}
					}
				}else{
					//for Add stage checking stage name
					if(!empty($emailAddress)){
						$appSql = "select * from tlr_applicants where isDeleted= ? and email = ?";
						$totalResult = pdoQuery($appSql,array('N',$emailAddress));
						if(count($totalResult) > 0){
							$data['code'] = '201';
							$data['message'] = "email address already exists!";
						}else{
							$data['code'] = '200';
							$data['message'] = "email address is available";
						}
					}else{
						$data['code'] = '201';
						$data['message'] = "email address can not be empty!";
					}
				}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;

	
	default:
		# code...
		break;
}
?>