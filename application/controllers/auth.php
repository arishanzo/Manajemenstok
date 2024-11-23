<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('M_user', 'model');
    //     $this->table = 'user';
    //     if (!$this->session->userdata('username')) {
    //         redirect('auth/login');
    //     }
    // }

    public function __construct()
    {
        parent::__construct();

        // if ($this->session->userdata('username')) {
        //     redirect('beranda');
        // }
    }

    public function index()
    {
        show_404();
    }
    public function logout()
    {

        $id = $_SESSION['id_user'];

        $this->m_auth->deleteaktivitas($id);
        $this->m_auth->logout();
        $this->session->sess_destroy();
        redirect(site_url());
    }


    public function login()
    {
        if ($this->session->userdata('username')) {
            redirect(base_url('dashboard'));
        }
        $this->load->library('form_validation');

        $rules = $this->m_auth->rules();
        $this->form_validation->set_rules($rules);



        $data = [
            'title' => 'Login | CV CARAKA ABADI',
            'datasetting' =>  $this->m_setting->getdatasetting()
        ];


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/headerlogin', $data);
            $this->load->view('auth/login', $data);
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );

        $cek = $this->m_auth->proseslogin("user", $where)->num_rows();
        $cek = $this->m_auth->proseslogin("user", $where)->row_array();
        if ($cek > 0) {

            $data_session = array(
                'lvl_user' => $username,
                'username' => $username,
                'id_user' => $cek['id_user']
            );

            $this->session->set_userdata($data_session);

            $save = array(

                'id_user' => $cek['id_user'],
                'jam' => date('Y-m-d h:i:s')
            );

            $this->m_auth->savelogaktivitas($save);

            redirect(base_url("index.php/home"));
        } else {
            $this->session->set_flashdata('authmsg', '<div class="alert alert-danger" role="alert">Password Atau Username Salah!</div>');
        }
    }
}
