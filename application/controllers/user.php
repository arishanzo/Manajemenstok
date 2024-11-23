<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->auth_model->current_user()) {
            redirect('login');
        }
    }
    public function index()
    {

        $data = [
            'title' => 'Halaman Admin | CV CARAKA ABADI',
            'halaman' => 'User',
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'apps' => 'Aplikasi Manajemen Stok',
            'app' => 'AMS'
            // 'current_user' => $this->m_auth->current_user(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxcrud', $data);
    }

    public function datauser()
    {



        $id = $_SESSION['id_user'];
        $datauser =  (($_SESSION['nama_user'] = 'Admin') ? $this->m_user->getdatauser() : $this->m_user->getdataperuser($id));
        $no = 1;
        foreach ($datauser as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_user'];
            $tbody[] = $value['lvl_user'];
            $aksi = "<button class='btn btn-success ubah-user' data-toggle='modal' data-id=" . $value['id_user'] . ">Ubah</button>" . ' ' . "<button class='btn btn-primary password-user' data-toggle='modal' data-id=" . $value['id_user'] . ">Ubah Password</button>" . ' ' . "<button class='btn btn-danger hapus-user' id='id' data-toggle='modal' data-id=" . $value['id_user'] . ">Hapus</button>";
            $tbody[] = $aksi;
            $data[] = $tbody;
        }

        if ($datauser) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    public function tambahuser()
    {
        // didapat dari ajax yang dimana data{nama:nama,alamat:alamat}
        $namauser = htmlspecialchars($this->input->post('nama'));
        $username = htmlspecialchars($this->input->post('username'));
        $password = md5($this->input->post('password'), PASSWORD_DEFAULT);
        $roleuser = htmlspecialchars($this->input->post('roleuser'));

        $tambahuser = array(
            'nama_user' => $namauser,
            'username'  => $username,
            'password' => $password,
            'lvl_user' => $roleuser
        );

        $data = $this->m_user->insertuser($tambahuser);

        echo json_encode($data);
    }

    public function edituser()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = [
            'datauser' => $this->m_user->datauseredit($id),
            'type'  => 'User'
        ];

        $this->load->view('editfrom', $data);
    }

    public function ubahpassword()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = [
            'datauser' => $this->m_user->datauseredit($id),
            'type'  => 'ubahpassword'
        ];

        $this->load->view('editfrom', $data);
    }

    public function ubahuser()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $namauser =  htmlspecialchars($this->input->post('namauser'));
        $lvluser = htmlspecialchars($this->input->post('roleuser'));
        $data = array(
            'username' =>  $username,
            'nama_user' => $namauser,
            'lvl_user' => $lvluser
        );

        $id = htmlspecialchars($this->input->post('id'));
        $data = $this->m_user->prosesubahuser($data, $id);

        echo json_encode($data);
    }

    public function prosesubahpassword()
    {
        $this->load->library('form_validation');

        $validation = [
            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|xss_clean|min_length[8]',
                'errors' => ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.', 'min_length' => 'Password terlalu pendek minimal 8 karakter / huruf!']
            ],
            [
                'field' => 'komfirmasipassword',
                'label' => 'komfirmasipassword',
                'rules' => 'required|xss_clean|min_length[8]|matches[password]',
                'errors' => [
                    'required' => 'Kolom ini harus Diisi %s.', 'xss_clean' => 'Please check your form on %s.', 'matches' => 'Password tidak sama!',
                    'min_length' => 'Password terlalu pendek minimal 8 karakter / huruf!'
                ]
            ]

        ];

        $this->form_validation->set_rules($validation);
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => False,
                'messages' => []
            ];
            foreach ($_POST as $key => $value) {
                $reponse['messages'][$key] = form_error($key);
                echo json_encode($reponse);
            }
        } else {
            $komfirmasipassword = md5($this->input->post('komfirmasipassword'));

            $data = array(
                'password' => $komfirmasipassword
            );
            $id = htmlspecialchars($this->input->post('iduser'));
            $data = $this->m_user->prosesubahuser($data, $id);

            $reponse = [
                'csrfName' => $this->security->get_csrf_token_name(),
                'csrfHash' => $this->security->get_csrf_hash(),
                'success' => true
            ];

            echo json_encode($reponse);
        }
    }

    public function hapususer()
    {
        // id yang telah diparsing pada ajax ajaxcrud.php data{id:id}
        $id = $this->input->post('id');

        $data = $this->m_user->hapusdatauser($id);
        echo json_encode($data);
    }
}

/* End of file Home.php */
