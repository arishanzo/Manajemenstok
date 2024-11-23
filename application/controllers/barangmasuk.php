<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barangmasuk extends CI_Controller
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
            'title' => 'Halaman Barang Masuk | CV CARAKA ABADI',
            'halaman' => 'Barang Masuk',
            'apps' => 'Aplikasi Manajemen Stok',
            'databarang' => $this->m_databarangmasuk->databarang(),
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'app' => 'AMS'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/barangmasuk', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxcrud', $data);
    }

    public function databarangmasuk()
    {

        $databarang = $this->m_databarang->getdatabarang();
        $no = 1;
        foreach ($databarang as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['id_barang'];
            $tbody[] = $value['nama_barang'];
            $tbody[] =   '<img class="img-thumbnail" src="' . ($value['gambar_barang'] == 'default.png' ? base_url('assets/img/gambarbarang/default-profile.png') : base_url('assets/img/gambarbarang/' . $value['gambar_barang'])) . '" class="card-img" style="width: 100%;">';

            $querybarang = $this->db->get_where('stok_barangmasuk', ['id_barang' => $value['id_barang']])->row_array();
            $ambil = $this->db->get('stok_barangmasuk');
            $cek = $ambil->num_rows();
            if ($cek > 0) {
                $tbody[] = $querybarang['jumlah_stok'];
            } else {
                $tbody[] = 0;
            }

            $id = $_SESSION['id_user'];
            $query = $this->m_user->hakaksesuser($id);





            $tbody[] = $querybarang['tgl_masuk'];

            if ($query['cread'] == 1) {
                $stok =  "<button class='btn btn-success tambah-stok' data-toggle='modal'  data-id=" . $querybarang['id_stokbarangmasuk'] . "> + </button>" . ' ' . "<button class='btn btn-danger kurangi-stok' id='id' data-toggle='modal' data-id=" . $querybarang['id_stokbarangmasuk'] . "> - </button>";
            } else {
                $stok = '';
            }
            if ($query['update'] == 1 && $query['delete'] == 1) {
                $aksi = "<button class='btn btn-success ubah-stokbarang ' data-toggle='modal'  data-id=" .  $querybarang['id_stokbarangmasuk'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger  hapus-barangmasuk' id='id' data-toggle='modal' data-id=" . $querybarang['id_stokbarangmasuk'] . ">Hapus</button>";
            } else

            if ($query['update'] == 1) {
                $aksi =  "<button class='btn btn-success ubah-stokbarang' data-toggle='modal'  data-id=" . $querybarang['id_stokbarangmasuk'] . ">Ubah</button>";
            } else

            if ($query['delete'] == 1) {
                $aksi = "<button class='btn btn-danger hapus-barangmasuk' id='id' data-toggle='modal' data-id=" . $querybarang['id_stokbarangmasuk'] . ">Hapus</button>";
            } else {
                $aksi = '';
            }






            $tbody[] = $stok;
            $tbody[] = $aksi;

            $data[] = $tbody;
        }

        if ($databarang) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }


    public function editbarangmasuk()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');


        $data = [
            'databarangmasuk' => $this->m_databarangmasuk->databarangeditmasuk($id),
            'type'  => 'barangmasuk'
        ];

        $this->load->view('editfrom', $data);
    }

    public function tambahstok()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');


        $data = [
            'databarangmasuk' => $this->m_databarangmasuk->databarangeditmasuk($id),
            'type'  => 'tambahstok'
        ];

        $this->load->view('stokform', $data);
    }

    public function kurangistok()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');


        $data = [
            'databarangmasuk' => $this->m_databarangmasuk->databarangeditmasuk($id),
            'type'  => 'kurangistok'
        ];

        $this->load->view('stokform', $data);
    }

    public function tambahstokbarang()
    {

        $id = htmlspecialchars($this->input->post('id'));

        $query = $this->db->get_where('stok_barangmasuk', ['id_stokbarangmasuk' => htmlspecialchars($this->input->post('id', true))])->row_array();

        $stokedit = htmlspecialchars($this->input->post('stok'));

        $jmlhstok = $stokedit + $query['jumlah_stok'];
        $date = date('Y-m-d h:i:s');

        $data = array(
            'jumlah_stok'  => $jmlhstok,
            'tgl_masuk' => $date
        );

        $data = $this->m_databarangmasuk->prosesubahbarangmasuk($data, $id);

        echo json_encode($data);
    }

    public function kurangistokbarang()
    {

        $id = htmlspecialchars($this->input->post('id'));

        $query = $this->db->get_where('stok_barangmasuk', ['id_stokbarangmasuk' => htmlspecialchars($this->input->post('id', true))])->row_array();

        $stokedit = htmlspecialchars($this->input->post('stok'));

        $jmlhstok =  $query['jumlah_stok'] - $stokedit;
        $date = date('Y-m-d h:i:s');

        $data = array(
            'jumlah_stok'  => $jmlhstok,
            'tgl_masuk' => $date
        );

        $data = $this->m_databarangmasuk->prosesubahbarangmasuk($data, $id);

        echo json_encode($data);
    }

    public function ubahbarangmasuk()
    {
        $id = htmlspecialchars($this->input->post('id'));

        $stokedit = htmlspecialchars($this->input->post('stok'));

        $date = date('Y-m-d h:i:s');

        $data = array(
            'jumlah_stok'  => $stokedit,
            'tgl_masuk' => $date
        );

        $data = $this->m_databarangmasuk->prosesubahbarangmasuk($data, $id);

        echo json_encode($data);
    }

    public function hapusbarangmasuk()
    {

        $id = htmlspecialchars($this->input->post('id'));

        $stokedit = htmlspecialchars($this->input->post('stok'));

        $date = date('Y-m-d h:i:s');

        $data = array(
            'jumlah_stok'  => 0,
            'tgl_masuk' => $date
        );

        $data = $this->m_databarangmasuk->prosesubahbarangmasuk($data, $id);

        echo json_encode($data);
    }
}

/* End of file Home.php */
