<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProductDetail;
use App\Models\Gudang;


class ProductdetailController extends ResourceController
{
    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        header("Access-Control-Allow-Headers: X-Request-With");
        $this->ProductDetail = new ProductDetail();
        $this->Gudang = new Gudang();
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
            'countproductdetail' => $this->ProductDetail->like('Gudang', $wherelike)->countAllResults()
        ];

        return $this->respond($data, 200);
    }

    //get data by field No ACC
    public function getProductDetailbyid()
    {
        $wherelike = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'dataproductdetail' => $this->ProductDetail->where('Kode', $wherelike)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //get data with filter field Nama, Person. Show limit
    public function getProductDetail()
    {
        $wherelike = $this->request->getVar('like');
        $pageprev = $this->request->getVar('pageprev');
        $page = $this->request->getVar('page');
        $data = [
            'message' => 'success',
            'dataproductdetail' => $this->ProductDetail->like('Kode', $wherelike)->orLike('Gudang', $wherelike)->limit(intval($page), intval($pageprev))->findAll()
        ];

        return $this->respond($data, 200);
    }

    //Get detail produk by kode and gudang
    public function getProductDetailByKodeAndGudang()
    {
        $kode = $this->request->getVar('kode');
        $gudang = $this->request->getVar('gudang');
        $data = [
            'message' => 'success',
            'dataproductdetail' => $this->ProductDetail->where('Kode', $kode)->where('Gudang', $gudang)->findAll()
        ];

        return $this->respond($data, 200);
    }


    //Insert
    public function createProductDetail($kode = null)
    {
        $data = array();
        $index = 0;

        $datagudang = $this->Gudang->findAll();

        foreach ($datagudang as $gudang) {
            array_push($data, array(
                'Kode'           => $kode,
                'Gudang'         => $gudang['Gudang'],
                'sAwal'          => 0,
            ));

            $index++;
        }

        $this->ProductDetail->insertBatch($data);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }

    //Update
    public function update($id = null)
    {

        $this->ProductDetail->update($id, [
            'sAwal'          => esc($this->request->getVar('sAwal')),
            'Temp'           => esc($this->request->getVar('Temp')),
            'hBeli'          => esc($this->request->getVar('hBeli')),
        ]);

        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    //delete
    public function deletedata()
    {
        $id = $this->request->getVar('id');
        $this->ProductDetail->where('Kode', $id)->delete();
        $response = ['message' => 'success'];
        return $this->respondDeleted($response);
    }
}
