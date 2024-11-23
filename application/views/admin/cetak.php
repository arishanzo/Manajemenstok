<?php

$namabulan = $getambilbulan;

require FCPATH  . '/assets/vendor/fpdf184/fpdf.php';

if ($type == 'pdf') {

    if (empty($tahun or empty($bulan))) {

?>
        <div class="container-fluid">

            <!-- 404 Error Text -->
            <div class="text-center">
                <div class="error mx-auto" data-text="404">404</div>
                <p class="lead text-gray-800 mb-0">Mohon Maaf Terjadi Kesalahan</p>
                <p class="text-gray-500 mb-5">Mohon Ulangi Proses Kembali, Kemungkinan Anda Belum Mimilih Apapun</p>

                <p class="text-gray-500 mb-0">Silahkan Kembali, Dan Ulangi Prosesnya Kembali</p>
                <a href="index.php">&larr; Kembali Ke Menu Sebelumya</a>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

    <?php
    } else {


        $pdf = new FPDF('L', 'mm', 'A4');

        $pdf->AddPage();

        $date = date('d-m-Y');

        //set font jadi arial, bold, 14pt
        $pdf->SetFont('Arial', 'B', 14);


        $pdf->Cell(280, 5, 'Laporan Stok Opname  ', 0, 0, 'C');


        $pdf->Cell(180, 6, '', 0, 1, 'C');


        $pdf->Cell(280, 5, 'Bulan ' . $namabulan . ' & Tahun ' . $tahun, 0, 0, 'C');
        $pdf->Cell(180, 10, '', 0, 1, 'C');
        //buat dummy cell untuk memberi jarak vertikal
        $pdf->Cell(189, 5, '', 0, 1); //end of line
        //Cell(width , height , text , border , end line , [align] )

        $pdf->Cell(130, 10, 'DETAIL STOK OPNAME', 0, 0);
        $pdf->Cell(59, 5, '', 0, 1); //end of line

        //set font jadi arial, regular, 12pt

        $pdf->SetFont('Arial', '', 12);


        $pdf->Cell(250, 10, 'Tgl Cetak     : ' . $date, 0, 0);
        $pdf->Cell(0, 5, ' ', 0, 1); //end of line


        $pdf->Cell(130, 10, 'Priode Bulan & Tahun   : ' . $namabulan . ' ' . $tahun, 0, 1);
        //end of line



        //buat dummy cell untuk memberi jarak vertikal
        $pdf->Cell(10, 3, '', 0, 1); //end of line
        $pdf->SetFillColor(255, 255, 0);
        $pdf->SetFont('Arial', 'B', 10);


        $pdf->setFillColor(230, 230, 230);
        $pdf->Cell(5, 20, 'No', 1, 0, 'C', 1);
        $pdf->Cell(30, 20, 'Nama Barang', 1, 0, 'C', 1);

        $pdf->Cell(224, 10, 'Bulan ' . $namabulan, 1, 0, 'C', 1);
        $pdf->Cell(20, 20, 'Total', 1, 0, 'C', 1);




        $pdf->Cell(30, 10, "", 0, 1);
        $pdf->Cell(35, 10, "", 0, 0);


        $pdf->Cell(8, 10, 1, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 2, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 3, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 4, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 5, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 6, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 7, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 8, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 9, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 10, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 11, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 12, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 13, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 14, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 15, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 16, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 17, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 18, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 19, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 20, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 21, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 22, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 23, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 24, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 25, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 26, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 27, 1, 0, 'C', 1);
        $pdf->Cell(8, 10, 28, 1, 1, 'C', 1);



        $pdf->SetFont('Arial', '', 8);

        $no = 1;

        foreach ($databarang as $r) {

            $pdf->cell(5, 5, $no++, 1, 0, 'C');
            $pdf->cell(30, 5, $r['nama_barang'], 1, 0, 'L');




            $id = $r['id_barang'];
            $db = $this->db->get_where('stok_opname', ['id_barang' => $id]);
            $query = $db->row_array();

            $queryarr =   $db->result_array();
            $cek = $db->num_rows();


            if (empty($query)) {


                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(8, 5, 0, 1, 0, 'C');
                $pdf->Cell(20, 5, 0, 1, 0, 'C');
            } else {

                $id = $r['id_barang'];
                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-1']);
                $o = $db->row_array();
                $cekbulan1 = $db->num_rows();

                if (empty($cekbulan1)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-2']);
                $o = $db->row_array();


                $cekbulan2 = $db->num_rows();

                if (empty($cekbulan2)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }



                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-3']);
                $o = $db->row_array();


                $cekbulan3 = $db->num_rows();

                if (empty($cekbulan3)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-4']);
                $o = $db->row_array();


                $cekbulan4 = $db->num_rows();

                if (empty($cekbulan4)) {
                    $total[] = 0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-5']);
                $o = $db->row_array();


                $cekbulan5 = $db->num_rows();

                if (empty($cekbulan5)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-6']);
                $o = $db->row_array();


                $cekbulan6 = $db->num_rows();

                if (empty($cekbulan6)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-7']);
                $o = $db->row_array();


                $cekbulan7 = $db->num_rows();

                if (empty($cekbulan7)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-8']);
                $o = $db->row_array();


                $cekbulan8 = $db->num_rows();

                if (empty($cekbulan8)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-9']);
                $o = $db->row_array();


                $cekbulan9 = $db->num_rows();

                if (empty($cekbulan9)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-10']);
                $o = $db->row_array();


                $cekbulan10 = $db->num_rows();

                if (empty($cekbulan10)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-11']);
                $o = $db->row_array();


                $cekbulan11 = $db->num_rows();

                if (empty($cekbulan11)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-12']);
                $o = $db->row_array();


                $cekbulan12 = $db->num_rows();

                if (empty($cekbulan12)) {
                    $total[] = 0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-13']);
                $o = $db->row_array();


                $cekbulan13 = $db->num_rows();

                if (empty($cekbulan13)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-14']);
                $o = $db->row_array();


                $cekbulan14 = $db->num_rows();

                if (empty($cekbulan14)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-15']);
                $o = $db->row_array();


                $cekbulan15 = $db->num_rows();

                if (empty($cekbulan15)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-16']);
                $o = $db->row_array();


                $cekbulan2 = $db->num_rows();

                if (empty($cekbulan16)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-17']);
                $o = $db->row_array();


                $cekbulan17 = $db->num_rows();

                if (empty($cekbulan17)) {
                    $total[] = 0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] = $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-18']);
                $o = $db->row_array();


                $cekbulan18 = $db->num_rows();

                if (empty($cekbulan18)) {
                    $total[] = 0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] = $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-19']);
                $o = $db->row_array();


                $cekbulan19 = $db->num_rows();

                if (empty($cekbulan19)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-20']);
                $o = $db->row_array();


                $cekbulan20 = $db->num_rows();

                if (empty($cekbulan20)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-21']);
                $o = $db->row_array();


                $cekbulan21 = $db->num_rows();

                if (empty($cekbulan21)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-22']);
                $o = $db->row_array();


                $cekbulan22 = $db->num_rows();

                if (empty($cekbulan22)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {

                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-23']);
                $o = $db->row_array();


                $cekbulan23 = $db->num_rows();

                if (empty($cekbulan23)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-24']);
                $o = $db->row_array();


                $cekbulan24 = $db->num_rows();

                if (empty($cekbulan24)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-25']);
                $o = $db->row_array();


                $cekbulan25 = $db->num_rows();

                if (empty($cekbulan25)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-26']);
                $o = $db->row_array();


                $cekbulan26 = $db->num_rows();

                if (empty($cekbulan26)) {
                    $total[] =  0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {

                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }


                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-27']);
                $o = $db->row_array();


                $cekbulan27 = $db->num_rows();

                if (empty($cekbulan27)) {

                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bulan . '-28']);
                $o = $db->row_array();


                $cekbulan28 = $db->num_rows();

                if (empty($cekbulan28)) {
                    $total[] = 0;
                    $pdf->Cell(8, 5, 0, 1, 0, 'C');
                } else {
                    $total[] =  $o['stokopname'];
                    $pdf->Cell(8, 5, $o['stokopname'], 1, 0, 'C');
                }

                $grandtotal = array_sum($total);
                $pdf->Cell(20, 5, $grandtotal, 1, 0, 'C');
            }

            $pdf->Cell(30, 5, "", 0, 1);
        } //     }
        // }

        // end of line
        // plus men then thun n geser n rokumen




        //buat dummy cell untuk memberi jarak vertikal

        $pdf->Output();
    }
} else if (isset($_POST['excel'])) {
    header("Content-type: application/octet-stream");

    header("Content-Disposition: attachment; filename=$title.xls");

    header("Pragma: no-cache");

    header("Expires: 0");
    ?>

    <table border="1" width="100%">

        <thead>

            <tr>

                <th>Nama</th>

                <th>Username</th>

                <th>Password</th>

            </tr>

        </thead>

        <tbody>

        <?php
    }
