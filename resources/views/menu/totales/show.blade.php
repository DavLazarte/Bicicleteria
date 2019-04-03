@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="proveedor">Fecha</label>
                <p>{{$total->fecha}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">            

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th>Negocio</th>
                            <th>Efectivo</th>
                            <th>Tarjeta</th>
                            <th>Subtotal</th>
                        </thead>
                        <tfoot>
                            <tr style="background-color:#c0c0c0">
                                <th  colspan="0"><p align="left">TOTALES</p></th>
                                <th  colspan="0"><p align="left">{{$total->total_efectivo}}</p></th>
                                <th  colspan="0"><p align="left">{{$total->total_tarjeta}}</p></th>
                                <th  colspan="0"><p align="left">{{$total->total_gral}}</p></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($detalles as $det)
                            <tr>
                                <td>{{$det->nombre}}</td>
                                <td>$/. {{$det->efectivo}}</td>
                                <td>$/. {{$det->tarjeta}}</td>
                                <td>$/. {{$det->sub_total}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                <div class="form-group">
                  <a href="{{url('reportotales',$total->id)}}" target="_blank"><button title="Reporte" class="btn btn-warning"><i class="fa fa-print" aria-hidden="true"></i></button></a>
                </div>
            </div>
    </div>   
@push ('scripts')
<script>
$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
</script>
@endpush
@endsection