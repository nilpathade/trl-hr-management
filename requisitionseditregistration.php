<?php
require_once('header/header.php');
if ($requisitionAccess != 3) {
  require_once('accesserror.php');
}
$reqId = encrypt_decrypt('decrypt', $_GET['eid']);
$regeditSql = "select * from tlr_requisitions where isDeleted= ? and clientId = ? and id= ?";
$resultRow = pdoQuery($regeditSql, array('N', $userid, $reqId));
// require_once('header/registrationHeader.php');
// show country list
$contrySql = "select * from tlr_countries where isDeleted= ?";
$countryResult = pdoQuery($contrySql, array('N'));

// show notice period list
$nplistSql = "select * from tlr_noticeperiod where isDeleted= ?";
$nplistResult = pdoQuery($nplistSql, array('N'));

// show selection stages list
$stagesSql = "select * from tlr_selectionstages where isDeleted= ? and reqId= ?";
$totalstages = pdoQuery($stagesSql, array('N', $reqId));

if (count($resultRow) > 0) {
  foreach ($resultRow as $rows) {

    // show state list
    $stateSql = "select * from tlr_states where isDeleted= ? and countryId = ?";
    $totalstateResult = pdoQuery($stateSql, array('N', $rows['country']));

    // show city list 
    $citySql = "select * from tlr_cities where isDeleted= ? and stateId = ?";
    $totalCityResult = pdoQuery($citySql, array('N', $rows['state']));

    $selectedStages = explode(',', $rows['stages']);
?>
<div class="container-fluid">
    <form action="requisitionsubmit.php" method="post" id="fileForm" role="form" enctype="multipart/form-data">
        <fieldset>
            <legend class="text-center mandateinfo">Valid information is required to register. <span class="req"><small>
                        required *</small></span></legend>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="designation"><span class="req">* </span> Designation: </label>
                    <input class="form-control" type="text" name="designation"
                        value="<?php echo $rows['designation']; ?>" id="txt" onkeyup="Validate(this)" required />
                    <input class="form-control" type="hidden" name="reqId" id="txt2" value="<?php echo $rows['id']; ?>"
                        onkeyup="Validate(this)" required />
                    <div id="errDesignation"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMin"><span class="req">* </span> Minium experience:
                    </label>
                    <input class="form-control" type="number" name="experienceMin"
                        value="<?php echo $rows['experienceMin']; ?>" min="00" max="100" id="txt"
                        onkeyup="validatephone(this)" required />
                    <div id="errExperienceMin"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="experienceMax"><span class="req">* </span> Maximum experience:
                    </label>
                    <input class="form-control" type="number" value="<?php echo $rows['experienceMax']; ?>" min="00"
                        max="100" name="experienceMax" id="txt" onkeyup="validatephone(this)" required />
                    <div id="errExperienceMax"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="ctcRangeMin"><span class="req">* </span> Minium CTC: </label>
                    <input class="form-control" type="text" name="ctcRangeMin"
                        value="<?php echo $rows['ctcRangeMin']; ?>"  id="txt"
                        onkeyup="ctcValidate(this)" required />
                    <div id="errctcRangeMin"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="ctcRangeMax"><span class="req">* </span> Maximum CTC: </label>
                    <input class="form-control" type="text" value="<?php echo $rows['ctcRangeMax']; ?>" name="ctcRangeMax" id="txt" onkeyup="ctcValidate(this)" required />
                    <div id="errctcRangeMax"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="noticePeriod"><span class="req">* </span> Notice Peroid: </label>
                    <select class="form-select" name="noticePeriod" id="noticePeriod" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($nplistResult as $name) {
                  if ($name['npdays'] == $rows['noticePeriod']) {  ?>
                        <option value="<?php echo $name['npdays']; ?>" selected="selected">
                            <?php echo $name['npdaysname']; ?></option>
                        <?php  } else { ?>
                        <option value="<?php echo $name['npdays']; ?>"><?php echo $name['npdaysname']; ?></option>
                        <?php }
                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="country"><span class="req">* </span> Country: </label>
                    <select class="form-select getstatelistclass" name="country" id="country" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($countryResult as $name) {
                  if ($name['id'] == $rows['country']) {  ?>
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
                    <select class="form-select getCitylistclass" name="state" id="state" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($totalstateResult as $name) {
                  if ($name['id'] == $rows['state']) {  ?>
                        <option value="<?php echo $name['id']; ?>" selected="selected"><?php echo $name['stateName']; ?>
                        </option>
                        <?php  } else { ?>
                        <option value="<?php echo $name['id']; ?>"><?php echo $name['stateName']; ?></option>
                        <?php }
                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="city"><span class="req">* </span> City: </label>
                    <select class="form-select" name="city" id="city" required>
                        <option value="" hidden>Select</option>
                        <?php foreach ($totalCityResult as $cityname) {
                  if ($cityname['id'] == $rows['city']) {  ?>
                        <option value="<?php echo $cityname['id']; ?>" selected="selected">
                            <?php echo $cityname['cityName']; ?></option>
                        <?php  } else { ?>
                        <option value="<?php echo $cityname['id']; ?>"><?php echo $cityname['cityName']; ?></option>
                        <?php }
                }  ?>
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="resourceCount"><span class="req">* </span> Resource Count: </label>
                    <input class="form-control" type="number" value="<?php echo $rows['resourceCount']; ?>"
                        name="resourceCount" min="00" max="100" id="txt" onkeyup="validatephone(this)" required />
                    <div id="errresourceCount"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="startDate"><span class="req">* </span> Start Date: </label>
                    <input type="date" id="startDate" value="<?php echo $rows['startDate']; ?>" name="startDate"
                        min="2000-01-02" required class="form-control" />
                    <div id="errstartDate"></div>
                </div>


                <div class="mb-3 col-md-6">
                    <label class="form-label" for="endDate"><span class="req">* </span> End Date: </label>
                    <input type="date" id="endDate" value="<?php echo $rows['endDate']; ?>" name="endDate"
                        min="2000-01-02" required class="form-control" />
                    <div id="errendDate"></div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="keyTechnicalSkills"><span class="keyTechnicalSkills">*
                        </span>Technical
                        Key Skills: </label>
                    <textarea id="form19" class="md-textarea form-control" name="keyTechnicalSkills"
                        rows="3"><?php echo $rows['keyTechnicalSkills']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="otherSkill"><span class="otherSkill">* </span>Other Skills: </label>
                    <textarea id="form19" class="md-textarea form-control" name="otherSkill"
                        rows="3"><?php echo $rows['otherSkill']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="comment"><span class="comment">* </span>Comment: </label>
                    <textarea id="form19" class="md-textarea form-control" name="comment"
                        rows="3"><?php echo $rows['comment']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="jdUpload"><span class="jdUpload">* </span>Job Description: </label>
                    <textarea id="form19" class="md-textarea form-control" name="jdUpload"
                        rows="3"><?php echo $rows['jdUpload']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="iptest">IP Test: </label>
                    <textarea id="form19" class="md-textarea form-control" name="iptest"
                        rows="1"><?php echo $rows['iptest']; ?></textarea>
                </div>

                <div class="mb-3 col-md-6" id="stagesRefresh">
                    <label class="form-label" for="stages"><span class="req">* </span> Stages: </label>
                    <div class="row">
                        <div class="col">
                            <select class="form-control" name="stages[]" id="stages" required>
                                <?php $temp = 0;
                    foreach ($totalstages as $stages) {
                      foreach ($selectedStages as $val) {
                        if ($val == $stages['id']) {
                          $temp = 1;
                        }
                      }
                      if ($temp != 0) { ?>
                                <option value="<?php echo $stages['id']; ?>" selected="selected">
                                    <?php echo $stages['stageName']; ?>
                                </option>
                                <?php $temp = 0;
                      } else {  ?>
                                <option value="<?php echo $stages['id']; ?>"><?php echo $stages['stageName']; ?>
                                </option>
                                <?php }
                    }  ?>
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" class="custom-btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Add stage
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-6">
                <?php $regs = md5("tlreditrequisitions"); ?>
                <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
            </div>

            <div class="mb-3 text-center">
                <input class="custom-btn" type="submit" name="submit_reg" value="Save">
            </div>

        </fieldset>
    </form><!-- ends register form -->
</div><!-- ends col-6 -->
</div>
<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="stagevalue"><span class="req">* </span> Add stage: </label>
                        <input class="form-control stagevalueclass" type="text" name="stagevalue" id="txt"
                            onkeyup="Validate(this)" required />
                        <div id="errstagevalue"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary addstages">Save changes</button>
            </div>
        </div>
    </div>
</div> -->





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="stagevalue"><span class="req">* </span> Add stage: </label>
                        <input class="form-control stagevalueclass" type="text" name="stagevalue" id="txt"
                            onkeyup="Validate(this)" required />
                        <div id="errstagevalue"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="custom-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="custom-btn custom-btn2 addstages">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/registration.js?v=3"></script>

<?php }
} else {  ?>
<h3 class="text-center mt-5 mb-5">Something went wrong!</h3>
<?php }  ?>