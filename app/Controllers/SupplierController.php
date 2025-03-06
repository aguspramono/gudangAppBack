<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Supplier;

header('Access-Control-Allow-Origin: *');

class SupplierController extends ResourceController
{
    public function __construct()
    {
        $this->Supplier = new Supplier();
    }

    //protected $modelName = 'App\Models\Tokenpush';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'datasupplier' => $this->Supplier->like('Nama', $wherelike)->orLike('Person', $wherelike)->limit(intval($page))->findAll()
        ];

        return $this->respond($data, 200);
    }
}
