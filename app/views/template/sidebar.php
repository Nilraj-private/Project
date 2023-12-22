<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-1">
    <!-- Brand Logo -->
    <a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php" class="brand-link brand_logo">
        <img src="<?= $_SESSION['url_path'] ?>/public/images/logo1.png" alt="Niki Data Recovery Services" class="brand-image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-4 ">

            <div class="align_center">
                <div class="image">
                    <img src="<?= $_SESSION['url_path'] ?>/public/images/avtar.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info online_txt">
                    <a href="#" class="d-block">Hello, <?= (!isset($_SESSION['user_name'])) ? 'Super Admin' :  ucwords($_SESSION['user_name']) ?></a>
                </div>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'dashboard.php') ? 'nav-item menu-is-opening menu-open' : '' ?>">
                    <a href="<?= $_SESSION['url_path'] ?>/app/views/dashboard.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'dashboard.php') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt mr5"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'register.php?type=inward' || $_SESSION['page'] == 'register.php?type=outward' || $_SESSION['page'] == 'create_inward.php')) ? 'nav-item menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-inbox mr5"></i>
                        <p>
                            Register
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml30" style="display: <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'register.php?type=inward' || $_SESSION['page'] == 'register.php?type=outward' || $_SESSION['page'] == 'create_inward.php')) ? 'block' : 'none' ?>;">
                        <li class="nav-item">
                            <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?type=inward" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'register.php?type=inward') ? 'active' : '' ?>">
                                <p>Inward</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $_SESSION['url_path'] ?>/app/views/register/register.php?type=outward" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'register.php?type=outward') ? 'active' : '' ?>">
                                <p>Outward</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $_SESSION['url_path'] ?>/app/views/register/create_inward.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'create_inward.php') ? 'active' : '' ?>">
                                <p>Create Inward</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'SuperAdmin') { ?>
                    <li class="nav-item <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'customer_index.php' || $_SESSION['page'] == 'customer_form.php')) ? 'nav-item menu-is-opening menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-laptop mr5"></i>
                            <p>
                                Customer
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml30" style="display: <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'customer_index.php' || $_SESSION['page'] == 'customer_form.php')) ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_index.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'customer_index.php') ? 'active' : '' ?>">
                                    <p>Customer List</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/customer/customer_form.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'customer_form.php') ? 'active' : '' ?>">
                                    <p>Add Customer</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'user_index.php' || $_SESSION['page'] == 'device_manufacturer_index.php' || $_SESSION['page'] == 'database_backup.php')) ? 'nav-item menu-is-opening menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit mr5"></i>
                            <p>
                                Administrator
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml30" style="display: <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'user_index.php' || $_SESSION['page'] == 'device_manufacturer_index.php' || $_SESSION['page'] == 'database_backup.php')) ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/administrator/user_index.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'user_index.php') ? 'active' : '' ?>">
                                    <p>User Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/administrator/device_manufacturer_index.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'device_manufacturer_index.php') ? 'active' : '' ?>">
                                    <p>Device Manufacturer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/administrator/database_backup.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'database_backup.php') ? 'active' : '' ?>">
                                    <p>Database Backup</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/administrator/city_index.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'city_index.php') ? 'active' : '' ?>">
                                    <p>City</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'change_password.php' || $_SESSION['page'] == 'problems.php')) ? 'nav-item menu-is-opening menu-open' : '' ?>">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit mr5"></i>
                            <p>
                                General
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml30" style="display: <?= (isset($_SESSION['page']) && ($_SESSION['page'] == 'change_password.php' || $_SESSION['page'] == 'problems.php')) ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/auth/change_password.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'change_password.php') ? 'active' : '' ?>">
                                    <p>Change Password</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= $_SESSION['url_path'] ?>/app/views/general/problems/problems.php" class="nav-link <?= (isset($_SESSION['page']) && $_SESSION['page'] == 'problems.php') ? 'active' : '' ?>">
                                    <p>Problems</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>