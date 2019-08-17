
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
                        <h4 class="text-black" >RECINTO: <b>C-{{ $persona->circunscripcion }} D-{{ $persona->distrito }} R-{{ $persona->nombre_recinto }}</b></h4 class="text-black" >
                        

                    <form action="{{ url('editar_persona') }}"  method="post" id="f_enviar_editar_persona" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-black ">Circuns.</label>
                                <select class="form-control" name="id_circunscripcion" id="id_circunscripcion">
                                    <option value="0" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group distrito_json">
                                <label class="text-black ">Distrito</label>
                                <select class="form-control" name="id_distrito" id="id_distrito">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group recinto_json">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto">
                                    {{-- @foreach ($recintos as $recinto)
                                    <option value={{$recinto->id_recinto}} {{ $persona->id_recinto == $recinto->id_recinto ? 'selected' : '' }}>{{$recinto->id_recinto}} - {{$recinto->nombre_recinto}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Usuario</label>
                                <input type="input" name="nombres" placeholder="" class="form-control" value="{{ $persona->nombre }}"  required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Password</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="{{ $persona->cedula_identidad }}" required/>
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

<script>
  $(document).ready(function() {
    var id_sol = $("#id_solicitud").val();
    
    $("#id_origen").change(function(){
        cargaSubOrigen();
    });

    function cargaSubOrigen(){
        $(".sub_origen_json select").html("");
        var id_origen = $("#id_origen").val();
    
        // console.log($("#anio").val());
        $.getJSON("consultaSubOrigen/"+id_origen+"",{},function(objetosretorna){
            $("#error").html("");
            var TamanoArray = objetosretorna.length;
            $(".sub_origen_json select").append('<option value="0"> --- SELECCIONE EL SUB ORIGEN --- </option>');
            $.each(objetosretorna, function(i,value){
                $(".sub_origen_json select").append('<option value="'+value.id_sub_origen+'">'+value.nombre+'</option>');
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
            $(".recinto_json select").append('<option value="'+value.id_recinto+'">'+value.id_recinto+' - '+value.nombre+'</option>');
        });
    });
    };


  });
</script>