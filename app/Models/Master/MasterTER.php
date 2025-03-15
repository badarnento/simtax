<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterTER extends BaseModel
{
    use HasFactory;

    protected $table = 'MASTER_TER';

    protected $primaryKey = 'ID_TER';

    protected $fillable = [
        'LAPISAN',
        'PENGHASILAN_MIN',
        'PENGHASILAN_MAX',
        'TARIF'
    ];

    public static $searchableColumns = [];
}
