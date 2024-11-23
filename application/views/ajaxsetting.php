<script>
    $(document).ready(function() {

        $('#hakaksesuser').on('click', '.read-checked', function() {
            if ($(this).prop("checked") == true) {
                var type = 'read';
                var check = [];
                var id = $(this).data('id');
                check.push($(this).val());
                check = check.toString()
                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakaksescheckced') ?>",
                    method: "POST",
                    data: {
                        check: check,
                        type: type,
                        id: id
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }

                });

            } else if ($(this).prop("checked") == false) {
                var id = $(this).data('id');
                var type = 'read';
                var check = [];
                check.push($(this).val());
                check = check.toString()

                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakakses') ?>",
                    method: "POST",
                    data: {
                        check2: check,
                        id: id,
                        type: type
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }


                });
            }
        });

        $('#hakaksesuser').on('click', '.cread-checked', function() {
            if ($(this).prop("checked") == true) {
                var type = 'cread';
                var check = [];
                var id = $(this).data('id');
                check.push($(this).val());
                check = check.toString()
                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakaksescheckced') ?>",
                    method: "POST",
                    data: {
                        check: check,
                        type: type,
                        id: id
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }

                });

            } else if ($(this).prop("checked") == false) {
                var id = $(this).data('id');
                var type = 'cread';
                var check = [];
                check.push($(this).val());
                check = check.toString()

                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakakses') ?>",
                    method: "POST",
                    data: {
                        check2: check,
                        id: id,
                        type: type
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }


                });
            }
        });

        $('#hakaksesuser').on('click', '.update-checked', function() {
            if ($(this).prop("checked") == true) {
                var type = 'update';
                var check = [];
                var id = $(this).data('id');
                check.push($(this).val());
                check = check.toString()
                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakaksescheckced') ?>",
                    method: "POST",
                    data: {
                        check: check,
                        type: type,
                        id: id
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }

                });

            } else if ($(this).prop("checked") == false) {
                var id = $(this).data('id');
                var type = 'update';
                var check = [];
                check.push($(this).val());
                check = check.toString()

                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakakses') ?>",
                    method: "POST",
                    data: {
                        check2: check,
                        id: id,
                        type: type
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }


                });
            }
        });

        $('#hakaksesuser').on('click', '.delete-checked', function() {
            if ($(this).prop("checked") == true) {
                var type = 'delete';
                var check = [];
                var id = $(this).data('id');
                check.push($(this).val());
                check = check.toString()
                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakaksescheckced') ?>",
                    method: "POST",
                    data: {
                        check: check,
                        type: type,
                        id: id
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }

                });

            } else if ($(this).prop("checked") == false) {
                var id = $(this).data('id');
                var type = 'delete';
                var check = [];
                check.push($(this).val());
                check = check.toString()

                $.ajax({
                    url: "<?= base_url('index.php/setting/ubahhakakses') ?>",
                    method: "POST",
                    data: {
                        check2: check,
                        id: id,
                        type: type
                    },
                    beforeSend: function() {
                        swal({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {

                        swal({
                            type: 'success',
                            title: 'Berhasil Di Ubah',
                            timer: 5500
                        })
                        $('#hakaksesuser').DataTable().ajax.reload();
                    },
                    error: function(data) {
                        swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                        $('#hakaksesuser').DataTable().ajax.reload();
                    }


                });
            }
        });



        var hakaksesuser = $('#hakaksesuser').DataTable({
            "processing": true,
            "ajax": "<?= base_url("index.php/setting/hakaksesuser") ?>",
            stateSave: true,
            "order": []
        })


        $('#formsetting').submit(function(e) {
            e.preventDefault();
            var formdata = new FormData(this);

            $.ajax({
                url: "<?= base_url('index.php/setting/ubahsetting') ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(data) {

                    swal({
                        type: 'success',
                        title: 'Ubah Setting',
                        text: 'Anda Berhasil Mengubah Setingg Aplikasi',
                        timer: 5500
                    })
                    location.reload();
                },
                error: function(data) {
                    swal.fire("Gagal Merubah Setting", "Pastikan Gambar Yang Di Upload Sesuai Keterangan", "error");
                    location.reload();
                }


            })
            return false;
        });

        // proses untuk mengubah data
        $('#formubahpassword').submit(function(e) {
            e.preventDefault();
            var formdata = new FormData(this);

            $.ajax({
                url: "<?= base_url('index.php/setting/prosesubahpassword') ?>",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function() {
                    swal({
                        title: 'Menunggu',
                        html: 'Memproses data',
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },

                success: function(response) {
                    if (response.success == true) {

                        swal({
                            type: 'success',
                            title: 'Ubah Password',
                            text: 'Anda Berhasil Mengubah Password'
                        });
                        form.reset();
                        // bersihkan form pada modal

                    } else {
                        swal.close()
                        swal({
                            icon: 'error',
                            title: 'Ubah Password Gagal',
                            text: 'Password anda gagal diubah!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $.each(response.messages, function(key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .find('.text-danger')
                                .remove();
                            if (element.parent('.input-group').length) {
                                element.parent().after(value);
                            } else {
                                element.after(value);
                            }
                        });
                    }

                },
                error: function() {
                    swal.fire("Gagal", "Password Tidak Sama!", "error");
                }
            })
            return false;
        });

    });
</script>