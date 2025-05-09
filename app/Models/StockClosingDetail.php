<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockClosingDetail extends Model
{
    protected $table            = 'stock_closingdetail';
    protected $primaryKey       = 'NoClosing';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NoClosing', 'NoPo', 'Kode'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
