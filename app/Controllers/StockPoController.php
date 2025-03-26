<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPo;


class StockPoController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPo = new StockPo();
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
            'countStockPo' => $this->StockPo->like('NoPo', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);;
    }

    //get all data StockLunasHutang
    public function allStockPo()
    {
        $data = [
            'message' => 'success',
            'dataStockPo' => $this->StockPo->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPobyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPo' => $this->StockPo->where('md5(NoPo)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPo()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPo' => $this->StockPo->like('NoPo', $wherelike)->orLike('sNo_Acc', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPo->insert([
            'NoPo'                   => esc($this->request->getVar('NoPo')),
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'sNo_Acc'                => esc($this->request->getVar('sNo_Acc')),
            'PayDueDay'              => esc($this->request->getVar('PayDueDay')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'PPn'                    => esc($this->request->getVar('PPn')),
            'NominalPPn'             => esc($this->request->getVar('NominalPPn')),
            'NominalDisc'            => esc($this->request->getVar('NominalDisc')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
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
            'sNo_Acc'                => esc($this->request->getVar('sNo_Acc')),
            'PayDueDay'              => esc($this->request->getVar('PayDueDay')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'Disc'                   => esc($this->request->getVar('Disc')),
            'PPn'                    => esc($this->request->getVar('PPn')),
            'NominalPPn'             => esc($this->request->getVar('NominalPPn')),
            'NominalDisc'            => esc($this->request->getVar('NominalDisc')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockPo->where('md5(NoPo)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPo->where('md5(NoPo)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
