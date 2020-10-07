<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addRole">Asignar Pastor</button>

<form method="POST" action="{{route('iglesias.asignarPastor', $iglesia->id)}}">
    @csrf

    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar Pastor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @if ($errors->any())
                            @include('mensaje')
                        @endif
                        <form method="POST" action="{{ route('iglesias.asignarPastor', $iglesia->id) }}" role="form" >
                            @csrf                          
                                        <label>Selecciona Pastor: </label>
                                    <select name="pastor">
                                        <option value="" selected="">Seleciona una opción</option>
                                       @foreach($pastores as $name => $pastor)
                                       <option value="{{$pastor['id']}}">{{ $pastor['name'] }} {{ $pastor['last_name']}}</option>

                                    @endforeach
                                    </select>    
                                        
                        </form>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
