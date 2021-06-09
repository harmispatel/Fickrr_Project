<?php

namespace Fickrr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function view_profile_settings()
    {
        return view('profile-settings');
    }
	
	
	
	public function update_profile(Request $request)
	{
	
	   $name = $request->input('name');
	   $username = $request->input('username');
       $email = $request->input('email');
		 
		 
		 if(!empty($request->input('password')))
		 {
		 $password = bcrypt($request->input('password'));
		 $pass = $password;
		 }
		 else
		 {
		 $pass = $request->input('save_password');
		 }
		 
		 if(!empty($request->input('website')))
		 {
		 $website  = $request->input('website');
		 $website_url = $website;
		 }
		 else
		 {
		 $website_url = "";
		 }
		 $country = $request->input('country');
		 
		 $profile_heading = $request->input('profile_heading');
		 
		 $about = $request->input('about');
		 
		 if(!empty($request->input('facebook_url')))
		 {
		 $facebook_url  = $request->input('facebook_url');
		 $facebook = $facebook_url;
		 }
		 else
		 {
		 $facebook = "";
		 }
		 
		 
		 if(!empty($request->input('twitter_url')))
		 {
		 $twitter_url  = $request->input('twitter_url');
		 $twitter = $twitter_url;
		 }
		 else
		 {
		 $twitter = "";
		 }
		 
		 
		 if(!empty($request->input('gplus_url')))
		 {
		 $gplus_url  = $request->input('gplus_url');
		 $gplus = $gplus_url;
		 }
		 else
		 {
		 $gplus = "";
		 }
		 
		 
		 if(!empty($request->input('item_update_email')))
		 {
		 $item_update_email  = $request->input('item_update_email');
		 $item_update = $item_update_email;
		 }
		 else
		 {
		 $item_update = 0;
		 }
		 
		 
		 if(!empty($request->input('item_comment_email')))
		 {
		 $item_comment_email  = $request->input('item_comment_email');
		 $item_comment = $item_comment_email;
		 }
		 else
		 {
		 $item_comment = 0;
		 }
		 
		 
		 if(!empty($request->input('item_review_email')))
		 {
		 $item_review_email  = $request->input('item_review_email');
		 $item_review = $item_review_email;
		 }
		 else
		 {
		 $item_review = 0;
		 }
		 
		 
		 if(!empty($request->input('buyer_review_email')))
		 {
		 $buyer_review_email  = $request->input('buyer_review_email');
		 $buyer_review = $buyer_review_email;
		 }
		 else
		 {
		 $buyer_review = 0;
		 }
		 
		 
		 
		 if(!empty($request->input('user_freelance')))
		 {
		 $user_freelance  = $request->input('user_freelance');
		 $freelance = $user_freelance;
		 }
		 else
		 {
		 $freelance = 0;
		 }
		 
		 $country_badge = $request->input('country_badge');
		 $exclusive_author = $request->input('exclusive_author');
		 
		 
		 
		 /*  $earnings = $request->input('save_earnings');*/
		 $allsettings = Settings::allSettings();
		  $image_size = $allsettings->site_max_image_size;
		  
		  $id = $request->input('id');
		  
		  $token = $request->input('user_token');
		 
         
		 $request->validate([
							'name' => 'required',
							'username' => 'required',
							'email' => 'required|email',
							'password' => 'confirmed|min:6',
							'user_photo' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							'user_banner' => 'mimes:jpeg,jpg,png,gif|max:'.$image_size,
							
         ]);
		 $rules = array(
				'username' => ['required', 'regex:/^[\w-]*$/', 'max:255', Rule::unique('users') ->ignore($id, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				'email' => ['required', 'email', 'max:255', Rule::unique('users') ->ignore($id, 'id') -> where(function($sql){ $sql->where('drop_status','=','no');})],
				
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
		     
			Members::droPhoto($token); 
		   
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
		  
		 
		 if ($request->hasFile('user_banner')) {
		     
			Members::droBanner($token); 
		   
			$image = $request->file('user_banner');
			$img_name = time() . '456.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/users');
			$imagePath = $destinationPath. "/".  $img_name;
			$image->move($destinationPath, $img_name);
			$user_banner = $img_name;
		  }
		  else
		  {
		     $user_banner = $request->input('save_banner');
		  }
		 
		 
		 
		 
		$data = array('name' => $name, 'username' => $username, 'email' => $email, 'password' => $pass, 'website' => $website_url, 'country' => $country, 'profile_heading' => $profile_heading, 'about' => $about, 'facebook_url' => $facebook, 'twitter_url' => $twitter, 'gplus_url' => $gplus,  'user_photo' => $user_image, 'user_banner' => $user_banner, 'item_update_email' => $item_update, 'item_comment_email' => $item_comment, 'item_review_email' => $item_review, 'buyer_review_email' => $buyer_review, 'updated_at' => date('Y-m-d H:i:s'), 'user_freelance' => $freelance, 'country_badge' => $country_badge, 'exclusive_author' => $exclusive_author);
 
           Members::updateData($token, $data);
           if(!empty($request->input('become-vendor')))
		   {
		   $become_vendor = $request->input('become-vendor');
		      if($become_vendor == 1)
			  {
			     $data_value = array('user_type' => 'vendor');
				 Members::updateData($token, $data_value);
			  }  
		   }
		   else
		   {
			   $become_vendor = 0;
		   } 
		   return redirect()->back()->with('success', 'Update successfully.');
            
 
       } 
     
       
	
	
	}
	
	
	
	
}
