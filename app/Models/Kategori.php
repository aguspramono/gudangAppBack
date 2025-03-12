<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table            = 'master_kategori';
    protected $primaryKey       = 'Kategori';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Kategori', 't_NoAkunStock', 't_NoAkunKas', 't_NoAkunHutang', 'k_NoAkunBiaya', 'k_NoAkunStock', 'a_NoAkunBiaya', 'a_NoAkunStock', 'Keterangan', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
