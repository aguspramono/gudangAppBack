<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Merk extends Model
{
    protected $table            = 'master_merek';
    protected $primaryKey       = 'Merek';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Merek', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
