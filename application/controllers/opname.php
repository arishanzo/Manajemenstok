<?php
defined('BASEPATH') or exit('No direct script access allowed');

class opname extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->m_auth->current_user()) {
            redirect('login');
        }
    }
    public function index()
    {

        $data = [
            'title' => 'Halaman Stok Opname| CV CARAKA ABADI',
            'halaman' => 'Stok Opname',
            'apps' => 'Aplikasi Manajemen Stok',
            'databarang' => $this->m_databarang->getdatabarang(),
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'app' => 'AMS'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/opname', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxcrud', $data);
    }

    public function dataopname()
    {

        $databarang = $this->m_opname->getdataopname();
        $no = 1;
        foreach ($databarang as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['id_barang'];
            $tbody[] = $value['nama_barang'];
            $tbody[] = $value['stokopname'];
            $tbody[] = date("d F Y", strtotime($value['tgl_input']));

            $id = $_SESSION['id_user'];
            $query = $this->m_user->hakaksesuser($id);


            if ($query['update'] == 1 && $query['delete'] == 1) {
                $aksi = "<button class='btn btn-success ubah-opname ' data-toggle='modal'  data-id=" . $value['id_stokopname'] . ">Ubah</button>" . ' ' .  "<button class='btn btn-danger hapus-opname' id='id' data-toggle='modal' data-id=" . $value['id_stokopname'] . ">Hapus</button>";
            } else
            if ($query['update'] == 1) {
                $aksi =  "<button class='btn btn-success ubah-opname' data-toggle='modal'  data-id=" . $value['id_stokopname'] . ">Ubah</button>";
            } else 

            if ($query['delete'] == 1) {
                $aksi = "<button class='btn btn-danger hapus-opname' id='id' data-toggle='modal' data-id=" . $value['id_stokopname'] . ">Hapus</button>";
            } else {
                $aksi = '';
            }


            $tbody[] = $aksi;
            $data[] = $tbody;
        }

        if ($databarang) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    public function tambahopname()
    {
        // didapat dari ajax yang dimana data{nama:nama,alamat:alamat}
        $namabarang = htmlspecialchars($this->input->post('namabarangopname'));
        $stokopname = htmlspecialchars($this->input->post('stokopname'));
        $tanggal = htmlspecialchars($this->input->post('tanggalopname'));



        $tambahopname = array(
            'id_barang' => $namabarang,
            'stokopname'  => $stokopname,
            'tgl_input' => $tanggal
        );

        $data = $this->m_opname->insertopname($tambahopname);

        echo json_encode($data);
    }

    public function editopname()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = [
            'dataopname' => $this->m_opname->dataopnameedit(trim($id)),
            'type'  => 'stokopname',
            'databarang' => $this->m_databarang->getdatabarang()
        ];

        $this->load->view('editfrom', $data);
    }

    public function ubahopname()
    {

        $id = htmlspecialchars($this->input->post('ideditstokopname'));

        $namabarang = htmlspecialchars($this->input->post('namabarangopnameedit'));
        $stokopname = htmlspecialchars($this->input->post('stokopnameedit'));
        $tanggal = htmlspecialchars($this->input->post('tanggalopnameedit'));




        $data = array(
            'id_barang' => $namabarang,
            'stokopname'  => $stokopname,
            'tgl_input' => $tanggal
        );

        $data = $this->m_opname->prosesubahopname($data, $id);

        echo json_encode($data);
    }

    public function hapusopname()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->m_opname->hapusdataopname($id);
        echo json_encode($data);
    }

    public function printpdf()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}

        $getdataopname = $this->m_opname->getdataopname();
        $getdatabarang = $this->m_databarang->getdatabarang();
        $bln = $this->input->post('bulan');
        $bulan = $this->m_opname->get_bln($bln);

        $data = [
            'bulan' => htmlspecialchars($this->input->post('bulan')),
            'tahun' => htmlspecialchars($this->input->post('tahun')),
            'dataopname' => $getdataopname,
            'databarang' => $getdatabarang,
            'getambilbulan' => $bulan,
            'type' => 'pdf'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('admin/cetak', $data);
    }

    public function printexcel()
    {
        $this->load->library('form_validation');

        $validation = [
            [
                'field' => 'bulan',
                'label' => 'bulan',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
            ],
            [
                'field' => 'tahun',
                'label' => 'tahun',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
            ]

        ];
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Halaman Stok Opname| CV CARAKA ABADI',
                'halaman' => 'Stok Opname',
                'apps' => 'Aplikasi Manajemen Stok',
                'databarang' => $this->m_databarang->getdatabarang(),
                'datasetting' =>  $this->m_setting->getdatasetting(),
                'app' => 'AMS'
                // 'current_barang' => $this->m_auth->current_barang(),
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/nav', $data);
            $this->load->view('admin/opname', $data);
            $this->load->view('layout/foot', $data);
            $this->load->view('ajaxcrud', $data);
        } else {
            $getdataopname = $this->m_opname->getdataopname();
            $getdatabarang = $this->m_databarang->getdatabarang();
            $bln = $this->input->post('bulan');
            $bulan = $this->m_opname->get_bln($bln);
            $tahun = htmlspecialchars($this->input->post('tahun'));
            $data = [
                'bulan' => htmlspecialchars($this->input->post('bulan')),
                'tahun' => htmlspecialchars($this->input->post('tahun')),
                'dataopname' => $getdataopname,
                'databarang' => $getdatabarang,
                'getambilbulan' => $bulan,
                'title' => 'Stok Opname Bulan' . $bulan,
                'type' => 'excel'
                // 'current_barang' => $this->m_auth->current_barang(),
            ];


            $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $styleJudul = [
                'font' => [
                    'bold' => true,
                    'size' => 15,
                ],
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'wrap' => true,
                ],
            ];


            $sheet->setCellValue('A1', 'Laporan Stok Opname CV.CARAKA ABADI di Bulan: ' . $bulan . ' ' . $tahun);
            $sheet->mergeCells('A1:AD1');
            $sheet->getStyle('A1')->applyFromArray($styleJudul);
            $sheet->setCellValue('A3', 'Excel was generated on ' . date("Y-m-d H:i:s") . '');
            $sheet->mergeCells('A3:AD3');
            $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


            $sheet->setCellValue('A5', 'No');
            $sheet->setCellValue('B5', 'Nama Barang');

            $sheet->setCellValue('C5', 1);
            $sheet->setCellValue('D5', 2);
            $sheet->setCellValue('E5', 3);
            $sheet->setCellValue('F5', 4);
            $sheet->setCellValue('G5', 5);

            $sheet->setCellValue('H5', 6);
            $sheet->setCellValue('I5', 7);
            $sheet->setCellValue('J5', 8);
            $sheet->setCellValue('K5', 9);
            $sheet->setCellValue('L5', 10);

            $sheet->setCellValue('M5', 11);
            $sheet->setCellValue('N5', 12);
            $sheet->setCellValue('O5', 13);
            $sheet->setCellValue('P5', 14);
            $sheet->setCellValue('Q5', 15);

            $sheet->setCellValue('R5', 16);
            $sheet->setCellValue('S5', 17);
            $sheet->setCellValue('T5', 18);
            $sheet->setCellValue('U5', 19);
            $sheet->setCellValue('V5', 20);


            $sheet->setCellValue('W5', 21);
            $sheet->setCellValue('X5', 22);
            $sheet->setCellValue('Y5', 23);
            $sheet->setCellValue('Z5', 24);
            $sheet->setCellValue('AA5', 25);
            $sheet->setCellValue('AB5', 26);
            $sheet->setCellValue('AC5', 27);
            $sheet->setCellValue('AD5', 28);
            $sheet->setCellValue('AE5', 'Total');




            $sheet->getStyle('A5:AE5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            $no = 1;
            $rowx = 6;
            foreach ($getdatabarang as $barang) {
                $sheet->setCellValue('A' . $rowx, $no++);
                $sheet->setCellValue('B' . $rowx, $barang['nama_barang']);

                $id = $barang['id_barang'];
                $db = $this->db->get_where('stok_opname', ['id_barang' => $id]);
                $query = $db->row_array();


                if (empty($query)) {

                    $sheet->setCellValue('C' . $rowx, 0);
                    $sheet->setCellValue('D' . $rowx, 0);
                    $sheet->setCellValue('E' . $rowx, 0);
                    $sheet->setCellValue('F' . $rowx, 0);
                    $sheet->setCellValue('G' . $rowx, 0);

                    $sheet->setCellValue('H' . $rowx, 0);
                    $sheet->setCellValue('I' . $rowx, 0);
                    $sheet->setCellValue('J' . $rowx, 0);
                    $sheet->setCellValue('K' . $rowx, 0);
                    $sheet->setCellValue('L' . $rowx, 0);

                    $sheet->setCellValue('M' . $rowx, 0);
                    $sheet->setCellValue('N' . $rowx, 0);
                    $sheet->setCellValue('O' . $rowx, 0);
                    $sheet->setCellValue('P' . $rowx, 0);
                    $sheet->setCellValue('Q' . $rowx, 0);

                    $sheet->setCellValue('R' . $rowx, 0);
                    $sheet->setCellValue('S' . $rowx, 0);
                    $sheet->setCellValue('T' . $rowx, 0);
                    $sheet->setCellValue('U' . $rowx, 0);
                    $sheet->setCellValue('V' . $rowx, 0);

                    $sheet->setCellValue('W' . $rowx, 0);
                    $sheet->setCellValue('X' . $rowx, 0);
                    $sheet->setCellValue('Y' . $rowx, 0);
                    $sheet->setCellValue('Z' . $rowx, 0);
                    $sheet->setCellValue('AA' . $rowx, 0);
                    $sheet->setCellValue('AB' . $rowx, 0);
                    $sheet->setCellValue('AC' . $rowx, 0);
                    $sheet->setCellValue('AD' . $rowx, 0);
                    $sheet->setCellValue('AE' . $rowx, 0);
                } else {
                    $id = $barang['id_barang'];
                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-1']);
                    $o = $db->row_array();
                    $cekbulan1 = $db->num_rows();

                    if (empty($cekbulan1)) {
                        $total[] =  0;
                        $sheet->setCellValue('C' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('C' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-2']);
                    $o = $db->row_array();


                    $cekbulan2 = $db->num_rows();

                    if (empty($cekbulan2)) {
                        $total[] =  0;
                        $sheet->setCellValue('D' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('D' . $rowx, $o['stokopname']);
                    }



                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-3']);
                    $o = $db->row_array();


                    $cekbulan3 = $db->num_rows();

                    if (empty($cekbulan3)) {
                        $total[] =  0;
                        $sheet->setCellValue('E' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('E' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-4']);
                    $o = $db->row_array();


                    $cekbulan4 = $db->num_rows();

                    if (empty($cekbulan4)) {
                        $total[] =  0;
                        $sheet->setCellValue('F' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('F' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-5']);
                    $o = $db->row_array();


                    $cekbulan5 = $db->num_rows();

                    if (empty($cekbulan5)) {
                        $total[] =  0;
                        $sheet->setCellValue('G' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('G' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-6']);
                    $o = $db->row_array();


                    $cekbulan6 = $db->num_rows();

                    if (empty($cekbulan6)) {
                        $total[] =  0;
                        $sheet->setCellValue('H' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('H' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-7']);
                    $o = $db->row_array();


                    $cekbulan7 = $db->num_rows();

                    if (empty($cekbulan7)) {
                        $total[] =  0;
                        $sheet->setCellValue('I' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('I' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-8']);
                    $o = $db->row_array();


                    $cekbulan8 = $db->num_rows();

                    if (empty($cekbulan8)) {
                        $total[] =  0;
                        $sheet->setCellValue('J' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('J' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-9']);
                    $o = $db->row_array();


                    $cekbulan9 = $db->num_rows();

                    if (empty($cekbulan9)) {
                        $total[] =  0;
                        $sheet->setCellValue('K' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('K' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-10']);
                    $o = $db->row_array();


                    $cekbulan10 = $db->num_rows();

                    if (empty($cekbulan10)) {
                        $total[] =  0;
                        $sheet->setCellValue('L' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('L' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-11']);
                    $o = $db->row_array();


                    $cekbulan11 = $db->num_rows();

                    if (empty($cekbulan11)) {
                        $total[] =  0;
                        $sheet->setCellValue('M' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('M' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-12']);
                    $o = $db->row_array();


                    $cekbulan12 = $db->num_rows();

                    if (empty($cekbulan12)) {
                        $total[] =  0;
                        $sheet->setCellValue('N' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('N' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-13']);
                    $o = $db->row_array();


                    $cekbulan13 = $db->num_rows();

                    if (empty($cekbulan13)) {
                        $total[] =  0;
                        $sheet->setCellValue('O' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('O' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-14']);
                    $o = $db->row_array();


                    $cekbulan14 = $db->num_rows();

                    if (empty($cekbulan14)) {
                        $total[] =  0;
                        $sheet->setCellValue('P' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('P' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-15']);
                    $o = $db->row_array();


                    $cekbulan15 = $db->num_rows();

                    if (empty($cekbulan15)) {
                        $total[] =  0;
                        $sheet->setCellValue('Q' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('Q' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-16']);
                    $o = $db->row_array();


                    $cekbulan2 = $db->num_rows();

                    if (empty($cekbulan16)) {
                        $total[] =  0;
                        $sheet->setCellValue('R' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('R' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-17']);
                    $o = $db->row_array();


                    $cekbulan17 = $db->num_rows();

                    if (empty($cekbulan17)) {
                        $total[] =  0;
                        $sheet->setCellValue('S' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('S' . $rowx, $o['stokopname']);
                    }
                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-18']);
                    $o = $db->row_array();


                    $cekbulan18 = $db->num_rows();

                    if (empty($cekbulan18)) {
                        $total[] =  0;
                        $sheet->setCellValue('T' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('T' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-19']);
                    $o = $db->row_array();


                    $cekbulan19 = $db->num_rows();

                    if (empty($cekbulan19)) {
                        $total[] =  0;
                        $sheet->setCellValue('U' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('U' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-20']);
                    $o = $db->row_array();


                    $cekbulan20 = $db->num_rows();

                    if (empty($cekbulan20)) {
                        $total[] =  0;
                        $sheet->setCellValue('V' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('V' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-21']);
                    $o = $db->row_array();


                    $cekbulan21 = $db->num_rows();

                    if (empty($cekbulan21)) {
                        $total[] =  0;
                        $sheet->setCellValue('W' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('W' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-22']);
                    $o = $db->row_array();


                    $cekbulan22 = $db->num_rows();

                    if (empty($cekbulan22)) {
                        $total[] =  0;
                        $sheet->setCellValue('X' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('X' . $rowx, $o['stokopname']);
                    }


                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-23']);
                    $o = $db->row_array();


                    $cekbulan23 = $db->num_rows();

                    if (empty($cekbulan23)) {
                        $total[] =  0;
                        $sheet->setCellValue('Y' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('Y' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-24']);
                    $o = $db->row_array();


                    $cekbulan24 = $db->num_rows();

                    if (empty($cekbulan24)) {
                        $total[] =  0;
                        $sheet->setCellValue('Z' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('Z' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-25']);
                    $o = $db->row_array();


                    $cekbulan25 = $db->num_rows();

                    if (empty($cekbulan25)) {
                        $total[] =  0;
                        $sheet->setCellValue('AA' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('AA' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-26']);
                    $o = $db->row_array();


                    $cekbulan26 = $db->num_rows();

                    if (empty($cekbulan26)) {
                        $total[] =  0;
                        $sheet->setCellValue('AB' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('AB' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-27']);
                    $o = $db->row_array();


                    $cekbulan27 = $db->num_rows();

                    if (empty($cekbulan27)) {

                        $total[] =  0;
                        $sheet->setCellValue('AC' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('AC' . $rowx, $o['stokopname']);
                    }

                    $db = $this->db->get_where('stok_opname', ['id_barang' => $id, 'tgl_input' => $tahun . '-' . $bln . '-28']);
                    $o = $db->row_array();


                    $cekbulan28 = $db->num_rows();

                    if (empty($cekbulan28)) {
                        $total[] =  0;
                        $sheet->setCellValue('AD' . $rowx, 0);
                    } else {
                        $total[] =  $o['stokopname'];
                        $sheet->setCellValue('AD' . $rowx, $o['stokopname']);
                    }

                    $grandtotal = array_sum($total);
                    $sheet->setCellValue('AE' . $rowx, $grandtotal);
                }

                $rowx++;
            }
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(15);

            $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = "Stokopname" . time() . "_bulanan" . "_download";

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $writer->save('php://output');
        }
    }
}

/* End of file Home.php */
