<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockClosingPesananDetail;


class StockClosingPesananDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockClosingPesananDetail = new StockClosingPesananDetail();
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
            'countStockClosingPesananDetail' => $this->StockClosingPesananDetail->like('NoClosing', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockClosingPesananDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockClosingPesananDetail' => $this->StockClosingPesananDetail->where('md5(NoClosing)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockClosingPesananDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockClosingPesananDetail' => $this->StockClosingPesananDetail->like('NoClosing', $wherelike)->orLike('NoPesanan', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {

        $this->StockClosingPesananDetail->insert([
            'NoClosing'               => esc($this->request->getVar('NoClosing')),
            'NoPesanan'               => esc($this->request->getVar('NoPesanan')),
            'Kode'                    => esc($this->request->getVar('Kode')),
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'NoPesanan'               => esc($this->request->getVar('NoPesanan')),
            'Kode'                    => esc($this->request->getVar('Kode')),
        ];
        $result = $this->StockClosingPesananDetail->where('md5(NoClosing)', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockClosingPesananDetail->where('md5(NoClosing)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
