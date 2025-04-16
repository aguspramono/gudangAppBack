<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Stock;

class ClosingbulananController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Stock = new Stock();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function index()
    {

        $periode = $this->request->getVar('periode');
        $tgl = $this->request->getVar('tgl');
        $c1 = $this->Stock->closingBulanan1();
        $c2 = $this->Stock->closingBulanan2($periode);

        if ($c1->getNumRows() > 0) {
            $c1 = $c1->getResult();
            if ($tgl < $c1[0]->Tgl) {
                $data = array(
                    "message" => "Tanggal Harian yang aktif " . $Tgl . " proses dibatalkan",
                    "status" => false
                );
                //MessageBox.Show("Tanggal Harian yang aktif ( " + Convert.ToDateTime(mySqlDataReader["Tgl"]).Date.ToString("dd-MM-yyy") + " ), Proses diBatalkan?", "Info", MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                return $data;
            }
        }





        $data = [
            'message' => 'success',
            'dataaktifday' => $this->Aktifday->findAll()
        ];

        return $this->respond($data, 200);
    }
}
