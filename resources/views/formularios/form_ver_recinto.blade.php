@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
@php
    header('Access-Control-Allow-Origin: *');
@endphp

@section('main-content')
<section  id="contenido_principal">
<section  id="content">

    <div class="" >
        <div class="container">
            <div class="row">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubicación de mi Recinto</h3>
        
                        <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div id="div_map" class="col-md-9 col-sm-8">
                            {{-- <div style="width: 100%">
                                <iframe width="100%" height="600" src="https://www.google.com/maps/place/16%C2%B033'54.6%22S+68%C2%B012'57.1%22W/@-16.5651667,-68.2180498,17z/data=!3m1!4b1!4m6!3m5!1s0x0:0x0!7e2!8m2!3d-16.5651623!4d-68.2158571?hl=es-419" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                                </iframe>
                            </div><br /> --}}
                            @if (!empty($recinto))
                            <a href="{{$recinto->geolocalizacion}}" target="_blank" class="btn btn-app">
                                    {{-- <span class="badge bg-red">531</span> --}}
                                    <i class="fa fa-map-marker"></i> Ver
                                </a>
                            @else
                                
                            @endif
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-4">
                            <div class="pad box-pane-right bg-primary" style="min-height: 280px">
                            <div class="description-block margin-bottom">
  
                                <h5 class="description-header">Circunscripción</h5>
                                <span class="description-text">
                                @if (!empty($recinto))
                                    {{$recinto->circunscripcion}}
                                @else
                                    Todos
                                @endif
                                </span>
                            </div>
                            <!-- /.description-block -->
                            <div class="description-block margin-bottom">

                                <h5 class="description-header">Distrito</h5>
                                <span class="description-text">
                                @if (!empty($recinto))
                                {{$recinto->distrito}}
                                @else
                                    Todos
                                @endif
                                </span>
                            </div>
                            <!-- /.description-block -->
                            <div class="description-block">

                                <h5 class="description-header">Recinto</h5>
                                <span class="description-text">
                                @if (!empty($recinto))
                                {{$recinto->nombre}}
                                @else
                                    Todos
                                @endif
                                </span>
                            </div>
                            <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div>
      </div>

</section>

</section>
@endsection
