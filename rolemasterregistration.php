<?php
require_once('header/header.php');
// require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($roleAccess != 3) {
  require_once('accesserror.php');
}
$contrySql = "select * from tlr_countries where isDeleted= ?";
$totalResult = pdoQuery($contrySql, array('N'));
?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="rolemastersubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
    <h2 class="text-center">Role master list</h2>
    <fieldset>
      <legend class="mandateinfo text-center">Valid information is required to register. <span class="req"><small>
            required
            *</small></span></legend>

      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="state"><span class="req">* </span> Role Type: </label>
          <select class="form-select" name="roletype" id="roletype" required>
            <option value="" hidden>Select</option>
            <option value="1">Source Team</option>
            <option value="2">Training Team</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="clientname"><span class="req">* </span> Role Name: </label>
          <input class="form-control rolenameclass" type="text" name="rolename" id="txt" onkeyup="roleValidate(this)" required />
          <div id="errMessage"></div>
        </div>
      </div>


      <div class="mb-3">
        <?php $regs = md5("tlraddrole"); ?>
        <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
      </div>

      <div class="mb-5 text-center">
        <input class="custom-btn chkrolename" type="submit" name="submit_reg" value="Register">
      </div>
    </fieldset>
  </form><!-- ends register form -->
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=5"></script>