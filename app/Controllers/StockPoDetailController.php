<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPoDetail;


class StockPoDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPoDetail = new StockPoDetail();
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
            'countStockPoDetail' => $this->StockPoDetail->like('NoPo', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockPoDetail()
    {
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPoDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->where('md5(NoPo)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPoDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->like('NoPo', $wherelike)->orLike('Departemen', $wherelike)->orLike('NoPesanan', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPoDetail->insert([
            'NoPo'                   => esc($this->request->getVar('NoPo')),
            'Departemen'             => esc($this->request->getVar('Departemen')),
            'NoPesanan'              => esc($this->request->getVar('NoPesanan')),
            'Alokasi'                => esc($this->request->getVar('Alokasi')),
            'Kode'                   => esc($this->request->getVar('Kode')),
            'Qtty'                   => esc($this->request->getVar('Qtty')),
            'Harga'                  => esc($this->request->getVar('Harga')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'TglClosing'             => esc($this->request->getVar('TglClosing')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Departemen'             => esc($this->request->getVar('Departemen')),
            'NoPesanan'              => esc($this->request->getVar('NoPesanan')),
            'Alokasi'                => esc($this->request->getVar('Alokasi')),
            'Kode'                   => esc($this->request->getVar('Kode')),
            'Qtty'                   => esc($this->request->getVar('Qtty')),
            'Harga'                  => esc($this->request->getVar('Harga')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'TglClosing'             => esc($this->request->getVar('TglClosing')),
        ];
        $result = $this->StockPoDetail->where('md5(NoPo)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPoDetail->where('md5(NoPo)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
