@extends('layouts.app')
@section('content')
    <div class="container" style="padding-right:5%;  padding-left: 5%; padding-top: 2%">
        <div class="row-cols-1">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Registro de Datos </h3>

            </div>

                <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}" role="form" nctype="multipart/form-data">
                   @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Teléfono</label>
                                <input type="tel" class="form-control"  name="telefono" value="{{ old('telefono') }}" placeholder="Enter ..."></input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Cédula</label>
                                <input type="number" class="form-control" name="cedula" value="{{ old('cedula') }}" rows="3" placeholder="Enter ..." ></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Sexo</label>
                                <select name="sexo" class="form-control">
                                    <option value="" selected>-Seleciona una opcion-</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Ciudad</label>
                                <input type="text" class="form-control" autocapitalize="sentences" name="ciudad" value="{{ old('ciudad') }}" placeholder="Enter ..." ></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <input type="text" class="form-control"  autocapitalize="sentences" name="estado" value="{{ old('estado') }}" placeholder="Enter ..."></input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" class="form-control" autocapitalize="sentences" name="direccion"  value="{{ old('direccion') }}" placeholder="Enter ..." ></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nacionalidad</label>
                                <input type="text" class="form-control" autocapitalize="sentences" name="nacionalidad"  value="{{ old('nacionalidad') }}" placeholder="Enter ..."></input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Estado Civil</label>
                                <select class="form-control" name="estado_civil">
                                    <option value="" selected>-Seleciona una opcion-</option>
                                    <option value="casado">Casado</option>
                                    <option value="soltero">Soltero</option>
                                    <option value="viudo">Viudo</option>
                                    <option value="divorciado">Divorciado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="chec">Desea Registrar la iglesia a la que pertenece?</label>
                                <input type="checkbox" id="checkiglesia" onChange="iglesiareg(this);" > <b>Si</b>
                                <div  class="input-group  col-auto">
                                    <select id="regiglesia" disabled  class="form-control @error('iglesia') is-invalid @enderror" name="iglesia">
                                        <option selected value=null >-Seleciona un Opción</option>
                                        @foreach($iglesias as $id => $iglesia)
                                        <option value="{{$id}}" >  {{$iglesia}} </option>>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        @error('iglesia')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-auto">
                            <button type="submit" class="btn btn-block btn-success">
                                {{ __('Register') }}
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
    </div>
        <!-- Modal errors validate-->


@endsection
