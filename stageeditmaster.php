<?php
require_once('header/header.php');
if ($stagesAccess != 3) {
  require_once('accesserror.php');
}
$stageId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_selectionstages where id = ? and isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array($stageId, 'N'));
$reqSql = "select * from tlr_requisitions where isDeleted= ?";
$requistionRows = pdoQuery($reqSql, array('N'));
require_once('header/registrationHeader.php');

if (count($resultRow) > 0) {
  foreach ($resultRow as $rows) {
?>
<div class="container-fluid">
    <form action="stagemastersubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
        <fieldset>
            <legend class="text-center mandateinfo mb-4">Valid information is required to register. <span
                    class="req"><small> required *</small></span></legend>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="requistionId"><span class="req">* </span> Requistions: </label>
                    <select class="form-select" name="requistionId" id="requistionId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($requistionRows as $reqValue) {
                  if ($reqValue['id'] == $rows['reqId']) { ?>
                        <option value="<?php echo $reqValue['id']; ?>" selected="selected">
                            <?php echo $reqValue['reqNo'] . ' ( ' . $reqValue['designation'] . ' )'; ?></option>

                        <?php  } else {  ?>
                        <option value="<?php echo $reqValue['id']; ?>">
                            <?php echo $reqValue['reqNo'] . ' ( ' . $reqValue['designation'] . ' )'; ?></option>
                        <?php  }
                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="clientname"><span class="req">* </span> Stage name: </label>
                    <input class="form-control stageNameclass" type="text" name="stageName" id="txt"
                        onkeyup="stageValidate(this)" required value="<?php echo $rows['stageName']; ?>" />
                    <input class="form-control" type="hidden" name="stageId" id="txt2"
                        value="<?php echo $rows['id']; ?>" onkeyup="Validate(this)" required />
                    <div id="errMessage"></div>
                </div>
            </div>

            <div class="mb-3">
                <?php $regs = md5("tlreditstage"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-3 text-center">
                <input class="custom-btn chkstagename" type="submit" name="submit_reg" value="Save">
            </div>

        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
</div>
<script type="text/javascript" src="js/registration.js?v=6"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Client Edit Registration</h3>
<?php }  ?>