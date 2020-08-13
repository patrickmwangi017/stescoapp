<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use Session;
use App\Cart;
use App\shipment;
use App\drivers;
// use Auth;

class driversController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:drivers');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $driver = Auth::user();
            $shipments = shipment::all();
            $shipments->transform(function($shipment, $key) {
                $shipment->cart = unserialize($shipment->cart);
                return $shipment;
            });
         
        return view('drivers/home', ['shipments' => $shipments], ['driver' => $driver]);
    }
    public function pending()
    {
            $driver = Auth::user();
            $shipments = shipment::all();
            $shipments->transform(function($shipment, $key) {
                $shipment->cart = unserialize($shipment->cart);
                return $shipment;
            });
         
        return view('drivers/pending', ['shipments' => $shipments], ['driver' => $driver]);
    }
    public function delivered()
    {
            $driver = Auth::user();
            $shipments = shipment::all();
            $shipments->transform(function($shipment, $key) {
                $shipment->cart = unserialize($shipment->cart);
                return $shipment;
            });
         
        return view('drivers/delivered', ['shipments' => $shipments], ['driver' => $driver]);
    }
    public function confirmed()
    {
            $driver = Auth::user();
            $shipments = shipment::all();
            $shipments->transform(function($shipment, $key) {
                $shipment->cart = unserialize($shipment->cart);
                return $shipment;
            });
         
        return view('drivers/confirmed', ['shipments' => $shipments], ['driver' => $driver]);
    }

    public function is_delivered(Request $request, $shipment_id)
    {

        $data=shipment::find($shipment_id);
            $data->deliverystatus="Delivered";
        
        // if ($data->status == 0){
        //     $data->status=1;
        // }else{
        //     $data->status=0;
        // }
        $data->save();
        $data1=drivers::where('id', $data->driver_id)
        ->update(['status' => "Free"]);


        return redirect()->back()->with('message', $data->Email. 'Status has been Approved successfully');
    }

    public function search (Request $request){
        $search = $request->get('search');
    $shipments = DB::table('shipments')->where('name', 'like', '%' .$search. '%')->paginate(5);

    return view('drivers/home', ['shipments'=>$shipments]);
    
    }

    // public function getLogout(Request $request){
    //     Auth::logout();
    //     return redirect()->route('drivers.login');
    // }

    public function getLogout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('drivers.login');
    }
    public function getProfile(){
        $user = Auth::user();
        return view('drivers.profile', ['user' => $user]); 
    }
    public function update_driver_info(Request $request, $user_id) {

        $this->validate($request, [
            'email'=>'Email',
            'phone'=>'min:10',
            'password' => 'string|min:4',

        ]);
        $data= drivers::find($user_id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->password= bcrypt($request->input('password'));

        $data->save();
        return redirect()->back()->with('message','User Information is updated Successfully');
                  }


}


