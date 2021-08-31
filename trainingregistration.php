<?php
require_once('header/header.php');
require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($trainingAccess != 3) {
  require_once('accesserror.php');
}
//$contrySql = "select * from tlr_countries where isDeleted= ?";
//$totalResult = pdoQuery($contrySql,array('N'));
$roleSql = "select * from tlr_rolemaster where isDeleted= ? and roleType = ?";
$totalRoleResult = pdoQuery($roleSql, array('N', 2));
?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="trainingregistrationsubmit.php" method="post" id="fileForm" autocomplete="OFF" enctype="multipart/form-data">
    <h2 class="text-center">Training Team Registration</h2>
    <fieldset>
      <legend class="mandateinfo text-center">Valid information is required to register. <span class="req"><small>
            required *</small></span></legend>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="firstname"><span class="req">* </span>First Name: </label>
          <input class="form-control" type="text" name="firstname" id="txt" onkeyup="Validate(this)" required />
          <div id="errfirstname"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="lastname"><span class="req">* </span>Last Name: </label>
          <input class="form-control" type="text" name="lastname" id="txt" onkeyup="Validate(this)" required />
          <div id="errlastname"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="email"><span class="req">* </span> Email Address: </label>
          <input class="form-control emailclass" required type="email" name="email" id="email" onkeyup="training_email_validate(this.value);" />
          <div id="errMessage"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="phonenumber"><span class="req">* </span>Mobile Number: </label>
          <input required type="tel" name="phonenumber" id="phone" class="form-control phone" maxlength="10" onkeyup="validatephone(this);" />
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="password"><span class="req">* </span>Password: </label>
          <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass1" />
        </div>
        <div class="mb-3 col-md-6">

          <label class="form-label" for="confirmpassword"><span class="req">* </span> Confirm Password:
          </label>
          <input required name="confirmpassword" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass2" onkeyup="checkPass(); return false;" />
          <span id="confirmMessage" class="confirmMessage"></span>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="address"><span class="currentcompany">* </span>Current Company:
          </label>
          <input class="form-control" type="text" name="currentcompany" id="txt" onkeyup="Validate(this)" required />
          <div id="errcurrentcompany"></div>
        </div>


        <div class=" mb-3 col-md-6">
          <label class="form-label" for="address"><span class="currentdesignation">* </span>Current
            Designation:
          </label>
          <input class="form-control" type="text" name="currentdesignation" id="txt" onkeyup="Validate(this)" required />
          <div id="errcurrentdesignation"></div>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="address"><span class="currentdepartment">* </span>Current Department:
          </label>
          <input class="form-control" type="text" name="currentdepartment" id="txt" onkeyup="Validate(this)" required />
          <div id="errcurrentdepartment"></div>
        </div>

        <!-- <div class="mb-3 col-md-6">
            <label class="form-label" for="country"><span class="req">* </span> Country: </label>
                    <select class="form-control getstatelistclass" name="country" id="country" required>
                      <option selected>select country</option>
                      <?php //foreach ($totalResult as $name) { 
                      ?>
                       <option value="<?php //echo $name['id']; 
                                      ?>"><?php //echo $name['countryName']; 
                                          ?></option>
                      <?php //}  
                      ?>
                    </select>
            </div>

            <div class="mb-3 col-md-6">
            <label class="form-label" for="state"><span class="req">* </span> State: </label>
                    <select class="form-control getCitylistclass" name="state" id="state" required>
                    <option selected>select state</option>
                    </select>
            </div>

            <div class="mb-3 col-md-6">
            <label class="form-label" for="city"><span class="req">* </span> City: </label>
                   <select class="form-control" name="city" id="city" required>
                      <option selected>select city</option>
                    </select> 
            </div>-->

        <div class="mb-3 col-md-6">
          <label class="form-label" for="country"><span class="req">* </span> Status: </label>
          <select class="form-select" name="status" id="status" required>
            <option value="" hidden>Select</option>
            <option value="active">Active</option>
            <option value="suspend">Suspend</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="country"><span class="req">* </span> Role: </label>
          <select class="form-select" name="role" id="role" required>
            <option value="" hidden>Select</option>
            <?php foreach ($totalRoleResult as $name) { ?>
              <option value="<?php echo $name['id']; ?>"><?php echo $name['roleName']; ?></option>
            <?php }  ?>
          </select>
        </div>
      </div>
      <div class="mb-3 col-md-6">
        <?php $regs = md5("tlraddtrainingsubmit"); ?>
        <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
      </div>

      <div class="mb-5 text-center">
        <input class="custom-btn trainingsubmit" type="submit" name="submit_reg" value="Register">
      </div>
    </fieldset>
  </form><!-- ends register form -->

  <script type="text/javascript">
    document.getElementById("field_terms").setCustomValidity(
      "Please indicate that you accept the Terms and Conditions");
  </script>
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=6"></script>