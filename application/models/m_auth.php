<?php
class m_auth extends CI_Model
{
    const SESSION_KEY = 'id_user';

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required|xss_clean',
                'errors' => ['required' => 'You must provide a %s.', 'xss_clean' => 'Please check your form on %s.']
            ]
        ];
    }

    public function logout()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
        return !$this->session->has_userdata(self::SESSION_KEY);
    }

    public function deleteaktivitas($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('log_aktivitas');
    }
    public function savelogaktivitas($save)
    {

        $this->db->insert('log_aktivitas', $save);
    }



    public function proseslogin($table, $where)
    {

        return $this->db->get_where($table, $where);
    }


    public function current_user()
    {
        if (!$this->session->has_userdata(self::SESSION_KEY)) {
            return null;
        }

        $user_id = $this->session->userdata(self::SESSION_KEY);
        $query = $this->db->get_where('user', ['id_user' => $user_id]);
        return $query->row();
    }

    public function logout_do($table)
    {
        return $this->db->get($table);
    }
}
