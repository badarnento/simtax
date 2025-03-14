<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BaseDatatableService
{
    public function getData(Request $request, Builder $query, callable $transformCallback, array $searchableColumns)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $draw = $request->input('draw', 0);
        $searchValue = strtolower($request->input('search.value', ''));
        $number = $start + 1;

        $totalRecord = $query->count();

        if (!empty($searchValue) && !empty($searchableColumns)) {
            $query->where(function ($q) use ($searchValue, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhereRaw("LOWER($column) LIKE ?", ["%{$searchValue}%"]);
                }
            });
        }

        $totalFiltered = $query->count();

        $items = $query->offset($start)->limit($length)->get();
        $data = $items->map(function ($item) use (&$number, $transformCallback) {
            return $transformCallback($item, $number++);
        });

        return [
            'data' => $data,
            'draw' => $draw,
            'recordsTotal' => $totalRecord,
            'recordsFiltered' => $totalFiltered,
        ];
    }
}
