<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Http\Controllers\Controller;
use App\Cart;
use App\Product;
use App\services;
use App\Order;
use App\shipment;
use App\stockmanager;
use App\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\HTTP\Requests;
use Session;
use Auth;
use DB;
use App\User;
use mpesa;
use checkout;
use invoice;
use PDF;
use App\StockPurchase;
use App\Supplyerpayment;






class productsController extends Controller
{


    // public function getPayment(){
    //     return view('shop.InsertPayment');
    // }
   public function getIndex(){
       $products= Product::all();
       return view('shop.index',['products'=>$products]);


      
    //    ->with(['products'=>$products])
    // ['products'=>$products]
    // compact('products')
   }
   

   public function getAddToCart(Request $request, $id){
       $product = Product::find($id);
       $oldCart = Session::has('cart') ? Session::get('cart') : null;
       $cart = new Cart($oldCart);
       $cart->add($product, $product->id);
    //    delete $cart = new Cart($oldCart); from ProductControler.php and change $Cart to $oldCart

       $request->session()->put('cart', $cart);
      
    //    dd($request->session()->get('cart'));
      return redirect()->route('product.index');
     
   }

   public function getAddoneToCart(Request $request, $id){
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->addone($product, $product->id);
 //    delete $cart = new Cart($oldCart); from ProductControler.php and change $Cart to $oldCart

    $request->session()->put('cart', $cart);
   
 //    dd($request->session()->get('cart'));
 return Redirect::back();
  
}
   public function getupdateCart(Request $request,  $id){
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->reduce($product, $product->id);
 //    delete $cart = new Cart($oldCart); from ProductControler.php and change $Cart to $oldCart

    $request->session()->put('cart', $cart);
   
 //    dd($request->session()->get('cart'));
//    return redirect()->route('shop.shopping-cart');
return Redirect::back();
// return view('shop.shopping-cart', ['products'=>$cart->items, 'totalPrice' =>$cart->totalPrice, 'totalQty' =>$cart->totalQty]);
  
}

public function getremoveCart(Request $request,  $id){
    $product = Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $cart->reduce($product, $product->id)*$product['qty'];
 //    delete $cart = new Cart($oldCart); from ProductControler.php and change $Cart to $oldCart

    $request->session()->put('cart', $cart);
   
 //    dd($request->session()->get('cart'));
//    return redirect()->route('shop.shopping-cart');
   return view('shop.shopping-cart', ['products'=>$cart->items, 'totalPrice' =>$cart->totalPrice, 'totalQty' =>$cart->totalQty]);
  
}


   public function getCart(){

        $products= Product::all();
       if (!Session::has('cart')){
           return view('shop.shopping-cart');
       }
       $oldCart = Session::get('cart');
       $cart = new Cart($oldCart);
       return view('shop.shopping-cart', ['products'=>$cart->items, 'totalPrice' =>$cart->totalPrice, 'totalQty' =>$cart->totalQty]);
   }
public function getCheckout() {

    if (!Session::has('cart')){
        return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    return view('shop.checkout', ['total'=>$total]);

}
               
                    

public function postCheckout(Request $request){
   
    if (!Session::has('cart')){
        return view('shop.shopping-cart');
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    $user = Auth::user();

    
    $this->validate($request, [
        'mpesa_code'=>'alpha_num|required|min:10|max:10|unique:shipments',
        'town'=>'required',
        'address'=>'required',

    ]);
   

    foreach($cart->items as $top)
    $products= Product::find($top['item']['id']);
    $quantity=$products->quantity_available;
    foreach($cart->items as $top)
    $data=Product::where('id', $top['item']['id']) 
                    ->update(['quantity_available' =>$quantity - $top['qty'] ]);
                 
                    
    $payment = new payment();
    $payment->cart = serialize($cart);
    $payment->totalexpected = $total;
    $payment->mpesa_code = $request->input('mpesa_code');
    $payment->town = $request->input('town');
    $payment->address = $request->input('address');
    $payment->name = $user->name;
    Auth::user()->payments()->save($payment);
    

    $order = new order();
    $order->cart = serialize($cart);
    $order->payment_id = $payment->id;
    $order->name = $user->name;
    $order->town = $payment->town;
    $order->address = $payment->address;
    Auth::user()->orders()->save($order);

        $shipment = new shipment();
        $shipment->cart = serialize($cart);
        $shipment->order_id = $order->id;
        $shipment->order_shipment = 'Order';
        $shipment->totalexpected = $total;
        $shipment->mpesa_code = $payment->mpesa_code;
        $shipment->payment_id = $payment->id;
        $shipment->name = $user->name;
        $shipment->town = $payment->town;
        $shipment->address = $payment->address;
        Auth::user()->shipment()->save($shipment);
        

    Session::forget('cart');
    return redirect()->route('product.index')->with('message', 'Successfully purchased products'); 
    
}


// BONNIES QUERY
public function is_user(Request $request, $order_id)
{
    $data=payment::find($order_id);
        $data->status="Approved";
        $data->save();
    
        $order = new order();
        $order->cart = serialize($cart);
        $order->payment_id = $data->id;
        Auth::user()->orders()->save($order);

    

    return Redirect::to('accountants/home')->with('message', $data->Email. 'Status has been Approved successfully');
}

public function is_prodapprove(Request $request, $id)
{
    $data=Product::where('id', $id)
                    ->update(['status' => "Published"]);
                 return redirect()->back()->with('message','Product has been Approved successfully');

}

public function is_prodarchive(Request $request, $id)
{
    $data=Product::where('id', $id)
                    ->update(['status' => "Archived"]);
                 return redirect()->back()->with('message','Product has been Archived successfully');

}
public function is_prodedit(Request $request, $id)
{
    $products = Product::find($id);   
    return view('stockmanager.prodedit', ['products' => $products]);

}
public function update_product_info(Request $request, $id) {
    $data= Product::find($id);
    $data->productName = $request->input('productName');
    $data->Description = $request->input('Description');
    $data->Price = $request->input('Price');
    $data->quantity_available = $request->input('quantity_available');
    $data->unit = $request->unit;
    $data->status = $request->status;
    
    $data->save();
              return Redirect::back()->with('message','Product Data Updated successfully');
}

// public function add_new_product(Request $request) {
//     $product= new services();
//     $product->serviceName = $request->input('productName');
//     $product->Description = $request->input('Description');
//     $product->Price = $request->input('Price');
//     $product->quantity_available = $request->input('quantity_available');
//     $product->unit = $request->unit;
//     $product->status = $request->status;
//     $product->Picture = $request->input('Picture');
//     $product->save();
    
//             return Redirect::to('stockmanagerhome')->with('message','New Product Was Added Successfully');
// }


public function add_new_product(Request $request) {
    $product= new product();
    $product->productName = $request->input('productName');
    $product->Description = $request->input('Description');
    $product->Price = $request->input('Price');
    $product->quantity_available = $request->input('quantity_available');
    $product->unit = $request->unit;
    $product->status = $request->status;
    $product->Picture = $request->input('Picture');
    $product->save();
    
            return Redirect::to('stockmanagerhome')->with('message','New Product Was Added Successfully');
}
public function is_payment(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->payment_status="Approved";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
}
public function payment_reject(Request $request, $shipment_id)
{
    $row=shipment::find($shipment_id);
    $cart=unserialize($row->cart);
    foreach($cart->items as $top)
        $products= Product::find($top['item']['id']);
            $quantity=$products->quantity_available;
      
            foreach($cart->items as $top)
            
                $data=Product::where('id', $top['item']['id']) 
                ->update(['quantity_available' =>$quantity+$top['qty'] ]);
    
    
    $data1=shipment::find($shipment_id);
        $data1->payment_status="Rejected";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Rejected successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Rejected successfully');
}

public function payment_archive(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->payment_status="Archived";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Archived successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Rejected successfully');
}
public function is_refund(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->refund_status="Refunded";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Approved successfully');
}

public function is_order(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->order_status="Approved";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Approved successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Approved successfully');
}
public function order_reject(Request $request, $shipment_id)
{
    $data1=shipment::find($shipment_id);
        $data1->order_status="Rejected";

    $data1->save();
    return redirect()->back()->with('message', $data1->Email. 'Order has been Rejected successfully');
    // return Redirect::to('accountants/home')->with('message', $data1->Email. 'Order has been Rejected successfully');
}

public function search (Request $request){
    $search = $request->get('search');
$products = DB::table('products')->where('productName', 'like', '%' .$search. '%')->paginate(5);
return view('shop.index', ['products'=>$products]);

}

//   public function pdf($ID){
//         $Invoice = StockPurchase::with(['products.styles','supplyer'])->where('boxID',$ID)->get();
//         $paymenthist= Supplyerpayment::where('boxID',$ID)->sum('amount');
//         //return view("PDF.pdfstock",compact(['Invoice','paymenthist']));

//         $pdf = PDF::loadView('PDF.pdfstock',compact(['Invoice','paymenthist']));
//         return $pdf->stream('Purchase_invoice_'.$ID.'.pdf');
//     }
    public function pdf(Request $request, $id){
        $shipments = shipment::find($id);
        $cart=unserialize($shipments->cart);
        $pdf = PDF::loadView('user.orderreport',compact(['shipments', 'cart']));
        return $pdf->stream('Purchase_invoice_'.$id.'.pdf');
    }
    public function pdf2(Request $request, $id){
        $shipments = shipment::find($id);
        $cart=unserialize($shipments->cart);
        $pdf = PDF::loadView('user.paymentreport',compact(['shipments', 'cart']));
        return $pdf->stream('Purchase_invoice_'.$id.'.pdf');
    }

}

