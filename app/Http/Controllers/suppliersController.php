<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\servicedelivery;
use Auth;
use App\suppliers;
use App\supply;
use App\shipment;

class suppliersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:suppliers');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Auth::user();
            $supplies = supply::all();
            // $shipments->transform(function($shipment, $key) {
            //     $shipment->booking = unserialize($shipment->booking);
            //     return $shipment;
            // });
         
        return view('suppliers/home', ['supplies' => $supplies], ['supplier' => $supplier]);
    }
    public function pending()
    {
        $supplier = Auth::user();
            $supplies = supply::all();
            // $shipments->transform(function($shipment, $key) {
            //     $shipment->booking = unserialize($shipment->booking);
            //     return $shipment;
            // });
         
        return view('suppliers/pending', ['supplies' => $supplies], ['supplier' => $supplier]);
    }
    public function accepted()
    {
        $supplier = Auth::user();
        $supplies = supply::all();
        // $shipments->transform(function($shipment, $key) {
        //     $shipment->booking = unserialize($shipment->booking);
        //     return $shipment;
        // });
     
    return view('suppliers/accepted', ['supplies' => $supplies], ['supplier' => $supplier]);
    }
    public function confirmed()
    {
        $supplier = Auth::user();
            $supplies = supply::all();
            // $shipments->transform(function($shipment, $key) {
            //     $shipment->booking = unserialize($shipment->booking);
            //     return $shipment;
            // });
         
        return view('suppliers/confirmed', ['supplies' => $supplies], ['supplier' => $supplier]);
    }
    public function is_rejected(Request $request, $supply_id)
    {
        $data=supply::find($supply_id);
            $data->request_status="Rejected";
        // if ($data->status == 0){
        //     $data->status=1;
        // }else{
        //     $data->status=0;
        // }
        $data->save();


        return redirect()->back()->with('message', 'Request has been Rejected successfully');
    }

    

    public function is_accepted(Request $request, $supply_id)
    {

        $data=supply::find($supply_id);
            $data->request_status="Accepted";
        // if ($data->status == 0){
        //     $data->status=1;
        // }else{
        //     $data->status=0;
        // }
        $data->save();


        return redirect()->back()->with('message', 'Request has been Accepted successfully');
    }

    public function is_supplied(Request $request, $supply_id)
    {
        $data=supply::find($supply_id);
            $data->supply_status="Done";
        // if ($data->status == 0){
        //     $data->status=1;
        // }else{
        //     $data->status=0;
        // }
        $data->save();


        return redirect()->back()->with('message', 'Supply Done successfully');
    }

    public function search (Request $request){
        $search = $request->get('search');
    $services = DB::table('servicedeliveries')->where('name', 'like', '%' .$search. '%')->paginate(5);

    return view('suppliers/home', ['services'=>$services]);
    
    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('suppliers.login');
    }
    public function getProfile(){
        $user = Auth::user();
        return view('suppliers.profile', ['user' => $user]); 
    }
    public function update_supplier_info(Request $request, $user_id) {

        $this->validate($request, [
            'email'=>'Email',
            'phone'=>'min:10',
            'password' => 'string|min:4',

        ]);
        $data= suppliers::find($user_id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->password= bcrypt($request->input('password'));

        $data->save();
        return redirect()->back()->with('message','User Information is updated Successfully');
                  }
}
