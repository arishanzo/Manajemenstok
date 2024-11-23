<?php
if ($type == 'tambahstok') {
?> <?= form_open_multipart('barangmasuk/tambahstokbarang', ['id' => 'formtambahstok']) ?>

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
        <button type="submit" id="btn-tambahstok" class="btn btn-primary">Tambah Stok</button>
    </div>
    </form>




<?php

} else if ($type == 'kurangistok') {
?> <?= form_open_multipart('barangmasuk/kurangistokbarang', ['id' => 'formkurangistok']) ?>

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
        <button type="submit" id="btn-tambahstok" class="btn btn-primary">Kurangi Stok</button>
    </div>
    </form>




<?php

}

?>