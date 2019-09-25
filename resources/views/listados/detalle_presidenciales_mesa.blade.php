<section>

<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Detalle Votacion Presidencial</h3>	
			{{-- <h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
			<h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" > --}}
			<h4 class="text-black" >CIRCUNSCRIPCION: <b>{{$mesa->circunscripcion}}</b></h4 class="text-black" >
			<h4 class="text-black" >DISTRITO: <b>{{$mesa->distrito}}</b></h4 class="text-black" >
			<h4 class="text-black" >RECINTO: <b>#{{$mesa->id_recinto}} - {{$mesa->nombre_recinto}}</b></h4 class="text-black" >
		</div>
		<!-- /.box-header -->
		{{-- {{dd($detalle_mesas)}} --}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_votacion_general" class="table table-hover table-striped table-bordered">
			<thead>
				<tr>				
					{{-- <th># Recinto</th> --}}
					<th style="background-color:#3c8dbc; text-align:center; color:white" class="col-sm-1">Partido</th>
					<th style="background-color:#3c8dbc; text-align:center; color:white" class="col-sm-1">Votos</th>
					<th style="background-color:#3c8dbc; text-align:center; color:white" class="col-sm-10">Foto del Acta</th>
				</tr>
				{{-- <th>Estado</th>
				<th></th> --}}
			</thead>
		<tbody>
			{{-- {{dd($votos_presidenciales)}} --}}
			
			@foreach ($detalle_mesas as $key => $p)
			<tr>
				<td>
					<div class="user-block">
						<img class="img-circle img-bordered-sm" src={{ url($p['logo']) }} alt="user image">
							<span class="username">
								<a href="#">{{ $p['sigla'] }}</a>
							</span>
						{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
					</div>
				</td>
				<td style="text-align:center;"><h2><b>{{$p['validos']}}</b></h2></td>
				@if ($key == 0)
					@if ($mesa->foto_presidenciales != "")
					<td rowspan="9"><img class="img-responsive" src="{{ $mesa->foto_presidenciales }}" alt="Foto del Acta"></td>
					@else
					<td  style="text-align:center;" rowspan="9">No se cargó la foto aún...!</td>
					@endif
				@endif
			</tr>
			@endforeach
			<tr>
				<td>
					<div class="user-block">
						<img class="img-circle img-bordered-sm" src={{ url('/img/blanco.png') }} alt="user image">
							<span class="username">
								<a href="#">Blancos</a>
							</span>
						{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
					</div>
				</td>
				@if (empty($votos_presidenciales_r))
				<td style="text-align:right;"></td>
				@else
				<td style="text-align:center;"><h2><b>{{$votos_presidenciales_r->blancos}}</b></h2></td>
				@endif
			</tr>
			<tr>
			<td>
				<div class="user-block">
					<img class="img-circle img-bordered-sm" src={{ url('/img/nulo.png') }} alt="user image">
						<span class="username">
							<a href="#">Nulos</a>
						</span>
					{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
				</div>
			</td>
			@if (empty($votos_presidenciales_r))
			<td style="text-align:right;"></td>
			@else
			<td style="text-align:center;"><h2><b>{{$votos_presidenciales_r->nulos}}</b></h2></td>
			@endif
			
			</tr>
		
		</tbody>
		</table>
		</div>
		<!-- /.box-body -->
	  </div>

</section>


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


