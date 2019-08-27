
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
                      
                    <form action="{{ url('agregar_persona') }}"  method="post" id="f_enviar_agregar_persona" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombres</label>
                                <input type="input" name="nombres" placeholder="" class="form-control" value="{{ old('nombres') }}"  required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Paterno</label>
                                <input type="input" name="paterno" placeholder="" class="form-control" value="{{ old('paterno') }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Materno</label>
                                <input type="input" name="materno" placeholder="" class="form-control" value="{{ old('materno') }}" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label >Carnet</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="{{ old('cedula') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >Comp.</label>
                                <input type="input" name="complemento" placeholder="" class="form-control" value="{{ old('complemento') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Exp.</label>
                                <select class="form-control" name="expedido">
                                    <option>LP</option>
                                    <option>OR</option>
                                    <option>PT</option>
                                    <option>CB</option>
                                    <option>SC</option>
                                    <option>BN</option>
                                    <option>PA</option>
                                    <option>TJ</option>
                                    <option>CH</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class=" ">Fecha de nacimiento</label>
                                <input type="date" name="nacimiento" placeholder="" class="form-control" value="{{ old('nacimiento') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono - Celular</label>
                                <input type="input" name="telefono" placeholder="" class="form-control" value="{{ old('telefono') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono de Referencia</label>
                                <input type="input" name="telefono_ref" placeholder="" class="form-control" value="{{ old('telefono_ref') }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Dirección</label>
                                <input type="input" name="direccion" placeholder="" class="form-control" value="{{ old('direccion') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" name="email" placeholder="Correo electrónico" class="form-control" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Grado de compromiso</label>
                                <input type="number" min="1" max="5" name="grado_compromiso" placeholder="1" class="form-control" value="1" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Circunscripción</label>
                                <select class="form-control" name="id_circunscripcion" id="id_circunscripcion">
                                    <option value="0" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($circunscripciones as $circ)
                                <option value="{{$circ->circunscripcion}}">{{$circ->circunscripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group distrito_json">
                                <label class="">Distrito</label>
                                <select class="form-control" name="id_distrito" id="id_distrito">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group recinto_json">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto">
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Organización de Origen</label>
                                <select class="form-control" name="id_origen" id="id_origen" required>
                                        <option value="" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($origenes as $origen)
                                <option value="{{$origen->id_origen}}">{{$origen->id_origen}} - {{$origen->origen}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group sub_origen_json">
                                <label class="text-black">Sub Origen</label>
                                <select class="form-control" name="id_sub_origen">
                                    <option value="0" selected> --- SELECCIONE UN ORIGEN--- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
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

