<?php

namespace App\Models;


use CodeIgniter\Model;

class Cuti extends Model
{
    protected $table            = 'CUTI';
    protected $primaryKey       = 'IDCUTI';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['IDCUTI', 'IDUSER', 'TANGGALDARI', 'TANGGALSAMPAI', 'ALASANCUTI', 'JUMLAHCUTI', 'IDDIKETAHUI', 'IDDISETUJUI', 'TANGGALPENGAJUAN', 'TANGGALUPDATE', 'IDUSELOGIN', 'STATUSDIKET', 'STATUSDISET', 'STATUSCUTI'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

}
