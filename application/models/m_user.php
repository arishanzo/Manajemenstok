<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_user extends CI_Model
{

    public function getdatauser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdataktivitasuser($id)
    {
        $this->db->select('*');
        $this->db->from('log_aktivitas');

        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function getdataperuser($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function insertuser($data)
    {
        return $this->db->insert('user', $data);
    }

    public function datauseredit($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function hakaksesuser($id)
    {
        $this->db->select('*');
        $this->db->from('hakaksesuser');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahuser($data, $id)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('user', $data);
    }

    public function hapusdatauser($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('user');
    }
}

/* End of file Datauser_model.php */
