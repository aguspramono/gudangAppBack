<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Aktifday extends Model
{
    protected $table            = 'master_aktifday';
    protected $primaryKey       = 'Tgl';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    public function updateaktifdaymod($tanggal)
    {
        $this->db->query("update master_AktifDay Set Tgl='" . $tanggal . "'");

        return "success";
    }
}
