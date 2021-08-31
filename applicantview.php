<?php
require_once('header/dbconnection.php');
error_reporting(0);
$applicantId = encrypt_decrypt('decrypt', $_GET['eid']);
$message = $_GET['message'];
$title = 'Add Applicant';
require_once('header/header.php');
if ($message == md5('success')) {
    $textmessage = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
} else if ($message == md5('error')) {
    $textmessage = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
}
//require_once('header/registrationHeader.php');
?>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<style type="text/css">
.showtab {
    display: none;
}
</style>
<?php
$appSql = "select * from tlr_applicants where isDeleted = ? and id= ?";
$applicantRow = pdoQuery($appSql, array('N', $applicantId));

// show notice period list
$nplistSql = "select * from tlr_noticeperiod where isDeleted= ?";
$nplistResult = pdoQuery($nplistSql, array('N'));

if (count($applicantRow) > 0) {
    //experience tab
    $experienceSql = "select * from tlr_work_experience_details where isDeleted = ? and applicantid= ?";
    $experienceRow = pdoQuery($experienceSql, array('N', $applicantId));

    //certification tab
    $certificateSql = "select * from tlr_certifications where isDeleted = ? and applicantid= ?";
    $certificationRow = pdoQuery($certificateSql, array('N', $applicantId));

    //internship tab
    $internshipSql = "select * from tlr_internship_experience_details where isDeleted = ? and applicantid= ?";
    $internshipRow = pdoQuery($internshipSql, array('N', $applicantId));

    //academic tab
    $academicSql = "select * from tlr_academic_details where isDeleted = ? and applicantid= ?";
    $academicRow = pdoQuery($academicSql, array('N', $applicantId));

    //academic tab
    $skillsSql = "select * from tlr_technicalskills where isDeleted = ? and applicantid= ?";
    $skillsRow = pdoQuery($skillsSql, array('N', $applicantId));

    //academic tab
    $personalSql = "select * from tlr_personal_details where isDeleted = ? and applicantid= ?";
    $personalRow = pdoQuery($personalSql, array('N', $applicantId));

    //academic tab
    $kidSql = "select * from tlr_kids_details where isDeleted = ? and applicantid= ?";
    $kidsRow = pdoQuery($kidSql, array('N', $applicantId));


    $docupload = encrypt_decrypt('decrypt', $applicantRow[0]['docupload']);
    $regs = md5("tlreditapplicantsubmit"); ?>
<style type="text/css">
.showtab {
    display: block;
}

.titlespace {
    margin-left: 10px;
    font-weight: 500;
}
</style>
<?php } else {
    $regs = md5("tlraddapplicantsubmit");
} ?>
<div class="container-fluid">
    <div class="bs-example">
        <?php if (!empty($textmessage)) {
            echo $textmessage;
        } ?>

        <div class="mb-3 col-md-12"><b>Baics Details</b>
            <hr />
        </div>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label" for="applicantname"> Applicant No: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['applicationNo']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="applicantname">Applicant Name: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['name']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="phonenumber">Mobile Number: </label>
                <span class="titlespace"> <?php echo $applicantRow[0]['contactnumber']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="email"> Email Address: </label>

                <span class="titlespace"><?php echo $applicantRow[0]['contactnumber']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="companyname"> Current Company Name: </label>

                <span class="titlespace"><?php echo $applicantRow[0]['currentcompany']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="currentdesignation">Current Designation: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['currentdesignation']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="currentctc"> Current CTC: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['currentctc']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="expectedctc"><span class="req">* </span> Expected CTC: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['expectedctc']; ?></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="noticePeriod"> Notice Peroid: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['noticeperiod']; ?> days</span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="urgencylevel">Urgency Level: </label>
                <span class="titlespace"><?php echo getUrgencyLevel($applicantRow[0]['urgencylevel']); ?>
                    days</span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="urgencylevel">Interest: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['interest']; ?> days</span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="urgencylevel">Uploaded CV: </label>
                <span class="titlespace"><a href="<?php echo $applicantRow[0]['interest']; ?>">Resume</a></span>
            </div>

            <div class="mb-3 col-md-4">
                <label class="form-label" for="urgencylevel">Signature: </label>
                <span class="titlespace"><?php echo $applicantRow[0]['signature']; ?></span>
            </div>
        </div>
        <div class="mb-3 col-md-12"> <b>Work Experience</b>
            <hr />
        </div>
        <?php for ($i = 0; $i < count($experienceRow); $i++) { ?>
        <div class="row">
            <div class="mb-3 col-md-4">
                <label class="form-label" for="certificatename">Company Name: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['company']; ?> </span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Location: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['location'] ?> </span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Designation: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['designation']; ?> </span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Start Date: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['startdate'] ?> </span>
            </div>

            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">End Date: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['enddate'] ?> </span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Description/Role: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['description_role'] ?> </span>
            </div>

            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Responsibilities: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['responsibilities'] ?></span>
            </div>

            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Team Handling Experience: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['teamexp'] ?></span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Last CTC: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['lastctc'] ?> </span>
            </div>

            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">Reason For Job Change: </label>
                <span class="titlespace"> <?php echo $experienceRow[$i]['reason_for_switch'] ?></span>
            </div>
            <div class="mb-3 col-sm-4">
                <label class="form-label" for="certificatename">How To Get: </label>
                <span class="titlespace"><?php echo $experienceRow[$i]['how_get_in'] ?></span>
            </div>
        </div>
        <?php } ?>

        <div class="mb-3 col-md-12"><b>Certification Detail</b>
            <hr />
        </div>
        <?php for ($i = 0; $i < count($certificationRow); $i++) { ?>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label class="form-label" for="certificatename">Certificate Name: </label>
                <span class="titlespace"><?php echo $certificationRow[$i]['certificatename'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Certificate Date: </label>
                <span class="titlespace"><?php echo $certificationRow[$i]['certificatedate'] ?></span>
            </div>

            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Institute/School: </label>
                <span class="titlespace"><?php echo $certificationRow[$i]['institute_school'] ?></span>
            </div>
            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Certificate Validity: </label>
                <span class="titlespace"><?php echo $certificationRow[$i]['validity'] ?></span>
            </div>
            <div class="mb-3 col-sm-9"> </div>
            <?php if ($i < count($certificationRow) - 1) { ?>
            <div class="mb-3 col-md-12">
                <hr />
            </div>
        </div>
        <?php }
            } ?>

        <div class="mb-3 col-md-12"><b>Intership</b>
            <hr />
        </div>
        <?php for ($i = 0; $i < count($internshipRow); $i++) { ?>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label class="form-label" for="certificatename">Company: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['company'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Designation: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['designation'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Start Date: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['start_date'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">End Date: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['end_date'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Description/Role: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['description_roles'] ?></span>
            </div>
            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">How get in: </label>
                <span class="titlespace"><?php echo $internshipRow[$i]['how_get_in'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Stipend: </label>
                <span class="titlespace"> <?php echo $internshipRow[$i]['stipend'] ?></span>
            </div>
            <?php if ($i < count($internshipRow) - 1) { ?>
            <div class="mb-3 col-md-12">
                <hr />
            </div>
        </div>

        <?php }
        } ?>
        <div class="mb-3 col-md-12"><b>Academic Detail</b>
            <hr />
        </div>
        <?php for ($i = 0; $i < count($academicRow); $i++) { ?>
        <div class="row">
            <div class="mb-3 col-md-3">
                <label class="form-label" for="certificatename">Education Degree: </label>
                <span class="titlespace"> <?php echo $academicRow[$i]['education'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Percentage: </label>
                <span class="titlespace"> <?php echo $academicRow[$i]['percentage'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">University/Board: </label>
                <span class="titlespace"> <?php echo $academicRow[$i]['board_university'] ?></span>
            </div>
            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Institute/School: </label>
                <span class="titlespace"> <?php echo $academicRow[$i]['school_collage'] ?></span>
            </div>

            <div class="mb-3 col-sm-3">
                <label class="form-label" for="certificatename">Location: </label>
                <span class="titlespace"><?php echo $academicRow[$i]['location'] ?></span>
            </div>
            <?php if ($i < count($academicRow) - 1) { ?>
            <div class="mb-3 col-md-12">
                <hr />
            </div>
        </div>
        <?php }
    } ?>

        <div class="mb-3 col-md-12"><b>Skills</b>
            <hr />
        </div>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Technical skills: </label>
                <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>"
                    id="applicantId" required value="" placeholder="Applicant name" />
                <input class="form-control" type="hidden" name="skillId" value="<?php echo $skillsRow[0]['id']; ?>"
                    id="skillId" required />
                <textarea id="form19" class="md-textarea form-control" name="technicallskills" rows="3"
                    placeholder="Enter your technical skills"><?php echo $skillsRow[0]['technicallskills']; ?></textarea>
            </div>

            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Personality Traits: </label>
                <textarea id="form19" class="md-textarea form-control" name="personalitytraits" rows="3"
                    placeholder="Enter your Personality Traits"><?php echo $skillsRow[0]['personalitytraits']; ?></textarea>
            </div>

        </div>
        <div class="mb-3 col-md-12"><b>Personal Detail</b>
            <hr />
        </div>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Date of Birth: </label>
                <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>"
                    id="applicantId" required value="" placeholder="Applicant name" />
                <input class="form-control" type="hidden" name="personalId" value="<?php echo $personalRow[0]['id']; ?>"
                    id="personalId" required />
                <input class="form-control" type="date" name="dateofbirth" id="dateofbirth" required
                    value="<?php echo $personalRow[0]['dateofbirth'] ?>" />
            </div>

            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Anniversary: </label>
                <input class="form-control" type="date" name="anniversary" id="anniversary" required
                    value="<?php echo $personalRow[0]['anniversary'] ?>" />
            </div>
        </div>
        <div class="mb-3 col-md-12"><b>Kids Detail</b>
            <hr />
        </div>

        <?php for ($i = 0; $i < count($kidsRow); $i++) { ?>
        <div class="row">
            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Kid Name: </label>
                <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>"
                    id="applicantId" required value="" placeholder="Applicant name" />
                <input class="form-control" type="hidden" name="kidId" value="<?php echo $kidsRow[$i]['id']; ?>"
                    id="kidId" required />
                <input class="form-control" type="text" name="kids_name[]" id="kids_name" required
                    value="<?php echo $kidsRow[$i]['kids_name'] ?>" />
            </div>

            <div class="mb-3 col-sm-6">
                <label class="form-label" for="certificatename">Birthday: </label>
                <input class="form-control" type="date" name="kids_birthday[]" id="kids_birthday" required
                    value="<?php echo $kidsRow[$i]['birthday'] ?>" />
            </div>
        </div>

        <?php } ?>
    </div>
</div>
</body>

</html>
<script type="text/javascript" src="js/registration.js?v=7"></script>
<script type="text/javascript" src="js/testapplicant.js?v=9"></script>