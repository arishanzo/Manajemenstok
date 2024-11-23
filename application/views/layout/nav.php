<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center" href="index.html">
                <img class="img-thumbnail img-responsive" src=" <?= ($datasetting['logo_aplikasi'] == 'default.png' ? base_url('assets/img/setting/logo.jpg') : base_url('assets/img/setting/' . $datasetting['logo_aplikasi'])) ?>" style="width: 50px;">
                <span>CV CARAKA ABADI</span>

            </a>

            <!-- Divider -->


            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <?= (($_SESSION['lvl_user'] == 'admin') ? '<span>  Data User / Setting Apps</span>' : '<span>Setting User</span>');  ?>


            </div>
            <?php
            if ($_SESSION['lvl_user'] == 'admin') {
            ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('index.php/user/') ?>">
                        <i class="fas fa-users"></i>
                        <span>User</span></a>
                </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('setting') ?>">
                    <i class="fas fa-cogs"></i>
                    <?= (($_SESSION['lvl_user'] == 'admin') ? '<span>Setting Apps</span>' : '<span>Setting User</span>');  ?>
                </a>
            </li>
            <div class="sidebar-heading">
                Data Barang
            </div>


            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('barang') ?>"><i class="fas fa-dolly-flatbed"></i><span> Data Barang</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('barang_masuk') ?>"><i class="fas fa-dolly-flatbed"></i><span> Barang Masuk</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('barang_keluar') ?>"><i class="fas fa-truck"></i> <span> Barang Keluar</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('stok_opname') ?>"><i class="fas fa-boxes"></i><span> Stok_opname</span></a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt "></i>
                    Logout
                </a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-navy topbar mb-4 static-top shadow">
                    <a class="sidebar-brand d-flex align-items-center content-center" href="<?= base_url('dasboard') ?>">

                        <div class="sidebar-brand-text mx-3"><?= $datasetting['nama_aplikasi']  ?></div>
                    </a>
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small">Selamat Datang, <?= $_SESSION['lvl_user'] ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url() ?>/assets/img/fotouser/avatar-4.png">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>


                <!-- Bootstrap core JavaScript-->
                <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
                <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../datatable/js/datatables.min.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
                <script src="../sweetalert/sweetalert.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>
                <script src="<?= base_url() ?>/assets/vendor/dataTables.bootstrap4.min.js"> </script>
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

                <script src="<?= base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"> </script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>