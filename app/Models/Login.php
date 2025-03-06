<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table            = 'USERADMIN';
    protected $primaryKey       = 'USERID';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['USERID', 'USERNAME', 'PASSWORD', 'NAMA', 'STATUS','JENISKELAMIN','JABATAN'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
