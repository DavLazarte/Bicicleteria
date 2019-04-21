<?php

namespace adm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use adm\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use adm\DetalleTotal;
use adm\Total;
use adm\Sucursal;
use DB;
use Response;
use Illuminate\Support\Collection;
use Fpdf;

class TotalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request)
        {
           $searchText=trim($request->get('searchText'));
           $totals=DB::table('totals')
            ->where('fecha','LIKE','%'.$searchText.'%')
            ->where('estado','=','Activo')
            ->orderBy('id','desc')
            ->paginate(10);
            return view('menu.totales.index', compact('searchText', 'totals'));

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales=DB::table('sucursals')->where('estado','=','Activa')->get();
    
        return view("menu.totales.create",compact('sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         try{
            DB::beginTransaction();
            $total=new Total;
            $total->total_efectivo=$request->get('total_efectivo');
            $total->total_tarjeta=$request->get('total_tarjeta');
            $total->total_gral=$request->get('total_gral');
            $total->fecha=$request->get('fecha');
            $total->estado=$request->get('estado');
            $total->save();
            
            $negocio = $request->get('negocio');
            $efectivo = $request->get('efectivo');
            $tarjeta = $request->get('tarjeta');
            $sub_total = $request->get('sub_total');
            
             $cont = 0;
            
            while($cont < count($negocio)){
                $detalle = new DetalleTotal();
                $detalle->idtotal= $total->id; 
                $detalle->negocio= $negocio[$cont];
                $detalle->efectivo= $efectivo[$cont];
                $detalle->tarjeta= $tarjeta[$cont];
                $detalle->sub_total= $sub_total[$cont];
                $detalle->save();
                $cont=$cont+1;
            }

             DB::commit();

         }catch(\Exception $e)
         {
               DB::rollback();
         }

        return Redirect::to('menu/recaudacion');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total=DB::table('totals')
            ->where('id','=',$id)
            ->first();

        $detalles=DB::table('detalle_totals as dt')
             ->join('sucursals as s','dt.negocio','=','s.id')
             ->select('s.nombre','dt.efectivo','dt.tarjeta','dt.sub_total')
             ->where('dt.idtotal','=',$id)
             ->get();
        return view("menu.totales.show",compact('total','detalles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $total=Total::findOrFail($id);
        $total->estado='Cancelada';
        $total->update();
        return Redirect::to('menu/recaudacion');
    }
    public function vistatotales(Request $request)
    {
        if ($request)
        {
            $local  = Sucursal::where('estado','=','Activa')->get();
            $fecha  = trim($request->get('fecha'));
            // $tipo   = trim($request->get('tipo'));
            $nego   = trim($request->get('nego'));
            $totals=DB::table('totals as t')
            ->join('detalle_totals as dt', 'dt.idtotal','=', 't.id')
            ->join('sucursals as s', 's.id','=', 'dt.negocio')
            ->select('dt.id','dt.idtotal','dt.negocio','dt.efectivo','dt.tarjeta','dt.sub_total','s.nombre','t.fecha')
            ->orwhere('t.fecha','=', $fecha )
            ->where('dt.negocio','=', $nego )
            ->where('t.estado','=','Activo')
            ->get();
            return view('menu.movimiento.totales',compact('local','totals','fecha','nego'));
        }
    }
    public function reportec($id){
        //Obtengo los datos
        $total=DB::table('totals')
        ->where('id','=',$id)
        ->first();

        $detalles=DB::table('detalle_totals as dt')
             ->join('sucursals as s','dt.negocio','=','s.id')
             ->select('s.nombre','dt.efectivo','dt.tarjeta','dt.sub_total')
             ->where('dt.idtotal','=',$id)
             ->get();


       $pdf = new Fpdf();
       $pdf::AddPage();
       $pdf::SetFont('Arial','B',14);
    //    $pdf::Image('..\public\img\logo.jpeg',5,5,60);
       //Inicio con el reporte
       $pdf::SetXY(15,10);
       $pdf::Cell(0,0,utf8_decode('Reporte de Totales'));

       $pdf::SetFont('Arial','B',14);
       //Inicio con el reporte
       $pdf::SetXY(15,20);
       $pdf::Cell(0,0,utf8_decode("Nº:".$total->id));

       $pdf::SetFont('Arial','B',10);
    //    $pdf::SetXY(35,60);
    //    $pdf::Cell(0,0,utf8_decode("Cliente:".$venta->nombre));
       $pdf::SetXY(15,30);
       $pdf::Cell(0,0,substr("Fecha:".$total->fecha,0,16));
    //    $total=0;
    //    $pdf::SetXY(180,69);
       $pdf::setXY(10,35);
       $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
       $pdf::SetFillColor(206, 246, 244); // establece el color del fondo de la celda 
       $pdf::SetFont('Arial','B',13);
       $pdf::cell(60,8,utf8_decode("Negocio"),1,"","L",true);
       $pdf::cell(40,8,utf8_decode("Efectivo"),1,"","L",true);
       $pdf::cell(40,8,utf8_decode("Tarjeta"),1,"","L",true);
       $pdf::cell(40,8,utf8_decode("Subtotal"),1,"","L",true);
       //Mostramos los detalles
       $y=50;
       foreach($detalles as $det){
           $pdf::SetXY(10,$y);
           $pdf::MultiCell(120,0,utf8_decode($det->nombre));
           $pdf::SetXY(70,$y);
           $pdf::MultiCell(25,0,$det->efectivo);
           $pdf::SetXY(110,$y);
           $pdf::MultiCell(25,0,$det->tarjeta);
           $pdf::SetXY(150,$y);
           $pdf::MultiCell(25,0,sprintf("%0.2F",($det->sub_total)));
           $y=$y+7;
       }
       $pdf::setXY(10,$y);
       $pdf::SetFillColor(206, 246, 244); // establece el color del fondo de la celda 
       $pdf::cell(60,8,utf8_decode("Totales"),1,"","L",true);
       $pdf::cell(40,8,utf8_decode($total->total_efectivo),1,"","L",true);
       $pdf::cell(40,8,utf8_decode($total->total_tarjeta),1,"","L",true);
       $pdf::cell(40,8,utf8_decode($total->total_gral),1,"","L",true);
       $pdf::Output();
       exit;
   }
   public function reportlo($nego, $fecha){
    //Obtenemos los registros
    $registros=DB::table('totals as t')
    ->join('detalle_totals as dt', 'dt.idtotal','=', 't.id')
    ->join('sucursals as s', 's.id','=', 'dt.negocio')
    ->select('dt.id','dt.idtotal','dt.negocio','dt.efectivo','dt.tarjeta','dt.sub_total','s.nombre','t.fecha','dt.negocio','t.estado')
    ->where('t.fecha','=', $fecha )
    ->orwhere('dt.negocio','=', $nego )
    ->where('t.estado','=','Activo')
    ->get();

    $pdf = new Fpdf();
    $pdf::AddPage();
    $pdf::SetTextColor(35,56,113);
    $pdf::SetFont('Arial','B',11);
    $pdf::Cell(0,10,utf8_decode("Totales : ".$fecha),0,"","C");
    $pdf::Ln();
    $pdf::Ln();
    $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
    $pdf::SetFillColor(206, 246, 245); // establece el color del fondo de la celda 
    $pdf::SetFont('Arial','B',14); 
    //El ancho de las columnas debe de sumar promedio 190

    // $pdf::cell(25,8,utf8_decode("Fecha"),1,"","L",true);
    $pdf::cell(50,8,utf8_decode("Local"),1,"","L",true);
    $pdf::cell(40,8,utf8_decode("Efectivo"),1,"","L",true);
    $pdf::cell(40,8,utf8_decode("Tarjeta"),1,"","L",true);
    $pdf::cell(40,8,utf8_decode("Subtotal"),1,"","L",true);
    
    $pdf::Ln();
    $pdf::SetTextColor(0,0,0);  // Establece el color del texto 
    $pdf::SetFillColor(255, 255, 255); // establece el color del fondo de la celda
    $pdf::SetFont("Arial","",14);
    
    foreach ($registros as $reg)
    {
       $pdf::cell(50,6,utf8_decode($reg->negocio.'-'.$reg->nombre),1,"","L",true);
       $pdf::cell(40,6,utf8_decode($reg->efectivo),1,"","L",true);
       $pdf::cell(40,6,utf8_decode($reg->tarjeta),1,"","L",true);
       $pdf::cell(40,6,utf8_decode($reg->sub_total),1,"","L",true);
       $pdf::Ln(); 
    }
    $pdf::Output();
    exit;
 }
}
