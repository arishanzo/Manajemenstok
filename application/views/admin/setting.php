<div class="row col-lg-12">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <div class="container py-5">
                    <!-- For demo purpose -->
                    <div class="row mb-4">
                        <div class="col-lg-8 mx-auto text-center">
                            <h1 class="display-6"><i class="fas fa-cogs"></i> Setting Aplikasi <br> <?= $datasetting['nama_aplikasi'] ?></h1>
                        </div>
                    </div> <!-- End -->
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="card ">
                                <div class="card-header">
                                    <div class="card-body shadow-sm pt-4 pl-2 pr-2 pb-2">
                                        <!-- Credit card form tabs -->

                                        <?php
                                        if ($_SESSION['lvl_user'] == 'admin') {
                                        ?>
                                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                                <li class="nav-item"> <a data-toggle="pill" href="#settingapps" class="nav-link active "> <i class="fas fa-cogs"></i> Setting Aplikasi </a> </li>
                                                <li class="nav-item"> <a data-toggle="pill" href="#settinguser" class="nav-link "> <i class="fas fa-users-cog"></i> Setting User </a> </li>
                                                <li class="nav-item"> <a data-toggle="pill" href="#device" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Informasi Perangkat </a> </li>
                                            </ul>
                                        <?php

                                        } else {

                                        ?>
                                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">

                                                <li class="nav-item"> <a data-toggle="pill" href="#settinguser" class="nav-link active"> <i class="fas fa-users-cog"></i> Setting User </a> </li>
                                                <li class="nav-item"> <a data-toggle="pill" href="#device" class="nav-link "> <i class="fas fa-mobile-alt mr-2"></i> Informasi Perangkat </a> </li>
                                            </ul>
                                        <?php

                                        }

                                        ?>

                                    </div> <!-- End -->
                                    <!-- Credit card form content -->
                                    <?php
                                    if ($_SESSION['lvl_user'] == 'admin') {
                                    ?>
                                        <div class="card mt-3 tab-content">
                                            <!-- credit card info-->

                                            <div id="settingapps" class="container tab-pane fade show active pt-3">
                                                <?= form_open_multipart('setting/ubahsetting', ['id' => 'formsetting']) ?>
                                                <input type="text" name="idsetting" hidden id="idsetting" value="<?= $datasetting['id_settingapps'] ?>">
                                                <div class=" form-group row">
                                                    <div class="col-sm-2">Logo Aplikasi</div>
                                                    <div class="col-sm-10">
                                                        </label> <input type="text" name="namaaplikasi" placeholder="Masukan Nama Aplikasi" value="<?= $datasetting['nama_aplikasi'] ?> " required class=" form-control "> </div>
                                                </div>


                                                <div class=" form-group row">
                                                    <div class="col-sm-2">Logo Aplikasi</div>
                                                    <div class="col-sm-10">
                                                        <dd class="col-sm-7"><?= '<img class="img-thumbnail" src="' . ($datasetting['logo_aplikasi'] == 'default.png' ? base_url('assets/img/setting/logo.jpg') : base_url('assets/img/setting/' . $datasetting['logo_aplikasi'])) . '" class="card-img" style="width: 100px;">'
                                                                                ?></dd>
                                                        <div class="custom-file">
                                                            <?= form_upload('logoaplikasi', '', ['class' => 'form-control cutom-file-input ', 'id' => 'logoaplikasi', 'name' => 'logoaplikasi', 'accept' => 'image/png, image/jpeg, image/jpg, image/gif']); ?>
                                                            <label for="logoaplikasi">Choose file. Max 2 MB</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-2">Logo Icon</div>
                                                    <div class="col-sm-10">
                                                        <dd class="col-sm-7"><?= '<img class="img-thumbnail" src="' . ($datasetting['logo_aplikasi'] == 'default.png' ? base_url('assets/img/setting/logo.jpg') : base_url('assets/img/setting/' . $datasetting['icon_aplikasi'])) . '" class="card-img" style="width: 100px;">'
                                                                                ?></dd>
                                                        <div class="custom-file">
                                                            <?= form_upload('iconaplikasi', '', ['class' => 'form-control cutom-file-input ', 'id' => 'iconaplikasi', 'name' => 'iconaplikasi', 'accept' => 'image/png, image/jpeg, image/jpg, image/gif']); ?>
                                                            <label for="iconaplikasi">Choose file. Max 2 MB</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="card-tittle  text-center"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Setting Aplikasi Di Ubah Pada Tanggal <?= date('d-F-Y', strtotime($datasetting['tgl_input'])) ?> </span>
                                                <div class="card-footer"> <button type="submit" id="btn-setting" class="btn btn-primary">Simpan Setting</button>
                                                    </form>
                                                </div>
                                            </div>


                                            <!-- End -->
                                            <!-- Paypal info -->
                                            <div id="settinguser" class="tab-pane fade pt-3">
                                                <div class="container col-lg-6">
                                                    <span>Setting user ini memberikan hak akses untuk user pada aplikasi</span>
                                                </div>
                                                <div class="card container col-lg-9">
                                                    <div class="table-responsive mt-3">
                                                        <table class="table table-striped" style="width: 500px;" id="hakaksesuser">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama User</th>
                                                                    <th>Jabatan</th>
                                                                    <th>Read</th>
                                                                    <th>Create</th>
                                                                    <th>Update</th>
                                                                    <th style="width: 500px;">Delete</th>
                                                                </tr>
                                                            </thead>


                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End -->
                                            <!-- bank transfer info -->
                                            <div id="device" class="tab-pane fade pt-3">
                                                <div class="card">
                                                    <div class="card-header">Perangkat Anda Saat Ini</div>
                                                    <div class="card-body">
                                                        <span class="<?= $icon_agent = ($this->agent->is_browser() ? 'fas fa-fw fa-laptop' : ($this->agent->is_mobile() ? 'fas fa-fw fa-mobile-alt' : 'fas fa-fw fa-desktop')) ?> fa-2x mr-1 float-left"></span>
                                                        <h5 class="card-title">
                                                            <?= $type_agent = ($this->agent->is_browser() ? $this->agent->browser() . ' ' . $this->agent->version() : ($this->agent->is_mobile() ? $this->agent->mobile() : 'Unknown')) ?></h5>
                                                        <br>
                                                        <p class="card-text"><?= $this->agent->agent_string(); ?></p>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                    } else {

                                        ?>
                                            <div class="card mt-3 tab-content">

                                                <div id="settinguser" class="container tab-pane fade show active pt-3">
                                                    <div class="form-group row">
                                                        <label for="namauser" class="col-sm-2 col-form-label">Nama User</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="namauser" id="namauseredit" value="<?= $datauser['nama_user'] ?>" readonly>
                                                            <input type="hidden" name="iduser" id="iduser" value="<?= $datauser['id_user'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="username" id="usernameedit" value="<?= $datauser['username'] ?>" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="role_user" class="col-sm-2 col-form-label">Jabatan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="roleuser" id="roleuser" value="<?= $datauser['lvl_user'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <h5>Ganti Password</h5>

                                                    <?= form_open('', ['id' => 'formubahpassword']) ?>
                                                    <input type="hidden" name="iduser" id="iduser" value="<?= $datauser['id_user'] ?>">

                                                    <div class="form-group row" id="show_hide_password">
                                                        <label for="pass_baru" class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" id="password" minlength="8" required name="password" placeholder="Masukan Password Baru">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" id="show_hide_password">
                                                        <label for="pass_baru_confirm" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" class="form-control" id="komfirmasipassword" minlength="8" required name="komfirmasipassword" placeholder="Konfirmasi Password Baru">
                                                        </div>
                                                    </div>



                                                    <div class="card-footer">
                                                        <button type="submit" id="btn-password" class="btn btn-primary">Ganti Password</button>
                                                    </div>
                                                    </form>

                                                </div>

                                                <!-- End -->
                                                <!-- bank transfer info -->
                                                <div id="device" class="tab-pane fade pt-3">
                                                    <div class="card">
                                                        <div class="card-header">Perangkat Anda Saat Ini</div>
                                                        <div class="card-body">
                                                            <span class="<?= $icon_agent = ($this->agent->is_browser() ? 'fas fa-fw fa-laptop' : ($this->agent->is_mobile() ? 'fas fa-fw fa-mobile-alt' : 'fas fa-fw fa-desktop')) ?> fa-2x mr-1 float-left"></span>
                                                            <h5 class="card-title">
                                                                <?= $type_agent = ($this->agent->is_browser() ? $this->agent->browser() . ' ' . $this->agent->version() : ($this->agent->is_mobile() ? $this->agent->mobile() : 'Unknown')) ?></h5>
                                                            <br>
                                                            <p class="card-text"><?= $this->agent->agent_string(); ?></p>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php

                                        }

                                            ?>
                                            <!-- End -->
                                            <!-- End -->
                                            </div>
                                        </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>