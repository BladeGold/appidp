<?php

namespace App\Http\Controllers;

use App\Http\Requests\IglesiasCreateFormRequest;
use App\Iglesia;
use App\User;
use App\UserDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class IglesiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('single_admin')->except('show','shows');

    }
    public function validates(){

        if (empty(Iglesia::all()->toArray())==true){
            return false;
        }
        else{
            return true;
        }
    }
    public function index(Request $request)
    {
        $validate= $this->validates();
        $pastores= User::WhereDoesntHave('Pertenece')->whereHas('roles', function($query){
                $query->where('name','Pastor');
            })->get()->toArray();
        if ($validate==false){
            return view('iglesias.index', compact('validate', 'pastores'))->with('mensaje','No hay iglesias Registradas')->with('tipo','warning');
        }
        else{
            if ($request->ajax()){
                $iglesias=Iglesia::all();

                return DataTables::of($iglesias)

                    ->addColumn('action', 'iglesias.action')
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('iglesias.index', compact('validate', 'pastores'));
        }
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
    public function store(IglesiasCreateFormRequest $request)
    {
        if (empty($request)==false){
            $iglesia= new Iglesia();

            $iglesia->name= $request->get('name');
            $iglesia->direccion= $request->get('direccion');
           if($request->get('pastor') == !NULL){
                $iglesia->asignarIglesia($request->get('pastor'));

            }

            $iglesia->save();

            return redirect('iglesias');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function shows($id){
        $users = Iglesia::findOrFail($id)->Miembros;
        return DataTables::of($users)
                ->make(true);
    }
    public function show($id)
    {
        $rol= User::findOrFail(Auth::id())->tieneRol()->toArray();

        if($rol[0] == 'Administrador') {

            $iglesia = Iglesia::findOrFail($id);
            $users = Iglesia::findOrFail($id)->Miembros;
            $us = $users->toArray();
            $pastor=User::whereHas('Pertenece', function($query) use($id) {
                $query->where('iglesia_id', $id);
                })->whereHas('roles', function($query){
                $query->where('name','Pastor');
                })->get()->last();    
            if (empty($us)== true) {
                            $existe = false;
                        }            
            if (empty($us) == false) {
                $existe= true;
            }
            $pastores= User::WhereDoesntHave('Pertenece')->whereHas('roles', function($query){
                $query->where('name','Pastor');
            })->get()->toArray();
            
            return view('iglesias.show', compact('users', 'iglesia','pastor','existe', 'pastores'));
        }

        elseif($rol[0] !== 'Administrador'){
        $iglesia_id=User::findOrFail(Auth::id())->Pertenece->flatten()->pluck('id')->last();
            $iglesia= Iglesia::findOrFail($iglesia_id);
            $users= User::whereHas('Pertenece', function($query) use($iglesia_id) {
                $query->where('iglesia_id', $iglesia_id);
                })->get();
            $pastor=User::whereHas('Pertenece', function($query) use($iglesia_id) {
                $query->where('iglesia_id', $iglesia_id);
                })->whereHas('roles', function($query){
                $query->where('name','Pastor');
                })->get()->last();
            
            if (empty($users)== true) {
                $existe = false;
            }            
            if (empty($users) == false) {
                    $existe= true;
            }
            
           return view('iglesias.show', compact('users', 'iglesia', 'pastor','existe',));
        }

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iglesia= Iglesia::findOrFail($id);
        $iglesia->delete();
        return redirect('/iglesias')->with('Mensaje', 'Iglesia eliminada con Exito!')->with('tipo','success');
    }

    public function asignarPastor(Request $request, $id)
    {

        $iglesia= Iglesia::findOrFail($id);
        $iglesia->asignarIglesia($request->get('pastor'));

        return redirect('iglesias/'.$id);
    }
}
