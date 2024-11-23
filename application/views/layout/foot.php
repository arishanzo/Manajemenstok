  <!-- Footer -->

  </div>


  <footer class="sticky-footer bg-white mt-5">
      <div class="container my-auto">
          <div class="copyright text-center my-auto">
              <span> Copyright &copy; CV CARAKA ABADI <?= date('Y') ?> <BR>Support By @ <a href="https://www.instagram.com/aris.wahyudi86">Aris WIT</a>
              </span>
          </div>
      </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Apa Anda Yakin Ingin Keluar ?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">Silahkan pilih tombol keluar apabila ingin mengakhiri session ini</div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="<?= base_url() ?>index.php/auth/logout">Logout</a>
              </div>
          </div>
      </div>
  </div>

  <script type="text/javascript">
      window.onload = function() {
          jam();
      }

      function jam() {
          var e = document.getElementById('jam'),
              d = new Date(),
              h, m, s;
          h = d.getHours();
          m = set(d.getMinutes());
          s = set(d.getSeconds());

          e.innerHTML = h + ':' + m + ':' + s;

          setTimeout('jam()', 1000);
      }

      function set(e) {
          e = e < 10 ? '0' + e : e;
          return e;
      }
  </script>

  <script>
      $(document).ready(function() {
          // ini adalah fungsi untuk mengambil data user dan di  incluce ke dalam datatable
          var omset = $('#omset').DataTable({
              "processing": true,
              "ajax": "<?= base_url("index.php/home/omset") ?>",
              stateSave: true,
              "order": []
          })
      });
  </script>

  </body>

  </html>