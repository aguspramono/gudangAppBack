<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Historyproductdetail extends Model
{
    protected $table            = 'history_productdetail';
    protected $primaryKey       = 'Periode';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Periode', 'Kode', 'Gudang', 'sAwal', 'Temp', 'hBeli'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
