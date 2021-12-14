<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$data = customer::orderByDesc('created_at')->get();

        $data = customer::join('preferentials', 'preferentials.id', 'customers.preferential_id')
            ->join('users', 'users.id', 'customers.user_id')
            ->where('users.c_id', $request->c_id)
            ->select('customers.*', 'preferentials.title as preferential')
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
            customer::create([
                'name'=>$request->data['name'],
                'address'=>$request->data['address'],
                'telphone'=>$request->data['telphone'],
                'preferential_id'=>$request->data['preferential_id'],
                'remark'=>$request->data['remark'],
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
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = customer::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        customer::where('id', $id)->update([
            'name'=>$request->data['name'],
            'address'=>$request->data['address'],
            'telphone'=>$request->data['telphone'],
            'preferential_id'=>$request->data['preferential_id'],
            'remark'=>$request->data['remark'],
            'user_id'=>$request->data['user_id'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        customer::whereIn('id', $request->id)->delete();
    }
}
