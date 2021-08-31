<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($clientAccess != 3) {
  require_once('accesserror.php');
}
$contrySql = "select * from tlr_countries where isDeleted= ?";
$totalResult = pdoQuery($contrySql, array('N'));
?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="clientregistrationsubmit.php" method="post" id="fileForm" autocomplete="OFF" enctype="multipart/form-data">
    <h2 class="text-center">Client Registration</h2>
    <fieldset>
      <legend class="mandateinfo text-center mb-4">Valid information is required to register. <span class="req"><small>
            required
            *</small></span></legend>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="clientname"><span class="req">* </span> Client Name: </label>
          <input class="form-control" type="text" name="clientname" id="txt" onkeyup="Validate(this)" required />
          <div id="errClient"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="email"><span class="req">* </span> Client SPOC Email: </label>
          <input class="form-control emailclass" required type="text" name="email" id="email" onkeyup="client_email_validate(this.value);" />
          <div id="errMessage"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="password"><span class="req">* </span> Password: </label>
          <input required name="password" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass1" />
        </div>
        <div class="mb-3 col-md-6">

          <label class="form-label" for="confirmpassword"><span class="req">* </span> Confirm Password:
          </label>
          <input required name="confirmpassword" type="password" class="form-control inputpass" minlength="4" maxlength="16" id="pass2" onkeyup="checkPass(); return false;" />
          <span id="confirmMessage" class="confirmMessage"></span>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="phonenumber"><span class="req">* </span> Mobile Number: </label>
          <input required type="text" name="phonenumber" id="phone" class="form-control phone" maxlength="10" onkeyup="validatephone(this);" />
        </div>


        <div class=" mb-3 md-form amber-textarea active-amber-textarea col-md-6">
          <label class="form-label" for="address"><span class="textaddress">* </span>Address: </label>
          <textarea id="form19" class="md-textarea form-control" name="address" rows="1"></textarea>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="country"><span class="req">* </span> Country: </label>
          <select class="form-select getstatelistclass" name="country" id="country" required>
            <option value="" hidden>Select</option>
            <?php foreach ($totalResult as $name) { ?>
              <option value="<?php echo $name['id']; ?>"><?php echo $name['countryName']; ?></option>
            <?php }  ?>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="state"><span class="req">* </span> State: </label>
          <select class="form-select getCitylistclass" name="state" id="state" required>
            <option value="">Select</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="city"><span class="req">* </span> City: </label>
          <select class="form-select" name="city" id="city" required>
            <option value="" hidden>Select</option>
          </select>
        </div>

        <div class=" mb-3 md-form amber-textarea active-amber-textarea col-md-6">
          <label class="form-label" for="description"><span class="textdescription">* </span>Description:
          </label>
          <textarea id="form19" class="md-textarea form-control" name="description" rows="1"></textarea>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="spoccontact"><span class="req">* </span>Client SPOC Contact: </label>
          <input required type="text" name="spoccontact" id="spoccontact" class="form-control" maxlength="28" onkeyup="validate(this);" />
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="websiteurl"><span class="req">* </span> Website URL: </label>
          <input required type="text" name="websiteurl" id="websiteurl" class="form-control" />
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="clientspoc"><span class="req">* </span> Client SPOC Name: </label>
          <input class="form-control" type="text" name="clientspoc" id="clientspoc" onkeyup="Validate(this)" required />
          <div id="errclientspoc"></div>
        </div>



        <div class="mb-3 col-md-6">
          <label class="form-label" for="iprimedspocClient"><span class="req">* </span> iPRIMED SPOC for
            client(Lead): </label>
          <input class="form-control" type="text" name="iprimedspocClient" id="txt" onkeyup="Validate(this)" required />
          <div id="erriprimedspocClient"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="companyname"><span class="req">* </span> Company Name: </label>
          <input class="form-control" type="text" name="companyname" id="txt" onkeyup="Validate(this)" required />
          <div id="errCompanyname"></div>

        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="uploadContract">Upload Contract/SOW: </label>
          <input type="file" class="form-control" name="uploadContract"  />
          <div id="erruploadContract"></div>
        </div>

        <div class="mb-3 col-md-12 text-center">
          <input type="checkbox" class="form-check-input mt-2" required name="terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" id="field_terms">   <label class="form-check-label" for="field_terms">I agree with the <a href="terms.php" title="You may read our terms and conditions by clicking on this link">terms and
              conditions</a>
            for Registration.</label><span class="req">* </span>
          <?php $regs = md5("tlraddsubmit"); ?>
          <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
        </div>
      </div>
      <div class="mb-3 text-center">
        <input class="custom-btn clientsubmit" type="submit" name="submit_reg" value="Register">
      </div>
    </fieldset>
  </form><!-- ends register form -->

  <script type="text/javascript">
    document.getElementById("field_terms").setCustomValidity(
      "Please indicate that you accept the Terms and Conditions");
  </script>
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=6"></script>