<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item  d-sm-inline-block">
      <a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php" class="nav-link res_home">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto mr5">
    <a href="<?= $_SESSION['url_path'] ?>/app/controllers/logout.php" class="btn btn-primary float-left mr10">Sign Out <i class='fa fa-sign-out ml5'></i></a>
  </ul>
</nav>
<!-- /.navbar -->