<?php
use Illuminate\Support\Facades\Input;
use App\Product;
use App\services;
use App\accountants;
use App\shipment;
use App\drivers;
use App\suppliers;
use App\supply;
use App\Order;
use App\Cart;
use App\payment;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('users', 'Auth\LoginController@showLoginForm')->name('user.login');
    Route::get('usersregister', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
    Route::post('usersregister', 'Auth\RegisterController@Register');
    Route::post('users', 'Auth\LoginController@Login');
    Route::post('users-password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
    Route::get('users-password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
    Route::post('users-password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('users-password/reset/{token}', 'Auth\ForgotPasswordController@showResetForm')->name('user.password.reset');

Route::get('/', ['uses'=>'productsController@getIndex',
'as'=>'product.index'
]);


Route::get('/help', [
    'uses'=>'UserController@help',
     'as'=>'user.help'
]);

Route::get('/servicesindex', ['uses'=>'servicesController@getServicesIndex',
'as'=>'shop.servicesindex'
]);



Route::get('/add-to-cart/{id}', [
    'uses'=>'productsController@getAddToCart',
     'as'=>'product.addToCart'
]);


Route::get('/addone-to-cart/{id}', [
    'uses'=>'productsController@getAddoneToCart',
     'as'=>'product.addoneToCart'
]);
Route::get('/update-cart/{id}', [
    'uses'=>'productsController@getupdateCart',
     'as'=>'update-cart'
]);

Route::get('/remove-cart/{id}', [
    'uses'=>'productsController@getremoveCart',
     'as'=>'remove-cart'
]);

Route::get('/service-add-to-cart/{id}', [
    'uses'=>'servicesController@getAddToCart',
     'as'=>'service.addToBooking'
]);

Route::get('/shopping-cart', [
    'uses'=>'productsController@getCart',
     'as'=>'product.shoppingCart'
]);



Route::get('/bookings', [
    'uses'=>'servicesController@getBooking',
     'as'=>'service.bookings'
]);

Route::get('/checkout', [
    'uses'=>'productsController@getCheckout',
     'as'=>'checkout',
     'middleware'=> 'auth'
]);

Route::post('/checkout', [
    'uses'=>'productsController@postCheckout',
     'as'=>'checkout',
     'middleware'=> 'auth'
]);



Route::get('/servicescheckout', [
    'uses'=>'servicesController@getCheckout',
     'as'=>'servicescheckout',
     'middleware'=> 'auth'
]);

Route::post('/servicescheckout', [
    'uses'=>'servicesController@postCheckout',
     'as'=>'servicescheckout',
     'middleware'=> 'auth'
]);
Route::get('/feedback', [
    'uses'=>'UserController@getFeedback',
     'as'=>'feedback',
     'middleware'=> 'auth'
]);


Route::post('/feedback', [
    'uses'=>'UserController@postFeedback',
     'as'=>'feedback',
     'middleware'=> 'auth'
]);
Route::get('inbox/{id}',[
    'uses'=>'UserController@inbox',
    'as'=>'inbox',
    'middleware'=>'auth'
]);


// Route::group(['prefix' => 'user'], function(){
    Route::group(['middleware' => 'guest'], function(){
        Route::get('/signup', [
            'uses'=>'UserController@getSignup',
            'as'=>'user.signup'
            ]);
        Route::post('/signup', [
            'uses'=>'UserController@postSignup',
            'as'=>'user.signup'
            ]);
            
            Route::get('signin', [
                'uses'=>'UserController@getSignin',
                'as'=>'user.signin'
                
                ]);
                
                Route::post('signin', [
                'uses'=>'UserController@postSignin',
                'as'=>'user.signin'
                
                ]);
                

    });
Route::group(['middleware' => 'auth'], function(){
Route::get('/profile', [
            'uses'=>'UserController@getProfile',
            'as'=>'user.profile'
    ]);

Route::get('/pendingorders', [
        'uses'=>'UserController@getOrders',
        'as'=>'user.pendingorders'
    ]);
Route::get('/deliveredorders', [
    'uses'=>'UserController@getDeliveredOrders',
    'as'=>'user.deliveredorders'
     ]);
Route::get('/approvedorders', [
    'uses'=>'UserController@getApprovedOrders',
    'as'=>'user.approvedorders'
     ]);
Route::get('/pendingservicesbooked', [
    'uses'=>'UserController@getpendingservicesbooked',
    'as'=>'user.pendingservicesbooked'
]);
Route::get('/approvedservicesbooked', [
    'uses'=>'UserController@getapprovedservicesbooked',
    'as'=>'user.approvedservicesbooked'
]);
Route::get('/deliveredservicesbooked', [
    'uses'=>'UserController@getdeliveredservicesbooked',
    'as'=>'user.deliveredservicesbooked'
]);
    Route::get('/logout', [
        'uses'=>'UserController@getLogout',
        'as'=>'user.logout'
    ]);


    });
        
// });

Route::group(['middleware' => 'auth'], function(){
Route::get('pendingpayments', [
    'uses'=>'UserController@pendingpayments',
    'as'=>'pendingpayments'
    
    ]);
Route::get('approvedpayments', [
        'uses'=>'UserController@approvedpayments',
        'as'=>'approvedpayments'
        
        ]);
Route::get('rejectedpayments', [
            'uses'=>'UserController@rejectedpayments',
            'as'=>'rejectedpayments'
            
            ]);
});





// SHIPMENT MANAGER STARTS HERE
Route::get('/shipmentmanagerlogout', [
    'uses'=>'shipmentmanagerController@getLogout',
    'as'=>'shipmentmanager.logout'
]);
Route::get('/shipmentmanagerprofile', [
    'uses'=>'shipmentmanagerController@getProfile',
    'as'=>'shipmentmanager.profile'
]);
// Route::get('modal', 'shipmentmanagerController@modal')->name('modal');
Route::get('shipmentmanagerhome', 'shipmentmanagerController@index')->name('shipmentmanager/home');
Route::get('shipmentmanager/shipmentreport', 'shipmentmanagerController@shipmentreport')->name('shipmentmanager/shipmentreport');
Route::get('shipmentmanager/servicedeliveryreport', 'shipmentmanagerController@servicedeliveryreport')->name('shipmentmanager/servicedeliveryreport');
Route::get('shipmentmanagerpendingorders', 'shipmentmanagerController@pendingorders')->name('shipmentmanager/pendingorders');
Route::get('shipmentmanagerallocatedorders', 'shipmentmanagerController@allocatedorders')->name('shipmentmanager/allocatedorders');
Route::get('shipmentmanagerallbookings', 'shipmentmanagerController@allbookings')->name('shipmentmanager/allbookings');
Route::get('shipmentmanagerpendingbookings', 'shipmentmanagerController@pendingbookings')->name('shipmentmanager/pendingbookings');
Route::get('shipmentmanagerallocatedbookings', 'shipmentmanagerController@allocatedbookings')->name('shipmentmanager/allocatedbookings');
Route::get('shipmentmanager', 'shipmentmanager\LoginController@showLoginForm')->name('shipmentmanager.login');
Route::get('shipmentmanagerregister', 'shipmentmanager\RegisterController@showRegistrationForm')->name('shipmentmanager.register');
Route::post('shipmentmanagerregister', 'shipmentmanager\RegisterController@Register');
Route::post('shipmentmanager', 'shipmentmanager\LoginController@Login');
Route::post('shipmentmanager-password/email', 'shipmentmanager\ForgotPasswordController@sendResetLinkEmail')->name('shipmentmanager.password.email');
Route::get('shipmentmanager-password/reset', 'shipmentmanager\ForgotPasswordController@showLinkRequestForm')->name('shipmentmanager.password.request');
Route::post('shipmentmanager-password/reset', 'shipmentmanager\ResetPasswordController@reset');
Route::get('shipmentmanager-password/reset/{token}', 'shipmentmanager\ForgotPasswordController@showResetForm')->name('shipmentmanager.password.reset');

// ORDERMANAGER STARTS HERE
Route::get('/ordermanagerlogout', [
    'uses'=>'ordermanagerController@getLogout',
    'as'=>'ordermanager.logout'
]);
Route::get('/ordermanagerprofile', [
    'uses'=>'ordermanagerController@getProfile',
    'as'=>'ordermanager.profile'
]);

Route::get('ordermanagerpendingorders', [
    'uses'=>'ordermanagerController@getpendingorders',
    'as'=>'ordermanager.pendingorders'
     ]);

Route::get('ordermanagerapprovedorders', [
'uses'=>'ordermanagerController@getapprovedorders',
'as'=>'ordermanager.approvedorders'
 ]);

Route::get('ordermanagerallbookings', [
'uses'=>'ordermanagerController@getallbookings',
'as'=>'ordermanager.allbookings'
]);
Route::get('ordermanagerpendingbookings', [
    'uses'=>'ordermanagerController@getpendingbookings',
    'as'=>'ordermanager.pendingbookings'
    ]);
Route::get('ordermanagerapprovedbookings', [
'uses'=>'ordermanagerController@getapprovedbookings',
'as'=>'ordermanager.approvedbookings'
]);

Route::get('ordermanagerhome', 'ordermanagerController@index')->name('ordermanager/home');
Route::get('ordermanager/ordersreport', 'ordermanagerController@ordersreport')->name('ordermanager/ordersreport');
Route::get('ordermanager/bookingsreport', 'ordermanagerController@bookingsreport')->name('ordermanager/bookingsreport');
Route::get('ordermanager', 'ordermanager\LoginController@showLoginForm')->name('ordermanager.login');
Route::get('ordermanagerregister', 'ordermanager\RegisterController@showRegistrationForm')->name('ordermanager.register');
Route::post('ordermanagerregister', 'ordermanager\RegisterController@Register');
Route::post('ordermanager', 'ordermanager\LoginController@Login');
Route::post('ordermanager-password/email', 'ordermanager\ForgotPasswordController@sendResetLinkEmail')->name('ordermanager.password.email');
Route::get('ordermanager-password/reset', 'ordermanager\ForgotPasswordController@showLinkRequestForm')->name('ordermanager.password.request');
Route::post('ordermanager-password/reset', 'ordermanager\ResetPasswordController@reset');
Route::get('ordermanager-password/reset/{token}', 'ordermanager\ForgotPasswordController@showResetForm')->name('ordermanager.password.reset');

// ACCOUNTANTS START HERE
Route::get('/accountantslogout', [
    'uses'=>'accountantsController@getLogout',
    'as'=>'accountants.logout'
]);
Route::get('/accountantprofile', [
    'uses'=>'accountantsController@getProfile',
    'as'=>'accountants.profile'
]);

    Route::get('accountantsorders', 'accountantsController@orders');
    Route::get('accountantshome', 'accountantsController@index')->name('accountants/home');
    // Route::get('accountants/paymentreport', 'accountantsController@paymentpdf');
    Route::get('accountants/paymentreport', 'accountantsController@paymentreport')->name('accountants/paymentreport');
    Route::get('accountantspending', 'accountantsController@pending')->name('accountants/pending');
    Route::get('accountantsapproved', 'accountantsController@approved')->name('accountants/approved');
    Route::get('accountantsrejected', 'accountantsController@rejected')->name('accountants/rejected');
    Route::get('accountantsrefunded', 'accountantsController@refunded')->name('accountants/refunded');
    Route::get('accountantsarchived', 'accountantsController@archived')->name('accountants/archived');
    Route::get('accountants', 'accountants\LoginController@showLoginForm')->name('accountants.login');
    Route::get('accountantsregister', 'accountants\RegisterController@showRegistrationForm')->name('accountants.register');
    Route::post('accountantsregister', 'accountants\RegisterController@Register');
    Route::post('accountants', 'accountants\LoginController@Login');
    Route::post('accountants-password/email', 'accountants\ForgotPasswordController@sendResetLinkEmail')->name('accountant.password.email');
    Route::get('accountants-password/reset', 'accountants\ForgotPasswordController@showLinkRequestForm')->name('accountants.password.request');
    Route::post('accountants-password/reset', 'accountants\ResetPasswordController@reset');
    Route::get('accountants-password/reset/{token}', 'accountants\ForgotPasswordController@showResetForm')->name('accountants.password.reset');
   

    // DRIVERS STARTS HERE
    Route::get('/driverprofile', [
        'uses'=>'driversController@getProfile',
        'as'=>'drivers.profile'
    ]);
    Route::get('/driverslogout', [
        'uses'=>'driversController@getLogout',
        'as'=>'drivers.logout'
    ]);
    
    Route::get('drivershome', 'driversController@index');
    Route::get('driverspending', 'driversController@pending');
    Route::get('driversdelivered', 'driversController@delivered');
    Route::get('driversconfirmed', 'driversController@confirmed');
    Route::get('drivers', 'drivers\LoginController@showLoginForm')->name('drivers.login');
    Route::get('driversregister', 'drivers\RegisterController@showRegistrationForm')->name('drivers.register');
    Route::post('driversregister', 'drivers\RegisterController@Register');
    Route::post('drivers', 'drivers\LoginController@Login');
    Route::post('drivers-password/email', 'drivers\ForgotPasswordController@sendResetLinkEmail')->name('drivers.password.email');
    Route::get('drivers-password/reset', 'drivers\ForgotPasswordController@showLinkRequestForm')->name('drivers.password.request');
    Route::post('drivers-password/reset', 'drivers\ResetPasswordController@reset');
    Route::get('drivers-password/reset/{token}', 'drivers\ForgotPasswordController@showResetForm')->name('drivers.password.reset');



    // suppliers START HERE
    Route::get('/supplierprofile', [
        'uses'=>'suppliersController@getProfile',
        'as'=>'suppliers.profile'
    ]);
    Route::get('/supplierslogout', [
        'uses'=>'suppliersController@getLogout',
        'as'=>'suppliers.logout'
    ]);
    Route::get('suppliershome', 'suppliersController@index');
    Route::get('supplierspending', 'suppliersController@pending');
    Route::get('suppliersaccepted', 'suppliersController@accepted');
    Route::get('suppliersconfirmed', 'suppliersController@confirmed');
    Route::get('suppliers', 'suppliers\LoginController@showLoginForm')->name('suppliers.login');
    Route::get('suppliersregister', 'suppliers\RegisterController@showRegistrationForm')->name('suppliers.register');
    Route::post('suppliersregister', 'suppliers\RegisterController@Register');
    Route::post('suppliers', 'suppliers\LoginController@Login');
    Route::post('suppliers-password/email', 'suppliers\ForgotPasswordController@sendResetLinkEmail')->name('accountant.password.email');
    Route::get('suppliers-password/reset', 'suppliers\ForgotPasswordController@showLinkRequestForm')->name('suppliers.password.request');
    Route::post('suppliers-password/reset', 'suppliers\ResetPasswordController@reset');
    Route::get('suppliers-password/reset/{token}', 'suppliers\ForgotPasswordController@showResetForm')->name('suppliers.password.reset');
   
   
    // QUICK ACTIONS START HERE
    Route::get('/registered', 'dashboardController@registered')->name('registered');

    Route::get('is_user/{id}', 'productsController@is_user')->name('is_user');
    Route::get('farchive/{id}', 'UserController@farchive')->name('farchive');
    Route::get('payment_reject/{id}', 'productsController@payment_reject')->name('payment_reject');
    Route::get('payment_archive/{id}', 'productsController@payment_archive')->name('payment_archive');
    Route::get('is_payment/{id}', 'productsController@is_payment')->name('is_payment');
    Route::get('is_quantity/{id}', 'productsController@is_quantity')->name('is_quantity');
    Route::get('remove/{id}', 'productsController@remove')->name('remove');
    Route::get('is_refund/{id}', 'productsController@is_refund')->name('is_refund');
    Route::get('is_order/{id}', 'productsController@is_order')->name('is_order');
    Route::get('order_reject/{id}', 'productsController@order_reject')->name('order_reject');
    Route::get('is_booking/{id}', 'servicesController@is_booking')->name('is_booking');
    Route::get('booking_reject/{id}', 'servicesController@booking_reject')->name('booking_reject');
    Route::get('is_prodarchive/{id}', 'productsController@is_prodarchive')->name('is_prodarchive');
    Route::get('is_prodapprove/{id}', 'productsController@is_prodapprove')->name('is_prodapprove');
    Route::get('is_prodedit/{id}', 'stockmanagerController@is_prodedit')->name('is_prodedit');
    Route::post('add_new_product', 'productsController@add_new_product')->name('add_new_product');
    
    Route::get('is_delivered/{id}', 'driversController@is_delivered')->name('is_delivered');
    Route::get('is_confirmdelivered/{id}', 'UserController@is_confirmdelivered')->name('is_confirmdelivered');
    Route::get('is_accepted/{id}', 'suppliersController@is_accepted')->name('is_accepted');
    Route::get('is_rejected/{id}', 'suppliersController@is_rejected')->name('is_rejected');
    Route::get('is_supplied/{id}', 'suppliersController@is_supplied')->name('is_supplied');
    Route::post('is_allocated/{id}', 'shipmentmanagerController@is_allocated')->name('is_allocated');
    Route::post('is_masonallocated/{id}', 'shipmentmanagerController@is_masonallocated')->name('is_masonallocated');
    Route::post('allocatedriver', 'shipmentmanagerController@allocatedriver')->name('allocatedriver');
    
    Route::post('update-user-info/{id}', 'UserController@update_user_info');
    Route::post('update-product-info/{id}', 'productsController@update_product_info');
    Route::post('update-accountant-info/{id}', 'accountantsController@update_accountant_info');
    Route::post('update-driver-info/{id}', 'driversController@update_driver_info');
    Route::post('update-supplier-info/{id}', 'suppliersController@update_supplier_info');
    Route::post('update-ordermanager-info/{id}', 'ordermanagerController@update_ordermanager_info');
    Route::post('update-shipmentmanager-info/{id}', 'shipmentmanagerController@update_shipmentmanager_info');
    Route::post('update-stockmanager-info/{id}', 'stockmanagerController@update_stockmanager_info');
    Route::get('/makepdfpurchase/{id}', 'productsController@pdf');
    Route::get('/makepdfpurchase2/{id}', 'productsController@pdf2');
    

    // STOCK MANAGER STARTS HERE
    Route::get('/stockmanagerlogout', [
        'uses'=>'stockmanagerController@getLogout',
        'as'=>'stockmanager.logout'
    ]);
    
Route::get('/stockmanagerprofile', [
    'uses'=>'stockmanagerController@getProfile',
    'as'=>'stockmanager.profile'
]);


Route::get('stockmanagerhome', 'stockmanagerController@index');
Route::get('stockmanagerpublished', 'stockmanagerController@published');
Route::get('stockmanagerarchived', 'stockmanagerController@archived');
Route::get('stockmanagerpending', 'stockmanagerController@pending');
Route::get('stockmanagerdelivered', 'stockmanagerController@delivered');
Route::get('stockmanagerconfirmed', 'stockmanagerController@confirmed');
Route::get('stockmanager', 'stockmanager\LoginController@showLoginForm')->name('stockmanager.login');
Route::get('stockmanagerregister', 'stockmanager\RegisterController@showRegistrationForm')->name('stockmanager.register');
Route::post('stockmanagerregister', 'stockmanager\RegisterController@Register');
Route::post('stockmanager', 'stockmanager\LoginController@Login');
Route::post('stockmanager-password/email', 'stockmanager\ForgotPasswordController@sendResetLinkEmail')->name('stockmanager.password.email');
Route::get('stockmanager-password/reset', 'stockmanager\ForgotPasswordController@showLinkRequestForm')->name('stockmanager.password.request');
Route::post('stockmanager-password/reset', 'stockmanager\ResetPasswordController@reset');
Route::get('stockmanager-password/reset/{token}', 'stockmanager\ForgotPasswordController@showResetForm')->name('stockmanager.password.reset');


// SEARCH STARTS HERE
Route::post('/search', function(){
    $search=Input::get('search');
    if($search !=""){
        $products=Product::where('productName', 'LIKE', '%' .$search. '%')
                               ->orWhere('Price', 'LIKE', '%' .$search. '%')
                               ->get();
                               if(count($products)>0)
                               return view('shop.index', ['products'=>$products])->withDetails($products)->withQuery($products);

    }
    return view('shop.index', ['products'=>$products])->withMessage("No such products found!");
});


Route::post('/searchservices', function(){
    $searchservices=Input::get('searchservices');
    if($searchservices !=""){
        $services=services::where('serviceName', 'LIKE', '%' .$searchservices. '%')
                               ->orWhere('Price', 'LIKE', '%' .$searchservices. '%')
                               ->get();
                               if(count($services)>0)
                               return view('shop.servicesindex', ['services'=>$services])->withDetails($services)->withQuery($services);

    }
    return view('shop.servicesindex', ['services'=>$services])->withMessage("No such services found!");
});


Route::post('/searchapprovedpayments', function(){
    $row=shipment::all();
    $searchapprovedpayments=Input::get('searchapprovedpayments');
    if($searchapprovedpayments !="" && $row->payment_status = "Approved"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchapprovedpayments. '%')
                               ->orWhere('totalexpected', 'LIKE', '%' .$searchapprovedpayments. '%')
                               ->orWhere('payment_status', 'LIKE', '%' .$searchapprovedpayments. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('accountants.approved', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('accountants.approved', ['shipments' => $shipments])->withMessage("No such Payments found!");
});

Route::post('/searchallpayments', function(){
    $row=shipment::all();
    $searchallpayments=Input::get('searchallpayments');
    if($searchallpayments !=""){
        $shipments = shipment::where('mpesa_code', 'LIKE', '%' .$searchallpayments. '%')
                               ->orWhere('totalexpected', 'LIKE', '%' .$searchallpayments. '%')
                               ->orWhere('payment_status', 'LIKE', '%' .$searchallpayments. '%')
                               ->orWhere('refund_status', 'LIKE', '%' .$searchallpayments. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('accountants.home', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('accountants.home', ['shipments' => $shipments])->withMessage("No such Payments found!");
});

Route::post('/searchpendingpayments', function(){
    $row=shipment::all();
    $searchpendingpayments=Input::get('searchpendingpayments');
    if($searchpendingpayments !="" && $row->payment_status = "Pending"){
        $shipments = shipment::where('mpesa_code', 'LIKE', '%' .$searchpendingpayments. '%')
                               ->orWhere('totalexpected', 'LIKE', '%' .$searchpendingpayments. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('accountants.pending', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('accountants.pending', ['shipments' => $shipments])->withMessage("No such Payments found!");
});
Route::post('/searchrejectedpayments', function(){
    $row=shipment::all();
    $searchrejectedpayments=Input::get('searchrejectedpayments');
    if($searchrejectedpayments !="" && $row->payment_status = "Approved"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchrejectedpayments. '%')
                               ->orWhere('totalexpected', 'LIKE', '%' .$searchrejectedpayments. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('accountants.rejected', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('accountants.rejected', ['shipments' => $shipments])->withMessage("No such Payments found!");
});
Route::post('/searchrefundedpayments', function(){
    $row=shipment::all();
    $searchrefundedpayments=Input::get('searchrefundedpayments');
    if($searchrefundedpayments !="" && $row->payment_status = "Refunded"){
        $shipments = shipment::where('totalexpected', 'LIKE', '%' .$searchrefundedpayments. '%')
                               ->orWhere('name', 'LIKE', '%' .$searchrefundedpayments. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('accountants.refunded', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('accountants.refunded', ['shipments' => $shipments])->withMessage("No such Payments found!");
}); 
// && $row->payment_status = "Refunded"
Route::post('/searchallorders', function(){
    $row=shipment::all();
    $searchallorders=Input::get('searchallorders');
    if($searchallorders !="" && $row->order_shipment = "Order"){
        $shipments = shipment::where('payment_status', 'LIKE', '%' .$searchallorders. '%')
                               ->orWhere('name', 'LIKE', '%' .$searchallorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/home', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/home', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 

Route::post('/searchapprovedorders', function(){
    $row=shipment::all();
    $searchapprovedorders=Input::get('searchapprovedorders');
    if($searchapprovedorders !="" && $row->order_shipment = "Order" && $row->order_status = "Approved"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchapprovedorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/approvedorders', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/approvedorders', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 


Route::post('/searchpendingorders', function(){
    $row=shipment::all();
    $searchpendingorders=Input::get('searchpendingorders');
    if($searchpendingorders !="" && $row->order_shipment = "Order" && $row->order_status = "Pending"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchpendingorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/pendingorders', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/pendingorders', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 


Route::post('/searchallbookings', function(){
    $row=shipment::all();
    $searchallbookings=Input::get('searchallbookings');
    if($searchallbookings !="" && $row->order_shipment = "Shipment"){
        $shipments = shipment::where('booking_status', 'LIKE', '%' .$searchallbookings. '%')
                               ->orWhere('name', 'LIKE', '%' .$searchallbookings. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/allbookings', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/allbookings', ['shipments' => $shipments])->withMessage("No such Bookings found!");
}); 

Route::post('/searchapprovedbookings', function(){
    $row=shipment::all();
    $searchapprovedbookings=Input::get('searchapprovedorders');
    if($searchapprovedbookings !="" && $row->order_shipment = "Shipment" && $row->booking_status = "Approved"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchapprovedbookings. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/approvedbookings', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/approvedbookings', ['shipments' => $shipments])->withMessage("No such Bookings found!");
}); 


Route::post('/searchpendingbookings', function(){
    $row=shipment::all();
    $searchpendingbookings=Input::get('searchpendingbookings');
    if($searchpendingbookings !=""  && $row->order_shipment = "Shipment" && $row->booking_status = "Pending"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchpendingbookings. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('ordermanager/pendingbookings', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/pendingbookings', ['shipments' => $shipments])->withMessage("No such Bookings found!");
}); 


Route::post('/searchallshipmentorders', function(){
    $drivers=drivers::all();
    $row=shipment::all();
    $searchallshipmentorders=Input::get('searchallshipmentorders');
    if($searchallshipmentorders !="" && $row->order_shipment = "Order" && $row->payment_status= "Approved"){
        $shipments = shipment::where('allocation_status', 'LIKE', '%' .$searchallshipmentorders. '%')
                               ->orWhere('name', 'LIKE', '%' .$searchallshipmentorders. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchallshipmentorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/home', ['shipments' => $shipments], ['drivers' => $drivers])->withDetails($shipments)->withQuery($shipments);

    }
    return view('ordermanager/home', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 

Route::post('/searchallocatedorders', function(){
    $drivers=drivers::all();
    $row=shipment::all();
    $searchallocatedorders=Input::get('searchallocatedorders');
    if($searchallocatedorders !="" && $row->order_shipment = "Order" && $row->allocation_status = "Allocated"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchallocatedorders. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchallocatedorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/allocatedorders', ['shipments' => $shipments], ['drivers' => $drivers])->withDetails($shipments)->withQuery($shipments);

    }
    return view('shipmentmanager/allocatedorders', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 


Route::post('/searchshipmentpendingorders', function(){
    $drivers=drivers::all();
    $row=shipment::all();
    $searchshipmentpendingorders=Input::get('searchshipmentpendingorders');
    if($searchshipmentpendingorders !="" && $row->order_shipment = "Order" && $row->allocation_status = "Pending"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchshipmentpendingorders. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchallocatedorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->cart = unserialize($shipment->cart);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/pendingorders', ['shipments' => $shipments], ['drivers' => $drivers])->withDetails($shipments)->withQuery($shipments);

    }
    return view('shipmentmanager/pendingorders', ['shipments' => $shipments])->withMessage("No such Orders found!");
}); 


Route::post('/searchshipmentallbookings', function(){
    $suppliers=suppliers::all();
    $row=shipment::all();
    $searchshipmentallbookings=Input::get('searchshipmentallbookings');
    if($searchshipmentallbookings !="" && $row->order_shipment = "Shipment" && $row->booking_status= "Approved"){
        $shipments = shipment::where('allocation_status', 'LIKE', '%' .$searchshipmentallbookings. '%')
                               ->orWhere('name', 'LIKE', '%' .$searchshipmentallbookings. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/allbookings', ['shipments' => $shipments], ['suppliers' => $suppliers])->withDetails($shipments)->withQuery($shipments);

    }
    return view('shipmentmanager/allbookings', ['shipments' => $shipments])->withMessage("No such Bookings found!");
}); 

Route::post('/searchshipmentallocatedbookings', function(){
    $suppliers=suppliers::all();
    $row=shipment::all();
    $searchshipmentallocatedbookings=Input::get('searchshipmentallocatedbookings');
    if($searchshipmentallocatedbookings !="" && $row->order_shipment = "Shipment" && $row->allocation_status = "Allocated"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchshipmentallocatedbookings. '%')
                                     ->orWhere('address', 'LIKE', '%' .$searchallshipmentorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/allocatedbookings', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('shipmentmanager/allocatedbookings', ['shipments' => $shipments], ['suppliers' => $suppliers])->withMessage("No such Bookings found!");
}); 


Route::post('/searchshipmentpendingbookings', function(){
    $suppliers=suppliers::all();
    $row=shipment::all();
    $searchshipmentpendingbookings=Input::get('searchshipmentpendingbookings');
    if($searchshipmentpendingbookings !=""  && $row->order_shipment = "Shipment" && $row->allocation_status = "Pending"){
        $shipments = shipment::where('name', 'LIKE', '%' .$searchshipmentpendingbookings. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchallshipmentorders. '%')
                               ->get();

                               $shipments->transform(function($shipment, $key) {
                                $shipment->booking = unserialize($shipment->booking);
                                return $shipment;
                            });
                            //    dd($shipments);
                               if(count($shipments)>0)
                               return view('shipmentmanager/pendingbookings', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('shipmentmanager/pendingbookings', ['shipments' => $shipments], ['suppliers' => $suppliers])->withMessage("No such Bookings found!");
}); 
Route::post('/searchdriverall', function(){
    $row=shipment::all();
    $driver = Auth::user();
    $searchdriverall=Input::get('searchdriverall');
    if($searchdriverall !="" && $row->driver_id==$driver->id){
        $shipments=shipment::where('name', 'LIKE', '%' .$searchdriverall. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchdriverall. '%')
                               ->get();
                               if(count($shipments)>0)
                               return view('drivers/home', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('drivers/home', ['shipments' => $shipments])->withMessage("No such shipments found!");
});

Route::post('/searchdriverpending', function(){
    $row=shipment::all();
    $driver = Auth::user();
    $searchdriverpending=Input::get('searchdriverpending');
    if($searchdriverpending !="" && $row->deliverystatus="Pending"){
        $shipments=shipment::where('name', 'LIKE', '%' .$searchdriverpending. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchdriverpending. '%')
                               ->get();
                               if(count($shipments)>0)
                               return view('drivers/pending', ['shipments' => $shipments], ['driver' => $driver])->withDetails($shipments)->withQuery($shipments);

    }
    return view('drivers/pending', ['shipments' => $shipments], ['driver' => $driver])->withMessage("No such shipments found!");
});

Route::post('/searchdriverdelivered', function(){
    $row=shipment::all();
    $driver = Auth::user();
    $searchdriverdelivered=Input::get('searchdriverdelivered');
    if($searchdriverdelivered !="" && $row->driver_id==$driver->id && $row->deliverystatus="Delivered"){
        $shipments=shipment::where('name', 'LIKE', '%' .$searchdriverdelivered. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchdriverdelivered. '%')
                               ->get();
                               if(count($shipments)>0)
                               return view('drivers/delivered', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('drivers/delivered', ['shipments' => $shipments])->withMessage("No such shipments found!");
});

Route::post('/searchdriverconfirmed', function(){
    $row=shipment::all();
    $driver = Auth::user();
    $searchdriverconfirmed=Input::get('searchdriverconfirmed');
    if($searchdriverconfirmed !="" && $row->driver_id==$driver->id && $row->receivestatus="Received"){
        $shipments=shipment::where('name', 'LIKE', '%' .$searchdriverconfirmed. '%')
                               ->orWhere('address', 'LIKE', '%' .$searchdriverconfirmed. '%')
                               ->get();
                               if(count($shipments)>0)
                               return view('drivers/confirmed', ['shipments' => $shipments])->withDetails($shipments)->withQuery($shipments);

    }
    return view('drivers/confirmed', ['shipments' => $shipments])->withMessage("No such shipments found!");
});


Route::post('/searchsupplierall', function(){
    $row=supply::all();
    $supplier = Auth::user();
    $searchsupplierall=Input::get('searchsupplierall');
    if($searchsupplierall !="" && $row->supplier_id==$supplier->id){
        $supplies=supply::where('id', 'LIKE', '%' .$searchsupplierall. '%')
                               ->orWhere('quantity', 'LIKE', '%' .$searchsupplierall. '%')
                               ->orWhere('comment', 'LIKE', '%' .$searchsupplierall. '%')
                               ->get();
                               if(count($supplies)>0)
                               return view('suppliers/home', ['supplies' => $supplies])->withDetails($supplies)->withQuery($supplies);

    }
    return view('suppliers/home', ['supplies' => $supplies])->withMessage("No such supplies found!");
});
Route::post('/searchsupplierpending', function(){
    $row=supply::all();
    $supplier = Auth::user();
    $searchsupplierpending=Input::get('searchsupplierpending');
    if($searchsupplierpending !="" && $row->supplier_id==$supplier->id && $row->request_status="Pending"){
        $supplies=supply::where('id', 'LIKE', '%' .$searchsupplierpending. '%')
                           ->orWhere('quantity', 'LIKE', '%' .$searchsupplierpending. '%')
                           ->orWhere('comment', 'LIKE', '%' .$searchsupplierpending. '%')
                               ->get();
                               if(count($supplies)>0)
                               return view('suppliers/pending', ['supplies' => $supplies])->withDetails($supplies)->withQuery($supplies);

    }
    return view('suppliers/pending', ['supplies' => $supplies])->withMessage("No such supplies found!");
});

Route::post('/searchsupplieraccepted', function(){
    $row=supply::all();
    $supplier = Auth::user();
    $searchsupplieraccepted=Input::get('searchsupplieraccepted');
    if($searchsupplieraccepted !="" && $row->supplier_id==$supplier->id && $row->request_status="Accepted"){
        $supplies=supply::where('id', 'LIKE', '%' .$searchsupplieraccepted. '%')
                                     ->orWhere('quantity', 'LIKE', '%' .$searchsupplieraccepted. '%')
                                     ->orWhere('comment', 'LIKE', '%' .$searchsupplieraccepted. '%')
                               ->get();
                               if(count($supplies)>0)
                               return view('suppliers/accepted', ['supplies' => $supplies])->withDetails($supplies)->withQuery($supplies);

    }
    return view('suppliers/accepted', ['supplies' => $supplies])->withMessage("No such supplies found!");
});
Route::post('/searchsupplierconfirmed', function(){
    $row=supply::all();
    $supplier = Auth::user();
    $searchsupplierconfirmed=Input::get('searchsupplierconfirmed');
    if($searchsupplierconfirmed !="" && $row->supplier_id==$supplier->id && $row->receive_status="Received"){
        $supplies=supply::where('id', 'LIKE', '%' .$searchsupplierconfirmed. '%')
                               ->orWhere('quantity', 'LIKE', '%' .$searchsupplierconfirmed. '%')
                               ->orWhere('comment', 'LIKE', '%' .$searchsupplierconfirmed. '%')
                               ->get();
                               if(count($supplies)>0)
                               return view('suppliers/confirmed', ['supplies' => $supplies])->withDetails($supplies)->withQuery($supplies);

    }
    return view('suppliers/confirmed', ['supplies' => $supplies])->withMessage("No such supplies found!");
});

