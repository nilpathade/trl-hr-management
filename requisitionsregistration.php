<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully added requisitions.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($requisitionAccess != 3) {
  require_once('accesserror.php');
}
$contrySql = "select * from tlr_countries where isDeleted= ?";
$totalResult = pdoQuery($contrySql, array('N'));

$stagesSql = "select * from tlr_selectionstages where isDeleted= ?";
$totalstages = pdoQuery($stagesSql, array('N'));
// show notice period list
$nplistSql = "select * from tlr_noticeperiod where isDeleted= ?";
$nplistResult = pdoQuery($nplistSql, array('N'));
?>
<div class="container-fluid">
  <?php if (!empty($message)) echo $message;   ?>
  <form action="requisitionsubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
    <h2 class="text-center">Requisitions Registration</h2>
    <fieldset>
      <legend class="mandateinfo text-center">Valid information is required to register. <span class="req"><small>
            required
            *</small></span></legend>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label class="form-label" for="designation"><span class="req">* </span> Designation: </label>
          <input class="form-control" type="text" name="designation" id="txt" onkeyup="Validate(this)" required />
          <div id="errDesignation"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMin"><span class="req">* </span> Minium Experience:
          </label>
          <input class="form-control" type="number" name="experienceMin" min="00" max="100" id="txt" onkeyup="validatephone(this)" required />
          <div id="errExperienceMin"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="experienceMax"><span class="req">* </span> Maximum Experience:
          </label>
          <input class="form-control" type="number" min="00" max="100" name="experienceMax" id="txt" onkeyup="validatephone(this)" required />
          <div id="errExperienceMax"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="ctcRangeMin"><span class="req">* </span> Minimum CTC: </label>
          <input class="form-control" type="text" name="ctcRangeMin"  id="txt" onkeyup="ctcValidate(this)" required />
          <div id="errctcRangeMin"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="ctcRangeMax"><span class="req">* </span> Maximum CTC: </label>
          <input class="form-control" type="text" name="ctcRangeMax" id="txt" onkeyup="ctcValidate(this)"  required />
          <div id="errctcRangeMax"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="noticePeriod"><span class="req">* </span> Notice Peroid: </label>
          <select class="form-select" name="noticePeriod" id="noticePeriod" required>
            <option value="" hidden>Select</option>
            <?php foreach ($nplistResult as $name) { ?>
              <option value="<?php echo $name['npdays']; ?>"><?php echo $name['npdaysname']; ?></option>
            <?php }  ?>
          </select>
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
            <option value="" hidden>Select</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="city"><span class="req">* </span> City: </label>
          <select class="form-select" name="city" id="city" required>
            <option value="" hidden>Select</option>
          </select>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="resourceCount"><span class="req">* </span> Resource Count: </label>
          <input class="form-control" type="number" name="resourceCount" min="00" max="100" id="txt" onkeyup="validatephone(this)" required />
          <div id="errresourceCount"></div>
        </div>

        <div class="mb-3 col-md-6">
          <label class="form-label" for="startDate"><span class="req">* </span> Start Date: </label>
          <input type="date" id="startDate" name="startDate" min="2000-01-02" required class="form-control" />
          <div id="errstartDate"></div>
        </div>


        <div class="mb-3 col-md-6">
          <label class="form-label" for="endDate"><span class="req">* </span> End Date: </label>
          <input type="date" id="endDate" name="endDate" min="2000-01-02" required class="form-control" />
          <div id="errendDate"></div>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="keyTechnicalSkills"><span class="req">*
            </span>Technical Key Skills:
          </label>
          <textarea id="form19" class="md-textarea form-control" name="keyTechnicalSkills" rows="3"></textarea>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="otherSkill"><span class="req">* </span>Other Skills: </label>
          <textarea id="form19" class="md-textarea form-control" name="otherSkill" rows="3"></textarea>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="comment"><span class="req">* </span>Comment: </label>
          <textarea id="form19" class="md-textarea form-control" name="comment" rows="3"></textarea>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="jdUpload"><span class="req">* </span>Job Description: </label>
          <textarea id="form19" class="md-textarea form-control" name="jdUpload" rows="3"></textarea>
        </div>

        <div class=" mb-3 col-md-6">
          <label class="form-label" for="iptest">IP Test: </label>
          <textarea id="form19" class="md-textarea form-control" name="iptest" rows="1"></textarea>
        </div>

        <div class="mb-3 col-md-6">
         <!-- <label class="form-label" for="stages"><span class="req">* </span> Stages: </label>
          <select class="form-select" name="stages[]" id="stages" required>
            <option value="" hidden>Select</option>
            <?php //foreach ($totalstages as $stages) { ?>
              <option value="<?php //echo $stages['id']; ?>"><?php //echo $stages['stageName']; ?></option>
            <?php // }  ?>
          </select>-->
        </div>


        <div class="mb-3 col-md-6">
          <?php $regs = md5("tlraddrequisitions"); ?>
          <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
        </div>
      </div>
      <div class="mb-5 text-center">
        <input class="custom-btn" type="submit" name="submit_reg" value="Register">
      </div>
    </fieldset>
  </form><!-- ends register form -->
</div><!-- ends col-6 -->
<!-- Modal -->
<script type="text/javascript" src="js/registration.js?v=8"></script>