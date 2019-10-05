@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3 myform-cont" >

                     <div class="myform-top">
                        <div class="myform-top-left">
                           {{-- <img  src="" class="img-responsive logo" /> --}}
                          <h3>Mesas de Votación a llenar</h3>
                            <p>Por favor pulse sobre la mesa de votación a llenar</p>
                        </div>
                        <div class="myform-top-right">
                          <i class="fa fa-edit"></i>
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

	                  <div class="myform-bottom">
											@foreach ($mesas as $mesa)
												<form action="{{ url('form_votar_seleccionar_tipo') }}"  method="post">
													<input type="hidden" name="id_mesa" value="{{ $mesa->id_mesa }}">
													<br>
													<button type="submit" style="font-size: 16px; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#87CEEB), color-stop(100%,#4682B4)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														MESA {{ $mesa->codigo_mesas_oep }}
														<br>({{ $mesa->codigo_ajllita }})
														<br>
															Votos Presidenciales:
																<?php
																	//Controlamos que hayan llenado los 10 registros (9 presidente y 1 blancos y nulos)
																	$registros_presidenciales = $mesa->registros_presidenciales + $mesa->registros_presidenciales_r;
																?>
																@if($registros_presidenciales == 0)
																	<p style="width: 2rem; height: 2rem; border-radius: 50%; background: white;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspPendiente</span>
																	</p>
																@elseif($registros_presidenciales>0 && $registros_presidenciales <= $cantidad_partidos)
																	{{-- <p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto</span>
																	</p> --}}
																	@if($mesa->foto_presidenciales == "")
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto&nbspSin&nbspFoto</span>
																		</p>
																	@else
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto&nbspCon&nbspFoto</span>
																		</p>
																	@endif
																@elseif($registros_presidenciales == $cantidad_partidos+1)
																	{{-- <p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto</span>
																	</p> --}}
																	@if($mesa->foto_presidenciales == "")
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto&nbspSin&nbspFoto</span>
																		</p>
																	@else
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto&nbspCon&nbspFoto</span>
																		</p>
																	@endif
																@endif





																<?php
																	//Controlamos que la suma no exceda el total de votos que se deben emitir
																	$suma_presidenciales = $mesa->suma_presidenciales + $mesa->suma_presidenciales_nulos + $mesa->suma_presidenciales_blancos;
																?>
																@if($suma_presidenciales > $mesa->numero_votantes)
																	<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspRev.&nbspValores</span>
																	</p>
																@endif

														<br>
															Votos Uninominales:
																<?php
																	//Controlamos que hayan llenado los 10 registros (9 presidente y 1 blancos y nulos)
																	$registros_uninominales = $mesa->registros_uninominales + $mesa->registros_uninominales_r;
																?>
																@if($registros_uninominales == 0)
																	<p style="width: 2rem; height: 2rem; border-radius: 50%; background: white;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspPendiente</span>
																	</p>
																@elseif($registros_uninominales>0 && $registros_uninominales <= $cantidad_partidos)
																	{{-- <p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto</span>
																	</p> --}}
																	@if($mesa->foto_uninominales == "")
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto&nbspSin&nbspFoto</span>
																		</p>
																	@else
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: yellow;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspIncompleto&nbspCon&nbspFoto</span>
																		</p>
																	@endif
																@elseif($registros_uninominales == $cantidad_partidos+1)
																	{{-- <p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto</span>
																	</p> --}}
																	@if($mesa->foto_uninominales == "")
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto&nbspSin&nbspFoto</span>
																		</p>
																	@else
																		<p style="width: 2rem; height: 2rem; border-radius: 50%; background: green;	justify-content: center; margin:0px auto;">
																			<span>&nbsp&nbsp&nbsp&nbsp&nbspCompleto&nbspCon&nbspFoto</span>
																		</p>
																	@endif

																@endif


																<?php
																	//Controlamos que la suma no exceda el total de votos que se deben emitir
																	$suma_uninominales = $mesa->suma_uninominales + $mesa->suma_uninominales_nulos + $mesa->suma_uninominales_blancos;
																?>
																@if($suma_uninominales > $mesa->numero_votantes)
																	<p style="width: 2rem; height: 2rem; border-radius: 50%; background: red;	justify-content: center; margin:0px auto;">
																		<span>&nbsp&nbsp&nbsp&nbsp&nbspRev.&nbspValores</span>
																	</p>
																@endif
													</button>
												</form>
											@endforeach
									</div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
