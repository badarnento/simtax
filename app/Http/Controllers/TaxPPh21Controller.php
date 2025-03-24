<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\TaxPPh21;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\BaseDataTableService;

class TaxPPh21Controller extends Controller
{
    use ResponseTrait;

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = TaxPPh21::query();

        $pph21 = $datatableService->getData($request, $query, function ($pph21, $number) {
            $pph21->no = $number;
            return $pph21;
        }, TaxPPh21::$searchableColumns);

        return $this->successResponse('Successfully Requested', $pph21);
    }

    public function store(Request $request)
    {

        $fieldMappings = [
            'gaji_pokok' => 'GAJI_POKOK',
            'tunjangan' => 'TUNJANGAN',
            'uang_makan' => 'UANG_MAKAN',
            'uang_lembur' => 'UANG_LEMBUR',
            'tunjangan_pph' => 'TUNJANGAN_PPH',
            'premi_bpjs_jkk' => 'PREMI_JKK',
            'premi_bpjs_jkm' => 'PREMI_JKM',
            'premi_bpjs_kesehatan' => 'PREMI_BPJS_KES',
            'naturan_pph21' => 'NATURA_OBJEK_PPH21',
            'tunjangan_hari_raya' => 'THR',
            'bonus' => 'BONUS',
            'tantiem' => 'TANTIEM_DAN_LAINNYA',
            'bulan_akhir' => 'BULAN',
            'tahun' => 'TAHUN',
            'penghasilan_bruto' => 'PENGHASILAN_BRUTO',
            'gross_up' => 'GROSS_UP',
        ];

        // Loop untuk menyesuaikan key dan menghapus titik
        $data = [];
        foreach ($fieldMappings as $requestKey => $dbColumn) {
            // $data[$dbColumn] = $request->input($requestKey, 0);
            $data[$dbColumn] = $request->input($requestKey);
        }
        $data['TGL_PEMOTONGAN'] = Carbon::now()->endOfMonth()->toDateString();
        // print_r($data);die;
        // Simpan ke database
        $pph21 = TaxPPh21::create($data);

        return $this->successResponse('Successfully Created', $pph21);
    }
}
