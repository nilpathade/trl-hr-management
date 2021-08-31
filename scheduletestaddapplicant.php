<?php
require_once('header/header.php');
// require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
   $message = '<div class="alert alert-success" role="alert">You have successfully added schedule test.</div>';
} else if ($_GET['message'] == md5('error')) {
   $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($stagesAccess != 3) {
   require_once('accesserror.php');
}
//query for applicant information
$appSql = "select * from tlr_applicants where isDeleted= ?";
$applicantRow = pdoQuery($appSql, array('N'));

//query schedule test
$testSql = "select * from tlr_test_schedule_master where isDeleted= ?";
$testRows = pdoQuery($testSql, array('N'));
?>
<div class="container-fluid">
    <?php if (!empty($message)) echo $message;   ?>
    <form action="scheduletestapplicantsubmit.php" method="post" id="stageform" name="stageform" autocomplete="OFF"
        enctype="multipart/form-data">
        <h2 class="text-center">Add Sechedule test</h2>
        <fieldset>
            <legend class="mandateinfo text-center mb-4">Valid information is required to register. <span
                    class="req"><small> required
                        *</small></span></legend>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="requistionId"><span class="req">* </span> Applicant Name: </label>
                    <select class="form-select" name="applicantId" id="applicantId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($applicantRow as $reqValue) { ?>
                        <option value="<?php echo $reqValue['id']; ?>"><?php echo $reqValue['name']; ?></option>
                        <?php  }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="requistionId"><span class="req">* </span> Schedule Test: </label>
                    <select class="form-select" name="scheduletestId" id="scheduletestId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($testRows as $testValue) { ?>
                        <option value="<?php echo $testValue['id']; ?>"><?php echo $testValue['testName']; ?></option>
                        <?php  }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="startDate"><span class="req">* </span> Start Date: </label>
                    <input type="date" id="datetimepicker" name="startDate" required class="form-control" />
                    <div id="errstartDate"></div>
                </div>


                <div class="mb-3 col-md-6">
                    <label for="endDate"><span class="req">* </span> End Date: </label>
                    <input type="date" id="endDate" name="endDate" required class="form-control" />
                    <div id="errendDate"></div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <?php $regs = md5("tlraddscheduletest"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-3 text-center">
                <input class="custom-btn chkstestname" type="submit" name="submit_reg" value="save">
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript" src="js/registration.js?v=12"></script>