<?php
if ($type == 'User') {
?>
  <form id="formubahdatauser" method="post">
    <div class="form-group row">
      <label for="namauser" class="col-sm-2 col-form-label">Nama User</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="namauser" id="namauseredit" value="<?= $datauser['nama_user'] ?>">
        <input type="hidden" name="iduser" id="iduser" value="<?= $datauser['id_user'] ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="username" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="username" id="usernameedit" value="<?= $datauser['username'] ?>">
      </div>
    </div>

    <div class="form-group row">
      <label for="role_user" class="col-sm-4 col-form-label">Role Akun</label>
      <div class="col-sm-8">
        <?= form_dropdown('role_user', [$datauser['lvl_user'] => $datauser['lvl_user'], 'Admin' => 'Admin', 'Owner' => 'Owner', 'Manajemen Produk' => 'Manajemen Produk'], set_value('role_user', $datauser['lvl_user']), 'class="form-control" id="role_useredit"'); ?>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Ubah Data user</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
    </div>
  </form>



<?php

} else if ($type == 'barang') {
?>
  <?= form_open_multipart('barang/ubahbarang', ['id' => 'formteditbarang']) ?>
  <div class="form-group row">
    <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="namabarangedit" id="namabarangedit" value="<?= $databarang['nama_barang'] ?>" placeholder="Masukan Nama Barang" required autofocus>
      <input type="hidden" name="id_barangedit" id="id_barangedit" value="<?= $databarang['id_barang'] ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="namabarang" class="col-sm-2 col-form-label">Jenis Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="jenisbarangedit" id="jenisbarangedit" value="<?= $databarang['jenis_barang'] ?>" placeholder="Masukan Jenis Barang" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="umur_pegawai" class="col-sm-2 col-form-label">No Sertifikat</label>
    <div class="col-sm-10">
      <div class="input-group">
        <input type="text" class="form-control" name="nosertifikatedit" id="nosertifikatedit" value="<?= $databarang['no_sertifikat'] ?>" placeholder="Masukan No Sertifkat" name="nosertifikat" required>
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
        <input type="number" class="form-control" id="hargapokokbarangedit" name="hargapokokbarangedit" value="<?= $databarang['harga_barang'] ?>" required>
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
        <input type="number" class="form-control" id="hargajualbarangedit" name="hargjualbarangedit" value="<?= $databarang['harga_pokokbarang'] ?>" required>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-2">Gambar Barang</div>
    <div class="col-sm-10">
      <dd class="col-sm-7"><?= '<img class="img-thumbnail" src="' . ($databarang['gambar_barang'] == 'default.png' ? base_url('assets/img/gambarbarang/default-profile.png') : base_url('assets/img/gambarbarang/' . $databarang['gambar_barang'])) . '" class="card-img" style="width: 100%;">'
                            ?></dd>
      <div class="custom-file">
        <?= form_upload('gambarbarangedit', '', ['class' => 'form-control cutom-file-input ', 'id' => 'gambarbarangedit', 'name' => 'gambarbarangedit', 'accept' => 'image/png, image/jpeg, image/jpg, image/gif']); ?>
        <label for="gambarbarang">Choose file. Max 2 MB</label>
      </div>
    </div>
  </div>


  <div class="my-2" id="info-data"></div>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="submit" id="btn-barang" class="btn btn-primary">Update Data Barang</button>
  </div>
  </form>



<?php

} else if ($type == 'barangmasuk') {
?> <?= form_open_multipart('', ['id' => 'formeditbarangmasuk']) ?>

  <div class="form-group row">
    <label for="namabarang" class="col-sm-2 col-form-label">Jumlah Stok</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="stok" id="stok" value="<?= $databarangmasuk['jumlah_stok'] ?>" readonly required>
      <input type="hidden" name="id_barangmasukedit" id="id_barangmasukedit" value="<?= $databarangmasuk['id_stokbarangmasuk'] ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="namabarang" class="col-sm-2 col-form-label">Stok Barang</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="stokedit" id="stokedit" placeholder="Masukan Stok Barang" required>
    </div>
  </div>


  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="submit" id="btn-barangmasuk" class="btn btn-primary">Ubah Stok</button>
  </div>
  </form>




<?php

} else if ($type == 'barang_keluar') {

?>
  <?= form_open_multipart('barangkeluar/ubahbarangkeluar', ['id' => 'formteditbarangkeluar']) ?>
  <input type="hidden" name="ideditbarangkeluar" id="ideditbarangkeluar" value="<?= $databarangkeluar['id_stokbarangkeluar'] ?>">
  <div class="section-title mt-0">Nama Barang </div>
  <div class="input-group mb-2">
    <select class="selectpicker form-control" id="namabarangedit" name="namabarangedit" data-live-search="true" required>
      <option value="<?= $databarangkeluar['id_barang'] ?>" disabled><?= $databarangkeluar['nama_barang'] ?></option>
      <?php

      foreach ($databarang as $row) {
      ?>
        <option value="<?= $row['id_barang'] ?>"><?= trim($row['nama_barang']) ?></option>

      <?php


      }

      ?>
    </select>

  </div>

  <div class="section-title mt-0">Jumlah Barang Keluar / Terjual </div>
  <div class="input-group mb-2">
    <input type="number" class="form-control" name="terjualedit" id="terjualedit" value="<?= $databarangkeluar['stok_keluar'] ?>" placeholder="Masukan Barang Yang Terjual" required>
  </div>

  <div class="section-title mt-0">Tanggal Terjual </div>
  <div class="input-group mb-2">
    <input type="date" class="form-control" name="tanggaledit" id="tanggaledit" value="<?= $databarangkeluar['tgl_keluar'] ?>" required>
  </div>



  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="submit" id="btn-barang" class="btn btn-primary">Update Data Barang Keluar</button>
  </div>
  </form>
<?php

} else if ($type == 'ubahpassword') {

?>

  <?= form_open_multipart('', ['id' => 'formubahpassword']) ?>
  <input type="hidden" name="iduser" id="iduser" value="<?= $datauser['id_user'] ?>">

  <div class="form-group row" id="show_hide_password">
    <label for="pass_baru" class="col-sm-4 col-form-label">Password</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="password" minlength="8" required name="password" placeholder="Masukan Password Baru">
    </div>
  </div>
  <div class="form-group row" id="show_hide_password">
    <label for="pass_baru_confirm" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="komfirmasipassword" minlength="8" required name="komfirmasipassword" placeholder="Konfirmasi Password Baru">
    </div>
  </div>


  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="submit" id="btn-password" class="btn btn-primary">Ganti Password</button>
  </div>
  </form>

<?php

} else if ($type == 'stokopname') {
?>

  <?= form_open_multipart('opname/ubahopname', ['id' => 'formeditopname']) ?>
  <input type="hidden" name="ideditstokopname" id="ideditstokopname" value="<?= $dataopname['id_stokopname'] ?>">
  <div class="section-title mt-0">Nama Barang </div>
  <div class="input-group mb-2">
    <select class="selectpicker form-control" id="namabarangopnameedit" name="namabarangopnameedit" data-live-search="true" required>
      <option value="<?= $dataopname['id_barang'] ?>" disabled><?= $dataopname['nama_barang'] ?></option>
      <?php

      foreach ($databarang as $row) {
      ?>
        <option value="<?= $row['id_barang'] ?>"><?= trim($row['nama_barang']) ?></option>

      <?php


      }

      ?>
    </select>

  </div>

  <div class="section-title mt-0">Stok Opname </div>
  <div class="input-group mb-2">
    <input type="text" class="form-control" name="stokopnameedit" id="stokopnameedit" value="<?= $dataopname['stokopname'] ?>" placeholder="Masukan Barang Yang Terjual" required>
  </div>

  <div class="section-title mt-0">Tanggal Terjual </div>
  <div class="input-group mb-2">
    <input type="date" class="form-control" name="tanggalopnameedit" id="tanggalopnameedit" value="<?= $dataopname['tgl_input'] ?>" required>
  </div>



  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
    <button type="submit" id="btn-barang" class="btn btn-primary">Update Data Barang Keluar</button>
  </div>
  </form>

<?php
}

?>