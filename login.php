<?php require_once('header/loginHeader.php');
error_reporting(0);
$message =  $_GET['message'] ? $_GET['message'] : '';
$clsname = "alert alert-danger";
if ($message == md5('error')) {
  $message = "Invalid username or password!";
} else if ($message == md5('logout')) {
  $message = "You have successfully logged out!";
  $clsname = "alert alert-success";
}
?>

<body class="login-body">
    <div class="login-container">
        <div class="row">
            <div class="col-md-6 d-none d-md-block d-lg-block p-0">
                <img src="images/login.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-6 p-0">
                <div class="inner-container">
                    <h4 class="main-head mb-4 mt-4">Welcome to TLR Portal</h4>
                    <h5 class="sub-head mb-4">Login</h3>
                        <?php if (!empty($message)) echo '<div class="' . $clsname . ' text-center" role="alert">' . $message . '</div>'; ?>
                        <form class="regform" action="loginsubmit.php" method="POST">
                            <div class="mb-3">
                                <!-- <label class="form-label" for="email">Email:</label> -->
                                <input class="custom-input" placeholder="Email" type="email" name="email" id="email"
                                    required />
                            </div>
                            <div class="mb-2">
                                <!-- <label class="form-label" for="password">Password:</label> -->
                                <input class="custom-input" placeholder="Password" type="password" name="password"
                                    id="password" required />
                            </div>
                            <div class="text-end mb-3">
                                <a href="forgetpassword.php" class="link">Forgot Password?</a>
                            </div>
                            <div>
                                <button class="custom-btn w-100" type="submit">Login</button>
                            </div>
                            <div class="text-center mt-4 text-muted">Not a member?
                                <a class="link" href="applicantregister.php">Register </a>
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>