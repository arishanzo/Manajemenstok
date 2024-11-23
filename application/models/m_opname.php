<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_opname extends CI_Model
{

    public function getdataopname()
    {
        $this->db->select('*');
        $this->db->from('stok_opname');
        $this->db->join('barang', 'barang.id_barang = stok_opname.id_barang');

        return  $this->db->get()->result_array();
    }

    public function insertopname($tambahopname)
    {
        return $this->db->insert('stok_opname', $tambahopname);
    }

    public function dataopnameedit($id)
    {
        $this->db->select('*');
        $this->db->from('stok_opname');
        $this->db->join('barang', 'barang.id_barang = stok_opname.id_barang');
        $this->db->where('id_stokopname', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function prosesubahopname($data, $id)
    {
        $this->db->where('id_stokopname', $id);
        return $this->db->update('stok_opname', $data);
    }

    public function hapusdataopname($id)
    {
        $this->db->where('id_stokopname', $id);
        return $this->db->delete('stok_opname');
    }

    public function get_bln($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "Appril";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

/* End of file Databarang_model.php */
