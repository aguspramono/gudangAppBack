<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class ProductDetail extends Model
{
    protected $table            = 'master_productdetail';
    protected $primaryKey       = 'Kode';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Kode', 'Gudang', 'sAwal', 'Temp', 'hBeli'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
