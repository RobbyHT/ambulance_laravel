<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\car;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Car::join('users', 'cars.driver_id', 'users.id')
            ->select('cars.*', 'users.name')
            ->orderByDesc('cars.created_at')
            ->get();
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
        $resoult = car::updateOrCreate(['id' => $request->id], $data);
        return response($resoult, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Car::join('users', 'cars.driver_id', 'users.id')
            ->where('cars.id', $id)
            ->select('cars.*', 'users.name')
            ->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        car::where('id', $id)->update([
            'plate'=>$request->date['plate'],
            'driver_id'=>$request->date['driver_id']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(car $car)
    {
        //
    }
}
