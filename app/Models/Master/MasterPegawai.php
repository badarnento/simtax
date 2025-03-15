<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterPegawai extends BaseModel
{
    use HasFactory;

    protected $table = 'MASTER_PEGAWAI';

    protected $primaryKey = 'ID_PEGAWAI';

    protected $fillable = [
        'ID_PEMOTONG',
        'ID_KODE_OBJEK_PPH21',
        'NAMA',
        'JENIS_KELAMIN',
        'JABATAN',
        'NIK',
        'TKU_PENERIMA_PENGHASILAN',
        'PTKP',
        'ALAMAT',
        'STATUS_KARYAWAN_RESIDENCE',
        'NO_PASSPORT',
        'NEGARA',
        'KODE_NEGARA',
        'BULAN_AWAL_PENGHASILAN',
        'BULAN_AKHIR_PENGHASILAN',
        'LAMA_BEKERJA',
        'STATUS_PEGAWAI',
        'DESKRIPSI_STATUS_PEGWAI',
        'KODE_FASILITAS',
        'NAMA_FASILITAS',
        'KODE_DOKUMEN',
        'NAMA_DOKUMEN_REFERENSI',
        'NOMOR_DOKUMEN_REFERENSI',
        'TGL_DOKUMEN_REFERENSI'
    ];

    public static $searchableColumns = ['NIK', 'NAMA'];
}
