<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halaman Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="container-fluid">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <h5>Total Omset Anda Hari Ini Sebesar</h5>
                            <h2 class="text-success"><?= 'Rp.' . number_format($omset['sum'], 2, ",", "."); ?></h2>
                        </div>
                        <div class="col-lg-3">
                            <h5>Total Laba Anda Hari Ini Sebesar</h5>
                            <h2 class="text-success"><?= 'Rp.' . number_format($laba, 2, ",", "."); ?></h2>
                        </div>
                        <div class="col-lg-3">
                            <h5>Presentase Penjualan Hari Ini</h5>
                            <?php
                            if ($presentase < 29) {
                            ?>
                                <h2 class="text-danger"><?= round($presentase, 2) ?> %</h2>

                            <?php

                            } else  if ($presentase < 59) {
                            ?>
                                <h2 class="text-warning"><?= round($presentase, 2) ?> %</h2>

                            <?php

                            } else {
                            ?>
                                <h2 class="text-success"><?= round($presentase, 2) ?> %</h2>

                            <?php

                            }

                            ?>
                        </div>

                        <div class="col-lg-3">
                            <h5 class="text-right text-success"><?= $jam ?></h5>

                            <h5 class="text-right text-success"><?= date('d-F-Y') ?></h5>
                            <b>
                                <h2 class=" text-right" id="jam" style="font-size:24"></h2>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Semua Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $totalbarang ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Barang Terjual Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalbarangkeluar['sum'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Barang Masuk
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totalbarangmasuk['sum'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dolly-flatbed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Terakhir Anda Online</div>
                            <div class="h5 mb-0 font-weight-bold text-success-800">


                                <?php
                                echo   $terakhirlogin = date("d-M-Y H:i:s",  strtotime($logaktivitas['jam']));



                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <span>
                Keterangan:<br>
                - Apabila pesentase barang < 29 %=<span class='badge badge-danger'>Barang Tidak Laku</span><br>
            - Apabila presentase barang < 59 %=<span class='badge badge-warning'>barang Lumayan Laku </span><br>
                - Apabila presentase barang > 59 %=<span class='badge badge-success'>barang Terlaris </span></span><br>
                <div class="card-header mt-3">
                    <b><span class="mb-4">Informasi Setiap Penjualan</span></b>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped mb-0 mt-3 admin" id="omset">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Stok Terjual</th>
                                <th>Tanggal</th>
                                <th>Laba Bersih</th>
                                <th>Presentase</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>


                        <tbody align="center">
                        </tbody>
                    </table>
                </div>
        </div>
    </div>






    <br>
</div>