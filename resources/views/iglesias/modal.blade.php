
<div class="modal" id="miModalIglesia" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Iglesia</h5>
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
                        <!-- /.col -->
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-block btn-success">
                                {{ __('Register') }}
                            </button>
                        </div>

                        <div class="col-sm-3">
                            <button type="reset" class="btn btn-block btn-danger">
                                {{ __('Limpiar') }}
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
