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

                            <?php

                            $id = $_SESSION['id_user'];
                            $db = $this->db->get_where('hakaksesuser', ['id_user' => $id]);
                            $query = $db->row_array();

                            if ($query['cread'] == 1) {
                            ?>


                                <button type="button" class="btn btn-primary mb-4 float-right" data-toggle="modal" data-target="#tambahdatabarangshow">Tambah Data</button>
                            <?php

                            }
                            ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="databarang">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Gambar Barang</th>
                                        <th>Harga Jual Barang</th>
                                        <th>No Sertifikat</th>
                                        <th>Harga Pokok</th>
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


<!-- Modal untuk tambah data user -->
<div class="modal fade" id="tambahdatabarangshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data <?= $halaman ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('barang/tambahbarang', ['id' => 'formtambahdatabarang']) ?>
                <div class="form-group row">
                    <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="namabarang" id="namabarang" placeholder="Masukan Nama Barang" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="namabarang" class="col-sm-2 col-form-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="jenisbarang" id="jenisbarang" placeholder="Masukan Jenis Barang" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="umur_pegawai" class="col-sm-2 col-form-label">No Sertifikat</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nosertifikat" id="nosertifikat" placeholder="Masukan No Sertifkat" name="nosertifikat" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="umur_pegawai" class="col-sm-2 col-form-label">Harga Pokok Barang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">RP</div>
                            </div>
                            <input type="number" class="form-control" id="hargapokokbarang" name="hargapokokbarang" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="umur_pegawai" class="col-sm-2 col-form-label">Harga Jual Barang</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">RP</div>
                            </div>
                            <input type="number" class="form-control" id="hargajualbarang" name="hargjualbarang" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">Gambar Barang</div>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <?= form_upload('gambarbarang', '', ['class' => 'form-control cutom-file-input ', 'id' => 'gambarbarang', 'name' => 'gambarbarang', 'accept' => 'image/png, image/jpeg, image/jpg, image/gif']); ?>
                            <label for="gambarbarang">Choose file. Max 2 MB</label>
                        </div>
                    </div>
                </div>


                <div class="my-2" id="info-data"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" id="btn-barang" class="btn btn-primary">Tambah Data Barang</button>
            </div>
            </form>
        </div>

    </div>