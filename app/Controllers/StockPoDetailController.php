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
        $optionlike = $this->request->getVar('option');
        $optionfilter = $this->request->getVar('filter');
        $tanggaldari = $this->request->getVar('tanggaldari');
        $tanggalsampai = $this->request->getVar('tanggalsampai');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $likeket = "stock_podetail.Kode";
        if (empty($optionlike)) {
            $likeket = "stock_podetail.NoPo";
        } elseif ($optionlike == "Nomor PO") {
            $likeket = "stock_podetail.NoPo";
        } elseif ($optionlike == "Nama Barang") {
            $likeket = "master_product.Nama";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_podetail.Departemen";
        } elseif ($optionlike == "Kode Barang") {
            $likeket = "stock_podetail.Kode";
        }

        $builder = $this->StockPoDetail;
        $builder->select("stock_po.Tgl,stock_podetail.NoPo,stock_podetail.Kode,master_product.Nama,stock_podetail.Departemen,stock_podetail.Alokasi,stock_podetail.Qtty");
        $builder->join("stock_po", "stock_po.NoPo=stock_podetail.NoPo", 'LEFT');
        $builder->join("master_product", "master_product.Kode=stock_podetail.Kode", 'LEFT');


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
        $query = $builder->countAllResults();

        $wherelike = $this->request->getVar('like');
        $data = [
            'message' => 'success',
            'countStockPoDetail' => $query
        ];
        return $this->respond($data, 200);
    }

    //get data item po where kode barang
    public function dataitempobykodebarang()
    {

        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $optionlike = $this->request->getVar('option');
        $optionfilter = $this->request->getVar('filter');
        $tanggaldari = $this->request->getVar('tanggaldari');
        $tanggalsampai = $this->request->getVar('tanggalsampai');
        $bulan = $this->request->getVar('bulan');
        $tahun = $this->request->getVar('tahun');

        $likeket = "stock_podetail.Kode";
        if (empty($optionlike)) {
            $likeket = "stock_podetail.NoPo";
        } elseif ($optionlike == "Nomor PO") {
            $likeket = "stock_podetail.NoPo";
        } elseif ($optionlike == "Nama Barang") {
            $likeket = "master_product.Nama";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_podetail.Departemen";
        } elseif ($optionlike == "Kode Barang") {
            $likeket = "stock_podetail.Kode";
        }

        $builder = $this->StockPoDetail;
        $builder->select("DATE_FORMAT(stock_po.Tgl,'%d-%m-%Y') as Tgl,stock_podetail.NoPo,stock_podetail.Kode,master_product.Nama,stock_podetail.Departemen,stock_podetail.Alokasi,stock_podetail.Qtty");
        $builder->join("stock_po", "stock_po.NoPo=stock_podetail.NoPo", 'LEFT');
        $builder->join("master_product", "master_product.Kode=stock_podetail.Kode", 'LEFT');


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
        $builder->orderBy("stock_po.Tgl DESC,stock_podetail.NoPo DESC");
        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $query
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

    //get data by field No Po
    public function getStockPoDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->where('md5(NoPo)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No Po & Kode Barang
    public function getStockpodetailbyidandkodebarang()
    {
        $wherelike = $this->request->getVar('id');
        $wherelike2 = $this->request->getVar('kodebarang');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->where('md5(NoPo)', md5($wherelike))->where('md5(Kode)', md5($wherelike2))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field NoPo and date closing
    public function getStockPoDetailbynopo()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->where('md5(NoPo)', md5($wherelike))->where('TglClosing Is Not Null', NULL, FALSE)->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field nopo only
    public function getStockPoDetailbynoponly()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPoDetail' => $this->StockPoDetail->join('master_product', 'master_product.Kode=stock_podetail.Kode', 'LEFT')->where('md5(NoPo)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //get data by field nopesanan
    public function getStockPoDetailbynopesanan()
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

    //Batch Insert
    public function createbatch()
    {
        $dataval = $this->request->getPost('data');
        $departemen = $this->request->getPost('depart');
        $nopo = $this->request->getPost('nopo');
        $data = array();
        $index = 0;

        foreach ($dataval as $dataitem) {
            array_push($data, array(
                'NoPo'          => $nopo,
                'Departemen'    => $departemen,
                'Kode'          => $dataitem['kodebarang'],
                'NoPesanan'     => $dataitem['nomorpesanan'],
                'Alokasi'       => $dataitem['alokasi'],
                'Qtty'          => $dataitem['qtybarang'],
                'Harga'         => $dataitem['hargabeliend'],
                'Disc'          => $dataitem['diskonbarang'],
            ));

            $index++;
        }

        $this->StockPoDetail->insertBatch($data);

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
        $this->StockPoDetail->where('md5(NoPo)', md5($id))->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
