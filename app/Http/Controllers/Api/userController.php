<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\TryCatch;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::join('companies', 'companies.id', 'users.c_id')
            ->select('users.*', 'companies.c_name')
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
        $data = $request->all();
        $resoult = User::updateOrCreate(['id' => $request->id], $data);
        return response($resoult, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::join('companies', 'companies.id', 'users.c_id')
            ->where('users.id', $id)
            ->select('users.*', 'companies.c_name')
            ->first();
        try {
            $data['perid'] = Crypt::decryptString($data['perid']);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->data['permission'] != ''){
            User::where('id', $id)->update([
                'permission' => $request->data['permission'],
            ]);
        }
        User::where('id', $id)->update([
            'name'=>$request->data['name'],
            'gender'=>$request->data['gender'],
            'birther'=>$request->data['birther'],
            'telphone'=>$request->data['telphone']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::whereIn('id', $request->id)->delete();
    }

    public function login(Request $request)
    {
        $data = User::where('account', $request->account)->where('perid', $request->password)->first();

        /*if($data != null){
            $resoult = $data->permission;
        }*/
        return response()->json($data);

        //return response($data, Response::HTTP_OK);
    }

    public function userTake($vm)
    {
        if($vm === "driver"){
            $data = User::where('permission', 'driver')->get();
        }else if($vm === "EMT"){
            $data = User::where('permission', 'EMT')->get();   
        }
        return response()->json($data);
    }
}
