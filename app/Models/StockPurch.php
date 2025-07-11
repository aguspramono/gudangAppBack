<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class StockPurch extends Model
{
    protected $table            = 'stock_purch';
    protected $primaryKey       = 'InvNum';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'InvNum', 'sNo_Acc', 'PayDueDay', 'NominalPPn', 'NominalDisc', 'Disc', 'PPn', 'Keterangan', 'TglLunas', 'TglUbah', 'Username'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    public function cekPurch($noinv)
    {
        return $this->db->query("Select Tgl, Ifnull((select Gudang From stock_purchdetail Where InvNum=stock_purch.InvNum),'') Gudang From stock_purch Where md5(InvNum) = '" . md5($noinv) . "'");
    }
}
