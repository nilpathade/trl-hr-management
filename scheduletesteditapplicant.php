<?php
require_once('header/header.php');
if ($stagesAccess != 3) {
   require_once('accesserror.php');
}
$appId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from ltr_schedule_test_applicant where id = ? and isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array($appId, 'N'));
// require_once('header/registrationHeader.php');
//query for applicant information
$appSql = "select * from tlr_applicants where isDeleted= ?";
$applicantRow = pdoQuery($appSql, array('N'));

//query schedule test
$testSql = "select * from tlr_test_schedule_master where isDeleted= ?";
$testRows = pdoQuery($testSql, array('N'));

if (count($resultRow) > 0) {
   foreach ($resultRow as $rows) {
?>
<div class="container-fluid">
    <form action="testschedulemastersubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
        <fieldset>
            <legend class="text-center mandateinfo mb-4">Valid information is required to register. <span
                    class="req"><small>
                        required *</small></span></legend>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="requistionId"><span class="req">* </span> Applicant Name: </label>
                    <select class="form-select" name="applicantId" id="applicantId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($applicantRow as $reqValue) {
                           if ($rows['applicantId'] == $reqValue['id']) { ?>
                        <option value="<?php echo $reqValue['id']; ?>" selected="selected">
                            <?php echo $reqValue['name']; ?>
                        </option>
                        <?php  } else {  ?>
                        <option value="<?php echo $reqValue['id']; ?>"><?php echo $reqValue['name']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="requistionId"><span class="req">* </span> Schedule Test: </label>
                    <select class="form-select" name="scheduletestId" id="scheduletestId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($testRows as $testValue) {
                           if ($testValue['id'] == $rows['testScheduleId']) { ?>
                        <option value="<?php echo $testValue['id']; ?>" selected="selected">
                            <?php echo $testValue['testName']; ?></option>
                        <?php  } else {  ?>
                        <option value="<?php echo $testValue['id']; ?>"><?php echo $testValue['testName']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="startDate"><span class="req">* </span> Start Date: </label>
                    <input type="date" id="startDate" name="startDate" value="<?php echo $rows['startDate']; ?>"
                        required placeholder="start date" class="form-control" />
                    <div id="errstartDate"></div>
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="endDate"><span class="req">* </span> End Date: </label>
                    <input type="date" id="endDate" name="endDate" value="<?php echo $rows['endDate']; ?>" required
                        placeholder="end date" class="form-control" />
                    <div id="errendDate"></div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <?php $regs = md5("tlreeditscheduletest"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>
            <div class="mb-5 text-center">
                <input class="custom-btn chktestname" type="submit" name="submit_reg" value="Save">
            </div>
        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
</div>
<script type="text/javascript" src="js/registration.js?v=7"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Something went wrong!</h3>
<?php }  ?>