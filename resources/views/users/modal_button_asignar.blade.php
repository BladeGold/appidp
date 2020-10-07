<button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#addRole">Añadirme como miembro</button>

<form method="POST" action="{{route('users.asignarIglesia')}}">
    @csrf

    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de Iglesia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @if ($errors->any())
                            @include('mensaje')
                        @endif
                        <form method="POST" action="{{ route('iglesias.store') }}" role="form" >
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                            <div class="form-group">
                                <div  class="input-group  col-auto">
                                    <select   class="form-control @error('iglesia') is-invalid @enderror" name="iglesia">
                                        <option selected value=null >-Seleciona un Opción</option>
                                        @foreach($iglesias as $id => $iglesi)
                                        <option value="{{ $id }}" >  {{ $iglesi }} </option>>
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
