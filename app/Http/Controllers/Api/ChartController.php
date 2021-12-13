<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DispatchRecord;


class ChartController extends Controller
{
    public function dispatchCount(Request $request)
    {
        $arr = [];
        $dateVer = "";
        if($request->start_date != ''){
            $dateVer .= " and d_date >= ?";
            array_push($arr, $request->start_date);
        }
        if($request->end_date != ''){
            $dateVer .= " and d_date <= ?";
            array_push($arr, $request->end_date);
        }
        switch($request->item){
            case "user":
                if($request->start_date != ''){
                    array_push($arr, $request->start_date);
                }
                if($request->end_date != ''){
                    array_push($arr, $request->end_date);
                }
                $str = "select users.name as key, count from users,
                            (select driver_id as user_id, count(driver_id) from dispatch_records
                                inner join users
                                    on dispatch_records.user_id = users.id and users.c_id = '{$request->c_id}'
                                where dispatch_records.driver_id is not null
                                {$dateVer}
                            group by driver_id
                            union all
                            select dispatch_emts.user_id, count(dispatch_emts.user_id) from dispatch_records
                                inner join users
                                    on dispatch_records.user_id = users.id and users.c_id = '{$request->c_id}'
                                left join dispatch_emts
                                    on dispatch_emts.dispatch_id = dispatch_records.id
                                where dispatch_emts.user_id is not null
                                {$dateVer}
                            group by dispatch_emts.user_id) as b
                        where users.id = b.user_id";
                break;
            case "month":
                $str = "select
                            to_char(DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd')), 'yyyy/mm') as key,
                            count(id) AS count
                        from dispatch_records
                        where id is not null";
                $str .= $dateVer;
                $str .= " group by DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd'))";
                $str .= " order by key asc";
                break;
        }
        
        $data = DB::select($str, $arr);
        return response()->json($data);
    }

    public function simgleDispatchCount(Request $request)
    {
        $arr = [];
        $dateVer = "";
        if($request->start_date != ''){
            $dateVer .= " and d_date >= ?";
            array_push($arr, $request->start_date);
        }
        if($request->end_date != ''){
            $dateVer .= " and d_date <= ?";
            array_push($arr, $request->end_date);
        }
        switch($request->item){
            case "user":
                if($request->start_date != ''){
                    array_push($arr, $request->start_date);
                }
                if($request->end_date != ''){
                    array_push($arr, $request->end_date);
                }
                $str = "select users.name as key, count from users,
                            (select driver_id as user_id, count(driver_id) from dispatch_records
                                inner join users
                                    on dispatch_records.user_id = users.id and users.id = '{$request->user_id}'
                                where dispatch_records.driver_id is not null
                                {$dateVer}
                            group by driver_id
                            union all
                            select dispatch_emts.user_id, count(dispatch_emts.user_id) from dispatch_records
                                inner join users
                                    on dispatch_records.user_id = users.id and users.c_id = '{$request->user_id}'
                                left join dispatch_emts
                                    on dispatch_emts.dispatch_id = dispatch_records.id
                                where dispatch_emts.user_id is not null
                                {$dateVer}
                            group by dispatch_emts.user_id) as b
                        where users.id = b.user_id";
                break;
            case "month":
                $str = "select
                            to_char(DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd')), 'yyyy/mm') as key,
                            count(id) AS count
                        from dispatch_records
                        where id is not null";
                $str .= $dateVer;
                $str .= " group by DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd'))";
                $str .= " order by key asc";
                break;
        }
        
        $data = DB::select($str, $arr);
        return response()->json($data);
    }
}
