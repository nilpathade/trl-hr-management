 <?php
$sourceSql ="select * from tlr_requisitions where isDeleted = ? and clientId = ?";
$resultRow = pdoQuery($sourceSql, array('N',$userid));

//sourceing count
$schksql = "select * from tlr_sourcingteam where isDeleted = ? and roleType= ?";
$Rows = pdoQuery($schksql, array('N',1));

//training count 
$tchksql = "select * from tlr_sourcingteam where isDeleted = ? and roleType= ?";
$tRows = pdoQuery($tchksql, array('N',2));
 ?>
 <div class="content" style="width: 100% !important;">
    <div class="container-fluid">
	 	<h2>Welcome <?php echo $_SESSION['name']; ?>!</h2>
	     <div class="row">
	         <div class="col-lg-4" style="min-height: 300px; border:1px solid black">
	             Sourcing
	              	<select name="reqId" class="form-control dashboardreqId" id="reqId"> 
			           <option value="">---select---</option>
			           <?php foreach ($resultRow as $name) { ?>
			              <option value="<?php echo $name['id']; ?>"><?php echo $name['designation']; ?></option>
			            <?php }  ?>
			        </select>
			      <div id="showSourceCount">
			      	
			      </div>
			      <div id="totaltestCount">
			      	
			      </div>
			      <span id="errMessage"></span>
	         </div>
	         <div class="col-lg-4" style="min-height: 300px; border:1px solid black">
	             Training
	         </div>
	         <div class="col-lg-4" style="min-height: 300px; border:1px solid black">
	             Placement
	         </div>
	     </div>
	     <div class="row mt-3" style="border: 1px solid black;">
	         <div class="col-lg-4">
	             QuickPL
	         </div>
	         <div class="col-lg-4">
	             Client list
	         </div>
	         <div class="col-lg-4">
	             Resource count : <b><?php echo count($Rows); ?></b>
	             <br/>
	             Training Count : <b><?php echo count($tRows); ?></b>
	         </div>
	     </div>
 	</div>
</div>