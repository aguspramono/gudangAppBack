<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Gudang extends Model
{
    protected $table            = 'master_gudang';
    protected $primaryKey       = 'Gudang';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Gudang', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
