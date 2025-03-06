<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Models\Tokenpush;
use App\Models\Pegawai;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class PegawaiController extends ResourceController
{

    public function __construct()
    {
        $this->Tokenpush = new Tokenpush();
        $this->Pegawai = new Pegawai();
    }



    protected $modelName = 'App\Models\Pegawai';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function index()
    {
        $nama = $this->request->getVar('nama');
        $data = [
            'message' => 'success',
            'datapegawai' => $this->Pegawai->like('NAMA', $nama)->orderBy('NAMA', 'ASC')->findAll()
        ];

        return $this->respond($data, 200);
    }


    public function detail()
    {
        $id = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datapegawai' => $this->Pegawai->where('ID', $id)->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function absensi()
    {
        $id = $this->request->getVar('id');
        $fromDate = $this->request->getVar('fromdate');
        $toDate = $this->request->getVar('todate');
        $data = [
            'message' => 'success',
            'dataabsensi' => $this->Pegawai->m_absensi($id, $fromDate, $toDate)->getResult()
        ];

        return $this->respond($data, 200);
    }
}
