<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterKodeObjekPPH21 extends BaseModel
{
    use HasFactory;

    protected $table = 'MASTER_KODE_OBJEK_PPH21';

    protected $primaryKey = 'ID_KODE_OBJEK_PPH21';

    protected $fillable = [
    'KODE_OBJEK_PAJAK', 
    'NAMA_OBJEK_PAJAK', 
    'DEEMED', 
    'TARIF'
    ];

    public static $searchableColumns = ['KODE_OBJEK_PAJAK','NAMA_OBJEK_PAJAK'];
}
