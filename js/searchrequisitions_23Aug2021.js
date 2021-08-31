function searchrequisitions(){
	var requisitionid = $('#requisitionid').val();
	var designation = $('#designation').val();
	var keyskills = $('#keyskills').val();
	var startDate = $('#startDate').val();
	var endDate = $('#endDate').val();
	var experienceMin = $('#experienceMin').val();
	var experienceMax = $('#experienceMax').val();
	var noticePeriod = $('#noticePeriod').val();
	var country = $('#country').val();
	var ctcRangeMin = $('#ctcRangeMin').val();
	var ctcRangeMax = $('#ctcRangeMax').val();
	var state = $('#state').val();
	var city = $('#city').val();
	$.ajax({
            type:'POST',
            url:'searchrequisitionsrecords.php',
            data:{
				requisitionid	:  requisitionid,
				designation	:  designation,
				keyskills	:  keyskills,
				startDate	:  startDate,
				endDate	:  endDate,
				experienceMin	:  experienceMin,
				experienceMax	:  experienceMax,
				noticePeriod	:  noticePeriod,
				country	:  country,
				ctcRangeMin	:  ctcRangeMin,
				ctcRangeMax	:  ctcRangeMax,
				state	:  state,
				city	:  city,
            },
            success: function(data){
                $('#searchresult').html(data);
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

}
function resetdata(){
	location.reload();
}