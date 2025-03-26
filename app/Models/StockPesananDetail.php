<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockPesananDetail extends Model
{
    protected $table            = 'stock_pesanandetail';
    protected $primaryKey       = 'NoPesanan';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NoPesanan', 'Departemen', 'Kode', 'Qtty', 'TglClosing', 'Alokasi', 'Tglbutuh'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
