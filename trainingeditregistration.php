<?php
require_once('header/header.php');
if ($trainingAccess != 3) {
    require_once('accesserror.php');
}
$sourceId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_sourcingteam where id = ? and roleType = ? and isDeleted= ?";
$resultRow = pdoQuery($regeditSql, array($sourceId, 2, 'N',));
require_once('header/registrationHeader.php');
// show role list
$roleSql = "select * from tlr_rolemaster where isDeleted= ? and roleType = ?";
$totalRoleResult = pdoQuery($roleSql, array('N', 2));

if (count($resultRow) > 0) {
    foreach ($resultRow as $rows) {
?>
<div class="container-fluid">
    <form action="trainingregistrationsubmit.php" method="post" id="fileForm" autocomplete="OFF"
        enctype="multipart/form-data">
        <fieldset>
            <legend class="text-center mandateinfo mb-4">Valid information is required to register. <span
                    class="req"><small>
                        required *</small></span></legend>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="firstname"><span class="req">* </span> First name: </label>
                    <input class="form-control" type="text" name="firstname" id="txt" onkeyup="Validate(this)" required
                        value="<?php echo $rows['firstName']; ?>" />
                    <input class="form-control" type="hidden" name="sourceId" id="txt2"
                        value="<?php echo $rows['id']; ?>" onkeyup="Validate(this)" required />
                    <div id="errfirstname"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="lastname"><span class="req">* </span> Last name: </label>
                    <input class="form-control" type="text" name="lastname" id="txt"
                        value="<?php echo $rows['lastName']; ?>" onkeyup="Validate(this)" required />
                    <div id="errlastname"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="email"><span class="req">* </span> Email Address: </label>
                    <input class="form-control emailclass" required type="text" name="email" id="email"
                        onkeyup="training_email_validate(this.value);" value="<?php echo $rows['email']; ?>" />
                    <div id="errMessage"></div>
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phonenumber"><span class="req">* </span> Mobile Number: </label>
                    <input required type="text" name="phonenumber" id="phone" class="form-control phone" maxlength="10"
                        onkeyup="validatephone(this);" placeholder="enter mobile number ex 1234567890"
                        value="<?php echo $rows['mobile']; ?>" />
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="address"><span class="currentcompany">* </span>Current Company:
                    </label>
                    <input class="form-control" type="text" name="currentcompany"
                        value="<?php echo $rows['currentCompany']; ?>" id="txt" onkeyup="Validate(this)" required />
                    <div id="errcurrentcompany"></div>
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="address"><span class="currentdesignation">* </span>Current
                        Designation:
                    </label>
                    <input class="form-control" type="text" name="currentdesignation"
                        value="<?php echo $rows['currentDesignation']; ?>" id="txt" onkeyup="Validate(this)" required />
                    <div id="errcurrentdesignation"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="address"><span class="currentdepartment">* </span>Current Department:
                    </label>
                    <input class="form-control" type="text" name="currentdepartment"
                        value="<?php echo $rows['currentDepartment']; ?>" id="txt" onkeyup="Validate(this)" required />
                    <div id="errcurrentdepartment"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="country"><span class="req">* </span> Status: </label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="" hidden>Select</option>
                        <?php if ($rows['status'] == 'active') { ?>
                        <option value="active" selected="selected">Active</option>
                        <option value="suspend">Suspend</option>
                        <?php   } else { ?>
                        <option value="active">Active</option>
                        <option value="suspend" selected="selected">Suspend</option>
                        <?php    } ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="country"><span class="req">* </span> Role: </label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($totalRoleResult as $name) {
                                    if ($name['id'] == $rows['role']) { ?>
                        <option value="<?php echo $name['id']; ?>" selected="selected"><?php echo $name['roleName']; ?>
                        </option>
                        <?php  } else { ?>
                        <option value="<?php echo $name['id']; ?>"><?php echo $name['roleName']; ?></option>
                        <?php }
                                }  ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <?php $regs = md5("trainingeditsubmit"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-5 text-center">
                <input class="custom-btn trainingsubmit" type="submit" name="submit_reg" value="Save">
            </div>

        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
</div>
<script type="text/javascript" src="js/registration.js?v=2"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Client Edit Registration</h3>
<?php }  ?>