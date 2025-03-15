<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockIn extends Model
{
    protected $table            = 'stock_in';
    protected $primaryKey       = 'NoBukti';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'NoBukti', 'drGudang', 'keGudang', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
