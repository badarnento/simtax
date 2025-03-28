<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterKodeObjekPPH21;
use App\Services\BaseDataTableService;
use Illuminate\Support\Facades\Validator;

class MasterKodeObjekPPH21Controller extends Controller
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

        $query = MasterKodeObjekPPH21::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('KODE_OBJEK_PAJAK', 'LIKE', '%' . $search . '%')
                    ->orWhere('NAMA_OBJEK_PAJAK', 'LIKE', '%' . $search . '%');
            });
        }

        $data = $query->limit(10)->get();

        return $this->successResponse('Successfully Requested', $data);
    }

    public function show(MasterKodeObjekPPH21 $kodeobjekpph21)
    {
        $data = $kodeobjekpph21;

        return $this->successResponse('Successfully Requested', $data);
    }

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasterKodeObjekPPH21::query();
        $kodeobjekpph21Data = $datatableService->getData($request, $query, function ($kodeobjekpph21, $number) {
            $kodeobjekpph21->no = $number;

            return $kodeobjekpph21;
        }, MasterKodeObjekPPH21::$searchableColumns);

        return $this->successResponse('Successfully Requested', $kodeobjekpph21Data);
    }
}
