<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class DynamicPDFController extends Controller{
 
    function index(){
        $shipments = $this->get_shipment_data();
        return view('dynamic_pdf')->with('shipments', $shipments);
    }

    function get_shipment_data(){
        $shipment = DB::table('shipments')
                    ->get();
                    return $shipment;
    }
    function pdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_shipment_to_html());
        $pdf->stream();
    }
    function convert_shipment_to_html(){
        $shipments = $this->get_shipment_data();
        $output = '
         <h3 align="center">Shipment data</h3>
         <table width="100%" style="border-collapse:collapse; border: 0px;">
         <tr>
         <th style= "border: 1px solid; padding: 12px;" width= "20%" >Name</th>
         <th style= "border: 1px solid; padding: 12px;" width= "20%" >Name</th>
         <th style= "border: 1px solid; padding: 12px;" width= "20%" >Name</th>
         <th style= "border: 1px solid; padding: 12px;" width= "20%" >Name</th>
         </tr>

        ';

        foreach($shipment_data as $shipment){
            $output = '
            <tr>
            <td style= "border: 1px solid; padding: 12px;">'.$shipment->Name.'</td>
            </tr>
             ';
           }
           $output = '</table>';
           return $output; 
       

    }
}