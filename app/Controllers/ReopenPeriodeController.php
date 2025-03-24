<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Periode;

class ReopenPeriodeController extends ResourceController
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

    public function cekperiode()
    {
        $data = [
            'message' => 'success',
            'dataperiode' => $this->Periode->cekperiodemod()->getResult()
        ];

        return $this->respond($data, 200);
    }

    public function updateperiode($num)
    {

        $this->Periode->updatePeriodemod($num);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }
}
