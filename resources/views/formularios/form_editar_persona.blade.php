
<section>

    <div class="" >
        <div class="container"> 
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Editar Persona</h3>
                            <p>Por favor llene los siguientes campos</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-pencil-square-o"></i>
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
                      
                    <form action="{{ url('editar_persona') }}"  method="post" id="f_enviar_editar_persona" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <input type="hidden" name="id_persona" value="{{ $persona->id_persona }}">
                      
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Nombres</label>
                                <input type="input" name="nombres" placeholder="" class="form-control" value="{{ $persona->nombre }}"  required/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Paterno</label>
                                <input type="input" name="paterno" placeholder="" class="form-control" value="{{ $persona->paterno }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Materno</label>
                                <input type="input" name="materno" placeholder="" class="form-control" value="{{ $persona->materno }}" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label >Carnet</label>
                                <input type="input" name="cedula" placeholder="" class="form-control" value="{{ $persona->cedula_identidad }}" required/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Comp.</label>
                                <input type="input" name="complemento" placeholder="" class="form-control" value="{{ $persona->complemento_cedula }}" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label >Exp.</label>
                                <select class="form-control" name="expedido">
                                    <option value="LP" {{ $persona->expedido == 'LP' ? 'selected' : '' }}>LP</option>
                                    <option value="OR" {{ $persona->expedido == 'OR' ? 'selected' : '' }}>OR</option>
                                    <option value="PT" {{ $persona->expedido == 'PT' ? 'selected' : '' }}>PT</option>
                                    <option value="CB" {{ $persona->expedido == 'CB' ? 'selected' : '' }}>CB</option>
                                    <option value="SC" {{ $persona->expedido == 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="BN" {{ $persona->expedido == 'BN' ? 'selected' : '' }}>BN</option>
                                    <option value="PA" {{ $persona->expedido == 'PA' ? 'selected' : '' }}>PA</option>
                                    <option value="TJ" {{ $persona->expedido == 'TJ' ? 'selected' : '' }}>TJ</option>
                                    <option value="CH" {{ $persona->expedido == 'CH' ? 'selected' : '' }}>CH</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=" ">Fecha de nacimiento</label>
                                <input type="date" name="nacimiento" placeholder="" class="form-control" value="{{ $persona->fecha_nacimiento }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono</label>
                                <input type="input" name="telefono" placeholder="" class="form-control" value="{{ $persona->telefono_celular }}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Telefono de Referencia</label>
                                <input type="input" name="telefono_ref" placeholder="" class="form-control" value="{{ $persona->telefono_referencia }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >Direccion</label>
                                <input type="input" name="direccion" placeholder="" class="form-control" value="{{ $persona->direccion }}" required/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" name="email" placeholder="Correo electrónico" class="form-control" value="{{ $persona->email }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Grado de compromiso</label>
                                <input type="number" min="1" max="5" name="grado_compromiso" placeholder="1" class="form-control" value="{{ $persona->grado_compromiso}}" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="text-black ">Circuns.</label>
                                <select class="form-control" name="id_circunscripcion" id="id_circunscripcion">
                                    <option value="0" selected> --- SELECCIONE UNA CIRCUNSCRIPCIÓN --- </option>
                                    @foreach ($circunscripciones as $circ)
                                    <option value={{$circ->circunscripcion}} {{ $persona->circunscripcion == $circ->circunscripcion ? 'selected' : '' }}>{{$circ->circunscripcion}}</option>
                                {{-- <option value="{{$circ->circunscripcion}}">{{$circ->circunscripcion}}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group distrito_json">
                                <label class="">Distrito</label>
                                <select class="form-control" name="id_distrito" id="id_distrito">
                                    @foreach ($distritos as $dist)
                                    <option value={{$dist->distrito}} {{ $persona->distrito == $dist->distrito ? 'selected' : '' }}>{{$dist->distrito}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group recinto_json">
                                <label class="text-black">Recinto</label>
                                <select class="form-control" name="recinto">
                                    @foreach ($recintos as $recinto)
                                    <option value={{$recinto->id_recinto}} {{ $persona->id_recinto == $recinto->id_recinto ? 'selected' : '' }}>{{$recinto->id_recinto}} - {{$recinto->nombre_recinto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black ">Organización de Origen</label>
                                <select class="form-control" name="id_origen" id="id_origen">
                                    @foreach ($origenes as $origen)
                                <option value={{$origen->id_origen}} {{ $persona->id_origen == $origen->id_origen ? 'selected' : '' }}>{{$origen->origen}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group sub_origen_json">
                                <label class="text-black">Sub Origen</label>
                                <select class="form-control" name="id_sub_origen">
                                    <option value="0" selected> --- SELECCIONE UN ORIGEN--- </option>
                                    @foreach ($sub_origenes as $sub_origen)
                                    <option value={{$sub_origen->id_sub_origen}} {{ $persona->id_sub_origen == $sub_origen->id_sub_origen ? 'selected' : '' }}>{{$sub_origen->nombre}}</option>
                                    @endforeach
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