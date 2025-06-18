<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StockOut;
use App\Models\Globalfunc;
use App\Models\StockOutDetail;


class StockOutController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->StockOut = new StockOut();
        $this->Globalfunc = new Globalfunc();
        $this->StockOutDetail = new StockOutDetail();
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

        $likeket = "stock_out.InvNum";
        if (empty($optionlike)) {
            $likeket = "stock_out.InvNum";
        } elseif ($optionlike == "Nomor Invoice") {
            $likeket = "stock_out.InvNum";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_out.Departemen";
        } elseif ($optionlike == "Dari Gudang") {
            $likeket = "stock_outdetail.Gudang";
        } elseif ($optionlike == "Ke Gudang") {
            $likeket = "stock_out.keGudang";
        }

        $builder = $this->StockOut;
        $builder->select("stock_out.Tgl,stock_out.InvNum,stock_out.Departemen,stock_outdetail.Gudang,stock_out.keGudang");
        $builder->selectSum('stock_outdetail.Qtty');
        $builder->join('stock_outDetail', 'stock_out.InvNum=stock_outdetail.InvNum', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_out.Tgl>=', $tanggaldari);
            $builder->where('stock_out.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_out.Tgl)', $bulan);
            $builder->where('year(stock_out.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_out.Tgl)', $tahun);
        }

        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_out.Tgl,stock_out.InvNum,stock_outdetail.Gudang');
        $query = $builder->countAllResults();

        $data = [
            'message' => 'success',
            'countStockOut' => $query
        ];

        return $this->respond($data, 200);
    }

    //get all data StockLunasHutang
    public function allStockOut()
    {
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get all data limit
    public function stockoutdata()
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

        $likeket = "stock_out.InvNum";
        if (empty($optionlike)) {
            $likeket = "stock_out.InvNum";
        } elseif ($optionlike == "Nomor Invoice") {
            $likeket = "stock_out.InvNum";
        } elseif ($optionlike == "Departemen") {
            $likeket = "stock_out.Departemen";
        } elseif ($optionlike == "Dari Gudang") {
            $likeket = "stock_outdetail.Gudang";
        } elseif ($optionlike == "Ke Gudang") {
            $likeket = "stock_out.keGudang";
        }

        //Select Stock_Out.Tgl As 'Tanggal',Stock_Out.InvNum As 'No.Invoice',Stock_Out.Departemen,Stock_OutDetail.Gudang drGudang,Sum(Stock_OutDetail.Qtty) As 'Jlh Qtty', stock_Out.keGudang From Stock_Out Left Join Stock_OutDetail On Stock_Out.InvNum=Stock_OutDetail.InvNum Where Stock_Out.InvNum Like '{0}' " + text + "Group By Stock_Out.Tgl,Stock_Out.InvNum,Stock_OutDetail.Gudang Order By Stock_Out.Tgl Desc,Stock_Out.InvNum Desc
        $builder = $this->StockOut;
        $builder->select("DATE_FORMAT(stock_out.Tgl,'%d-%m-%Y') as Tanggal,stock_out.InvNum,stock_out.Departemen,stock_outdetail.Gudang,stock_out.keGudang");
        $builder->selectSum('stock_outdetail.Qtty');
        $builder->join('stock_outDetail', 'stock_out.InvNum=stock_outdetail.InvNum', 'LEFT');

        if (!empty($optionfilter) && $optionfilter == "Tanggal") {
            $builder->where('stock_out.Tgl>=', $tanggaldari);
            $builder->where('stock_out.Tgl<=', $tanggalsampai);
        }
        if (!empty($optionfilter) && $optionfilter == "Bulan") {
            $builder->where('month(stock_out.Tgl)', $bulan);
            $builder->where('year(stock_out.Tgl)', $tahun);
        }
        if (!empty($optionfilter) && $optionfilter == "Tahun") {
            $builder->where('year(stock_out.Tgl)', $tahun);
        }

        $builder->like($likeket, $wherelike);
        $builder->groupBy('stock_out.Tgl,stock_out.InvNum,stock_outdetail.Gudang');
        $builder->orderBy('stock_out.Tgl Desc,stock_out.InvNum Desc');
        $builder->limit(intval($page), intval($pageprev));
        $query = $builder->findAll();

        $data = [
            'message' => 'success',
            'dataStockOut' => $query
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getStockOutbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->where('md5(InvNum)', md5($wherelike))->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field InvNum, drGudang. Show limit
    public function getStockOut()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataStockOut' => $this->StockOut->like('InvNum', $wherelike)->orLike('Departemen', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function testajah()
    {
        $response = $this->testajahlagi()->getBody();
        $data = json_decode($response, true);
        print_r($data['status']);
    }


    public function testajahlagi()
    {
        $response = ['message' => 'No.Invoice Ini Sudah diLakukan Penerimaan Mutasi', 'status' => 'error'];

        return $this->respond($response, 200);
    }


    //Insert
    public function savefunc()
    {
        $this->db = \Config\Database::connect();
        $query = "";
        $invoice = esc($this->request->getPost('invoice'));
        $dataval = esc($this->request->getPost('data'));
        $tanggal = esc($this->request->getPost('tanggal'));
        $gudang = esc($this->request->getPost('gudang'));
        $data = array();
        $index = 0;

        $query = $this->db->query("Select i.Tgl, i.NoBukti From Stock_In i Left Join Stock_InDetail id On i.NoBukti=id.NoBukti Where id.InvNum = '" . $invoice . "'");

        if ($query->getNumRows() > 0) {
            $response = ['message' => 'No.Invoice Ini Sudah diLakukan Penerimaan Mutasi', 'status' => 'error'];
        } else {

            foreach ($dataval as $dataitem) {
                $kodebarang = $dataitem['kodebarang'];
                $qty = $dataitem['qtybarang'];

                if (intval($qty) <= 0) {
                    $response = ['message' => 'Ada Qty yang belum diisi, harap periksa kembali', 'status' => 'error'];
                    return $this->respond($response, 200);
                }

                $qty2 = $this->Globalfunc->calculate($tanggal, $tanggal, $invoice, $kodebarang, $gudang, true);

                // $response = ['message' => $qty2, 'status' => 'error'];
                // return $this->respond($response, 200);


                $cekstock = $this->Globalfunc->AlertMinusStock($kodebarang, "Inventory", $qty2, $qty);

                if ($cekstock['status'] != 1) {
                    $response = ['message' => $cekstock['message'] . "-" . $qty2, 'status' => 'error'];
                    return $this->respond($response, 200);
                }

                if ($dataitem['alokasi'] == "") {
                    $response = ['message' => 'Alokasi Barang Belum diIsi, Periksa Kembali', 'status' => 'error'];
                    return $this->respond($response, 200);
                }

                array_push($data, array(
                    'InvNum'    => $invoice,
                    'Gudang'    => $gudang,
                    'Kode'      => $dataitem['kodebarang'],
                    'Qtty'      => $dataitem['qtybarang'],
                    'Alokasi'   => $dataitem['alokasi'],
                ));

                $index++;
            }

            $query = $this->db->query("Select Tgl From Stock_Out Where InvNum = '" . $invoice . "'");
            if ($query->getNumRows() > 0) {
                $result = $query->getResult();

                $vTgl = $result[0]->Tgl;

                $cekclosebulanan = $this->Globalfunc->closeBulanan($vTgl, "Stock_Periode");
                if ($cekclosebulanan['status'] != 1) {
                    $response = ['message' => $cekclosebulanan['message'], 'status' => 'error'];
                    return $this->respond($response, 200);
                }
            }

            $this->deletedata($invoice);

            // $response = ['message' => $this->request->getPost('departemen'), 'status' => 'error'];
            // return $this->respond($response, 200);

            $this->StockOut->insert([
                'InvNum'                 => $invoice,
                'Tgl'                    => $tanggal,
                'Departemen'             => esc($this->request->getPost('departemen')),
                'Keterangan'             => esc($this->request->getPost('keterangan')),
                'Status'                 => esc($this->request->getPost('status')),
                'keGudang'               => esc($this->request->getPost('keGudang')),
                'TglUbah'                => esc($this->request->getPost('TglUbah')),
                'Username'               => esc($this->request->getPost('Username')),
            ]);

            $this->StockOutDetail->insertBatch($data);
            $response = ['message' => 'success', 'status' => 'success'];
            return $this->respond($response, 200);
        }
    }

    //Update
    public function update($id = null)
    {
        $data = [
            'Tgl'                    => esc($this->request->getVar('Tgl')),
            'Departemen'             => esc($this->request->getVar('Departemen')),
            'Keterangan'             => esc($this->request->getVar('Keterangan')),
            'Status'                 => esc($this->request->getVar('Status')),
            'keGudang'               => esc($this->request->getVar('keGudang')),
            'TglUbah'                => esc($this->request->getVar('TglUbah')),
            'Username'               => esc($this->request->getVar('Username')),
        ];
        $result = $this->StockOut->where('md5(InvNum)', $id)->set($data)->update();


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata($id)
    {
        $this->StockOut->where('md5(InvNum)', md5($id))->delete();
        $this->StockOutDetail->where('md5(InvNum)', md5($id))->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
