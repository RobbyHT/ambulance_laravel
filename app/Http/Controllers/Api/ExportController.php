<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ExportController extends Controller
{
    public function userTake($vm)
    {
        
        $coll = new UserErrorExport($errorItems);

        Excel::store($coll, 'public/excel/usersError.xlsx');
        return asset('storage/excel/usersError.xlsx');
    }
}
