<?php

class m_feedback extends CI_Model
{

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ],

            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ]
        ];
    }


    public function rulesuser()
    {
        return [
            [
                'field' => 'username',
                'label' => 'username',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ],
            [
                'field' => 'namauser',
                'label' => 'namauser',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ],
            [
                'field' => 'roleuser',
                'label' => 'roleuser',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ],

            [
                'field' => 'password',
                'label' => 'password',
                'rules' => 'trim|required|xss_clean|',
                'errors' => ['required' => 'Maaf Tidak Boleh Kosong %s.', 'xss_clean' => 'Tolong Cek Form ini %s.']
            ]
        ];
    }
}
