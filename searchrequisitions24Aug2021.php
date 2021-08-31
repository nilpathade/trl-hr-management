<?php
require_once('header/header.php');
// show country list
 $contrySql = "select * from tlr_countries where isDeleted= ?";
 $countryResult = pdoQuery($contrySql,array('N'));

// show notice period list
 $nplistSql = "select * from tlr_noticeperiod where isDeleted= ?";
 $nplistResult = pdoQuery($nplistSql,array('N'));

// show selection stages list
$stagesSql = "select * from tlr_selectionstages where isDeleted= ? and reqId= ?";
$totalstages = pdoQuery($stagesSql,array('N',$reqId)); 


$reqId =encrypt_decrypt('decrypt',$_GET['eid']);
$regeditSql = "select * from tlr_requisitions where isDeleted= ? and clientId = ? and id= ?";
$resultRow = pdoQuery($regeditSql,array('N',$userid,$reqId));
if(count($resultRow) >0 ){
    foreach ($resultRow as $rows) {
// show state list
$stateSql = "select * from tlr_states where isDeleted= ? and countryId = ?";
$totalstateResult = pdoQuery($stateSql,array('N',$rows['country']));

// show city list 
$citySql = "select * from tlr_cities where isDeleted= ? and stateId = ?";
$totalCityResult = pdoQuery($citySql,array('N',$rows['state']));

$selectedStages = explode(',',$rows['stages']);
}
}
?>
<div class="col-md-12">
    <form  method="post" id="searchrequisitions" role="form" >
        <br>
		<div class="row">
			<div class="form-group col-md-6">   
	            <label for="requisitionid"> Requisition ID: </label>
	            <input class="form-control" type="text" name="requisitionid" id = "requisitionid" placeholder="Requisition ID" /> 
	            <div id="errRequisitionid"></div>    
	        </div>

	        <div class="form-group col-md-6">   
	            <label for="designation"> Designation: </label>
	            <input class="form-control" type="text" name="designation" id = "designation" placeholder="Designation" /> 
	            <div id="errDesignation"></div>    
	        </div>
    	</div><br>
    	<div class="row">
	        <div class="form-group col-md-6">   
	            <label for="keyskills"> Key Skills: </label>
	            <input class="form-control" type="text" name="keyskills" id = "keyskills"  placeholder="Key Skills" /> 
	             <div id="errKeyskills"></div>    
	        </div>
	        <div class="form-group col-md-3">   
                <label for="startDate"> Start Date: </label>
                   <input type="date" id="startDate" value="<?php echo $rows['startDate']; ?>" name="startDate" min="2000-01-02" placeholder="start date" class="form-control" /> 
                        <div id="errstartDate"></div>    
            </div>


            <div class="form-group col-md-3">   
                <label for="endDate"> End Date: </label>
                    <input type="date" id="endDate" value="<?php echo $rows['endDate']; ?>" name="endDate" min="2000-01-02" placeholder="end date" class="form-control" /> 
                    <div id="errendDate"></div>      
            </div>
	        
    	</div><br>
        <div class="row">
        	<div class="form-group col-md-3">   
	            <label for="experienceMin"> Minium Experience: </label>
	                <input class="form-control" type="number" name="experienceMin" value="<?php echo $rows['experienceMin']; ?>" min="00" max="100" id = "experienceMin" onkeyup = "validatephone(this)" placeholder="Minium Experience" /> 
	                    <div id="errExperienceMin"></div>    
	        </div>
	        <div class="form-group col-md-3">   
	            <label for="experienceMax"> Maximum Experience: </label>
	                <input class="form-control" type="number" value="<?php echo $rows['experienceMax']; ?>" min="00" max="100" name="experienceMax" id = "experienceMax" onkeyup = "validatephone(this)" placeholder="Maximum experience" /> 
	                    <div id="errExperienceMax"></div>    
	        </div>
	        <div class="form-group col-md-3">
            	<label for="noticePeriod"> Notice Peroid: </label>
                    <select class="form-control" name="noticePeriod" id="noticePeriod" >
                      <option selected value='null'>notice period</option>
                       <?php foreach ($nplistResult as $name) { 
                        if($name['npdays'] == $rows['noticePeriod']){  ?>
                            <option value="<?php echo $name['npdays']; ?>" selected="selected"><?php echo $name['npdaysname']; ?></option>
                       <?php  }else{ ?>
                             <option value="<?php echo $name['npdays']; ?>"><?php echo $name['npdaysname']; ?></option>
                       <?php }
                        }  ?>
                    </select>
            </div>

            <div class="form-group col-md-3">
            	<label for="country"> Country: </label>
                <select class="form-control getstatelistclass" name="country" id="country" >
                  <option selected>select country</option>
                   <?php foreach ($countryResult as $name) { 
                    if($name['id'] == $rows['country']){  ?>
                        <option value="<?php echo $name['id']; ?>" selected="selected"><?php echo $name['countryName']; ?></option>
                   <?php  }else{ ?>
                         <option value="<?php echo $name['id']; ?>"><?php echo $name['countryName']; ?></option>
                   <?php }
                    }  ?>
                </select>
            </div>
	        
	    </div><br>
        <div class="row">
        	<div class="form-group col-md-3">   
	            <label for="ctcRangeMin"> Minium CTC: </label>
	                <input class="form-control" type="number" name="ctcRangeMin" value="<?php echo $rows['ctcRangeMin']; ?>" min="00" max="100" id = "ctcRangeMin" onkeyup = "validatephone(this)"  placeholder="Minium CTC" /> 
	                    <div id="errctcRangeMin"></div>    
	        </div>
	        <div class="form-group col-md-3">   
	            <label for="ctcRangeMax"> Maximum CTC: </label>
	                <input class="form-control" type="number" value="<?php echo $rows['ctcRangeMax']; ?>" min="00" max="100" name="ctcRangeMax" id = "ctcRangeMax" onkeyup = "validatephone(this)"  placeholder="Maximum CTC" /> 
	                    <div id="errctcRangeMax"></div>    
	        </div>

	        <div class="form-group col-md-3">
            <label for="state"> State: </label>
                    <select class="form-control getCitylistclass" name="state" id="state" >
                    <option selected>Select State</option>
                     <?php foreach ($totalstateResult as $name) { 
                        if($name['id'] == $rows['state']){  ?>
                            <option value="<?php echo $name['id']; ?>" selected="selected"><?php echo $name['stateName']; ?></option>
                       <?php  }else{ ?>
                             <option value="<?php echo $name['id']; ?>"><?php echo $name['stateName']; ?></option>
                       <?php }
                        }  ?>
                    </select>
            </div>

            <div class="form-group col-md-3">
            <label for="city"> City: </label>
                   <select class="form-control" name="city" id="city" >
                      <option selected>Select City</option>
                       <?php foreach ($totalCityResult as $cityname) { 
                        if($cityname['id'] == $rows['city']){  ?>
                            <option value="<?php echo $cityname['id']; ?>" selected="selected"><?php echo $cityname['cityName']; ?></option>
                       <?php  }else{ ?>
                             <option value="<?php echo $cityname['id']; ?>"><?php echo $cityname['cityName']; ?></option>
                       <?php }
                        }  ?>
                    </select>
            </div>
    	</div>
        <center><br><br>
            <div class="form-group btnleft">
                <input class="btn btn-primary" type="button" name="submit_requisition" value="Search Requisition" onclick="javascript:searchrequisitions()">
                <input class="btn btn-primary" type="button" name="reset" value="Reset Requisition" onclick="javascript:resetdata()">
            </div>
        </center>

	</form>
</div>
<?php
  $regeditSql = "select * from tlr_requisitions where isDeleted= ? ";
  $resultRow = pdoQuery($regeditSql,array('N'));
?>
<div id="searchresult">
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
                <?php if($requisitionAccess==3){ ?> <th scope="col">Actions</th> <?php } ?>
              </tr>
            </thead>

            <tbody >
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
</div>
<script type="text/javascript" src="js/searchrequisitions.js?v=5"></script>
<script type="text/javascript" src="js/registration.js"></script>