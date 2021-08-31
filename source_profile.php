<?php
require_once('header/header.php');
require_once('header/registrationHeader.php');
error_reporting(1);
if($_GET['message']==md5('success')){
  $message = '<div class="alert alert-success" role="alert">Your profile has been successfully updated.</div>';
}else if($_GET['message']==md5('error')){
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
}else if($profileAccess != 3){
   require_once('accesserror.php');
} 
$sourceId =encrypt_decrypt('decrypt',$_GET['eid']);
$regeditSql = "select * from tlr_sourcingteam where id = ? and isDeleted= ? and sctId= ?";
$resultRow = pdoQuery($regeditSql,array($sourceId,'N',$menuid));
require_once('header/registrationHeader.php');
// show role list
 $roleSql = "select * from tlr_rolemaster where isDeleted= ?";
 $totalRoleResult = pdoQuery($roleSql,array('N'));

if(count($resultRow) >0 ){
    foreach ($resultRow as $rows) {
 ?>
    <div class="col-md-12">
             <?php if(!empty($message)) echo $message;   ?>
            <form action="profileupdate.php" method="post" id="fileForm" autocomplete="OFF" enctype="multipart/form-data">
            <fieldset><legend class="text-center mandateinfo">Valid information is required to register. <span class="req"><small> required *</small></span></legend>

             <div class="form-group col-md-6">   
                <label for="firstname"><span class="req">* </span> First name: </label>
                    <input class="form-control" type="text" name="firstname" id = "txt" onkeyup = "Validate(this)" required value="<?php echo $rows['firstName']; ?>" /> 
                     <input class="form-control" type="hidden" name="sourceId" id = "txt2" value="<?php echo $rows['id']; ?>" onkeyup = "Validate(this)" required /> 
                        <div id="errfirstname"></div>    
            </div>

            <div class="form-group col-md-6">   
                <label for="lastname"><span class="req">* </span> last name: </label>
                    <input class="form-control" type="text" name="lastname" id = "txt" value="<?php echo $rows['lastName']; ?>" onkeyup = "Validate(this)" required placeholder="Last name" /> 
                        <div id="errlastname"></div>    
            </div>

            <div class="form-group col-md-6">
                <label for="email"><span class="req">* </span> Email Address: </label> 
                    <input class="form-control emailclass" required type="text" name="email" id = "email"  onkeyup="training_email_validate(this.value);" value="<?php echo $rows['email']; ?>" />   
                        <div id="errMessage"></div>
            </div>

    
            <div class="form-group col-md-6">
            <label for="phonenumber"><span class="req">* </span> Mobile Number: </label>
                    <input required type="text" name="phonenumber" id="phone" class="form-control phone" maxlength="10" onkeyup="validatephone(this);" placeholder="enter mobile number ex 1234567890" value="<?php echo $rows['mobile']; ?>"/> 
            </div>


            <div class=" form-group col-md-6">
               <label for="address"><span class="currentcompany">* </span>Current Company: </label> 
                <input class="form-control" type="text" name="currentcompany" value="<?php echo $rows['currentCompany']; ?>"  id = "txt" onkeyup = "Validate(this)" required placeholder="Current company" /> 
                <div id="errcurrentcompany"></div>
            </div>


            <div class=" form-group col-md-6">
               <label for="address"><span class="currentdesignation">* </span>Current Designation: </label> 
                <input class="form-control" type="text" name="currentdesignation" value="<?php echo $rows['currentDesignation']; ?>"  id = "txt" onkeyup = "Validate(this)" required placeholder="Current designation" /> 
                <div id="errcurrentdesignation"></div>
            </div>

             <div class=" form-group col-md-6">
               <label for="address"><span class="currentdepartment">* </span>Current Department: </label> 
                <input class="form-control" type="text" name="currentdepartment" value="<?php echo $rows['currentDepartment']; ?>"  id = "txt" onkeyup = "Validate(this)" required placeholder="Current Department" /> 
                <div id="errcurrentdepartment"></div>
            </div>

            <div class="form-group col-md-6">
                <label for="country"><span class="req">* </span> Status: </label>
                    <select class="form-control" name="status" id="status" required>
                      <option selected>select status</option>
                      <?php if($rows['status'] == 'active'){ ?>
                        <option value="active" selected="selected">Active</option>
                        <option value="suspend">Suspend</option>
                        <?php   }else { ?>
                          <option value="active">Active</option>
                          <option value="suspend" selected="selected">Suspend</option>
                       <?php    } ?>
                    </select>
            </div>

            <div class="form-group col-md-6">
                <label for="country"><span class="req">* </span> Role: </label>
                    <select class="form-control" name="role" id="role" required>
                      <option>select role</option>
                      <?php foreach ($totalRoleResult as $name) { 
                          if($name['id'] == $rows['role']){ ?>
                            <option value="<?php echo $name['id']; ?>" selected="selected"><?php echo $name['roleName']; ?></option>
                        <?php  }else { ?>
                       <option value="<?php echo $name['id']; ?>"><?php echo $name['roleName']; ?></option>
                      <?php } }  ?>
                    </select>
            </div>            

            <div class="form-group btnleft">
            
                <?php $regs = md5("sourceprofileupdate"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>
            <center>
            <div class="form-group btnleft">
                <input class="btn btn-primary trainingsubmit" type="submit" name="submit_reg" value="Save">
            </div></center>
            </fieldset>
            </form><!-- ends register form -->
        </div><!-- ends col-6 -->
  </div>
<script type="text/javascript" src="js/registration.js?v=2"></script>

<?php } } else{  ?>
            <h3 class="text-center mt-5 mb-5">Something went wrong !</h3>
<?php }  ?>