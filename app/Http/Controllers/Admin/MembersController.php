<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Items;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	/* customer */
	
    public function customer()
    {
        
		
		$userData['data'] = Members::getuserData();
		return view('admin.customer',[ 'userData' => $userData]);
    }
	
	public function add_customer()
	{
	   
	   return view('admin.add-customer');
	}
	
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
	
	public function save_customer(Request $request)
	{

		//echo "<pre>";print_r($request->all());exit;
 
    
         $name = $request->input('name');
		 $username = $request->input('username');
		 $page_redirect = $request->input('page_redirect');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		// $address = $request->input('address');
		$phonenumber = $request->input('phonenumber');
		$about = $request->input('about');

		$item_shop=isset($request->item_shop) ? $request->item_shop : array();
		$facebook=$request->input('socialmedialinks');
	  	$instagram=$request->input('instagram');
	 	$twitterurl=$request->input('twitterurl');
	  	$youtube=$request->input('youtube');

		 // if(!empty($request->input('earnings'))){
		 // 	$earnings = $request->input('earnings');
   		//       }
		 // else{

		 //   $earnings = 0;
		 // }
		 
		 
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 return back()->withErrors($validator)->withInput();
		} 
		else
		{
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = 1;
		  $token = $this->generateRandomString();
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password,  'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token,'phonenumber'=>$phonenumber,'about'=>$about,'facebook_url'=>$facebook,'twitter_url'=>$twitterurl,'instagram'=>$instagram,'youtube'=>$youtube);
 
            
           $user_id=Members::insertData($data);


            if(count($item_shop) > 0 && $item_shop[0] != ''){
		    		
		    		Members::updateItemShop($item_shop,$user_id);
		    }
            return redirect('/admin/'.$page_redirect)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  
  public function delete_customer($token){

      $get_member = Members::editData($token);
	  $user_id = $get_member->id;
	  
      $data = array('drop_status'=>'yes');
	  
	  $item_data = array('drop_status'=>'yes', 'item_status' => 0);
	  
	  Items::dropItems($item_data,$user_id);
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_customer($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-customer', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_customer(Request $request)
	{
	
		//echo "<pre>";print_r($request->all());exit;
	  	$name = $request->input('name');
	   	$username = $request->input('username');
	   	$page_redirect = $request->input('page_redirect');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
	//	 $address = $request->input('address');
		 $phonenumber = $request->input('phonenumber');
		 $about = $request->input('about');
		 $item_shop=isset($request->item_shop) ? $request->item_shop : array();
		 $user_id=$request->input('user_id');

		$facebook=$request->input('socialmedialinks');
	  	$instagram=$request->input('instagram');
	 	$twitterurl=$request->input('twitterurl');
	  	$youtube=$request->input('youtube');

		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 // if(!empty($request->input('earnings')))
		 // {
		 // $earnings = $request->input('earnings');
   //       }
		 // else
		 // {
		 //   $earnings = 0;
		 // }
		 
		  $token = $request->input('edit_id');
		  
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 	$failedRules = $validator->failed();
		 	return back()->withErrors($validator)->withInput();
		} 
		else
		{
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droPhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else{
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
			$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'),'phonenumber'=>$phonenumber,'about'=>$about,'facebook_url'=>$facebook,'twitter_url'=>$twitterurl,'instagram'=>$instagram,'youtube'=>$youtube);
            
			Members::updateData($token, $data);

			if(count($item_shop) > 0 && $item_shop[0] != ''){
		    		
		    		Members::updateItemShop($item_shop,$user_id);
		    }



            return redirect('/admin/'.$page_redirect)->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* customer */
	
	
	/* vendor */
	
	public function vendor()
    {
        
		$userData['data'] = Members::getvendorData();
		return view('admin.vendor',[ 'userData' => $userData]);
    }
	
	public function add_vendor(){


		$q=Items::with('hasOneUser')->where('item_status','=',1);
		$q=$q->where(function($q){
		 	$q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
		 })->select('item_id','item_name','item_type')->get();

		$data = array('items' => $q);
	   return view('admin.add-vendor')->with($data);;
	}
	
	
	public function edit_vendor($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);

	   	$q=Items::with('hasOneUser')->where('item_status','=',1);
		$q=$q->where(function($q){
		 	$q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
		 })->select('item_id','item_name','item_type')->get();

		$selectedshop= Members::viewVendorshop($edit['userdata']->id);



		$data = array('items' => $q);




	   
	 //  return view('admin.add-vendor')->with($data);;

	   return view('admin.edit-vendor', [ 'edit' => $edit, 'token' => $token,'data'=>$data,'selectedshop'=>$selectedshop]);
	}
	
	/* vendor */
	
    
	
	/* edit profile */
	
	
	public function edit_profile()
    {
        $token = Auth::user()->id;
		$edit['userdata'] = Members::editprofileData($token);
		
		return view('admin.edit-profile', [ 'edit' => $edit, 'token' => $token]);
		
    }
	
	
	
	public function update_profile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 
		 
		  $token = $request->input('edit_id');
		 
         $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
		     
			Members::droprofilePhoto($token); 
		   
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email,'user_type' => $user_type, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'));
 
            
            
			Members::updateprofileData($token, $data);
            return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	/* edit profile */
	
	
	/* administrator */
	
	public function administrator()
    {
        
		
		$userData['data'] = Members::getadminData();
		return view('admin.administrator',[ 'userData' => $userData]);
    }
	
	public function add_administrator()
	{
	   
	   return view('admin.add-administrator');
	}
	
	
	public function save_administrator(Request $request)
	{
 
         $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $password = bcrypt($request->input('password'));
		 $facebook=$request->input('socialmedialinks');
	  	$instagram=$request->input('instagram');
	 	$twitterurl=$request->input('twitterurl');
	  	$youtube=$request->input('youtube');
		  
		 // if(!empty($request->input('earnings')))
		 // {
		 // $earnings = $request->input('earnings');
   //       }
		 // else
		 // {
		 //   $earnings = 0;
		 // }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = "";
		  }
		  $verified = 1;
		  $token = $this->generateRandomString();
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password, 'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token, 'user_permission' => $user_permissions,'facebook_url'=>$facebook,'twitter_url'=>$twitterurl,'instagram'=>$instagram,'youtube'=>$youtube);
 
            
            Members::insertData($data);
            return redirect($page_url)->with('success', 'Insert successfully.');
            
 
       } 
     
    
  }
  
  public function delete_administrator($token){

      $data = array('drop_status'=>'yes');
	  
      Members::deleteData($token,$data);
	  
	  return redirect()->back()->with('success', 'Delete successfully.');

    
  }
  
  public function edit_administrator($token)
	{
	   
	   $edit['userdata'] = Members::editData($token);
	   return view('admin.edit-administrator', [ 'edit' => $edit, 'token' => $token]);
	}
	
	
	public function update_administrator(Request $request)
	{
	
	   $sid = 1;
		 $setting['setting'] = Settings::editGeneral($sid);
		 $site_max_image_size = $setting['setting']->site_max_image_size;
		 $name = $request->input('name');
		 $username = $request->input('username');
         $email = $request->input('email');
		 $user_type = $request->input('user_type');
		 $facebook=$request->input('socialmedialinks');
	  	$instagram=$request->input('instagram');
	 	$twitterurl=$request->input('twitterurl');
	  	$youtube=$request->input('youtube');
		  
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 // if(!empty($request->input('earnings')))
		 // {
		 // $earnings = $request->input('earnings');
   //       }
		 // else
		 // {
		 //   $earnings = 0;
		 // }
		 $page_url = '/admin/administrator';
		 if(!empty($request->input('user_permission')))
	     {
	      
		  $user_permission = "";
		  foreach($request->input('user_permission') as $permission)
		  {
		     $user_permission .= $permission.',';
		  }
		  $user_permissions = rtrim($user_permission,",");
		  
	     }
	     else
	     {
	     $user_permissions = "";
	     }
		 $token = $request->input('user_token');
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'password' => 'min:6',
							'email' => 'required|email',
							'user_photo' => 'mimes:jpeg,jpg,png|max:'.$site_max_image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($token, 'user_token') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) {

		 	$failedRules = $validator->failed();
		 	return back()->withErrors($validator);

		} 
		else{
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$img_name = time() . '.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_image = $img_name;
		  }
		  else
		  {
		     $user_image = $request->input('save_photo');
		  }
		  $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $pass, 'user_photo' => $user_image, 'updated_at' => date('Y-m-d H:i:s'), 'user_permission' => $user_permissions,'facebook_url'=>$facebook,'twitter_url'=>$twitterurl,'instagram'=>$instagram,'youtube'=>$youtube);
          Members::updateData($token, $data);
          return redirect($page_url)->with('success', 'Update successfully.');
            
 
       } 
	
	
	}
  
	
	/* administrator */
	
	
	
	
}
