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
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('imgprofile/').'/'.$user()->imagen }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{$user->name}} {{$user->last_name}}</h3>

                                <p class="text-muted text-center">{{$rol}}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> <b>Fecha de Nacimiento: </b> <a class="float-right">{{$user_date->fecha_nacimiento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-transgender" aria-hidden="true"></i> <b>Sexo: </b> <a class="float-right">{{$user_date->sexo}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-map-pin" aria-hidden="true"></i>  <b>Lugar de Nacimiento: </b> <a class="float-right">{{$user_date->lugar_nacimiento}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-map-marker-alt mr-1"></i> <b>Localidad: </b> <a class="float-right">{{$user_date->estado}}, {{$user_date->ciudad}}</a>
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
                                @can('Administrador')
                                    <div class="col-sm-3 float-left"> <a href="{{route('admin.edit', $user->id )}} "><button type="button" class="btn btn-block btn-warning btn-sm">Editar</button></a></div>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-book mr-1"></i> Estado Civil:</strong>
                                <p class="text-muted">
                                    {{$user_date->estado_civil}}
                                </p>

                                <hr>

                                <strong> <i class="fa fa-map" aria-hidden="true"></i> Dirección:</strong>
                                <p class="text-muted">{{$user_date->direccion}}</p>

                                <hr>

                                <strong> <i class="fa fa-passport" aria-hidden="true"></i> Nacionalidad: </strong>
                                <p class="text-muted">
                                    {{$user_date->nacionalidad}}
                                </p>

                                <hr>

                                <strong> <i class="fa fa-id-card-o" aria-hidden="true"></i> Cedula:</strong>
                                <p class="text-muted">{{$user_date->cedula}}</p>

                                <hr>

                                <strong> <i class="fa fa-mobile" aria-hidden="true"></i> Telefono: </strong>

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

