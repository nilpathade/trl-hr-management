<?php
require_once('header/dbconnection.php');
require_once('header/registrationHeader.php');
$requisitionid	= $_POST['requisitionid'] ? $_POST['requisitionid'] : '';
$designation	= $_POST['designation'] ? $_POST['designation'] : '';
$keyskills		= $_POST['keyskills'] ? $_POST['keyskills'] : '';
$startDate		= $_POST['startDate'] ? $_POST['startDate'] : '';
$endDate		= $_POST['endDate'] ? $_POST['endDate'] : '';
$experienceMin	= $_POST['experienceMin'] ? $_POST['experienceMin'] : '';
$experienceMax	= $_POST['experienceMax'] ? $_POST['experienceMax'] : '';
$noticePeriod	= $_POST['noticePeriod'] ? $_POST['noticePeriod'] : '';
$country		= $_POST['country'] ? $_POST['country'] : '';
$ctcRangeMin	= $_POST['ctcRangeMin'] ? $_POST['ctcRangeMin'] : '';
$ctcRangeMax	= $_POST['ctcRangeMax'] ? $_POST['ctcRangeMax'] : '';
$state			= $_POST['state'] ? $_POST['state'] : '';
$city			= $_POST['city'] ? $_POST['city'] : '';

$regeditSql = "select * from tlr_requisitions where isDeleted= ? ";
if(!empty($requisitionid) && isset($requisitionid)){
	$regeditSql .= " AND reqNo = '".$requisitionid."'" ;
} 
if(!empty($designation) && isset($designation)){
	$regeditSql .= " AND designation LIKE '%".$designation."%'" ;
}
if(!empty($keyskills) && isset($keyskills)){
	$regeditSql .= " AND keyTechnicalSkills LIKE '%".$keyskills."%'" ;
}
if(!empty($noticePeriod) && isset($noticePeriod) && $noticePeriod != 'null'){
	$regeditSql .= " AND noticePeriod LIKE '%".$noticePeriod."%'" ;
}
if(!empty($country) && isset($country) && $country != 'select country'){
	$regeditSql .= " AND country = '".$country."'" ;
}
if(!empty($state) && isset($state) && $state != 'Select State'){
	$regeditSql .= " AND state = '".$state."'" ;
}
if(!empty($city) && isset($city) && ($city != 'Select City')){
	$regeditSql .= " AND city = '".$city."'" ;
}
if(!empty($startDate) && isset($startDate)){
	$regeditSql .= " AND startDate <= '".$startDate."'  AND endDate >= '". $endDate ."'" ;
}
if(!empty($endDate) && isset($endDate)){
	$regeditSql .= " AND endDate >= '". $endDate ."'" ;
}


if(!empty($experienceMin) && isset($experienceMin)){
	$regeditSql .= " AND experienceMin <= '". $experienceMin ."'" ;
}

if(!empty($experienceMax) && isset($experienceMax)){
	$regeditSql .= " AND experienceMax >= '". $experienceMax ."'" ;
}


if(!empty($ctcRangeMin) && isset($ctcRangeMin)){
	$regeditSql .= " AND ctcRangeMin <= '". $ctcRangeMin ."'" ;
}

if(!empty($ctcRangeMax) && isset($ctcRangeMax)){
	$regeditSql .= " AND ctcRangeMax >= '". $ctcRangeMax ."'" ;
}

//echo $regeditSql; exit();
$resultRow = pdoQuery($regeditSql,array('N'));

?>
<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Requisitions No</th>
                <th scope="col">Designation</th>
                <th scope="col">Key Technical Skills</th>
                <th scope="col">Other Skills</th>
                <th scope="col">Notice Period</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            
            <tbody class="searchresult">
            <?php
               $k=1;
              if(count($resultRow) > 0 ){
              
                foreach ($resultRow as $rows) {
                  $id = encrypt_decrypt('encrypt',$rows['id']);
                  ?>
                  <tr>
                      <th scope="row"><?php echo $k; ?></th>
                      <td><?php echo $rows['reqNo']; ?></td>
                      <td><?php echo $rows['designation']; ?></td>
                      <td><?php echo $rows['keyTechnicalSkills']; ?></td>
                      <td><?php echo $rows['otherSkill']; ?></td>
                      <td><?php echo $rows['noticePeriod']; ?></td>
                      <td><a href="#"> Apply </a> </td>
                      </td>
                  </tr>
            <?php $k++;
                   }

                 }
                ?>
                </tbody>
       </table>
    </div>
</div>

<script type="text/javascript" src="js/searchrequisitions.js?v=2"></script>
<script type="text/javascript" src="js/registration.js?v=2"></script>