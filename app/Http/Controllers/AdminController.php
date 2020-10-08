<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminUserUpdateFormRequest;
use App\User;
use App\Iglesia;
use App\UserDate;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\DataTables;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('single_admin');
    }

    public function index(Request $request)
    {   
        $miembros_registrados= DB::table('iglesia_user')->count();
        $users_count = User::all()->count();
        $iglesias_count = Iglesia::all()->count(); 
                
        return view('admin.index', compact('users_count','iglesias_count','miembros_registrados') );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  $valida = $this->validates($id);
       

        if ($valida==true){
            $user_date=UserDate::Where('user_id', $id)->firstOrFail();
            $user=User::findOrFail($id);
            $rol= User::find($id)->roles->flatten()->pluck('name')->last();
            return view('admin.show_profile', compact('user_date','user','rol'));
        }
        elseif ($valida==false) {
           return redirect('admin/show_users')->with('mensaje','El usuario no posee datos registrados')->with('tipo','warning');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $valida = $this->validates($id);
        if ($valida==false){
            return redirect('admin/show_users')->with('mensaje','El usuario no posee datos registrados')->with('tipo','warning');
        }
        else{
            
            $roles=Role::all()->flatten()->pluck('name','id');
            $rol= User::find($id)->roles->flatten()->pluck('name')->last();
            $user_date= UserDate::Where('user_id', $id)->firstOrFail();
            $user= User::findOrFail($id);
            return view('admin.edit_admin', compact('user','user_date','roles','rol',));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserUpdateFormRequest $request, $id)
    {
        $date = UserDate::where('user_id', $id)->firstOrFail();
        $user = User::findOrFail($id);

        $user->name=$request->get('name');
        $user->last_name=$request->get('last_name');
        $user->email=$request->get('email');


        $date->fecha_nacimiento=$request->get('fecha_nacimiento');
        $date->lugar_nacimiento=$request->get('lugar_nacimiento');
        $date->telefono=$request->get('telefono');
        $date->sexo=$request->get('sexo');
        $date->ciudad=$request->get('ciudad');
        $date->estado=$request->get('estado');
        $date->direccion=$request->get('direccion');
        $date->nacionalidad=$request->get('nacionalidad');
        $date->estado_civil=$request->get('estado_civil');
        $date->cedula=$request->get('cedula');
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

        $role_id= User::find($id)->roles->flatten()->pluck('id')->last();
        User::find($id)->roles()->updateExistingPivot($role_id, ['role_id' => $request->get('rol')]);
        //dd(User::find($id)->roles->flatten()->pluck('id')->last());
        $date->update();
        $user->update();
        return redirect('/admin/show_users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $user->delete();
        return redirect('admin/show_users');
    }

    public function validates($id){
        if (empty($id)==false){
            $date = UserDate::find($id);
            if (empty($date)==false){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function show_users(Request $request){
        if ($request->ajax()){
            $users=User::all();

            return DataTables::of($users)
                ->addColumn('rol', function ($user){
                    foreach ($user->roles as $role){
                        return $user->name;
                    }
                })
                ->addColumn('action', 'admin.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.show_users' );
    }
}








