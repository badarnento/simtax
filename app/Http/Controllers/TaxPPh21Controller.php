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

    public function show(MasaPajakPph21View $bulanan)
    {
        $data = collect($bulanan)->map(function ($value, $key) {
            // Field yang akan diformat sebagai angka dengan pemisah ribuan
            $formatThousandFields = [
                'GAJI_POKOK',
                'UANG_MAKAN',
                'UANG_LEMBUR',
                'TUNJANGAN',
                'TUNJANGAN_PPH',
                'THR',
                'BONUS',
                'PENGHASILAN_BRUTO',
                'PREMI_JKK',
                'PREMI_JKM',
                'PREMI_BPJS_KES',
                'PPH21_TERUTANG',
                'ZAKAT',
                'IURAN_PENSIUN',
                'IURAN_JHT',
                'NATURA_OBJEK_PPH21',
                'TANTIEM_DAN_LAINNYA'
            ];

            // Field yang tetap dalam format asli meskipun numerik
            $excludeNumericFormat = ['NIK', 'NPWP', 'ID_PEGAWAI', 'ID_MASA_PAJAK', 'ID_TER'];

            // Jika field adalah 1 atau 0, ubah menjadi "Ya" atau "Tidak"
            if (in_array($key, ['GROSS_UP']) && ($value === 1 || $value === 0)) {
                return $value === 1 ? 'Ya' : 'Tidak';
            }

            // Jika nilai adalah 0, ubah menjadi '-'
            if ($value === 0) {
                return '-';
            }

            // Jika field masuk dalam daftar format thousand separator
            if (in_array($key, $formatThousandFields) && is_numeric($value) && $value > 0) {
                return CommonHelper::thousandFormat($value);
            }

            // Format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
            if (in_array($key, ['TGL_PEMOTONGAN']) && !empty($value)) {
                return date('d-m-Y', strtotime($value));
            }

            // Jika field termasuk dalam daftar yang harus dikecualikan, kembalikan dalam format asli
            if (in_array($key, $excludeNumericFormat)) {
                return (string) $value; // Pastikan tetap string untuk ID atau kode unik
            }

            return $value;
        });

        return $this->successResponse('Successfully Requested', $data);
    }


    public function shosssw(MasaPajakPph21View $bulanan)
    {
        $data = collect($bulanan)->map(function ($value, $key) {
            // Jika nilai adalah 1 atau 0, ubah menjadi "Ya" atau "Tidak"
            if (in_array($key, ['GROSS_UP']) && ($value === 1 || $value === 0)) {
                return $value === 1 ? 'Ya' : 'Tidak';
            }

            // Jika nilai adalah 0, ubah menjadi '-'
            if ($value === 0) {
                return '-';
            }

            // Jika nilai lebih dari 0, format dengan thousand separator
            if (is_numeric($value) && $value > 0) {
                return number_format($value, 0, ',', '.');
            }

            // Format tanggal dari yyyy-mm-dd menjadi dd-mm-yyyy
            if (in_array($key, ['TGL_PEMOTONGAN']) && !empty($value)) {
                return date('d-m-Y', strtotime($value));
            }

            return $value;
        });

        return $this->successResponse('Successfully Requested', $data);
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
            'iuran_zakat' => 'ZAKAT',
            'jumlah_pph21_terutang' => 'PPH21_TERUTANG',
            'iuran_bpjs_tk_jht' => 'IURAN_JHT',
            'iuran_bpjs_tk_jp' => 'IURAN_PENSIUN',
            'kategori_ter' => 'KATEGORI_TER',
            'jumlah_penghasilan_bruto' => 'PENGHASILAN_BRUTO',
        ];

        // Loop untuk menyesuaikan key dan menghapus titik
        $data = [];
        foreach ($fieldMappings as $requestKey => $dbColumn) {
            // $data[$dbColumn] = $request->input($requestKey, 0);
            $data[$dbColumn] = $request->input($requestKey);
        }

        $data['TGL_PEMOTONGAN'] = Carbon::now()->endOfMonth()->toDateString();
        $data['TAHUN'] = 2025;
        // Simpan ke database
        TaxPPh21::create($data);

        return $this->successResponse('Successfully Created', []);
    }
}
