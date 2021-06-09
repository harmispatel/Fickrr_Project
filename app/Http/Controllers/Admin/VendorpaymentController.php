<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Vendorpaymentsettings;
use Fickrr\Models\Items;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;

class VendorpaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function paymentsetting(Request $request){




// $to_email = 'harmistest@gmail.com';
// 		$subject = "THis is first";
// //   $to_email = "to@example.com";
//   $to_fullname = "John Doe";
// //   $from_email = "harmistest@gmail.com";
//   $from_email = "info@ghaith.com";
//   $from_fullname = "Jane Doe from";
//   $headers  = "MIME-Version: 1.0";
//   $headers .= "Content-type: text/html; charset=utf-8";
//   // Additional headers
//   // This might look redundant but some services REALLY favor it being there.
//   $headers .= "To: $to_fullname <$to_email>";
//   $headers .= "From: $from_fullname <$from_email>";
//   $message = "<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en'>
//   <head>
//     <title>Hello Test</title>
//   </head>
//   <body>
//     <p></p>
//     <p style='color: #00CC66; font-weight:600; font-style: italic; font-size:14px; float:left; margin-left:7px;'>You have received an inquiry from your website.  Please review the contact information below.</p>
//   </body>
//   </html>";
//   if (!mail($to_email, $subject, $message, $headers)) { 
//     print_r(error_get_last());
//   }
//   else { 
// 	'<h3 style="color:#d96922; font-weight:bold; height:0px; margin-top:1px;">Thank You For Contacting us!!</h3>';

//   }exit;


    	$itemid=$request->id;

    	$sidd = 1;
		//	$setting['setting'] = Settings::editGeneral($sidd);

    	//$sid = 1;
		$setting['setting'] = Vendorpaymentsettings::editGeneral($itemid);

		//echo "<pre>";print_r(	$setting['setting']);exit;

		$setting['payment'] =  Settings::editGeneral($sidd);
		$additional['setting'] = Settings::editAdditional();
		/*$payment_option = array('paypal','stripe','wallet','2checkout','paystack','localbank');*/
		$payment_option = array('paypal','stripe','wallet','paystack','localbank','razorpay');
		$withdraw_option = array('paypal','stripe','paystack','localbank');
		$get_payment =!empty($setting['setting']) ? explode(',', $setting['setting']->payment_option) : array();
		$get_withdraw =!empty($setting['setting']) ? explode(',', $setting['setting']->withdraw_option) : array();
		return view('admin.vendorpayment-settings', [ 'setting' => $setting,'payment_option' => $payment_option, 'withdraw_option' => $withdraw_option, 'get_payment' => $get_payment, 'get_withdraw' => $get_withdraw, 'additional' => $additional,'itemid'=>$itemid]);

    	//$tocken=

    }


    public function update_payment_settings(Request $request){

    	//echo "<pre>";print_r($request->all());
    	$sid=$request->sid;

	   $site_extra_fee = $request->input('site_extra_fee');
	   if(!empty($request->input('payment_option'))){
	     $payment = "";
		 foreach($request->input('payment_option') as $payment_option){
		    $payment .= $payment_option.',';
		 }
		 $payment_method = rtrim($payment,',');
	   }
	   else
	   {
	   	$payment_method = "";
	   }
	   
	   if(!empty($request->input('withdraw_option')))
	   {
	     $withdraw = "";
		 foreach($request->input('withdraw_option') as $withdraw_option)
		 {
		    $withdraw .= $withdraw_option.',';
		 }
		 $withdraw_method = rtrim($withdraw,',');
	   }
	   else
	   {
	   $withdraw_method = "";
	   }
	   $paypal_email = $request->input('paypal_email');
	   $paypal_mode = $request->input('paypal_mode');
	   $stripe_mode = $request->input('stripe_mode');
	   $test_publish_key = $request->input('test_publish_key');
	   $live_publish_key = $request->input('live_publish_key');
	   $test_secret_key = $request->input('test_secret_key');
	   $live_secret_key = $request->input('live_secret_key');
	//   $site_minimum_withdrawal = $request->input('site_minimum_withdrawal');
	//   $site_referral_commission = $request->input('site_referral_commission');
	//   $site_non_exclusive_commission = $request->input('site_non_exclusive_commission'); 
	 //  $site_exclusive_commission = $request->input('site_exclusive_commission'); 
	  // $two_checkout_mode = $request->input('two_checkout_mode');
	//   $two_checkout_account = $request->input('two_checkout_account');
	 //  $two_checkout_publishable = $request->input('two_checkout_publishable');
	 //  $two_checkout_private = $request->input('two_checkout_private');
	   $paystack_public_key = $request->input('paystack_public_key');
	   $paystack_secret_key = $request->input('paystack_secret_key');
	   $paystack_merchant_email = $request->input('paystack_merchant_email');
	   $local_bank_details = $request->input('local_bank_details');
	   $razorpay_key = $request->input('razorpay_key');
	   $razorpay_secret = $request->input('razorpay_secret');
	 //  $per_sale_referral_commission = $request->input('per_sale_referral_commission');
	   
	   // $request->validate([
				// 			'site_exclusive_commission' => 'required|numeric|min:0',
				// 			'site_extra_fee' => 'required',
				// 			'site_referral_commission' => 'required|numeric|min:0',
				// 			'site_non_exclusive_commission' => 'required|numeric|min:0',
							
							
    //      ]);
		 
		  $sid = $request->input('sid');
		  $itemid = $request->input('itemid');
		 
         
		 
		 $rules = array(
				
				
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator);
		} 
		else
		{
		
			  
		 
		 
		$data = array( 'payment_option' => $payment_method, 'withdraw_option' => $withdraw_method, 'paypal_email' => $paypal_email, 'paypal_mode' => $paypal_mode, 'stripe_mode' => $stripe_mode, 'test_publish_key' => $test_publish_key, 'test_secret_key' => $test_secret_key, 'live_publish_key' => $live_publish_key, 'live_secret_key' => $live_secret_key,'paystack_public_key' => $paystack_public_key, 'paystack_secret_key' => $paystack_secret_key, 'paystack_merchant_email' => $paystack_merchant_email, 'local_bank_details' => $local_bank_details,'vendorstoreId'=>$itemid);
 		$message='';
         if($sid > 0){

            	Vendorpaymentsettings::updatemailData($sid,$data);
            	$message='Payment detail updated successfully';

        }
       else{
            		Vendorpaymentsettings::insertGetId($data);
            		$message='Payment detail inserted successfully !!';
        }
            
		
			//$addition_data = array('razorpay_key' => $razorpay_key, 'razorpay_secret' => $razorpay_secret, 'per_sale_referral_commission' => $per_sale_referral_commission);
			//Settings::updateAdditionData($addition_data);
        return redirect()->back()->with('success', $message);
            
 
       } 
     
       return redirect('/admin/paymentsetting/'.$userId);

    }
	
	/* customer */
	
  
	
	
	
	
}
