<?php
require_once('header/header.php');
require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully added requisitions.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($assignAccess != 3) {
  require_once('accesserror.php');
}

$requisitionSql = "select * from tlr_requisitions where isDeleted= ? and clientId= ?";
$requisitionResult = pdoQuery($requisitionSql, array('N', $userid));

?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="assignrecruiterssubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
    <h2 class="text-center">Assign recruiters for various requisitions</h2>
    <fieldset>
      <legend class="mandateinfo text-center mb-4">Valid information is required to register. <span class="req"><small>
            required
            *</small></span></legend>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="requisitionsId"><span class="req">* </span>Requisitions: </label>
          <select class="form-select" name="requisitionsId" id="requisitionsId" required>
            <option value="" hidden>Select</option>
            <?php foreach ($requisitionResult as $reqlist) { ?>
              <option value="<?php echo $reqlist['id']; ?>"><?php echo $reqlist['designation']; ?></option>
            <?php }  ?>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMin"><span class="req">* </span> Status: </label>
          <select class="form-select" name="status" id="status" required>
            <option value="" hidden>Select</option>
            <option value="1">Assigned</option>
            <option value="2">Unassigned</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMin"><span class="req">* </span> Re-Assigned: </label>
          <select class="form-select" name="reassigned" id="reassigned" required>
            <option value="" hidden>Select</option>
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMin"><span class="req">* </span> Role Type: </label>
          <select class="form-select getrolelistclass" name="roleType" id="roleType" required>
            <option value="" hidden>Select</option>
            <option value="1">Source</option>
            <option value="2">Traning</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMax"><span class="req">* </span> Role List: </label>
          <select class="form-select getmemberlistclass" name="roleslist" id="roleslist" required>
            <option value="" hidden>Select</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="stages"><span class="req">* </span> Source Member list: </label>
          <div style="border:1px solid #000" id="roleMemberlist">
          </div>
        </div>

        <div class="mb-3 col-md-6">
          <?php $regs = md5("tlrassignadd"); ?>
          <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
        </div>
      </div>
      <div class="mb-3 text-center">
        <input class="custom-btn" type="submit" name="submit_reg" value="Save">
      </div>
    </fieldset>
  </form><!-- ends register form -->
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=7"></script>