$(document).ready(function () {
    var counter = 0;
    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";

            cols += '<td> <input type="text" name="wedcompany'+ counter +'"   class="form-control" /></td>';
            cols += '<td> <input type="mail" name="wedlocation'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="weddesignation'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="date" name="wedstartdate'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="date" name="wedenddate'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="weddescriptionrole'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedresponsibilities'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedteamexp'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedlastctc'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedreasonforswitch'+ counter +'"    class="form-control"/></td>';
            cols += '<td> <input type="text" name="wedhowtoget'+ counter +'"    class="form-control"/></td>';

        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        counter++;
    });
    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();       
        counter -= 1
    });

    var counter1 = 0;
    $("#addcertificate").on("click", function () {
        var newRow1 = $("<tr>");
        var cols1 = "";
        cols1 += '<td> <input type="text" name="wedcertificate'+ counter1 +'" class="form-control" /></td>';
        cols1 += '<td> <input type="date" name="weddate'+ counter1 +'"  class="form-control"/></td>';
        cols1 += '<td> <input type="text" name="wedinstitute_school'+ counter1 +'"  class="form-control"/></td>';
        cols1 += '<td> <input type="text" name="wedvalidity'+ counter1 +'"  class="form-control"/></td>';
        
        cols1 += '<td><input type="button" class="ibtnDel1 btn btn-md btn-danger "  value="Delete"></td>';
        newRow1.append(cols1);
        $("table.order-list1").append(newRow1);
        counter1++;
    });

    $("table.order-list1").on("click", ".ibtnDel1", function (event) {
        $(this).closest("tr").remove();       
        counter1 -= 1
    });

    var counter3 = 0;
    $("#internshipid").on("click", function () {
        var newRow3 = $("<tr>");
        var cols3 = "";

        cols3 += '<td> <input type="text" name="iedcompany'+ counter3 +'" class="form-control" /></td>';
        cols3 += '<td> <input type="text" name="ieddesignation'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="date" name="iedstartdate'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="date" name="iedenddate'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="ieddescriptionrole'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="iedhowtoget'+ counter3 +'"  class="form-control"/></td>';
        cols3 += '<td> <input type="text" name="iedstipend'+ counter3 +'"  class="form-control"/></td>';

        cols3 += '<td><input type="button" class="ibtnDel3 btn btn-md btn-danger "  value="Delete"></td>';
        newRow3.append(cols3);
        $("table.internship").append(newRow3);
        counter3++;
    });

    $("table.internship").on("click", ".ibtnDel3", function (event) {
        $(this).closest("tr").remove();       
        counter3 -= 1
    });

    var counter2 = 0;
    $("#academicdetails").on("click", function () {
        var newRow2 = $("<tr>");
        var cols2 = "";
        cols2 += '<td> <input type="text" name="education'+ counter2 +'" class="form-control" /></td>';
        cols2 += '<td> <input type="mail" name="percentage'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="board_university'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="school_collage'+ counter2 +'"  class="form-control"/></td>';
        cols2 += '<td> <input type="text" name="location'+ counter2 +'"  class="form-control"/></td>';

        cols2 += '<td><input type="button" class="ibtnDel2 btn btn-md btn-danger "  value="Delete"></td>';
        newRow2.append(cols2);
        $("table.academic-details").append(newRow2);
        counter2++;
    });

    $("table.academic-details").on("click", ".ibtnDel2", function (event) {
        $(this).closest("tr").remove();       
        counter2 -= 1
    });

    var counter5 = 0;
    $("#kids_details").on("click", function () {
        var newRow5 = $("<tr>");
        var cols5 = "";
        cols5 += '<td> <input type="text" name="kids_name'+ counter5 +'" class="form-control" /></td>';
        cols5 += '<td> <input type="date" name="kids_birthday'+ counter5 +'"  class="form-control"/></td>';
        
        cols5 += '<td><input type="button" class="ibtnDel5 btn btn-md btn-danger "  value="Delete"></td>';
        newRow5.append(cols5);
        $("table.kids-details").append(newRow5);
        counter5++;
    });

    $("table.kids-details").on("click", ".ibtnDel5", function (event) {
        $(this).closest("tr").remove();       
        counter5 -= 1
    });

});

function addapplicant(){
    
}