@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row" style="display: flex; align-items: center;  justify-content: center;">
           <div class="card">
               <div class="card-header">
                <i class="fa fa-church"></i> &nbsp; Iglesia de Dios de la Profecía
               </div>
               {{$errors->login->first('direccion')}}
               <div class="card-body">
                   <form action="{{route('iglesias.update', $iglesia->id)}}" method="POST" role="form">
                    @method('PUT')
                    @csrf
                       <div class="row">
                           <div class="col-sm-10">
                               <div class="form-group">
                                 <label for="">Nombre de Iglesia:</label>
                                 <input type="text" name="name" id="" aria-describedby="errorName_iglesia" class="form-control @error('name') is-invalid @enderror" value="{{$iglesia->name}}" >                                 
                                 @error('name')
                                    @foreach ($errors->all() as $error)
                                    <small id="errorName_iglesia" class=" invalid-feedback" role="alert">{{ $error }}</small>
                                    @endforeach                                 
                                 @enderror 
                                </div>
                           </div>
                             
                           <div class="col-sm-10">
                               <div class="form-group">
                                 <label for="">Dirección:</label>
                                 <input type="text" name="direccion" id="" aria-describedby="errorDireccion" class="form-control @error('direccion') is-invalid @enderror" value="{{$iglesia->direccion}}" >                                 
                                  @error('direccion')
                                    @foreach ($errors->all() as $error)
                                    <small id="errorDireccion" class=" invalid-feedback" role="alert">{{ $error }}</small>
                                    @endforeach                                 
                                @enderror 
                            </div>                             
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-10">
                               <div class="fomr-group">
                                   <div class="form-group">
                                     <label for="">Pastor:</label>
                                     <select class="form-control" name="pastor" id="">
                                         @if(empty($pastores)==true)
                                            @if (empty($pastor)==false)
                                                <option value="{{$pastor->id}}" selected>{{$pastor->name}} {{$pastor->last_name}}</option>
                                            @endif
                                            @if (empty($pastor)==true)
                                                <option value="" selected>-Sin Asignar-</option> 
                                            @endif
                                         @endif
                                        @foreach ($pastores as $id => $pasto)
                                             @if (empty($pastor)==true)
                                             <option value="" selected>-Sin Asignar-</option> 
                                             @endif
                                             @if (empty($pastor)==false)
                                             <option value="{{$pastor->id}}">{{$pastor->name}} {{$pastor->last_name}}</option>
                                             @endif
                                             <option value="{{$pasto['id']}}">{{ $pasto['name'] }}</option>
                                         @endforeach
                                                          
                                     </select>
                                   </div>
                               </div>
                           </div>
                       </div>
                   
               </div>
               <div class="card-footer text-muted">
                   
                   <button type="submit"  class="btn btn-primary btn-lg btn-block">Guardar</button>
                   </form>
               </div>
           </div>
        </div>
    </div>
@endsection