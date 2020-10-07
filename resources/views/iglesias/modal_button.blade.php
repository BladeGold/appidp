<button type="button" class="btn btn-warning float-right" data-toggle="modal" data-target="#addRole">Crear Nueva Iglesia</button>

<form method="POST" action="{{route('iglesias.store')}}">
    @csrf

    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Iglesia</h5>
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
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Nombre de la Iglesia:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>Dirección de la Iglesia:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-sm-6">
                            <div class="form-group">
                                <label for="chec">Desea Asignar el Pastor de esta iglesia?</label>
                                <input type="checkbox" id="checkiglesia" onChange="iglesiareg(this);" > <b>Si</b>
                                <div  class="input-group  col-auto">
                                    <select id="regiglesia" disabled  class="form-control @error('iglesia') is-invalid @enderror" name="pastor">
                                        <option selected value=null >-Seleciona un Opción</option>
                                        @foreach($pastores as $name => $pastor)
                                        <option value="{{$pastor['id']}}">{{$pastor['name'] }} {{$pastor['last_name']}}</option>

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
