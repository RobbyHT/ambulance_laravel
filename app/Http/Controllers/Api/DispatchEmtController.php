<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\dispatchEmt;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class DispatchEmtController extends Controller
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
        $data = [];
        foreach($request->user_id as $id){
            $data['dispatch_id'] = $request->dispatch_id;
            $data['user_id'] = $id;
            $data['state'] = $request->state;

            $resoult = dispatchEmt::create($data);
        }

        //echo $qq->dispatch_id;

        //$resoult = dispatchEmt::create($data);
        return response($resoult, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dispatchEmt  $dispatchEmt
     * @return \Illuminate\Http\Response
     */
    public function show(dispatchEmt $dispatchEmt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dispatchEmt  $dispatchEmt
     * @return \Illuminate\Http\Response
     */
    public function edit(dispatchEmt $dispatchEmt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dispatchEmt  $dispatchEmt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dispatchEmt $dispatchEmt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dispatchEmt  $dispatchEmt
     * @return \Illuminate\Http\Response
     */
    public function destroy(dispatchEmt $dispatchEmt)
    {
        //
    }
}
