<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully updated.</div>';
} else if ($_GET['message'] == md5('dsuccess')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully deleted.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($appliedApplicantAcess == 0) {
  require_once('accesserror.php');
}
$pageno = !empty($_GET['pageno']) ?  $_GET['pageno'] : 1;
$fixlimit = !empty($_REQUEST['fixlimit']) ?  $_REQUEST['fixlimit'] : 10;
$limit = !empty($_REQUEST['fixlimit']) ?  $_REQUEST['fixlimit'] : 10;
$filterColumn = !empty($_REQUEST['filterColumn']) ?  $_REQUEST['filterColumn'] : '';
$filterValue = !empty($_REQUEST['filterValue']) ?  $_REQUEST['filterValue'] : '';
$condition = '';
$selected = '';
$selected1 = '';
$selected2 = '';
$selected3 = '';
if (!empty($filterColumn) && !empty($filterValue)) {
  if ($filterColumn == 'name') {
    $condition = "and ta.$filterColumn like '%$filterValue%'";
    $selected = "selected = 'selected'";
  }/*else if($filterColumn == 'applicationNo'){
    $condition = "and $filterColumn ='$filterValue'";
      $selected1 = "selected = 'selected'";
   }else if($filterColumn == 'contactnumber'){
    $condition = "and $filterColumn ='$filterValue'";
      $selected2 = "selected = 'selected'";
   }else if($filterColumn == 'email'){
    $condition = "and $filterColumn ='$filterValue'";
    $selected3 = "selected = 'selected'";
  }*/
}

if (!empty($filterColumn) && !empty($filterValue)) {
	if ($_SESSION['profilepage'] == md5('client')) { 
  $totalSql = "select * from tlr_assignteam as ass INNER JOIN tlr_applyjob as tap on ass.requisitionId = tap.requisitionId
  INNER JOIN tlr_applicants as ta ON ta.id = tap.applicantId where ass.isDeleted= ? $condition";
  $totalResult = pdoQuery($totalSql, array('N'));
	}else{
	$totalSql = "select * from tlr_assignteam as ass INNER JOIN tlr_applyjob as tap on ass.requisitionId = tap.requisitionId INNER JOIN tlr_applicants as ta ON ta.id = tap.applicantId where ass.isDeleted= ? and ass.sourceId = ? $condition";
  $totalResult = pdoQuery($totalSql, array('N', $userid));
	}
  $totalCount = count($totalResult);
  $totalPages = ceil($totalCount / $limit);
  if ($pageno == 1) {
    $pageno = 0;
  } else {
    $pageno = ($pageno - 1) * $limit;
    $limit = $pageno * $limit;
  }
  if ($_SESSION['profilepage'] == md5('client')) { 
	$applicationSql = "select tap.id,tap.applicantId,ass.requisitionId,tap.status from tlr_assignteam as ass INNER JOIN tlr_applyjob as tap on ass.requisitionId = tap.requisitionId 
  INNER JOIN tlr_applicants as ta ON ta.id = tap.applicantId where ass.isDeleted= ? $condition limit " . $pageno . ',' . $limit;
  $resultRow = pdoQuery($applicationSql, array('N'));
  }else{
	  $applicationSql = "select tap.id,tap.applicantId,ass.requisitionId,tap.status from tlr_assignteam as ass INNER JOIN tlr_applyjob as tap on ass.requisitionId = tap.requisitionId 
  INNER JOIN tlr_applicants as ta ON ta.id = tap.applicantId where ass.isDeleted= ? and ass.sourceId = ? $condition limit " . $pageno . ',' . $limit;
  $resultRow = pdoQuery($applicationSql, array('N', $userid));
  }
}
if (!empty($message)) echo $message;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 mb-3">
            <form method="POST" id="limitform" name="limitform">
                <select name="fixlimit" id="fixlimit" class="form-select" onchange="limitChanged(this.value);">
                    <?php if ($_REQUEST['fixlimit'] == '25') { ?>
                    <option value="10">10</option>
                    <option value="25" selected="selected">25</option>
                    <option value="30">30</option>
                    <?php } else if ($_REQUEST['fixlimit'] == 30) {  ?>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="30" selected="selected">30</option>
                    <?php } else {  ?>
                    <option value="10" selected="selected">10</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                    <?php  } ?>
                </select>
            </form>
        </div>
        <div class="col-md-2 mb-3">
            <form method="POST" id="filterform" name="filterform">
                <select name="filterColumn" class="form-select" id="filterColumn">
                    <option value="" hidden>Select</option>
                    <option value="name" <?php echo $selected; ?>>Applicant Name</option>
                    <!-- <option value="email" <?php //echo $selected3; 
                                      ?> >Email</option>
          <option value="applicationNo" <?php //echo $selected1; 
                                        ?> >Application No</option>
          <option value="contactnumber" <?php //echo $selected2; 
                                        ?> >Mobile Number</option>-->
                </select>
        </div>
        <div class="col-md-3 mb-3">
            <input type="text" name="filterValue" class="form-control" placeholder="Type something..." id="filterValue"
                value="<?php echo $filterValue; ?>" />
        </div>
        <div class="col-md-2 mb-3">
            <button type="submit" class="custom-btn">Search</button>
        </div>
        </form>
    </div>
</div>
<?php if (!empty($filterColumn) && !empty($filterValue)) { ?>
<div class="responsive-table">
    <table class="table mt-4">
        <thead class="custom-thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Application Name</th>
                <th scope="col">Job Applied</th>
                <th scope="col">status</th>
                <?php if ($appliedApplicantAcess == 3) { ?> <th scope="col">View</th> <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
        $k = 1;
        if (count($resultRow) > 0) {

          foreach ($resultRow as $rows) {
            $applicantId = encrypt_decrypt('encrypt', $rows['id']);
            $applicantName = getApplicantName($rows['applicantId']);
            $getRequisitionName = getRequisitionName($rows['requisitionId']);
            $applicantStatus = getApplicantStatus($rows['id']);
        ?>
            <tr id="record<?php echo $k; ?>">
                <th scope="row"><?php echo $k; ?></th>
                <td><?php echo $applicantName; ?></td>
                <td><?php echo $getRequisitionName; ?></td>
                <td><?php echo $applicantStatus; ?> <br /><a href="#" class="updateapplicationstatus"
                        attr-reqId="<?php echo $rows['requisitionId']; ?>"
                        attr-jobId="<?php echo $rows['id']; ?>">change
                        status</a></td>
                <?php if ($appliedApplicantAcess == 3) { ?> <td><a
                        href="applicantview.php?eid=<?php echo encrypt_decrypt('encrypt', $rows['applicantId']); ?>"
                        title="pageview"><span class="material-icons-round">view</span></a> <?php } ?> </td>
            </tr>
            <?php $k++;
          }
        }
        ?>
</div>
</div>
<tr>
    <td colspan="7">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($totalPages > 1) {
            if ($pageno > 0) { ?>
                <li class="page-item">
                    <a href="applicantsearch.php?pageno=1&fixlimit=<?php echo $fixlimit; ?>" class="page-link">
                        Previous </a>
                </li>
                <?php   }
            for ($i = 0; $i < $totalPages; $i++) {  ?>
                <li class="page-item"> <a
                        href="applicantsearch.php?pageno=<?php echo $i + 1; ?>&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"><?php echo $i + 1; ?></a></li>
                <?php }
            if ($totalPages > $pageno + 1) { ?>
                <li class="page-item"> <a
                        href="applicantsearch.php?pageno=<?php echo $totalPages; ?>&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"> Next </a> </li>
                <?php   }
          } ?>
    </td>
</tr>
</tbody>
</table>
</div>
<?php } ?>
<!-- Modal -->
<div id="myModal" class="modal" style="width:40%; margin-left: 30%; height:50%; margin-top: 50px;">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p><span id="errMessage"></span>
        <form>
            <div class="form-group col-md-6">
                <input type="hidden" name="logjobId" id="logjobId" value="" />
                <label class="form-label" for="country"><span class="req">* </span> change status: </label>
                <span class="optionArr"></span>
            </div>

            <div class=" mb-3 md-form amber-textarea active-amber-textarea col-md-6">
                <label class="form-label" for="description"><span class="textdescription">* </span>Description:
                </label>
                <textarea class="md-textarea form-control" name="comments" id="comments" rows="1"></textarea>
            </div>
            <div style="float:right; margin-right: 18px;"><button type="button"
                    class="btn btn-primary cmtop submitjoblog">Save</button></div>
        </form>
        </p>
    </div>

</div>
<script type="text/javascript">
function limitChanged(limit) {
    document.getElementById('limitform').submit();
}
var span = document.getElementsByClassName("close")[0];
</script>
<script type="text/javascript" src="js/registration.js?v=9"></script>

</script>