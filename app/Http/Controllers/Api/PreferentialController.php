<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\preferential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PreferentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = preferential::where('user_id', $request->user_id)
            ->orderByDesc('created_at')
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
        DB::beginTransaction();
        try {
            preferential::create([
                'title'=>$request->data['title'],
                'content'=>$request->data['content'],
                'discount'=>$request->data['discount'],
                'user_id'=>$request->data['user_id'],
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\preferential  $preferential
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = preferential::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\preferential  $preferential
     * @return \Illuminate\Http\Response
     */
    public function edit(preferential $preferential)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\preferential  $preferential
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        preferential::where('id', $id)->update([
            'title'=>$request->data['title'],
            'content'=>$request->data['content'],
            'discount'=>$request->data['discount'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\preferential  $preferential
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        preferential::whereIn('id', $request->id)->delete();
    }
}
