<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\TaxPPh21;
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
}
