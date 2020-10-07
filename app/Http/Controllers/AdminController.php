<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminUserUpdateFormRequest;
use App\User;
use App\Iglesia;
use App\UserDate;
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
    {   $user = User::all();
        $ig= DB::table('iglesia_user')->count();
        
        return view('admin.index', [
            'users_count' => User::all()->count(),
            'iglesias_count' => Iglesia::all()->count(), 
            'miembros_registrados' => $ig,  
        ]);
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
            return view('admin.show_profile', ['user_date' => UserDate::Where('user_id', $id)->firstOrFail() , 'user'=>User::findOrFail($id)]);
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
            return view('admin.edit_admin', ['user_date' => UserDate::Where('user_id', $id)->firstOrFail() , 'user'=>User::findOrFail($id)]);
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

        $date->user_id= Auth::id();
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








