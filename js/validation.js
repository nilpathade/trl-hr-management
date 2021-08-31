 $(document).on('click','.chkstagename', function(){
        var stageName = $('.stageNameclass').val();
        alert(stageName);
        $.ajax({
            type:'POST',
            url:'getChecklist.php',
            data:{
                stageName : stageName,
                stateAction:'checkstagename'
            },
            success: function(data){
                var response = $.parseJSON(data);
                if(response.code == '200'){
                    $('#errClient').html(response.message);
                    $("#errClient").css("color", "green");
                    
                }else{
                    $('#errClient').html(response.message);
                    $("#errClient").css("color", "red");
                }
            },
            error:function(e,msg){
                console.log("Fixed the issue by developer!");
            }
        })

    });