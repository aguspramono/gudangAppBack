<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPurchDetail;


class StockPurchDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPurchDetail = new StockPurchDetail();
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
            'countStockPurchDetail' => $this->StockPurchDetail->like('InvNum', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockPurchDetail()
    {
        $data = [
            'message' => 'success',
            'dataStockPurchDetail' => $this->StockPurchDetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPurchDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPurchDetail' => $this->StockPurchDetail->where('md5(InvNum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No PO
    public function getStockPurchDetailbynopo()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPurchDetail' => $this->StockPurchDetail->where('md5(NoPo)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPurchDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPurchDetail' => $this->StockPurchDetail->like('InvNum', $wherelike)->orLike('Gudang', $wherelike)->orLike('NoPo', $wherelike)->orLike('Kode', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPurchDetail->insert([
            'InvNum'                 => esc($this->request->getVar('InvNume')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'NoPo'                   => esc($this->request->getVar('NoPo')),
            'Kode'                   => esc($this->request->getVar('Kode')),
            'Qtty'                   => esc($this->request->getVar('Qtty')),
            'Harga'                  => esc($this->request->getVar('Harga')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'Alokasi'                => esc($this->request->getVar('Alokasi')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [

            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'NoPo'                   => esc($this->request->getVar('NoPo')),
            'Kode'                   => esc($this->request->getVar('Kode')),
            'Qtty'                   => esc($this->request->getVar('Qtty')),
            'Harga'                  => esc($this->request->getVar('Harga')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'Alokasi'                => esc($this->request->getVar('Alokasi')),
        ];
        $result = $this->StockPurchDetail->where('md5(InvNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPurchDetail->where('md5(InvNum)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
