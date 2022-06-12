<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginUsersController extends Controller

{
    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if($validate->fails()){
            return back()->withErrors(['msg' => 'Debes selecionar el reCAPTCHA']);}
            else{
                if(auth()->attempt(request(['email','password'])) == false){
                    return back()->withErrors(['email' => 'Los datos introducidos no coinciden con nuestros registros'])
                    ->withInput(request(['email']));
                }
                if( Auth::user()){
                    if(Auth::user()->rol =='admin'){
                        return redirect('/welcome_home');
                    }
                    else if(Auth::user()->rol =='profesor'){
                        return redirect('/welcome_home_profe');
                    }
                    else{
                        return redirect('/');
                    }
                }
            }
        }
        public function destroy(){
            auth()->logout();
            return redirect()->route('inicio')->with('mensaje', 'Session cerrada exitosamente');
        }
    }