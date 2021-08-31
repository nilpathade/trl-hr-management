<?php 
require_once('header/dbconnection.php');
$roleslist = !empty($_POST['roleslist']) ? $_POST['roleslist'] : '';
$roleType = !empty($_POST['roleType']) ? $_POST['roleType'] : '';
if(!empty($roleslist) && !empty($roleType)){

	$roleSql = "select firstName,lastName,id from tlr_sourcingteam where isDeleted= ? and role = ? and roleType =?";
	$totalResult = pdoQuery($roleSql,array('N',$roleslist,$roleType));
	$data = array();
	$roleMemberlist='';
	foreach ($totalResult as $name) { 
       $roleMemberlist .= '<input class="form-check-input" type="checkbox" name="memberlist[]" value="'.$name['id'].'" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
                  '.$name['firstName'].' '.$name['lastName'].'</label><br/>';
    }
    $data['roleMemberlist'] = $roleMemberlist;
    //header('HTTP/1.1 Success'); 
}else{

}
echo json_encode($data);
die;
?>