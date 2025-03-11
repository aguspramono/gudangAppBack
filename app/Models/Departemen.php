<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Departemen extends Model
{
    protected $table            = 'master_departemen';
    protected $primaryKey       = 'Departemen';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Departemen', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
