@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
{{-- 
	<div style='overflow-x:scroll;overflow-y:hidden;'>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Charts</b></div>
					<div class="panel-body">
						<canvas id="canvas" height="280" width="800"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

	{{-- INICIO CIRCUNSCRIPCION 8 --}}
	<div class="box box-primary">
		<a href="javascript:void(0);" onclick="refrescar_votos();">
			<div class="box-header with-border" style="background-color:#038fe1; text-align:center">
                <h3 class="box-title" style="color:white">Conteo General de Votos (Uninominal) al {{  round(($votos_validos->validos*100)/$total_votos, 2) }} %</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool bg-black"><i class="fa fa-refresh text-green" id="btn_refresh"></i></button>
			</div>
			</div>
		</a>
		<div class="box-body" style="">
			<br>
		  <div class="chart" id="chart">
		  </div>
		</div>
	</div>
	{{-- FIN CIRCUNSCRIPCION 8 --}}


</section>
@endsection


@section('scripts')

@parent

<script>
function activar_uninominales() {
	// alertify.success('hola');
	var url = "{{url('data_uninominales_general')}}";
	var Partidos = new Array();
	var Labels = new Array();
	var Votos = new Array();
	var Porcentaje = new Array();
	var Fill = new Array();
	var BorderColor = new Array();
	$.get(url, function(response){
		console.log(url);
	response.forEach(function(data){
		Partidos.push(data.sigla);
		Labels.push(data.id_partido);
		Votos.push(data.valor);
		Porcentaje.push(data.porcentaje);
		Fill.push(data.fill);
		BorderColor.push(data.borderColor);
	});
	var chartData = {
		labels:Partidos,
        datasets: [
            {
				label: 'Votos',
				data: Votos,
				porcentaje: Porcentaje,
				datalabels: {
					align: 'end',
					anchor: 'start'
				},
				borderWidth: 1,
				fill:false,
				backgroundColor:Fill,
				borderColor:BorderColor,
				borderWidth:1
            }
        ]
    };
	var opciones = {

		scales: {
			xAxes: [{
				ticks: {
					fontSize: 15,
					fontStyle: 'bold'
				}
			}],
			yAxes: [{
				ticks: {
					beginAtZero:true,
					fontSize: 15
				}
			}]
		},
		legend: {
			display: false // Ocultando el titulo del centro
		},

		// events: true,
		// tooltips: {
		// 	enabled: true
		// },
		hover: {
			animationDuration: 0
		},
		animation: {
			duration: 1,
			onComplete: function () {
				var chartInstance = this.chart,
					ctx = chartInstance.ctx;
				// ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
				ctx.font = Chart.helpers.fontString(12, 'bold', Chart.defaults.global.defaultFontFamily);
				ctx.textAlign = 'center';
				ctx.textBaseline = 'bottom';

				this.data.datasets.forEach(function (dataset, i) {
					var meta = chartInstance.controller.getDatasetMeta(i);
					meta.data.forEach(function (bar, index) {
						var data = dataset.data[index];    
						var porcentaje = dataset.porcentaje[index];                         
						ctx.fillText(porcentaje+' %', bar._model.x, bar._model.y +20);
					});
				});
			}
		}
	};

	$('#canvas').remove();
	$('#chart').append('<canvas id="canvas" height="240" width="754"><canvas>');

	var ctx = document.getElementById("canvas"),
		myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: opciones
     });

	});
}

activar_uninominales();


window.setInterval(function(){
	location.reload();
}, 60000);

function refrescar_votos(){
	location.reload();
}

</script>

@endsection


