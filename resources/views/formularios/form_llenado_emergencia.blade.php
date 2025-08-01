@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

<section  id="contenido_principal">

    @if(session()->has('mensaje_exito'))
        {{-- <div class="alert alert-success">
        {{ session()->get('mensaje_exito') }}
        </div> --}}
        @section("scripts_toasts")
        <script>
            alertify.success(' Votos registrados ');
        </script>
        @endsection
    @endif
    @if(session()->has('mensaje_error'))
        {{-- <div class="alert alert-warning">
        {{ session()->get('mensaje_error') }}
        </div> --}}
        @section("scripts_toasts")
        <script>
            alertify.error(' No se registraron los votos, revise su conexión ');
        </script>
        @endsection
    @endif

    @if(session()->has('mensaje_exito_imagen'))
        @section("scripts_toasts")
        <script>
            alertify.success(' Imagen Cargada ');
        </script>
        @endsection
    @endif
    @if(session()->has('mensaje_error_imagen'))
        @section("scripts_toasts")
        <script>
            alertify.error(' No se cargo la imagen, vuelva a intentarlo ');
        </script>
        @endsection
    @endif

<div class="box box-primary">
        <div class="box-header" style="text-align:center;">
        <h3 class=""><b>Llenado de Mesas - Votos Presidenciales</b></h3>
        <h3 class=""><b>{{$recinto->nombre}}</b> ({{count($mesas)}} mesas)</h3>
				{{-- <input type="hidden" id="rol_usuario" value="{{ $rol->slug }}"> --}}
		</div>
		<!-- /.box-header -->

        {{-- {{dd($votos_presidenciales_r)}} --}}

		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas" class="table table-hover table_striped_presidenciales table-bordered">
            {{-- <table class="table"> --}}
                    <thead>
                        {{-- <tr style="background-color:#111111; text-align:center; color:white"> --}}
                        <tr>
                        <th style='font-size: 16px; text-align:center; font-family: "Source Sans Pro"; vertical-align: middle;'>                                    
                            #
                        </th>
                        <th style='font-size: 16px; text-align:center; font-family: "Source Sans Pro"; vertical-align: middle;'>
                            MESA
                        </th>
                        @foreach ($partidos as $partido)
                        {{-- <th style="text-align:center" width="9%">{{$partido->sigla}}</th> --}}
                        <th style="text-align:left" width="9%">					
                            <div class="user-block"  style="vertical-align: middle">
                                <img class="img-circle img-bordered-sm" src={{url($partido->logo)}} alt="user image">
                                    <span class="username">
                                        {{-- <a href="#">{{$partido->sigla}}</a> --}}
                                        {{$partido->sigla}}
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        @endforeach
                        <th style="text-align:left" width="8%">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src={{url('/img/blanco.png')}} alt="user image">
                                    <span class="username">
                                        {{-- <a href="#">Blancos</a> --}}
                                        Blancos
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        <th style="text-align:left" width="8%">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src={{url('/img/nulo.png')}} alt="user image">
                                    <span class="username">
                                        {{-- <a href="#">Nulos</a> --}}
                                        Nulos
                                    </span>
                                {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                            </div>
                        </th>
                        <th style="text-align:center" width="1%"></th>
                        <th style="text-align:center" width="1%"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($mesas as $key => $mesa)
                        @php
                            $num = $key+1;
                        @endphp
                        @if ($num % 7 == 0)
                        <tr>
                            <th style='font-size: 16px; text-align:center; font-family: "Source Sans Pro"; vertical-align: middle;'>                                    
                                #
                            </th>
                            <th style='font-size: 16px; text-align:center; font-family: "Source Sans Pro"; vertical-align: middle;'>
                                MESA
                            </th>
                            @foreach ($partidos as $partido)
                            {{-- <th style="text-align:center" width="9%">{{$partido->sigla}}</th> --}}
                            <th style="text-align:left" width="10%">					
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url($partido->logo)}} alt="user image">
                                        <span class="username">
                                            {{-- <a href="#">{{$partido->sigla}}</a> --}}
                                            {{$partido->sigla}}
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            @endforeach
                            <th style="text-align:left" width="8%">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url('/img/blanco.png')}} alt="user image">
                                        <span class="username">
                                            {{-- <a href="#">Blancos</a> --}}
                                            Blancos
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            <th style="text-align:left" width="8%">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src={{url('/img/nulo.png')}} alt="user image">
                                        <span class="username">
                                            {{-- <a href="#">Nulos</a> --}}
                                            Nulos
                                        </span>
                                    {{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
                                </div>
                            </th>
                            <th style="text-align:center"></th>
                        </tr>
                        @endif
                        <tr>
                            <form action="{{ route('llenado_emergencia') }}"  method="post">
                            <td style='font-size: 15px;'><b>{{$key+1}}</b></td>
                            <td style='font-size: 15px;' scope="row"><b>{{ $mesa->id_mesa }}</b>
                                <input type="hidden" name="id_mesa" id="id_mesa" value="{{$mesa->id_mesa}}">
                                <input type="hidden" name="id_recinto" id="id_recinto" value="{{$recinto->id_recinto}}">
                            </td>
                            @foreach ($partidos as $partido)
                            <td>
                                @if ($mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('id_partido')->first() )
                                <div class="form-group" style="text-align:center">
                                <input type="number" name="partidos[{{$partido->id_partido}}]" id="partido_{{$partido->id_partido}}" min="0" max="250" value="{{$mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('validos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                                @else
                                <div class="form-group" style="text-align:center">
                                <input type="number" name="partidos[{{$partido->id_partido}}]" id="partido_{{$partido->id_partido}}" min="0" max="250" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69">
                                </div>
                                @endif
                            </td>
                            @endforeach
                            @if (!is_null($mesa->votos_presidenciales_r ))
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="blancos" id="blancos" min="0" max="250" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('blancos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="nulos" id="nulos" min="0" max="250" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('nulos')->first()}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" style='width: 80px;'>
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="blancos" id="blancos" min="0" max="250" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" >
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="nulos" id="nulos" min="0" max="250" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69" >
                                </div>
                            </td>
                            @endif

                            <td>
                                <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-fw fa-save"></i></button>
                            </td>
                            </form>
                        <td>
                            {{-- <button type="button" class="btn_foto btn btn-default btn-xs"><i class="fa fa-camera"></i>{{ $mesa->id_mesa}}</button> --}}
                            <form>
                                <button type="button" onclick="verinfo_mesas({{$mesa->id_mesa}},20);" class="btn_foto btn btn-default btn-xs"><i class="fa fa-camera"></i></button>
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
			@if (count($mesas) == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... no se encontraron resultados para su busqueda...
				</label>
				</div>
			</div>
			@endif
		</div>
		<!-- /.box-body -->
	  </div>

</section>


@section('scripts')



@parent

<script>

max = 250;
$('input[type="number"]').keydown(function () {
	// Save old value.
	if (!$(this).val() || (parseInt($(this).val()) <= max && parseInt($(this).val()) >= 0))
	$(this).data("old", $(this).val());
});
$('input[type="number"]').keyup(function () {
	// Check correct, else revert back to old value.
	if (!$(this).val() || (parseInt($(this).val()) <= max && parseInt($(this).val()) >= 0))
	;
	else
	$(this).val($(this).data("old"));
});

</script>

@endsection


@endsection
