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


        return $this->respond($data, 200);
    }
}
