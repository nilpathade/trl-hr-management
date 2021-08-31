 <?php
 require_once('header/dbconnection.php');
$registration = $_POST['registration'] ? $_POST['registration'] : '';
 if($registration == md5("clientprofileupdate")){
	$clientId = $_POST['clientId'] ? $_POST['clientId'] : '';
	$clientname = $_POST['clientname'] ? $_POST['clientname'] : '';
	$email = $_POST['email'] ? $_POST['email'] : '';
	$phonenumber = $_POST['phonenumber'] ? $_POST['phonenumber'] : '';
	$address = $_POST['address'] ? $_POST['address'] : '';
	$countryId = $_POST['country'] ? $_POST['country'] : '101';
	$stateId = $_POST['state'] ? $_POST['state'] : '';
	$cityId = $_POST['city'] ? $_POST['city'] : '';
	$description = $_POST['description'] ? $_POST['description'] : '';
	$spoccontact = $_POST['spoccontact'] ? $_POST['spoccontact'] : '';
	$websiteurl = $_POST['websiteurl'] ? $_POST['websiteurl'] : '';
	$clientspoc = $_POST['clientspoc'] ? $_POST['clientspoc'] : '';
	$iprimedspocClient = $_POST['iprimedspocClient'] ? $_POST['iprimedspocClient'] : '';
	$companyname = $_POST['companyname'] ? $_POST['companyname'] : '';
	$uploadContractexist = $_POST['uploadContractexist'] ? $_POST['uploadContractexist'] : '';
	if(empty($uploadContractexist)){

		if (move_uploaded_file($_FILES["uploadContract"]["tmp_name"],
		      "uploadsow/" . $_FILES["uploadContract"]["name"])){
			$uploadContract = "uploadsow/" . $_FILES["uploadContract"]["name"];
		}else{
			$uploadContract = '';
		}
	}else{
		$uploadContract = $uploadContractexist;
	}
	$checkSql = "select * from tlr_client where isDeleted = ? and email= ? and id= ?";
	$checkRow = pdoQuery($checkSql,array('N',$email,$clientId));
	if(count($checkRow) == 1){
		 $editquery = "UPDATE tlr_client SET clientName = ?,`email` = ?,`address` = ?,`countryId` = ?,`stateId` = ?,`cityId` = ?,`description` = ?,`spocContact` = ?,`mobile` = ?,`clientWebsite` = ?,`clientSpoc` = ?,`iprimedspocClient` = ?,uploadContract = ?, companyName =?  WHERE `id` = ? and `isDeleted` = ?";
		$resultRow = pdoQuery($editquery,array($clientname,$email,$address,$countryId,$stateId,$cityId,$description,$spoccontact,$phonenumber,$websiteurl,$clientspoc,$iprimedspocClient,$uploadContract,$companyname,$clientId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}
	}else{
		$checkSql = "select * from tlr_client where isDeleted = ? and email= ?";
		$checkRow = pdoQuery($checkSql,array('N',$email));
		if(count($checkRow)==0){
			$editquery = "UPDATE tlr_client SET clientName = ?,`email` = ?,`address` = ?,`countryId` = ?,`stateId` = ?,`cityId` = ?,`description` = ?,`spocContact` = ?,`mobile` = ?,`clientWebsite` = ?,`clientSpoc` = ?,`iprimedspocClient` = ?,uploadContract = ?, companyName =?  WHERE `id` = ? and `isDeleted` = ?";
			$resultRow = pdoQuery($editquery,array($clientname,$email,$address,$countryId,$stateId,$cityId,$description,$spoccontact,$phonenumber,$websiteurl,$clientspoc,$iprimedspocClient,$uploadContract,$companyname,$clientId,'N'));
		if($resultRow){
			$message = "success";
			}else{
				$message = "error";
			}

		}else{
			$message = "error";
		}
	}
	header('location:client_profile.php?message='.md5($message));
}elseif($registration == md5("sourceprofileupdate")){
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
	header('location:source_profile.php?message='.md5($message).'&eid='.$_SESSION['userid']);

}