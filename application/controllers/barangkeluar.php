<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barangkeluar extends CI_Controller
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
            'title' => 'Halaman Barang Keluar | CV CARAKA ABADI',
            'halaman' => 'Barang Keluar',
            'apps' => 'Aplikasi Manajemen Stok',
            'databarang' => $this->m_databarang->getdatabarang(),
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'app' => 'AMS'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/barangkeluar', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxcrud', $data);
    }

    public function databarangkeluar()
    {

        $databarang = $this->m_barangkeluar->getdatabarangkeluar();
        $no = 1;
        foreach ($databarang as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['id_barang'];
            $tbody[] = $value['nama_barang'];
            $tbody[] = $value['stok_keluar'];
            $tbody[] = 'Rp.' . number_format($value['nilai_barangkeluar'], 2, ",", ".");
            $tbody[] = date("d F Y", strtotime($value['tgl_keluar']));
            $query = $this->db->get_where('stok_barangmasuk', ['id_barang' => $value['id_barang']])->row_array();
            if ($query['jumlah_stok'] == 0) {
                $tbody[] = "<span class='badge badge-danger'>Stok Habis</span>";
            } else if ($query['jumlah_stok'] < 5) {
                $tbody[] = "<span class='badge badge-primary'>Stok Hampir Habis</span>";
            } else {
                $tbody[] = "<span class='badge badge-success'>Stok Masih Ada</span>";
            }

            $id = $_SESSION['id_user'];
            $query = $this->m_user->hakaksesuser($id);

            if ($query['update'] == 1 && $query['delete'] == 1) {
                $aksi = "<button class='btn btn-success  ubah-barangkeluar' data-toggle='modal'  data-id=" . $value['id_stokbarangkeluar'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger hapus-barangkeluar' id='id' data-toggle='modal' data-id=" . $value['id_stokbarangkeluar'] . ">Hapus</button>";
            } else
            if ($query['update'] == 1) {
                $aksi =  "<button class='btn btn-success ubah-barangkeluar' data-toggle='modal'  data-id=" . $value['id_stokbarangkeluar'] . ">Ubah</button>";
            } else 

            if ($query['delete'] == 1) {
                $aksi = "<button class='btn btn-danger hapus-barangkeluar' id='id' data-toggle='modal' data-id=" . $value['id_stokbarangkeluar'] . ">Hapus</button>";
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

    public function tambahbarangkeluar()
    {
        // didapat dari ajax yang dimana data{nama:nama,alamat:alamat}
        $query = $this->db->get_where('barang', ['id_barang' => htmlspecialchars($this->input->post('namabarang', true))])->row_array();
        $namabarang = htmlspecialchars($this->input->post('namabarang'));
        $terjual = htmlspecialchars($this->input->post('terjual'));
        $tanggal = htmlspecialchars($this->input->post('tanggal'));

        $stokbarangmasuk = $this->db->get_where('stok_barangmasuk', ['id_barang' => htmlspecialchars($this->input->post('namabarang', true))])->row_array();

        if ($stokbarangmasuk['jumlah_stok'] > $terjual) {
            $nilaibarang = $query['harga_barang'] * $terjual;

            $tambahbarang = array(
                'id_barang' => $namabarang,
                'stok_keluar'  => $terjual,
                'nilai_barangkeluar' => $nilaibarang,
                'tgl_keluar' => $tanggal
            );

            $data = $this->m_barangkeluar->insertbarangkeluar($tambahbarang);

            echo json_encode($data);
        }
    }

    public function editbarangkeluar()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = [
            'databarangkeluar' => $this->m_barangkeluar->databarangkeluaredit(trim($id)),
            'type'  => 'barang_keluar',
            'databarang' => $this->m_databarang->getdatabarang()
        ];

        $this->load->view('editfrom', $data);
    }

    public function ubahbarangkeluar()
    {

        $databarang = $this->db->get_where('barang', ['id_barang' => htmlspecialchars($this->input->post('namabarangedit', true))])->row_array();

        $stokbarangmasuk = $this->db->get_where('stok_barangmasuk', ['id_barang' => htmlspecialchars($this->input->post('namabarangedit', true))])->row_array();

        $stokbarangkeluar = $this->db->get_where('stok_barangkeluar', ['id_barang' => htmlspecialchars($this->input->post('namabarangedit', true))])->row_array();


        $id = htmlspecialchars($this->input->post('ideditbarangkeluar'));

        $namabarang = htmlspecialchars($this->input->post('namabarangedit'));
        $terjual = htmlspecialchars($this->input->post('terjualedit'));
        $tanggal = htmlspecialchars($this->input->post('tanggaledit'));

        $nilaibarang = $databarang['harga_barang'] * $terjual;

        if ($stokbarangmasuk['jumlah_stok'] > $terjual) {

            $data = array(
                'id_barang' => $namabarang,
                'stok_keluar'  => $terjual,
                'nilai_barangkeluar' => $nilaibarang,
                'tgl_keluar' => $tanggal
            );

            $data = $this->m_barangkeluar->prosesubahbarangkeluar($data, $id);

            echo json_encode($data);
        }
    }

    public function hapusbarangkeluar()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->m_barangkeluar->hapusdatabarangkeluar($id);
        echo json_encode($data);
    }
}

/* End of file Home.php */
