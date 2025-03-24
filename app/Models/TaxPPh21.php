<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaxPPh21 extends BaseModel
{
    use HasFactory;

    protected $table = 'MASA_PAJAK_PPH21_BULANAN';

    protected $primaryKey = 'ID_MASA_PAJAK';

    public static $searchableColumns = [];

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

    /* 
    
        [metode-penggajian] => GROSS UP
    [bulan-awal] => 1
    [bulan-akhir] => 1
    [npwp] => 
    [status-ptkp] => TK/0
    [gaji_pokok] => 111.111.111.111
    [tunjangan] => 22.222.222
    [uang_makan] => 33.333.333
    [uang_lembur] => 44.444.444
    [penghasilan_lain] => 555.555.555
    [tunjangan_pph] => 
    [premi_bpjs_jkk] => 
    [premi_bpjs_jkm] => 
    [premi_bpjs_kesehatan] => 
    [naturan_pph21] => 999.999.999
    [tunjangan_hari_raya] => 6.666.666.666
    [bonus] => 777.777.778
    [tantiem] => 888.888.888.888
    */


    public function setGajiPokokAttribute($value)
    {
        $this->attributes['GAJI_POKOK'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setTunjanganAttribute($value)
    {
        $this->attributes['TUNJANGAN'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setUangMakanAttribute($value)
    {
        $this->attributes['UANG_MAKAN'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setUangLemburAttribute($value)
    {
        $this->attributes['UANG_LEMBUR'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setBonusAttribute($value)
    {
        $this->attributes['BONUS'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setTantiemDanLainnyaAttribute($value)
    {
        $this->attributes['TANTIEM_DAN_LAINNYA'] = $value !== "" ? str_replace('.', '', $value) : null;
    }

    public function setPremiJkkAttribute($value)
    {
        $this->attributes['PREMI_JKK'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }

    public function setPremiJkmAttribute($value)
    {
        $this->attributes['PREMI_JKM'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }

    public function setPremiBpjsKesAttribute($value)
    {
        $this->attributes['PREMI_BPJS_KES'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }
    public function setNaturaObjekPph21Attribute($value)
    {
        $this->attributes['NATURA_OBJEK_PPH21'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }

    public function setThrAttribute($value)
    {
        $this->attributes['THR'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }

    public function setPenghasilanBrutoAttribute($value)
    {
        $this->attributes['PENGHASILAN_BRUTO'] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }


}
