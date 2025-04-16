<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Historyproductdetail;


class HistoryproductdetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Historyproductdetail = new Historyproductdetail();
    }

    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function index()
    {
        $data = [
            'message' => 'success',
            'datahistoryproductdetail' => $this->Historyproductdetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function getdatabywhere()
    {
        $kode = $this->request->getVar('kode');
        $gudang = $this->request->getVar('gudang');
        $periode = $this->request->getVar('periode');
        $data = [
            'message' => 'success',
            'datahistoryproductdetail' => $this->Historyproductdetail->where('Kode', $kode)->where('Gudang', $gudang)->where('Periode', $periode)->findAll()
        ];

        return $this->respond($data, 200);
    }
}
