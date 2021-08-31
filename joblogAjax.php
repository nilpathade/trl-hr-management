<?php 
require_once('header/dbconnection.php');
$methodAction = !empty($_POST['methodAction']) ? $_POST['methodAction'] : '';
switch ($methodAction) {
	case 'joblog':
		try{
				$jobId = !empty($_POST['jobId']) ? $_POST['jobId'] : '';
				$statusId = !empty($_POST['statusId']) ? $_POST['statusId'] : '';
				$comments = !empty($_POST['comments']) ? $_POST['comments'] : '';
				$userid = encrypt_decrypt('decrypt', $_SESSION['userid']);
				$sqlcheck = "select * from tlr_joblog where jobId = ? and stagesId= ? and updateBy = ?";
				$checkRow = pdoQuery($sqlcheck,array($jobId,$statusId,$userid));
				if(!empty($jobId) && !empty($statusId) && !empty($comments) && count($checkRow) == 0){
					$insertSql = "insert into tlr_joblog (`jobId`, `stagesId`, `updateBy`, `comments`)VALUES (?,?,?,?)";
					$resultRow = pdoQuery($insertSql,array($jobId,$statusId,$userid,$comments));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "Status has been change successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
					$data['code'] = '201';
					$data['message'] = "something went wrong please try again check!";
				}	

			}catch(Exception $e){
				echo "Exception occur in joblog case!";
			}
		echo json_encode($data);
		break;

	case 'viewStagesApplicant':
		try{
				
				$reqId = !empty($_POST['reqId']) ? $_POST['reqId'] : '1';
				$jobId = !empty($_POST['jobId']) ? $_POST['jobId'] : '';
				if(!empty($reqId) && !empty($jobId)){
					$checkSql = "select * from tlr_selectionstages where reqId = ? and isDeleted= ?";
					$resultRow = pdoQuery($checkSql,array(1,'N'));
					if(count($resultRow) > 0){
						$data['code'] = '200';
						$data['jobId'] = $jobId;
						$optionArr .= '<select class="form-control" name="statusId" id="statusId" >';
						foreach ($resultRow as $value) {
							$optionArr .='<option value="'.$value['id'].'">'.$value['stageName'].'</option>';
						}
						$optionArr .= '</select>';

						$data['optionArr'] = $optionArr;
						//$data['message'] = "Status has been change successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
					$data['code'] = '201';
					$data['message'] = "something went wrong please try again !";
				}	

			}catch(Exception $e){
				echo "Exception occur in joblog case!";
			}
		echo json_encode($data);
		break;
}

?>