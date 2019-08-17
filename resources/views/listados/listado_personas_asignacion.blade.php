@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Personas - Asignacion</h3>	
	
			<div class="box-header">
				<h4 class="box-title">Usuarios</h4>	        
				<form   action="{{ url('buscar_persona_asignacion') }}"  method="post"  >
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"> 
					<div class="input-group input-group-sm">
						<input type="text" class="form-control" id="dato_buscado" name="dato_buscado" required>
						<span class="input-group-btn">
						<input type="submit" class="btn btn-primary" value="buscar" >
						</span>
					</div>
				</form>
			</div>
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover table-striped table-bordered">
			<tbody>

			<tr>
				<th>ID</th>
				<th>Nombre Completo</th>
				<th>Cedula de Identidad</th>
				{{-- <th>Fecha nacimiento</th> --}}
				{{-- <th>Telf. Cel.</th> --}}
				{{-- <th>Telf. Ref.</th> --}}
				{{-- <th>Email</th> --}}
				{{-- <th>Dirección</th> --}}
				<th>Compromiso</th>
				<th>Fecha de Registro</th>
				<th>Activo</th>
				<th>Recinto</th>
				<th>Origen</th>
				<th>Sub Origen</th>
				<th>Rol</th>
				<th>Asignar</th>
			</tr>
			{{-- // ->where('personal.idarea', $persona->idarea)
			// ->where('vacaciones.id_estado', '=' ,1) --}}

			@foreach ($personas as $p)
				<tr>
					<td>{{$p->id_persona}}</td>
					<td>{{$p->nombre.' '.$p->paterno.' '.$p->materno}}</td>
					<td>{{$p->cedula_identidad}} {{$p->complemento_cedula}} {{$p->expedido}}</td>
					{{-- <td>{{f_formato($p->fecha_nacimiento)}}</td>
					<td>{{$p->telefono_celular}}</td>
					<td>{{$p->telefono_referencia}}</td> --}}
					{{-- <td>{{$p->email}}</td> --}}
					{{-- <td>{{$p->direccion}}</td> --}}
					<td>{{$p->grado_compromiso}}</td>
					<td>{{f_formato($p->fecha_registro)}}</td>
					<td>{{$p->activo}}</td>
					<td>{{$p->nombre_recinto}}</td>
					<td>{{$p->origen}}</td>
					<td>{{$p->sub_origen}}</td>
					<td>{{$p->nombre_rol}}</td>
					
					@if ($p->activo == 1)
					<td><button type="button" class="btn btn-success btn-xs" onclick="verinfo_usuario({{ $p->id_persona }}, 20)" ><i class="fa fa-random"></i></button></td>
					{{-- <td><button type="button" class="btn btn-danger btn-xs" onclick="verinfo_persona({{ $p->id_persona }}, 2)" ><i class="fa fa-fw fa-user-times"></i></button></td> --}}
					@else
					<td><button disabled type="button" class="btn btn-success btn-xs" ><i class="fa fa-random"></i></button></td>
					{{-- <td><button disabled type="button" class="btn btn-danger btn-xs"  ><i class="fa fa-fw fa-user-times"></i></button></td> --}}
					@endif
					


					{{-- @if ($p->estado == 'SOLICITADA')
					<td><span class="badge bg-blue">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'APROBADA')
					<td><span class="badge bg-yellow">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" onclick="verinfo_usuario({{  $p->id_solicitud }}, 8)"  ><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'AUTORIZADA')
					<td><span class="badge bg-green">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td>
					@endif
					@if ($p->estado == 'RECHAZADA')
					<td><span class="badge bg-red">{{$p->estado}}</span></td>
					<td><button type="button" class="btn  btn-default btn-xs" disabled ><i class="fa fa-fw fa-edit"></i></button></td>
					@endif --}}
				</tr>
			@endforeach

			</tbody></table>
			@if (count($personas) == 0)
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... Realizar nueva busqueda ...
				</label> 
				</div>
			</div> 
			@endif
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection