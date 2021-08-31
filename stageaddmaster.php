<?php
require_once('header/header.php');
require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
   $message = '<div class="alert alert-success" role="alert">You have successfully added stage.</div>';
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
   <form action="stagemastersubmit.php" method="post" id="stageform" name="stageform" autocomplete="OFF" enctype="multipart/form-data">
      <h2 class="text-center">Selection stages list</h2>
      <fieldset>
         <legend class="mandateinfo text-center">Valid information is required to register. <span class="req"><small>
                  required
                  *</small></span></legend>

         <div class="row">
            <div class="mb-3 col-md-6">
               <label class="form-label" for="requistionId"><span class="req">* </span>Requistions: </label>
               <select class="form-select" name="requistionId" id="requistionId" required>
                  <option value="" hidden>Select</option>
                  <?php foreach ($resultRow as $reqValue) { ?>
                     <option value="<?php echo $reqValue['id']; ?>">
                        <?php echo $reqValue['reqNo'] . ' ( ' . $reqValue['designation'] . ' )'; ?></option>
                  <?php  }  ?>
               </select>
            </div>
            <div class="mb-3 col-md-6">
               <label class="form-label" for="clientname"><span class="req">* </span>Stages: </label>
               <input class="form-control stageNameclass" type="text" name="stageName" id="txt" onkeyup="stageValidate(this)" required />
               <div id="errMessage"></div>
            </div>
         </div>
         <div class="mb-3 col-md-6">
            <?php $regs = md5("tlraddstage"); ?>
            <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
         </div>

         <div class="mb-3 text-center">
            <input class="custom-btn chkstagename" type="submit" name="submit_reg" value="save">
         </div>
      </fieldset>
   </form><!-- ends register form -->
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=12"></script>