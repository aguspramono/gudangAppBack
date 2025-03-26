<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPurch;


class StockPurchController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPurch = new StockPurch();
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
            'countStockPurch' => $this->StockPurch->like('InvNum', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockPurch()
    {
        $data = [
            'message' => 'success',
            'dataStockPurch' => $this->StockPurch->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPurchbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPurch' => $this->StockPurch->where('md5(InvNum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPurch()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPurch' => $this->StockPurch->like('InvNum', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPurch->insert([
            'InvNum'                => esc($this->request->getVar('InvNum')),
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'sNoAcc'                => esc($this->request->getVar('sNoAcc')),
            'PayDueDay'             => esc($this->request->getVar('PayDueDay')),
            'NominalPPn'            => esc($this->request->getVar('NominalPPn')),
            'NominalDisc'           => esc($this->request->getVar('NominalDisc')),
            'Disc'                  => esc($this->request->getVar('Disc')),
            'PPn'                   => esc($this->request->getVar('PPn')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglLunas'              => esc($this->request->getVar('TglLunas')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),


        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {
        $data = [

            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'sNoAcc'                => esc($this->request->getVar('sNoAcc')),
            'PayDueDay'             => esc($this->request->getVar('PayDueDay')),
            'NominalPPn'            => esc($this->request->getVar('NominalPPn')),
            'NominalDisc'           => esc($this->request->getVar('NominalDisc')),
            'Disc'                  => esc($this->request->getVar('Disc')),
            'PPn'                   => esc($this->request->getVar('PPn')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglLunas'              => esc($this->request->getVar('TglLunas')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockPurch->where('md5(InvNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPurch->where('md5(InvNum)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
