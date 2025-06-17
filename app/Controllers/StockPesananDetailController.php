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
        } elseif ($optionlike == "Kode Barang") {
            $likeket = "stock_pesanandetail.Kode";
        } elseif ($optionlike == "Nama Barang") {
            $likeket = "master_product.Nama";
        }

        $builder = $this->StockPesananDetail;
        $builder->select('stock_pesanandetail.*,stock_pesanan.Tgl,master_product.Nama');
        $builder->join('stock_pesanan', 'stock_pesanan.NoPesanan=stock_pesanandetail.NoPesanan', 'LEFT');
        $builder->join('master_product', 'master_product.Kode=stock_pesanandetail.Kode', 'LEFT');

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
        $query = $builder->countAllResults();

        $data = [
            'message' => 'success',
            'countStockPesananDetail' => $query
        ];
        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockPesananDetail()
    {
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
        } elseif ($optionlike == "Kode Barang") {
            $likeket = "stock_pesanandetail.Kode";
        } elseif ($optionlike == "Nama Barang") {
            $likeket = "master_product.Nama";
        }

        $builder = $this->StockPesananDetail;
        $builder->select('stock_pesanandetail.*,DATE_FORMAT(stock_pesanan.Tgl,"%d-%m-%Y") as tanggal,master_product.Nama');
        $builder->join('stock_pesanan', 'stock_pesanan.NoPesanan=stock_pesanandetail.NoPesanan', 'LEFT');
        $builder->join('master_product', 'master_product.Kode=stock_pesanandetail.Kode', 'LEFT');

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
        $builder->orderBy('stock_pesanan.Tgl DESC,stock_pesanan.NoPesanan DESC');

        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'datapesananbarangdetail' => $query
        ];
        return $this->respond($data, 200);
    }

    //get data by field nopesanan and tgl closing
    public function getDetailpesananbynopestglclosing()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->where('md5(NoPesanan)', md5($wherelike))->where('TglClosing Is Not Null', NULL, FALSE)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data by field nomor pesanan and tgl closing
    public function getStockPesananDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $kodebarang = $this->request->getVar('kodebarang');
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->where('md5(NoPesanan)', md5($wherelike))->where('md5(Kode)', md5($kodebarang))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data by field nomor pesanan only
    public function getStockPesananDetailbynopesonly()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockPesananDetail' => $this->StockPesananDetail->join('master_product', 'master_product.Kode=stock_pesanandetail.Kode', 'LEFT')->where('md5(NoPesanan)', md5($wherelike))->findAll()
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

    public function createbatch()
    {
        $dataval = $this->request->getPost('data');
        $departemen = $this->request->getPost('depart');
        $nomorpesanan = $this->request->getPost('nomorpesanan');
        $data = array();
        $index = 0;

        foreach ($dataval as $dataitem) {
            array_push($data, array(
                'NoPesanan'     => $nomorpesanan,
                'Departemen'    => $departemen,
                'Kode'          => $dataitem['kodebarang'],
                'Qtty'          => $dataitem['qtybarang'],
                'Alokasi'       => $dataitem['alokasi'],
                'TglButuh'      => $dataitem['tanggalbutuh'],
            ));

            $index++;
        }

        $this->StockPesananDetail->insertBatch($data);

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
        $this->StockPesananDetail->where('md5(NoPesanan)', md5($id))->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
