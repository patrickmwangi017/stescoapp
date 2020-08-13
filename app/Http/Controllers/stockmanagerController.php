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
use App\shipmentmanager;
use App\stockmanager;
use DB;
use Auth;


class stockmanagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:stockmanager');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::all();
       
        return view('stockmanager.home', ['products' => $products]);
    }
    public function published()
    {
        
        $products = Product::all();
       
        return view('stockmanager.published', ['products' => $products]);
    }

    public function archived()
    {
        
        $products = Product::all();
       
        return view('stockmanager.archived', ['products' => $products]);
    }

public function getProfile(){
        $user = Auth::user();
        return view('stockmanager.profile', ['user' => $user]); 
    }
    public function update_stockmanager_info(Request $request, $user_id) {

        $this->validate($request, [
            'email'=>'Email',
            'phone'=>'min:10',
            'password' => 'string|min:4',

        ]);
        $data= stockmanager::find($user_id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->password= bcrypt($request->input('password'));

        $data->save();
                  return Redirect::back()->with('message','Profile Updated successfully');
    }

    public function is_prodedit(Request $request, $id)
{
    $products =Product::find($id);      
    return view('stockmanager.prodedit', ['products' => $products]);

}
public function getLogout(Request $request){
    Auth::logout();
    $request->session()->flush();
    return redirect()->route('stockmanager.login');
}

}