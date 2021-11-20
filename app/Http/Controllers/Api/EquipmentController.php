<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = equipment::orderBy('id')->get();
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
        equipment::create([
            'name'=>$request->data['name'],
            'amount'=>$request->data['amount'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = equipment::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        equipment::where('id', $id)->update([
            'name'=>$request->data['name'],
            'amount'=>$request->data['amount']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        equipment::whereIn('id', $request->id)->delete();
    }
}
