@extends('layouts.app')

@section('content')

    <div class="container-fluid">

            <h2>Lista de usuarios registrados</h2>

        <table class="table table-bordered display dt-responsive nowrap" id="data_table" style="width: auto" >
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col" >Email</th>
                    <th scope="col" width="120px">Opciones</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

    </div>



@push('scripts')
    <script>
        $(function () {
            var table = $('#data_table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.show_users')}}",

                columns:[

                    
                    {data: "name", name: 'name',className: 'dtr-control', defaultContent: '<ion-icon name="add-circle-outline"></ion-icon>'},
                    {data: "last_name", name: 'last_name'},
                    {data: "email", name: 'email'},
                    {data: 'action', name: 'action', ordeable:false, searchable:false},


                ]
            });
           // $('#data_table').addClass('card');
            $('#data_table').addClass('table-responsive order-column ');

        });
    </script>
@endpush
@endsection
