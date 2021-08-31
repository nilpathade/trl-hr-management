<?php
require_once('header/header.php');
error_reporting(0);
if ($_GET['message'] == md5('success')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully updated.</div>';
} else if ($_GET['message'] == md5('dsuccess')) {
  $message = '<div class="alert alert-success" role="alert">You have successfully deleted.</div>';
} else if ($_GET['message'] == md5('error')) {
  $message = '<div class="alert alert-danger" role="alert">Something went wrong please try again!</div>';
} else if ($stagesAccess == 0) {
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
  if ($filterColumn == 'testName') {
    $condition = "and $filterColumn like '%$filterValue%'";
    $selected = "selected = 'selected'";
  }
}
$totalSql = "select * from tlr_test_schedule_master where isDeleted= ? $condition";
$totalResult = pdoQuery($totalSql, array('N'));
$totalCount = count($totalResult);
$totalPages = ceil($totalCount / $limit);
if ($pageno == 1) {
  $pageno = 0;
} else {
  $pageno = ($pageno - 1) * $limit;
  $limit = $pageno * $limit;
}
$regeditSql = "select * from tlr_test_schedule_master where isDeleted= ? $condition limit " . $pageno . ',' . $limit;
$resultRow = pdoQuery($regeditSql, array('N'));
if (!empty($message)) echo $message;
if ($stagesAccess == 3) {
?>
<div class="container-fluid">
    <div class="col-md-3"><a href="testscheduleaddmaster.php"><button class="custom-btn mb-3"> Add New Test</button></a>
    </div> <?php } ?>
    <div class="row">
        <div class="col-md-2">
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
        <div class="col-md-2">
            <form method="POST" id="filterform" name="filterform">
                <select name="filterColumn" class="form-select" id="filterColumn">
                    <option value="" hidden>Select</option>
                    <option value="testName" <?php echo $selected; ?>>test Name</option>
                </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="filterValue" placeholder="Type Something..." class="form-control" id="filterValue"
                value="<?php echo $filterValue; ?>" />
        </div>
        <div class="col-md-2">
            <button type="submit" class="custom-btn">Search</button>
        </div>
        </form>
    </div>
    <div class="responsive-table">
        <table class="table mt-4">
            <thead class="custom-thead">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Test Name</th>
                    <th scope="col">Test URL</th>
                    <th scope="col">Created By</th>
                    <?php if ($stagesAccess == 3) { ?> <th scope="col">Actions</th><?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
        $k = 1;
        if (count($resultRow) > 0) {

          foreach ($resultRow as $rows) {
            $testId = encrypt_decrypt('encrypt', $rows['id']);

        ?>
                <tr>
                    <th scope="row"><?php echo $k; ?></th>
                    <td><?php echo $rows['testName']; ?></td>
                    <td><?php echo $rows['testUrl']; ?></td>
                    <td><?php echo $rows['createdBy']; ?></td>
                    <?php if ($stagesAccess == 3) { ?> <td><a class="icon"
                            href="testscheduleeditmaster.php?eid=<?php echo encrypt_decrypt('encrypt', $rows['id']); ?>"
                            title="edit"><i class="bor-right fa fa-edit"></i></a><a class="icon" href="#"
                            onClick="javascript:deletetestscheduleconfirmation('<?php echo $testId; ?>');"
                            title="Delete"><i class="fas fa-trash"></i></a>
                    </td> <?php } ?>
                </tr>
                <?php $k++;
          }
        }
        ?>

                <tr>
                    <td colspan="7">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <?php if ($totalPages > 1) {
                  if ($pageno > 0) { ?>
                                <li class="page-item">
                                    <a href="testschedulegridmaster.php?pageno=1&fixlimit=<?php echo $fixlimit; ?>"
                                        class="page-link">
                                        Previous </a>
                                </li>
                                <?php   }
                  for ($i = 0; $i < $totalPages; $i++) {  ?>
                                <li class="page-item"> <a
                                        href="testschedulegridmaster.php?pageno=<?php echo $i + 1; ?>&fixlimit=<?php echo $fixlimit; ?>"
                                        class="page-link"><?php echo $i + 1; ?></a></li>
                                <?php }
                  if ($totalPages > $pageno + 1) { ?>
                                <li class="page-item"> <a
                                        href="testschedulegridmaster.php?pageno=<?php echo $totalPages; ?>&fixlimit=<?php echo $fixlimit; ?>"
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