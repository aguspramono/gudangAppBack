<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;


class LastupdateController extends ResourceController
{
    protected $modelName = 'App\Models\Lastupdate';
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
            'datalastupdate' => $this->model->findAll()
        ];

        return $this->respond($data, 200);
    }


}
