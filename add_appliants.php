<?php
require_once('header/dbconnection.php');
//$clientId =encrypt_decrypt('decrypt',$_GET['eid']);
$title = 'Add Applicant';
require_once('header/header.php');
require_once('header/registrationHeader.php');
?>
<h3 style="text-align: center"> <?php echo $title; ?>  </h3>
    <div class="col-md-12">
        <form action="#" onsubmit="addapplicant()" method="post" id="fileForm" role="form" enctype="multipart/form-data">
            <fieldset>
            <h4> Baics Details </h4>
             <div class="form-group col-md-6">   
                <label for="applicantname"><span class="req">* </span> Applicant name: </label>
                    <input class="form-control" type="text" name="applicantname" id = "txt"  required value="" placeholder="Applicant name" /> 
                    <div id="errClient"></div>    
            </div>

            <div class="form-group col-md-6">
            <label for="phonenumber"><span class="req">* </span> Mobile Number: </label>
                    <input required type="text" name="phonenumber" id="phone" class="form-control phone" maxlength="10" placeholder="Enter Mobile number ex 1234567890" value="<?php //echo $rows['mobile']; ?>"/> 
            </div>

            <div class="form-group col-md-6">
                <label for="email"><span class="req">* </span> Email Address: </label> 
                    <input class="form-control" required type="text" name="email" id = "email" placeholder="Email Address" />   
                    <div class="status" id="status"></div>
            </div>

            <div class="form-group col-md-6">   
                <label for="companyname"><span class="req">* </span> Current Company Name: </label>
                    <input class="form-control" type="text" name="companyname" id = "txt"  required placeholder="Company name" value="" /> 
                    <div id="errCompanyname"></div>    
            </div>

            <div class="form-group col-md-6">   
                <label for="currentdesignation"><span class="req">* </span> Current Designation: </label>
                    <input class="form-control" type="text" name="currentdesignation" id = "currentdesignation"  required placeholder="Current Designation" value="" /> 
                    <div id="errcurrentdesignation"></div>    
            </div>

            <div class="form-group col-md-6">   
                <label for="currentctc"><span class="req">* </span> Current CTC: </label>
                    <input class="form-control" type="text" name="currentctc" id = "currentctc"  required placeholder="Current CTC" value="" /> 
                    <div id="errcurrentctc"></div>    
            </div>

            <div class="form-group col-md-6">   
                <label for="expectedctc"><span class="req">* </span> Expected CTC: </label>
                    <input class="form-control" type="text" name="expectedctc" id = "expectedctc"  required placeholder="Expected CTC" value="" /> 
                    <div id="errexpectedctc"></div>    
            </div>

            <div class="form-group col-md-6">   
                <label for="noticeperiod"><span class="req">* </span> Notice Period: </label>
                    <input class="form-control" type="text" name="noticeperiod" id = "noticeperiod"  required placeholder="Expected CTC" value="" /> 
                    <div id="errnoticeperiod"></div>    
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
                <textarea id="form19" class="md-textarea form-control" name="interest" rows="3" placeholder="Enter your interest"></textarea>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
              <label for="uploadcv"><span class="req">* </span> Upload CV: </label>
                <input type="file" class="form-control" aria-label="file example" name="uploadcv"> 
              </div>

             <div class="form-group col-md-6">
                <label for="declearation"><span class="req">* </span>Declearation</label>
                <input type="checkbox" name="declearation" id="declearation" value="1">
                <span>The above information is true to the best of my knowledge and I authorize iPRIMED to share my resume with its prospective employers basis the available opening</span>
            </div>
           
            </div>
             

            <div class="row">
            <div class="form-group col-md-6">   
              <label for="signature"><span class="req">* </span> Signature : </label>
                  <input class="form-control" type="text" name="signature" id = "signature"  required placeholder="Signature" value="" /> 
                  <div id="errsignature"></div>    
            </div>
            <div class="form-group col-md-6">   
              <label for="date"><span class="req">* </span> Date: </label>
                  <input class="form-control" type="date" name="date" id = "date" required placeholder="Date" value="" />
                  <div id="errdate"></div>
            </div>
          </div>
           </br>
           <legend class="text-center mandateinfo">Valid information is required to register. <span class="req"><small> required *</small></span></legend></br>
            <center>
              <div class="form-group btnleft">
                  <input class="btn btn-success" type="submit" name="submit_reg" value="Add Applicant" />
              </div>
            </center>
        </fieldset>
    </form>

            <div id="workexperiencedetails">
                <h4> Work Experience Details  </h4>
                 <table id="myTable" class=" table order-list">
                    <thead>
                        <tr>
                            <td>Company</td>
                            <td>Location</td>
                            <td>Designation</td>
                            <td>Start Date</td>
                            <td>End Date</td>
                            <td>Description/Role</td>
                            <td>Responsibilities</td>
                            <td>Team Experiance</td>
                            <td>Last CTC</td>
                            <td>Reason For Switch</td>
                            <td>How get in</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="col-sm-2">
                                <input type="text" name="wedcompany" class="form-control" />
                            </td>
                            <td class="col-sm-1">
                                <input type="mail" name="wedlocation"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="weddesignation"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="date" name="wedstartdate"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="date" name="wedenddate"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="weddescriptionrole"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="wedresponsibilities"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="wedteamexp"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="wedlastctc"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="wedreasonforswitch"  class="form-control"/>
                            </td>
                            <td class="col-sm-1">
                                <input type="text" name="wedhowtoget"  class="form-control"/>
                            </td>
                            <td class="col-sm-2"><a class="deleteRow"></a>

                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="11" style="text-align: left;">
                                <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Experiance" />
                            </td>
                        </tr>
                        <tr>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <h4> Certification Details  </h4>
             <table id="certificateTable" class=" table order-list1">
                <thead>
                    <tr>
                        <td>Certificate Name</td>
                        <td>Certificate Date</td>
                        <td>Institute/School</td>
                        <td>Validity</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-3">
                            <input type="text" name="wedcertificate" class="form-control" />
                        </td>
                        <td class="col-sm-3">
                            <input type="date" name="weddate"  class="form-control"/>
                        </td>
                        <td class="col-sm-3">
                            <input type="text" name="wedinstitute_school"  class="form-control"/>
                        </td>
                        <td class="col-sm-3">
                            <input type="text" name="wedvalidity"  class="form-control"/>
                        </td>

                        <td class="col-sm-2"><a class="deleteRow"></a>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block " id="addcertificate" value="Add Certificate" />
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>

            <h4> Internship Experience Details </h4>
             <table id="internshipTable" class=" table internship">
                <thead>
                    <tr>
                        <td>Company</td>
                        <td>Designation</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Description/Role</td>
                        <td>How get in</td>
                        <td>Stipend</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-3">
                            <input type="text" name="iedcompany" class="form-control" />
                        </td>
                        <td class="col-sm-2">
                            <input type="text" name="ieddesignation"  class="form-control"/>
                        </td>
                        <td class="col-sm-1">
                            <input type="date" name="iedstartdate"  class="form-control"/>
                        </td>
                        <td class="col-sm-1">
                            <input type="date" name="iedenddate"  class="form-control"/>
                        </td>
                        <td class="col-sm-3">
                            <input type="text" name="ieddescriptionrole"  class="form-control"/>
                        </td>
                        <td class="col-sm-1">
                            <input type="text" name="iedhowtoget"  class="form-control"/>
                        </td>
                        <td class="col-sm-1">
                            <input type="text" name="iedstipend"  class="form-control"/>
                        </td>
                        <td class="col-sm-2"><a class="deleteRow"></a>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="11" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block " id="internshipid" value="Add Internship" />
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>


            <h4> Academic Details  </h4>
            <table id="academicdetailsTable" class=" table academic-details">
                <thead>
                    <tr>
                        <td>Education Degree</td>
                        <td>Percentage</td>
                        <td>University/Board </td>
                        <td>Institute/School </td>
                        <td>Location</td>
                    </tr>
                </thead>
                <tbody>
                    <td class="col-sm-2">
                        <input type="text" name="education"  class="form-control"/>
                    </td>
                    <td class="col-sm-2">
                        <input type="number" name="percentage"  class="form-control"/>
                    </td>
                    <td class="col-sm-3">
                        <input type="text" name="board_university"  class="form-control"/>
                    </td>
                    <td class="col-sm-3">
                        <input type="text" name="school_collage"  class="form-control"/>
                    </td>
                    <td class="col-sm-2">
                        <input type="text" name="location"  class="form-control"/>
                    </td>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block " id="academicdetails" value="Add Education" />
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>
            <h4> Skills  </h4>
            <div class="row">
                  <div class="form-group col-md-6">
                        <label for="techincallskills"><span class="textdescription">* </span>Techincall skills: </label> 
                        <textarea id="form19" class="md-textarea form-control" name="techincallskills" rows="3" placeholder="Enter your techincall skills"></textarea>
                  </div>

                 <div class="form-group col-md-6">
                    <label for="personalitytraits"><span class="textdescription">* </span>Personality Traits: </label> 
                    <textarea id="form19" class="md-textarea form-control" name="personalitytraits " rows="3" placeholder="Enter your Personality Traits"></textarea>
                </div>
            </div>

           <h4> Personal Details </h4> 
           <div class="row">
                  <div class="form-group col-md-6">
                        <label for="dateofbirth"><span class="textdescription">* </span>Date of Birth: </label> 
                        <input class="form-control" type="date" name="dateofbirth"  placeholder="Enter your Date of Birth" />
                  </div>

                 <div class="form-group col-md-6">
                    <label for="anniversary"><span class="textdescription">* </span>Anniversary: </label> 
                    <input class="form-control" type="date" name="anniversary "  placeholder="Enter your Anniversary" />
                </div>
            </div>
            <div class="row">
             <h4> Kids Details  </h4>     
                <table id="kids_detailsid" class=" table kids-details">
                <thead>
                    <tr>
                        <td>Kids Name</td>
                        <td>Birthday</td>                        
                    </tr>
                </thead>
                <tbody>
                    <td class="col-sm-6">
                        <input type="text" name="kids_name"  class="form-control"/>
                    </td>
                    <td class="col-sm-6">
                        <input type="date" name="kids_birthday"  class="form-control"/>
                    </td>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: left;">
                            <input type="button" class="btn btn-lg btn-block " id="kids_details" value="Add more" />
                        </td>
                    </tr>
                    <tr>
                    </tr>
                </tfoot>
            </table>

            </div>
          

            
        </div><!-- ends col-6 -->
  </div>
<script type="text/javascript" src="js/add_applicant.js"></script>
