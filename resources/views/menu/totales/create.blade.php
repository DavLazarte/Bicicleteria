@extends ('layouts.admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Nuevo Cierre</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
        {!!Form::open(array('url'=>'menu/recaudacion','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <div class="form-group">
                        <label>Negocio</label>
                        <select name="pidsucursal" class="form-control selectpicker" id="pidsucursal" data-live-search="true">
                            @foreach($sucursales as $suc)
                            <option value="{{$suc->id}}_{{$suc->nombre}}">{{$suc->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="efectivo">Efectivo</label>
                        <input type="number" name="pefectivo" id="pefectivo" class="form-control" 
                        placeholder="Monto Efectivo">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="tarjeta">Tarjetas</label>
                        <input type="number"  name="ptarjeta" id="ptarjeta" class="form-control" 
                        placeholder="Monto Tarjetas">
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date"  name="fecha" id="pfecha" class="form-control" >
                    </div>
                </div>
                {{-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for="sub_total">Sub-Total</label>
                        <input type="number" name="psubtotal" id="psubtotal" class="form-control" value="0">
                    </div>
                </div>  --}}
                
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    <div class="form-group">
                        <label for=""></label>
                       <button type="button" id="bt_add" class="btn btn-primary" class="form-control">Agregar</button>
                    </div>
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="table-responsive">

                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Negocio</th>
                                    <th>Efectivo</th>
                                    <th>Tarjeta</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th  colspan="0"><p align="left">TOTALES</p></th>
                                        <th></th>
                                        <th><p align="left"><span id="total_efectivo">$/.</span> <input type="hidden" name="total_efectivo" id="tefectivo"></p></th>
                                        {{-- <th colspan="0"><p align="left">TOTAL TARJETAS:</p></th> --}}
                                        <th><p align="left"><span id="total_tarjeta">$/. </span></p><input type="hidden" name="total_tarjeta" id="ttarjeta"></th>
                                        {{-- <th  colspan="0"><p align="left">TOTAL GENERAL:</p></th> --}}
                                        <th><p align="left"><span align="right" id="total_gral">$/. </span><input type="hidden" name="total_gral" id="tgral"></p></th>
                                    </tr>
                                    <input type="hidden" name="estado" value="Activo">
                                </tfoot>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                 </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
        <div class="form-group">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"></input>
            <button class="btn btn-primary" id="save"type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>  
{!!Form::close()!!}

@push ('scripts')
<script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });
  $("#guardar").hide();
  var cont=0;
      total=0;
      tefectivo=0;
      ttarjeta=0;
      subtotal=[];
      subefectivo=[];
      subtarjeta=[];

  function agregar()
  {
    datosSucursal=document.getElementById('pidsucursal').value.split('_');
    idsucursal=datosSucursal[0];
    sucursal = $("#pidsucursal option:selected").text();
    efectivo = $("#pefectivo").val();
    tarjeta  = $("#ptarjeta").val();

    // // if (idsucursal!="" && efectivo!="" && tarjeta!="")
    // {
        subtotal[cont]=(parseFloat(efectivo)+ parseFloat(tarjeta));
        subefectivo[cont]=parseFloat(efectivo);
        subtarjeta[cont]=parseFloat(tarjeta);
        total=total+subtotal[cont];
        tefectivo= tefectivo+subefectivo[cont];
        ttarjeta= ttarjeta+subtarjeta[cont];
        var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="negocio[]" value="'+idsucursal+'">'+sucursal+'</td><td><input type="number" name="efectivo[]" value="'+parseFloat(efectivo).toFixed(2)+'"></td><td><input type="number" name="tarjeta[]" value="'+parseFloat(tarjeta).toFixed(2)+'"></td><td><input type="number" name="sub_total[]" value="'+parseFloat(subtotal[cont]).toFixed(2)+'"></td></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);   
    // }
    // else
    // {
    //     alert("Error al ingresar el detalle de la venta, revise los datos del artículo");
    // }
    
  }
  function limpiar(){
    $("#pefectivo").val("");
    $("#ptarjeta").val("");
  }
  function totales()
  {
        $("#total_gral").html("$/. " + total.toFixed(2));
        $("#total_efectivo").html("$/. " + tefectivo.toFixed(2));
        $("#total_tarjeta").html("$/. " + ttarjeta.toFixed(2));        
        $("#tgral").val(+ total.toFixed(2));
        $("#ttarjeta").val(+ ttarjeta.toFixed(2));        
        $("#tefectivo").val(+ tefectivo.toFixed(2));
  }
  function evaluar()
  {
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }

   function eliminar(index){
    total=total-subtotal[index]; 
    tefectivo= tefectivo-subefectivo[index];
    ttarjeta= ttarjeta-subtarjeta[index];
    totales();  
    $("#fila" + index).remove();
    evaluar();

  }

$('#liVentas').addClass("treeview active");
$('#liVentass').addClass("active");
  
</script>
@endpush
@endsection