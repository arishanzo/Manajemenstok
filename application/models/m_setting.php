<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_setting extends CI_Model
{

    public function getdatasetting()
    {
        $this->db->select('*');
        $this->db->from('setting_apps');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function hakaksesuser()
    {
        $this->db->select('*');
        $this->db->from('hakaksesuser');
        $this->db->join('user', 'user.id_user = hakaksesuser.id_user');

        return  $this->db->get()->result_array();
    }

    public function datasetting($id)
    {
        $this->db->select('*');
        $this->db->from('setting_apps');
        $this->db->where('id_settingapps', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahsetting($data, $id)
    {
        $this->db->where('id_settingapps', $id);
        return $this->db->update('setting_apps', $data);
    }

    public function edithakakses($data, $id)
    {
        $this->db->where('id_hakaksesuser', $id);
        return $this->db->update('hakaksesuser', $data);
    }
}
