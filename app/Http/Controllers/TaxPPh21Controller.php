<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use Carbon\Carbon;
use App\Models\TaxPPh21;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\MasaPajakPph21View;
use App\Services\BaseDataTableService;

class TaxPPh21Controller extends Controller
{
    use ResponseTrait;

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasaPajakPph21View::query();

        $pph21 = $datatableService->getData($request, $query, function ($pph21, $number) {
            $pph21->no = $number;
            $pph21->TGL_PEMOTONGAN = $pph21->TGL_PEMOTONGAN;
            $pph21->MASA_PAJAK = $pph21->MASA_PAJAK;
            $pph21->GROSS_UP = $pph21->GROSS_UP;
            $pph21->GAJI_POKOK = CommonHelper::thousandFormat($pph21->GAJI_POKOK);
            $pph21->TUNJANGAN_PPH = CommonHelper::thousandFormat($pph21->TUNJANGAN_PPH);
            $pph21->PENGHASILAN_BRUTO = CommonHelper::thousandFormat($pph21->PENGHASILAN_BRUTO);

            return $pph21;
        }, MasaPajakPph21View::$searchableColumns);

        return $this->successResponse('Successfully Requested', $pph21);
    }

    public function getTarif(Request $request)
    {

        $id_pegawai = $request->input('id_pegawai');

        $data = TaxPPh21::getMasterTerByPegawai($id_pegawai);

        return $this->successResponse('Successfully Requested', collect($data));
    }

    public function store(Request $request)
    {

        $fieldMappings = [
            'id_pegawai' => 'ID_PEGAWAI',
            'id_ter' => 'ID_TER',
            'gaji_pokok' => 'GAJI_POKOK',
            'tunjangan' => 'TUNJANGAN',
            'uang_makan' => 'UANG_MAKAN',
            'uang_lembur' => 'UANG_LEMBUR',
            'tunjangan_pph' => 'TUNJANGAN_PPH',
            'premi_bpjs_jht' => 'PREMI_JHT',
            'premi_bpjs_jkk' => 'PREMI_JKK',
            'premi_bpjs_jkm' => 'PREMI_JKM',
            'premi_bpjs_JP' => 'PREMI_JP',
            'premi_bpjs_kesehatan' => 'PREMI_BPJS_KES',
            'natura_pph21' => 'NATURA_OBJEK_PPH21',
            'tunjangan_hari_raya' => 'THR',
            'bonus' => 'BONUS',
            'tantiem' => 'TANTIEM_DAN_LAINNYA',
            'bulan_awal' => 'BULAN',
            'metode_penggajian' => 'GROSS_UP',
            'jumlah_penghasilan_bruto' => 'PENGHASILAN_BRUTO',
        ];

        // Loop untuk menyesuaikan key dan menghapus titik
        $data = [];
        foreach ($fieldMappings as $requestKey => $dbColumn) {
            // $data[$dbColumn] = $request->input($requestKey, 0);
            $data[$dbColumn] = $request->input($requestKey);
        }

        /*         print_r($data);
        die; */
        $data['TGL_PEMOTONGAN'] = Carbon::now()->endOfMonth()->toDateString();
        $data['TAHUN'] = 2005;
        // Simpan ke database
        TaxPPh21::create($data);

        return $this->successResponse('Successfully Created', []);
    }
}
