<?php 

$is_login_page = 1;

include('../template/head.php');

?>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-header text-center">
                <img src="<?= $_SESSION['url_path'] ?>/public/images/logo2.jpg" alt="Niki Data Recovery Services" class="brand-image" style="height:164px;">
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="login_form" action="../../controllers/login.php" method="POST">
                    <input type="hidden" name="login_page">
                    <div class="input-group mb-3">
                        <input type="email" name="username" id="username" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['error']['username'])) {
                            echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
                            unset($_SESSION['error']); // Remove the error message from the session
                        }
                        ?>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <!-- <p class="mb-1">
                    <a href="change_password.php">I forgot my password</a>
                </p> -->
            </div>
        </div>
    </div>

    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/jquery/jquery.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/js/adminlte.min.js?v=3.2.0"></script>
    <script src="<?= $_SESSION['url_path'] ?>/public/plugins/toastr/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            if ("<?= isset($_SESSION['success_message']) ? 1 : 0 ?>" == 1) {
                toastr.success("<?= $_SESSION['success_message'] ?? '' ?>")
                var unnset = "<?php unset($_SESSION['success_message']); ?>"
            }
        })
    </script>
</body>

</html>