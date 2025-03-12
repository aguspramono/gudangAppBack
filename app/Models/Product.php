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

}
