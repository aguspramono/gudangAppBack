<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockInDetail extends Model
{
    protected $table            = 'stock_indetail';
    protected $primaryKey       = 'NoBukti';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NoBukti', 'InvNum', 'Kode', 'Qtty', 'Alokasi'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
