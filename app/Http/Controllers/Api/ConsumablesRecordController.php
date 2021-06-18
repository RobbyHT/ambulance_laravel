<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\consumablesRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ConsumablesRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $str = "";
        foreach($request->arr as $val){
            if($val != null){
                $resoult = consumablesRecord::create([
                        'dispatch_id' => $request->dispatchId,
                        'consumables_id'=>$val
                    ]);
            }
        }
        //Log::info($resoult);
        return response($resoult, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\consumablesRecord  $consumablesRecord
     * @return \Illuminate\Http\Response
     */
    public function show(consumablesRecord $consumablesRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\consumablesRecord  $consumablesRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(consumablesRecord $consumablesRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\consumablesRecord  $consumablesRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, consumablesRecord $consumablesRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\consumablesRecord  $consumablesRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(consumablesRecord $consumablesRecord)
    {
        //
    }
}
