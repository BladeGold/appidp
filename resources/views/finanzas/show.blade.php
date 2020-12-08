@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="nav-icon fa fa-church"></i>
                    Registro Financieros de la Iglesia {{$iglesia->name}}
                </h3>
            </div>
            <div class="card-body">
               
                <table class="table  table-bordered" id="data_table" style="width: auto" >

                </table>
             
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
                ajax: "{{route('finanzas.show', $iglesia->id)}}",
                columnDefs: [
                    {title: "Monto", targets: 0},
                    {title: "Fecha", targets: 1},
                ],

                columns: [
                    {data: "monto", name: 'monto',},
                    {data: "fecha", name: 'fecha',  },          


                ]
            });


            $('#data_table').addClass('table-responsive order-column ');
           //$('#data_table').addClass('card ');


        });
    </script>
@endpush
@endsection