<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\payment;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\shipment;
use App\suppliers;
use App\drivers;
use Session;
use App\User;
use App\Cart;
use App\shipmentmanager;
use DB;
use Auth;
use PDF;

class shipmentmanagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:shipmentmanager');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = drivers::all();
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('shipmentmanager.home', ['shipments' => $shipments], ['drivers' => $drivers]);
    }

    public function pendingorders()
    {
        $drivers = drivers::all();
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('shipmentmanager.pendingorders', ['shipments' => $shipments], ['drivers' => $drivers]);
    }
    public function allocatedorders()
    {
        $drivers = drivers::all();
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('shipmentmanager.allocatedorders', ['shipments' => $shipments], ['drivers' => $drivers]);
    }
    public function allbookings()
    {
        $suppliers = suppliers::all();
        $shipments = shipment::all();
        $shipments->transform(function($shipment, $key) {
            $shipment->booking = unserialize($shipment->booking);
            return $shipment;
        });
        return view('shipmentmanager.allbookings', ['shipments' => $shipments], ['suppliers' => $suppliers]);
    }
    public function pendingbookings()
    {
        $suppliers = suppliers::all();
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->booking = unserialize($shipment->booking);
            return $shipment;
        });
        return view('shipmentmanager.pendingbookings', ['shipments' => $shipments], ['suppliers' => $suppliers]);
    }
    public function allocatedbookings()
    {
        $suppliers = suppliers::all();
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->booking = unserialize($shipment->booking);
            return $shipment;
        });
        return view('shipmentmanager.allocatedbookings', ['shipments' => $shipments], ['suppliers' => $suppliers]);
    }

    public function orderreports()
    {
        include(app_path() . '/fpdf.php');
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('accountants/orderreports', ['shipments' => $shipments]);
    }



    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('shipmentmanager.login');
    }

    
    public function getProfile(){
        $user = Auth::user();
        return view('shipmentmanager.profile', ['user' => $user]); 
    }
    public function update_shipmentmanager_info(Request $request, $user_id) {

        $this->validate($request, [
            'email'=>'Email',
            'phone'=>'min:10',
            'password' => 'string|min:4',

        ]);
        $data= shipmentmanager::find($user_id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->password= bcrypt($request->input('password'));

        $data->save();
        return redirect()->back()->with('message','User Information is updated Successfully');
    }
    public function is_allocated(Request $request,$shipment_id){
                    $data1=shipment::find($shipment_id);
                    if($request->cat!=-1)
                    $data1->driver_id=$request->cat;
                    if($request->cat!=-1)
                    $data1->allocation_status="Allocated";
                        
                        $data1->save();

                    $data=drivers::where('id', $data1->driver_id)
                    ->update(['status' => "On Duty"]);
                 return redirect()->back()->with('message', $data1->Email. 'Driver has been Allocated successfully');
    }
    public function is_masonallocated(Request $request,$shipment_id){
        $data1=shipment::find($shipment_id);
        if($request->cat!=-1)
        $data1->mason_id=$request->cat;
        if($request->cat!=-1)
        $data1->allocation_status="Allocated";
            
            $data1->save();

        $data=suppliers::where('id', $data1->mason_id)
        ->update(['status' => "On Duty"]);
     return redirect()->back()->with('message', $data1->Email. 'Mason has been Allocated successfully');
}
    public function is_saveallocated(Request $request,$shipment_id, $id){
                    $driver=shipment::find($id);
                    $data1=shipment::find($shipment_id);
                        $data1->allocation_status="Allocated";
                        $data1->driver_id=$driver->id;
                    $data1->save();
                    
                    return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
                    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Approved successfully');
                }
public function servicedeliveryreport()
    {
        $id=1;
        $drivers = drivers::all();
        $shipments = shipment::all();
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
            $pdf = PDF::loadView('shipmentmanager/servicedeliveryreport',compact(['shipments', 'drivers']));
        return $pdf->stream('Purchase_invoice_'.$id.'.pdf');
    }
    // public function pdf(Request $request, $id){
    //     $shipments = shipment::find($id);
    //     $cart=unserialize($shipments->cart);
    //     $pdf = PDF::loadView('user.orderreport',compact(['shipments', 'cart']));
    //     return $pdf->stream('Purchase_invoice_'.$id.'.pdf');
    // }

    public function shipmentreport()
    {
        $id=1;
        $drivers = drivers::all();
        $shipments = shipment::all();
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
            $pdf = PDF::loadView('shipmentmanager/shipmentreport',compact(['shipments', 'drivers']));
        return $pdf->stream('ShipmentReport_'.$id.'.pdf');
    }

    public function allocatedriver(Request $request) {
        $data = shipment::where('id',$row->id)
        ->update($data['driver_id'] = $request->cat);
        return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
    }


    public function save_supplyer_payment(Request $request ) {

        // {{ $driver['id'] }}
        $data = new Supplyerpayment();

        $data['amount'] = $request->data['newpaid'];
        $data['supplyersID'] = $request->data['supplyerID'];
        $data['paymentMethod'] = $request->data['paymentMethod'];
        $data['boxID'] = $request->data['ID'];
        if($data['remarks']!="")
        $data['remarks'] = $request->data['remarks'];

        $total_paid = $request->data['paid']+$data['amount'];

        $data->save();

        $supplyerB = Supplyer::find($data['supplyersID']);

        $supplyer = Supplyer::where('id', $data['supplyersID'])
            ->update(['paid' => $supplyerB->paid+ $data['amount']]);


        if($request->data['total']==$total_paid) {
            $dataStock = array();
            $dataStock['statusPaid'] = 0;

            StockPurchase::where('boxID',$data['boxID'])->update($dataStock);
        }
        else{
            $dataStock = array();
            $dataStock['statusPaid'] = -1;

            StockPurchase::where('boxID',$data['boxID'])->update($dataStock);
        }


    }
}
