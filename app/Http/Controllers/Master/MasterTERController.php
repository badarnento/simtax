<?php

namespace App\Http\Controllers\Master;

use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterTER;
use App\Services\BaseDataTableService;

class MasterTERController extends Controller
{
    use ResponseTrait;

    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = MasterTER::query();
        $terData = $datatableService->getData($request, $query, function ($ter, $number) {
            $ter->no = $number;
            $ter->PENGHASILAN_MIN = CommonHelper::thousandFormat($ter->PENGHASILAN_MIN);
            $ter->PENGHASILAN_MAX = CommonHelper::thousandFormat($ter->PENGHASILAN_MAX);
            return $ter;
        }, MasterTER::$searchableColumns);

        return $this->successResponse('Successfully Requested', $terData);
    }
}
