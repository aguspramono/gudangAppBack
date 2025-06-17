<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockPesanan;


class StockPesananController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockPesanan = new StockPesanan();
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
        $wherelike  = $this->request->getVar('like');
        $optionlike = $this->request->getVar('option');
        $optionfilter   = $this->request->getVar('filter');
        $tanggaldari    = $this->request->getVar('tanggaldari');
        $tanggalsampai  = $this->request->getVar('tanggalsampai');
        $bulan          = $this->request->getVar('bulan');
        $tahun          = $this->request->getVar('tahun');
        $likeket        = "stock_pesanan.NoPesanan";
        if (empty($optionlike)) {
            $likeket = "stock_pesanan.NoPesanan";
        } elseif ($optionlike == "Nomor Pesanan") {
            $likeket = "stock_pesanan.NoPesanan";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_pesanandetail.Departemen";
        }

        $builder = $this->StockPesanan;
        $builder->select('stock_pesanan.Tgl As tanggal,stock_pesanan.NoPesanan as NoPesanan,stock_pesanandetail.Departemen');
        $builder->selectSum('stock_pesanandetail.Qtty');
        $builder->join('stock_pesanandetail', 'stock_pesanan.NoPesanan=stock_pesanandetail.NoPesanan', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_pesanan.Tgl>=', $tanggaldari);
            $builder->where('stock_pesanan.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_pesanan.Tgl)', $bulan);
            $builder->where('year(stock_pesanan.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_pesanan.Tgl)', $tahun);
        }

        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_pesanan.Tgl,stock_pesanan.NoPesanan,stock_pesanandetail.Departemen');

        $query = $builder->countAllResults();

        $data = [
            'message' => 'success',
            'countStockPesanan' => $query
        ];
        return $this->respond($data, 200);
    }

    //get data stock pesanan
    public function allStockPesanan()
    {
        //Select Stock_Pesanan.Tgl As 'Tanggal',Stock_Pesanan.NoPesanan As 'No.Pesanan',Stock_PesananDetail.Departemen,Sum(Stock_PesananDetail.Qtty) As 'Jlh Qtty' From (Stock_Pesanan Left Join Stock_PesananDetail On Stock_Pesanan.NoPesanan=Stock_PesananDetail.NoPesanan) Where Stock_Pesanan.NoPesanan Like '{arg}' Group By Stock_Pesanan.Tgl,Stock_Pesanan.NoPesanan Order By Stock_Pesanan.Tgl Desc,Stock_Pesanan.NoPesanan Desc
        $wherelike  = $this->request->getVar('like');
        $pageprev   = $this->request->getVar('pageprev');
        $page       = $this->request->getVar('page');
        $optionlike = $this->request->getVar('option');
        $optionfilter   = $this->request->getVar('filter');
        $tanggaldari    = $this->request->getVar('tanggaldari');
        $tanggalsampai  = $this->request->getVar('tanggalsampai');
        $bulan          = $this->request->getVar('bulan');
        $tahun          = $this->request->getVar('tahun');
        $likeket        = "stock_pesanan.NoPesanan";
        if (empty($optionlike)) {
            $likeket = "stock_pesanan.NoPesanan";
        } elseif ($optionlike == "Nomor Pesanan") {
            $likeket = "stock_pesanan.NoPesanan";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_pesanandetail.Departemen";
        }

        $builder = $this->StockPesanan;
        $builder->select('DATE_FORMAT(stock_pesanan.Tgl,"%d-%m-%Y") as tanggal,stock_pesanan.NoPesanan as NoPesanan,stock_pesanandetail.Departemen');
        $builder->selectSum('stock_pesanandetail.Qtty');
        $builder->join('stock_pesanandetail', 'stock_pesanan.NoPesanan=stock_pesanandetail.NoPesanan', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_pesanan.Tgl>=', $tanggaldari);
            $builder->where('stock_pesanan.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_pesanan.Tgl)', $bulan);
            $builder->where('year(stock_pesanan.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_pesanan.Tgl)', $tahun);
        }

        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_pesanan.Tgl,stock_pesanan.NoPesanan,stock_pesanandetail.Departemen');
        $builder->orderBy('stock_pesanan.Tgl DESC,stock_pesanan.NoPesanan DESC');

        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'datastockpesanan' => $query
        ];
        return $this->respond($data, 200);
    }


    //get data by field No Pesanan
    public function getStockPesananbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPesanan' => $this->StockPesanan->where('md5(NoPesanan)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockPesanan()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockPesanan' => $this->StockPesanan->like('NoPesanan', $wherelike)->orLike('Gudang', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function create()
    {
        $this->StockPesanan->insert([
            'NoPesanan'              => esc($this->request->getVar('NoPesanan')),
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Gudang'                 => esc($this->request->getVar('Gudang')),
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
            'Gudang'                 => esc($this->request->getVar('Gudang')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockPesanan->where('md5(NoPesanan)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->StockPesanan->where('md5(NoPesanan)', md5($id))->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
