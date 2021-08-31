 <?php
$sourceSql ="select * from tlr_requisitions where isDeleted = ? and clientId = ?";
$resultRow = pdoQuery($sourceSql, array('N',$userid));

//sourceing count
$schksql = "select * from tlr_sourcingteam where isDeleted = ? and roleType= ?";
$Rows = pdoQuery($schksql, array('N',1));

//training count 
$tchksql = "select * from tlr_sourcingteam where isDeleted = ? and roleType= ?";
$tRows = pdoQuery($tchksql, array('N',2));
 ?>
 <div class="content" style="width: 100% !important;">
    <div class="container-fluid">
	 	<h4>Applicant Dashboard</h4>
	     <div class="row">
	         <div class="col-lg-9" style="min-height: 300px;padding-top:25px;">
	            <center><b>Welcome to iPRIMED Training Led Recruitment<br/> Space!</b></center>
	          
	            <div style="border:1px solid black; width: 60%;margin-left:25%; margin-top:2%; padding-top:20px; padding-left:25px; padding-right:20px; padding-bottom: 10px;">
	            	<p>Brief explanation about the program and program flow</p>
	            </div>
	         </div>
	         <div class="col-lg-3">
	             <span><b>Quick Links</b></span>
	             <div style="border:1px solid black; min-height:250px; padding-top:10px; padding-left:15px; padding-right:15px; padding-bottom: 10px;">
		             <a href="testapplicant.php">Complete Profile</a><br/>
		             <a href="#">Complete Test</a><br/>
		             <a href="#">Upcoming Interview</a><br/>
		             <a href="#">Bookmark</a><br/>
		             <a href="#">History</a>
	         	</div>
	         </div>
	     </div>
 	</div>
</div>