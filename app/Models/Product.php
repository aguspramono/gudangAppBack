<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Product extends Model
{
    protected $table            = 'master_product';
    protected $primaryKey       = 'Kode';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Kode', 'Nama', 'Merek', 'Kategori', 'Satuan', 'Spec', 'Lokasi', 'HargaEceran', 'HargaKanvas', 'HargaAgen', 'HargaBeli', 'hBeliEnd', 'Min', 'Max', 'TglUbah', 'Username', 'Showing'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    public function stokdistribusi($id)
    {
        if (empty($id)) {
            $whereID = "";
        } else {
            $whereID = "where master_gudang.Gudang='" . $id . "' ";
        }
        return $this->db->query("Select Distinct master_gudang.Gudang,master_productdetail.Temp As sAwal,master_productdetail.Temp As Beli, master_productdetail.Temp As 'Out',master_productdetail.Temp As MutIn, master_productdetail.Temp As Adj, master_productdetail.Temp As Sisa From master_gudang Left Join master_productdetail On master_gudang.Gudang=master_productdetail.Gudang " . $whereID . "");
    }

    public function renameCodeProduct($kodelama, $kodebaru)
    {
        $this->db->query("Update Stock_PurchDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
        $this->db->query("Update Stock_rPurchDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
        $this->db->query("Update Stock_SalesDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
        $this->db->query("Update Stock_rSalesDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
        $this->db->query("Update Stock_AdjDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
        $this->db->query("Update Stock_MutasiDetail Set Kode = '" . $kodebaru . "' Where Kode = '" . $kodelama . "'");
    }
}
