<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateFormRequest;
use App\Http\Requests\UserUpdateFormRequest;
use App\Iglesia;
use App\UserDate;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validates(){

        if (empty(Auth::id())==false){
            $date = UserDate::find(Auth::id());
            if (empty($date)){
                return false;
            }
            elseif ($date['user_id']==Auth::id()){
                return true;
            }
        }

    }

    public function index()
    {
        $valida = $this->validates();
        switch ($valida){
            case true:
               return redirect('users/dashboard');
                break;
            case false:
                return $this->create();
                break;
        }

    }

    public function dashboard(){

      $pastor=NULL;
      //obtieene la iglesia del usuario
      $iglesia=  User::find(Auth::id())->Pertenece->flatten()->pluck('name','id')->toArray();

      foreach ($iglesia as $key => $value) {
          
            $data_iglesia = Iglesia::find($key)->Miembros->flatten()->pluck('name','id');

                $miembros_count=$data_iglesia->count();                
    
            foreach ($data_iglesia as $id => $name) {
                $data_user = User::find($id)->tieneRol()->toArray();

                foreach ($data_user as $rol_id => $rol) {
                
                    do {
                        if($rol == 'Pastor'){
                            $pastor_name= $name;
                            $pastor_lastname= User::where('id', $id)->pluck('last_name');
                           $pastor= $pastor_name.' '.$pastor_lastname[0];
                           break;
                        }
                    } while (0);
                }
            }
        }
        if (!empty($iglesia)) {
            
            $esMiembro=true; 
            
            return view('users.dashboard', compact('esMiembro','iglesia', 'pastor', 'miembros_count',));
        }
        else {
         $esMiembro=false;
         $iglesias = Iglesia::all()->flatten()->pluck('name', 'id'); 
            return view('users.dashboard', compact('esMiembro', 'iglesias',));   
        }

    }

    public function create()
    {
        if(empty(User::findOrFail(Auth::id())->Pertenece->toArray())){
            $iglesias = Iglesia::all()->flatten()->pluck('name', 'id');
            $esMiembro= false;
            return view('users.regdate', compact('iglesias','esMiembro'));
          }
        else{
            $esMiembro= true;
            return view('users.regdate',compact('esMiembro'));
        }
    }


    public function store(UserCreateFormRequest $request)
    {
        $valida = $this->validates();
        if ($valida==true){
            return redirect('/users');
        }

        else {

            $date= new UserDate();
            $date->user_id=auth::id();
            $date->fecha_nacimiento=$request->get('fecha_nacimiento');
            $date->lugar_nacimiento=$request->get('lugar_nacimiento');
            $date->telefono=$request->get('telefono');
            $date->cedula=$request->get('cedula');
            $date->sexo=$request->get('sexo');
            $date->ciudad=$request->get('ciudad');
            $date->estado=$request->get('estado');
            $date->direccion=$request->get('direccion');
            $date->nacionalidad=$request->get('nacionalidad');
            $date->estado_civil=$request->get('estado_civil');

            $date->save();

            if ($request->get('iglesia') !== null ){
                User::findOrFail(Auth::id())->asignarIglesia($request->get('iglesia'));
            }

            return $this->index();

        }

    }


    public function show($id)
    { $valida = $this->validates();
        $user_date=UserDate::Where('user_id', $id)->firstOrFail();
        $user=User::findOrFail($id);
        $rol= User::find($id)->roles->flatten()->pluck('name')->last();
        if ($valida==true){
            return view('users.show_profile', compact('user_date','user','rol',));
        }
        else {
            return redirect('/users');
        }


    }


    public function edit($id)
    {
        $valida = $this->validates();
        if ($valida==false){

            return view('users.regdate');
        }

        else{
            $user_date = UserDate::Where('user_id', $id)->firstOrFail();
            $user = User::findOrFail($id);
            return view('users.edit', compact('user_date', 'user',));
        }
    }

    public function update(UserUpdateFormRequest $request, $id)
    {
        $date = UserDate::where('user_id', $id)->firstOrFail();
        $user = User::findOrFail($id);

        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');

        
        $date->fecha_nacimiento=$request->get('fecha_nacimiento');
        $date->lugar_nacimiento=$request->get('lugar_nacimiento');
        $date->telefono=$request->get('telefono');
        $date->sexo=$request->get('sexo');
        $date->ciudad=$request->get('ciudad');
        $date->estado=$request->get('estado');
        $date->direccion=$request->get('direccion');
        $date->nacionalidad=$request->get('nacionalidad');
        $date->estado_civil=$request->get('estado_civil');
        if ($request->hasFile('imagen')){
            $file = $request->imagen;
            $collection = Str::of(Auth::user()->email)->explode('@');
            $filename = $collection[0].$collection[1].'.'.$file->extension();
            $ruta= public_path('/imgProfile/'.$filename) ;
            Image::make($file->getRealPath())
                ->resize(600,400, function ($constraint){
                        $constraint->aspectRatio();
                    })
                    ->save($ruta,72);
            $user->imagen=$filename;
        }
        $date->update();
       $user->update();
        return redirect('/users/'.Auth::id());
    }


    public function destroy($id)
    {
        //
    }

    public function asignarIglesia(){
        
        User::findOrFail(Auth::id())->asignarIglesia($request->get('iglesia'));

        return redirect('users/dashboard');
    }





}
