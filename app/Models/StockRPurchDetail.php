<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockRPurchDetail extends Model
{
    protected $table            = 'stock_rpurchdetail';
    protected $primaryKey       = 'Renum';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Renum', 'InvNum', 'Kode', 'Qtty'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
