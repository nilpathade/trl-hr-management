<?php
require_once('header/header.php');
require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully added schedule test.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($stagesAccess != 3) {
  require_once('accesserror.php');
}
$regeditSql = "select * from tlr_requisitions where isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array('N'));
?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="testschedulemastersubmit.php" method="post" id="stageform" name="stageform" autocomplete="OFF" enctype="multipart/form-data">
    <h2 class="text-center">Add Sechedule test</h2>
    <fieldset>
      <legend class="mandateinfo text-center mb-4">Valid information is required to register. <span class="req"><small> required
            *</small></span></legend>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="testname"><span class="req">* </span> Test Name: </label>
          <input class="form-control testnameclass" type="text" name="testName" id="txt" onkeyup="testNameValidate(this)" required />
          <div id="errMessage"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="testurl"><span class="req">* </span> Test URL: </label>
          <input class="form-control" type="text" name="testUrl" id="txt" required />
          <div id="testurl"></div>
        </div>
      </div>

      <div class="mb-3 col-md-6">
        <?php $regs = md5("tlraddtest"); ?>
        <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
      </div>

      <div class="mb-5 text-center">
        <input class="custom-btn chkstestname" type="submit" name="submit_reg" value="save">
      </div>
    </fieldset>
  </form><!-- ends register form -->
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=12"></script>