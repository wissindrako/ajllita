
<section>

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Asignar Usuario - Mesa</h3>
                            {{-- <p>Por favor llene los siguientes campos</p> --}}
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-random"></i>
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
                        <h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
                        <h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" >
                        <h4 class="text-black" >GRADO DE COMPROMISO: <b>{{$persona->grado_compromiso}}</b></h4 class="text-black" >
                        <h4 class="text-black" >ORIGEN: <b>{{ $persona->origen }} - {{ $persona->sub_origen }}</b></h4 class="text-black" >
                        <h4 class="text-black" >RECINTO: <b>C-{{ $persona->circunscripcion }} D-{{ $persona->distrito }} R-{{ $persona->id_recinto }}: {{ $persona->nombre_recinto }}</b></h4 class="text-black" >
                        
                    <form action="{{ url('asignar_usuario_mesa') }}"  method="post" id="f_asignar_usuario_mesa" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id_persona" id="id_persona" value="{{ $persona->id_persona }}">
                      <input type="hidden" name="cedula_identidad" id="cedula_identidad" value="{{ $persona->cedula_identidad }}">
                      <input type="hidden" name="complemento_cedula" id="complemento_cedula" value="{{ $persona->complemento_cedula }}">
                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-black">Rol</label>
                                <div class="form-group bg-gray">
                                    <select  class="form-control" name="rol_slug" id="rol_slug">
                                        @foreach ($roles as $rol)
                                    <option value={{$rol->slug}} {{$rol->slug == 'delegado_mas' ? 'selected' : ''}}>{{$rol->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" id="div_circ">
                            <div class="form-group">
                                <label class="text-black ">Circuns.</label>
                                <select class="form-control" name="circunscripcion" id="id_circunscripcion">
                                    <option value="0" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($circunscripciones as $circ)
                                    <option value="{{$circ->circunscripcion}}">{{$circ->circunscripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2" id="div_distrito">
                            <div class="form-group distrito_json">
                                <label class="text-black ">Distrito</label>
                                <select class="form-control" name="distrito" id="id_distrito">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8" id="div_recinto">
                            <div class="form-group recinto_json">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto" id="id_recinto">
                                    {{-- @foreach ($recintos as $recinto)
                                    <option value={{$recinto->id_recinto}} {{ $persona->id_recinto == $recinto->id_recinto ? 'selected' : '' }}>{{$recinto->id_recinto}} - {{$recinto->nombre_recinto}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="div_mesas">
                            <div class="form-group">
                                <label class="text-black">Mesas - Recinto</label>
                                <div class="form-group bg-gray mesas_json">
                                    <select  multiple="" class="form-control" name="mesas[]" id="id_mesa">
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
                        {{-- <div class="col-md-12">
                            <br>
                        </div> --}}
                        {{-- quitando usuario y pass --}}
                        {{-- <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-black">Usuario</label>
                                        <input type="input" name="username" id="username" placeholder="" class="form-control" value=""  required/>
                                        <button type="button" class="btn btn-xs btn-info" id="generar_usuario">Generar Usuario</button>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="text-black">Password</label>
                                        <input type="password" name="password" id="password" placeholder="" class="form-control" value="" required/>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-12">
                            <br>
                        </div>
                            <button type="submit" class="mybtn" id="btn_registrar">Registrar</button>
                      </form>
                    
                    </div>
              </div>
            </div>

        </div>
      </div>
 
</section>

<script>
  $(document).ready(function() {

    // var id_persona = $("#id_persona").val();
    // $.ajax({
    //     type:'get',
    //     url:"ObtieneUsuario/"+id_persona+"",
    //     data:{},
    //     success: function(result){
    //         // alertify.success("Nombre de usuario y Contraseña:"+result);
    //         $("#username").val(result);
    //         $("#password").val(result);
    //     }
    // });

    // Ocultando Divs al iniciar
    $("#div_circ").hide();
    $("#div_distrito").hide();
    $("#div_recinto").hide();
    $("#div_mesas").hide();
    $("#div_casa_campana").hide();
    $("#div_vehiculo").hide();

    // document.getElementById('generar_usuario').onclick = function(){
        
    //     var id_persona = $("#id_persona").val();
    //     var id_recinto = $("#id_recinto").val();
    //     if (id_recinto != null) {
    //     $.ajax({
    //         type:'get',
    //         url:"ObtieneUsuario/"+id_persona+"",
    //         data:{},
    //         success: function(result){
    //             $("#username").val(result);
    //             $("#password").val(result);
    //         }
    //     });

    //     }else {
    //         alertify.success("Seleccione el recinto y las mesas");
    //     }
    // };

    $("#rol_slug").change(function(){
        
        //id obtenido de la base de datos "campo : slug"
        var rol_slug = $("#rol_slug").val();
        if (rol_slug == 'delegado_mas') {
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").hide();
            $("#btn_registrar").prop('disabled', true);
        }else if(rol_slug == 'conductor'){
            $("#div_circ").hide();
            $("#div_distrito").hide();
            $("#div_recinto").hide();
            $("#div_mesas").hide();
            $("#div_casa_campana").hide();
            $("#div_vehiculo").show();
            $("#btn_registrar").prop('disabled', false);
        }else if(rol_slug == 'registrador'){
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
        }else if(rol_slug == 'informatico'){
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
        $(".mesas_json select").html("");
        var id_recinto = $("#id_recinto").val();
    
        // console.log($("#anio").val());
        $.getJSON("consultaMesasRecinto/"+id_recinto+"/"+id_persona+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            // $(".mesas_json select").append('<input type="checkbox" disabled="">');
            $.each(objetosretorna, function(i,value){
                // if (value.activo == '0') {
                // } else {
                    $(".mesas_json select").append('<option selected value="'+value.id_mesa+'">R:'+value.id_recinto+'-'+value.id_mesa+'-'+value.codigo_mesas_oep+'</option>');                    
                // }
            });
        });
    };
    
    $("#id_circunscripcion").change(function(){
        cargaDistritos();
    });

    $("#id_distrito").change(function(){
        cargaRecintos();
    });

    function cargaDistritos(){
    $(".distrito_json select").html("");
    var id_circunscripcion = $("#id_circunscripcion").val();

    // console.log($("#anio").val());
    $.getJSON("consultaDistritos/"+id_circunscripcion+"",{},function(objetosretorna){
        $("#error").html("");
        var TamanoArray = objetosretorna.length;
        $(".distrito_json select").append('<option value="0"> --- SELECCIONE EL DISTRITO --- </option>');
        $.each(objetosretorna, function(i,value){
            $(".distrito_json select").append('<option value="'+value.distrito+'">'+value.distrito+'</option>');
        });
    });
    };

    function cargaRecintos(){
  $(".recinto_json select").html("");
  var id_circunscripcion = $("#id_circunscripcion").val();
  var id_distrito = $("#id_distrito").val();

  // console.log($("#anio").val());
  $.getJSON("consultaRecintos/"+id_distrito+"/"+id_circunscripcion+"",{},function(objetosretorna){
        $("#error").html("");
        var TamanoArray = objetosretorna.length;
        $(".recinto_json select").append('<option value="0"> --- SELECCIONE EL RECINTO --- </option>');
        $.each(objetosretorna, function(i,value){
            $(".recinto_json select").append('<option value="'+value.id_recinto+'"> R:'+value.id_recinto+' - '+value.nombre+'</option>');
        });
    });
    };


  });
</script>