<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Stock extends Model
{
    protected $table            = 'stock_purch';
    protected $primaryKey       = 'InvNum';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['Tgl', 'InvNum', 'sNo_Acc', 'PayDueDay', 'NominalPPn', 'NominalDisc'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    //protected $useTimestamps = true;
    //protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    public function c1($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang)
    {
        return $this->db->query("Select IfNull(Sum(stock_purchDetail.Qtty),0) As Jlh From stock_purch Left Join stock_purchdetail On stock_purch.InvNum=stock_purchdetail.InvNum Where stock_purch.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_purchdetail.Kode = '" . $cKode . "' And stock_purchdetail.Gudang = '" . $cGudang . "' And stock_purchdetail.InvNum <> '" . $cInvNum . "'");
    }

    public function c2($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang)
    {
        return $this->db->query("Select IfNull(Sum(stock_rpurchDetail.Qtty),0) As Jlh From stock_rpurch Left Join stock_rpurchdetail On stock_rpurch.ReNum=stock_rpurchdetail.ReNum Left Join stock_purchdetail On (stock_rpurchdetail.InvNum=stock_purchdetail.InvNum And stock_rpurchdetail.Kode=stock_purchdetail.Kode) Where stock_rpurch.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_rpurchdetail.Kode = '" . $cKode . "' And stock_purchdetail.Gudang = '" . $cGudang . "' And stock_rpurchdetail.ReNum <> '" . $cInvNum . "'");
    }

    public function c3($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang)
    {
        return $this->db->query("Select IfNull(Sum(stock_outdetail.Qtty),0) As Jlh From stock_out Left Join stock_outdetail On stock_out.InvNum=stock_outdetail.InvNum Where stock_out.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_outdetail.Kode = '" . $cKode . "' And stock_outdetail.Gudang = '" . $cGudang . "' And stock_outdetail.InvNum <> '" . $cInvNum . "'");
    }

    public function c4($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang)
    {
        return $this->db->query("Select IfNull(Sum(stock_adjdetail.Qtty),0) As Jlh From stock_adj Left Join stock_adjdetail On stock_adj.NoBukti=stock_adjdetail.NoBukti Where stock_adj.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_adjdetail.Kode = '" . $cKode . "' And stock_adjdetail.Gudang = '" . $cGudang . "' And stock_adjdetail.NoBukti <> '" . $cInvNum . "'");
    }

    public function c5($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang)
    {
        return $this->db->query("Select IfNull(Sum(stock_indetail.Qtty),0) As Jlh From stock_in Left Join stock_indetail On stock_in.NoBukti=stock_indetail.NoBukti Where stock_in.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_indetail.Kode = '" . $cKode . "' And stock_in.keGudang = '" . $cGudang . "' And stock_indetail.NoBukti <> '" . $cInvNum . "'");
    }

    public function closingBulanan1()
    {
        return $this->db->query("Select Tgl From master_aktifday");
    }

    public function closingBulanan2($cPeriodeApa)
    {
        return $this->db->query("Select Tgl From " . $cPeriodeApa . " Where Aktif=1");
    }
}
