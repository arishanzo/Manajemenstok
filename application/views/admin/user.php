<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-gradient-dark">
                <h4 class="text-white">Data <?= $title ?></h4>
            </div>
            <div class="card-body">
                <div class="card-header py-3">
                    <div class="container-fluid">

                        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">

                            <button type="button" class="btn btn-primary mb-4 float-right" data-toggle="modal" data-target="#tambahusershow">Tambah Data</button>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 admin" id="datauser">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Level User / Jabatan</th>
                                        <th>Action</th>
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
<div class="modal fade" id="tambahusershow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formtambahdatauser">
                    <div class="form-group row">
                        <label for="inputnama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namauser" placeholder="Masukan Nama Anda" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_user" class="col-sm-4 col-form-label">Role Akun</label>
                        <div class="col-sm-8">
                            <?= form_dropdown('role_user', ['' => 'Pilih Jabatan', 'Admin' => 'Admin', 'Owner' => 'Owner', 'Manajemen Produk' => 'Manajemen Produk'], set_value('role_user', 'Pilih Jabatan'), 'class="form-control" id="role_user"'); ?>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah Data user</button>
            </div>
            </form>
        </div>

    </div>