<!-- Modal untuk edit data user -->
<div class="modal fade" id="editshow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data <?= $halaman ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="edit">

        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // ini adalah fungsi untuk mengambil data user dan di  incluce ke dalam datatable
      var databarang = $('#databarang').DataTable({
        "processing": true,
        "ajax": "<?= base_url("index.php/barang/databarang") ?>",
        stateSave: true,
        "order": []
      })

      // ini adalah fungsi untuk mengambil data user dan di  incluce ke dalam datatable
      var databarangmasuk = $('#databarangmasuk').DataTable({
        "processing": true,
        "ajax": "<?= base_url("index.php/barangmasuk/databarangmasuk") ?>",
        stateSave: true,
        "order": []
      })

      var databarangkeluar = $('#databarangkeluar').DataTable({
        "processing": true,
        "ajax": "<?= base_url("index.php/barangkeluar/databarangkeluar") ?>",
        stateSave: true,
        "order": []
      })

      var dataopname = $('#dataopname').DataTable({
        "processing": true,
        "ajax": "<?= base_url("index.php/opname/dataopname") ?>",
        stateSave: true,
        "order": []
      })

      // tambah opname

      // tambah barang
      $('#formtambahdataopname').submit(function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/opname/tambahopname') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: formdata, // ambil datanya dari form yang ada di variabel
          processData: false,
          contentType: false,
          dataType: "JSON",
          success: function(data) {
            swal({
              type: 'success',
              title: 'Stok Opname',
              text: 'Anda Berhasil Menambahkan Stok Opname',
              showConfirmButton: true,
              timer: 1500
            });
            $('#tambahdataopnameshow').modal('hide');

            $('#dataopname').DataTable().ajax.reload();
            window.location.replace('stok_opname');
          },
          error: function() {
            swal.fire("Gagal Menyimpan", "Ada Kesalahan Menginputkan Data Stok Opname!", "error");
          }


        })
        return false;
      });

      $('#dataopname').on('click', '.ubah-opname', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/opname/editopname') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formeditopname').submit(function(e) {
              e.preventDefault();
              var formdata = new FormData(this);

              $.ajax({
                url: "<?= base_url('index.php/opname/ubahopname') ?>",
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
                  dataopname.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Update Stok opname',
                    text: 'Anda Berhasil Mengubah Data Stok Opname'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                },
                error: function(data) {
                  swal.fire("Gagal Menyimpan", "Stok Opname Terjadi Kesalahan Input Data", "error");
                }

              })
              return false;
            });
          }
        });
      });



      // tambah barang keluar

      // tambah barang
      $('#formtambahdatabarangkeluar').submit(function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barangkeluar/tambahbarangkeluar') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: formdata, // ambil datanya dari form yang ada di variabel
          processData: false,
          contentType: false,
          dataType: "JSON",
          success: function(data) {
            swal({
              type: 'success',
              title: 'Barang Keluar',
              text: 'Anda Berhasil Menambahkan Barang Terjual / Keluar',
              showConfirmButton: true,
              timer: 1500
            });
            $('#tambahdatabarangkeluarshow').modal('hide');

            $('#databarangkeluar').DataTable().ajax.reload();
            window.location.replace('barang_keluar');
          },
          error: function() {
            swal.fire("Gagal Menyimpan", "Stok Barang Kurang Mohon Untuk Menambahkan Stok Barang!", "error");
          }


        })
        return false;
      });

      $('#databarangkeluar').on('click', '.ubah-barangkeluar', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barangkeluar/editbarangkeluar') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formteditbarangkeluar').submit(function(e) {
              e.preventDefault();
              var formdata = new FormData(this);

              $.ajax({
                url: "<?= base_url('index.php/barangkeluar/ubahbarangkeluar') ?>",
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
                  databarangkeluar.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Update Barang Keluar',
                    text: 'Anda Berhasil Mengubah Data Barang keluar'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                },
                error: function(data) {
                  swal.fire("Gagal Menyimpan", "Stok Barang Kurang Mohon Untuk Menambahkan Stok Barang!", "error");
                }

              })
              return false;
            });
          }
        });
      });

      // hapus barang keluar

      $('#databarangkeluar').on('click', '.hapus-barangkeluar', function() {
        var id = $(this).data('id');
        swal({
          title: 'Konfirmasi',
          text: "Anda ingin menghapus ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('index.php/barangkeluar/hapusbarangkeluar') ?>",
              method: "post",
              beforeSend: function() {
                swal({
                  title: 'Menunggu',
                  html: 'Memproses data',
                  onOpen: () => {
                    swal.showLoading()
                  }
                })
              },
              data: {
                id: id
              },
              success: function(data) {
                swal(
                  'Hapus',
                  'Berhasil Terhapus',
                  'success'
                )
                databarangkeluar.ajax.reload(null, false)
              }
            })
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        })
      });

      // tambah barang masuk

      $('#databarangmasuk').on('click', '.tambah-stok', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barangmasuk/tambahstok') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formtambahstok').on('submit', function() {
              var id = $('#id_barangmasukedit').val(); // diambil dari id nama yang ada diform modal
              var stok = $('#stokedit').val();

              $.ajax({
                type: "post",
                url: "<?= base_url('index.php/barangmasuk/tambahstokbarang') ?>",
                beforeSend: function() {
                  swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })
                },
                data: {
                  stok: stok,
                  id: id
                }, // ambil datanya dari form yang ada di variabel

                success: function(data) {
                  databarangmasuk.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Tambah Stok',
                    text: 'Anda Berhasil Menambahkan Stok'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                }
              })
              return false;
            });
          }
        });
      });

      // ubah stok barang masuk

      $('#databarangmasuk').on('click', '.ubah-stokbarang', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barangmasuk/editbarangmasuk') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formeditbarangmasuk').on('submit', function() {
              var id = $('#id_barangmasukedit').val(); // diambil dari id nama yang ada diform modal
              var stok = $('#stokedit').val();

              $.ajax({
                type: "post",
                url: "<?= base_url('index.php/barangmasuk/ubahbarangmasuk') ?>",
                beforeSend: function() {
                  swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })
                },
                data: {
                  stok: stok,
                  id: id
                }, // ambil datanya dari form yang ada di variabel

                success: function(data) {
                  databarangmasuk.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Anda Berhasil Mengubah Stok'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                }
              })
              return false;
            });
          }
        });
      });

      // kurangi stok

      $('#databarangmasuk').on('click', '.kurangi-stok', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barangmasuk/kurangistok') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formkurangistok').on('submit', function() {
              var id = $('#id_barangmasukedit').val(); // diambil dari id nama yang ada diform modal
              var stok = $('#stokedit').val();

              $.ajax({
                type: "post",
                url: "<?= base_url('index.php/barangmasuk/kurangistokbarang') ?>",
                beforeSend: function() {
                  swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })
                },
                data: {
                  stok: stok,
                  id: id
                }, // ambil datanya dari form yang ada di variabel

                success: function(data) {
                  databarangmasuk.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Kurangi Stok',
                    text: 'Anda Berhasil Mengurangi Stok'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                }
              })
              return false;
            });
          }
        });
      });

      // tambah barang
      $('#formtambahdatabarang').submit(function(e) {
        e.preventDefault();
        $("#btn-barang").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Saving").attr("disabled", true);
        var formdata = new FormData(this);
        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barang/tambahbarang') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: formdata, // ambil datanya dari form yang ada di variabel
          processData: false,
          contentType: false,
          dataType: "JSON",
          success: function(data) {
            swal({
              type: 'success',
              title: 'Tambah Barang',
              text: 'Anda Berhasil Menambahkan Barang',
              showConfirmButton: true,
              timer: 1500
            });
            $('#tambahdatabarangshow').modal('hide');

            $('#databarang').DataTable().ajax.reload();
            window.location.replace('barang');
          },
          error: function() {
            swal.fire("Gagal Menyimpan", "Ada Kesalahan Saat Menyimpan!", "error");
          }


        })
        return false;
      });


      // fungsi untuk edit data
      //pilih selector dari table id datauser dengan class .ubah-user
      $('#databarang').on('click', '.ubah-barang', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/barang/editbarang') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formteditbarang').submit(function(e) {
              e.preventDefault();
              $("#btn-barang").html("<span class='fas fa-spinner fa-pulse' aria-hidden='true' title=''></span> Saving").attr("disabled", true);
              var formdata = new FormData(this);

              $.ajax({
                url: "<?= base_url('index.php/barang/ubahbarang') ?>",
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
                  databarang.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Update Barang',
                    text: 'Anda Berhasil Mengubah Data Barang'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                },
                error: function(data) {
                  swal.fire("Gagal Menyimpan", "Stok Opname Terjadi Kesalahan Input Data", "error");
                }

              })
              return false;
            });
          }
        });
      });
      // fungsi untuk hapus data
      //pilih selector dari table id datauser dengan class .hapus-user
      $('#databarang').on('click', '.hapus-barang', function() {
        var id = $(this).data('id');
        swal({
          title: 'Konfirmasi',
          text: "Anda ingin menghapus ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('index.php/barang/hapusbarang') ?>",
              method: "post",
              beforeSend: function() {
                swal({
                  title: 'Menunggu',
                  html: 'Memproses data',
                  onOpen: () => {
                    swal.showLoading()
                  }
                })
              },
              data: {
                id: id
              },
              success: function(data) {
                swal(
                  'Hapus',
                  'Berhasil Terhapus',
                  'success'
                )
                databarang.ajax.reload(null, false)
              }
            })
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        })
      });

    });
  </script>

  <!-- data user -->

  <script>
    $(document).ready(function() {
      // ini adalah fungsi untuk mengambil data user dan di  incluce ke dalam datatable
      var datauser = $('#datauser').DataTable({
        "processing": true,
        "ajax": "<?= base_url("index.php/user/datauser") ?>",
        stateSave: true,
        "order": []
      })


      $('#formtambahdatauser').on('submit', function() {
        var nama = $('#namauser').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var roleuser = $('#role_user').val();

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/user/tambahuser') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            nama: nama,
            username: username,
            password: password,
            roleuser: roleuser
          }, // ambil datanya dari form yang ada di variabel

          dataType: "JSON",
          success: function(data) {
            swal({
              type: 'success',
              title: 'Tambah user',
              text: 'Anda Berhasil Menambahkan user',
              showConfirmButton: false,
              timer: 1500
            });
            $('#tambahusershow').modal('hide');

            $('#datauser').DataTable().ajax.reload();
            window.location.replace('index');
          },
          error: function() {
            swal.fire("Gagal Menyimpan", "Ada Kesalahan Saat Menyimpan!", "error");
          }


        })
        return false;
      });
      // fungsi untuk edit data
      //pilih selector dari table id datauser dengan class .ubah-user
      $('#datauser').on('click', '.ubah-user', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/user/edituser') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formubahdatauser').on('submit', function() {
              var namauser = $('#namauseredit').val(); // diambil dari id nama yang ada diform modal
              var username = $('#usernameedit').val();
              var roleuser = $('#role_useredit').val(); // diambil dari id alamat yanag ada di form modal 
              var id = $('#iduser').val(); //diambil dari id yang ada di form modal
              $.ajax({
                type: "post",
                url: "<?= base_url('index.php/user/ubahuser') ?>",
                beforeSend: function() {
                  swal({
                    title: 'Menunggu',
                    html: 'Memproses data',
                    onOpen: () => {
                      swal.showLoading()
                    }
                  })
                },
                data: {
                  namauser: namauser,
                  username: username,
                  roleuser: roleuser,
                  id: id
                }, // ambil datanya dari form yang ada di variabel

                success: function(data) {
                  datauser.ajax.reload(null, false);
                  swal({
                    type: 'success',
                    title: 'Update User',
                    text: 'Anda Berhasil Mengubah Data User'
                  })
                  // bersihkan form pada modal
                  $('#editshow').modal('hide');
                }
              })
              return false;
            });
          }
        });
      });

      $('#datauser').on('click', '.password-user', function() {
        // ambil element id pada saat klik ubah
        var id = $(this).data('id');

        $.ajax({
          type: "post",
          url: "<?= base_url('index.php/user/ubahpassword') ?>",
          beforeSend: function() {
            swal({
              title: 'Menunggu',
              html: 'Memproses data',
              onOpen: () => {
                swal.showLoading()
              }
            })
          },
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#editshow').modal('show');
            $('#edit').html(data);

            // proses untuk mengubah data
            $('#formubahpassword').submit(function(e) {
              e.preventDefault();
              var formdata = new FormData(this);

              $.ajax({
                url: "<?= base_url('index.php/user/prosesubahpassword') ?>",
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
                    $('#editshow').modal('hide');
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
          }
        });
      });

      // fungsi untuk hapus data
      //pilih selector dari table id datauser dengan class .hapus-user
      $('#datauser').on('click', '.hapus-user', function() {
        var id = $(this).data('id');
        swal({
          title: 'Konfirmasi',
          text: "Anda ingin menghapus ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('index.php/user/hapususer') ?>",
              method: "post",
              beforeSend: function() {
                swal({
                  title: 'Menunggu',
                  html: 'Memproses data',
                  onOpen: () => {
                    swal.showLoading()
                  }
                })
              },
              data: {
                id: id
              },
              success: function(data) {
                swal(
                  'Hapus',
                  'Berhasil Terhapus',
                  'success'
                )
                datauser.ajax.reload(null, false)
              }
            })
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        })
      });

      $('#dataopname').on('click', '.hapus-opname', function() {
        var id = $(this).data('id');
        swal({
          title: 'Konfirmasi',
          text: "Anda ingin menghapus ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('index.php/opname/hapusopname') ?>",
              method: "post",
              beforeSend: function() {
                swal({
                  title: 'Menunggu',
                  html: 'Memproses data',
                  onOpen: () => {
                    swal.showLoading()
                  }
                })
              },
              data: {
                id: id
              },
              success: function(data) {
                swal(
                  'Hapus',
                  'Berhasil Terhapus',
                  'success'
                )
                $('#dataopname').DataTable().ajax.reload();
              }
            })
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        })
      });


      $('#databarangmasuk').on('click', '.hapus-barangmasuk', function() {
        var id = $(this).data('id');
        swal({
          title: 'Konfirmasi',
          text: "Anda ingin menghapus ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          cancelButtonText: 'Tidak',
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?= base_url('index.php/barangmasuk/hapusbarangmasuk') ?>",
              method: "post",
              beforeSend: function() {
                swal({
                  title: 'Menunggu',
                  html: 'Memproses data',
                  onOpen: () => {
                    swal.showLoading()
                  }
                })
              },
              data: {
                id: id
              },
              success: function(data) {
                swal(
                  'Hapus',
                  'Berhasil Terhapus',
                  'success'
                )
                $('#databarangmasuk').DataTable().ajax.reload();
              }
            })
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal(
              'Batal',
              'Anda membatalkan penghapusan',
              'error'
            )
          }
        })
      });


    });
  </script>