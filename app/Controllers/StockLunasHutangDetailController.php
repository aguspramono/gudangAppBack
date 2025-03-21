<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockLunasHutangDetail;


class StockLunasHutangDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockLunasHutangDetail = new StockLunasHutangDetail();
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
            'countStockLunasHutangDetail' => $this->StockLunasHutangDetail->like('NoBukti', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get all data StockLunasHutang
    public function allStockLunasHutangDetail()
    {
        $data = [
            'message' => 'success',
            'dataStockLunasHutangDetail' => $this->StockLunasHutangDetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockLunasHutangDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockLunasHutangDetail' => $this->StockLunasHutangDetail->where('md5(NoBukti)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field NoBukti, drGudang. Show limit
    public function getStockLunasHutangDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockLunasHutangDetail' => $this->StockLunasHutangDetail->like('NoBukti', $wherelike)->orLike('InvNum', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockLunasHutangDetail->insert([
            'NoBukti'               => esc($this->request->getVar('NoBukti')),
            'InvNum'                => esc($this->request->getVar('InvNum')),
            'Bayar'                 => esc($this->request->getVar('Bayar')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [

            'InvNum'               => esc($this->request->getVar('InvNum')),
            'Bayar'                => esc($this->request->getVar('Bayar')),
        ];
        $result = $this->StockLunasHutangDetail->where('md5(NoBukti)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockLunasHutangDetail->where('md5(NoBukti)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
