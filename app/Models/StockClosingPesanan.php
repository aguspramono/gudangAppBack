<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockClosingPesanan extends Model
{
    protected $table            = 'stock_closingpesanan';
    protected $primaryKey       = 'NoClosing';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'NoClosing', 'Departemen', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
