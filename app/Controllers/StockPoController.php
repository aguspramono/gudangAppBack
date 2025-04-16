<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPo;
use App\Models\Stock;


class StockPoController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPo = new StockPo();
        $this->Stock = new Stock();
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
        $likeket = "stock_po.NoPo";
        if (empty($optionlike)) {
            $likeket = "stock_po.NoPo";
        } elseif ($optionlike == "Nomor PO") {
            $likeket = "stock_po.NoPo";
        } elseif ($optionlike == "Nama Supplier") {
            $likeket = "master_supplier.Nama";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_podetail.Departemen";
        }

        $builder = $this->StockPo;
        $builder->select('DATE_FORMAT(stock_po.Tgl,"%d-%m-%Y") as Tanggal,stock_po.NoPo as Nomor PO,master_supplier.Nama as Nama Supplier,stock_podetail.Departemen');
        $builder->selectSum('stock_podetail.Qtty');
        $builder->join('stock_podetail', 'stock_po.NoPo=stock_podetail.NoPo', 'LEFT');
        $builder->join('master_supplier', 'master_supplier.sNo_Acc=stock_po.sNo_Acc', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_po.Tgl>=', $tanggaldari);
            $builder->where('stock_po.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_po.Tgl)', $bulan);
            $builder->where('year(stock_po.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_po.Tgl)', $tahun);
        }
        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_po.Tgl,stock_po.NoPo,master_supplier.Nama,stock_podetail.Departemen');
        $query = $builder->countAllResults();


        $data = [
            'message' => 'success',
            'countStockPo' =>  $query
        ];
        return $this->respond($data, 200);
    }


    //get all data stock po
    public function stockpodata()
    {
        //Select Stock_PO.Tgl As 'Tanggal',Stock_PO.NoPo As 'No.PO',Master_Supplier.Nama As 'Nama Supplier',Stock_PODetail.Departemen,Sum(Stock_PODetail.Qtty) As 'Jlh Qtty' From (Stock_PO Left Join Stock_PODetail On Stock_PO.NoPo=Stock_PODetail.NoPo) Left Join Master_Supplier On Stock_PO.sNo_Acc=Master_Supplier.sNo_Acc Where Stock_PO.NoPo Like '{arg}' Group By Stock_PO.Tgl,Stock_PO.NoPo,Master_Supplier.Nama,Stock_PODetail.Departemen Order By Stock_PO.Tgl Desc,Stock_PO.NoPo Desc
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $optionlike = $this->request->getVar('option');
        $optionfilter = $this->request->getVar('filter');
        $tanggaldari = $this->request->getVar('tanggaldari');
        $tanggalsampai = $this->request->getVar('tanggalsampai');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');
        $likeket = "stock_po.NoPo";
        if (empty($optionlike)) {
            $likeket = "stock_po.NoPo";
        } elseif ($optionlike == "Nomor PO") {
            $likeket = "stock_po.NoPo";
        } elseif ($optionlike == "Nama Supplier") {
            $likeket = "master_supplier.Nama";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_podetail.Departemen";
        }

        $builder = $this->StockPo;
        $builder->select('DATE_FORMAT(stock_po.Tgl,"%d-%m-%Y") as Tanggal,stock_po.NoPo as Nomor PO,master_supplier.Nama as Nama Supplier,stock_podetail.Departemen');
        $builder->selectSum('stock_podetail.Qtty');
        $builder->join('stock_podetail', 'stock_po.NoPo=stock_podetail.NoPo', 'LEFT');
        $builder->join('master_supplier', 'master_supplier.sNo_Acc=stock_po.sNo_Acc', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_po.Tgl>=', $tanggaldari);
            $builder->where('stock_po.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_po.Tgl)', $bulan);
            $builder->where('year(stock_po.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_po.Tgl)', $tahun);
        }
        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_po.Tgl,stock_po.NoPo,master_supplier.Nama,stock_podetail.Departemen');
        $builder->orderBy('stock_po.Tgl DESC,stock_po.NoPo DESC');
        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'datastockpo' => $query
        ];
        return $this->respond($data, 200);
    }

    //closing bulanan
    public function closingBulananFun()
    {
        print_r($this->Stock->closingBulanan());
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
