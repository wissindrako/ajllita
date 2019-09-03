@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">

<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Listado de Votacion por Recinto</h3>	
				<h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
					<h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" >
					<h4 class="text-black" >FECHA DE REGISTRO: <b>{{$persona->fecha_registro}}</b></h4 class="text-black" >
		</div>
		<!-- /.box-header -->
		{{-- {{dd($personas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_votacion_general" class="table table-hover table-striped table-bordered">
			<thead>
				<th>Circ.</th>
				<th>Distrito</th>
				<th>Recinto</th>
				<th>Mesa</th>
				<th>Presidenciales</th>
				<th>P - N/B</th>
				{{-- <th>Estado</th>
				<th></th> --}}
			</thead>
		<tbody>
			{{-- {{dd($mesas)}} --}}
			@foreach ($mesas as $mesa)
				<tr>
				<td>{{$mesa->nombre_completo}}</td>
				<td>{{$mesa->contacto}}</td>
				<td>{{$mesa->nombre_recinto}}</td>
				<td>{{$mesa->id_mesa}}</td>
				{{-- {{dd($votos_presidenciales)}} --}}
				@php
					$votos = 0;
					$votos_r = 0;
				@endphp
				@foreach ($votos_presidenciales as $vp)

					@if ($mesa->id_mesa == $vp->id_mesa)
					@php
						$votos = $vp->votos_presidenciales;
					@endphp
					@endif
				@endforeach
				@foreach ($votos_presidenciales_r as $vp)

					@if ($mesa->id_mesa == $vp->id_mesa)
					@php
						$votos_r = $vp->votos_presidenciales_r;
					@endphp
					@endif
				@endforeach
				@if ($votos < 1)
				<td><span class="badge bg-red">Incompleto</span></td>	
				@else
					@if ($votos == 9)
					<td><span class="badge bg-green">Completo</span></td>	
					@else
					<td><span class="badge bg-yellow">Pendiente</span></td>	
					@endif
				@endif
				@if ($votos_r < 1)
				<td><span class="badge bg-red">Incompleto</span></td>	
				@else
					@if ($votos_r == 9)
					<td><span class="badge bg-green">Completo</span></td>	
					@else
					<td><span class="badge bg-yellow">Pendiente</span></td>	
					@endif
				@endif
				</tr>
			@endforeach
		</tbody>
		</table>
		</div>
		<!-- /.box-body -->
	  </div>

</section>
@endsection


@section('scripts')

@parent

<script>
function activar_tabla_votacion_general() {
    var t = $('#tabla_votacion_general').DataTable({

		scrollY:"600px",
		scrollX: true,
		dom: 'Bfrtip',
        processing: true,
        serverSide: true,
		pageLength: 100,
		buttons: [
			'excel', 'pdf', 'print'
		],
		// buttons: [
        //           {
        //               extend: 'pdfHtml5',
        //               orientation: 'landscape',
        //               pageSize: 'LEGAL'
        //           }
		//         ],
		// rowsGroup: [// Always the array (!) of the column-selectors in specified order to which rows groupping is applied
        //           // (column-selector could be any of specified in https://datatables.net/reference/type/column-selector)
        //           // 'first:name',
        //           0,
        //           1,
        //           2,
        //           3,
        //           4,
        //           5,
        //         ],
        language: {
                 "url": '{!! asset('/plugins/datatables/latino.json') !!}'
                  } ,
        ajax: '{!! url('buscar_votacion_recinto') !!}',
        columns: [
            { data: 'circunscripcion', name: 'circunscripcion' },
            { data: 'distrito', name: 'distrito' },
			{ data: 'nombre', name: 'nombre' },
			{ data: 'codigo_mesas_oep', name: 'codigo_mesas_oep' },
			{ data: 'presidenciales.0.partidos', name: 'presidenciales.0.partidos' },
			{ data: 'presidenciales.0.nulos_blancos', name: 'presidenciales.0.nulos_blancos' },
			// { data: 'presidenciales_r', name: 'presidenciales_r' },
            // {data: null,
            //     render: function(data, type, row, meta) {
            //         var additionalRemedies = '';
            //         //loop through all the row details to build output string
            //         for (var item in row.presidenciales) {
            //             var r = row.additionalRemedies[item];
            //             additionalRemedies = additionalRemedies +  r.presidenciales + '</br>';
			// 			console.log(additionalRemedies);
						
            //         }
            //         return additionalRemedies;
 
            //     }
            // },
            // { data: 'contacto', name: 'contacto' },
            // { data: 'mesa_activa', name: 'mesa_activa' },

            // { data: null,  render: function ( data, type, row ) {
			// 		if  ( row.mesa_activa === null || row.mesa_activa === 0) {
			// 			return "<i class='fa fa-circle-o text-red'></i><p class='text-red'>No Asignado</p>"
			// 		} else {
			// 			return "<i class='fa fa-circle-o text-green'></i><p class='text-green'>Asignado</p>"
			// 		}
			// 	}  
			// },
        ],
		"order": [[3, 'asc']]
    });

}	
// activar_tabla_votacion_general();


</script>



@endsection


