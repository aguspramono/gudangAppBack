<?php

namespace App\Models;

use CodeIgniter\Model;

class Lastupdate extends Model
{
    protected $table            = 'LASTUPDATE';
    protected $primaryKey       = 'idLASTUPDATE';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['idLASTUPDATE', 'lastUpdate'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
