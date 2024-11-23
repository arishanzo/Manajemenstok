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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="databarangmasuk">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Gambar Barang</th>
                                        <th>Stok</th>
                                        <th>Tanggal Ubah</th>
                                        <?php

                                        $id = $_SESSION['id_user'];
                                        $db = $this->db->get_where('hakaksesuser', ['id_user' => $id]);
                                        $query = $db->row_array();

                                        if (!$query['cread'] == 1 or $query['update'] == 1 or $query['delete'] == 1) {

                                        ?>
                                            <th>Tambah / kurangi</th>
                                        <?php

                                        }
                                        ?>

                                        <?php

                                        $id = $_SESSION['id_user'];
                                        $db = $this->db->get_where('hakaksesuser', ['id_user' => $id]);
                                        $query = $db->row_array();

                                        if (!$query['cread'] == 1 or $query['update'] == 1 or $query['delete'] == 1) {
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