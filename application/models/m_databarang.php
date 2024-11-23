<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_databarang extends CI_Model
{

    public function getdatabarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function totalhargapokok()
    {
        $this->db->select('sum(harga_pokokbarang) as hargapokok');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->row_array();
    }


    public function totalbarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function insertbarang($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function databarangedit($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('id_barang', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahbarang($data, $id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('barang', $data);
    }

    public function hapusdatabarang($id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->delete('barang');
    }
}

/* End of file Databarang_model.php */
