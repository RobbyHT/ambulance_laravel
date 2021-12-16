<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\company;
use App\Rules\RulePerid;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\RegMail;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'account' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'perid' => ['required', 'string', new RulePerid],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $license_VP = $data['license_VP'] ?? '';

        return User::create([
            'account' => $data['account'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'perid' => $data['perid'],
            'email' => $data['email'],
            'telphone' => $data['telphone'],
            'birther' => $data['birther'],
            'gender' => $data['gender'],
            'license_VP' => $license_VP,
            'license_path' => $data['license_path'],
            'permission' => $data['permission'],
            'c_id' => $data['c_id'],
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validator = $this->validator($data);
        
        if ($validator->fails()) {
            return redirect('auth-register')
                        ->withErrors($validator,'regdata')
                        ->withInput($request->all());
        }
        
        $validator->validate();

        DB::beginTransaction();
        try {
            if($request->permission == 'unit'){
                do {
                    $token = Str::random(80);
                    $tokenCheck = company::where('c_key', $token)->first();
                    if(isset($tokenCheck)){
                        $sameToken = true;
                    }else{
                        $sameToken = false;
                    }
                }while($sameToken);

                $data['c_id'] = company::create([
                    'c_name' => $data['c_name'],
                    'c_tel' => $data['c_tel'],
                    'c_addr' => $data['c_addr'],
                    'tax_id' => $data['tax_id'],
                    'c_key' => $token,
                ])->id;
            }else{
                $c_key = company::whereNotNull('c_key')->where('c_key', $request->company_key)->first();
                if($c_key == ''){
                    return redirect('auth-register')
                                ->withErrors(["key"=>"key not found."], 'regdata')
                                ->withInput($request->all());
                }
                $data['c_id'] = $c_key->id;
            }

            $data['perid'] = Crypt::encryptString($data['perid']);
            $data['password'] =  $this->generateRandomString(8);

            $data['license_path'] = null;
            if($request->license_img != null && $request->license_img != "undefined"){
                $data['license_path'] = Storage::disk('public')->put('license_img', $request->license_img);
            }

            event(new Registered($user = $this->create($data)));
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        $s = $this->send($data);
        
        return $request->wantsJson()
                        ? new Response('', 201)
                        : redirect($this->redirectPath())->with('msg','已寄出帳密到email：'.$data['email'].'，請使用該帳密登入!!');  
    }

    protected function generateRandomString(int $length) 
    {
        //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ=/\@#$%&';
        $characters = '123QWEASD';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    protected function send(array $data)
    {
        try {
            // 收件者務必使用 collect 指定二維陣列，每個項目務必包含 "name", "email"
            $to = collect([
                ['name' => $data['name'], 'email' => $data['email']]
            ]);
    
            // 提供給模板的參數
            $data['subject'] = '醫指派註冊訊息';
            $data['msg'] = '您好，登入用的帳號/密碼如下，請至首頁登入後修改密碼!!';
            $data['url'] = 'http://140.131.115.55/';

            // 若要直接檢視模板
            // echo (new Warning($data))->render();die;
 
            Mail::to($to)->send(new RegMail($data));

            Log::info($data);
            return "ok"; //event(new LogSeningMessage());

        } catch (\Exception $e) {

            Log::info($e);

            if (count(Mail::failures()) > 0) {
                //return Mail::failures();
                return $e;
            }
            return "failures";

        }        
    }
}
