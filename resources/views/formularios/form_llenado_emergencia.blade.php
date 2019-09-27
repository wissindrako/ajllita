<section  id="content" style="background-color: #002640;">


<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Llenado de Mesas de Emergencia</h3>
				{{-- <input type="hidden" id="rol_usuario" value="{{ $rol->slug }}"> --}}
		</div>
		<!-- /.box-header -->
		{{dd($votos_presidenciales)}}
		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas" class="table table-hover table-striped table-bordered">
            {{-- <table class="table"> --}}
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>id_gestion</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Vigencia</th>
                            <th>Saldo</th>
                            <th>Acción</th>
                        </tr>
                        @foreach ($collection as $item)
                            
                        @endforeach
                    </thead>
                    <tbody>
                        {{-- @foreach ($gestiones as $gestion)
                        <tr>
                            <td scope="row">{{$gestion->id_usuario}}</td>
                            <td>{{ $gestion->id }}</td>
                            <td>{{$gestion->desde}}</td>
                            <td>{{$gestion->hasta}}</td>
                            <td>{{$gestion->vigencia}}</td>
                            <td><input type="number" name="" id="input_saldo" value="{{$gestion->saldo}}"><input type="hidden" name="" id="id_gestion" value="{{ $gestion->id }}"></td>
                            <td><button type="button" class="btn_gestion btn btn-default btn-xs"><i class="fa fa-fw fa-save"></i></button></td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
			{{-- @if (count($personas) == 0) --}}
			<div class="box box-primary col-xs-12">
				<div class='aprobado' style="margin-top:70px; text-align: center">
				<label style='color:#177F6B'>
					... no se encontraron resultados para su busqueda...
				</label>
				</div>
			</div>
			{{-- @endif --}}
		</div>
		<!-- /.box-body -->
	  </div>

</section>


@section('scripts')

@parent


<script>
        $('.table tbody').on('click', '.btn_gestion', function(){
        //   alertify.success('id_gestion:');
        var fila = $(this).closest('tr');
        var id_gestion = fila.find('#id_gestion').val();
        var input_saldo = fila.find('#input_saldo').val();
        
        $.ajax({
            type:'POST',
            url:"edita_datos_gestion", // sending the request to the same page we're on right now
            data:{'id_gestion':id_gestion, 'input_saldo':input_saldo},
                success: function(result){
                    if (result == 'ok') {
                        alertify.success('Gestión actualizada correctamente');
                    }
                    else{
                        alertify.success('Gestión actualizada correctamente');
                    }
                }
            }
        )
        
        })
        </script>


@endsection
