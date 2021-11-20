<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Exports\UserDataExport;
use Illuminate\Support\Facades\Auth;

class ExportController extends Controller
{
    public function exportUser(Request $request)
    {
        $data = User::where('c_id', $request->c_id)
            ->select('account', 'name', 'gender', 'birther', 'perid', 'email', 'telphone', 'license_VP', 'created_at')
            ->get();

        $data = json_decode(json_encode($data), true);
        $coll = new UserDataExport($data);

        Excel::store($coll, 'public/excel/userData.xlsx');
        return asset('storage/excel/userData.xlsx');
    }
}
