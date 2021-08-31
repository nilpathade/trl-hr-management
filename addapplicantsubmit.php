<?php
require_once('header/dbconnection.php');
error_reporting(1);
$registration = $_POST['registration'] ? $_POST['registration'] : '';
if($registration == md5("tlraddapplicantsubmit")){
	$name = $_POST['applicantname'] ? $_POST['applicantname'] : '';
	$password = $_POST['password'] ? $_POST['password'] : '';
	$contactnumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';
	$email = $_POST['email'] ? $_POST['email'] : '';
	$currentcompany = $_POST['companyname'] ? $_POST['companyname'] : '';
	$currentdesignation = $_POST['currentdesignation'] ? $_POST['currentdesignation'] : '';
	$currentctc = $_POST['currentctc'] ? $_POST['currentctc'] : '';
	$expectedctc = $_POST['expectedctc'] ? $_POST['expectedctc'] : '';
	$noticeperiod = $_POST['noticePeriod'] ? $_POST['noticePeriod'] : '';
	$urgencylevel = $_POST['urgencylevel'] ? $_POST['urgencylevel'] : '';
	$interest = $_POST['interest'] ? $_POST['interest'] : '';
	$signature = $_POST['signature'] ? $_POST['signature'] : '';
	$registeronly = $_POST['registeronly'] ? $_POST['registeronly'] : 'No';
	if (move_uploaded_file($_FILES["uploadcv"]["tmp_name"],
	      "uploadcvs/" . $_FILES["uploadcv"]["name"])){
		  $uploadcv = "uploadcvs/" . $_FILES["uploadcv"]["name"];
		  $uploadcv = encrypt_decrypt('encrypt',$uploadcv);
	}else{
		$uploadcv = '';
	}
	
	$password = md5($password);
	$applicantSql = "select * from tlr_applicants where isDeleted = ? order by applicationNo DESC limit 1";
	$applicantRow = pdoQuery($applicantSql,array('N'));
	if(count($applicantRow) == 0){
		$applicantNo = 'A101';
	}else{
		$applicantArr = explode('A',$applicantRow[0]['applicationNo']);
		$applicantNo = $applicantArr[1]+1;
	}
	$checkSql = "select * from tlr_applicants where isDeleted = ? and email= ?";
	$checkRow = pdoQuery($checkSql,array('N',$email));
	$today = date('Y-m-d');
	
	if(count($checkRow) == 0){
	   // $insertSql = "insert into tlr_applicants (`applicationNo`,`name`, `password`, `contactnumber`, `email`, `currentcompany`, `currentdesignation`, `currentctc`, `expectedctc`, `noticeperiod`, `urgencylevel`, `interest`, `docupload`, `signature`, `createddate`,`isDeleted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		//$resultRow = pdoQuery($insertSql,array('A'.$applicantNo,$name,$password,$contactnumber,$email,$currentcompany,$currentdesignation,$currentctc,$expectedctc,$noticeperiod,$urgencylevel,$interest,$uploadcv,$signature,$today,'N'));
		$insertSql = "insert into tlr_applicants (`applicationNo`,`name`, `password`, `contactnumber`, `email`)VALUES (?,?,?,?,?)";
		$resultRow = pdoQuery($insertSql,array('A'.$applicantNo,$name,$password,$contactnumber,$email));
		sleep(1);
		if($resultRow){
				if(empty($resultRow)){
					$appIdSql = "select id,applicationNo from tlr_applicants where isDeleted = ? order by id DESC limit 1";
					$appRows = pdoQuery($appIdSql,array('N'));
					$resultRow = $appRows[0]['id'];
					//$applicationNo  = $appRows[0]['applicationNo '];
				}
				$eid = encrypt_decrypt('encrypt',$resultRow);
			$message = "success";
			$menuSql = "insert into tlr_menu_page_rel (`adminId`,`menuId`, `accessId`, `priorityOrder`,`isDeleted`)VALUES (?,?,?,?,?)";
			$resultRow = pdoQuery($menuSql,array('A'.$applicantNo,'2','3','2','N'));
			}else{
				$message = "error";
			}
	}else{
		$message = "error";
	}
	if($registeronly == 'Yes'){
		$profilepage = md5("applicant");
		$menuid = 'A'.$applicantNo;
		session_regenerate_id();
		$_SESSION['loggedin'] = true;
		$_SESSION['name'] = $name;
		$_SESSION['userid'] = $eid;
		$_SESSION['menuid'] = $menuid;
		$_SESSION['profilepage'] = $profilepage;
		header('location:dashboard.php?message='.md5($message));
		die;
	}else{
		header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);
	}

}else if($registration == md5("tlreditapplicantsubmit")){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$name = $_POST['applicantname'] ? $_POST['applicantname'] : '';
	$contactnumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';
	$email = $_POST['email'] ? $_POST['email'] : '';
	$currentcompany = $_POST['companyname'] ? $_POST['companyname'] : '';
	$currentdesignation = $_POST['currentdesignation'] ? $_POST['currentdesignation'] : '';
	$currentctc = $_POST['currentctc'] ? $_POST['currentctc'] : '';
	$expectedctc = $_POST['expectedctc'] ? $_POST['expectedctc'] : '';
	$noticeperiod = $_POST['noticePeriod'] ? $_POST['noticePeriod'] : '';
	$urgencylevel = $_POST['urgencylevel'] ? $_POST['urgencylevel'] : '';
	$interest = $_POST['interest'] ? $_POST['interest'] : '';
	$signature = $_POST['signature'] ? $_POST['signature'] : '';
	$existcvs  = $_POST['existcvs'] ? $_POST['existcvs'] : '';
	$today = date('Y-m-d');
	if(!empty($_FILES["uploadcv"]["name"])){

		if (move_uploaded_file($_FILES["uploadcv"]["tmp_name"],
	      "uploadcvs/" . $_FILES["uploadcv"]["name"])){
		  $uploadcv = "uploadcvs/" . $_FILES["uploadcv"]["name"];
		  $uploadcv = encrypt_decrypt('encrypt',$uploadcv);
		}else{
			$uploadcv = '';
		}
	}else{
		$uploadcv = $existcvs;
	}
	$checkSql = "select * from tlr_applicants where isDeleted = ? and email= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$email,$applicantId));
	if(count($checkRow) == 1){
		$editquery = "UPDATE tlr_applicants SET name = ?, contactnumber = ?,`email` = ?,`currentcompany` = ?,`currentdesignation` = ?,`currentctc` = ?,`expectedctc` = ?,`noticeperiod` = ?,`urgencylevel` = ?,`interest` = ?,`docupload` = ?,`signature` = ?,`createddate` = ? WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($name,$contactnumber,$email,$currentcompany,$currentdesignation,$currentctc,$expectedctc,$noticeperiod,$urgencylevel,$interest,$uploadcv,$signature,$today,$applicantId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from tlr_applicants where isDeleted = ? and email= ?";
		$checkRow = pdoQuery($checkSql,array('N',$email));
		if(count($checkRow)==0){
			$editquery = "UPDATE tlr_applicants SET name = ?, contactnumber = ?,`email` = ?,`currentcompany` = ?,`currentdesignation` = ?,`currentctc` = ?,`expectedctc` = ?,`noticeperiod` = ?,`urgencylevel` = ?,`interest` = ?,`docupload` = ?,`signature` = ?,`createddate` = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($name,$contactnumber,$email,$currentcompany,$currentdesignation,$currentctc,$expectedctc,$noticeperiod,$urgencylevel,$interest,$uploadcv,$signature,$today,$applicantId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);
}else if($registration == md5('experience')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$experienceId = $_POST['experienceId'] ? $_POST['experienceId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$wedcompany = $_POST['wedcompany'] ? $_POST['wedcompany'] : '';
	$wedlocation = $_POST['wedlocation'] ? $_POST['wedlocation'] : '';
	$weddesignation = $_POST['weddesignation'] ? $_POST['weddesignation'] : '';
	$wedstartdate = $_POST['wedstartdate'] ? $_POST['wedstartdate'] : '';
	$wedenddate = $_POST['wedenddate'] ? $_POST['wedenddate'] : '';
	$weddescriptionrole = $_POST['weddescriptionrole'] ? $_POST['weddescriptionrole'] : '';
	$wedresponsibilities = $_POST['wedresponsibilities'] ? $_POST['wedresponsibilities'] : '';
	$wedteamexp = $_POST['wedteamexp'] ? $_POST['wedteamexp'] : '';
	$wedlastctc = $_POST['wedlastctc'] ? $_POST['wedlastctc'] : '';
	$wedreasonforswitch = $_POST['wedreasonforswitch'] ? $_POST['wedreasonforswitch'] : '';
	$wedhowtoget = $_POST['wedhowtoget'] ? $_POST['wedhowtoget'] : '';
	$i=0;
	foreach($wedcompany as $value){
		if(empty($experienceId[$i])){
			$insertSql = "insert into tlr_work_experience_details (`applicantid`, `company`, `location`, `designation`, `startdate`, `enddate`, `description_role`, `responsibilities`, `teamexp`, `lastctc`, `reason_for_switch`, `how_get_in`, `isDeleted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$wedlocation[$i],$weddesignation[$i],$wedstartdate[$i],$wedenddate[$i],$weddescriptionrole[$i],$wedresponsibilities[$i],$wedteamexp[$i],$wedlastctc[$i],$wedreasonforswitch[$i],$wedhowtoget[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_work_experience_details SET company = ?, location = ?,`designation` = ?,`startdate` = ?,`enddate` = ?,`description_role` = ?,`responsibilities` = ?,`teamexp` = ?,`lastctc` = ?,`reason_for_switch` = ?,`how_get_in` = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$wedlocation[$i],$weddesignation[$i],$wedstartdate[$i],$wedenddate[$i],$weddescriptionrole[$i],$wedresponsibilities[$i],$wedteamexp[$i],$wedlastctc[$i],$wedreasonforswitch[$i],$wedhowtoget[$i],$experienceId[$i],'N'));
		}
		$i++;
	}

	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('certification')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$certificateId = $_POST['certificateId'] ? $_POST['certificateId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$wedcertificate = $_POST['wedcertificate'] ? $_POST['wedcertificate'] : '';
	$weddate = $_POST['weddate'] ? $_POST['weddate'] : '';
	$wedinstitute_school = $_POST['wedinstitute_school'] ? $_POST['wedinstitute_school'] : '';
	$wedvalidity = $_POST['wedvalidity'] ? $_POST['wedvalidity'] : '';
	$i=0;
	foreach($wedcertificate as $value){
		if(empty($certificateId[$i])){
			$insertSql = "insert into tlr_certifications (`applicantid`, `certificatename`, `certificatedate`, `institute_school`, `validity`, `isDeleted`) VALUES (?,?,?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$weddate[$i],$wedinstitute_school[$i],$wedvalidity[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_certifications SET certificatename = ?, certificatedate = ?,`institute_school` = ?,`validity` = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$weddate[$i],$wedinstitute_school[$i],$wedvalidity[$i],$certificateId[$i],'N'));
		}
		$i++;
	}

	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('intership')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$intershipId = $_POST['internshipId'] ? $_POST['internshipId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$company = $_POST['iedcompany'] ? $_POST['iedcompany'] : '';
	$designation = $_POST['ieddesignation'] ? $_POST['ieddesignation'] : '';
	$start_date = $_POST['iedstartdate'] ? $_POST['iedstartdate'] : '';
	$end_date = $_POST['iedenddate'] ? $_POST['iedenddate'] : '';
	$description_roles = $_POST['ieddescriptionrole'] ? $_POST['ieddescriptionrole'] : '';
	$how_get_in = $_POST['iedhowtoget'] ? $_POST['iedhowtoget'] : '';
	$stipend = $_POST['iedstipend'] ? $_POST['iedstipend'] : '';
	$i=0;
	foreach($company as $value){
		if(empty($intershipId[$i])){
			$insertSql = "insert into tlr_internship_experience_details (`applicantid`, `company`,`designation`, `start_date`, `end_date`, `description_roles`, `how_get_in`, `stipend`, `isDeleted`) VALUES (?,?,?,?,?,?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$designation[$i],$start_date[$i],$end_date[$i],$description_roles[$i],$how_get_in[$i],$stipend[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_internship_experience_details SET company = ?, designation = ?,`start_date` = ?,`end_date` = ?, description_roles = ?,`how_get_in` = ?,`stipend` = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$designation[$i],$start_date[$i],$end_date[$i],$description_roles[$i],$how_get_in[$i],$stipend[$i],$intershipId[$i],'N'));
		}
		$i++;
	}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('academicrecord')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$academicId = $_POST['academicId'] ? $_POST['academicId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$education = $_POST['education'] ? $_POST['education'] : '';
	$percentage = $_POST['percentage'] ? $_POST['percentage'] : '';
	$school_collage = $_POST['school_collage'] ? $_POST['school_collage'] : '';
	$board_university = $_POST['board_university'] ? $_POST['board_university'] : '';
	$location = $_POST['location'] ? $_POST['location'] : '';
	$i=0;
	foreach($education as $value){
		if(empty($academicId[$i])){
			$insertSql = "insert into tlr_academic_details (`applicantid`, `education`,`percentage`, `school_collage`, `board_university`, `location`, `isDeleted`) VALUES (?,?,?,?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$percentage[$i],$school_collage[$i],$board_university[$i],$location[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_academic_details SET education = ?, percentage = ?, school_collage = ?,`board_university` = ?,`location` = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$percentage[$i],$school_collage[$i],$board_university[$i],$location[$i],$academicId[$i],'N'));
		}
		$i++;
	}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('skills')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$skillId = $_POST['skillId'] ? $_POST['skillId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$technicallskills = $_POST['technicallskills'] ? $_POST['technicallskills'] : '';
	$personalitytraits = $_POST['personalitytraits'] ? $_POST['personalitytraits'] : '';
		if(empty($skillId)){
			$insertSql = "insert into tlr_technicalskills (`applicantid`, `technicallskills`,`personalitytraits`, `isDeleted`) VALUES (?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$technicallskills,$personalitytraits,'N'));
		}else{
			$editquery = "UPDATE tlr_technicalskills SET technicallskills = ?, personalitytraits = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($technicallskills,$personalitytraits,$skillId,'N'));
		}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('personaldetail')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$personalId = $_POST['personalId'] ? $_POST['personalId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$dateofbirth = $_POST['dateofbirth'] ? $_POST['dateofbirth'] : '';
	$anniversary = $_POST['anniversary'] ? $_POST['anniversary'] : '';
		if(empty($personalId)){
			$insertSql = "insert into tlr_personal_details (`applicantid`, `dateofbirth`,`anniversary`, `isDeleted`) VALUES (?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$dateofbirth,$anniversary,'N'));
		}else{
			$editquery = "UPDATE tlr_personal_details SET dateofbirth = ?, anniversary = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($dateofbirth,$anniversary,$personalId,'N'));
		}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('kidsdetail')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$kidId = $_POST['kidId'] ? $_POST['kidId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$kids_name = $_POST['kids_name'] ? $_POST['kids_name'] : '';
	$kids_birthday = $_POST['kids_birthday'] ? $_POST['kids_birthday'] : '';
	$i=0;
	foreach($kids_name as $value){
		if(empty($kidId[$i])){
			$insertSql = "insert into tlr_kids_details (`applicantid`, `kids_name`,`birthday`, `isDeleted`) VALUES (?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$kids_birthday[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_kids_details SET kids_name = ?, birthday = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$kids_birthday[$i],$kidId[$i],'N'));
		}
		$i++;
	}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}else if($registration == md5('applicantregister')){

	$applicantId = $_POST['applicantId'] ? $_POST['applicantId'] : '';
	$kidId = $_POST['kidId'] ? $_POST['kidId'] : '';
	$eid = $applicantId;
	$applicantId = encrypt_decrypt('decrypt',$applicantId);
	$kids_name = $_POST['kids_name'] ? $_POST['kids_name'] : '';
	$kids_birthday = $_POST['kids_birthday'] ? $_POST['kids_birthday'] : '';
	$i=0;
	foreach($kids_name as $value){
		if(empty($kidId[$i])){
			$insertSql = "insert into tlr_kids_details (`applicantid`, `kids_name`,`birthday`, `isDeleted`) VALUES (?,?,?,?)";
			$resultRow = pdoQuery($insertSql,array($applicantId,$value,$kids_birthday[$i],'N'));
		}else{
			$editquery = "UPDATE tlr_kids_details SET kids_name = ?, birthday = ? WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($value,$kids_birthday[$i],$kidId[$i],'N'));
		}
		$i++;
	}
	header('location:testapplicant.php?message='.md5($message).'&eid='.$eid);

}elseif(!empty($_GET['did'])){
		$id =encrypt_decrypt('decrypt',$_GET['did']);
		$clientdelquery = "UPDATE tlr_client SET isDeleted = ? WHERE `id` = ? and `isDeleted` = ? limit 1";
		$resultRow = pdoQuery($clientdelquery,array('Y',$id,'N'));
		if($resultRow){
			$message = "dsuccess";
		}else{
			$message = "error";
		}
		header('location:clientgridregistration.php?message='.md5($message));
}else{
		$message = "error";
		header('location:clientgridregistration.php?message='.md5($message));
}
	
?>