<section  id="content" style="background-color: #002640;">


<div class="box box-primary">
		<div class="box-header">
				<h3 class="box-title">Llenado de Mesas de Emergencia</h3>
				{{-- <input type="hidden" id="rol_usuario" value="{{ $rol->slug }}"> --}}
		</div>
		<!-- /.box-header -->
		@foreach ($users as $item)

            {{-- {{ \App\User::find($item->id)->persona['nombre'] }} --}}

        @endforeach
        {{-- {{dd($votos_presidenciales_r)}} --}}

		<div class="box-body table-responsive no-padding">
		  <table id="tabla_personas" class="table table-hover table-striped table-bordered">
            {{-- <table class="table"> --}}
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Mesa</th>
                        @foreach ($partidos as $partido)
                        <th style="text-align:center" width="8%">{{$partido->sigla}}</th>
                        @endforeach
                        <th style="text-align:center" width="8%">Blancos</th>
                        <th style="text-align:center" width="8%">Nulos</th>
                        <th style="text-align:center" width="8%">Guardar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($mesas as $key => $mesa)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td scope="row">{{$mesa->id_mesa}}</td>
                            @foreach ($partidos as $partido)
                            <td>

                                @if ($mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('id_partido')->first() )
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="input_saldo" value="{{$mesa->votos_presidenciales->where('id_partido',$partido->id_partido)->pluck('validos')->first()}}" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="">
                                </div>
                                @else
                                <div class="form-group" style="text-align:center">
                                <input type="number" name="" id="input_saldo" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="" >
                                </div>
                                {{-- @break --}}
                                @endif
                            </td>
                            @endforeach
                            @if (!is_null($mesa->votos_presidenciales_r ))
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="input_saldo" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('blancos')->first()}}" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="">
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="input_saldo" value="{{$mesa->votos_presidenciales_r->where('id_mesa',$mesa->id_mesa)->pluck('nulos')->first()}}" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="">
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="input_saldo" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="">
                                </div>
                            </td>
                            <td>
                                <div class="form-group" style="text-align:center">
                                    <input type="number" name="" id="input_saldo" value="" style='width: 80px;'><input type="hidden" name="" id="id_gestion" value="">
                                </div>
                            </td>
                            @endif

                            <td><button type="button" class="btn_gestion btn btn-default btn-xs"><i class="fa fa-fw fa-save"></i></button></td>
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
