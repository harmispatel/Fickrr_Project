<?php

namespace Fickrr\Http\Controllers\Admin;

use Fickrr\Http\Controllers\Controller;
use Fickrr\Models\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Fickrr\Models\Members;
use Fickrr\Models\Users;
class ManufacturersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* Manufacturers */

    public function manufacturers()
    {
        $manufacturersData['manufacturers'] = Manufacturers::getManufactureData();
        return view('admin.manufacturers', ['manufacturersData' => $manufacturersData]);
    }

    public function add_manufacturers()
    {
        return view('admin.add-manufacturers');
    }

    public function manufacturers_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }

    public function save_manufacturers(Request $request)
    {

      //  echo "<pre>";print_r($request->all());exit;
        $manufacturers_name = $request->input('name');
        $manufacturers_slug = $this->manufacturers_slug($manufacturers_name);
        $manufacturers_status = $request->input('manufacturers_status');
        $password=bcrypt($manufacturers_name);
            $facebook=$request->input('socialmedialinks');
        $instagram=$request->input('instagram');
        $twitterurl=$request->input('twitterurl');
        $youtube=$request->input('youtube');
        $request->validate([
            'name' => 'required',
            'manufacturers_status' => 'required',
            'email' => 'required',
            'main_phone' => 'required',
            'order_method' => 'required',
            'order_email' => 'required',
        ]);
        $rules = array(
            'name' => ['required', 'max:255', Rule::unique('users')],
        );

        $messsages = array(

        );

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {



            // $manufacturers = new Manufacturers;
            // $manufacturers->manufacturers_name = $manufacturers_name;
            // $manufacturers->manufacturers_slug = $manufacturers_slug;
            // $manufacturers->website = $request->website;
            // $manufacturers->street_address = $request->street_address;
            // $manufacturers->city = $request->city;
            // $manufacturers->state = $request->state;
            // $manufacturers->zip_code = $request->zip_code;
            // $manufacturers->main_phone = $request->main_phone;
            // $manufacturers->email = $request->email;
            // $manufacturers->key_contact_person = $request->key_contact_person;
            // $manufacturers->key_contact_email = $request->key_contact_email;
            // $manufacturers->order_method = $request->order_method;
            // $manufacturers->order_email = $request->order_email;
            // $manufacturers->manufacturers_status = $manufacturers_status;
            if ($request->hasFile('manufacturers_image')) {


                $image = $request->file('manufacturers_image');
                $img_name = time() .'_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/manufacturers');
                $imagePath = $destinationPath . "/" . $img_name;
                $image->move($destinationPath, $img_name);
               // $manufacturers->manufacturers_image = $img_name;
            }
          //  $manufacturers->save();




            $token = $this->generateRandomString();
            $name= $manufacturers_name;
            $username=$manufacturers_name;
            $email= $request->email;
            $user_type='manufacturers';
            $password=$password;
            $user_image=$img_name;
            $verified = 1;
            $phonenumber=$request->main_phone;
            $facebook=$facebook;
            $twitterurl=$twitterurl;
            $instagram=$instagram;
            $youtube=$youtube;

            $data = array('name' => $name, 'username' => $username, 'email' => $email, 'user_type' => $user_type, 'password' => $password,  'user_photo' => $user_image, 'verified' => $verified, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'user_token' => $token,'phonenumber'=>$phonenumber,'facebook_url'=>$facebook,'twitter_url'=>$twitterurl,'instagram'=>$instagram,'youtube'=>$youtube);
 
            
           $user_id=Members::insertData($data);

            $manufacturers = new Manufacturers;
            $manufacturers->manufacturers_id= $user_id;
            $manufacturers->website = $request->website;
            $manufacturers->street_address = $request->street_address;
            $manufacturers->city = $request->city;
            $manufacturers->state = $request->state;
            $manufacturers->zip_code = $request->zip_code;
            $manufacturers->key_contact_person = $request->key_contact_person;
            $manufacturers->key_contact_email = $request->key_contact_email;
            $manufacturers->order_method = $request->order_method;
            $manufacturers->order_email = $request->order_email;
            $manufacturers->manufacturers_status = $manufacturers_status;
            $manufacturers->save();

            return redirect('/admin/manufacturers')->with('success', 'Insert successfully.');
        }
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

    public function delete_manufacturers($manufacturers_id)
    {
        $manufacturers = Manufacturers::find($manufacturers_id);
        $manufacturers->delete();

        return redirect()->back()->with('success', 'Delete successfully.');

    }

    public function edit_manufacturers($manufacturers_id){

        $edit['manufacturers'] = Manufacturers::find($manufacturers_id);
       $edit['users']=Users::find($manufacturers_id);
       //echo "<pre>";print_r( $edit['manufacturers']);
        return view('admin.edit-manufacturers', ['edit' => $edit, 'manufacturers_id' => $manufacturers_id]);
    }

    public function update_manufacturers(Request $request)
    {

        $manufacturers_name = $request->input('name');
        $manufacturers_slug = $this->manufacturers_slug($manufacturers_name);
        $manufacturers_status = $request->input('manufacturers_status');

        $manufacturers_id = $request->input('manufacturers_id');
        $request->validate([
            'name' => 'required',
            'manufacturers_status' => 'required',
            'email' => 'required',
            'main_phone' => 'required',
            'order_method' => 'required',
            'order_email' => 'required',

        ]);
        $rules = array(
            'name' => ['required', 'max:255', Rule::unique('users')->ignore($manufacturers_id, 'id')]
        );

        $messsages = array(

        );

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {

            $manufacturers = Manufacturers::find($manufacturers_id);
         //   $manufacturers->manufacturers_name = $manufacturers_name;
        //    $manufacturers->manufacturers_slug = $manufacturers_slug;
            $manufacturers->website = $request->website;
            $manufacturers->street_address = $request->street_address;
            $manufacturers->city = $request->city;
            $manufacturers->state = $request->state;
            $manufacturers->zip_code = $request->zip_code;
        //    $manufacturers->main_phone = $request->main_phone;
         //   $manufacturers->email = $request->email;
            $manufacturers->key_contact_person = $request->key_contact_person;
            $manufacturers->key_contact_email = $request->key_contact_email;
            $manufacturers->order_method = $request->order_method;
            $manufacturers->order_email = $request->order_email;
            $manufacturers->manufacturers_status = $manufacturers_status;
            if ($request->hasFile('manufacturers_image')) {

                $image = $request->file('manufacturers_image');
                // $img_name = time() . $image->getClientOriginalExtension();
                $img_name = time() .'_'.$image->getClientOriginalName();
                $destinationPath = public_path('/storage/manufacturers');
                $imagePath = $destinationPath . "/" . $img_name;
                $image->move($destinationPath, $img_name);
               // $manufacturers->manufacturers_image = $img_name;

            }else{
                $img_name=$request->old_manufacturers_image;
            }
            $manufacturers->save();

            $facebook=$request->socialmedialinks;
            $twitterurl=$request->twitterurl;
            $instagram=$request->instagram;
            $youtube=$request->youtube;

            $users=Users::find($manufacturers_id);
            $users->name=$manufacturers_name;
             $users->username=$manufacturers_name;
              $users->email= $request->email;
           $users->user_photo=  $img_name;
            $users->facebook_url=  $facebook;
            $users->twitter_url=  $twitterurl;
            $users->youtube=  $youtube;
            $users->instagram=  $instagram;

 

            $users->save();

            return redirect('/admin/manufacturers')->with('success', 'Update successfully.');

        }
    }
}
