<?php
require_once('header/header.php');
if ($roleAccess != 3) {
    require_once('accesserror.php');
}
$roleId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_rolemaster where id = ? and isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array($roleId, 'N'));
require_once('header/registrationHeader.php');

if (count($resultRow) > 0) {
    foreach ($resultRow as $rows) {
?>
<div class="container-fluid">
    <form action="rolemastersubmit.php" method="post" id="fileForm" autocomplete="OFF" enctype="multipart/form-data">
        <fieldset>
            <legend class="text-center mandateinfo mb-4">Valid information is required to register. <span
                    class="req"><small>
                        required *</small></span></legend>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="country"><span class="req">* </span> Role Type: </label>
                    <select class="form-select" name="roletype" id="roletype" required>
                        <option selected>select team</option>
                        <?php if ('1' == $rows['roleType']) {  ?>
                        <option value="1" selected="selected">Source Team</option>
                        <option value="2">Training Team</option>
                        <?php  } else { ?>
                        <option value="1">Source Team</option>
                        <option value="2" selected="selected">Training Team</option>
                        <?php }  ?>
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="clientname"><span class="req">* </span> Role name: </label>
                    <input class="form-control rolenameclass" type="text" name="rolename" id="txt"
                        onkeyup="roleValidate(this)" required value="<?php echo $rows['roleName']; ?>" />
                    <input class="form-control" type="hidden" name="roleId" id="txt2" value="<?php echo $rows['id']; ?>"
                        onkeyup="Validate(this)" required />
                    <div id="errMessage"></div>
                </div>
            </div>

            <div class="mb-3">
                <?php $regs = md5("tlreditrole"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-3 text-center">
                <input class="custom-btn chkrolename" type="submit" name="submit_reg" value="Save">
            </div>

        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
</div>
<script type="text/javascript" src="js/registration.js?v=3"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Client Edit Registration</h3>
<?php }  ?>