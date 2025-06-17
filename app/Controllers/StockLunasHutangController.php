<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockLunasHutang;


class StockLunasHutangController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockLunasHutang = new StockLunasHutang();
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
            'countStockLunasHutang' => $this->StockLunasHutang->like('NoBukti', $wherelike)->countAllResults()
        ];
        return $this->respond($data, 200);
    }

    //get data by ivnum
    public function getLunashutangbyivnum()
    {
        $wherelike = $this->request->getVar('ivnum');

        $builder = $this->StockLunasHutang;
        $builder->select("stock_lunashutang.Tgl,stock_lunashutang.NoBukti");
        $builder->join("Stock_LunasHutangDetail", "stock_lunashutang.NoBukti=stock_lunashutangdetail.NoBukti", "LEFT");
        $builder->where("stock_lunashutangdetail.InvNum", $wherelike);
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'dataStockLunasHutang' => $query
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockLunasHutang()
    {
        $data = [
            'message' => 'success',
            'dataStockLunasHutang' => $this->StockLunasHutang->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockLunasHutangbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockLunasHutang' => $this->StockLunasHutang->where('md5(NoBukti)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field NoBukti, drGudang. Show limit
    public function getStockLunasHutang()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockLunasHutang' => $this->StockLunasHutang->like('NoBukti', $wherelike)->orLike('sNo_Acc', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockLunasHutang->insert([
            'NoBukti'               => esc($this->request->getVar('NoBukti')),
            'Tgl'                   => esc($this->request->getVar('Tgl')),
            'sNo_Acc'               => esc($this->request->getVar('sNo_Acc')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
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
            'sNo_Acc'               => esc($this->request->getVar('sNo_Acc')),
            'Keterangan'            => esc($this->request->getVar('Keterangan')),
            'TglUbah'               => esc($this->request->getVar('TglUbah')),
            'Username'              => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockLunasHutang->where('md5(NoBukti)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockLunasHutang->where('md5(NoBukti)', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
