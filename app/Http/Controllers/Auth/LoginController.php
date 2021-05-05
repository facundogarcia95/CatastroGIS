<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginLogout;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function __construct()
    {
        ini_set('memory_limit', -1);
    }
    
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){

        $this->validateLogin($request);      
        
        if($this->attempt(['usuario_login' => $request->login,'password' => $request->password,'condicion'=>1])){

            event(new LoginLogout(Auth::user(),1));
            return Redirect::to(session('urlAccedida'))->withCookie( cookie()->forever('usuario', Auth::user()->usuario_id));
        }

         return back()->withErrors(['usuario' => trans('auth.failed')])
         ->withInput(request(['usuario']));
     }

     protected function validateLogin(Request $request){
        $this->validate($request,[
            'login' => 'required|string',
            'password' => 'required|string'
        ]);

    }

    public function logout(Request $request){

        event(new LoginLogout(Auth::user(),2));
        Cookie::forget('usuario');
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }


    protected function attempt($credentials)
        {
            if ( ! isset( $credentials['password'] ) || !isset( $credentials['usuario_login'] )) {
                return false;
            }

            $user = User::where('usuario_login','=',$credentials['usuario_login'])
                        ->where('password','=',md5($credentials['password']))
                        ->first();

            if ($user) {
                Auth::login($user);
                return $user;
            }

            return null;
        }

  


}
