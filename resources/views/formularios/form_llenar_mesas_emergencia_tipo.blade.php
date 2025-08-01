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
                          <h3>
														Llenado de Mesas de Emergencia
													</h3>
                            <p>Por favor pulse sobre el tipo de votación a registrar</p>
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

	                  <div id="div_notificacion_sol" class="myform-bottom">
											{{-- @foreach ($mesas as $mesa) --}}
												<br><br>
													{{-- <button type="button" onclick="verinfo_mesas({{$personas_logueadas->id_recinto}},10);" style="font-size: 18px; border-color: #0bcaec; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#09de5a), color-stop(100%,#3ACBC7)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														PRESIDENCIAL
													</button> --}}
                          <form action="{{ route('form_llenado_emergencia', $personas_logueadas->id_recinto) }}"  method="get">
                            <button type="submit" style="font-size: 18px; border-color: #0bcaec; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fff), color-stop(100%,#62d4f3)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                              PRESIDENCIAL
                            </button>
                          </form>
                        @if (isConcejal())
                        <br><br>
                        {{-- <button type="button" onclick="verinfo_mesas({{$personas_logueadas->id_recinto}},11);" style="font-size: 18px; border-color: #f51ebfd2; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fff), color-stop(100%,#3ACBC7)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                          UNINOMINAL
                        </button> --}}
                        <form action="{{ route('form_llenado_emergencia_uninominales', $personas_logueadas->id_recinto) }}"  method="get">
                          <button type="submit" style="font-size: 18px; border-color: #0bcaec; padding: 30px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fff), color-stop(100%,#62d4f3)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
                            UNINOMINAL
                          </button>
                        </form>
                        @endif
												<br><br>
												<form action="{{ url('form_votar_seleccionar_mesa') }}"  method="get">
													<button type="submit" style="font-size: 18px; padding: 10px;width: 100%; background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fff), color-stop(100%,#a3a3a3)); -webkit-box-shadow: inset 0px 0px 6px #fff; border-radius: 10px;">
														<i class="fa fa-mail-reply-all"></i> Volver
													</button>
												</form>
											{{-- @endforeach --}}
	                  </div>
              </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
