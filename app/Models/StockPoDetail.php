<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockPoDetail extends Model
{
    protected $table            = 'stock_podetail';
    protected $primaryKey       = 'NoPo';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NoPo', 'Departemen', 'NoPesanan', 'Alokasi', 'Kode', 'Qtty', 'Harga', 'Disc', 'TglClosing'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


}
