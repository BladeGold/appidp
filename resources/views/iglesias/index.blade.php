@extends('layouts.app')

@section('content')

    @if($validate==false)
        @include('iglesias.modal')
    @endif


@if($validate==true)
    <div class="container">

        <div class="row">
            <div class="col-sm ">
                @include('iglesias.modal_button')
                <h2>Lista de Iglesias</h2><hr><br>

                <table class="table  table-bordered" id="data_table" style="width: auto" >
                    <thead class="thead-dark">
                    </thead>

                    <tbody>

                    </tbody>
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
                    ajax: "{{route('iglesias.index')}}",
                    columnDefs: [
                        
                        {title: "Nombre de Iglesia", targets: 0},
                        {title: "Opciones", targets: 1},
                    ],

                    columns: [
                        
                        {data: "name", name: 'name',  },
                        {data: 'action', name: 'action',  ordeable: false, searchable: false},


                    ]
                });


                $('#data_table').addClass('table-responsive order-column ');
               //$('#data_table').addClass('card ');


            });
        </script>
    @endpush
@endif
@endsection
