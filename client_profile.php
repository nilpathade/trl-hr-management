<?php
require_once('header/header.php');
// require_once('header/registrationHeader.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
    $message = '<div class="alert alert-success" role="alert">Your profile has been successfully updated.</div>';
} else if ($_GET['message'] == md5('error')) {
    $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($profileAccess != 3) {
    require_once('accesserror.php');
}
$clientId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_client where id = ? and isDeleted= ? and cltId= ?";
$resultRow = pdoQuery($regeditSql, array($userid, 'N', $menuid));
// require_once('header/registrationHeader.php');
// show country list
$contrySql = "select * from tlr_countries where isDeleted= ?";
$countryResult = pdoQuery($contrySql, array('N'));

if (count($resultRow) > 0) {
    foreach ($resultRow as $rows) {

        // show state list
        $stateSql = "select * from tlr_states where isDeleted= ? and countryId = ?";
        $totalstateResult = pdoQuery($stateSql, array('N', $rows['countryId']));

        // show city list 
        $citySql = "select * from tlr_cities where isDeleted= ? and stateId = ?";
        $totalCityResult = pdoQuery($citySql, array('N', $rows['stateId']));

?>
<div class="container-fluid">
    <?php if (!empty($message)) echo $message;   ?>
    <form action="profileupdate.php" method="post" id="fileForm" autocomplete="OFF" enctype="multipart/form-data">
        <h2 class="text-center">Client Profile</h2>
        <fieldset>
            <legend class="text-center mandateinfo mb-4">Valid information is required to register. <span
                    class="req"><small>
                        required *</small></span></legend>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="clientname"><span class="req">* </span> Client name: </label>
                    <input class="form-control" type="text" name="clientname" id="txt" onkeyup="Validate(this)" required
                        value="<?php echo $rows['clientName']; ?>" />
                    <input class="form-control" type="hidden" name="clientId" id="txt2"
                        value="<?php echo $rows['id']; ?>" onkeyup="Validate(this)" required />
                    <div id="errClient"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="email"><span class="req">* </span> Email Address: </label>
                    <input class="form-control emailclass" required type="text" name="email" id="email"
                        onkeyup="client_email_validate(this.value);" value="<?php echo $rows['email']; ?>" />
                    <div id="errMessage"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phonenumber"><span class="req">* </span> Mobile Number: </label>
                    <input required type="text" name="phonenumber" id="phone" class="form-control phone" maxlength="10"
                        onkeyup="validatephone(this);" placeholder="enter mobile number ex 1234567890"
                        value="<?php echo $rows['mobile']; ?>" />
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="address"><span class="textaddress">* </span>Address: </label>
                    <textarea id="form19" class="form-control" name="address" rows="1"
                        placeholder="Enter your address"><?php echo $rows['address']; ?></textarea>
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="country"><span class="req">* </span> Country: </label>
                    <select class="form-control getstatelistclass" name="country" id="country" required>
                        <option selected>select country</option>
                        <?php foreach ($countryResult as $name) {
                                    if ($name['id'] == $rows['countryId']) {  ?>
                        <option value="<?php echo $name['id']; ?>" selected="selected">
                            <?php echo $name['countryName']; ?>
                        </option>
                        <?php  } else { ?>
                        <option value="<?php echo $name['id']; ?>"><?php echo $name['countryName']; ?></option>
                        <?php }
                                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="state"><span class="req">* </span> State: </label>
                    <select class="form-select form-control getCitylistclass" name="state" id="state" required>
                        <option selected>select state</option>
                        <?php foreach ($totalstateResult as $name) {
                                    if ($name['id'] == $rows['stateId']) {  ?>
                        <option value="<?php echo $name['id']; ?>" selected="selected">
                            <?php echo $name['stateName']; ?>
                        </option>
                        <?php  } else { ?>
                        <option value="<?php echo $name['id']; ?>"><?php echo $name['stateName']; ?></option>
                        <?php }
                                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="city"><span class="req">* </span> City: </label>
                    <select class="form-select form-control" name="city" id="city" required>
                        <option selected>select city</option>
                        <?php foreach ($totalCityResult as $cityname) {
                                    if ($cityname['id'] == $rows['cityId']) {  ?>
                        <option value="<?php echo $cityname['id']; ?>" selected="selected">
                            <?php echo $cityname['cityName']; ?></option>
                        <?php  } else { ?>
                        <option value="<?php echo $cityname['id']; ?>"><?php echo $cityname['cityName']; ?></option>
                        <?php }
                                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="description"><span class="textdescription">* </span>Description:
                    </label>
                    <textarea id="form19" class="form-control" name="description" rows="1"
                        placeholder="Enter your description"><?php echo $rows['description']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="spoccontact"><span class="req">* </span> SPOC Contact: </label>
                    <input required type="text" name="spoccontact" id="spoccontact" class="form-control" maxlength="28"
                        onkeyup="validate(this);" placeholder="not used for marketing"
                        value="<?php echo $rows['spocContact']; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="websiteurl"><span class="req">* </span> Website url: </label>
                    <input required type="text" name="websiteurl" id="websiteurl" class="form-control"
                        placeholder="Enter client website URL (Ex: www.google.com)"
                        value="<?php echo $rows['clientWebsite']; ?>" />
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="clientspoc"><span class="req">* </span> Client SPOC: </label>
                    <input class="form-control" type="text" name="clientspoc" id="clientspoc" onkeyup="Validate(this)"
                        placeholder="Client SPOC" required value="<?php echo $rows['clientSpoc']; ?>" />
                    <div id="errclientspoc"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <input type="hidden" name="uploadContractexist" value="<?php echo $rows['uploadContract']; ?>" />
                    <label class="form-label" for="uploadContract"><span class="req">* </span> Upload Contract/SOW:
                    </label>
                    <input type="file" class="form-control" aria-label="file example" name="uploadContract">
                    <?php if (!empty($rows['uploadContract'])) { ?>
                    <div class="form-text"> uploaded contract/SOW <a href="<?php echo $rows['uploadContract']; ?>"
                            target="_blank">Contract/SOW
                        </a></div>
                    <?php } ?>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="iprimedspocClient"><span class="req">* </span> IPRIMED SPOC for
                        client(Lead):
                    </label>
                    <input class="form-control" type="text" name="iprimedspocClient" id="txt" onkeyup="Validate(this)"
                        required placeholder="IPRIMED SPOC for client(Lead)"
                        value="<?php echo $rows['iprimedspocClient']; ?>" />
                    <div id="erriprimedspocClient"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="companyname"><span class="req">* </span> Company Name: </label>
                    <input class="form-control" type="text" name="companyname" id="txt" onkeyup="Validate(this)"
                        required placeholder="Company name" value="<?php echo $rows['companyName']; ?>" />
                    <div id="errCompanyname"></div>
                </div>

                <div class="mb-3">
                    <?php $regs = md5("clientprofileupdate"); ?>
                    <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
                </div>
            </div>

            <div class="mb-5 text-center">
                <input class="custom-btn clientsubmit" type="submit" name="submit_reg" value="Save">
            </div>

        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends row -->
</div>
<script type="text/javascript" src="js/registration.js?v=2"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Something went wrong!</h3>
<?php }  ?>


<!-- <style>
.client-profile {
    background-color: pink;
}
</style> -->