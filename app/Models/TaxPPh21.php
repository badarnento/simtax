<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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

    /**
     * Cast attribute values before saving to database
     */
    protected $casts = [
        'GAJI_POKOK' => 'integer',
        'TUNJANGAN' => 'integer',
        'UANG_MAKAN' => 'integer',
        'UANG_LEMBUR' => 'integer',
        'BONUS' => 'integer',
        'TANTIEM_DAN_LAINNYA' => 'integer',
        'PREMI_JKK' => 'integer',
        'PREMI_JKM' => 'integer',
        'PREMI_BPJS_KES' => 'integer',
        'NATURA_OBJEK_PPH21' => 'integer',
        'THR' => 'integer',
        'PENGHASILAN_BRUTO' => 'integer',
    ];

    /**
     * Convert currency-like values (with dots) to integer before saving
     */
    public function setAttributeValues($key, $value)
    {
        $this->attributes[$key] = $value !== "" ? (int) str_replace('.', '', $value) : null;
    }

    public function setGajiPokokAttribute($value)
    {
        $this->setAttributeValues('GAJI_POKOK', $value);
    }
    public function setTunjanganAttribute($value)
    {
        $this->setAttributeValues('TUNJANGAN', $value);
    }
    public function setTunjanganPphAttribute($value)
    {
        $this->setAttributeValues('TUNJANGAN_PPH', $value);
    }
    public function setUangMakanAttribute($value)
    {
        $this->setAttributeValues('UANG_MAKAN', $value);
    }
    public function setUangLemburAttribute($value)
    {
        $this->setAttributeValues('UANG_LEMBUR', $value);
    }
    public function setBonusAttribute($value)
    {
        $this->setAttributeValues('BONUS', $value);
    }
    public function setTantiemDanLainnyaAttribute($value)
    {
        $this->setAttributeValues('TANTIEM_DAN_LAINNYA', $value);
    }
    public function setPremiJkkAttribute($value)
    {
        $this->setAttributeValues('PREMI_JKK', $value);
    }
    public function setPremiJkmAttribute($value)
    {
        $this->setAttributeValues('PREMI_JKM', $value);
    }
    public function setPremiBpjsKesAttribute($value)
    {
        $this->setAttributeValues('PREMI_BPJS_KES', $value);
    }
    public function setNaturaObjekPph21Attribute($value)
    {
        $this->setAttributeValues('NATURA_OBJEK_PPH21', $value);
    }
    public function setThrAttribute($value)
    {
        $this->setAttributeValues('THR', $value);
    }
    public function setZakatAttribute($value)
    {
        $this->setAttributeValues('ZAKAT', $value);
    }
    public function setPph21TerutangAttribute($value)
    {
        $this->setAttributeValues('PPH21_TERUTANG', $value);
    }
    public function setPenghasilanBrutoAttribute($value)
    {
        $this->setAttributeValues('PENGHASILAN_BRUTO', $value);
    }

    public static function getTarifByGajiPegawai($id_pegawai)
    {
        return DB::table('MASTER_PEGAWAI as mp')
            ->select(
                'mp.NAMA',
                'mppb.GAJI_POKOK',
                'mp.PTKP',
                DB::raw('COALESCE((mppb.PREMI_BPJS_KES + mppb.PREMI_JKK + mppb.PREMI_JKM), 0) AS Total_PREMI'),
                DB::raw('COALESCE(mp2.JENIS_TER, "TIDAK ADA") AS JENIS_TER'),
                DB::raw('COALESCE(mt.TARIF, 0) AS TARIF')
            )
            ->leftJoin('MASA_PAJAK_PPH21_BULANAN as mppb', 'mppb.ID_PEGAWAI', '=', 'mp.ID_PEGAWAI')
            ->leftJoin('MASTER_PTKP as mp2', 'mp2.DESKRIPSI', '=', 'mp.PTKP')
            ->leftJoin('MASTER_TER as mt', function ($join) {
                $join->on('mppb.GAJI_POKOK', '>=', DB::raw('CAST(mt.PENGHASILAN_MIN AS UNSIGNED)'))
                    ->on('mppb.GAJI_POKOK', '<=', DB::raw('CAST(mt.PENGHASILAN_MAX AS UNSIGNED)'))
                    ->on('mt.LAPISAN', '=', 'mp2.JENIS_TER');
            })
            ->where('mp.ID_PEGAWAI', $id_pegawai)
            ->first();
    }

    public static function getMasterTerByPegawai($id_pegawai)
    {
        return DB::table('MASTER_PTKP as mptkp')
            ->leftJoin('MASTER_PEGAWAI as mp', 'mptkp.DESKRIPSI', '=', 'mp.PTKP')
            ->leftJoin('MASTER_TER as mt', 'mptkp.JENIS_TER', '=', 'mt.LAPISAN')
            ->where('mp.ID_PEGAWAI', $id_pegawai)
            ->select('mt.*')
            ->get();
    }

}
