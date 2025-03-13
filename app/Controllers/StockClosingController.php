<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockClosing;


class StockClosingController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockClosing = new StockClosing();
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
            'countStockClosing' => $this->StockClosing->like('NoClosing', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockClosingbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockClosing' => $this->StockClosing->where('md5(NoClosing)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockClosing()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockClosing' => $this->StockClosing->like('NoClosing', $wherelike)->orLike('Keterangan', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {

        $this->StockClosing->insert([
            'Tgl'             => esc($this->request->getVar('Tgl')),
            'NoClosing'       => esc($this->request->getVar('NoClosing')),
            'sNo_Acc'         => esc($this->request->getVar('sNo_Acc')),
            'Keterangan'      => esc($this->request->getVar('Keterangan')),
            'TglUbah'         => esc($this->request->getVar('TglUbah')),
            'Username'        => esc($this->request->getVar('Username')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'             => esc($this->request->getVar('Tgl')),
            'sNo_Acc'         => esc($this->request->getVar('sNo_Acc')),
            'Keterangan'      => esc($this->request->getVar('Keterangan')),
            'TglUbah'         => esc($this->request->getVar('TglUbah')),
            'Username'        => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockClosing->where('md5(NoClosing)', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockClosing->where('md5(NoClosing)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
