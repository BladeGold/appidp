<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "";//RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        $user = User::with('roles')->where('id', $user->id)->first();
        $role= $user->roles->first()->name;
        $us= User::with('Pertenece')->where('id', $user->id)->first();
        $iglesia_id=$us->Pertenece->pluck('id')->last();
        if($iglesia_id !== null){
        session(['iglesia_id' => $iglesia_id]);
        }      
        if($role == 'Administrador'){
            return redirect()->route('admin.dashboard') ;
        }
        else{
           return redirect('/users');
        }
    }
}