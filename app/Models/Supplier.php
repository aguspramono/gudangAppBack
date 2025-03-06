<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table            = 'master_supplier';
    protected $primaryKey       = 'sNo_Acc';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['sNo_Acc', 'Nama', 'Alamat', 'Kota', 'Phone', 'Email', 'TglUbah', 'Username', 'Person'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
