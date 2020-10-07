@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-sm-6 mx-auto">
        <div class="card" >
            <div class="card-header">
                @include('roles.modal')
                <h3 class="card-title"><h2>Lista de Roles</h2></h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body p-0" >
                <table class="table table-sm">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th style="width: 10px">Rol</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td scope="col">{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
