<?php
require_once('header/header.php');
if ($stagesAccess != 3) {
    require_once('accesserror.php');
}
$testId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_test_schedule_master where id = ? and isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array($testId, 'N'));
require_once('header/registrationHeader.php');

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
                    <label class="form-label" for="clientname"><span class="req">* </span> Test Name: </label>
                    <input class="form-control testnameclass" type="text" name="testName" id="txt"
                        onkeyup="testNameValidate(this)" required value="<?php echo $rows['testName']; ?>" />
                    <input class="form-control" type="hidden" name="testId" id="txt2" value="<?php echo $rows['id']; ?>"
                        onkeyup="Validate(this)" required />
                    <div id="errMessage"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="testurl"><span class="req">* </span> Test URL: </label>
                    <input class="form-control" type="text" name="testUrl" id="testUrl" required
                        value="<?php echo $rows['testUrl']; ?>" />
                    <div id="testurl"></div>
                </div>
            </div>

            <div class="mb-3 col-md-6">
                <?php $regs = md5("tlredittest"); ?>
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