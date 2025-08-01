<section>

<div class="box box-primary">
	<div class="box-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cerrar_modal"><span aria-hidden="true">&times;</span></button>
		<h3 class="box-title">Detalle Votación Uninominal</h3>	
		{{-- <h4 class="text-black" >NOMBRE: <b>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</b></h4 class="text-black" >
		<h4 class="text-black" >CEDULA: <b>{{$persona->cedula_identidad}} {{$persona->complemento_cedula}} {{$persona->expedido}}</b></h4 class="text-black" > --}}
		<h4 class="text-black" >CIRCUNSCRIPCION: <b>{{$mesa->circunscripcion}}</b></h4 class="text-black" >
		<h4 class="text-black" >DISTRITO: <b>{{$mesa->distrito}}</b></h4 class="text-black" >
		<h4 class="text-black" >RECINTO: <b>#{{$mesa->id_recinto}} - {{$mesa->nombre_recinto}}</b></h4 class="text-black" >
		<h4 class="text-black" ><b>MESA: {{$mesa->id_mesa}}</b> - ({{ $mesa->codigo_sistema }})</h4 class="text-black" >
			<input type="hidden" name="" id="id_mesa" value="{{$mesa->id_mesa}}">
			<input type="hidden" name="" id="habilitados" value="{{$mesa->numero_votantes}}">
	</div>
	<!-- /.box-header -->
	{{-- {{dd($detalle_mesas)}} --}}
	<div class="box-body table-responsive no-padding">
		<table id="tabla_votacion_general" class="table table-hover table_striped_uninominales table-bordered">
		<thead>
			<tr>			
				<th width="15%" style="background-color:#038fe1; text-align:center; color:white" class="col-sm-2">Partido</th>
				<th width="10%" style="background-color:#038fe1; text-align:center; color:white" class="col-sm-2">Cantidad Votos</th>
				<th width="5%" style="background-color:#038fe1; text-align:center; color:white" class="col-sm-1"></th>
				<th width="70%" style="background-color:#038fe1; text-align:center; color:white" class="col-sm-7">Foto del Acta</th>
			</tr>
			{{-- <th>Estado</th>
			<th></th> --}}
		</thead>
	<tbody>
		
		@foreach ($detalle_mesas as $key => $p)
		<tr>
			<td>
				<div class="user-block">
					<img class="img-circle img-bordered-sm" src={{ url($p['logo']) }} alt="user image">
						<span class="username">
							{{-- <a href="#">{{ $p['sigla'] }}</a> --}}
							{{ $p['sigla'] }}
						</span>
					{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
				</div>
			</td>
			<td style="text-align:center;">
				{{-- <h2><b>{{$p['validos']}}</b></h2> --}}
				<input type="hidden" name="" id="id_votos_uninominales" value="{{$p['id_votos_uninominales']}}">
				<input type="hidden" name="" id="id_partido" value="{{$p['id_partido']}}">
				<input style='font-size: 35px; color:black; height: 50px; font-weight:bold; text-align:center' type="number" min="0" max="250" name="input_voto" id="input_voto" placeholder="" class="input_voto form-control" value="{{$p['validos']}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
				
			</td>
			<td>
				<button type="button" class="btn_partido btn btn-default btn-lg"><i class="fa fa-fw fa-save"></i></button>
			</td>
			@if ($key == 0)
				@if ($mesa->foto_uninominales != "")
				<td rowspan="9"><img class="" src="{{ $mesa->foto_uninominales }}" style="width:800px; height:600px;" alt="Foto del Acta"></td>
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
							{{-- <a href="#">Blancos</a> --}}
							Blancos
						</span>
					{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
				</div>
			</td>
			@if (empty($votos_uninominales_r))
			<td style="text-align:center;">
				<input type="hidden" name="" id="blanco_nulo" value="BLANCO">
				<input type="hidden" name="" id="id_votos_uninominales_r" value="">
				<input style='font-size: 35px; color:black; height: 50px; font-weight:bold; text-align:center' type="number" min="0" max="250" name="input_voto_bn" id="input_voto_bn" placeholder="" class="input_voto form-control" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
			</td>
			<td>
				<button type="button" class="btn_blanco_nulo btn btn-default btn-lg"><i class="fa fa-fw fa-save"></i></button>
			</td>
			@else
			<td style="text-align:center;">
				<input type="hidden" name="" id="blanco_nulo" value="BLANCO">
				<input type="hidden" name="" id="id_votos_uninominales_r" value="{{$votos_uninominales_r->id_votos_uninominales_r}}">
				<input style='font-size: 35px; color:black; height: 50px; font-weight:bold; text-align:center' type="number" min="0" max="250" name="input_voto_bn" id="input_voto_bn" placeholder="" class="input_voto form-control" value="{{$votos_uninominales_r->blancos}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
			</td>
			<td>
				<button type="button" class="btn_blanco_nulo btn btn-default btn-lg"><i class="fa fa-fw fa-save"></i></button>
			</td>
			
			@endif
		</tr>
		<tr>
		<td>
			<div class="user-block">
				<img class="img-circle img-bordered-sm" src={{ url('/img/nulo.png') }} alt="user image">
					<span class="username">
						{{-- <a href="#">Nulos</a> --}}
						Nulos
					</span>
				{{-- <span class="description">{{ $p['nombre_partido'] }}</span> --}}
			</div>
		</td>
		@if (empty($votos_uninominales_r))
		<td style="text-align:center;">
			<input type="hidden" name="" id="blanco_nulo" value="NULO">
			<input type="hidden" name="" id="id_votos_uninominales_r" value="">
			<input style='font-size: 35px; color:black; height: 50px; font-weight:bold; text-align:center' type="number" min="0" max="250" name="input_voto_bn" id="input_voto_bn" placeholder="" class="input_voto form-control" value="" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
		</td>
		<td>
			<button type="button" class="btn_blanco_nulo btn btn-default btn-lg"><i class="fa fa-fw fa-save"></i></button>
		</td>
		@else
		<td style="text-align:center;">
			<input type="hidden" name="" id="blanco_nulo" value="NULO">
			<input type="hidden" name="" id="id_votos_uninominales_r" value="{{$votos_uninominales_r->id_votos_uninominales_r}}">
			<input style='font-size: 35px; color:black; height: 50px; font-weight:bold; text-align:center' type="number" min="0" max="250" name="input_voto_bn" id="input_voto_bn" placeholder="" class="input_voto form-control" value="{{$votos_uninominales_r->nulos}}" pattern="[0-9]{6,9}" onkeydown="return event.keyCode !== 69"  required/>
		</td>
		<td>
			<button type="button" class="btn_blanco_nulo btn btn-default btn-lg"><i class="fa fa-fw fa-save"></i></button>
		</td>
		@endif
		
		</tr>
	
	</tbody>
	</table>
	</div>
	<!-- /.box-body -->
	</div>

</section>
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

var habilitados = parseInt(document.getElementById("habilitados").value);
console.log("Total Votos: " + suma_votos());
console.log("Número de Habilitados: " + habilitados);

$('.table tbody').on('click', '.btn_partido', function(){
	var id_mesa = $("#id_mesa").val();

	var fila = $(this).closest('tr');
	var input_voto = fila.find('#input_voto').val();
	var id_votos_uninominales = fila.find('#id_votos_uninominales').val();
	var id_partido = fila.find('#id_partido').val();

	$.ajax({
		// alert('sdaf');
		type:'POST',
		url:"detalle_editar_mesa_uninominal", // sending the request to the same page we're on right now
		data:{
			'id_mesa':id_mesa,
			'input_voto':input_voto,
			'id_votos_uninominales':id_votos_uninominales,
			'id_partido':id_partido
		},
			success: function(result){
				if (result == 'ok') {
					alertify.success('Voto del partido actualizado');
				}
				else if (result == 'sin_valor') {
					alertify.success('Ingrese algun valor');
				}
				else{
					alertify.success('Voto del partido actualizado');
				}
			}
		});

		if (suma_votos() > habilitados) {
			alertify.error('La cantidad de votos excede el límite de ' + habilitados);
		}
});

//Blancos y Nulos
$('.table tbody').on('click', '.btn_blanco_nulo', function(){
	var id_mesa = $("#id_mesa").val();

	var fila = $(this).closest('tr');
	var blanco_nulo = fila.find('#blanco_nulo').val();
	var input_voto_bn = fila.find('#input_voto_bn').val();
	var id_votos_uninominales_r = fila.find('#id_votos_uninominales_r').val();

	$.ajax({
		// alert('sdaf');
		type:'POST',
		url:"detalle_editar_mesa_uninominal_r", // sending the request to the same page we're on right now
		data:{
			'id_mesa':id_mesa,
			'input_voto_bn':input_voto_bn,
			'id_votos_uninominales_r':id_votos_uninominales_r,
			'blanco_nulo':blanco_nulo
		},
			success: function(result){
				if (result == 'ok') {
					alertify.success('Voto del partido actualizado');
				}
				else if (result == 'sin_valor') {
					alertify.error('Ingrese algun valor');
				}
				else{
					alertify.success('Voto del partido actualizado');
				}
			}
		});

		if (suma_votos() > habilitados) {
			alertify.error('La cantidad de votos excede el límite de ' + habilitados);
		}
});

function suma_votos(){

	// console.log(document.getElementById("input_voto").value);
	var data = []; 
	var table = document.getElementById( 'tabla_votacion_general' ); 
	var input = table.getElementsByTagName( 'input' ); 
	for ( var z = 0; z < input.length; z++ ) { 
		if (input[z].id === 'input_voto' || input[z].id === 'input_voto_bn') {
			// data.push( input[z].id );
			if (input[z].value !== "") {
				data.push( parseInt(input[z].value) ); 
			}
		}
	}

	let total=0;
	data.forEach(function(a){total += a;});
	return total;
}

</script>