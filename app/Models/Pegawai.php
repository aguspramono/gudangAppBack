<?php

namespace App\Models;

use CodeIgniter\Model;

class Pegawai extends Model
{
    protected $table            = 'KARYAWAN';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['ID', 'NIK', 'NAMA', 'TglLahir', 'Gender', 'Agama', 'Alamat', 'NoKontak', 'Jabatan', 'Foto', 'cuti', 'cutiterpakai', 'sisacuti'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function m_absensi($id, $fromDate, $toDate)
    {
        if (empty($id)) {
            $whereID = "";
        } else {
            $whereID = " AND a.BadgeNumber='" . $id . "' ";
        }
        return $this->db->query("Select a.BadgeNumber,k.NAMA, Date_format(a.CHECKTIME,'%d %M %Y') as tanggal, time((Select min(CHECKTIME) from CHECKINOUT WHERE BadgeNumber=a.BadgeNumber and DATE(CHECKTIME)=DATE(a.CHECKTIME))) as scanMasuk,time((Select max(CHECKTIME) from CHECKINOUT WHERE BadgeNumber=a.BadgeNumber and date(CHECKTIME)=date(a.CHECKTIME))) as scanPulang, TIMEDIFF(time((Select min(CHECKTIME) from CHECKINOUT WHERE BadgeNumber=a.BadgeNumber and DATE(CHECKTIME)=DATE(a.CHECKTIME))),'08:30:59') as telat from CHECKINOUT As a inner join KARYAWAN as k on(k.ID=a.BadgeNumber) WHERE DATE(a.CHECKTIME) BETWEEN '" . $fromDate . "' AND '" . $toDate . "' " . $whereID . " GROUP BY date(a.CHECKTIME) , a.BadgeNumber ORDER BY a.BadgeNumber, date(a.CHECKTIME) ASC");
    }
}
