<?php
require_once('header/dbconnection.php');
$file = fopen("C:/inetpub/wwwroot/tlr_new/importDoc/applicantlist1.csv", "r");

$i=0;
   while (!feof($file)) {
    	$data = fgetcsv($file);
        echo $name  = trim($data[2]);
        $contactnumber  = trim($data[3]);
        $email  = trim($data[4]);
        $city  = trim($data[5]);
        $currentcompany  = trim($data[7]);
        $currentdesignation  = trim($data[8]);
        $noticeperiod  = trim($data[9]);
        $currentctc  = trim($data[10]);
        $expectedctc  = trim($data[11]);
		if($name != ''){
		$checkSql = "select * from tlr_applicants where isDeleted = ? and email= ?";
		$checkRow = pdoQuery($checkSql,array('N',$email));
		if(count($checkRow) == 0){
        $applicantSql = "select * from tlr_applicants where isDeleted = ? order by applicationNo DESC limit 1";
		$applicantRow = pdoQuery($applicantSql,array('N'));
		if(count($applicantRow) == 0){
			$applicantNo = 'A101';
		}else{
			echo $applicantRow[0]['applicationNo'];
			$applicantArr = explode('A',$applicantRow[0]['applicationNo']);
			echo $applicantNo = $applicantArr[1]+1;
		}
		
		$today = date('Y-m-d');
		$password = md5('admin99@');
		$urgencylevel = '';
		$interest = '';
		$uploadcv = '';
		$signature ='';
		
				//$test = array('A'.$applicantNo,$name,$password,$contactnumber,$email,$currentcompany,$currentdesignation,$currentctc,$expectedctc,$noticeperiod,$today,'N');
				//print_r($test);
				echo "<br>";
			
				if($i < 314){
				$insertSql = "insert into tlr_applicants (`applicationNo`,`name`, `password`, `contactnumber`, `email`, `currentcompany`, `currentdesignation`, `currentctc`, `expectedctc`, `noticeperiod`, `createddate`,`isDeleted`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
				$resultRow = pdoQuery($insertSql,array('A'.$applicantNo,$name,$password,$contactnumber,$email,$currentcompany,$currentdesignation,$currentctc,$expectedctc,$noticeperiod,$today,'N'));
				$i++;
				$applicantNo = '';
				}
			}
		}
	}
echo "Total applicant imported ".$i;
?>