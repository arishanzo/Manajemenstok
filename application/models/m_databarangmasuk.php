<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_databarangmasuk extends CI_Model
{

    public function getdatabarangmasuk()
    {
        $this->db->select('*');
        $this->db->from('stok_barangmasuk');
        $this->db->join('barang', 'barang.id_barang = stok_barangmasuk.id_barang');

        return  $this->db->get()->result_array();
    }

    public function insertbarangmasuk($data)
    {
        return $this->db->insert('stok_barangmasuk', $data);
    }

    public function totalbarangmasuk()
    {
        $this->db->select('sum(jumlah_stok)');
        $this->db->from('stok_barangmasuk');

        $query = $this->db->get();
        return $query->row_array();
    }

    public function databarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get()->result();
        return $query;
    }
    public function ambildatabarang($id)
    {
        $this->db->select('*');
        $this->db->from('stok_barangmasuk');
        $this->db->where('id_barang', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function databarangeditmasuk($id)
    {
        $this->db->select('*');
        $this->db->from('stok_barangmasuk');
        $this->db->join('barang', 'barang.id_barang = stok_barangmasuk.id_barang');
        $this->db->where('stok_barangmasuk.id_stokbarangmasuk', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahbarangmasuk($data, $id)
    {
        $this->db->where('id_stokbarangmasuk', $id);
        return $this->db->update('stok_barangmasuk', $data);
    }

    public function hapusdatabarangmasuk($id)
    {
        $this->db->where('id_stokbarangmasuk', $id);
        return $this->db->delete('stok_barangmasuk');
    }
}

/* End of file Databarang_model.php */
