<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockOut;


class StockOutController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockOut = new StockOut();
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
            'countStockOut' => $this->StockOut->like('InvNum', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get all data StockLunasHutang
    public function allStockOut()
    {
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockOutbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->where('md5(InvNum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockOut()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->like('InvNum', $wherelike)->orLike('Departemen', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockOut->insert([
            'InvNum'                 => esc($this->request->getVar('InvNum')),
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Departemen'             => esc($this->request->getVar('Departemen')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'Status'                 => esc($this->request->getVar('Status')),
            'keGudang'               => esc($this->request->getVar('keGudang')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Departemen'             => esc($this->request->getVar('Departemen')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'Status'                 => esc($this->request->getVar('Status')),
            'keGudang'               => esc($this->request->getVar('keGudang')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockOut->where('md5(InvNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockOut->where('md5(InvNum)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
