<?php
require_once('header/dbconnection.php');
require_once('header/commonFunction.php');
error_reporting(0);
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
} else {
    $userid = encrypt_decrypt('decrypt', $_SESSION['userid']);
    $menuid = $_SESSION['menuid'];
}
$menuSql = "select * from tlr_menu_page_rel where adminId = ? and isDeleted = ? and accessId <> ? order by priorityOrder ASC";
$menuResult = pdoQuery($menuSql, array($menuid, 'N', 0));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Admin Dashboard</title>
    <?php require_once('header/registrationHeader.php'); ?>
    <link rel="stylesheet" href="css/style.css" />
    <script>
    function openSidebar() {
        const sidebar = document.getElementById("menu");
        const iconToggle = document.getElementById("icon-toggle");
        const elements = document.getElementsByClassName("names");
        for (var i = 0, length = elements.length; i < length; i++) {
            elements[i].classList.toggle('show');
        }
        sidebar.classList.toggle('show');
        iconToggle.classList.toggle('fa-bars');
        iconToggle.classList.toggle('fa-times');
    }
    </script>
</head>

<body>
    <section id="header">
        <nav class="navbar top-navbar navbar-expand-lg navbar-light bg-light p-0">
            <div class="container-fluid">

                <img class="img-fluid" src="images/iprimed.png" alt="">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <!-- <a class="nav-link" href="#">Help</a>
                        <a class="nav-link" href="#">Notification</a>
                        <a class="nav-link" href="#">Message</a> -->
                        <?php if ($_SESSION['profilepage'] == md5('client')) { ?>
                        <a class="nav-link" href="profile.php?eid=<?php echo $_SESSION['userid']; ?>">Profile</a>
                        <?php } else if ($_SESSION['profilepage'] == md5('source')) { ?>
                        <a class="nav-link" href="source_profile.php?eid=<?php echo $_SESSION['userid']; ?>">Profile</a>
                        <?php  } else { ?>
                        <a class="nav-link" href="testapplicant.php?eid=<?php echo $_SESSION['userid']; ?>">Profile</a>
                        <?php } ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <div class="main-container">
        <div class="
    sidebar
    flex-column
    mb-sm-auto mb-0
    align-items-center align-items-sm-start
    d-flex
    justify-content-space-between
  " id="menu">
            <a href="#" onclick="openSidebar()"
                class="nav-link text-center px-0 sidebar-link d-block d-lg-none d-xl-none d-sm-none d-md-none">
                <i id="icon-toggle" class="fa fa-bars"></i>
                <span class="names d-none d-sm-inline">Close</span>
            </a>
            <a href="dashboard.php" class="nav-link align-middle px-0 sidebar-link">
                <i class="fa fa-home"></i>
                <span class="names d-none d-sm-inline">Home</span>
            </a>
            <?php
            $homeAccess = 1;
            foreach ($menuResult as $menu) { ?>
            <?php //if($menu['menuId'] == 1 && $menu['accessId'] > 0){ 
                ?>

            <?php //$homeAccess = $menu['accessId'];
                if ($menu['menuId'] == 2 && $menu['accessId'] > 0) { ?>
            <?php if ($_SESSION['profilepage'] == md5('client')) { ?>
            <a href="profile.php?eid=<?php echo $_SESSION['userid']; ?>"
                class="nav-link align-middle px-0 sidebar-link">
                <?php } else if ($_SESSION['profilepage'] == md5('source')) { ?>
                <a href="source_profile.php?eid=<?php echo $_SESSION['userid']; ?>"
                    class="nav-link align-middle px-0 sidebar-link">
                    <?php  } else { ?>
                    <a href="testapplicant.php?eid=<?php echo $_SESSION['userid']; ?>"
                        class="nav-link align-middle px-0 sidebar-link">
                        <?php } ?>
                        <i class="fas fa-user-circle"></i>
                        <span class="names d-none d-sm-inline">Profile</span>
                    </a>
                    <?php $profileAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 3 && $menu['accessId'] > 0) { ?>
                    <a href="clientgridregistration.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-user-cog"></i>
                        <span class="names d-none d-sm-inline">Client Management</span>
                    </a>
                    <?php $clientAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 4 && $menu['accessId'] > 0) { ?>
                    <a href="requisitionsgridregistration.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-list-ul"></i>
                        <span class="names d-none d-sm-inline">Requisitions Management</span>
                    </a>
                    <?php $requisitionAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 5 && $menu['accessId'] > 0) { ?>
                    <a href="sourcegridregistration.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-users"></i>
                        <span class="names d-none d-sm-inline">Source Management</span>
                    </a>
                    <?php $sourceAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 6 && $menu['accessId'] > 0) { ?>
                    <a href="traininggridregistration.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="names d-none d-sm-inline">Traning Management</span>
                    </a>
                    <?php $trainingAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 7 && $menu['accessId'] > 0) { ?>
                    <a href="rolemastergridregistration.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-user-tag"></i>
                        <span class="names d-none d-sm-inline">Role Management</span>
                    </a>
                    <?php $roleAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 8 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-users-cog"></i>
                        <span class="names d-none d-sm-inline">User Management</span>
                    </a>
                    <?php $userAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 9 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <span class="material-icons-round">settings_suggest</span>
                        <span class="names d-none d-sm-inline">Content Management</span>
                    </a>
                    <?php $contentAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 10 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <span class="material-icons-round">admin_panel_settings</span>
                        <span class="names d-none d-sm-inline">Permission Management</span>
                    </a>
                    <?php $permissionAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 11 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-calendar"></i>
                        <span class="names d-none d-sm-inline">Calendar</span>
                    </a>
                    <?php $eventAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 12 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-ticket-alt"></i>
                        <span class="names d-none d-sm-inline">Tickets</span>
                    </a>
                    <?php $ticketAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 13 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-bullhorn"></i>
                        <span class="names d-none d-sm-inline">News/Announcement</span>
                    </a>
                    <?php $newsAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 14 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-comment-alt"></i>
                        <span class="names d-none d-sm-inline">Feedback</span>
                    </a>
                    <?php $feedbackAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 15 && $menu['accessId'] > 0) { ?>
                    <a href="#" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-clipboard-list"></i>
                        <span class="names d-none d-sm-inline">Logs</span>
                    </a>
                    <?php $logsAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 16 && $menu['accessId'] > 0) { ?>
                    <!-- <a href="logout.php" class="nav-link align-middle px-0 sidebar-link">
    <span class="material-icons-round">logout</span>
    <span class="names d-none d-sm-inline">Log out</span>
  </a>-->
                    <?php }
                        if ($menu['menuId'] == 17 && $menu['accessId'] > 0) { ?>
                    <a href="assigngridrecruiters.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-user-check"></i>
                        <span class="names d-none d-sm-inline">Assign to recruiters</span>
                    </a>
                    <?php $assignAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 18 && $menu['accessId'] > 0) { ?>
                    <a href="stagegridmaster.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-sort-amount-down-alt"></i>
                        <span class="names d-none d-sm-inline">Stages Management</span>
                    </a>
                    <?php $stagesAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 19 && $menu['accessId'] > 0) { ?>
                    <a href="applicantsearch.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-search"></i>
                        <span class="names d-none d-sm-inline">Applicant Search</span>
                    </a>
                    <?php $applicantAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 20 && $menu['accessId'] > 0) { ?>
                    <a href="scheduletestgridapplicant.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-user-clock"></i>
                        <span class="names d-none d-sm-inline">Schedule Test Applicant</span>
                    </a>
                    <?php $scheduleTestAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 21 && $menu['accessId'] > 0) { ?>
                    <a href="testschedulegridmaster.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-clock"></i>
                        <span class="names d-none d-sm-inline">Schedule Test Management</span>
                    </a>
                    <?php $scheduleMasterAccess = $menu['accessId'];
                        }
                        if ($menu['menuId'] == 22 && $menu['accessId'] > 0) { ?>
                    <a href="appliedApplicant.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-search-plus"></i>
                        <span class="names d-none d-sm-inline">Applied Applicant Search</span>
                    </a>
                    <?php $appliedApplicantAcess = $menu['accessId'];
                        }
                    }   if($_SESSION['profilepage'] == md5("applicant")){ ?>
                 <a href="searchrequisitions.php" class="nav-link align-middle px-0 sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    <span class="names d-none d-sm-inline">Job Apply</span>
                </a>
              <?php $jobApplyAcess = 3; 
              } if($_SESSION['profilepage'] == md5("source") ){ ?>
                 <a href="appliedApplicant.php" class="nav-link align-middle px-0 sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    <span class="names d-none d-sm-inline">Applied Applicant Search</span>
                </a>
                <a href="applicantsearch.php" class="nav-link align-middle px-0 sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    <span class="names d-none d-sm-inline">Applicant Search</span>
                </a>
                <a href="testapplicant.php" class="nav-link align-middle px-0 sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    <span class="names d-none d-sm-inline">Add Applicant</span>
                </a>
              <?php $appliedApplicantAcess = 3; 
                    $applicantAccess = 3; 
              } ?>
                    <a href="logout.php" class="nav-link align-middle px-0 sidebar-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="names d-none d-sm-inline">Log out</span>
                    </a>
        </div>