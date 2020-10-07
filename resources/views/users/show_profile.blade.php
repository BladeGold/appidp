@extends('layouts.app')

@section('title') Perfil -@endsection

@section('content')
    <div class="container">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Imagen de Perfil -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img  class="img-circle img-bordered" width="200" height="200" src="{{ asset('imgprofile/').'/'.Auth::user()->imagen }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{$user->name}} {{$user->last_name}}</h3>

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Fecha de Nacimiento: </b> <a class="float-right">{{$user_date->fecha_nacimiento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Sexo: </b> <a class="float-right">{{$user_date->sexo}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Lugar de Nacimiento: </b> <a class="float-right">{{$user_date->lugar_nacimiento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Localidad: </b> <a class="float-right">{{$user_date->estado}}, {{$user_date->ciudad}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-8">
                        <!-- Otros Datos Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Otros Datos</h3>

                                <div class="col-sm-3 float-left"> <a href="{{route('users.edit', $user->id )}} "><button type="button" class="btn btn-block btn-warning btn-sm">Editar</button></a></div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Estado Civil:</strong>
                                <p class="text-muted">
                                    {{$user_date->estado_civil}}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección:</strong>
                                <p class="text-muted">{{$user_date->direccion}}</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Nacionalidad: </strong>
                                <p class="text-muted">
                                    {{$user_date->nacionalidad}}
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Cedula:</strong>
                                <p class="text-muted">{{$user_date->cedula}}</p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Telefono: </strong>

                                <p class="text-muted">
                                    {{$user_date->telefono}}
                                </p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.col -->
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
