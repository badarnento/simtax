<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterPegawai;
use App\Services\BaseDataTableService;
use Illuminate\Support\Facades\Validator;

class MasterPegawaiController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'nullable|string|max:100'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Invalid input', [], 400);
        }

        $search = $request->input('q');

        $query = MasterPegawai::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('NAMA', 'LIKE', '%' . $search . '%')
                    ->orWhere('NIK', 'LIKE', '%' . $search . '%');
            });
        }

        $data = $query->limit(10)->get();

        return $this->successResponse('Successfully Requested', $data);
    }

    public function show(MasterPegawai $pegawai)
    {
        $data = $pegawai;

        return $this->successResponse('Successfully Requested', $data);
    }

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
