<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_barangkeluar extends CI_Model
{

    public function getdatabarangkeluar()
    {
        $this->db->select('*');
        $this->db->from('stok_barangkeluar');
        $this->db->join('barang', 'barang.id_barang = stok_barangkeluar.id_barang');

        return  $this->db->get()->result_array();
    }

    public function insertbarangkeluar($data)
    {
        return $this->db->insert('stok_barangkeluar', $data);
    }

    public function databarang()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $query = $this->db->get()->result();
        return $query;
    }

    public function hitungomset()
    {

        $date = date('Y-m-d');
        $this->db->select('sum(nilai_barangkeluar)');
        $this->db->from('stok_barangkeluar');
        $this->db->where('tgl_keluar', $date);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function jumlahpenjualan()
    {

        $date = date('Y-m-d');
        $this->db->select('sum(stok_keluar) as stokkeluar');
        $this->db->from('stok_barangkeluar');
        $this->db->where('tgl_keluar', $date);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function totalbarangkeluar()
    {
        $date = date('Y-m-d');
        $this->db->select('sum(stok_keluar)');
        $this->db->from('stok_barangkeluar');
        $this->db->where('tgl_keluar', $date);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function databarangkeluaredit($id)
    {
        $this->db->select('*');
        $this->db->from('stok_barangkeluar');
        $this->db->join('barang', 'barang.id_barang = stok_barangkeluar.id_barang');
        $this->db->where('id_stokbarangkeluar', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahbarangkeluar($data, $id)
    {
        $this->db->where('id_stokbarangkeluar', $id);
        return $this->db->update('stok_barangkeluar', $data);
    }

    public function hapusdatabarangkeluar($id)
    {
        $this->db->where('id_stokbarangkeluar', $id);
        return $this->db->delete('stok_barangkeluar');
    }
}

/* End of file Databarang_model.php */
