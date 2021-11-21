<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Car;
use App\Models\equipment;
use App\Models\DispatchRecord;
use App\Exports\UserDataExport;
use App\Exports\CarDataExport;
use App\Exports\DispatchDataExport;
use App\Exports\EquipmentDataExport;
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

    public function exportCar(Request $request)
    {
        $data = Car::join('users', function($q) use ($request){
                $q->on('cars.driver_id', 'users.id')
                    ->where('users.c_id', $request->c_id);
            })
            ->select('cars.plate', 'users.name as driver_name', 'cars.factory_date', 'cars.expiry_date', 'cars.deleted_at', 'cars.created_at', 'cars.updated_at')
            ->get();

        $data = json_decode(json_encode($data), true);
        $coll = new CarDataExport($data);

        Excel::store($coll, 'public/excel/carData.xlsx');
        return asset('storage/excel/carData.xlsx');
    }

    public function exportEquipment(Request $request)
    {
        $data = equipment::select('name', 'amount')->get();

        $data = json_decode(json_encode($data), true);
        $coll = new EquipmentDataExport($data);

        Excel::store($coll, 'public/excel/DispatchDataExport.xlsx');
        return asset('storage/excel/DispatchDataExport.xlsx');
    }

    public function exportDispatch(Request $request)
    {
        $data = DispatchRecord::join('users as user', function($q) use ($request){
            $q->on('dispatch_records.user_id', 'user.id')
                ->where('user.c_id', $request->c_id);
        })
        ->join('users as driver', 'dispatch_records.driver_id', 'driver.id')
        ->select('d_date', 'd_time', 'start', 'end', 'driver.name', 'distance', 'duration', 'totalPay', 'o2', 'elevator', 'special', 'weight', 'phone', 'remark')
        ->orderByDesc('d_date')
        ->get();

        $data = json_decode(json_encode($data), true);
        $coll = new DispatchDataExport($data);

        Excel::store($coll, 'public/excel/dispatchData.xlsx');
        return asset('storage/excel/dispatchData.xlsx');
    }
}
