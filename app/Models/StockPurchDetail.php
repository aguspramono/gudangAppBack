<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockPurchDetail extends Model
{
    protected $table            = 'stock_purchdetail';
    protected $primaryKey       = 'InvNum';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['InvNum', 'Gudang', 'NoPo', 'Kode', 'Qtty', 'Harga', 'Disc', 'Alokasi'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
