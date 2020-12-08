@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3> <strong> Registro de Finanzas </strong> </h3>
        </div>
        <div class="card card-primary">
        <div class="card-body">
            <form method="POST" action="{{ route('finanzas.store') }}" role="form" nctype="multipart/form-data" >
                @csrf
                <input type="hidden" value="{{session('iglesia_id')}}" name="iglesia_id">
                <div class="form-group">
                <select name="select_finanza" class="form-control" id="tipo_select" onchange="tipo_finanza(this.value)">
                    <option value="select"> Selecciona una opcion </option>
                    <option value="activo"> Registrar Activo </option>
                    <option value="pasivo"> Registrar Pasivo </option>
                    <option value="ambos"> Registrar Activo y Pasivo </option>
                </select>
                </div>
            
                <div class="row" hidden id="activo">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha del Activo</label>
                            <div class="input-group">
                                <input type="date" id="fecha_activo"  class="form-control" name="fecha_activo" value="{{ old('fecha_activo') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                            </div>
                            <div class="input-group-append">
                                @error('iglesia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Monto del Activo</label>
                            <input type="number" step="0.01" min="1" id="monto_activo" class="form-control"  autocapitalize="sentences"  name="monto_activo" value="{{ old('monto_activo') }}" placeholder="Ejemplo: 123.00" >
                        </div>
                    </div>
                </div>

                <!--Comienzo del Pasivo-->
                
                <div class="row" hidden id="pasivo">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fecha del Pasivo</label>
                            <div class="input-group">
                                <input type="date" id="fecha_pasivo" class="form-control" name="fecha_pasivo" value="{{ old('fecha_activo') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Monto del Pasivo</label>
                            <input type="number" step="0.01" min="1" id="monto_pasivo"  class="form-control"  autocapitalize="sentences"  name="monto_pasivo" value="{{ old('monto_activo') }}" placeholder="Ejemplo: 123.00" >
                        </div>
                    </div>
                </div>

           
        </div>
        <div class="card-footer text-muted" hidden id="boton">
            <div class="row">
                <!-- /.col -->
                <div class="col-auto">
                    <button type="submit" class="btn btn-block btn-success">
                        {{ __('Guardar') }}
                    </button>
                </div>

                <div class="col-auto">
                    <button type="reset" class="btn btn-block btn-danger">
                        {{ __('Limpiar') }}
                    </button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        </div>

        
    </div>
    
@endsection