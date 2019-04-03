@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Cierres<a href="recaudacion/create"><button class="btn btn-success">Nuevo</button></a> </h3>
        @include('menu.totales.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Total Efectivo</th>
                    <th>Total Tarjeta</th>
                    <th>Total General</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
               @foreach ($totals as $tot)
                <tr>
                    <td>{{ Carbon\Carbon::parse($tot->fecha)->format('d-m-Y')}}</td>
                    <td>{{ $tot->total_efectivo}}</td>
                    <td>{{ $tot->total_tarjeta}}</td>
                    <td>{{ $tot->total_gral}}</td>
                    <td>{{ $tot->estado}}</td>
                    <td>
                        <a href="{{URL::action('TotalController@show',$tot->id)}}"><button class="btn btn-primary">Detalles</button></a>
                        {{-- <a href="{{URL::action('TotalController@edit',$tot->id)}}"><button class="btn btn-success">Actualizar</button></a> --}}
                        <a href="" data-target="#modal-delete-{{$tot->id}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
                    </td>
                </tr>

                @include('menu.totales.modal')
                @endforeach
            </table>
        </div>
        {{$totals->render()}}
    </div>
</div>
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush

@endsection