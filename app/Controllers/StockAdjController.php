<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockAdj;


class StockAdjController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockAdj = new StockAdj();
    }

    //protected $modelName = 'App\Models\Tokenpush';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */


    //get data like field Nama
    public function index()
    {
        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countStockAdj' => $this->StockAdj->like('NoBukti', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockAdjbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockAdj' => $this->StockAdj->where('md5(NoBukti)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockAdj()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockAdj' => $this->StockAdj->like('NoBukti', $wherelike)->orLike('Kondisi', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {

        $this->StockAdj->insert([
            'NoBukti'           => esc($this->request->getVar('NoBukti')),
            'Tgl'               => esc($this->request->getVar('Tgl')),
            'Kondisi'           => esc($this->request->getVar('Kondisi')),
            'Keterangan'        => esc($this->request->getVar('Keterangan')),
            'TglUbah'           => esc($this->request->getVar('TglUbah')),
            'Username'          => esc($this->request->getVar('Username')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'               => esc($this->request->getVar('Tgl')),
            'Kondisi'           => esc($this->request->getVar('Kondisi')),
            'Keterangan'        => esc($this->request->getVar('Keterangan')),
            'TglUbah'           => esc($this->request->getVar('TglUbah')),
            'Username'          => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockAdj->where('md5(NoBukti)', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockAdj->where('md5(NoBukti)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
