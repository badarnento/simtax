<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterPTKP extends BaseModel
{
    use HasFactory;

    protected $table = 'MASTER_PTKP';

    protected $primaryKey = 'ID_PTKP';

    protected $fillable = [
        'DESKRIPSI',
        'JENIS_TER',
        'PTKP_SEBULAN',
        'PTKP_SETAHUN'
    ];

    public static $searchableColumns = ['DESKRIPSI'];
}
