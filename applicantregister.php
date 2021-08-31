<?php
require_once('header/dbconnection.php');
error_reporting(0);
$message = $_GET['message'];
$title = 'Add Applicant';
require_once('header/outer_header.php');
if ($message == md5('success')) {
  $textmessage = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
} else if ($message == md5('error')) {
  $textmessage = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
}
//require_once('header/registrationHeader.php');
?>

<div class="register-container">

    <div class="inner-container inner-container-reg">
        <h4 class="text-center main-head mb-4">Welcome to TLR Portal</h4>
        <?php if (!empty($textmessage)) {
      echo $textmessage;
    } ?>
        <h5 class="text-center sub-head mb-4">Register</h4>

            <form action="addapplicantsubmit.php" method="post" id="applicantform" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="mb-4">
                        <!-- <label class="form-label" for="applicantname"><span class="req">* </span> Applicant full name:
                </label> -->
                        <input class="custom-input" type="text" name="applicantname" id="txt" required value=""
                            placeholder="* Applicant name" onkeyup="Validate(this)" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <!-- <label class="form-label" for="phonenumber"><span class="req">* </span> Mobile Number: </label> -->
                            <input required type="text" name="phonenumber" id="phone" class="custom-input phone"
                                maxlength="10" placeholder="* Mobile Number"
                                value="<?php echo $applicantRow[0]['contactnumber']; ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <!-- <label class="form-label" for="email"><span class="req">* </span> Email Address: </label> -->
                            <input class="custom-input emailapplicantclass" required type="text" name="email"
                                value="<?php echo $applicantRow[0]['email']; ?>" id="email"
                                placeholder="* Email Address" onkeyup="applicant_email_validate(this.value);" />
                            <div id="errMessage"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <!-- <label class="form-label" for="password"><span class="req">* </span> Password: </label> -->
                            <input required name="password" type="password" class="custom-input inputpass" minlength="4"
                                maxlength="16" id="pass1" placeholder="* Password" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <!-- <label class="form-label" for="confirmpassword"><span class="req">* </span> Password Confirm:
                </label> -->
                            <input required name="confirmpassword" type="password" class="custom-input inputpass"
                                minlength="4" maxlength="16" placeholder="* Confirm Password" id="pass2"
                                onkeyup="checkPass(); return false;" />
                            <span id="confirmMessage" class="confirmMessage mt-2"></span>
                        </div>
                    </div>
                </div>


                <div class="mb-3 form-check d-flex justify-content-center">
                    <!-- <label class="form-label" for="declearation"><span class="req">*
                        </span>Declearation</label> -->
                    <input class="form-check-input mt-1 me-1" type="checkbox" required name="terms"
                        onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');"
                        id="field_terms">

                    <label class="small-text" for="field_terms">&nbsp;I
                        agree with the <a href="terms.php" class="link"
                            title="You may read our terms and conditions by clicking on this link">terms
                            and conditions</a> for Registration.
                    </label>

                </div>


                <div class="d-flex justify-content-center">
                    <input type="hidden" name="registration" value="<?php echo md5('tlraddapplicantsubmit'); ?>" />
                    <input type="hidden" name="registeronly" value="Yes" />

                    <input class="custom-btn applicantbtnsubmit" type="submit" name="submit_reg" value="Register" />
                </div>
                <p class="text-center text-muted mt-3">Already have an account? <a href="login.php" class="link">Login
                        here</a></p>

            </form>
    </div>
</div>


</body>

</html>
<script type="text/javascript">
document.getElementById("field_terms").setCustomValidity("Please accept the terms and conditions");
</script>
<script type="text/javascript" src="js/registration.js?v=7"></script>
<script type="text/javascript" src="js/testapplicant.js?v=9"></script>