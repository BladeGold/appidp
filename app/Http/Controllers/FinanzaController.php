<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinanzaActivo;
use App\FinanzaPasivo;
use App\Iglesia;


class FinanzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
    $this->middleware('auth');
    $this->middleware('single_admin')->except('create','show','store');

    }
    
     public function index()
    { 
       
        
        
        return view('finanzas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finanzas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        switch ($request->get('select_finanza')) {
            case 'activo':
                $finanza = new FinanzaActivo();

                $finanza->iglesia_id=$request->get('iglesia_id');
                $finanza->monto=$request->get('monto_activo');
                $finanza->fecha=$request->get('fecha_activo');

                $finanza->save();

                return  redirect('finanzas/',session('iglesia_id'));
                break;
            
            case 'pasivo':
                $finanza = new FinanzaPasivo();

                $finanza->iglesia_id=$request->get('iglesia_id');
                $finanza->monto=$request->get('monto_pasivo');
                $finanza->fecha=$request->get('fecha_pasivo');

                $finanza->save();
                return  redirect('finanzas/'.session('iglesia_id'));
                break;

            case 'ambos':
                $finanza_activo = new FinanzaActivo();
                $finanza_activo->iglesia_id=$request->get('iglesia_id');
                $finanza_activo->monto=$request->get('monto_activo');
                $finanza_activo->fecha=$request->get('fecha_activo');
                $finanza_activo->save();

                $finanza_pasivo = new FinanzaPasivo();
                $finanza_pasivo->iglesia_id=$request->get('iglesia_id');
                $finanza_pasivo->monto=$request->get('monto_pasivo');
                $finanza_pasivo->fecha=$request->get('fecha_pasivo');
                $finanza_pasivo->save();

                return  redirect('finanzas/'.session('iglesia_id'));
                break;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $iglesia= Iglesia::findOrFail($id);

        if ($request->ajax()){
            $finanza_activo=FinanzaActivo::where('iglesia_id',$id);

            return DataTables::of($finanza_activo)

                ->addColumn('action', 'iglesias.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('finanzas.show',compact('iglesia'));
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
        //
    }
}
