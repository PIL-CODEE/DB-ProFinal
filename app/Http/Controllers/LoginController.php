<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function register(Request $request){

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->id_tipo_usuario = 1;

        $user->save();

        Auth::login($user);

        return redirect(route('usuario.index-clases'));
    }
    
    public function login(Request $request){

        $credentials = [
            "email"=>$request->email,
            "password"=>$request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials, $remember)){
            
            $request->session()->regenerate();

            return redirect()->intended(route('usuario.index-clases'));

        } else {
            return redirect(route('login'));
        }
        
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}