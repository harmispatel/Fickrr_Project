<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Models\Settings;
use Fickrr\Models\Members;
use Fickrr\Models\Items;
use Fickrr\Models\Attribute;
use Fickrr\Models\Designer;
use Fickrr\Models\Designerimages;
use Fickrr\Models\Designershops;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
/*use Intervention\Image\Image;*/
use Illuminate\Support\Facades\File;
use Fickrr\Http\Controllers\Controller;
use Auth;
use Mail;
use URL;
use Image;
use Storage;
use Illuminate\Support\Str;

use DB;

class DesignerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
		
    }
	
	

	public function view_designer(){


		$item['designer'] = Designer::with('hasManyDesignershops'
		)->get();


	//	echo "<pre>";print_r($item['designer']);exit;
	  	return view('admin.designers')->with($item);

	}
	
	

     public function upload_designer(){
	
		// $q=Items::with('hasOneUser')->where('item_status','=',1);
		// $q=$q->where(function($q){
		// 	$q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant');
		// })->select('item_id','item_name')->get();


		//$data = array('items' => $q);
        return view('admin.upload-designer');
    }


    public function save_designer(Request $request){


	    	$designername = $request->input('designername');
		   	$about = $request->input('about');
		   	$email = $request->input('email');
		   	$facebook = $request->input('socialmedialinks');
		   	$instagram = $request->input('instagram');
		   	$linkedin = $request->input('linkedin');
		   	$youtube = $request->input('youtube');
		 //  	$shops = $request->shops;
		   	$allsettings = Settings::allSettings();
		   	$image_size = $allsettings->site_max_image_size;
		   	$file_size = $allsettings->site_max_file_size;
		   	$watermark = $allsettings->site_watermark;
		   	$url = URL::to("/");
		   	$imagearray = $request->file('images');

		   	//echo "<pre>";print_r($imagearray);exit;
		   	$imagename=array();
		   	if(count($imagearray) > 0){
		   		foreach($imagearray as $image){

		   			$img_name = Str::random(5)."-".date('his')."-".Str::random(3) . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/items');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$imagename[]=$img_name;

		   		}
		   	}

			//echo "<pre>";print_r($imagename);exit;

		   	$data = array('name' =>$designername, 'email' => 	$email, 'about' => 	$about , 'facebook' => $facebook,'instagram'=>$instagram,'linkedin'=>$linkedin,'youtube'=>$youtube);

		   	$id=DB::table('designer')->insertGetId($data);

		   	if($id > 0 && count($imagename) > 0){

		   		foreach($imagename as $key=>$value){

		   				$data=array('designer_id'=>$id,'images'=>$value);
		   				DB::table('designer_images')->insertGetId($data);
		   		}
		   		
		   	}

		   	// if($id > 0 && count($shops) > 0 && $shops[0] != ''){

		   	// 	foreach($shops as $key=>$value){

		   	// 			$data=array('designer_id'=>$id,'shopitem_id'=>$value);
		   	// 			DB::table('designer_shops')->insertGetId($data);
		   	// 	}
		   		
		   	// }

 		$item_approve_status = "Designer inserted successfully.";
		return redirect('/admin/designers')->with('success', $item_approve_status);



    }

    public function edit_designer($id)
	{
	 
	  
		$edit['designer'] = Designer::with('hasManyDesignershops','hasManyDesignerimages')->where('id',$id)->first();

		// $q=Items::with('hasOneUser')->where('item_status','=',1);
		// $q=$q->where(function($q){
		// 	$q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant');
		// })->select('item_id','item_name')->get();


		$data = array('edit' => $edit);
	  
	   return view('admin.edit-designer')->with($data);
	    
	}


	public function update_designer(Request $request){

//echo "<pre>";print_r($request->all());exit;
		$designername = $request->input('designername');
	   	$about = $request->input('about');
	   	$email = $request->input('email');
	   $facebook = $request->input('socialmedialinks');
		$instagram = $request->input('instagram');
		$linkedin = $request->input('linkedin');
		$youtube = $request->input('youtube');
	  //  $shops=$request->shops;
	    $designerid=$request->input('id');

	    $oldimages=$request->input('oldimages');


	    	$allsettings = Settings::allSettings();
		   	$image_size = $allsettings->site_max_image_size;
		   	$file_size = $allsettings->site_max_file_size;
		   	$watermark = $allsettings->site_watermark;
		   	$url = URL::to("/");
		   		$imagearray=array();
		   	$imagearray = !empty($request->file('images')) ? $request->file('images') : array();

		   //	echo "<pre>";print_r($imagearray);exit;
		   	$imagename=array();
		   	if(count($imagearray) > 0){

		   		foreach($imagearray as $image){

		   			$img_name = Str::random(5)."-".date('his')."-".Str::random(3) . '.'.$image->getClientOriginalExtension();
					$destinationPath = public_path('/storage/items');
					$imagePath = $destinationPath. "/".  $img_name;
					$image->move($destinationPath, $img_name);
					$imagename[]=$img_name;

		   		}
		   	}

			//echo "<pre>";print_r($imagename);exit;
		   	$designer=$designerid > 0 ? Designer::find($designerid) : new Designer;
		   	$designer->name=$designername;
		   	$designer->email=$email;
		   	$designer->about=$about;
		   	$designer->facebook=$facebook;
		   	$designer->instagram=$instagram;
		   	$designer->linkedin=$linkedin;
		   	$designer->youtube=$youtube;
		   	$designer->save();

		   	// if($designerid > 0 && count($shops) > 0 && $shops[0] != ''){

		   	// 	Designershops::where('designer_id',$designerid)->delete();
		   	// 	foreach($shops as $key=>$value){
		   	// 			//$data=array('designer_id'=>$designerid,'shopitem_id'=>$value);
		   	// 			//DB::table('designer_shops')->insertGetId($data);
		   	// 			$designershop=new Designershops;
		   	// 			$designershop->designer_id=$designerid;
		   	// 			$designershop->shopitem_id=$value;
		   	// 			$designershop->save();
		   	// 	}
		   		
		   	// }

		   //	$id=DB::table('designer')->insertGetId($data);

		   	if($designerid > 0 && count($imagename) > 0 && $imagename[0] != '') {

		   		Designerimages::whereIn('designer_id',array($designerid))->delete();

		   		foreach($imagename as $key=>$value){

		   				$data=array('designer_id'=>$designerid,'images'=>$value);
		   				DB::table('designer_images')->insertGetId($data);
		   		}
		   		
		   	}

		   

 		$item_approve_status = "Designer updated successfully.";
 		return redirect('/admin/designers')->with('success', $item_approve_status);

	}

	public function delete_designer_request($id){




		Designershops::where('designer_id',$id)->delete();
		Designerimages::whereIn('designer_id',array($id))->delete();
	  
      	Designer::where('id',$id)->delete();
	  
	  	return redirect()->back()->with('success', 'Designer Detail Deleted Successfully.');

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
	
	/*public function item_slug($string){
		   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		   return $slug;
    }*/
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
}
