<?php
require_once('header/dbconnection.php');
error_reporting(0);
$applicantId =encrypt_decrypt('decrypt',$_GET['eid']);
$message =$_GET['message'];
$title = 'Add Applicant';
require_once('header/header.php');
if($message == md5('success')){
    $textmessage = '<div class="alert alert-success" role="alert">You have successfully registered.</div>';
}else if($message == md5('error')){
     $textmessage = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
}
//require_once('header/registrationHeader.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<style type="text/css">
    .showtab{
        display: none;
    }
</style>
<?php
$appSql = "select * from tlr_applicants where isDeleted = ? and id= ?";
$applicantRow = pdoQuery($appSql,array('N',$applicantId));

// show notice period list
 $nplistSql = "select * from tlr_noticeperiod where isDeleted= ?";
 $nplistResult = pdoQuery($nplistSql,array('N'));

if(count($applicantRow) > 0){ 
//experience tab
 $experienceSql = "select * from tlr_work_experience_details where isDeleted = ? and applicantid= ?";
 $experienceRow = pdoQuery($experienceSql,array('N',$applicantId));

 //certification tab
 $certificateSql = "select * from tlr_certifications where isDeleted = ? and applicantid= ?";
 $certificationRow = pdoQuery($certificateSql,array('N',$applicantId));

  //internship tab
 $internshipSql = "select * from tlr_internship_experience_details where isDeleted = ? and applicantid= ?";
 $internshipRow = pdoQuery($internshipSql,array('N',$applicantId));

 //academic tab
 $academicSql = "select * from tlr_academic_details where isDeleted = ? and applicantid= ?";
 $academicRow = pdoQuery($academicSql,array('N',$applicantId));

  //academic tab
 $skillsSql = "select * from tlr_technicalskills where isDeleted = ? and applicantid= ?";
 $skillsRow = pdoQuery($skillsSql,array('N',$applicantId));

  //academic tab
 $personalSql = "select * from tlr_personal_details where isDeleted = ? and applicantid= ?";
 $personalRow = pdoQuery($personalSql,array('N',$applicantId));

   //academic tab
 $kidSql = "select * from tlr_kids_details where isDeleted = ? and applicantid= ?";
 $kidsRow = pdoQuery($kidSql,array('N',$applicantId));
 

$docupload = encrypt_decrypt('decrypt',$applicantRow[0]['docupload']);
$regs = md5("tlreditapplicantsubmit"); ?>
<style type="text/css">
    .showtab{
        display: block;
    }
</style>
<?php }else{ 
$regs = md5("tlraddapplicantsubmit");
} ?>
<div class="col-md-12">
<div class="bs-example">
     <?php if(!empty($textmessage)){ echo $textmessage; } ?>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#home" class="nav-link active" data-toggle="tab">Baics Details</a>
        </li>
        <li class="nav-item">
            <a href="#experience" class="nav-link showtab" data-toggle="tab">Work Experience</a>
        </li>
        <li class="nav-item">
            <a href="#certification" class="nav-link showtab" data-toggle="tab">Certification Details</a>
        </li>
         <li class="nav-item">
            <a href="#internship" class="nav-link showtab" data-toggle="tab">Internship</a>
        </li>
         <li class="nav-item">
            <a href="#academic" class="nav-link showtab" data-toggle="tab">Academic Details</a>
        </li>
         <li class="nav-item">
            <a href="#skills" class="nav-link showtab" data-toggle="tab">Skills</a>
        </li>
           <li class="nav-item">
            <a href="#personaldetail" class="nav-link showtab" data-toggle="tab">Personal Details</a>
        </li>
         <li class="nav-item">
            <a href="#kids" class="nav-link showtab" data-toggle="tab">Kids Details</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="home">
            <br/>
             <span class="" style="font-size: 12px;float: right;"><b>Valid information is required to register.</b> <span class="req"><small> required *</small></span></span></br>
            <form action="addapplicantsubmit.php"  method="post" id="applicantform" enctype="multipart/form-data">
                <div class="form-row ml-3">
                 <div class="form-group col-md-6 ">   
                    <label for="applicantname"><span class="req">* </span> Applicant name: </label>
                        <input class="form-control" type="text" name="applicantname" value="<?php echo $applicantRow[0]['name']; ?>" id = "txt"  required value="" placeholder="Applicant name" onkeyup = "Validate(this)" /> 
                        <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                        <div id="errClient"></div>    
                </div>

                <div class="form-group col-md-6">
                <label for="phonenumber"><span class="req">* </span> Mobile Number: </label>
                        <input required type="text" name="phonenumber" id="phone"  class="form-control phone" maxlength="10" placeholder="Enter Mobile number ex 1234567890" value="<?php echo $applicantRow[0]['contactnumber']; ?>" /> 
                </div>

                <div class="form-group col-md-6">
                    <label for="email"><span class="req">* </span> Email Address: </label> 
                        <input class="form-control emailapplicantclass" required type="text" name="email" value="<?php echo $applicantRow[0]['email']; ?>" id = "email" placeholder="Email Address"  onkeyup = "applicant_email_validate(this.value);" />   
                        <div id="errMessage"></div>
                </div>

                <div class="form-group col-md-6">   
                    <label for="companyname"><span class="req">* </span> Current Company Name: </label>
                        <input class="form-control" type="text" name="companyname" value="<?php echo $applicantRow[0]['currentcompany']; ?>" id = "txt"  required placeholder="Company name" value="" /> 
                        <div id="errCompanyname"></div>    
                </div>

                <div class="form-group col-md-6">   
                    <label for="currentdesignation"><span class="req">* </span> Current Designation: </label>
                        <input class="form-control" type="text" name="currentdesignation" value="<?php echo $applicantRow[0]['currentdesignation']; ?>" id = "currentdesignation"  required placeholder="Current Designation" value="" /> 
                        <div id="errcurrentdesignation"></div>    
                </div>

                <div class="form-group col-md-6">   
                    <label for="currentctc"><span class="req">* </span> Current CTC: </label>
                        <input class="form-control" type="text" name="currentctc" value="<?php echo $applicantRow[0]['currentctc']; ?>" id = "currentctc"  required placeholder="Current CTC" value="" /> 
                        <div id="errcurrentctc"></div>    
                </div>

                <div class="form-group col-md-6">   
                    <label for="expectedctc"><span class="req">* </span> Expected CTC: </label>
                        <input class="form-control" type="text" name="expectedctc" value="<?php echo $applicantRow[0]['expectedctc']; ?>" id = "expectedctc"  required placeholder="Expected CTC" value="" /> 
                        <div id="errexpectedctc"></div>    
                </div>

                <div class="form-group col-md-6">   
                    <label for="noticePeriod"><span class="req">* </span> Notice Peroid: </label>
                    <select class="form-control" name="noticePeriod" id="noticePeriod" required>
                      <option selected>notice period</option>
                     <?php foreach ($nplistResult as $name) { 
                        if($applicantRow[0]['noticeperiod'] == $name['npdays']) { ?>
                       <option value="<?php echo $name['npdays']; ?>" selected="selected"><?php echo $name['npdaysname']; ?></option>
                      <?php }else{ ?>
                         <option value="<?php echo $name['npdays']; ?>"><?php echo $name['npdaysname']; ?></option>
                     <?php } }?>
                    </select>    
                </div>
                 
                <div class="form-group col-md-6">
                <label for="urgencylevel"><span class="req">* </span> Urgency Level: </label>
                        <select class="form-control" name="urgencylevel" id="urgencylevel" required>
                        <option value="null"selected>select urgency level</option>
                        <option value="1">Actively searching</option>
                        <option value="2">Casually looking out</option>
                        <option value="3">Depends on job lucrativeness </option>
                        </select>
                </div>

                

                <div class=" form-group md-form amber-textarea active-amber-textarea col-md-6">
                    <label for="interest"><span class="textdescription">* </span>Interest: </label> 
                    <textarea id="form19" class="md-textarea form-control" name="interest" rows="3" placeholder="Enter your interest"><?php echo $applicantRow[0]['interest']; ?></textarea>
                </div>
                
                  <div class="form-group col-md-6">
                  <label for="uploadcv"><span class="req">* </span> Upload CV: </label>
                    <input type="file" class="form-control" aria-label="file example" name="uploadcv"> 
                   <?php if(!empty($docupload)){ ?> To view check you resume <a href="<?php echo $docupload; ?>" target="_blank" >click here</a> <?php } ?>
                    <input class="form-control" type="hidden" name="existcvs" value="<?php echo $applicantRow[0]['docupload']; ?>" id = "existcvs"  required placeholder="Signature" value="" /> 

                  </div>                
                <div class="form-group col-md-6">   
                  <label for="signature"><span class="req">* </span> Signature : </label>
                      <input class="form-control" type="text" name="signature" value="<?php echo $applicantRow[0]['signature']; ?>" id = "signature"  required placeholder="Signature" value="" /> 
                        <input type="hidden" name="registration" value="<?php echo $regs; ?>" />
                      <div id="errsignature"></div>    
                </div>
                 <?php if(count($applicantRow) == 0){ ?>
               <div class="form-group col-md-12">
                    <label for="declearation"><span class="req">* </span>Declearation</label>
                    <input type="checkbox" name="declearation" id="declearation" value="1">
                    <span style="font-size: 12px">The above information is true to the best of my knowledge and I authorize iPRIMED to share my resume with its prospective employers basis the available opening</span>
                </div>
                           
                  <div class="form-group btnleft">
                   
                      <input class="btn btn-primary applicantbtnsubmit" type="submit" name="submit_reg" value="Add Applicant" />
                      </div>
                    <?php }else{ ?>
                        <div class="form-group btnleft">
                        <input class="btn btn-primary applicantbtnsubmit" type="submit" name="submit_reg" value="Update Applicant" />
                        </div>
                    <?php } ?>
                  
                </div>    
            </form>
        </div>
        <div class="tab-pane fade showtab" id="experience">
            
             <div id="workexperiencedetails" class="mt-3 ml-3">
               
                <form action="addapplicantsubmit.php"  method="post" id="experienceform" enctype="multipart/form-data">

             
                            <div class="form-row"> 
                            <div class="form-group col-md-3">
                               <label for="certificatename">Company Name: </label>
                                 <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                                  <input class="form-control" type="hidden" name="experienceId[]" value="<?php echo $experienceRow[0]['id']; ?>" id = "experienceId"  required  />
                                 <input class="form-control" type="text" name="wedcompany[]" id = "wedcompany"  required placeholder="enter company name here" value="<?php echo $experienceRow[0]['company'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Location: </label>
                                 <input class="form-control" type="text" name="wedlocation[]" id = "wedlocation"  required placeholder="enter location here" value="<?php echo $experienceRow[0]['location'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Designation: </label>
                                 <input class="form-control" type="text" name="weddesignation[]" id = "weddesignation"  required placeholder="enter designation here" value="<?php echo $experienceRow[0]['designation'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                               <label for="certificatename">Start Date: </label>
                                <input class="form-control" type="date" name="wedstartdate[]" id = "wedstartdate"  required value="<?php echo $experienceRow[0]['startdate'] ?>" /> 
                            </div>
                
                            <div class="form-group col-sm-3">
                               <label for="certificatename">End Date: </label>
                                <input class="form-control" type="date" name="wedenddate[]" id = "wedenddate"  required  value="<?php echo $experienceRow[0]['enddate'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                               <label for="certificatename">Description/Role: </label>
                                <input class="form-control" type="text" name="weddescriptionrole[]" id = "weddescriptionrole"  required placeholder="enter description role here" value="<?php echo $experienceRow[0]['description_role'] ?>" /> 
                            </div>

                            <div class="form-group col-sm-3">
                               <label for="certificatename">Responsibilities: </label>
                                <input class="form-control" type="text" name="wedresponsibilities[]" id = "wedresponsibilities"  required placeholder="enter responsibilities role here" value="<?php echo $experienceRow[0]['responsibilities'] ?>" /> 
                            </div>
                           
                            <div class="form-group col-sm-3">
                               <label for="certificatename">Team Handling Experience: </label>
                                <input class="form-control" type="text" name="wedteamexp[]" id = "wedteamexp"  required placeholder="enter team experience here" value="<?php echo $experienceRow[0]['teamexp'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                 <label for="certificatename">Last CTC: </label>
                                 <input class="form-control" type="text" name="wedlastctc[]" id = "wedlastctc"  required placeholder="enter your last CTC" value="<?php echo $experienceRow[0]['lastctc'] ?>" /> 
                            </div>
                            
                            <div class="form-group col-sm-3">
                               <label for="certificatename">Reason For Job Change: </label>
                                <input class="form-control" type="text" name="wedreasonforswitch[]" id = "wedreasonforswitch"  required placeholder="enter job change reason" value="<?php echo $experienceRow[0]['reason_for_switch'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                               <label for="certificatename">How To Get: </label>
                                 <input class="form-control" type="text" name="wedhowtoget[]" id = "wedhowtoget"  required placeholder="how to get" value="<?php echo $experienceRow[0]['how_get_in'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3 mt-4">
                              <?php if(!empty($experienceRow[0]['id'])){ ?>
                              <input type="button" class="btn btn-danger mt-2" onclick="deleteExperience(<?php echo $experienceRow[0]['id']; ?>)"  value="Delete"> <?php } ?>
                            </div>
                            
                            <?php for($i=1;$i<count($experienceRow);$i++){ ?>
                              <div class="form-group col-md-12">    <hr/></div>
                            <div class="form-group col-md-3">
                                <label for="certificatename">Company Name: </label>
                                 <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                                 <input class="form-control" type="hidden" name="experienceId[]" value="<?php echo $experienceRow[$i]['id']; ?>" id = "experienceId"  required  /> 
                                 <input class="form-control" type="text" name="wedcompany[]" id = "wedcompany"  required placeholder="enter company name here" value="<?php echo $experienceRow[$i]['company']; ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Location: </label>
                                 <input class="form-control" type="text" name="wedlocation[]" id = "wedlocation"  required placeholder="enter location here" value="<?php echo $experienceRow[$i]['location'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Designation: </label>
                                 <input class="form-control" type="text" name="weddesignation[]" id = "weddesignation"  required placeholder="enter designation here" value="<?php echo $experienceRow[$i]['designation'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Start Date: </label>
                                <input class="form-control" type="date" name="wedstartdate[]" id = "wedstartdate"  required value="<?php echo $experienceRow[$i]['startdate'] ?>" /> 
                            </div>
                
                            <div class="form-group col-sm-3">
                                <label for="certificatename">End Date: </label>
                                <input class="form-control" type="date" name="wedenddate[]" id = "wedenddate"  required  value="<?php echo $experienceRow[$i]['enddate'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Description/Role: </label>
                                <input class="form-control" type="text" name="weddescriptionrole[]" id = "weddescriptionrole"  required placeholder="enter description role here" value="<?php echo $experienceRow[$i]['description_role'] ?>" /> 
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="certificatename">Responsibilities: </label>
                                <input class="form-control" type="text" name="wedresponsibilities[]" id = "wedresponsibilities"  required placeholder="enter responsibilities role here" value="<?php echo $experienceRow[$i]['responsibilities'] ?>" /> 
                            </div>
                           
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Team Handling Experience: </label>
                                <input class="form-control" type="text" name="wedteamexp[]" id = "wedteamexp"  required placeholder="enter team experience here" value="<?php echo $experienceRow[$i]['teamexp'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Last CTC: </label>
                                 <input class="form-control" type="text" name="wedlastctc[]" id = "wedlastctc"  required placeholder="enter your last CTC" value="<?php echo $experienceRow[$i]['lastctc'] ?>" /> 
                            </div>
                            
                            <div class="form-group col-sm-3">
                                <label for="certificatename">Reason For Job Change: </label>
                                <input class="form-control" type="text" name="wedreasonforswitch[]" id = "wedreasonforswitch"  required placeholder="enter job change reason" value="<?php echo $experienceRow[$i]['reason_for_switch'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="certificatename">How To Get: </label>
                                 <input class="form-control" type="text" name="wedhowtoget[]" id = "wedhowtoget"  required placeholder="how to get" value="<?php echo $experienceRow[$i]['how_get_in'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3 mt-4">
                              <input type="button" class="btn btn-danger mt-2" onclick="deleteExperience(<?php echo $experienceRow[$i]['id']; ?>)"  value="Delete">
                            </div>           
                           
                            <?php } ?>
                
                            <div class="order-list  applicantcss" >
                            </div>
    
                            <div  class="form-group col-sm-2">
                                <input type="button" class="btn btn-warning mt-3 " id="addrow" value="Add Experiance" />
                            </div>
                            <div  class="form-group col-sm-2">
                                 <input type="hidden" name="registration" value="<?php echo md5('experience'); ?>" />
                            <input type="submit" class="btn btn-primary mt-3" id="addrow" value="update experience" />
                            </div>
                    </div>
               </form>
            </div>
        </div>
        <div class="tab-pane fade showtab" id="certification">
             <div id="certification" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="experienceform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Certificate Name: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                            <input class="form-control" type="hidden" name="certificateId[]" value="<?php echo $certificationRow[0]['id']; ?>" id = "certificateId"  required  />
                         <input class="form-control" type="text" name="wedcertificate[]" id = "wedcertificate"  required placeholder="certificate name" value="<?php echo $certificationRow[0]['certificatename'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Certificate Date: </label>
                         <input class="form-control" type="date" name="weddate[]" id = "weddate"  required value="<?php echo $certificationRow[0]['certificatedate'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="certificatename">Institute/School: </label>
                            <input class="form-control" type="text" name="wedinstitute_school[]" id = "wedinstitute_school"  required placeholder="Institute/School" value="<?php echo $certificationRow[0]['institute_school'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Certificate Validity: </label>
                          <input class="form-control" type="text" name="wedvalidity[]" id = "wedvalidity"  required placeholder="certificate validity" value="<?php echo $certificationRow[0]['validity'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-6 mt-4">
                          <?php if(!empty($certificationRow[0]['id'])){ ?>
                          <input type="button" class="btn btn-danger mt-2" onclick="deleteCertification(<?php echo $certificationRow[0]['id']; ?>)"  value="Delete"> <?php } ?>
                        </div>
                        <?php for($i=1;$i<count($certificationRow);$i++){ ?>
                              <div class="form-group col-md-12">    <hr/></div>
                            <div class="form-group col-md-3">
                              <label for="certificatename">Certificate Name: </label>
                                 <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                                   <input class="form-control" type="hidden" name="certificateId[]" value="<?php echo $certificationRow[$i]['id']; ?>" id = "certificateId"  required  />
                                <input class="form-control" type="text" name="wedcertificate[]" id = "wedcertificate"  required placeholder="certificate name" value="<?php echo $certificationRow[$i]['certificatename'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Certificate Date: </label>
                         <input class="form-control" type="date" name="weddate[]" id = "weddate"  required value="<?php echo $certificationRow[$i]['certificatedate'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="certificatename">Institute/School: </label>
                            <input class="form-control" type="text" name="wedinstitute_school[]" id = "wedinstitute_school"  required placeholder="Institute/School" value="<?php echo $certificationRow[$i]['institute_school'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Certificate Validity: </label>
                          <input class="form-control" type="text" name="wedvalidity[]" id = "wedvalidity"  required placeholder="certificate validity" value="<?php echo $certificationRow[$i]['validity'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-6 mt-4">
                          <input type="button" class="btn btn-danger mt-2" onclick="deleteCertification(<?php echo $certificationRow[$i]['id']; ?>)"  value="Delete">
                        </div>
                         <?php } ?>
                        <div class="certificatelist col-md-12 applicantcss">
                        </div>
                         <div class="form-group col-sm-2">
                             <input type="button" class="btn btn-warning mt-1" id="addcertificate" value="Add Certificate" />
                        </div>
                         <div class="form-group col-sm-2">
                             <input type="hidden" name="registration" value="<?php echo md5('certification'); ?>" />
                            <input type="submit" class="btn btn-primary  mt-1" id="addrow" value="update certificate" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade showtab" id="internship">
            <div id="internship" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="intershipform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Company: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                          <input class="form-control" type="hidden" name="internshipId[]" value="<?php echo $internshipRow[0]['id']; ?>" id = "internshipId"  required  /> 
                         <input class="form-control" type="text" name="iedcompany[]" id = "iedcompany"  required placeholder="education degree" value="<?php echo $internshipRow[0]['company'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Designation: </label>
                          <input class="form-control" type="text" name="ieddesignation[]" id = "ieddesignation"  required placeholder="designation" value="<?php echo $internshipRow[0]['designation'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                             <label for="certificatename">Start Date: </label>
                                <input class="form-control" type="date" name="iedstartdate[]" id = "iedstartdate"  required value="<?php echo $internshipRow[0]['start_date'] ?>" /> 
                            </div>
                
                         <div class="form-group col-sm-3">
                            <label for="certificatename">End Date: </label>
                                <input class="form-control" type="date" name="iedenddate[]" id = "iedenddate"  required  value="<?php echo $internshipRow[0]['end_date'] ?>" /> 
                         </div>

                        <div class="form-group col-sm-3">
                            <label for="certificatename">Description/Role: </label>
                            <input class="form-control" type="text" name="ieddescriptionrole[]" id = "ieddescriptionrole"  required placeholder="description/role" value="<?php echo $internshipRow[0]['description_roles'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">How get in: </label>
                          <input class="form-control" type="text" name="iedhowtoget[]" id = "iedhowtoget"  required placeholder="how get in" value="<?php echo $internshipRow[0]['how_get_in'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-3">
                        <label for="certificatename">Stipend: </label>
                          <input class="form-control" type="text" name="iedstipend[]" id = "iedstipend"  required placeholder="stipend" value="<?php echo $internshipRow[0]['stipend'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3 mt-4">
                           <?php if(!empty($internshipRow[0]['id'])){ ?>
                          <input type="button" class="btn btn-danger mt-2" onclick="deleteInternship(<?php echo $internshipRow[0]['id']; ?>)"  value="Delete"> <?php } ?>
                        </div>
                        <?php for($i=1;$i<count($internshipRow);$i++){ ?>
                              <div class="form-group col-md-12">    <hr/></div>
                            <div class="form-group col-md-3">
                                 <label for="certificatename">Company: </label>
                                 <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                                   <input class="form-control" type="hidden" name="internshipId[]" value="<?php echo $internshipRow[$i]['id']; ?>" id = "internshipId"  required  /> 
                                 <input class="form-control" type="text" name="iedcompany[]" id = "iedcompany"  required placeholder="education degree" value="<?php echo $internshipRow[$i]['company'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Designation: </label>
                          <input class="form-control" type="text" name="ieddesignation[]" id = "ieddesignation"  required placeholder="designation" value="<?php echo $internshipRow[$i]['designation'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                                <label for="certificatename">Start Date: </label>
                                <input class="form-control" type="date" name="iedstartdate[]" id = "iedstartdate"  required value="<?php echo $internshipRow[$i]['start_date'] ?>" /> 
                            </div>
                
                         <div class="form-group col-sm-3">
                               <label for="certificatename">End Date: </label>
                                <input class="form-control" type="date" name="iedenddate[]" id = "iedenddate"  required  value="<?php echo $internshipRow[$i]['end_date'] ?>" /> 
                         </div>

                        <div class="form-group col-sm-3">
                            <label for="certificatename">Description/Role: </label>
                            <input class="form-control" type="text" name="ieddescriptionrole[]" id = "ieddescriptionrole"  required placeholder="description/role" value="<?php echo $internshipRow[$i]['description_roles'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">How get in: </label>
                          <input class="form-control" type="text" name="iedhowtoget[]" id = "iedhowtoget"  required placeholder="how get in" value="<?php echo $internshipRow[$i]['how_get_in'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-3">
                        <label for="certificatename">Stipend: </label>
                          <input class="form-control" type="text" name="iedstipend[]" id = "iedstipend"  required placeholder="stipend" value="<?php echo $internshipRow[$i]['stipend'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3 mt-4">
                             <input type="button" class="btn btn-danger mt-2" onclick="deleteInternship(<?php echo $internshipRow[$i]['id']; ?>)"  value="Delete">
                        </div>
                         <?php } ?>
                        <div class="internshiplist applicantcss">
                        </div>
                         <div class="form-group col-sm-2">
                             <input type="hidden" name="registration" value="<?php echo md5('intership'); ?>" />
                            <input type="button" class="btn btn-warning mt-1" id="internshipid" value="Add Internship" />
                          </div>
                          <div class="form-group col-sm-2">
                            <input type="submit" class="btn btn-primary mt-1" id="addrow" value="update intership" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <div class="tab-pane fade showtab" id="academic">
            <div id="academicrecord" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="academicrecordform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Education Degree: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                          <input class="form-control" type="hidden" name="academicId[]" value="<?php echo $academicRow[0]['id']; ?>" id = "academicId"  required  /> 
                         <input class="form-control" type="text" name="education[]" id = "education"  required placeholder="education degree" value="<?php echo $academicRow[0]['education'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Percentage: </label>
                          <input class="form-control" type="text" name="percentage[]" id = "percentage"  required placeholder="percentage" value="<?php echo $academicRow[0]['percentage'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="certificatename">University/Board: </label>
                            <input class="form-control" type="text" name="board_university[]" id = "board_university"  required placeholder="university/board" value="<?php echo $academicRow[0]['description_roles'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Institute/School: </label>
                          <input class="form-control" type="text" name="school_collage[]" id = "school_collage"  required placeholder="institute/school" value="<?php echo $academicRow[0]['board_university'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-3">
                        <label for="certificatename">Location: </label>
                          <input class="form-control" type="text" name="location[]" id = "location"  required placeholder="stipend" value="<?php echo $academicRow[0]['location'] ?>" /> 
                        </div> 
                         <div class="form-group col-sm-3 mt-4">
                          <?php if(!empty($academicRow[0]['id'])){ ?>
                          <input type="button" class="btn btn-danger mt-2" onclick="deleteAcademic(<?php echo $academicRow[0]['id']; ?>)"  value="Delete"> <?php } ?>
                          </div>
                           <div class="form-group col-sm-3">
                           </div>
                           <div class="form-group col-sm-3">
                           </div>

                        <?php for($i=1;$i<count($academicRow);$i++){ ?>
                              <div class="form-group col-md-12">    <hr/></div>
                            <div class="form-group col-md-3">
                                 <label for="certificatename">Education Degree: </label>
                                 <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                                   <input class="form-control" type="hidden" name="academicId[]" value="<?php echo $academicRow[$i]['id']; ?>" id = "academicId"  required  /> 
                                 <input class="form-control" type="text" name="education[]" id = "education"  required placeholder="education degree" value="<?php echo $academicRow[$i]['education'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                        <label for="certificatename">Percentage: </label>
                          <input class="form-control" type="text" name="percentage[]" id = "percentage"  required placeholder="designation" value="<?php echo $academicRow[$i]['percentage'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3">
                            <label for="certificatename">University/Board: </label>
                            <input class="form-control" type="text" name="board_university[]" id = "board_university"  required placeholder="description/role" value="<?php echo $academicRow[$i]['board_university'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3">
                        <label for="certificatename">Institute/School: </label>
                          <input class="form-control" type="text" name="school_collage[]" id = "school_collage"  required placeholder="how get in" value="<?php echo $academicRow[$i]['school_collage'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-3">
                        <label for="certificatename">Location: </label>
                          <input class="form-control" type="text" name="location[]" id = "location"  required placeholder="stipend" value="<?php echo $academicRow[$i]['location'] ?>" /> 
                        </div>
                        <div class="form-group col-sm-3 mt-4">  <input type="button" class="btn btn-danger mt-2" onclick="deleteAcademic(<?php echo $academicRow[$i]['id']; ?>)"  value="Delete"></div>
                        <div class="form-group col-sm-3"></div>
                        <div class="form-group col-sm-3"></div>
                         <?php } ?>
                        <div class="academicrecordlist applicantcss">
                        </div>
                         <div class="form-group col-sm-2">
                             <input type="hidden" name="registration" value="<?php echo md5('academicrecord'); ?>" />
                            <input type="button" class="btn btn-warning mt-1" id="academicdetails" value="Add Academic" />
                        </div>
                        <div class="form-group col-sm-2"> 
                            <input type="submit" class="btn btn-primary" id="addrow" value="update academic" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <div class="tab-pane fade showtab" id="skills">
            <div id="skills" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="skillsform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-6">
                        <label for="certificatename">Technical skills: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                          <input class="form-control" type="hidden" name="skillId" value="<?php echo $skillsRow[0]['id']; ?>" id = "skillId"  required  /> 
                        <textarea id="form19" class="md-textarea form-control" name="technicallskills" rows="3" placeholder="Enter your technical skills"><?php echo $skillsRow[0]['technicallskills']; ?></textarea>
                        </div>

                        <div class="form-group col-sm-6">
                        <label for="certificatename">Personality Traits: </label>
                         <textarea id="form19" class="md-textarea form-control" name="personalitytraits" rows="3" placeholder="Enter your Personality Traits"><?php echo $skillsRow[0]['personalitytraits']; ?></textarea>
                        </div>
                         <div class="form-group col-sm-3">
                             <input type="hidden" name="registration" value="<?php echo md5('skills'); ?>" />
                            <input type="submit" class="btn btn-primary" id="addrow" value="update skills" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
         <div class="tab-pane fade showtab" id="personaldetail">
           <div id="personaldetails" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="personaldetailsform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-6">
                        <label for="certificatename">Date of Birth: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                          <input class="form-control" type="hidden" name="personalId" value="<?php echo $personalRow[0]['id']; ?>" id = "personalId"  required  /> 
                        <input class="form-control" type="date" name="dateofbirth" id = "dateofbirth"  required value="<?php echo $personalRow[0]['dateofbirth'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-6">
                        <label for="certificatename">Anniversary: </label>
                          <input class="form-control" type="date" name="anniversary" id = "anniversary"  required value="<?php echo $personalRow[0]['anniversary'] ?>" /> 
                        </div>

                         <div class="form-group col-sm-3">
                             <input type="hidden" name="registration" value="<?php echo md5('personaldetail'); ?>" />
                            <input type="submit" class="btn btn-primary" id="addrow" value="update detail" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade showtab" id="kids">
             <div id="kidsdetails" class="mt-3 ml-3">
                <form action="addapplicantsubmit.php"  method="post" id="kidsdetailform" enctype="multipart/form-data">

                    <div class="form-row"> 
                        <div class="form-group col-sm-4">
                        <label for="certificatename">Kid Name: </label>
                         <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" /> 
                          <input class="form-control" type="hidden" name="kidId" value="<?php echo $kidsRow[0]['id']; ?>" id = "kidId"  required  /> 
                        <input class="form-control" type="text" name="kids_name[]" id = "kids_name"  required value="<?php echo $kidsRow[0]['kids_name'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-4">
                        <label for="certificatename">Birthday: </label>
                          <input class="form-control" type="date" name="kids_birthday[]" id = "kids_birthday"  required value="<?php echo $kidsRow[0]['birthday'] ?>" /> 
                        </div>

                        <div class="form-group col-sm-3 mt-4">
                          <?php if(!empty($kidsRow[0]['id'])){ ?>
                          <input type="button" class="btn btn-danger mt-2" onclick="deleteKids(<?php echo $kidsRow[0]['id']; ?>)"  value="Delete">
                         <?php } ?>
                          </div>
                          <?php for($i=1;$i<count($kidsRow);$i++){ ?>
                            <div class="form-group col-md-12">    <hr/></div>
                            <div class="form-group col-sm-4">
                            <label for="certificatename">Kid Name: </label>
                             <input class="form-control" type="hidden" name="applicantId" value="<?php echo $_GET['eid']; ?>" id = "applicantId"  required value="" placeholder="Applicant name" />     
                             <input class="form-control" type="hidden" name="kidId" value="<?php echo $kidsRow[$i]['id']; ?>" id = "kidId"  required  /> 
                            <input class="form-control" type="text" name="kids_name[]" id = "kids_name"  required value="<?php echo $kidsRow[$i]['kids_name'] ?>" /> 
                            </div>

                            <div class="form-group col-sm-4">
                            <label for="certificatename">Birthday: </label>
                              <input class="form-control" type="date" name="kids_birthday[]" id = "kids_birthday"  required value="<?php echo $kidsRow[$i]['birthday'] ?>" /> 
                            </div>
                            <div class="form-group col-sm-3 mt-4">
                            <input type="button" class="btn btn-danger mt-2" onclick="deleteKids(<?php echo $kidsRow[$i]['id']; ?>)"  value="Delete">
                            </div>

                        <?php } ?>
                         <div class="kidlist col-md-12 applicantcss">
                        </div>
                         <div class="form-group col-sm-2">
                             <input type="hidden" name="registration" value="<?php echo md5('kidsdetail'); ?>" />
                              <input type="button" class="btn btn-warning mt-1" id="kids_details" value="Add more" />
                          </div>
                            <div class="form-group col-sm-2">
                            <input type="submit" class="btn btn-primary mt-1" id="addrow" value="update kids detail" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="js/registration.js?v=7"></script>
<script type="text/javascript" src="js/testapplicant.js?v=9"></script>