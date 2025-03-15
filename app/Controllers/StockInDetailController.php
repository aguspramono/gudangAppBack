<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockInDetail;


class StockInDetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockInDetail = new StockInDetail();
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
            'countStockInDetail' => $this->StockInDetail->like('NoBukti', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get data by field No ACC
    public function getStockInDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockInDetail' => $this->StockInDetail->where('md5(NoBukti)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getStockInDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockInDetail' => $this->StockInDetail->like('NoBukti', $wherelike)->orLike('InvNum', $wherelike)->orLike('Kode', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockInDetail->insert([
            'NoBukti'               => esc($this->request->getVar('NoBukti')),
            'InvNum'                => esc($this->request->getVar('InvNum')),
            'Kode'                  => esc($this->request->getVar('Kode')),
            'Qtty'                  => esc($this->request->getVar('Qtty')),
            'Alokasi'               => esc($this->request->getVar('Alokasi')),

        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'InvNum'                => esc($this->request->getVar('InvNum')),
            'Kode'                  => esc($this->request->getVar('Kode')),
            'Qtty'                  => esc($this->request->getVar('Qtty')),
            'Alokasi'               => esc($this->request->getVar('Alokasi')),
        ];
        $result = $this->StockInDetail->where('md5(NoBukti', $id)->set($data)->update();

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockInDetail->where('md5(NoBukti)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
