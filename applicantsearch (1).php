<?php 
require_once('header/header.php');
error_reporting(0);
if($_GET['message']==md5('success')){
  $message = '<div class="alert alert-success" role="alert">You have successfully updated.</div>';
}else if($_GET['message']==md5('dsuccess')){
  $message = '<div class="alert alert-success" role="alert">You have successfully deleted.</div>';
}else if($_GET['message']==md5('error')){
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
}else if($clientAccess == 0){
  require_once('accesserror.php');
 }
$pageno = !empty($_GET['pageno']) ?  $_GET['pageno'] : 1;
$fixlimit = !empty($_REQUEST['fixlimit']) ?  $_REQUEST['fixlimit'] : 10;
$limit = !empty($_REQUEST['fixlimit']) ?  $_REQUEST['fixlimit'] : 10;
$filterColumn = !empty($_REQUEST['filterColumn']) ?  $_REQUEST['filterColumn'] : '';
$filterValue = !empty($_REQUEST['filterValue']) ?  $_REQUEST['filterValue'] : '';
$condition = ''; $selected = ''; $selected1 = ''; $selected2 = ''; $selected3 = '';
if(!empty($filterColumn) && !empty($filterValue)){
   if($filterColumn == 'name'){
    $condition = "and $filterColumn like '%$filterValue%'";
    $selected = "selected = 'selected'";
   }else if($filterColumn == 'applicationNo'){
    $condition = "and $filterColumn ='$filterValue'";
      $selected1 = "selected = 'selected'";
   }else if($filterColumn == 'contactnumber'){
    $condition = "and $filterColumn ='$filterValue'";
      $selected2 = "selected = 'selected'";
   }else if($filterColumn == 'email'){
    $condition = "and $filterColumn ='$filterValue'";
    $selected3 = "selected = 'selected'";
  }
}
if(!empty($filterColumn) && !empty($filterValue)){
$totalSql = "select * from tlr_applicants where isDeleted= ? $condition";
$totalResult = pdoQuery($totalSql,array('N'));
$totalCount = count($totalResult);
$totalPages = ceil($totalCount/$limit);
if($pageno == 1){
  $pageno = 0;
}else{
  $pageno = ($pageno-1)*$limit;
  $limit = $pageno*$limit;
}
$applicationSql = "select * from tlr_applicants where isDeleted= ? $condition limit ".$pageno.','.$limit;
$resultRow = pdoQuery($applicationSql,array('N'));
}
if(!empty($message)) echo $message; 
?>
<div class="row">
  <div class="col-md-1 cmtop">
    <form method="POST" id="limitform" name="limitform">
      <select name="fixlimit" id="fixlimit" class="form-control" onchange="limitChanged(this.value);"> 
       <?php if($_REQUEST['fixlimit'] == '25'){ ?>
      <option value="10">10</option>
      <option value="25" selected="selected">25</option>
      <option value="30">30</option>
      <?php } else if($_REQUEST['fixlimit'] == 30){  ?>
      <option value="10">10</option>
          <option value="25">25</option>
          <option value="30" selected="selected">30</option>
     <?php }else{  ?>
      <option value="10" selected="selected">10</option>
          <option value="25">25</option>
          <option value="30">30</option>
      <?php  } ?>
      </select>
    </form>
  </div>
   <div class="col-md-3 cmtop">
         <form method="POST" id="filterform" name="filterform">
        <select name="filterColumn" class="form-control" id="filterColumn"> 
           <option value="">---select---</option>
          <option value="name" <?php echo $selected; ?> >Applicant Name</option>
          <option value="email" <?php echo $selected3; ?> >Email</option>
          <option value="applicationNo" <?php echo $selected1; ?> >Application No</option>
          <option value="contactnumber" <?php echo $selected2; ?> >Mobile Number</option>
        </select>
      </div>
      <div class="col-md-4 cmtop">
        <input type="text" name="filterValue" class="form-control" id="filterValue" value="<?php echo $filterValue; ?>" />
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary cmtop">Search</button>
      </div>
    </form>
    </div>
<?php if(!empty($filterColumn) && !empty($filterValue)){ ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
         <th scope="col">Application No</th>
      <th scope="col">Applicant Name</th>
      <th scope="col">Email Address</th>
      <th scope="col">Mobile No.</th>
      <th scope="col">Urgency Level</th>
      <?php if($clientAccess==3){ ?> <th scope="col">View</th> <?php } ?>
    </tr>
  </thead>
   <tbody>
  <?php
   $k=1;
  if(count($resultRow) > 0 ){
  
    foreach ($resultRow as $rows) {
      $applicantId = encrypt_decrypt('encrypt',$rows['id']);
       $urgencyLevel = getUrgencyLevel($rows['urgencylevel']);
      ?>
      <tr>
          <th scope="row"><?php echo $k; ?></th>
           <td><?php echo $rows['applicationNo']; ?></td>
          <td><?php echo $rows['name']; ?></td>
          <td><?php echo $rows['email']; ?></td>
          <td><?php echo $rows['contactnumber']; ?></td>
          <td><?php echo $urgencyLevel; ?></td>
          <?php if($clientAccess==3){ ?> <td><a href="applicantview.php?eid=<?php echo encrypt_decrypt('encrypt',$rows['id']); ?>" title="pageview"><span class="material-icons-round">list</span></a> <?php } ?> </td>
      </tr>
<?php $k++;
       }

     }
    ?>
 </div></div>
 <tr>
    <td colspan="7">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
    <?php if($totalPages > 1){ 
              if($pageno > 0){ ?>
                 <li class="page-item">
                <a href="applicantsearch.php?pageno=1&fixlimit=<?php echo $fixlimit; ?>" class="page-link"> Previous </a></li>
           <?php   }
          for($i=0;$i<$totalPages;$i++){  ?>
               <li class="page-item"> <a href="applicantsearch.php?pageno=<?php echo $i+1; ?>&fixlimit=<?php echo $fixlimit; ?>" class="page-link"><?php echo $i+1; ?></a></li>
            <?php } 
             if($totalPages > $pageno+1){ ?>
               <li class="page-item">  <a href="applicantsearch.php?pageno=<?php echo $totalPages; ?>&fixlimit=<?php echo $fixlimit; ?>" class="page-link"> Next </a> </li>
           <?php   }
          } ?>
      </td>
    </tr>
 </tbody>
</table>
<?php } ?>
<script type="text/javascript">
  function limitChanged(limit){
     document.getElementById('limitform').submit();
  }
</script>
<script type="text/javascript" src="js/registration.js"></script>