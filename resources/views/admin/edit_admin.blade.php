@extends('layouts.app')

@section('title') Perfil -@endsection

@section('content')
    <div class="container">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-10">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <form method="POST" action="{{ route('admin.update', $user->id ) }}" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @if ($errors->any())
                                        <script>
                                            $(document).ready(function()
                                            {
                                                $("#miModal").modal("show");
                                            });
                                        </script>
                                    @endif
                                @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div id="imagenPreview" >
                                                    <img id="actual" width='250' height='250' class="img-circle img-bordered" src="{{ asset('imgprofile/').'/'.$user->imagen }}" alt="User profile picture">
                                                </div>
                                                <br>
                                                <div class="input-group">

                                                    <span><b>Actualziar imagén de Perfil</b></span>
                                                    <input type="file" class="form-control-file" id="imagen" name="imagen">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nombres:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"  autocapitalize="sentences"  name="name" value="{{$user->name}}" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Apellidos:</label>
                                                <input type="text" class="form-control"  autocapitalize="sentences"  name="last_name" value="{{$user->last_name}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Correo:</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control"  autocapitalize="sentences"  name="email" value="{{$user->email}}" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Fecha de Nacimiento</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control" name="fecha_nacimiento"  data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false" value="{{$user_date->fecha_nacimiento}}">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Lugar de Nacimiento</label>
                                                <input type="text" class="form-control"   autocapitalize="sentences" name="lugar_nacimiento" value="{{$user_date->lugar_nacimiento}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Teléfono</label>
                                                <input type="tel" class="form-control"  name="telefono" value="{{$user_date->telefono}}"></input>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Cédula</label>
                                                <input type="number" class="form-control" name="cedula" rows="3" value="{{$user_date->cedula}}"></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- select -->
                                            <div class="form-group">
                                                {{$user_date->sexo}}
                                                <label>Sexo: </label>
                                                <select name="sexo" class="form-control" value="{{$user_date->sexo}}">
                                                    <option >-Seleciona una opcion-</option>
                                                    <option  @if($user_date->sexo=='Masculino') selected @endif value="Masculino">Masculino</option>
                                                    <option @if($user_date->sexo=='Femenino') selected @endif value="Femenino">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control" autocapitalize="sentences" name="ciudad" rows="3" value="{{$user_date->ciudad}}" ></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Estado</label>
                                                <input type="tel" class="form-control" autocapitalize="sentences" name="estado" value="{{$user_date->estado}}"></input>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Dirección</label>
                                                <input type="text" class="form-control" autocapitalize="sentences" name="direccion"  value="{{$user_date->direccion}}" ></input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Nacionalidad</label>
                                                <input type="tel" class="form-control" autocapitalize="sentences" name="nacionalidad"  value="{{$user_date->nacionalidad}}"></input>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Estado Civil</label>
                                                <select class="form-control" name="estado_civil">
                                                    <option >-Seleciona una opcion-</option>
                                                    <option @if($user_date->estado_civil=='Casado') selected @endif value="casado">Casado</option>
                                                    <option @if($user_date->estado_civil=='Soltero') selected @endif value="soltero">Soltero</option>
                                                    <option @if($user_date->estado_civil=='Viudo') selected @endif value="viudo">Viudo</option>
                                                    <option @if($user_date->estado_civil=='Divorciado') selected @endif value="divorciado">Divorciado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-sm-2">
                                            <button type="submit" class="btn btn-block btn-success">
                                                {{ __('Guardar') }}
                                            </button>
                                        </div>

                                        <!-- /.col -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <!-- Modal errors validate-->

@endsection

