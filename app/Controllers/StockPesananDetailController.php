<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPesananDetail;


class StockPesananDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPesananDetail = new StockPesananDetail();
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
            'countStockPesananDetail' => $this->StockPesananDetail->like('NoPesanan', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get all data StockLunasHutang
    public function allStockPesananDetail()
    {
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPesananDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->where('md5(NoPesanan)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPesananDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->like('NoPesanan', $wherelike)->orLike('Departemen', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPesananDetail->insert([
            'NoPesanan'                  => esc($this->request->getVar('NoPesanan')),
            'Departemen'                 => esc($this->request->getVar('Departemen')),
            'Kode'                       => esc($this->request->getVar('Kode')),
            'Qtty'                       => esc($this->request->getVar('Qtty')),
            'TglClosing'                 => esc($this->request->getVar('TglClosing')),
            'Alokasi'                    => esc($this->request->getVar('Alokasi')),
            'TglButuh'                   => esc($this->request->getVar('TglButuh')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Departemen'                 => esc($this->request->getVar('Departemen')),
            'Kode'                       => esc($this->request->getVar('Kode')),
            'Qtty'                       => esc($this->request->getVar('Qtty')),
            'TglClosing'                 => esc($this->request->getVar('TglClosing')),
            'Alokasi'                    => esc($this->request->getVar('Alokasi')),
            'TglButuh'                   => esc($this->request->getVar('TglButuh')),
        ];
        $result = $this->StockPesananDetail->where('md5(NoPesanan)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPesananDetail->where('md5(NoPesanan)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
