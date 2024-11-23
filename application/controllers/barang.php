<?php
defined('BASEPATH') or exit('No direct script access allowed');

class barang extends CI_Controller
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
            'title' => 'Halaman Barang | CV CARAKA ABADI',
            'halaman' => 'Barang',
            'apps' => 'Aplikasi Manajemen Stok',
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'app' => 'AMS'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/barang', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxcrud', $data);
    }

    public function databarang()
    {




        $databarang = $this->m_databarang->getdatabarang();
        $no = 1;
        foreach ($databarang as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['id_barang'];
            $tbody[] = $value['nama_barang'];
            $tbody[] = $value['jenis_barang'];
            $tbody[] =   '<img class="img-thumbnail" src="' . ($value['gambar_barang'] == 'default.png' ? base_url('assets/img/gambarbarang/default-profile.png') : base_url('assets/img/gambarbarang/' . $value['gambar_barang'])) . '" class="card-img" style="width: 100%;">';
            $tbody[] = 'Rp.' . number_format($value['harga_barang'], 2, ",", ".");
            $tbody[] = $value['no_sertifikat'];
            $tbody[] = 'Rp.' . number_format($value['harga_pokokbarang'], 2, ",", ".");

            $id = $_SESSION['id_user'];
            $query = $this->m_user->hakaksesuser($id);

            if ($query['update'] == 1 && $query['delete'] == 1) {
                $aksi = "<button class='btn btn-success ubah-barang mb-4' data-toggle='modal'  data-id=" . $value['id_barang'] . ">Ubah</button>" . ' ' . "<button class='btn btn-danger hapus-barang' id='id' data-toggle='modal' data-id=" . $value['id_barang'] . ">Hapus</button>";
            } else if ($query['update'] == 1) {
                $aksi = "<button class='btn btn-success ubah-barang mb-4' data-toggle='modal'  data-id=" . $value['id_barang'] . ">Ubah</button>";
            } else  if ($query['delete'] == 1) {
                $aksi =   "<button class='btn btn-danger hapus-barang' id='id' data-toggle='modal' data-id=" . $value['id_barang'] . ">Hapus</button>";
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

    public function tambahbarang()
    {
        // didapat dari ajax yang dimana data{nama:nama,alamat:alamat}
        $namabarang = htmlspecialchars($this->input->post('namabarang'));
        $jenisbarang = htmlspecialchars($this->input->post('jenisbarang'));
        $nosertifikat = htmlspecialchars($this->input->post('nosertifikat'));
        $hargapokobarang = htmlspecialchars($this->input->post('hargapokokbarang'));
        $hargajualbarang = htmlspecialchars($this->input->post('hargjualbarang'));

        $upload_image = $_FILES['gambarbarang']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size']      = '2048';
            $config['encrypt_name'] = TRUE;
            $config['upload_path'] = $this->config->item('SAVE_FOLDER_GAMBAR');

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambarbarang')) {
                $gbr = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->config->item('SAVE_FOLDER_GAMBAR') . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 300;
                $config['height'] = 300;
                $config['new_image'] = $this->config->item('SAVE_FOLDER_GAMBAR') . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $this->upload->data('file_name');
            } else {
                return "default.png";
            }
        } else {
            $gambar = 'Default.png';
        }


        $tambahbarang = array(
            'nama_barang' => $namabarang,
            'jenis_barang'  => $jenisbarang,
            'no_sertifikat' => $nosertifikat,
            'harga_barang' => $hargapokobarang,
            'harga_pokokbarang' => $hargajualbarang,
            'gambar_barang' => $gambar
        );

        $data = $this->m_databarang->insertbarang($tambahbarang);

        echo json_encode($data);
    }

    public function editbarang()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = [
            'databarang' => $this->m_databarang->databarangedit($id),
            'type'  => 'barang'
        ];

        $this->load->view('editfrom', $data);
    }

    public function ubahbarang()
    {

        $id = htmlspecialchars($this->input->post('id_barangedit'));
        $query_cek =  $this->m_databarang->databarangedit($id);
        $gambar = $query_cek['gambar_barang'];
        $upload_image = $_FILES['gambarbarangedit']['name'];

        if (empty($upload_image)) {
            $gambaredit = $gambar;
        } else {

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']      = '2048';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $this->config->item('SAVE_FOLDER_GAMBAR');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambarbarangedit')) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $this->config->item('SAVE_FOLDER_GAMBAR') . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 300;
                    $config['height'] = 300;
                    $config['new_image'] = $this->config->item('SAVE_FOLDER_GAMBAR') . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $old_image = trim($gambar);
                    if ($old_image != 'default.png') {
                        unlink($this->config->item('SAVE_FOLDER_GAMBAR') . $old_image);
                    }

                    $gambaredit = $this->upload->data('file_name');
                } else {
                    return "default.png";
                }
            } else {
                $gambaredit = 'Default.png';
            }
        }
        $namabarang = htmlspecialchars($this->input->post('namabarangedit'));
        $jenisbarang = htmlspecialchars($this->input->post('jenisbarangedit'));
        $nosertifikat = htmlspecialchars($this->input->post('nosertifikatedit'));
        $hargapokobarang = htmlspecialchars($this->input->post('hargapokokbarangedit'));
        $hargajualbarang = htmlspecialchars($this->input->post('hargjualbarangedit'));

        $data = array(
            'nama_barang' => $namabarang,
            'jenis_barang'  => $jenisbarang,
            'no_sertifikat' => $nosertifikat,
            'harga_barang' => $hargapokobarang,
            'harga_pokokbarang' => $hargajualbarang,
            'gambar_barang' => $gambaredit
        );

        $data = $this->m_databarang->prosesubahbarang($data, $id);

        echo json_encode($data);
    }

    public function hapusbarang()
    {

        $query = $this->db->get_where('barang', ['id_barang' => htmlspecialchars($this->input->post('id', true))])->row_array();

        $old_image = trim($query['gambar_barang']);
        if ($old_image != 'default-profile.png') {
            unlink($this->config->item('SAVE_FOLDER_GAMBAR') . $old_image);
        }
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->m_databarang->hapusdatabarang($id);
        echo json_encode($data);
    }
}

/* End of file Home.php */
