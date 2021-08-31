<?php 
require_once('header/dbconnection.php');
$methodAction = !empty($_POST['methodAction']) ? $_POST['methodAction'] : '';
switch ($methodAction) {
	case 'sourceCount':
		try{
				$reqId = !empty($_POST['reqId']) ? $_POST['reqId'] : '';
				if(!empty($reqId)){
					$checkSql = "select * from tlr_applyjob where requisitionId = ?";
					$resultRow = pdoQuery($checkSql,array($reqId));
					if(count($resultRow)> 0){
						$data['code'] = '200';
						$data['totalCount'] = "<br/>Total Job Applied : <b>".count($resultRow).'</b>';

						$checkSql1 = "select *,count(stagesId) as stagecnt from tlr_applyjob as tp INNER JOIN tlr_joblog as tj ON tj.jobId = tp.id inner join tlr_selectionstages as ts ON ts.id = tj.stagesId where tp.requisitionId = ? and ts.isDeleted = ?  group by tj.stagesId";
						$resultRow1 = pdoQuery($checkSql1,array($reqId,'N'));
						foreach ($resultRow1 as $value) {
							$data['totaltestCount'] .= "<br/>".$value['stageName']." : <b>".$value['stagecnt'].'</b>';
						}
						
					}else{
						$data['code'] = '201';
						$data['message'] = "No Record found!";
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
	}
?>