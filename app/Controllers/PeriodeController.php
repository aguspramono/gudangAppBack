<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Periode;

class PeriodeController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->Periode = new Periode();
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
            'dataperiode' => $this->Periode->where('Aktif', 1)->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function periodebytgldown()
    {
        $wherelike = $this->request->getVar('tgl');
        $data = [
            'message' => 'success',
            'dataperiode' => $this->Periode->where('Tgl<=', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function periodebytglup()
    {
        $wherelike = $this->request->getVar('tgl');
        $data = [
            'message' => 'success',
            'dataperiode' => $this->Periode->where('Tgl>=', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }
}
