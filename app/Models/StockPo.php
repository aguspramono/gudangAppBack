<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockPo extends Model
{
    protected $table            = 'stock_po';
    protected $primaryKey       = 'NoPo';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'NoPo', 'sNo_Acc', 'PayDueDay', 'Gudang', 'Disc', 'PPn', 'NominalPPn', 'NominalDisc', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
