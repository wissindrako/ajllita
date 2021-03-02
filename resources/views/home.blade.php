@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			{{-- <div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Bienvenid@</div>

					<div class="panel-body">
						{{ trans('adminlte_lang::message.logged') }}
						{{$personas}}
					</div>
				</div>
			</div> --}}

			<div style="text-align:center">

				<h2><b>Elecciones Subnacionales 2021</b></h2>
				<br>
				{{-- <h3><b>Administración </b></h3> --}}
				<img src="{{asset('img/logo_principal.png')}}" style="width:312px;height:100%;" class="resonsive"/>
			</div>
		</div>
	</div>
@endsection
