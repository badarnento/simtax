<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\BaseDataTableService;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
    
    public function getListing(Request $request, BaseDataTableService $datatableService)
    {
        $query = User::select(['id', 'name', 'email', 'created_at']);
        return response()->json(
            $datatableService->getData($request, $query, function ($user, $number) {
                return [
                    'id'         => $user->id,
                    'no'         => $number,
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'created_at' => Carbon::parse($user->created_at)->format('d-m-Y'),
                ];
            }, User::$searchableColumns)
        );
    }
}
