<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Tokenpush extends Model
{
    protected $table            = 'TOKEN';
    protected $primaryKey       = 'idtoken';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['idtoken', 'token', 'iduserlogin', 'statuslogin', 'updatetime'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
