<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockRPurchDetail;


class StockRPurchDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockRPurchDetail = new StockRPurchDetail();
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
            'countStockRPurchDetail' => $this->StockRPurchDetail->like('ReNum', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockRPurchDetail()
    {
        $data = [
            'message' => 'success',
            'dataStockRPurchDetail' => $this->StockRPurchDetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockRPurchDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockRPurchDetail' => $this->StockRPurchDetail->where('md5(Renum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockRPurchDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockRPurchDetail' => $this->StockRPurchDetail->like('ReNum', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockRPurchDetail->insert([
            'ReNum'           => esc($this->request->getVar('ReNum')),
            'InvNum'          => esc($this->request->getVar('InvNum')),
            'Kode'            => esc($this->request->getVar('Kode')),
            'Qtty'            => esc($this->request->getVar('Qtty')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [

            'InvNum'          => esc($this->request->getVar('InvNum')),
            'Kode'            => esc($this->request->getVar('Kode')),
            'Qtty'            => esc($this->request->getVar('Qtty')),
        ];
        $result = $this->StockRPurchDetail->where('md5(ReNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockRPurchDetail->where('md5(ReNum)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
