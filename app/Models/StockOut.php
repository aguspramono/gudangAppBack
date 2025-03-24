<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockOut extends Model
{
    protected $table            = 'stock_out';
    protected $primaryKey       = 'InvNum';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['InvNum', 'Tgl', 'Departemen', 'Keterangan', 'Status', 'keGudang', 'tglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
