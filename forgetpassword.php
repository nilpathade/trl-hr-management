<?php require_once('header/loginHeader.php'); ?>

<body class="login-body">
    <div class="container login-container">
        <div class="inner-container">
            <h3 class="text-center">Forgot password</h3>
            <p class="text-center">Please enter registered email address only</p>
            <?php if (!empty($message)) echo '<div class="' . $clsname . '" role="alert">' . $message . '</div>'; ?>
            <form class="forgotform" name="forgotfms" autocomplete="OFF" action="forgotsubmit.php" method="POST">
                <div class="mb-3">
                    <!-- <label for="email"><span class="req">* </span> Email Address: </label> -->
                    <input class="form-control emailclass w-100" required type="text" name="email" id="email"
                        onkeyup="email_validate(this.value);" placeholder="* Email" />
                    <div id="status"></div>
                </div>
                <button class="custom-btn w-100 forgotsubmit" type="submit">Reset</button>
                <div class="text-center mt-3">
                    <a href="login.php" class="link">
                        <i class="fa fa-chevron-left"></i>
                        Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script type="text/javascript" src="js/registration.js?v=10"></script>