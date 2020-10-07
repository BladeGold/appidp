@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row " style="display: flex; align-items: center;  justify-content: center;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <ion-icon name="home"></ion-icon>
                            Iglesia de Dios de la Profecía {{$iglesia->name}}
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Pastor</dt>
                            <dd class="col-sm-8">
                                @if(!empty($pastor))
                               <p> <strong>{{ $pastor }} </strong> </p>
                               @endif

                               @if(empty($pastor))
                               <p><strong> Sin Asignar</strong></p>
                               @include('iglesias.modal_button_pastor')
                               @endif
                            </dd>
                            
                        </dl>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-4">Dirección</dt>
                            <dd class="col-sm-8">
                               <p> <strong>{{ $iglesia->direccion}} </strong> </p>
                            </dd>
                            
                        </dl>
                        <hr>
                        <dl class="row">
                            <dt class="col-sm-4">Miembros</dt>
                            <dd class="col-sm-8">
                                @if($existe == true)
                                <table class="table  table-bordered" id="data_table" style="width: auto" >

                                </table>
                                @endif


                                @if($existe == false)
                                <p><strong>Sin miembros registrados</strong></p>

                                @endif
                            </dd>
                            <dt class="col-sm-4"></dt>
                            <dd class="col-sm-8"></dd>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
 @push('scripts')
        <script>
            $(function () {
                var table = $('#data_table').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('iglesias.shows', $iglesia->id)}}",
                    columnDefs: [
                        {title: "Nombre", targets: 0},
                        {title: "Apellido", targets: 1},
                    ],

                    columns: [
                        {data: "name", name: 'name',},
                        {data: "last_name", name: 'last_name',  },          


                    ]
                });


                $('#data_table').addClass('table-responsive order-column ');
               //$('#data_table').addClass('card ');


            });
        </script>
    @endpush



@endsection
