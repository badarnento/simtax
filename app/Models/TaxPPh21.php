<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaxPPh21 extends BaseModel
{
    use HasFactory;

    protected $table = 'MASA_PAJAK_PPH21_BULANAN';

    protected $primaryKey = 'ID_MASA_PAJAK';

    protected $fillable = [
        'BULAN',
        'TAHUN',
        'TUNJANGAN_PPH',
        'THR',
        'BONUS',
        'UANG_LEMBUR',
        'PREMI_JKK',
        'PREMI_JKM',
        'PREMI_BPJS_KES',
        'GROSS_UP',
        'PENGHASILAN_BRUTO',
        'ID_TER',
        'PPH21_TERUTANG',
        'KATEGORI_TER',
        'ID_PEGAWAI',
        'ZAKAT',
        'IURAN_PENSIUN',
        'IURAN_JHT',
        'TGL_PEMOTONGAN',
        'UANG_MAKAN',
        'TUNJANGAN',
        'NATURA_OBJEK_PPH21',
        'TANTIEM_DAN_LAINNYA',
        'GAJI_POKOK'
    ];

    public static $searchableColumns = ['UANG_MAKAN'];
}
