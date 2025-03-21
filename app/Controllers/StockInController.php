<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockIn;


class StockInController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockIn = new StockIn();
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
            'countStockIn' => $this->StockIn->like('NoBukti', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockInbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockIn' => $this->StockIn->where('md5(NoBukti)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockIn()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockIn' => $this->StockIn->like('NoBukti', $wherelike)->orLike('drGudang', $wherelike)->orLike('keGudang', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockIn->insert([
            'NoBukti'               => esc($this->request->getVar('NoBukti')),
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'drGudang'              => esc($this->request->getVar('drGudang')),
            'keGudang'              => esc($this->request->getVar('keGudang')),
            'Keterangan'            => esc($this->request->getVar('keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'drGudang'              => esc($this->request->getVar('drGudang')),
            'keGudang'              => esc($this->request->getVar('keGudang')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockIn->where('md5(NoBukti', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockIn->where('md5(NoBukti)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
