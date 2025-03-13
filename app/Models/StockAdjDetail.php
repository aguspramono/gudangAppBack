<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockAdjDetail extends Model
{
    protected $table            = 'stock_adjdetail';
    protected $primaryKey       = 'NoBukti';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NoBukti', 'Kode', 'Gudang', 'Qtty', 'Harga'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
