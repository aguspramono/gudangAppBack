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
        $optionlike = $this->request->getVar('option');
        $optionfilter = $this->request->getVar('filter');
        $tanggaldari = $this->request->getVar('tanggaldari');
        $tanggalsampai = $this->request->getVar('tanggalsampai');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $likeket = "stock_purch.InvNum";
        if (empty($optionlike)) {
            $likeket = "stock_purch.InvNum";
        } elseif ($optionlike == "Nomor Invoice") {
            $likeket = "stock_purch.InvNum";
        } elseif ($optionlike == "Nama Supplier") {
            $likeket = "master_supplier.Nama";
        } elseif ($optionlike == "Gudang") {
            $likeket = "stock_purchdetail.Gudang";
        }
        $builder = $this->StockPurch;
        $builder->select("stock_purch.Tgl As Tanggal,stock_purch.InvNum As No Invoice,master_supplier.Nama As Nama Supplier,stock_purchdetail.Gudang");
        $builder->selectSum("stock_purchdetail.Qtty");
        $builder->join("stock_purchdetail", "stock_purch.InvNum=stock_purchdetail.InvNum", "LEFT");
        $builder->join("master_supplier", "stock_purch.sNo_Acc=master_supplier.sNo_Acc", "LEFT");

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_purch.Tgl>=', $tanggaldari);
            $builder->where('stock_purch.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_purch.Tgl)', $bulan);
            $builder->where('year(stock_purch.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_purch.Tgl)', $tahun);
        }
        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_purch.Tgl,stock_purch.InvNum,master_supplier.Nama,stock_purchdetail.Gudang');
        $query = $builder->countAllResults();

        $data = [
            'message' => 'success',
            'countStockPurch' =>  $query
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockPurch()
    {
        //Select Stock_Purch.Tgl As 'Tanggal',Stock_Purch.InvNum As 'No.Invoice',Master_Supplier.Nama As 'Nama Supplier',Stock_PurchDetail.Gudang,Sum(Stock_PurchDetail.Qtty) As 'Jlh Qtty' From (Stock_Purch Left Join Stock_PurchDetail On Stock_Purch.InvNum=Stock_PurchDetail.InvNum) Left Join Master_Supplier On Stock_Purch.sNo_Acc=Master_Supplier.sNo_Acc Where Stock_Purch.InvNum Like '{arg}' Group By Stock_Purch.Tgl,Stock_Purch.InvNum,Master_Supplier.Nama,Stock_PurchDetail.Gudang Order By Stock_Purch.Tgl Desc,Stock_Purch.InvNum Desc
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $optionlike = $this->request->getVar('option');
        $optionfilter = $this->request->getVar('filter');
        $tanggaldari = $this->request->getVar('tanggaldari');
        $tanggalsampai = $this->request->getVar('tanggalsampai');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $likeket = "stock_purch.InvNum";
        if (empty($optionlike)) {
            $likeket = "stock_purch.InvNum";
        } elseif ($optionlike == "Nomor Invoice") {
            $likeket = "stock_purch.InvNum";
        } elseif ($optionlike == "Nama Supplier") {
            $likeket = "master_supplier.Nama";
        } elseif ($optionlike == "Gudang") {
            $likeket = "stock_purchdetail.Gudang";
        }
        $builder = $this->StockPurch;
        $builder->select("DATE_FORMAT(stock_purch.Tgl,'%d-%m-%Y') As Tanggal,stock_purch.InvNum As No Invoice,master_supplier.Nama As Nama Supplier,stock_purchdetail.Gudang");
        $builder->selectSum("stock_purchdetail.Qtty");
        $builder->join("stock_purchdetail", "stock_purch.InvNum=stock_purchdetail.InvNum", "LEFT");
        $builder->join("master_supplier", "stock_purch.sNo_Acc=master_supplier.sNo_Acc", "LEFT");

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_purch.Tgl>=', $tanggaldari);
            $builder->where('stock_purch.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_purch.Tgl)', $bulan);
            $builder->where('year(stock_purch.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_purch.Tgl)', $tahun);
        }
        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_purch.Tgl,stock_purch.InvNum,master_supplier.Nama,stock_purchdetail.Gudang');
        $builder->orderBy('stock_purch.Tgl DESC,stock_purch.InvNum DESC');
        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'dataStockPurch' => $query
        ];

        return $this->respond($data, 200);
    }

    public function cekPurchCont()
    {
        $wherelike = $this->request->getVar('ivnum');

        $data = [
            'message' => 'success',
            'dataStockPurch' => $this->StockPurch->cekPurch($wherelike)->getResult()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockPurchbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPurch' => $this->StockPurch->join('master_supplier', 'master_supplier.sNo_Acc=stock_purch.sNo_Acc', 'LEFT')->where('md5(stock_purch.InvNum)', md5($wherelike))->findAll()
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
            'sNo_Acc'                => esc($this->request->getVar('sNo_Acc')),
            'PayDueDay'             => esc($this->request->getVar('PayDueDay')),
            'NominalPPn'            => esc($this->request->getVar('NominalPPn')),
            'NominalDisc'           => esc($this->request->getVar('NominalDisc')),
            'Disc'                  => esc($this->request->getVar('Disc')),
            'PPn'                   => esc($this->request->getVar('PPn')),
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
        $this->StockPurch->where('md5(InvNum)', md5($id))->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
