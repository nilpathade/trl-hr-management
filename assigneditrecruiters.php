<?php
require_once('header/header.php');
// require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully added requisitions.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($assignAccess == 0 || $assignAccess == 1) {
  require_once('accesserror.php');
}
$assignId = encrypt_decrypt('decrypt', $_GET['eid']);
$assigneditSql = "select * from tlr_assignteam where id = ? and isDeleted= ?";
$resultRow = pdoQuery($assigneditSql, array($assignId, 'N'));

$requisitionSql = "select * from tlr_requisitions where isDeleted= ? and clientId= ?";
$requisitionResult = pdoQuery($requisitionSql, array('N', $userid));

if (count($resultRow) > 0) {
  foreach ($resultRow as $rows) {

    $assignSql = "select * from tlr_assignteam where requisitionId = ? and isDeleted= ?";
    $assignRow = pdoQuery($assignSql, array($rows['requisitionId'], 'N'));

    //get role list
    $roleSql = "select * from tlr_rolemaster where isDeleted= ? and roleType = ?";
    $totalResult = pdoQuery($roleSql, array('N', $rows['roleType']));
?>
<div class="container-fluid">
    <?php if (!empty($message)) echo $message;   ?>
    <form action="assignrecruiterssubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
        <h2 class="text-center">Assign recruiters for various requisitions</h2>

        <fieldset>
            <legend class="mandateinfo text-center mb-4">Valid information is required to register. <span
                    class="req"><small>
                        required
                        *</small></span>
            </legend>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="requisitionsId"><span class="req">* </span>Requisitions: </label>
                    <select class="form-select" name="requisitionsId" id="requisitionsId" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($requisitionResult as $reqlist) {
                  if ($rows['requisitionId'] == $reqlist['id']) { ?>
                        <option value="<?php echo $reqlist['id']; ?>" selected="selected">
                            <?php echo $reqlist['designation']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $reqlist['id']; ?>"><?php echo $reqlist['designation']; ?></option>
                        <?php }
                }  ?>
                    </select>
                    <input class="form-control" type="hidden" name="assignId" id="txt2"
                        value="<?php echo $rows['id']; ?>" onkeyup="Validate(this)" required />
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMin"><span class="req">* </span> Status: </label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="" hidden>Select</option>
                        <?php if ($rows['status'] == 1) { ?>
                        <option value="1" selected="selected">Assigned</option>
                        <option value="2">Unassigned</option>
                        <?php } else { ?>
                        <option value="1">Assigned</option>
                        <option value="2" selected="selected">Unassigned</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMin"><span class="req">* </span> Re-Assigned: </label>
                    <select class="form-select" name="reassigned" id="reassigned" required>
                        <option value="" hidden>Select</option>
                        <?php if ($rows['reAssigned'] == 'Yes') { ?>
                        <option value="No" selected="selected">Yes</option>
                        <option value="Yes">No</option>
                        <?php } else { ?>
                        <option value="Yes">Yes</option>
                        <option value="No" selected="selected">No</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMin"><span class="req">* </span> Role Type: </label>
                    <select class="form-select getrolelistclass" name="roleType" id="roleType" required>
                        <option value="" hidden>Select</option>
                        <?php if ($rows['roleType'] == 1) { ?>
                        <option value="1" selected="selected">Source</option>
                        <option value="2">Traning</option>
                        <?php } else { ?>
                        <option value="1">Source</option>
                        <option value="2" selected="selected">Traning</option>
                        <?php } ?>

                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMax"><span class="req">* </span> Role List: </label>
                    <select class="form-select getmemberlistclass" name="roleslist" id="roleslist" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($totalResult as $rolename) {
                  if ($rolename['id'] == $rows['roleId']) {  ?>
                        <option value="<?php echo $rolename['id']; ?>" selected="selected">
                            <?php echo $rolename['roleName']; ?></option>
                        <?php  } else { ?>
                        <option value="<?php echo $rolename['id']; ?>"><?php echo $rolename['roleName']; ?></option>
                        <?php }
                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="stages"><span class="req">* </span> Source Member list:
                    </label><br />
                    <div id="roleMemberlist">
                        <?php foreach ($assignRow as $assignVal) { ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" checked="checked" name="memberlist[]"
                                value="<?php echo $assignVal['id']; ?>" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $memberName = getMemberName($assignVal['sourceId']); ?></label>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <?php $regs = md5("tlrassignedit"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-3 text-center">
                <input class="custom-btn" type="submit" name="submit_reg" value="Save">
            </div>
        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
<script type="text/javascript" src="js/registration.js?v=7"></script>
<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Client Edit Registration</h3>
<?php }  ?>