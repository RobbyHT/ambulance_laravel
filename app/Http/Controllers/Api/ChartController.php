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
        $str = "SELECT
                        to_char(DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd')), 'yyyy/mm') as d_date,
                        COUNT(id) AS count
                FROM dispatch_records
                where id is not null";
        if($request->start_date != ''){
            $str .= " and d_date >= ?";
            array_push($arr, $request->start_date);
        }
        if($request->end_date != ''){
            $str .= " and d_date <= ?";
            array_push($arr, $request->end_date);
        }
        $str .= " GROUP BY DATE_TRUNC('month', TO_DATE(d_date, 'yyyy-mm-dd'))";
        $str .= " order by d_date asc";
        $data = DB::select($str, $arr);

        return response()->json($data);
    }
}
