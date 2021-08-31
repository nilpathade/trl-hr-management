$(document).ready(function () {
    var counter = 0;
    $("#addrow").on("click", function () {
        var newRow = $("<div class='form-row col-md-12 chk"+counter+"'>");
        var cols = "";
          /*  cols +=' <tr><td class="col-md-2"><input class="form-control" type="text" name="wedcompany[]" id = "wedcompany"  required placeholder="enter company name here" value="" /> </td <td class="col-sm-2"><input class="form-control" type="text" name="wedlocation[]" id = "wedlocation"  required placeholder="enter location here" value="" /></td><td class="col-sm-2"><input class="form-control" type="text" name="weddesignation[]" id = "weddesignation"  required placeholder="enter designation here" value="" /> </td><td class="col-sm-2"><input class="form-control" type="date" name="wedstartdate[]" id = "wedstartdate"  required value="" /></td></tr>';
           
            cols +='<tr><td class="col-sm-2"><input class="form-control" type="date" name="wedenddate[]" id = "wedenddate"  required  value="" /></td><td class="col-sm-2"><input class="form-control" type="text" name="weddescriptionrole[]" id = "weddescriptionrole"  required placeholder="enter designation role here" value="" /></td><td class="col-sm-2"><input class="form-control" type="text" name="wedteamexp[]" id = "wedteamexp"  required placeholder="enter team experience here" value="" /></td><td class="col-sm-2"><input class="form-control" type="text" name="wedlastctc[]" id = "wedlastctc"  required placeholder="enter your last CTC" value="" /></td></tr>';

            cols +='<tr><td class="col-sm-2"><input class="form-control" type="text" name="wedreasonforswitch[]" id = "wedreasonforswitch"  required placeholder="enter job change reason" value="" /></td>td class="col-sm-2"><input class="form-control" type="text" name="wedhowtoget[]" id = "wedhowtoget"  required placeholder="how to get" value="" /></td><td class="col-sm-2"></td><td class="col-sm-2"><a class="deleteRow"></a></td></tr>';*/
            cols +='<div class="col-md-12"><hr/></div><div class="form-group col-md-3"><label for="certificatename">Company Name: </label><input class="form-control" type="text" name="wedcompany[]" id = "wedcompany"  required placeholder="enter company name here" value="" /></div><div class="col-sm-3"><label for="certificatename">Location: </label><input class="form-control" type="text" name="wedlocation[]" id = "wedlocation"  required placeholder="enter location here" value="" /></div><div class="col-sm-3"> <label for="certificatename">Designation: </label><input class="form-control" type="text" name="weddesignation[]" id = "weddesignation"  required placeholder="enter designation here" value="" /></div><div class="col-sm-3"> <label for="certificatename">Start Date: </label><input class="form-control" type="date" name="wedstartdate[]" id = "wedstartdate"  required value="" /> </div>';
                
            cols +='<div class="form-group col-sm-3"><label for="certificatename">End Date: </label><input class="form-control" type="date" name="wedenddate[]" id = "wedenddate"  required  value="" /></div><div class="col-sm-3"><label for="certificatename">Description/Role: </label><input class="form-control" type="text" name="weddescriptionrole[]" id = "weddescriptionrole"  required placeholder="enter description role here" value="" /></div><div class="form-group col-sm-3"><label for="certificatename">Responsibilities: </label><input class="form-control" type="text" name="wedresponsibilities[]" id = "wedresponsibilities"  required placeholder="enter responsibilities role here" value="" /></div><div class="col-sm-3">  <label for="certificatename">Team Handling Experience: </label><input class="form-control" type="text" name="wedteamexp[]" id = "wedteamexp"  required placeholder="enter team experience here" value="" /></div><div class="col-sm-3"><label for="certificatename">Last CTC: </label><input class="form-control" type="text" name="wedlastctc[]" id = "wedlastctc"  required placeholder="enter your last CTC" value="" /></div>';
                   
                            
            cols +='<div class="col-sm-3"><label for="certificatename">Reason For Job Change: </label><input class="form-control" type="text" name="wedreasonforswitch[]" id = "wedreasonforswitch"  required placeholder="enter job change reason" value="" /></div><div class="col-sm-3"> <label for="certificatename">How To Get: </label><input class="form-control" type="text" name="wedhowtoget[]" id = "wedhowtoget"  required placeholder="how to get" value="" /></div><div class="col-sm-3 mt-4"><input type="button" class="ibtnDel btn btn-danger mt-2" value="Delete"></div>';
            /* cols += '<td> <input type="text" name="wedcompany'+ counter +'"   class="form-control" /></td>';
            cols += '<td> <input type="mail" name="wedlocation'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="weddesignation'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="date" name="wedstartdate'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="date" name="wedenddate'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="weddescriptionrole'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedresponsibilities'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedteamexp'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedlastctc'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedreasonforswitch'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedhowtoget'+ counter +'"    class="form-control"/></td>';*/

       /* cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';*/
        newRow.append(cols);
        $(".order-list").append(newRow);
        counter++;
    });
    $(".order-list").on("click", ".ibtnDel", function (event) {
       // $(this).closest("div").remove(); 
       counter = counter-1;   
       $(".chk"+counter).remove();
          //counter -= 1
        
    });

    var counter1 = 0;
    $("#addcertificate").on("click", function () {
        var newRow1 = $("<div class='form-row col-md-12 chk"+counter1+"'>");
        var cols1 ='';

        cols1 += '<div class="col-md-12"><hr/></div><div class="form-group col-sm-3"><label for="certificatename">Certificate Name: </label><input class="form-control" type="text" name="wedcertificate[]" id = "wedcertificate"  required placeholder="certificate name" /></div>';

        cols1 +='<div class="form-group col-sm-3"><label for="certificatename">Certificate Date: </label><input class="form-control" type="date" name="weddate[]" id = "weddate"  required /></div>';

        cols1 +='<div class="form-group col-sm-6"><label for="certificatename">Institute/School: </label><input class="form-control" type="text" name="wedinstitute_school[]" id = "wedinstitute_school"  required placeholder="Institute/School" /></div>';                      
        cols1 +='<div class="form-group col-sm-3"><label for="certificatename">Certificate Validity: </label><input class="form-control" type="text" name="wedvalidity[]" id = "wedvalidity"  required placeholder="certificate validity" /></div>';
         cols1 +='<div class="form-group col-sm-6 mt-4"><input type="button" class="ibtnDel1 btn btn-danger mt-2"  value="Delete"></div>';
       /* cols1 += '<td> <input type="text" name="wedcertificate'+ counter1 +'" class="form-control" /></td>';
        cols1 += '<td> <input type="date" name="weddate'+ counter1 +'"  class="form-control"/></td>';
        cols1 += '<td> <input type="text" name="wedinstitute_school'+ counter1 +'"  class="form-control"/></td>';
        cols1 += '<td> <input type="text" name="wedvalidity'+ counter1 +'"  class="form-control"/></td>';
        
        cols1 += '<td><input type="button" class="ibtnDel1 btn btn-md btn-danger "  value="Delete"></td>';*/
        newRow1.append(cols1);
        $(".certificatelist").append(newRow1);
        counter1++;
    });

    $(".certificatelist").on("click", ".ibtnDel1", function (event) {
        //$(this).closest("tr").remove(); 
        counter1 = counter1-1; 
        $(".chk"+counter1).remove();   
       // counter1 -= 1
    });

    var counter3 = 0;
    $("#internshipid").on("click", function () {
        var newRow3 = $("<div class='form-row col-md-12 chk"+counter3+"'>");
        var cols3 = "";

         cols3 += '<div class="col-md-12"><hr/></div> <div class="form-group col-sm-3"><label for="certificatename">Company: </label><input class="form-control" type="text" name="iedcompany[]" id = "iedcompany"  required placeholder="education degree"  /></div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">Designation: </label><input class="form-control" type="text" name="ieddesignation[]" id = "ieddesignation"  required placeholder="designation"  /></div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">Start Date: </label><input class="form-control" type="date" name="iedstartdate[]" id = "iedstartdate"  required  /></div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">End Date: </label><input class="form-control" type="date" name="iedenddate[]" id = "iedenddate"  required   /> </div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">Description/Role: </label><input class="form-control" type="text" name="ieddescriptionrole[]" id = "ieddescriptionrole"  required placeholder="description/role" /></div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">How get in: </label><input class="form-control" type="text" name="iedhowtoget[]" id = "iedhowtoget"  required placeholder="how get in"  /></div>';
         cols3 += '<div class="form-group col-sm-3"><label for="certificatename">Stipend: </label><input class="form-control" type="text" name="iedstipend[]" id = "iedstipend"  required placeholder="stipend" /></div>';
         cols3 += '<div class="form-group col-sm-3 mt-4"><input type="button" class="ibtnDel3 btn btn-danger mt-2"  value="Delete"></div>';
       /* cols3 += '<td> <input type="text" name="iedcompany'+ counter3 +'" class="form-control" /></td>';
        cols3 += '<td> <input type="text" name="ieddesignation'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="date" name="iedstartdate'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="date" name="iedenddate'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="ieddescriptionrole'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="iedhowtoget'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="iedstipend'+ counter3 +'"  class="form-control"/></td>';

        cols3 += '<td><input type="button" class="ibtnDel3 btn btn-md btn-danger "  value="Delete"></td>';*/
        newRow3.append(cols3);
        $(".internshiplist").append(newRow3);
        counter3++;
    });

    $(".internshiplist").on("click", ".ibtnDel3", function (event) {
       // $(this).closest("tr").remove();   
        counter3 = counter3-1; 
        $(".chk"+counter3).remove();      
        //counter3 -= 1
    });

    var counter2 = 0;
    $("#academicdetails").on("click", function () {
        var newRow2 = $("<div class='form-row col-md-12 chk"+counter2+"'>");
        var cols2 = "";
            cols2 +='<div class="col-md-12"><hr/></div><div class="form-group col-sm-3"><label for="certificatename">Company: </label><input class="form-control" type="text" name="education[]" id = "education"  required placeholder="education degree"  /></div>';
            cols2 +='<div class="form-group col-sm-3"><label for="certificatename">Percentage: </label><input class="form-control" type="text" name="percentage[]" id = "percentage"  required placeholder="Percentage"  /></div>';
            cols2 +='<div class="form-group col-sm-3"><label for="certificatename">University/Board: </label><input class="form-control" type="text" name="board_university[]" id = "board_university"  required placeholder="University/Board" /></div>';
            cols2 +='<div class="form-group col-sm-3"><label for="certificatename">Institute/School: </label><input class="form-control" type="text" name="school_collage[]" id = "school_collage"  required placeholder="Institute/School"  /></div>';
            cols2 +='<div class="form-group col-sm-3"><label for="certificatename">Location: </label><input class="form-control" type="text" name="location[]" id = "location"  required placeholder="Location" /></div>';
            cols2 +='<div class="form-group col-sm-3 mt-4"><input type="button" class="ibtnDel2 btn btn-danger mt-2"  value="Delete"></div>';
       /* cols2 += '<td> <input type="text" name="education'+ counter2 +'" class="form-control" /></td>';
        cols2 += '<td> <input type="mail" name="percentage'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="board_university'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="school_collage'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="location'+ counter2 +'"  class="form-control"/></td>';

        cols2 += '<td><input type="button" class="ibtnDel2 btn btn-md btn-danger "  value="Delete"></td>';*/
        newRow2.append(cols2);
        $(".academicrecordlist").append(newRow2);
        counter2++;
    });

    $(".academicrecordlist").on("click", ".ibtnDel2", function (event) {
       // $(this).closest("tr").remove(); 
        counter2 = counter2-1;  
       $(".chk"+counter2).remove();      
        //counter2 -= 1
    });

    var counter5 = 0;
    $("#kids_details").on("click", function () {
        var newRow5 = $("<div class='form-row col-md-12 chk"+counter5+"'>");
        var cols5 = "";

        cols5 += '<div class="col-md-12"><hr/></div><div class="form-group col-sm-4"> <label for="certificatename">Kid Name: </label><input class="form-control" type="text" name="kids_name[]" id = "kids_name" placeholder="kid name"  required  /></div>';
        cols5 += '<div class="form-group col-sm-4"><label for="certificatename">Birthday: </label><input class="form-control" type="date" name="kids_birthday[]" id = "kids_birthday"  required  /> </div>';
        cols5 += '<div class="form-group col-sm-4 mt-4"><input type="button" class="ibtnDel5 btn btn-danger mt-2"  value="Delete"></div>';

       /* cols5 += '<td> <input type="text" name="kids_name'+ counter5 +'" class="form-control" /></td>';
        cols5 += '<td> <input type="date" name="kids_birthday'+ counter5 +'"  class="form-control"/></td>';
        
        cols5 += '<td><input type="button" class="ibtnDel5 btn btn-md btn-danger "  value="Delete"></td>';*/
        newRow5.append(cols5);
        $(".kidlist").append(newRow5);
        counter5++;
    });

    $(".kidlist").on("click", ".ibtnDel5", function (event) {
        //$(this).closest("tr").remove(); 
         counter5 = counter5-1;       
        $(".chk"+counter5).remove();    
       // counter5 -= 1
    });

});

function deleteExperience(experienceId){
    if(confirm("Are you want to delete selected record")){
        $.ajax({
            type:'POST',
            url:'applicantAjax.php',
            data:{
                stateAction : 'workexperience',
                experienceId : experienceId
            },
            success: function(data){
                var response = $.parseJSON(data);
                alert(response.message);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
    }
}

function deleteCertification(certificationId){
    if(confirm("Are you want to delete selected record")){
        $.ajax({
            type:'POST',
            url:'applicantAjax.php',
            data:{
                stateAction : 'certification',
                certificationId : certificationId
            },
            success: function(data){
                var response = $.parseJSON(data);
                alert(response.message);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
    }
}

function deleteInternship(internshipId){
    if(confirm("Are you want to delete selected record")){
        $.ajax({
            type:'POST',
            url:'applicantAjax.php',
            data:{
                stateAction : 'internship',
                internshipId : internshipId
            },
            success: function(data){
                var response = $.parseJSON(data);
                alert(response.message);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
    }
}

function deleteAcademic(academicId){
    if(confirm("Are you want to delete selected record")){
        $.ajax({
            type:'POST',
            url:'applicantAjax.php',
            data:{
                stateAction : 'academic',
                academicId : academicId
            },
            success: function(data){
                var response = $.parseJSON(data);
                alert(response.message);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
    }
}

function deleteKids(kidId){
    if(confirm("Are you want to delete selected record")){
        $.ajax({
            type:'POST',
            url:'applicantAjax.php',
            data:{
                stateAction : 'kidsdetail',
                kidId : kidId
            },
            success: function(data){
                var response = $.parseJSON(data);
                alert(response.message);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })
    }
}