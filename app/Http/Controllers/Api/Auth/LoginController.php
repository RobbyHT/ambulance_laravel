<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Passport\Client;

/**
 * 第三方登入 CCTV 自動登入，讀取驗證碼、讀取使用者資訊、前端畫面錯誤回傳
 *
 * 包含API登入、CCTV登入、自動登入，如果有登入需求建議使用以下敘述
 *
 * 請使用原始的 /oauth/token 讓客戶端介接API認證功能，自己附上客戶端ID SECRET 等資訊。.
 *
 * @package App\Http\Controllers\Api\Auth
 */
class LoginController extends Controller
{
    /**
     * 用於前端擷取所有錯誤訊息，只要前端有錯誤都會回傳紀於Log
     *
     * 可由這個方法再送一次請求回報前端接收到錯誤！因為之前有發生被廠商的代理伺服器擋掉
     * 伺服器根本收不到訊息，但客戶端顯示錯誤，因此把傳給客戶端的內容，再傳回伺服器一次。
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Symfony\Component\HttpFoundation\Response
     */
    public function errorInfo(Request $request)
    {
        Log::error($request->res);
        return response('ok', 200);
    }
}
