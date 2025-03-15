<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterPegawai;
use App\Services\BaseDataTableService;

class MasterPegawaiController extends Controller
{
    use ResponseTrait;

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasterPegawai::query();
        $pegawaiData = $datatableService->getData($request, $query, function ($pegawai, $number) {
            $pegawai->no = $number;

            return $pegawai;
        }, MasterPegawai::$searchableColumns);

        return $this->successResponse('Successfully Requested', $pegawaiData);
    }
}
