
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
              <div class="col-sm-6 col-sm-offset-2 myform-cont" >
                
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
                   </div>

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
                                <label >Comp. SEGIP</label>
                                <input type="input" name="complemento" placeholder="" class="form-control" value="{{ old('complemento') }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Expedido</label>
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
                                <label >Grado de compromiso - (1 al 5)</label>
                                <input type="number" min="1" max="5" name="grado_compromiso" placeholder="1" class="form-control" value="1" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Organización de Origen</label>
                                <select class="form-control" name="id_origen" id="id_origen" required>
                                        <option value="" selected> --- SELECCIONE UNA ORGANIZACION --- </option>
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
                                    <option value="0" selected> --- SELECCIONE UNA SUB ORGANIZACION--- </option>
                                </select>
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
                            <div class="form-group distrito_json_select">
                                <label class="">Distrito</label>
                                <select class="form-control" name="id_distrito" id="id_distrito">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group recinto_json_select">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto" id="id_recinto">
                                  </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-black">Rol</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="rol_slug" id="rol_slug">
                                        @foreach ($roles as $rol)
                                    <option value={{$rol->slug}} {{$rol->slug == 'militante' ? 'selected' : ''}}>{{$rol->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_mesas">
                            <div class="" id="div_mesas_detalle">
                                    <h5 class="box-title"><b>Detalle de Mesas: </b></h5>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Asignadas:</b> <b><span id="mesas_asignadas"></span></b>
                                    </h3>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Sin Asignar:</b> <b><span id="mesas_sin_asignar"></span></b>
                                    </h3>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <h3 style="background-color:#ffffff; font-size: 14px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                        <b>Total:</b> <b><span id="mesas_total"></span></b>
                                    </h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-black">Mesas - Recinto</label>
                                <div class="form-group bg-gray mesas_json">
                                    <select size="7" multiple="" class="form-control" name="mesas[]" id="id_mesa" style="font-family:'FontAwesome', \'Helvetica Neue\', Helvetica, sans-serif; ">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_casa_campana">
                            <div class="form-group">
                                <label class="text-black">Casa de Campaña</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="id_casa_campana" id="id_casa_campana">
                                        <option value="" selected> --- SELECCIONE UNA CASA DE CAMPAÑA --- </option>
                                        @foreach ($casas as $casa)
                                        <option value="{{$casa->id_casa_campana}}">C:{{$casa->circunscripcion}} - D:{{$casa->distrito}} - {{$casa->nombre_casa_campana}} {{$casa->direccion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_vehiculo">
                            <div class="form-group">
                                <label class="text-black">Vehiculo</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="id_vehiculo" id="id_vehiculo">
                                        <option value="" selected> --- SELECCIONE UN VEHICULO --- </option>
                                        @foreach ($vehiculos as $vehiculo)
                                        <option value="{{$vehiculo->id_transporte}}">{{$vehiculo->id_transporte}} - {{$vehiculo->marca}} {{$vehiculo->modelo}}</option>
                                        @endforeach
                                    </select>
                                </div>
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


@section('scripts')
	
@parent
<script>
	function activar_mesas() {


    // Ocultando Divs al iniciar
    $("#div_circ").hide();
    $("#div_distrito").hide();
    $("#div_recinto").hide();
    $("#div_mesas").hide();
    $("#div_casa_campana").hide();
    $("#div_vehiculo").hide();


    $("#rol_slug").change(function(){

        // alert('aksd');
        
        
        //id obtenido de la base de datos "campo : slug"
        var rol_slug = $("#rol_slug").val();
        if (rol_slug == 'militante') {
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', true);
        }else if(rol_slug == 'conductor'){
            alertify.success(rol_slug);
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").show();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'registrador'){
            alertify.success(rol_slug);
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").show();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'call_center'){
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_mesa'){
            cargaMesasRecinto();
            $("#div_mesas_detalle").hide();
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").show();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_recinto'){
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").show();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_distrito'){
            $("#div_circ").show();
            $("#div_distrito").show();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'responsable_circunscripcion'){
            $("#div_circ").show();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', false);
        }else {
            
        }
    });
  
    $("#id_recinto").change(function(){
        cargaMesasRecinto();
    });

    function cargaMesasRecinto(){
        // alertify.success('dasf');
        
        $(".mesas_json select").html("");
        $("#div_mesas_detalle").show();
        $("#mesas_asignadas").text("");
        $("#mesas_sin_asignar").text("");
        $("#mesas_total").text("");
        var id_recinto = $("#id_recinto").val();
        var mesas_asignadas = 0;
        var mesas_sin_asignar = 0;
        var mesas_total = 0;
        // console.log($("#anio").val());
        $.getJSON("consultaMesasRecinto/"+id_recinto+"",{},function(objetosretorna){
            $("#error").html("");
            
            var TamanoArray = objetosretorna.length;
            // $(".mesas_json select").append('<input type="checkbox" disabled="">');
            $.each(objetosretorna, function(i,value){
                
                if (value.mesa_activa === 0 || value.mesa_activa === null) {
                    mesas_sin_asignar++;
                    $(".mesas_json select").append('<option value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.id_mesa+'-'+value.codigo_mesas_oep+'</option>');                    
                } else {
                    mesas_asignadas++;
                    $(".mesas_json select").append('<option disabled value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.id_mesa+'-'+value.codigo_mesas_oep+' &#xf007; '+value.nombre_completo+' &#xf095; '+value.telefono_celular+'</option>');                    
                    
                }
                mesas_total++;

            });
            $("#mesas_asignadas").text(mesas_asignadas);
            $("#mesas_sin_asignar").text(mesas_sin_asignar);
            $("#mesas_total").text(mesas_total);
        });
    };
    
    $("#id_circunscripcion").change(function(){
        cargaDistritos();
    });

    $("#id_distrito").change(function(){
        cargaRecintos();
    });

    function cargaDistritos(){
        $(".distrito_json_select select").html("");
        var id_circunscripcion = $("#id_circunscripcion").val();

        // console.log($("#anio").val());
        $.getJSON("consultaDistritos/"+id_circunscripcion+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".distrito_json_select select").append('<option value="0"> --- SELECCIONE EL DISTRITO --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".distrito_json_select select").append('<option value="'+value.distrito+'">'+value.distrito+'</option>');
            });
        });
    };

    function cargaRecintos(){
        $(".recinto_json_select select").html("");
        var id_circunscripcion = $("#id_circunscripcion").val();
        var id_distrito = $("#id_distrito").val();

        // console.log($("#anio").val());
        $.getJSON("consultaRecintos/"+id_distrito+"/"+id_circunscripcion+"",{},function(objetosretorna){
                $("#error").html("");
                var TamanoArray = objetosretorna.length;
                $(".recinto_json_select select").append('<option value="0"> --- SELECCIONE EL RECINTO --- </option>');
                $.each(objetosretorna, function(i,value){
                    $(".recinto_json_select select").append('<option value="'+value.id_recinto+'"> R:'+value.id_recinto+' - '+value.nombre+'</option>');
                });
            });
    };
	
	}	
	activar_mesas();
	
	
	</script>
@endsection