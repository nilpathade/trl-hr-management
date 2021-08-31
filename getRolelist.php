<?php 
require_once('header/dbconnection.php');
$roleTypeId = !empty($_POST['roleTypeId']) ? $_POST['roleTypeId'] : '';
if(!empty($roleTypeId)){

	$roleSql = "select * from tlr_rolemaster where isDeleted= ? and roleType = ?";
	$totalResult = pdoQuery($roleSql,array('N',$roleTypeId));
	$data = array(); $roleslist = '<option selected>select role list</option>';
	foreach ($totalResult as $name) { 
       $roleslist .= '<option value="'.$name['id'].'">'.$name['roleName'].'</option>';
    }
    $data['roleslist'] = $roleslist;
    //header('HTTP/1.1 Success'); 
}else{

}
echo json_encode($data);
die;
?>