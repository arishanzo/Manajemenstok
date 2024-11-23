<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-gradient-dark">
                <h4 class="text-white">Data <?= $halaman ?></h4>
            </div>
            <div class="card-body">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="container-fluid">

                            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                                <div class="row col-6">
                                    <button type="button" class="btn btn-dark  mb-4 float-left" data-toggle="modal" data-target="#pdfdataopnameshow"><i class="fas fa-download fa-sm text-white-50"></i> &nbsp; Print / Cetak</button>

                                </div>
                                <?php

                                $id = $_SESSION['id_user'];
                                $db = $this->db->get_where('hakaksesuser', ['id_user' => $id]);
                                $query = $db->row_array();

                                if ($query['cread'] == 1) {
                                ?>
                                    <div class=" col-lg-3">
                                        <button type="button" class="btn btn-primary mt-12 mb-4 float-right" data-toggle="modal" data-target="#tambahdataopnameshow">Tambah Data</button>
                                    </div>
                                <?php

                                }
                                ?>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 admin" id="dataopname">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Opname</th>
                                            <th>Tanggal Stok Opname</th>

                                            <?php

                                            $id = $_SESSION['id_user'];
                                            $db = $this->db->get_where('hakaksesuser', ['id_user' => $id]);
                                            $query = $db->row_array();

                                            if (!$query['read'] == 1 && $query['cread'] == 1 or $query['update'] == 1 or $query['delete'] == 1) {
                                            ?>
                                                <th>Aksi</th>
                                            <?php

                                            }
                                            ?>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<!-- Modal untuk tambah data user -->
<div class="modal fade" id="tambahdataopnameshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data <?= $halaman ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <?= form_open_multipart('opname/tambahopname', ['id' => 'formtambahdataopname']) ?>
                <div class="section-title mt-0">Nama Barang </div>
                <div class="input-group mb-2">
                    <select class="selectpicker form-control" id="namabarangopname" name="namabarangopname" data-live-search="true" required>
                        <?php

                        foreach ($databarang as $value) {
                        ?>
                            <option value="<?= $value['id_barang'] ?>"><?= $value['nama_barang'] ?></option>

                        <?php


                        }

                        ?>
                    </select>

                </div>

                <div class="section-title mt-0">Stok Opname </div>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="stokopname" id="stokopname" placeholder="Contoh Penulisan Angka yang benar 2.5 bukan 2,5" required>
                </div>

                <div class="section-title mt-0">Tanggal Terjual </div>
                <div class="input-group mb-2">
                    <input type="date" class="form-control" name="tanggalopname" id="tanggalopname" required>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btn-opname" class="btn btn-primary">Tambah Stok Opname</button>
            </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal untuk tambah data user -->
<div class="modal fade" id="pdfdataopnameshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PRINT PDF <?= $halaman ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card-header">
                    <div class="card-body shadow-sm pt-4 pl-2 pr-2 pb-2">



                        <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                            <li class="nav-item"> <a data-toggle="pill" href="#pdf" class="nav-link active "> <i class="fas fa-file-pdf"></i> PDF </a> </li>
                            <li class="nav-item"> <a data-toggle="pill" href="#excel" class="nav-link "> <i class="fas fa-file-excel"></i> EXCEL </a> </li>
                        </ul>

                    </div>
                    <div class="card mt-3 tab-content">
                        <!-- credit card info-->

                        <div id="pdf" class="container tab-pane fade show active pt-3">
                            <?= form_open_multipart('opname/printpdf', ['id' => 'formcetak']) ?>


                            <div class="widget-body mt-3">
                                <div class="form-group">
                                    <select class="custom-select" name="bulan">
                                        <option disabled selected>Pilih Bulan </option>
                                        <?php
                                        $bln = array(
                                            1 => "Januari", "Februari", "Maret", "April", "Mei",
                                            "Juni", "July", "Agustus", "September", "Oktober",
                                            "November", "Desember"
                                        );
                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                        ?>
                                            <option value="<?= $bulan ?>"><?= $bln[$bulan] ?></option>
                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="widget-body mt-3">
                                <div class="form-group">
                                    <select class="custom-select" name="tahun">
                                        <option disabled selected>Pilih Tahun </option>
                                        <?php
                                        $now = date("Y");
                                        for ($thn = 2010; $thn <= $now; $thn++) {
                                        ?>
                                            <option value="<?= $thn ?>"><?= $thn ?></option>
                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>

                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" id="btn-cetakpdf" class="btn btn-danger"><i class="fas fa-file-pdf"></i> &nbsp; Print PDF</button>
                            </div>
                            </form>
                        </div>

                        <div id="excel" class="tab-pane fade pt-3">
                            <?= form_open_multipart('opname/printexcel', ['id' => 'formcetak']) ?>


                            <div class="widget-body mt-3 container">
                                <div class="form-group">
                                    <select class="custom-select" name="bulan">
                                        <option disabled selected>Pilih Bulan </option>
                                        <?php
                                        $bln = array(
                                            1 => "Januari", "Februari", "Maret", "April", "Mei",
                                            "Juni", "July", "Agustus", "September", "Oktober",
                                            "November", "Desember"
                                        );
                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                        ?>
                                            <option value="<?= $bulan ?>"><?= $bln[$bulan] ?></option>
                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="widget-body mt-3 container">
                                <div class="form-group">
                                    <select class="custom-select" name="tahun">
                                        <option disabled selected>Pilih Tahun </option>
                                        <?php
                                        $now = date("Y");
                                        for ($thn = 2010; $thn <= $now; $thn++) {
                                        ?>
                                            <option value="<?= $thn ?>"><?= $thn ?></option>
                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="btn-cetakexcel" class="btn btn-success"><i class="fas fa-file-excel"></i> &nbsp; Print excel</button>
                                </div>
                                </form>


                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>