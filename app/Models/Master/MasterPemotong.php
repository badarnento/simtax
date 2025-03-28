<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterPemotong extends BaseModel
{
    use HasFactory;

    protected $table = 'MASTER_PEMOTONG';

    protected $primaryKey = 'ID_PEMOTONG';

    protected $fillable = [
     'NAMA_PEMOTONG', 
     'NPWP_PEMOTONG', 
     'TKU_PEMOTNG', 
     'ALAMAT_PEMOTONG', 
     'KOTA', 
     'NO_TLP', 
     'NAMA_PENANDATANGAN', 
     'NPWP_PENANDATANGAN', 
     'NIK_PENANDATANGAN', 
     'METODE_PPH21', 
     'TAHUN_PAJAK_PERHITUNGAN'
    ];

    public static $searchableColumns = ['NAMA_PEMOTONG','NPWP_PEMOTONG','TKU_PEMOTNG'];
}
