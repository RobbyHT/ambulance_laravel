<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DispatchRecord;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DispatchRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DispatchRecord::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // $result = json_decode($data[0], true);
        Log::info($data);
        // die();
        $resoult = DispatchRecord::create($data);
        return response($resoult, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DispatchRecord  $dispatchRecord
     * @return \Illuminate\Http\Response
     */
    public function show(DispatchRecord $dispatchRecord, int $id)
    {
        //$data = DispatchRecord::find($id);
        $data = DispatchRecord::join('users', 'users.id', 'dispatch_records.driver_id')
            ->select('dispatch_records.*', 'users.name as driver')
            ->where('dispatch_records.id', $id)
            ->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DispatchRecord  $dispatchRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(DispatchRecord $dispatchRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DispatchRecord  $dispatchRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DispatchRecord $dispatchRecord, int $id)
    {
        
        DispatchRecord::where('id', $id)->update(['state' => $request->state]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DispatchRecord  $dispatchRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DispatchRecord::where('id', $id)->delete();
    }

    public function checkTask(DispatchRecord $dispatchRecord)
    {
        $data = DB::select("select * from dispatch_records
                                where d_date::date = CURRENT_DATE 
                                        and d_time::time < CURRENT_TIME
                                        and state = 1");
        return response()->json($data);
    }

    public function driverTask($userid)
    {
        $data = DB::select("select * from dispatch_records
                                where driver_id = ?", [$userid]);
        return response()->json($data);
    }

    public function emtTask($userid)
    {
        $data = DB::select("select a.* from dispatch_records as a, dispatch_emts as b
                                where a.id = b.dispatch_id and b.user_id = ?", [$userid]);
        return response()->json($data);
    }

    public function getEvents($userid)
    {
        $data = DB::select("select id, (dispatch_records.start || '到' || dispatch_records.end) as title, d_date as start from dispatch_records 
        where user_id = ?", [$userid]);
        return response()->json($data);
    }
}
