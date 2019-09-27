
@extends('layouts.area')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container"> 
                      
                <div class="col-sm-12 " style="background-color:rgba(0, 0, 0, 0.35); height: 60px; " >
                        {{-- <a class="mybtn-social pull-right" href="{{ url('/register') }}">
                            Register
                       </a> --}}
     
                       {{-- <a class="mybtn-social pull-right" href="{{ url('/login') }}"> --}}
                       <a class="mybtn-social pull-right" href="{{ url('/') }}">
                            Inicio
                       </a>
                    
                     </div>
            <div class="row">
              <div class="col-sm-6 col-sm-offset-4 myform-cont" >
                
                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Consultar Mesas Asignadas</h3>
                            <p>Ingrese su número de Carnet</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-user"></i>
                        </div>
                    </div>


                    <div id="div_notificacion_sol" class="myform-bottom">

                      
                    <form action="{{ url('') }}"  method="post" id="f_enviar_agregar_persona" class="formentrada" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-md-12"><br></div>
                      <div class="col-md-12">
                            <div class="form-group">
                                {{-- <label >Carnet</label> --}}
                                <input type="input" name="cedula" id="input_cedula" placeholder="" class="form-control" value="" pattern="[0-9]{6,9}" required/>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <br>
                        </div>
                        {{-- <button type="submit" class="mybtn">Buscar</button> --}}

                        <div class="col-md-12">
                                <br>
                            </div>
                        <div class="box box-default" id="div_usuarios_encontrados">
                                <div  style="background-color:#111111; text-align:center; color:white" class="box-header">
                                    <h3 class="box-title"><b>Resultados Encontrados</b></h3>
                                </div>
                                <div class="box-body table-responsive no-padding scrollable">
                                    <table class="table table-bordered" id="tabla_cedula">
                                        <thead>
                                        <tr>
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Nombre</th>
                                            {{-- <th style="background-color:#3c8dbc; text-align:center; color:white">Carnet</th> --}}
                                            {{-- <th style="background-color:#3c8dbc; text-align:center; color:white">Nacimiento</th>
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Contacto</th> --}}
                                            {{-- <th style="background-color:#3c8dbc; text-align:center; color:white">Circ.</th>
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Distrito</th> --}}
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Recinto</th>
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Rol</th>
                                            <th style="background-color:#3c8dbc; text-align:center; color:white">Mesas</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <a href="{{ url('https://youtu.be/tMWkeBIohBs') }}" target="_blank" class="btn btn-block btn-social btn-google">
                                <i class="fa fa-youtube-play"></i> Video Tutorial
                            </a>
                            <a href="{{ url('/docs/Manual Control Azul.pdf') }}" target="_blank" class="btn btn-block btn-social btn-default">
                                <i class="fa fa-file-pdf-o"></i> Manual Control Azul
                            </a>
                            <a class="btn btn-block btn-social btn-default">
                                <i class="fa fa-file-pdf-o"></i> Lista de Mesas Asignadas
                            </a>
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

    $("#div_usuarios_encontrados").hide();


    $( "#input_cedula" ).keyup(function() {
        
        $("#tabla_cedula tbody").html("");
        var cedula = $("#input_cedula").val();
        var cedula_sin_espacios = cedula.trim();
        if (cedula_sin_espacios == "") {
            
        } else {
            // $.getJSON("consultaRecintosPorRecinto/"+recinto+"",{},function(objetosretorna){
            $.getJSON("consultaMesaAsignada/"+cedula_sin_espacios+"",{},function(objetosretorna){
                $("#div_usuarios_encontrados").show();
                $("#error").html("");
                var TamanoArray = objetosretorna.length;
                $.each(objetosretorna, function(i,datos){
                    var mesas = "";
                    if (datos.mesas === null) {
                        mesas = "Sin Mesas";
                    }else{
                        mesas = datos.mesas;
                    }

                    var nuevaFila =
                    "<tr>"
                    +"<td>"+datos.nombre_completo+"</td>"
                    // +"<td>"+datos.ci+"</td>"
                    // +"<td>"+datos.fecha_nacimiento+"</td>"
                    // +"<td>"+datos.contacto+"</td>"
                    +"<td>"+datos.recinto+"</td>"

                    +"<td>"+datos.description+"</td>"
                    +"<td>"+mesas+"</td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                });
                if(TamanoArray==0){
                    var nuevaFila =
                    "<tr><td colspan=6>No se encontraron resultados para su busqueda</td>"
                    +"</tr>";
                    $(nuevaFila).appendTo("#tabla_cedula tbody");
                }
            });
        }
        
    });
    

	
	}	
	activar_mesas();
	
	
	</script>
@endsection