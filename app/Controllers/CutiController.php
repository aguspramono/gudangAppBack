<?php

namespace App\Controllers;

require_once ROOTPATH . '/vendor/autoload.php';

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Models\Tokenpush;
use App\Models\Cuti;
use App\Models\Pegawai;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class CutiController extends ResourceController
{

    public function __construct()
    {
        $this->Tokenpush = new Tokenpush();
        $this->Cuti = new Cuti();
        $this->Pegawai = new Pegawai();
    }

    protected $modelName = 'App\Models\Pegawai';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

    public function delete($id = null)
    {
        $this->Cuti->where('IDCUTI', $id)->delete();
        $response = ['message' => 'success'];

        return $this->respondDeleted($response);
    }


    public function cekcutiuser()
    {
        $id = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datacuti' => $this->Cuti->where('IDUSELOGIN', $id)->where('STATUSCUTI', 'proses')->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function getCutiWhere()
    {
        $id = $this->request->getVar('id');
        $data = [
            'message' => 'success',
            'datacuti' => $this->Cuti->where('IDCUTI', $id)->findAll()
        ];

        return $this->respond($data, 200);
    }

    public function cekcuti()
    {
        $id = $this->request->getVar('id');
        $datacuti = $this->Cuti->join('KARYAWAN', 'KARYAWAN.ID=CUTI.IDUSER')->where('CUTI.IDCUTI', $id)->findAll();

        // $data = [
        //     'message' => 'success',
        //     'datacuti' => $this->Cuti->join('KARYAWAN', 'KARYAWAN.ID=CUTI.IDUSER')->where('CUTI.IDCUTI', $id)->findAll()
        // ];

        // return $this->respond($data, 200);



        print_r($datacuti);
    }

    public function update($id = null, $status = "")
    {

        $datacuti = $this->Cuti->join('KARYAWAN', 'KARYAWAN.ID=CUTI.IDUSER')->where('CUTI.IDCUTI', $id)->findAll();


        $this->Cuti->update($id, [
            'STATUSDIKET'          => esc($this->request->getVar('STATUSDIKET')),
            'STATUSDISET'        => esc($this->request->getVar('STATUSDISET')),
            'STATUSCUTI'         => esc($this->request->getVar('STATUSCUTI')),
        ]);


        if ($status == "disetujui") {
            $this->Pegawai->update($datacuti[0]['IDUSER'], [
                'cutiterpakai'       => floatval($datacuti[0]['cutiterpakai']) + floatval($datacuti[0]['JUMLAHCUTI']),
                'sisacuti'           => floatval($datacuti[0]['sisacuti']) - floatval($datacuti[0]['JUMLAHCUTI']),
            ]);
        }


        $response = ['message' => 'success'];

        return $this->respond($response, 200);
    }

    public function riwayatcuti()
    {
        $id             = $this->request->getVar('id');
        $tanggaldari    = $this->request->getVar('tanggaldari');
        $tanggalsampai  = $this->request->getVar('tanggalsampai');
        $idpegawai      = $this->request->getVar('idpegawai');

        if (empty($idpegawai)) {
            $whereIDPegawai = "";
        } else {
            $whereIDPegawai = " AND CUTI.IDUSER='" . $idpegawai . "'";
        }

        if (empty($id)) {
            $whereID = "";
        } else {
            $whereID = " CUTI.IDUSELOGIN='" . $id . "' AND ";
        }

        $where = $whereID . "((DATE(CUTI.TANGGALDARI)>='" . $tanggaldari . "' AND DATE(CUTI.TANGGALDARI)<='" . $tanggalsampai . "') OR (DATE(CUTI.TANGGALSAMPAI)>='" . $tanggaldari . "' AND DATE(CUTI.TANGGALSAMPAI)<='" . $tanggalsampai . "')) " . $whereIDPegawai . "";

        $builder = $this->Cuti->select('CUTI.*,KARYAWAN.*,USERADMIN.NAMA as namadiket,tabset.NAMA as namaset')
            ->join('KARYAWAN', 'KARYAWAN.ID=CUTI.IDUSER')
            ->join('USERADMIN', 'USERADMIN.USERID=CUTI.IDDIKETAHUI')
            ->join('USERADMIN as tabset', 'tabset.USERID=CUTI.IDDISETUJUI')
            ->where($where)->limit(10)->orderBy('DATE(CUTI.TANGGALPENGAJUAN)', 'DESC')->findAll();


        // if (empty($id)) {
        //     $builder = $this->Cuti->select('CUTI.*,KARYAWAN.*,USERADMIN.NAMA as namadiket,tabset.NAMA as namaset')
        //         ->join('KARYAWAN', 'KARYAWAN.ID=CUTI.IDUSER')
        //         ->join('USERADMIN', 'USERADMIN.USERID=CUTI.IDDIKETAHUI')
        //         ->join('USERADMIN as tabset', 'tabset.USERID=CUTI.IDDISETUJUI')
        //         ->where($where)
        //         ->limit(10)->orderBy('DATE(CUTI.TANGGALPENGAJUAN)', 'DESC')->findAll();
        // } else {

        // }

        $data = [
            'message' => 'success',
            'datacuti' => $builder
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {

        $IDUSER         = esc($this->request->getVar('IDUSER'));
        $TANGGALDARI    = esc($this->request->getVar('TANGGALDARI'));
        $TANGGALSAMPAI  = esc($this->request->getVar('TANGGALSAMPAI'));
        $ALASANCUTI     = esc($this->request->getVar('ALASANCUTI'));
        $JUMLAHCUTI     = esc($this->request->getVar('JUMLAHCUTI'));
        $IDDIKETAHUI    = esc($this->request->getVar('IDDIKETAHUI'));
        $IDDISETUJUI    = esc($this->request->getVar('IDDISETUJUI'));
        $TANGGALPENGAJUAN = esc($this->request->getVar('TANGGALPENGAJUAN'));
        $IDUSELOGIN = esc($this->request->getVar('IDUSELOGIN'));

        $this->Cuti->insert([
            'IDUSER'            => $IDUSER,
            'TANGGALDARI'       => $TANGGALDARI,
            'TANGGALSAMPAI'     => $TANGGALSAMPAI,
            'ALASANCUTI'        => $ALASANCUTI,
            'JUMLAHCUTI'        => $JUMLAHCUTI,
            'IDDIKETAHUI'       => $IDDIKETAHUI,
            'IDDISETUJUI'       => $IDDISETUJUI,
            'TANGGALPENGAJUAN'  => $TANGGALPENGAJUAN,
            'IDUSELOGIN'        => $IDUSELOGIN,
        ]);

        $response = ['message' => 'success'];

        return $this->respondCreated($response);
    }


    public function notifcutime()
    {

        $id = $this->request->getVar('id');
        $status = $this->request->getVar('status');
        $result = $this->Tokenpush->where('TOKEN.iduserlogin', $id)->findAll();

        if ($status == "pengajuan") {
            $body = "Pengajuan cuti Anda sudah terkirim, Anda akan mendapat notifikasi tentang status pengajuan cuti Anda.";
        } elseif ($status == "disetujui") {
            $body = "Pengajuan cuti telah disetujui";
        } elseif ($status == "tidaksetuju") {
            $body = "Pengajuan cuti tidak disetujui";
        }

        $channelName = 'pemberitahuan';
        $recipient = 'ExponentPushToken[' . $result[0]['token'] . ']';

        $expo = \ExponentPhpSDK\Expo::normalSetup();
        $expo->subscribe($channelName, $recipient);
        $notification = ['title' => 'Pengajuan Cuti', 'body' => $body, 'data' => json_encode(array('type' => 'cuti'))];
        $expo->notify([$channelName], $notification);

        $data = [
            'message' => 'success',
            'iduser' => $id
        ];

        return $this->respond($data, 200);
    }

    public function notifcutibos()
    {
        $diket = $this->request->getVar('iddiket');
        $diset = $this->request->getVar('iddiset');
        $dikar = $this->request->getVar('idkar');
        $resultdiket = $this->Tokenpush->where('TOKEN.iduserlogin', $diket)->findAll();
        $resultdiset = $this->Tokenpush->where('TOKEN.iduserlogin', $diset)->findAll();
        $resultkary = $this->Cuti->join('KARYAWAN', 'KARYAWAN.ID = CUTI.IDUSER')->where('CUTI.IDUSER', $dikar)->findAll();

        // print_r($resultdiket);
        // print_r($resultdiset);

        $channelName = 'pemberitahuancuti';
        if (!empty($resultdiket[0]['token'])) {
            $recipient1 = 'ExponentPushToken[' . $resultdiket[0]['token'] . ']';
        }

        $recipient2 = 'ExponentPushToken[' . $resultdiset[0]['token'] . ']';
        $expo = \ExponentPhpSDK\Expo::normalSetup();
        if (!empty($resultdiket[0]['token'])) {
            $expo->subscribe($channelName, $recipient1);
        }

        $expo->subscribe($channelName, $recipient2);
        $notification = ['title' => 'Pengajuan Cuti', 'body' => 'Hallo, ' . $resultkary[0]['NAMA'] . ' ingin mengajukan cuti, masuk ke aplikasi untuk melihat detail ya', 'data' => json_encode(array('type' => 'cuti', 'idkarya' => $resultkary[0]['ID']))];
        $expo->notify([$channelName], $notification);

        $data = [
            'message' => 'success'
        ];

        return $this->respond($data, 200);
    }
}
