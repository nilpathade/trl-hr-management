<?php 
require_once('header/dbconnection.php');
$stateAction = !empty($_POST['stateAction']) ? $_POST['stateAction'] : '';
switch ($stateAction) {
	case 'workexperience':
		try{
			$experienceId = !empty($_POST['experienceId']) ? $_POST['experienceId'] : '';
			//$experienceId =encrypt_decrypt('decrypt',$experienceId);
				$data= array();
				if(!empty($experienceId)){

					$clientdelquery = "UPDATE tlr_work_experience_details SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
					$resultRow = pdoQuery($clientdelquery,array('Y',$experienceId,'N'));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "selected experience deleted successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;
	case 'certification':
		try{
			$certificationId = !empty($_POST['certificationId']) ? $_POST['certificationId'] : '';
			//$experienceId =encrypt_decrypt('decrypt',$experienceId);
				$data= array();
				if(!empty($certificationId)){

					$clientdelquery = "UPDATE tlr_certifications SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
					$resultRow = pdoQuery($clientdelquery,array('Y',$certificationId,'N'));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "selected certification deleted successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;

		case 'internship':
		try{
			$internshipId = !empty($_POST['internshipId']) ? $_POST['internshipId'] : '';
			//$experienceId =encrypt_decrypt('decrypt',$experienceId);
				$data= array();
				if(!empty($internshipId)){

					$clientdelquery = "UPDATE tlr_internship_experience_details SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
					$resultRow = pdoQuery($clientdelquery,array('Y',$internshipId,'N'));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "selected internship deleted successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;

		case 'academic':
		try{
			$academicId = !empty($_POST['academicId']) ? $_POST['academicId'] : '';
			//$experienceId =encrypt_decrypt('decrypt',$experienceId);
				$data= array();
				if(!empty($academicId)){

					$clientdelquery = "UPDATE tlr_academic_details SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
					$resultRow = pdoQuery($clientdelquery,array('Y',$academicId,'N'));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "selected academic record deleted successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
			}catch(Exception $e){
				echo "something went worng!";
			}
		echo json_encode($data);
		break;

		case 'kidsdetail':
		try{
			$kidId = !empty($_POST['kidId']) ? $_POST['kidId'] : '';
			//$experienceId =encrypt_decrypt('decrypt',$experienceId);
				$data= array();
				if(!empty($kidId)){

					$clientdelquery = "UPDATE tlr_kids_details SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
					$resultRow = pdoQuery($clientdelquery,array('Y',$kidId,'N'));
					if($resultRow){
						$data['code'] = '200';
						$data['message'] = "selected kid record deleted successfully.";
					}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
					}
				}else{
						$data['code'] = '201';
						$data['message'] = "something went wrong please try again !";
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