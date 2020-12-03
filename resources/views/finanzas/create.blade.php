@extends('layouts.app')

@section('content')

    <div class="row center">
        <div class="card card-primary">

    <div class="card-header">
        Header
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('finanzas.store') }}" role="form" nctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Fecha del activo</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="fecha_activo" value="{{ old('fecha_activo') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Lugar de Nacimiento</label>
                        <input type="text" class="form-control"  autocapitalize="sentences"  name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" placeholder="Enter ..." >
                    </div>
                </div>
            </div>
        </form>
    </div>Ñ
    <div class="card-footer text-muted">
        Footer
    </div>

        </div>
        </div>
    </div>

    
@endsection