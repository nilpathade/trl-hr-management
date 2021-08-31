<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully updated.</div>';
} else if ($_GET['message'] == md5('dsuccess')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully deleted.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($roleAccess == 0) {
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
  if ($filterColumn == 'roleName') {
    $condition = "and $filterColumn like '%$filterValue%'";
    $selected = "selected = 'selected'";
  } else if ($filterColumn == 'roleType') {
    if (strtolower($filterValue) == 'source') {
      $filterValueText = 1;
    } else {
      $filterValueText = 2;
    }
    $condition = "and $filterColumn ='$filterValueText'";
    $selected1 = "selected = 'selected'";
  }
}
$totalSql = "select * from tlr_rolemaster where isDeleted= ? $condition";
$totalResult = pdoQuery($totalSql, array('N'));
$totalCount = count($totalResult);
$totalPages = ceil($totalCount / $limit);
if ($pageno == 1) {
  $pageno = 0;
} else {
  $pageno = ($pageno - 1) * $limit;
  $limit = $pageno * $limit;
}
$regeditSql = "select * from tlr_rolemaster where isDeleted= ? $condition limit " . $pageno . ',' . $limit;
$resultRow = pdoQuery($regeditSql, array('N'));
if (!empty($message)) echo $message;
if ($roleAccess == 3) {
?>
<div class="col-md-3"><a href="rolemasterregistration.php"><button class="custom-btn mb-3">Add New Role</button></a>
</div>
<?php } ?>
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
                <option value="roleName" <?php echo $selected; ?>>Role Name</option>
                <option value="roleType" <?php echo $selected1; ?>>Role Type</option>
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
                <th scope="col">Role Name</th>
                <th scope="col">Role Type</th>
                <?php if ($roleAccess == 3) { ?> <th scope="col">Actions</th><?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
      $k = 1;
      if (count($resultRow) > 0) {

        foreach ($resultRow as $rows) {
          $roleId = encrypt_decrypt('encrypt', $rows['id']);
          if ($rows['roleType'] == '1') {
            $roleTypeName = 'Source';
          } else {
            $roleTypeName = 'Training';
          }
      ?>
            <tr>
                <th scope="row"><?php echo $k; ?></th>
                <td><?php echo $rows['roleName']; ?></td>
                <td><?php echo $roleTypeName; ?></td>
                <?php if ($roleAccess == 3) { ?> <td><a class="icon"
                        href="rolemastereditregistration.php?eid=<?php echo encrypt_decrypt('encrypt', $rows['id']); ?>"
                        title="edit"><i class="fas fa-edit bor-right"></i></a><a class="icon" href="#"
                        onClick="javascript:deleteroleconfirmation('<?php echo $roleId; ?>');" title="Delete"><i
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
                    <a href="rolemastergridregistration.php?pageno=1&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"> Previous </a>
                </li>
                <?php   }
          for ($i = 0; $i < $totalPages; $i++) {  ?>
                <li class="page-item"> <a
                        href="rolemastergridregistration.php?pageno=<?php echo $i + 1; ?>&fixlimit=<?php echo $fixlimit; ?>"
                        class="page-link"><?php echo $i + 1; ?></a></li>
                <?php }
          if ($totalPages > $pageno + 1) { ?>
                <li class="page-item"> <a
                        href="rolemastergridregistration.php?pageno=<?php echo $totalPages; ?>&fixlimit=<?php echo $fixlimit; ?>"
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
<script type="text/javascript" src="js/registration.js?v=1"></script>