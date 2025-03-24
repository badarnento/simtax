<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasaPajakPph21View extends Model
{
    use HasFactory;

    protected $table = 'MASA_PAJAK_PPH21_VIEW';

    protected $primaryKey = null;

    public $incrementing = false;

    public $timestamps = false;

    public static $searchableColumns = ['NIK', 'NAMA'];


    public function getTglPemotonganAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getGrossUpAttribute($value)
    {
        return $value ? 'Ya' : 'Tidak';
    }

    public function getMasaPajakAttribute($value)
    {
        $months = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return $months[$value] ?? '';
    }
}
