<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
//use App\Models\Stock;

class GlobalController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        //$this->Stock = new Stock();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function Calculate()
    {
        $this->db = \Config\Database::connect();
        //$query = $this->db->query("SELECT * FROM gudangoffline.master_gudang");
        $Tgl = $this->request->getVar('tgl');
        $Tgl1 = $this->request->getVar('tgl1');
        $cInvNum = $this->request->getVar('cinvnum');
        $cKode = $this->request->getVar('ckode');
        $cGudang = $this->request->getVar('cgudang');
        $BoolMutasi = $this->request->getVar('boolmutasi');
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

        $data = array([
            "message" => "success",
            "data" => $result
        ]);

        return $this->respond($data, 200);
    }
}
