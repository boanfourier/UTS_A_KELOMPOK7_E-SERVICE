<?php
    $avatar_id = $_SESSION['user_id'];
    $avatar_sql = "SELECT * FROM user WHERE id = '$avatar_id'";
    $avatar = $conn->query($avatar_sql);
    $avatar_data = $avatar->fetch_array();
?>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?page=admin">
            <div class="sidebar-brand-icon">
               <i class="fa fa-user-secret"></i>
            </div>
            <div class="sidebar-brand-text mx-3">E-Laporz</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="?page=admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>



        <li class="nav-item">
            <a class="nav-link" href="?page=admin-posting">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Postingan</span></a>
        </li>

        

        <li class="nav-item">
            <a class="nav-link" href="?page=admin-komentar">
                <i class="fas fa-fw fa-comment"></i>
                <span>Komentar</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="?page=admin-user">
                <i class="fas fa-fw fa-users"></i>
                <span>User</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>



    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-dark bg-secondary topbar mb-4 static-top shadow">

                <div class="navbar-brand">
                    <h5>Administrator</h5>
                </div>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-white small"><?= ucfirst($avatar_data['nama']); ?></span>
                            <img class="img-profile rounded-circle" src="<?= $avatar_data['foto'] ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?php
                    $sql_posting_st = "SELECT * FROM posting";
                    $posting_st = $conn->query($sql_posting_st);
                    $jml_posting = $posting_st->num_rows;

                    $sql_komentar_st = "SELECT * FROM komentar";
                    $komentar_st = $conn->query($sql_komentar_st);
                    $jml_komentar = $komentar_st->num_rows;

                    $sql_user_st = "SELECT * FROM user";
                    $user_st = $conn->query($sql_user_st);
                    $jml_user = $user_st->num_rows;
                ?>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Postingan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_posting; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Komentar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_komentar; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comment fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            User</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jml_user ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow">

                            <div class="card-body">