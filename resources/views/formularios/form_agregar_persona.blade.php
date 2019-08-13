@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Agregar Persona</h3>
                            <p>Por favor llene los siguientes campos</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-child"></i>
                        </div>
                      </div>

                  <div class="col-md-12" >
                    @if (count($errors) > 0)
                     
                        <div class="alert alert-danger">
                            <strong>UPPS!</strong> Error al Registrar<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    
                    @endif
                   </div  >

                    <div id="div_notificacion_sol" class="myform-bottom">
                      
                    <form action="{{ url('enviar_gastronomia') }}"  method="post" id="f_enviar_gastronomia" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombres</label>
                                <input type="input" name="nombres" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Paterno</label>
                                <input type="input" name="paterno" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Materno</label>
                                <input type="input" name="materno" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >Carnet</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Comp.</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Exp.</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=" ">Fecha de nacimiento</label>
                                <input type="date" name="nacimiento" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono</label>
                                <input type="input" name="telefono" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono de Referencia</label>
                                <input type="input" name="telefono_ref" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Direccion</label>
                                <input type="input" name="direccion" placeholder="" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" name="email" placeholder="Correo electrónico" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Grado de compromiso</label>
                                <input type="number" min="1" max="5" name="grado_compromiso" placeholder="1" class="form-control" value="1" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Circuns.</label>
                                <select class="form-control" name="area" id="id_uni">
                                        <option value="0" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($unidades as $unidad)
                                        {{-- <option value="{{$unidad->id}}" {{ old('area', $unidad->id) == $unidad->id ? 'selected' : '' }}>{{$unidad->nombre}}</option> --}}
                                        <option value="{{$unidad->id}}">{{$unidad->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group cargo_json">
                                <label class="text-muted ">Cargo</label>
                                <select class="form-control" name="cargo">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-black">Circuns.</label>
                                <select class="form-control" name="circunscripcion">
                                    {{-- @foreach ($cargos as $cargo)
                                <option value="{{$cargo->idcargo}}" {{ old('cargo', $cargo->idcargod) == $cargo->idcargo ? 'selected' : '' }}>{{$cargo->nombrecargo}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-black">Distrito</label>
                                <select class="form-control" name="distrito">
                                    {{-- @foreach ($unidades as $unidad)
                                <option value="{{$unidad->id}}" {{ old('area', $unidad->id) == $unidad->id ? 'selected' : '' }}>{{$unidad->nombre}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto">
                                    {{-- @foreach ($unidades as $unidad)
                                <option value="{{$unidad->id}}" {{ old('area', $unidad->id) == $unidad->id ? 'selected' : '' }}>{{$unidad->nombre}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="mybtn">Registrar</button>
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>
 
</section>

</section>
@endsection

