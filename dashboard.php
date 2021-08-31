<?php
require_once('header/dashboard-header.php');
error_reporting(0);
if ($homeAccess == 0) {
	require_once('accesserror.php');
}
if ($_SESSION['profilepage'] == md5('applicant')) {

	require_once('dashboard-applicant.php');
} else if ($_SESSION['profilepage'] == md5('source')) {

	require_once('dashboard-source.php');
} else if ($_SESSION['profilepage'] == md5('client')) {

	require_once('dashboard-client.php');
} else if ($_SESSION['profilepage'] == md5('applicant')) {

	require_once('dashboard-applicant.php');
} ?>

<script type="text/javascript" src="js/registration.js?v=1"></script>