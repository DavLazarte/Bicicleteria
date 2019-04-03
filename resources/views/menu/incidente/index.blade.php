@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Incidentes <a href="incidente/create"><button class="btn btn-success">Nuevo</button></a>
		@include('menu.incidente.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Tipo</th>
					<th>Descripción</th>
					<th>Impacto</th>
					<th>Area</th>
					<th>Tecnico</th>
				</thead>
               @foreach ($incidentes as $inc)
				<tr>
					<td>{{ $inc->id}}</td>
					<td>{{ $inc->tipo}}</td>
					<td>{{ $inc->descripcion}}</td>
					<td>{{ $inc->impacto}}</td>
					<td>{{ $inc->area}}</td>
					<td>{{ $inc->tecnico}}</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$incidentes->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liCategorias').addClass("active");
</script>
@endpush
@endsection