<?php
defined('BASEPATH') or exit('No direct script access allowed');

class setting extends CI_Controller
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

        $id = $_SESSION['id_user'];
        $data = [
            'title' => 'Halaman Setting | CV CARAKA ABADI',
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'datauser' =>  $this->m_user->getdataperuser($id),
            'halaman' => 'Setting',
            'apps' => 'Aplikasi Manajemen Stok',
            'app' => 'AMS'
            // 'current_barang' => $this->m_auth->current_barang(),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/setting', $data);
        $this->load->view('layout/foot', $data);
        $this->load->view('ajaxsetting', $data);
    }

    public function ubahsetting()
    {

        $id = htmlspecialchars($this->input->post('idsetting'));
        $query_cek =  $this->m_setting->datasetting($id);

        $gambaraplikasi = $query_cek['logo_aplikasi'];
        $gambaricon = $query_cek['icon_aplikasi'];

        $upload_image1 = $_FILES['logoaplikasi']['name'];

        if (empty($upload_image1)) {
            $gambar1 = $gambaraplikasi;
        } else {

            if ($upload_image1) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']      = '2048';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $this->config->item('SAVE_FOLDER_SETTING');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logoaplikasi')) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $this->config->item('SAVE_FOLDER_SETTING') . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 300;
                    $config['height'] = 300;
                    $config['new_image'] = $this->config->item('SAVE_FOLDER_SETTING') . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $old_image = trim($gambaraplikasi);
                    if ($old_image != 'default.png') {
                        unlink($this->config->item('SAVE_FOLDER_SETTING') . $old_image);
                    }

                    $gambar1 = $this->upload->data('file_name');
                } else {
                    return "default.png";
                }
            } else {
                $gambar1 = 'Default.png';
            }
        }

        $upload_image2 = $_FILES['iconaplikasi']['name'];

        if (empty($upload_image2)) {
            $gambar2 =  $gambaricon;
        } else {

            if ($upload_image2) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']      = '2048';
                $config['encrypt_name'] = TRUE;
                $config['upload_path'] = $this->config->item('SAVE_FOLDER_SETTING');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('iconaplikasi')) {
                    $gbr = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $this->config->item('SAVE_FOLDER_SETTING') . $gbr['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $config['width'] = 300;
                    $config['height'] = 300;
                    $config['new_image'] = $this->config->item('SAVE_FOLDER_SETTING') . $gbr['file_name'];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $old_image = trim($gambaricon);
                    if ($old_image != 'default.png') {
                        unlink($this->config->item('SAVE_FOLDER_SETTING') . $old_image);
                    }

                    $gambar2 = $this->upload->data('file_name');
                } else {
                    return "default.png";
                }
            } else {
                $gambar2 = 'Default.png';
            }
        }

        $namaaplikasi = htmlspecialchars($this->input->post('namaaplikasi'));
        $data = array(
            'nama_aplikasi' => $namaaplikasi,
            'logo_aplikasi'  => $gambar1,
            'icon_aplikasi' => $gambar2,
            'tgl_input' => date('Y-m-d')
        );

        $data = $this->m_setting->prosesubahsetting($data, $id);

        echo json_encode($data);
    }

    public function hakaksesuser()
    {

        $datauser = $this->m_user->getdatauser();
        $no = 1;
        foreach ($datauser as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_user'];
            $tbody[] = $value['lvl_user'];

            $query = $this->db->get_where('hakaksesuser', ['id_user' => $value['id_user']])->row_array();
            $ambil = $this->db->get('hakaksesuser');
            $cek = $ambil->num_rows();

            if ($cek < 0) {
                $tbody[] = '';
                $tbody[] = '';
                $tbody[] = '';
                $tbody[] = '';
            } else {

                $tbody[] =  ($query['read'] == 1 ? "<label class='switch'>
                <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check read-checked' checked>
                 <span class='slider round'></span>
                </label>" : "<label class='switch'>
                <input type='checkbox' id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check read-checked'>
                 <span class='slider round'></span>
                </label>");

                $tbody[] =
                    ($query['cread'] == 1 ?  "<label class='switch'>
                    <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check cread-checked' checked>
                     <span class='slider round'></span>
                    </label>" : "<label class='switch'>
                    <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check cread-checked'>
                     <span class='slider round'></span>
                    </label>");

                $tbody[] =
                    ($query['update'] == 1 ?  "<label class='switch'>
                    <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check update-checked' checked>
                     <span class='slider round'></span>
                    </label>" : "<label class='switch'>
                    <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check update-checked'>
                     <span class='slider round'></span>
                    </label>");


                $tbody[] =
                    ($query['delete'] == 1 ?  "<label class='switch'>
            <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check delete-checked' checked>
             <span class='slider round'></span>
            </label>" : "<label class='switch'>
            <input type='checkbox'  id='checkbox' data-id=" . $query['id_hakaksesuser'] . "  class='get_check delete-checked'>
             <span class='slider round'></span>
            </label>");
            }

            $data[] = $tbody;
        }

        if ($datauser) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }

    public function ubahhakakses()
    {


        $id = htmlspecialchars($this->input->post('id'));
        $type = htmlspecialchars($this->input->post('type'));

        if ($type == 'read') {
            $data = array(
                'read' => 2
            );
        } else if ($type == 'cread') {
            $data = array(
                'cread' => 2
            );
        } else  if ($type == 'update') {
            $data = array(
                'update' => 2
            );
        } else  if ($type == 'delete') {
            $data = array(
                'delete' => 2
            );
        }



        $data = $this->m_setting->edithakakses($data, $id);

        echo json_encode($data);
    }

    public function ubahhakaksescheckced()
    {


        $id = htmlspecialchars($this->input->post('id'));
        $type = htmlspecialchars($this->input->post('type'));

        if ($type == 'read') {
            $data = array(
                'read' => 1
            );
        } else if ($type == 'cread') {
            $data = array(
                'cread' => 1
            );
        } else  if ($type == 'update') {
            $data = array(
                'update' => 1
            );
        } else  if ($type == 'delete') {
            $data = array(
                'delete' => 1
            );
        }



        $data = $this->m_setting->edithakakses($data, $id);

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
}
