<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterPemotong;
use App\Services\BaseDataTableService;
use Illuminate\Support\Facades\Validator;

class MasterPemotongController extends Controller
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

        $query = MasterPemotong::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('NAMA_PEMOTONG', 'LIKE', '%' . $search . '%')
                    ->orWhere('NPWP_PEMOTONG', 'LIKE', '%' . $search . '%')
                    ->orWhere('TKU_PEMOTNG', 'LIKE', '%' . $search . '%');
            });
        }

        $data = $query->limit(10)->get();

        return $this->successResponse('Successfully Requested', $data);
    }

    public function show(MasterPemotong $pemotong)
    {
        $data = $pemotong;

        return $this->successResponse('Successfully Requested', $data);
    }

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasterPemotong::query();
        $pemotongData = $datatableService->getData($request, $query, function ($pemotong, $number) {
            $pemotong->no = $number;

            return $pemotong;
        }, MasterPemotong::$searchableColumns);

        return $this->successResponse('Successfully Requested', $pemotongData);
    }
}
