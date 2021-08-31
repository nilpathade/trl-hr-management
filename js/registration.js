 function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
} 
function validatephone(phone) 
{
    var maintainplus = '';
    var numval = phone.value
    if ( numval.charAt(0)=='+' )
    {
        var maintainplus = '';
    }
    curphonevar = numval.replace(/[\\A-Za-z!"£$%^&\,*+_={};:'@#~,.Š\/<>?|`¬\]\[]/g,'');
    phone.value = maintainplus + curphonevar;
    var maintainplus = '';
    phone.focus;
}
// validates text only
function Validate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r. ]+/g, '');
    
}
function ctcValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z0-9-'\n\r. ]+/g, '');
    
}

function stageValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r. ]+/g, '');
    stageName();
}
function stageName(){
        var stageName = $('.stageNameclass').val();
        var stageId = $('#txt2').val();
        var reqId = $('#requistionId').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                stageName : stageName,
                stateAction:'checkstagename',
                stageId:stageId,
                reqId:reqId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".chkstagename").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".chkstagename").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }

function roleValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r. ]+/g, '');
    roleName();
}
function roleName(){
        var roleName = $('.rolenameclass').val();
        var roleId = $('#txt2').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                roleName : roleName,
                stateAction:'checkrolename',
                roleId:roleId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".chkrolename").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".chkrolename").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }


function testNameValidate(txt) {
    txt.value = txt.value.replace(/[^a-zA-Z-'\n\r. ]+/g, '');
    testName();
}
function testName(){
        var testName = $('.testnameclass').val();
        var testUrl = $('#testUrl').val();
         var testId = $('#txt2').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                testName : testName,
                stateAction:'checktestname',
                testUrl:testUrl,
                testId:testId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".chktestname").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".chktestname").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }


// validate email
function email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
    document.getElementById("status").innerHTML    = "<span class='warning'>Email address is not valid yet.</span>";
    }
    else
    {
    document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>"; 
    }
}

function forget_email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
        $('#errMessage').html("Email address is not valid yet.");
        $("#errMessage").css("color", "red");
        $(".forgotsubmit").attr("disabled", true);
    }
    else
    {
    document.getElementById("errMessage").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>"; 
    }
}

function training_email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
        $('#errMessage').html("Email address is not valid yet.");
        $("#errMessage").css("color", "red");
        $(".trainingsubmit").attr("disabled", true);
    }
    else
    {
   // document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>"; 
    training_email();
    }
   
}

function training_email(){
        var emailAddress = $('.emailclass').val();
        var trainingId = $('#txt2').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                emailAddress : emailAddress,
                stateAction:'checkemailtraning',
                trainingId:trainingId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".trainingsubmit").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".trainingsubmit").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }
function client_email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
        $('#errMessage').html("Email address is not valid yet.");
        $("#errMessage").css("color", "red");
        $(".clientsubmit").attr("disabled", true);
    }
    else
    {
   // document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>"; 
    client_email();
    }
   
}
function client_email(){
        var emailAddress = $('.emailclass').val();
        var clientId = $('#txt2').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                emailAddress : emailAddress,
                stateAction:'checkemailclient',
                clientId:clientId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".clientsubmit").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".clientsubmit").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }

function applicant_email_validate(email)
{
var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

    if(regMail.test(email) == false)
    {
        $('#errMessage').html("Email address is not valid yet.");
        $("#errMessage").css("color", "red");
        $(".applicantbtnsubmit").attr("disabled", true);
    }
    else
    {
   // document.getElementById("status").innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>"; 
    applicant_email();
    }
   
}

function applicant_email(){
        var emailAddress = $('.emailapplicantclass').val();
        var applicantId = $('#applicantId').val();
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                emailAddress : emailAddress,
                stateAction:'checkemailapplicant',
                applicantId:applicantId
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                    $(".applicantbtnsubmit").attr("disabled", false);
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $(".applicantbtnsubmit").attr("disabled", true);
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    }

// validate date of birth
function dob_validate(dob)
{
var regDOB = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/;

    if(regDOB.test(dob) == false)
    {
    document.getElementById("statusDOB").innerHTML  = "<span class='warning'>DOB is only used to verify your age.</span>";
    }
    else
    {
    document.getElementById("statusDOB").innerHTML  = "<span class='valid'>Thanks, you have entered a valid DOB!</span>"; 
    }
}
// validate address
function add_validate(address)
{
var regAdd = /^(?=.*\d)[a-zA-Z\s\d\/]+$/;
  
    if(regAdd.test(address) == false)
    {
    document.getElementById("statusAdd").innerHTML  = "<span class='warning'>Address is not valid yet.</span>";
    }
    else
    {
    document.getElementById("statusAdd").innerHTML  = "<span class='valid'>Thanks, Address looks valid!</span>";  
    }
}

  function deleteconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "clientregistrationsubmit.php?did="+did;
    }
  }

   function deletesourceconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "sourceregistrationsubmit.php?did="+did;
    }
  }

   function deletetrainingconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "trainingregistrationsubmit.php?did="+did;
    }
  }

  function deleteroleconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "rolemastersubmit.php?did="+did;
    }
  }

function deleterequisitionsconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "requisitionsubmit.php?did="+did;
    }
  }

function deletestageconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "stagemastersubmit.php?did="+did;
    }
  }

function deleteassignconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "assignrecruiterssubmit.php?did="+did;
    }
  }

function deletetestscheduleconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "testschedulemastersubmit.php?did="+did;
    }
}

function deletetestscheduletestconfirmation(did){
    var result = confirm("Are you sure you want to delete this item?");
    if (result) {
      window.location = "scheduletestapplicantsubmit.php?did="+did;
    }
}


  $(document).on('change','.getstatelistclass', function(){
        var countryId = $('#country').val();
        $.ajax({
            type:'POST',
            url:'getStatelist.php',
            data:{
                countryId : countryId
            },
            success: function(data){
                var response = $.parseJSON(data);
                $('#state').html(response.states);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    });

   $(document).on('change','.getCitylistclass', function(){
        var stateId = $('#state').val();
        $.ajax({
            type:'POST',
            url:'getCitylist.php',
            data:{
                stateId : stateId
            },
            success: function(data){
                var response = $.parseJSON(data);
                $('#city').html(response.cities);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }



        })

    });

    $(document).on('change','.getrolelistclass', function(){
        var roleType = $('#roleType').val();
        $.ajax({
            type:'POST',
            url:'getRolelist.php',
            data:{
                roleTypeId : roleType
            },
            success: function(data){
                var response = $.parseJSON(data);
                $('#roleslist').html(response.roleslist);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }



        })

    });

     $(document).on('change','.getmemberlistclass', function(){
        var roleslist = $('#roleslist').val();
        var roleType = $('#roleType').val();
        $.ajax({
            type:'POST',
            url:'getMemberlist.php',
            data:{
                roleslist : roleslist,
                roleType : roleType
            },
            success: function(data){
                var response = $.parseJSON(data);
                $('#roleMemberlist').html(response.roleMemberlist);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
     });


     $(document).on('click','.addstages', function(){
        var stagevalue = $('.stagevalueclass').val();
        var reqId = $('#txt2').val();
        $.ajax({
            type:'POST',
            url:'addstageAjax.php',
            data:{
                stagevalue : stagevalue,
                reqId:reqId
            },
            success: function(data){
              
               var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errstagevalue').html(response.message);
                    $("#errstagevalue").css("color", "green");
                }else{
                    $('#errstagevalue').html(response.message);
                    $("#errstagevalue").css("color", "red");
                }
                
               $("#stagesRefresh").load(" #stagesRefresh");
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
     });

      $(document).on('click','.submitjoblog', function(){
        var statusId = $('#statusId :selected').val();
        var comments = $('#comments').val();
        var jobId = $('#logjobId').val();
        $.ajax({
            type:'POST',
            url:'joblogAjax.php',
            data:{
                statusId : statusId,
                comments:comments,
                jobId:jobId,
                methodAction:'joblog'
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "green");
                   
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                }
              
               //$("#stagesRefresh").load(" #stagesRefresh");
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
     });

      $(document).on('click','.updateapplicationstatus', function(){
        var reqId = $(this).attr('attr-reqId');
        var jobId = $(this).attr('attr-jobId');
        var modal = document.getElementById("myModal");
       $.ajax({
            type:'POST',
            url:'joblogAjax.php',
            data:{
                reqId:reqId,
                jobId:jobId,
                methodAction:'viewStagesApplicant'
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('.optionArr').html(response.optionArr);
                    $('#logjobId').val(response.jobId);
                    modal.style.display = "block";
                }else{
                   
                }
              
              // $("#stagesRefresh").load(" #stagesRefresh");
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
     });


       $(document).on('change','.dashboardreqId', function(){
        var reqId = $('#reqId :selected').val();
        $.ajax({
            type:'POST',
            url:'dashboardAjax.php',
            data:{
                reqId : reqId,
                methodAction:'sourceCount'
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#showSourceCount').html(response.totalCount);
                    $('#totaltestCount').html(response.totaltestCount);
                    $('#errMessage').html('');
                }else{
                    $('#errMessage').html(response.message);
                    $("#errMessage").css("color", "red");
                    $('#showSourceCount').html('');
                      $('#totaltestCount').html('');
                }
              
               //$("#stagesRefresh").load(" #stagesRefresh");
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
     });