<?php

namespace App\Http\Controllers;
use App\User;
use App\Cart;
use App\Booking;
use App\payment;
use App\feedback;
use App\servicedelivery;
use App\shipment;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Auth;
use Session;
use DB;


class UserController extends Controller
{

    public function help(){
        return view('user.help');
    }
    public function getSignup(){
        return view('user.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request, [
            'Email'=>'Email|required|unique:users',
            'name'=>'required|unique:users',
            'town'=>'required',
            'postaladdress'=>'required',
            'phone'=>'required|min:10|unique:users',
            'password' => 'required|string|min:4|confirmed',

        ]);
        $user = new User([
            'Email'=> $request->input('Email'),
            'name'=> $request->input('name'),
            'town'=> $request->input('town'),
            'postaladdress'=> $request->input('postaladdress'),
            'phone'=> $request->input('phone'),
            'password'=> bcrypt($request->input('password')),
        ]);
        $user->save();

        // Auth::login($user);

        // if (Session::has('oldUrl')) {
        //     $oldUrl = Session::get('oldUrl');
        //     Session::forget('oldUrl');
        //     return redirect()->to($oldUrl);
        // }


        return redirect()->route('user.signin'); 

    }

    public function getSignin(){
        return view('user.signin');
    }
    public function postSignin(Request $request){
        $this->validate($request, [
        'Email' => 'Email|required',
            'password' => 'required|min:4'
        ]);
        if(Auth::attempt(['Email' => $request->input('Email'), 'password' => $request->input('password'), 'is_user'=>'Approved'])){
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            // return redirect()->route('user.profile'); 
            }
         
            return redirect()->back();
        
    }
    

    public function getProfile(){
        $user = Auth::user();
        return view('user.profile', ['user' => $user]); 
    }

    public function getOrders(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('user.pendingorders', ['shipments' => $shipments]);
        
    }
    public function getApprovedOrders(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('user.approvedorders', ['shipments' => $shipments]);
        
    }
    public function getDeliveredOrders(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($shipment, $key) {
            $shipment->cart = unserialize($shipment->cart);
            return $shipment;
        });
        return view('user.deliveredorders', ['shipments' => $shipments]);
        
    }
    public function getpendingservicesbooked(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($service, $key) {
            $service->booking = unserialize($service->booking);
            return $service;
        });
        return view('user/pendingservicesbooked', ['shipments' => $shipments]);
        
    }
    public function getapprovedservicesbooked(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($service, $key) {
            $service->booking = unserialize($service->booking);
            return $service;
        });
        return view('user/approvedservicesbooked', ['shipments' => $shipments]);
        
    }
    public function getdeliveredservicesbooked(){

        $shipments = Auth::user()->shipment;
        $shipments->transform(function($service, $key) {
            $service->booking = unserialize($service->booking);
            return $service;
        });
        return view('user/deliveredservicesbooked', ['shipments' => $shipments]);
        
    }


    // $payments = Auth::user()->payments;
    //     $payments->transform(function($payment, $key) {
    //         $payment->cart = unserialize($payment->cart);
    //         return $payment;
    //     });
    //     return view('user.profile', ['orders' => $payments]);
    // }

   
    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->forget('cart');
        Session::forget('oldUrl');
        $request->session()->flush();
        return redirect()->route('user.signin');
    }


    public function getFeedback() {

    $feedback=  Auth::user()->feedback;
        return view('user.feedback', ['feedback' => $feedback]);
    
    }
    public function inbox(Request $request, $feedback_id)
    {
            $feedback = feedback::find($feedback_id);
         
        return view('user/inbox', ['feedback' => $feedback]);
    }
    public function farchive(Request $request, $feedback_id)
    {
            $feedback = feedback::find($feedback_id);
            $feedback->userstatus="Archived";
            $feedback->save();
         
            return redirect()->back()->with('message','feedback Archived successfully');
    }
    public function postFeedback(Request $request){
        $user = Auth::user();
        $feedback = new feedback();
        $feedback->feedbackMessage = $request->input('feedbackMessage');
        $feedback->telephone = $user->phone;
        $feedback->Email = $user->Email;
        $feedback->name = $user->name;
        Auth::user()->feedback()->save($feedback);
        return redirect()->route('product.index')->with('success', 'Successfully submitted feedback'); 
    
    
    }
    public function update_user_info(Request $request, $user_id) {

        $this->validate($request, [
            'Email'=>'Email',
            'phone'=>'min:10|max:10',
            'password' => 'string|min:4',

        ]);
        $data= User::find($user_id);
        $data->name = $request->input('name');
        $data->Email = $request->input('Email');
        $data->town = $request->input('town');
        $data->postaladdress = $request->input('postaladdress');
        $data->phone = $request->input('phone');
        $data->password = bcrypt($request->input('password'));
        $data->save();
        return redirect()->back()->with('message','User Information is updated Successfully');
                  }


                  public function pendingpayments()
                  {
                      
                    $shipments = Auth::user()->shipment;
                      $shipments->transform(function($shipment, $key) {
                          $shipment->cart = unserialize($shipment->cart);
                          return $shipment;
                      });
                      return view('user/pending', ['shipments' => $shipments]);
                  }
                  public function approvedpayments()
                  {
                      
                    $shipments = Auth::user()->shipment;
                      $shipments->transform(function($shipment, $key) {
                          $shipment->cart = unserialize($shipment->cart);
                          return $shipment;
                      });
                      return view('user/approved', ['shipments' => $shipments]);
                  }
                  public function rejectedpayments()
                  {
                      
                    $shipments = Auth::user()->shipment;
                      $shipments->transform(function($shipment, $key) {
                          $shipment->cart = unserialize($shipment->cart);
                          return $shipment;
                      });
                      return view('user/rejected', ['shipments' => $shipments]);
                  }
public function is_confirmdelivered(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->receivestatus="Received";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Approved successfully');
}
}
