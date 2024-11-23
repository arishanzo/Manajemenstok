<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-gradient-dark">
                <h4 class="text-white">Data <?= $halaman ?></h4>
            </div>
            <div class="card-body">
                <div class="card-header py-3">
                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">


                            <button type="button" class="btn btn-primary mb-4 float-right" data-toggle="modal" data-target="#tambahdatabarangkeluarshow">Tambah Data Terjual</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="databarangkeluar">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Terjual</th>
                                        <th>Harga Terjual</th>
                                        <th>Tanggal Terjual</th>
                                        <th>Status</th>
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


                                <tbody align="center">
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
<div class="modal fade" id="tambahdatabarangkeluarshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data <?= $halaman ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <?= form_open_multipart('barangkeluar/tambahbarangkeluar', ['id' => 'formtambahdatabarangkeluar']) ?>
                <div class="section-title mt-0">Nama Barang </div>
                <div class="input-group mb-2">
                    <select class="selectpicker form-control" id="namabarang" name="namabarang" data-live-search="true" required>
                        <?php

                        foreach ($databarang as $value) {
                        ?>
                            <option value="<?= $value['id_barang'] ?>"><?= $value['nama_barang'] ?></option>

                        <?php


                        }

                        ?>
                    </select>

                </div>

                <div class="section-title mt-0">Jumlah Barang Keluar / Terjual </div>
                <div class="input-group mb-2">
                    <input type="number" class="form-control" name="terjual" id="terjual" placeholder="Masukan Barang Yang Terjual" required>
                </div>

                <div class="section-title mt-0">Tanggal Terjual </div>
                <div class="input-group mb-2">
                    <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btn-barang" class="btn btn-primary">Tambah Data Barang</button>
            </div>
            </form>
        </div>

    </div>