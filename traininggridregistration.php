<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully updated.</div>';
} else if ($_GET['message'] == md5('dsuccess')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully deleted.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($trainingAccess == 0) {
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
  if ($filterColumn == 'firstName' || $filterColumn == 'currentDepartment') {
    $condition = "and $filterColumn like '%$filterValue%'";
    $selected = "selected = 'selected'";
    if ($filterColumn == 'currentDepartment') {
      $selected1 = "selected = 'selected'";
    }
  } else if ($filterColumn == 'email') {
    $condition = "and $filterColumn ='$filterValue'";
    $selected3 = "selected = 'selected'";
  } else if ($filterColumn == 'role') {
    $condition = "and $filterColumn ='$filterValue'";
    $selected2 = "selected = 'selected'";
  }
}
$totalSql = "select * from tlr_sourcingteam where roleType= ? and isDeleted= ? $condition";
$totalResult = pdoQuery($totalSql, array(2, 'N'));
$totalCount = count($totalResult);
$totalPages = ceil($totalCount / $limit);
if ($pageno == 1) {
  $pageno = 0;
} else {
  $pageno = ($pageno - 1) * $limit;
  $limit = $pageno * $limit;
}
$regeditSql = "select * from tlr_sourcingteam where roleType= ? and  isDeleted= ? $condition limit " . $pageno . ',' . $limit;
$resultRow = pdoQuery($regeditSql, array(2, 'N'));
if (!empty($message)) echo $message;
if ($trainingAccess == 3) {
?>
<div class="col-md-3"><a href="trainingregistration.php"> <button class="custom-btn mb-3"> Add New Training</button></a>
</div> <?php } ?>
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
                <option value="firstName" <?php echo $selected; ?>>Source team Name</option>
                <option value="email" <?php echo $selected3; ?>>Email</option>
                <option value="currentDepartment" <?php echo $selected1; ?>>Depatment</option>
                <option value="role" <?php echo $selected2; ?>>Role</option>
            </select>
    </div>
    <div class="col-md-3 mb-3">
        <input type="text" name="filterValue" class="form-control" id="filterValue" placeholder="Type Something..."
            value="<?php echo $filterValue; ?>" />
    </div>
    <div class="col-md-2 mb-3">
        <button type="submit" class="custom-btn">Search</button>
    </div>
    </form>
</div>
<div class="responsive-table">
    <table class="table mt-3">
        <thead class="custom-thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Soucce team Name</th>
                <th scope="col">Email Address</th>
                <th scope="col">Mobile No.</th>
                <th scope="col">Depatment</th>
                <th scope="col">Role</th>
                <?php if ($trainingAccess == 3) { ?><th scope="col">Actions</th> <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
      $k = 1;
      if (count($resultRow) > 0) {

        foreach ($resultRow as $rows) {
          $sourceId = encrypt_decrypt('encrypt', $rows['id']);
          $rolename = getRoleName(2, $rows['role']);
      ?>
            <tr>
                <th scope="row"><?php echo $k; ?></th>
                <td><?php echo $rows['firstName'] . ' ' . $rows['lastName']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['mobile']; ?></td>
                <td><?php echo $rows['currentDepartment']; ?></td>
                <td><?php echo $rolename; ?></td>
                <?php if ($trainingAccess == 3) { ?> <td><a class="icon"
                        href="trainingeditregistration.php?eid=<?php echo encrypt_decrypt('encrypt', $rows['id']); ?>"
                        title="edit"><i class="fas fa-edit bor-right"></i></a><a class="icon" href="#"
                        onClick="javascript:deletetrainingconfirmation('<?php echo $sourceId; ?>');" title="Delete"><i
                            class="fas fa-trash"></i></a>
                </td> <?php } ?>
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
                <?php if ($totalPages > 0) {
          if ($pageno > 0) { ?>
                <li class="page-item">
                    <a href="traininggridregistration.php?pageno=1&fixlimit=<?php echo $fixlimit; ?>" class="page-link">
                        Previous </a>
                </li>
                <?php   }
          for ($i = 0; $i < $totalPages; $i++) {  ?>
                <li class="page-item"> <a
                        href="traininggridregistration.php?pageno=<?php echo $i + 1; ?>&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"><?php echo $i + 1; ?></a></li>
                <?php }
          if ($totalPages > $pageno + 1) { ?>
                <li class="page-item"> <a
                        href="traininggridregistration.php?pageno=<?php echo $totalPages; ?>&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"> Next </a> </li>
                <?php   }
        } ?>
    </td>
</tr>
</tbody>
</table>
</div>
<script type="text/javascript">
function limitChanged(limit) {
    document.getElementById('limitform').submit();
}
</script>
<script type="text/javascript" src="js/registration.js?v=2"></script>