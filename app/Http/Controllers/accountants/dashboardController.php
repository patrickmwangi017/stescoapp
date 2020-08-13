<?php


namespace App\Http\Controllers;
use App\payment;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Order;
use Session;

use App\User;
use App\Cart;
use DB;

class dashboardController extends Controller
{

    public function registered()
    {
        $users = payment::all();
        // $users = DB::table('users')->get();
        return view('accountants.registered')->with('users', $users);
    }
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


        return Redirect::to('registered')->with('message', $data->Email. 'Status has been Approved successfully');
    }
    public function is_user1(Request $request, $payment_id)
    {
        $data=payment::find($payment_id);
            $data->status=2;
        return Redirect::to('registered')->with('message', $data->Email. 'Status has been Rejected successfully');
    }

}
