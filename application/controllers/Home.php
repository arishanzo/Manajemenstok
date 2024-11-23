<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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

        if (date("H") < 4) {
            $greet = 'Selamat Malam | &nbsp;  <i class="fas fa-moon fa-2x  text-gray-300"></i>';
        } elseif (date("H") < 11) {
            $greet = 'Selamat Pagi | &nbsp; <i class="fas fa-sun fa-2x  text-gray-300"></i>';
        } elseif (date("H") < 16) {
            $greet = 'Selamat Siang';
        } elseif (date("H") < 18) {
            $greet = 'Selamat Sore';
        } else {
            $greet = 'Selamat Malam';
        }

        $hargapokok = $this->m_databarang->totalhargapokok();
        $terjual =  $this->m_barangkeluar->jumlahpenjualan();
        $totalpenjualan = $this->m_barangkeluar->hitungomset();


        $hargapokokpenjualan = $terjual['stokkeluar'] * $hargapokok['hargapokok'];
        $laba =   $hargapokokpenjualan - $totalpenjualan['sum'];


        if ($hargapokokpenjualan <= 0) {
            $presentase = 0;
        } else {
            $presentase = $laba / $hargapokokpenjualan * 100;
        }

        $id = $_SESSION['id_user'];

        $data = [
            'title' => 'Halaman Admin | CV CARAKA ABADI',
            'halaman' => 'User',
            'apps' => 'Aplikasi Manajemen Stok',
            'datasetting' =>  $this->m_setting->getdatasetting(),
            'totalbarang' => $this->m_databarang->totalbarang(),
            'totalbarangkeluar' => $this->m_barangkeluar->totalbarangkeluar(),
            'omset' => $this->m_barangkeluar->hitungomset(),
            'totalbarangmasuk' => $this->m_databarangmasuk->totalbarangmasuk(),
            'logaktivitas' => $this->m_user->getdataktivitasuser($id),
            'laba' => $laba,
            'presentase' => $presentase,
            'jam' => $greet,
            'app' => 'AMS'
            // 'current_user' => $this->m_auth->current_user(),
        ];
        $this->load->view('layout/head', $data);
        $this->load->view('layout/nav', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layout/foot', $data);
    }

    public function omset()
    {

        $databarang = $this->m_barangkeluar->getdatabarangkeluar();
        $no = 1;
        foreach ($databarang as  $value) {
            $tbody = array();
            $tbody[] = $no++;
            $tbody[] = $value['nama_barang'];
            $tbody[] = $value['stok_keluar'];
            $tbody[] = date("d F Y", strtotime($value['tgl_keluar']));


            $hargapokokpenjualan = $value['stok_keluar'] * $value['harga_pokokbarang'];
            $labalebersih = $value['nilai_barangkeluar']  - $hargapokokpenjualan;

            $persentase = $labalebersih / $hargapokokpenjualan;
            $totalpersentase = round($persentase * 100, 2);

            $tbody[] = 'Rp.' . number_format($labalebersih, 2, ",", ".");

            $tbody[] =  $totalpersentase . '%';

            if ($totalpersentase < 29) {
                $tbody[] = "<span class='badge badge-danger'>Barang Tidak Laku</span>";
            } else if ($totalpersentase < 59) {
                $tbody[] = "<span class='badge badge-primary'>Barang Cukup Laku</span>";
            } else {
                $tbody[] = "<span class='badge badge-success'>Terlaris</span>";
            }

            $data[] = $tbody;
        }

        if ($databarang) {
            echo json_encode(array('data' => $data));
        } else {
            echo json_encode(array('data' => 0));
        }
    }
}

/* End of file Home.php */
