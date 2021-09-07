<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\industry;

class AuthenticationController extends Controller
{
  //Login page
  public function loginPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-login',['pageConfigs' => $pageConfigs]);
  }
  //Register page
  public function registerPage(Request $request){
    //return var_dump(session()->all());
    if (Auth::check()) {
       Auth::logout();
    }
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];

    //$industries = industry::all();

    return view('pages.auth-register',[
      'pageConfigs' => $pageConfigs,
      //'industries' => $industries,
      ]);
  }
   //forget Password page
   public function forgetPasswordPage(){
    if (Auth::check()) {
      Auth::logout();
   }
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-forgot-password',['pageConfigs' => $pageConfigs]);
  }
   //reset Password page
   public function resetPasswordPage()
   {
    if (Auth::check()) {
      Auth::logout();
   }
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-reset-password',['pageConfigs' => $pageConfigs]);
  }
   //auth lock page
   public function authLockPage(){
    $pageConfigs = ['bodyCustomClass'=> 'bg-full-screen-image'];
    return view('pages.auth-lock-screen',['pageConfigs' => $pageConfigs]);
  }
}
