<?php

namespace App\Http\Controllers\Master;

use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterPTKP;
use App\Services\BaseDataTableService;

class MasterPTKPController extends Controller
{
    use ResponseTrait;

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasterPTKP::query();
        $terData = $datatableService->getData($request, $query, function ($ptkp, $number) {
            $ptkp->no = $number;
            return $ptkp;
        }, MasterPTKP::$searchableColumns);

        return $this->successResponse('Successfully Requested', $terData);
    }
}
