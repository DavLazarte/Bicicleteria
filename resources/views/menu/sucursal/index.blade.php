@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Sucursales <a href="sucursal/create"><button class="btn btn-success">Nuevo</button></a>
        @include('menu.incidente.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
               @foreach ($sucursals as $suc)
                <tr>
                    <td>{{$suc->id}}</td>
                    <td>{{$suc->nombre}}</td>
                    <td>{{$suc->direccion}}</td>
                    <td>{{$suc->telefono}}</td>
                    <td>{{$suc->estado}}</td>
                    <td>
                        <a href="{{URL::action('SucursalController@edit',$suc->id)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$suc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                    </td>
                </tr>
                @include('menu.sucursal.modal')
                @endforeach
            </table>
        </div>
        {{$sucursals->render()}}
    </div>
</div>
@push ('scripts')
<script>
$('#liAlmacen').addClass("treeview active");
$('#liCategorias').addClass("active");
</script>
@endpush
@endsection