<?php

namespace App\Models;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\Model;

class Globalfunc extends Model
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

    public function calculate($Tgl, $Tgl1, $cInvNum, $cKode, $cGudang, $BoolMutasi)
    {
        $result = 0;
        $num = 0;
        $num2 = 0;
        $query = "";

        $query = $this->db->query("Select Periode,Aktif,Tgl From stock_periode Where Tgl <= '" . $Tgl . "' Order By Tgl Desc");
        if ($query->getNumRows() <= 0) {
            $query = $this->db->query("Select Periode,Aktif,Tgl From stock_periode Where Tgl >= '" . $Tgl . "' Order By Tgl");
        }

        $query = $query->getResult();
        $num2 = intval($query[0]->Periode);
        $Tgl = date('Y-m-d', strtotime($query[0]->Tgl)) . " 00:00:00";



        if (intval($query[0]->Aktif == 1)) {
            $query = $this->db->query("Select sAwal From master_productdetail Where Kode = '" . $cKode . "' And Gudang = '" . $cGudang . "'");
        } else {
            $query = $this->db->query("Select sAwal From history_productdetail Where Kode = '" . $cKode . "' And Gudang = '" . $cGudang . "' And Periode = " . $num2 . "");
        }


        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = floatval($query[0]->sAwal);
        }

        $query = $this->db->query("Select IfNull(Sum(stock_purchdetail.Qtty),0) As Jlh From stock_purch Left Join stock_purchdetail On stock_purch.InvNum=stock_purchdetail.InvNum Where stock_purch.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_purchdetail.Kode = '" . $cKode . "' And stock_purchdetail.Gudang = '" . $cGudang . "' And stock_purchdetail.InvNum <> '" . $cInvNum . "'");
        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = $num + floatval($query[0]->Jlh);
        }

        $query = $this->db->query("Select IfNull(Sum(stock_rpurchdetail.Qtty),0) As Jlh From stock_rpurch Left Join stock_rpurchdetail On stock_rpurch.ReNum=stock_rpurchdetail.ReNum Left Join stock_purchdetail On (stock_rpurchdetail.InvNum=stock_purchdetail.InvNum And stock_rpurchdetail.Kode=stock_purchdetail.Kode) Where stock_rpurch.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_rpurchdetail.Kode = '" . $cKode . "' And stock_purchdetail.Gudang = '" . $cGudang . "' And stock_rpurchdetail.ReNum <> '" . $cInvNum . "'");
        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = $num - floatval($query[0]->Jlh);
        }

        $query = $this->db->query("Select IfNull(Sum(stock_outdetail.Qtty),0) As Jlh From stock_out Left Join stock_outdetail On stock_out.InvNum=stock_outdetail.InvNum Where stock_out.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_outdetail.Kode = '" . $cKode . "' And stock_outdetail.Gudang = '" . $cGudang . "' And stock_outdetail.InvNum <> '" . $cInvNum . "'");
        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = $num - floatval($query[0]->Jlh);
        }

        $query = $this->db->query("Select IfNull(Sum(stock_adjdetail.Qtty),0) As Jlh From stock_adj Left Join stock_adjdetail On stock_adj.NoBukti=stock_adjdetail.NoBukti Where stock_adj.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_adjdetail.Kode = '" . $cKode . "' And stock_adjdetail.Gudang = '" . $cGudang . "' And stock_adjdetail.NoBukti <> '" . $cInvNum . "'");
        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = $num - floatval($query[0]->Jlh);
        }

        $query = $this->db->query("Select IfNull(Sum(stock_indetail.Qtty),0) As Jlh From stock_in Left Join stock_indetail On stock_in.NoBukti=stock_indetail.NoBukti Where stock_in.Tgl Between '" . $Tgl . "' And '" . $Tgl1 . "' And stock_indetail.Kode = '" . $cKode . "' And stock_in.keGudang = '" . $cGudang . "' And stock_indetail.NoBukti <> '" . $cInvNum . "'");
        if ($query->getNumRows() > 0) {
            $query = $query->getResult();
            $num = $num + floatval($query[0]->Jlh);
        }

        $result = $num;

        return $result;
    }

    public function AlertMinusStock($cProdCod, $cStock, $iSaldo, $iQtty)
    {
        if ((floatval($iSaldo) - floatval($iQtty)) < 0) {
            $response = ['message' => 'Sisa Stock Untuk Kode ' . $cStock . ' (' . $cProdCod . ') = ' . $iSaldo . '. Periksa kembali', 'status' => false];
        } else {
            $response = ['message' => 'success', 'status' => true];
        }
        return $response;
    }

    public function closeBulanan($tgl, $periode)
    {
        $c1 = $this->db->query("Select Tgl From master_aktifday");
        $c2 = $this->db->query("Select Tgl From " . $periode . " Where Aktif=1");

        if ($c1->getNumRows() > 0) {
            $c1 = $c1->getResult();


            if (date($tgl) < date($c1[0]->Tgl)) {
                $data = array([
                    "message" => "Tanggal Harian yang aktif " . date('d-m-Y', strtotime($tgl)) . " proses dibatalkan",
                    "status" => false
                ]);
            }
        }

        if ($c2->getNumRows() > 0) {
            $c2 = $c2->getResult();
            if (date($tgl) < date($c2[0]->Tgl)) {
                $data = array([
                    "message" => "Periode Untuk Tanggal  " . date('d-m-Y', strtotime($tgl)) . " Sudah diTutup. Perubahan Data Tidak diIzinkan...!!!",
                    "status" => false
                ]);
            } else {
                $data = array([
                    "message" => "success",
                    "status" => true
                ]);
            }
        } else {
            $data = array([
                "message" => "Periode Stock Belum diAktifkan, Hubungi Administrator...!!!",
                "status" => false
            ]);
        }

        return $data;
    }
}
