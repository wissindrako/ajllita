

<div class="box box-primary col-xs-12">


<div class='aprobado' style="margin-top:70px; text-align: center">
  <span class="label label-success">Realizado <i class="fa fa-check"></i></span><br/>
  <label style='color:#177F6B'>
    Formulario enviado correctamente
  </label> 

</div>

 <div class="margin" style="margin-top:50px; text-align:center;margin-bottom: 50px;">
    <div class="btn-group">
        @if ($msj == 'enviado_gastronomia')
        <a href="{{ url('/form_encuesta_gastronomia') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif

        @if ($msj == 'enviado_visitante')
        <a href="{{ url('/form_encuesta_visitante') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif

        @if ($msj == 'enviado_literatura')
        <a href="{{ url('/form_encuesta_literatura') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif

        @if ($msj == 'enviado_turismo')
        <a href="{{ url('/form_encuesta_turismo') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif
        
        @if ($msj == 'enviado_productores')
        <a href="{{ url('/form_encuesta_productores') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif
        
        @if ($msj == 'enviado_artesania')
        <a href="{{ url('/form_encuesta_artesania') }}" class="btn btn-success"    value=" "  > Nueva Encuesta</a>
        @endif
      
    </div>
    <div class="btn-group" style="margin-left:50px; " >
      <a href="{{ url('/') }}" class="btn btn-info"    value=" "  > Salir </a>
    </div>
 </div> 


 

 </div> 

