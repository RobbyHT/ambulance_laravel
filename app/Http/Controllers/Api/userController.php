<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\company;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = User::join('companies', 'companies.id', 'users.c_id')
            ->where('c_id', $request->c_id)
            ->where('users.id', '!=', $request->user_id)
            ->select('users.*', 'companies.c_name')
            ->orderByDesc('created_at')
            ->get();

        $data = [];
        foreach($res as $re){
            $permission = '';
            switch($re['permission']){
                case 'admin':
                    $permission = '系統管理者';
                    break;
                case 'driver':
                    $permission = '司機';
                    break;
                case 'EMT':
                    $permission = '醫療人員';
                    break;
                case 'unit':
                    $permission = '單位管理者';
                    break;
                case 'common':
                    $permission = '一般使用者';
                    break;
            }
            $data[] = [
                'id'=>$re['id'],
                'account'=>$re['account'],
                'name'=>$re['name'],
                'gender'=>$re['gender']=='M'?'男':'女',
                'birther'=>$re['birther'],
                'perid'=>Crypt::decryptString($re['perid']),
                'permission'=>$permission,
                'email'=>$re['email'],
                'telphone'=>$re['telphone'],
                'created_at'=>$re['created_at'],
                'updated_at'=>$re['updated_at'],
                'deleted_at'=>$re['deleted_at']
            ];
        }
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

    public function updateCompanyKey(Request $request)
    {
        do {
            $token = Str::random(80);
            $tokenCheck = company::where('c_key', $token)->first();
            if(isset($tokenCheck)){
                $sameToken = true;
            }else{
                $sameToken = false;
            }
        }while($sameToken);

        company::where('id', $request->c_id)->update([
            'c_key' => $token
        ]);
    }

    public function getCompanyKey(Request $request)
    {
        $data = company::where('id', $request->c_id)
            ->select('c_key')
            ->first();
        return response()->json($data);
    }
}
