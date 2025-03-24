<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Periode extends Model
{
    protected $table            = 'stock_periode';
    protected $primaryKey       = 'Periode';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Periode', 'Tgl', 'Tgl1', 'Aktif', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    public function cekperiodemod()
    {

        return $this->db->query("Select Periode, DATE_FORMAT(Tgl,'%d-%m-%Y') as Tgl, DATE_FORMAT(Tgl1,'%d-%m-%Y') as Tgl1 From stock_periode Where Periode = (Select Periode - 1 From stock_periode Where Aktif = 1)");
    }

    public function updatePeriodemod($num)
    {
        $this->db->query("update master_productdetail Set sAwal = 0");
        $this->db->query("update master_productdetail Set sAwal = Ifnull((Select sAwal From history_productdetail Where Periode = " . $num . " And Kode = master_productdetail.Kode And Gudang = master_productdetail.Gudang),0)");
        $this->db->query("delete from history_product Where Periode = " . $num . "");
        $this->db->query("delete from history_productdetail Where Periode = " . $num . "");
        $this->db->query("delete from stock_periode Where Aktif = 1");
        $this->db->query("update stock_periode Set Aktif = 1 where Periode = " . $num . "");

        return "success";
    }
}
