<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\payment;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\shipment;
use Session;
use App\User;
use App\Cart;
use App\Product;
use App\Boooking;
use App\accountants;
use DB;
use Auth;
use PDF;

class accountantsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:accountants');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });

        return view('accountants.home', ['shipments' => $shipments]);
    }
    
    public function pending()
    {
        
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            $shipment->booking = unserialize($shipment->booking);
            return $shipment;
        });
        // $shipments->transform(function($shipment, $key) {
        //     $shipment->booking = unserialize($shipment->booking);
        //     return $shipment;
        // });
        return view('accountants/pending', ['shipments' => $shipments]);
    }

    // public function paymentreport()
    // {
    //     include(app_path() . '/fpdf.php');
    //     $shipments = shipment::all();
    //     $shipments->transform(function($shipment, $key) {
    //         $shipment->cart = unserialize($shipment->cart);
    //         return $shipment;
            
    //     });
    //     return view('accountants/paymentreport', ['shipments' => $shipments]);
    // }

    public function paymentreport()
    {
        $id=1;
        $shipments = shipment::all();
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
            $pdf = PDF::loadView('accountants/paymentreport',compact(['shipments']));
        return $pdf->stream('PaymentReport_'.$id.'.pdf');
    }

    public function approved()
    {
        
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('accountants/approved', ['shipments' => $shipments]);
    }
    public function rejected()
    {
        
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('accountants/rejected', ['shipments' => $shipments]);
    }

    public function refunded()
    {
        
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('accountants/refunded', ['shipments' => $shipments]);
    }
    public function archived()
    {
        
        $shipments = shipment::all();
        // $orders = Auth::user()->orders;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('accountants/archived', ['shipments' => $shipments]);
    }
    // public function registered()
    // {
    //     $users = payment::all();
    //     // $users = DB::table('users')->get();
    //     return view('accountants.registered')->with('users', $users);
    // }
    public function is_user(Request $request, $payment_id)
    {
        $data=payment::find($payment_id);
            $data->status=1;
        
        // if ($data->status == 0){
        //     $data->status=1;
        // }else{
        //     $data->status=0;
        // }

        // if ($data->status == 0){
        //     $data->status=1;

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);
            $total = $cart->totalPrice;
        
            $order = new order();
            $order->cart = serialize($cart);
            $order->id = $payment_id;
            Auth::user()->orders()->save($order);
        // }else{
        //     echo('Payment already exists');
        // }
       
    // $payment->mpesa_code = $request->input('mpesa_code');
    // $payment->name = $request->input('name');
    


        $data->save();


        return Redirect::to('accountants.home')->with('message', $data->Email. 'Status has been Approved successfully');
    }
    public function is_user1(Request $request, $payment_id)
    {
        $data=payment::find($payment_id);
            $data->status=2;
        return Redirect::to('accountants.home')->with('message', $data->Email. 'Status has been Rejected successfully');
    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('accountants.login');
    }

    // public function search (Request $request){
    //     $search = $request->get('search');
    // $shipments = DB::table('shipments')->where('name', 'like', '%' .$search. '%')->paginate(5);

    // return view('accountants/home', ['shipments'=>$shipments]);
    
    // }
    public function getProfile(){
        $user = Auth::user();
        return view('accountants.profile', ['user' => $user]); 
    }
    public function update_accountant_info(Request $request, $user_id) {

        $this->validate($request, [
            'email'=>'Email',
            'phone'=>'min:10',
            'password' => 'string|min:4',

        ]);
        $data= accountants::find($user_id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->password= bcrypt($request->input('password'));

        $data->save();
                  return redirect()->back()->with('message','User Information is updated Successfully');
                  }

             

}
