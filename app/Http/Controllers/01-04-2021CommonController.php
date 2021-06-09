<?php

namespace Fickrr\Http\Controllers;

use Illuminate\Http\Request;
use Fickrr\Models\Members;
use Fickrr\Models\Settings;
use Fickrr\Models\Items;
use Fickrr\Models\Blog;
use Fickrr\Models\Users;
use Fickrr\Models\Category;
use Fickrr\Models\Comment;
use Fickrr\Models\Pages;
use Fickrr\Models\Attribute;
use Fickrr\Models\SubCategory;
use Fickrr\Models\Products;
use Fickrr\Models\Tag;

use Fickrr\Models\Productorder;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Validation\Rule;
use URL;
use Illuminate\Support\Facades\Cookie;
use Redirect;
use Storage;
use DB;
use Fickrr\Models\Roomtype;
use Fickrr\Models\Designer;
use Fickrr\Helpers\Helper;
use Fickrr\Models\Itemroom;

use Stevebauman\Location\Facades\Location;


//use Spatie\Sitemap\SitemapGenerator;

class CommonController extends Controller
{
    
	
	public function cookie_translate($id){
	
	  	Cookie::queue(Cookie::make('translate', $id, 3000));
      	return Redirect::back()->withCookie('translate');
	  
	}

	public function manage_allitem(){

		$itemData['item'] = Items::getmanageitemData();
		$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	  	$viewitem['type'] = Items::gettypeItem();
	  	return view('user.manage-allitem',[ 'itemData' => $itemData, 'encrypter' => $encrypter, 'viewitem' => $viewitem]);

	}
	
	
	public function view_start_selling(){

	  	$setting['setting'] = Settings::editSelling();
	  	$data = array('setting' => $setting);
	  	return view('start-selling')->with($data);
	}
	
	
	public function view_preview($item_slug,$item_id){

	   $item['item'] = Items::singleitemData($item_slug,$item_id);
	   $data = array('item' => $item);
	   return view('preview')->with($data);
	}
	public function autoComplete(Request $request) {
	    
        $query = $request->get('term','');
        $products=Items::autoSearch($query);
        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->item_name,'id'=>$product->item_id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
	
	public function not_found(){

	  return view('404');
	}
	
	public function view_new_items(){
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   $data = array('setting' => $setting, 'newest' => $newest);
	   return view('new-releases')->with($data);
	}
	
	
	public function view_tags($type,$slug)
	{
	   $nslug = str_replace("-"," ",$slug);
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_tags', 'LIKE', "%$nslug%")->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   $data = array('setting' => $setting, 'itemData' => $itemData, 'slug' => $slug);
	   return view('tag')->with($data);
	}
	
	
	public function view_featured_items()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_featured','=','yes')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   $data = array('setting' => $setting, 'featured' => $featured);
	   return view('featured-items')->with($data);
	}
	
	public function view_popular_items()
	{
	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->get();
	   $data = array('setting' => $setting, 'popular' => $popular);
	   return view('popular-items')->with($data);
	}
	
	
	public function view_free_items(){
	  
	  $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.free_download','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  
	  
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  
	  if($setting['setting']->site_free_end_date < date("Y-m-d"))
	  {
	     $data = array('free_download' => 0);
		 Items::updateFree($data);
	  }
	  
	  return view('free-items',[ 'free' => $free, 'setting' => $setting]);
	  
	}
	
	
		

    public function view_index()
	{




	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	   $blog['data'] = Blog::homeblogData();
	   $comments = Blog::getgroupcommentData();
	   $review['data'] = Items::homereviewsData();
	   $totalmembers = Members::getmemberData();
	   $totalsales = Items::totalsaleitemCount();
	   $totalfiles = Items::totalfileItems();
	   $total['earning'] = Items::totalearningCount();
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take($setting['setting']->home_popular_items)->get();
	   $flash['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_flash','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_flash_items)->get();
	   $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.free_download','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_free_items)->get();
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();
	   $totalearning = 0;
	   foreach($total['earning'] as $earning)
	   {
	     $totalearning += $earning->total_price;
	   } 


	 //echo "<pre>";print_r( $review['data']);exit;
	   
	   
	   $data = array('blog' => $blog, 'comments' => $comments, 'review' => $review, 'totalmembers' => $totalmembers, 'totalsales' => $totalsales, 'totalfiles' => $totalfiles, 'totalearning' => $totalearning, 'featured' => $featured, 'newest' => $newest, 'free' => $free, 'popular' => $popular, 'flash' => $flash);
	  //SitemapGenerator::create(URL::to('/'))->writeToFile('sitemap.xml');
	  
	  return view('index')->with($data);
	}

	public function view_index1(Request $request){


		// $data = array('user_token'=>"Virat Gandhi");

		//    //  Mail::send('forgot_mail',$data, function($message){
		// 	  //       $message->to('example@gmail.com','Example')->subject('Hello Example, Whats Up');
		// 	  // });
 	// 		Mail::send('forgot_mail', $data, function($message) {
  // 		   $message->to('harmistest@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
  // 		      $message->from('harmistest@gmail.com','Virat Gandhi');
  // 		      });
  		
	

  // 		      echo "HTML Email Sent. Check your inbox.";exit;



		// $ip = \Request::ip();


		// dd($ip);
 		//echo "<pre>";print_r($_SERVER);;

		// echo $_SERVER['HTTP_CLIENT_IP'];;

		$location='';

		$ip=$request->ip();$ip = \Request::getClientIp(true);
        $location = \Location::get($ip);


//echo "<pre>";print_r($clientIP );
    		$zip='380015';;

			$apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 
  //   	 $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
  //   		$result_string = file_get_contents($url);
  // 		$result = json_decode($result_string, true);
  //  		$result['results'][0]['geometry']['location'];
		// echo "<pre>";print_r($result);
     		//$lat= 40.3556714;$lng=-74.9505165;
			$lat= 23.023506299999998 ;$lng=72.5024768;

     	//40.3556714,-74.9505165
        if(!empty($location)){

        	//echo "<pre>";print_r($location);
        	//$location='';
        	$latitude= trim($location->latitude);$longitude=trim($location->longitude);
        	$lat = isset($location->latitude) ?  $location->latitude : 23.0276;
			$lng =isset($location->longitude) ?  $location->longitude : 72.5871;

			//$latitude= 23.023506299999998;$longitude=72.53230239999999;

			// 23.0258,72.5873
			 // $latitude=  23.0258;$longitude=72.5873;
			//$lat =  40.3556714;
			//$lng = -74.9505165;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;
  		 	$location =$json->results[0]->formatted_address;

        }
		



	   $sid = 1;
	   $setting['setting'] = Settings::editGeneral($sid);
	  // $blog['data'] = Blog::homeblogData();
	   $comments = Blog::getgroupcommentData();
	   $review['data'] = Items::homereviewsData();
	   $totalmembers = Members::getmemberData();
	   $totalsales = Items::totalsaleitemCount();
	   $totalfiles = Items::totalfileItems();
	   $total['earning'] = Items::totalearningCount();
	   $featured['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();


	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take($setting['setting']->home_popular_items)->get();
	   $flash['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_flash','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_flash_items)->get();
	   $free['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.free_download','=',1)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_free_items)->get();
	   $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();
	   $totalearning = 0;

//echo "<pre>";print_r($popular['items'] );exit;
	   
	   	foreach($total['earning'] as $earning){
	     	$totalearning += $earning->total_price;
	   	} 


	  // 	$lat= 40.3556714;$lng=-74.9505165;

	  // 	 echo "<pre>";print_r($location);exit;


	   	$circle_radius = 3959;
		$max_distance = 20;

		$t=DB::table("items")

    	->select("item_id"

        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        * cos(radians(latitude)) 

        * cos(radians(longitude) - radians(" . $lng . ")) 

        + sin(radians(" .$lat. ")) 

        * sin(radians(latitude))) AS distance"))

    	->havingRaw("distance < ".$max_distance)

        //->groupBy("posts.id")

        ->get();

		//echo "<pre>";print_r( $t);

        $featured['items']  = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.item_type','=','hotel')->where('items.drop_status','=','no')->select("*"

        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        * cos(radians(latitude)) 

        * cos(radians(longitude) - radians(" . $lng . ")) 

        + sin(radians(" .$lat. ")) 

        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();


    





        // $featured['items']  = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_type','=','hotel')->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();

        //echo "<pre>";print_r($featured['items']);exit;


        $q = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no');


        $q = $q->where(function($q){

           	$q->where('items.item_type','=','restaurant')->orwhere('items.item_type','=','spa');

        })->select("*"

        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        * cos(radians(latitude)) 

        * cos(radians(longitude) - radians(" . $lng . ")) 

        + sin(radians(" .$lat. ")) 

        * sin(radians(latitude))) AS distance"));
        $popular['items']=$q->havingRaw("distance < ".$max_distance)->orderBy('items.item_id', 'desc')->take($setting['setting']->home_featured_items)->get();


        $newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=','restaurant')->select("*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();


        $query = Items::with('hasManysItemhotel')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','!=','product');
        $query= $query->where(function($query){

           	$query->where('items.item_type','=','hotel')->orWhere('items.item_type','=','restaurant')->orWhere('items.item_type','=','spa');

        }) ;


         $itemhotel= $query->whereHas('hasManysItemhotel',function($query) use($lat,$lng,$max_distance){
         	$query->select("hotel_id",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        * cos(radians(latitude)) 

        * cos(radians(longitude) - radians(" . $lng . ")) 

        + sin(radians(" .$lat. ")) 

        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance);
         });
        $itemhotel= $query->pluck('item_id')->toArray();


       //echo "<pre>";print_r($itemhotel);exit;

       // $query=Products::with('ratings','item_hotel')->where('items.item_status','=',1)->where('items.drop_status','=','no');
         $query=Products::with('hasManysProducthotel')
        // ->where('item_status','=',1)
         ->where('drop_status','=','no');
        // $query=$query->whereHas('hasManysProducthotel',function($query) use($itemhotel){
        //  	$query->whereIn('hotel_id',$itemhotel);
        // });
        $query = $query->where('tiem_ravybeexc','=',1)->orderBy('pro_id', 'desc')->take($setting['setting']->site_newest_files)->get();

         //echo "<pre>";print_r($query);exit;

        // $query = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no');
        // $query= $query->where(function($query){
        //    	$query->where('items.item_type','=','product');

        // })
        // ->select("*",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        // * cos(radians(latitude)) 

        // * cos(radians(longitude) - radians(" . $lng . ")) 

        // + sin(radians(" .$lat. ")) 

        // * sin(radians(latitude))) AS distance"))
        // ->havingRaw("distance < ".$max_distance);
        //  $query = $query->where('tiem_ravybeexc','=','1')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();

	  	$rvybe['exclusive']=$query;



        // $query = Items::with('hasManysItemhotel')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','!=','product');
        // $query= $query->where(function($query){

        //    	$query->where('items.item_type','=','hotel')->orWhere('items.item_type','=','restaurant')->orWhere('items.item_type','=','spa');

        // });

        //  $itemhotel= $query->whereHas('hasManysItemhotel',function($query) use($lat,$lng,$max_distance){
        //  	$query->select("hotel_id",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        // * cos(radians(latitude)) 

        // * cos(radians(longitude) - radians(" . $lng . ")) 

        // + sin(radians(" .$lat. ")) 

        // * sin(radians(latitude))) AS distance"))
        // ->havingRaw("distance < ".$max_distance);
        //  })->pluck('item_id')->toArray();


        // echo "<pre>";print_r( $itemhotel);

	   	  // vybes near you withhin 10 miles

	  // 	$newest['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=','restaurant')->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();

			//echo "<pre>";print_r($hotel['items']);exit;

	  	//echo $setting['setting']->site_newest_files;
	
	 // $query=Products::with('hasManysProducthotel')
  //       // ->where('item_status','=',1)
  //        ->where('drop_status','=','no');
  //       // $query=$query->whereHas('hasManysProducthotel',function($query) use($itemhotel){
  //       //  	$query->whereIn('hotel_id',$itemhotel);
  //       // });
  //       $query = $query->where('tiem_ravybeexc','=',1)->orderBy('pro_id', 'desc')->take($setting['setting']->site_newest_files)->get();

	 //   echo "<pre>";print_r($query);exit;
	   
	   $data = array('comments' => $comments, 'review' => $review, 'totalmembers' => $totalmembers, 'totalsales' => $totalsales, 'totalfiles' => $totalfiles, 'totalearning' => $totalearning, 'featured' => $featured, 'newest' => $newest, 'free' => $free, 'popular' => $popular, 'flash' => $flash,'location'=>$location,'rvybe'=>$rvybe);
	  //SitemapGenerator::create(URL::to('/'))->writeToFile('sitemap.xml');
	  
	  return view('user.index1')->with($data);
	}

	public function fetchlocation(Request $request){

		 $latlng=explode(",",$request->input('latlng'));
		 $lat= $latlng[0];
		 $lng= $latlng[1];

		// echo "<pre>";print_r($latlng);

		$lat=$latlng[0] ;$lng=$latlng[1];

		$lat=$request->input('lat');
		$lng=$request->input('lng');


   		//	$lat= 40.3556714;$lng=-74.9505165;

		//$lat= 40.2902141;
		// $lng=-75.0743597;
     	//40.3556714,-74.9505165
        if(!empty($latlng)){
			$latitude=$lat; $longitude=$lng;
			$apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
  		 	$location =$json->results[0]->formatted_address;

  		 	$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$max_distance = 25;


   			$featured['items']  = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.item_type','=','hotel')
   			->where('items.drop_status','=','no')
   			->select("*"

	        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

	        * cos(radians(latitude)) 

	        * cos(radians(longitude) - radians(" . $lng . ")) 

	        + sin(radians(" .$lat. ")) 

	        * sin(radians(latitude))) AS distance"))
       		->havingRaw("distance < ".$max_distance)
        	->orderBy('items.item_id', 'desc')
        //->take($setting['setting']->home_featured_items)
        ->get();



        $hotelhtml=''; $reshtml='';
        if(count($featured['items']) > 0){
        	foreach($featured['items'] as $key=>$featured){

        		$price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);

                $hotelhtml.='<div class="item">';
                 $hotelhtml.='<article class="event-default-wrap">';
                 $hotelhtml.='<div class="event-default">';
                $hotelhtml.='<figure class="event-default-image">';
                    if($featured->item_thumbnail!=''){

                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$imgname=url('/public/storage/items/'.$featured->item_thumbnail);
                    	$hotelhtml.='<a class="event-default-title" href="'.$atag.'">';
                        $hotelhtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                    }else{
                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$hotelhtml.='<a class="event-default-title" href="'.$atag.'">';
                    	$imgname=url('/public/img/no-image.png');;
                    	 $hotelhtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                    }
                           
                           
                           
                           
                          
                    $hotelhtml.=' </figure>';
                    $hotelhtml.=' </div>';
                    $hotelhtml.='  <div class="event-default-inner">';
                    $hreg=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    $hotelhtml.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
                    $hotelhtml.='</div>';
                    $hotelhtml.='</article>';
                 	$hotelhtml.='</div>';

        	}
        }

       $popular['items'] = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=','restaurant')->select("*"

        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')
      //  ->take($setting['setting']->home_featured_items)
        ->get();

         
        if(count($popular['items']) > 0){
        	foreach($popular['items'] as $key=>$featured){

        		$price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);

          

                // $reshtml.='<div class="col-md-3">';
                // $reshtml.='<article class="event-default-wrap">';
                // $reshtml.='<div class="event-default">';
                // $reshtml.='<figure class="event-default-image">';

                // if($featured->item_preview!=''){

                //     	$atag=URL::to('/shopstore/'.$featured->item_slug);
                //     	$imgname=url('/public/storage/items/'.$featured->item_preview);
                //     	$reshtml.='<a class="event-default-title" href="'.$atag.'">';
                //         $reshtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';


                // }else{

                //     	$atag=URL::to('/shopstore/'.$featured->item_slug);
                //     	$reshtml.='<a class="event-default-title" href="'.$atag.'">';
                //     	$imgname=url('/public/img/no-image.png');;
                //     	 $reshtml.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                // }
                           
                           

               	// $reshtml.=' </figure>'; 
                // $reshtml.='</div>';
                // $reshtml.='  <div class="event-default-inner">';
               	// $hreg=URL::to('/shopstore/'.$featured->item_slug);
                // $reshtml.='  <h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
               	// $reshtml.=' </div>';
                // $reshtml.=' </article>';
                // $reshtml.=' </div>';


                	$price = Helper::price_info($featured->item_flash,$featured->regular_price);
               	 $count_rating = Helper::count_rating($featured->ratings);

                $reshtml.='<div class="item">';
                 $reshtml.='<article class="event-default-wrap">';
                 $reshtml.='<div class="event-default">';
                $reshtml.='<figure class="event-default-image">';
                    if($featured->item_thumbnail!=''){

                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$imgname=url('/public/storage/items/'.$featured->item_thumbnail);
                    	$reshtml.='<a class="event-default-title" href="'.$atag.'">';
                        $reshtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                    }else{
                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$reshtml.='<a class="event-default-title" href="'.$atag.'">';
                    	$imgname=url('/public/img/no-image.png');;
                    	 $reshtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                    }
                           
                          
                    $reshtml.=' </figure>';
                    $reshtml.=' </div>';
                    $reshtml.='  <div class="event-default-inner">';
                    $hreg=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    $reshtml.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
                    $reshtml.='</div>';
                    $reshtml.='</article>';
                 	$reshtml.='</div>';

        	}
        }


         $newest['items'] = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=','restaurant')->select("*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();



        $nearbyvybes='';
        if(count($newest['items']) > 0){

        	foreach($newest['items'] as $key=>$featured){


        		$price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);

          

                // $nearbyvybes.='<div class="col-md-3">';
                // $nearbyvybes.='<article class="event-default-wrap">';
               	// $nearbyvybes.='<div class="event-default">';
                // $nearbyvybes.='<figure class="event-default-image">';

                // if($featured->item_preview!=''){

                //     	$atag=URL::to('/shopstore/'.$featured->item_slug);
                //     	$imgname=url('/public/storage/items/'.$featured->item_preview);
                //     	$nearbyvybes.='<a class="event-default-title" href="'.$atag.'">';
                //         $nearbyvybes.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                // }else{
                //     	$atag=URL::to('/shopstore/'.$featured->item_slug);
                //     	$nearbyvybes.='<a class="event-default-title" href="'.$atag.'">';
                //     	$imgname=url('/public/img/no-image.png');;
                //     	 $nearbyvybes.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                // }
                           
                           

               	// $nearbyvybes.=' </figure>'; 
                // $nearbyvybes.='</div>';
               	// $nearbyvybes.='  <div class="event-default-inner">';
               	// $hreg=URL::to('/shopstore/'.$featured->item_slug);
               	// $nearbyvybes.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
               	// $nearbyvybes.=' </div>';
                // $nearbyvybes.=' </article>';
                // $nearbyvybes.=' </div>';




                $nearbyvybes.='<div class="item">';
                 $nearbyvybes.='<article class="event-default-wrap">';
                 $nearbyvybes.='<div class="event-default">';
                $nearbyvybes.='<figure class="event-default-image">';
                      if($featured->item_thumbnail!=''){

                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$imgname=url('/public/storage/items/'.$featured->item_thumbnail);
                    	$nearbyvybes.='<a class="event-default-title" href="'.$atag.'">';
                        $nearbyvybes.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                }else{
                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$nearbyvybes.='<a class="event-default-title" href="'.$atag.'">';
                    	$imgname=url('/public/img/no-image.png');;
                    	 $nearbyvybes.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                }
                      
                           
                          
                    $nearbyvybes.=' </figure>';
                    $nearbyvybes.=' </div>';
                    $nearbyvybes.='  <div class="event-default-inner">';
                    $hreg=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    $nearbyvybes.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
                    $nearbyvybes.='</div>';
                    $nearbyvybes.='</article>';
                 	$nearbyvybes.='</div>';


        	}

        }


         $spa = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=','spa')->select("*"
        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')->take($setting['setting']->site_newest_files)->get();



        $spahtml='';
        if(count($spa) > 0){

        	foreach($spa as $key=>$featured){


        		$price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);

          

             



                $spahtml.='<div class="item">';
                 $spahtml.='<article class="event-default-wrap">';
                 $spahtml.='<div class="event-default">';
                $spahtml.='<figure class="event-default-image">';
                      if($featured->item_thumbnail!=''){

                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$imgname=url('/public/storage/items/'.$featured->item_thumbnail);
                    	$spahtml.='<a class="event-default-title" href="'.$atag.'">';
                        $spahtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                }else{
                    	$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    	$spahtml.='<a class="event-default-title" href="'.$atag.'">';
                    	$imgname=url('/public/img/no-image.png');;
                    	 $spahtml.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                }
                      
                           
                          
                    $spahtml.=' </figure>';
                    $spahtml.=' </div>';
                    $spahtml.='  <div class="event-default-inner">';
                    $hreg=URL::to('/shopstore/'.urlencode($featured->item_slug));
                    $spahtml.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
                    $spahtml.='</div>';
                    $spahtml.='</article>';
                 	$spahtml.='</div>';


        	}

        }



        // $query = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no');
        // $query= $query->where(function($query){

        //    	$query->where('items.item_type','=','product');

        // })->select("*",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        // * cos(radians(latitude)) 

        // * cos(radians(longitude) - radians(" . $lng . ")) 

        // + sin(radians(" .$lat. ")) 

        // * sin(radians(latitude))) AS distance"))
        // ->havingRaw("distance < ".$max_distance);

        //  $query = $query->where('tiem_ravybeexc','=','1')->orderBy('items.item_id', 'desc')->take(2)->get();

        	//$lat= 40.3556714;$lng=-74.9505165;

  //       $lat= 40.2902141;
		// $lng=-75.0743597;
        $query = Items::with('hasManysItemhotel','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no');
        // $query= $query->where(function($query){

        //    	$query->where('items.item_type','=','hotel')->orWhere('items.item_type','=','restaurant')->orWhere('items.item_type','=','spa');

        // });

        $itemhotel= $query->whereHas('hasManysItemhotel',function($query) use($lat,$lng,$max_distance){
         	$query->select(DB::raw("6371 * acos(cos(radians(" . $lat . ")) 

        * cos(radians(latitude)) 

        * cos(radians(longitude) - radians(" . $lng . ")) 

        + sin(radians(" .$lat. ")) 

        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance <= ".$max_distance);
         })->pluck('item_id')->toArray();


        //echo "<pre>";print_r($itemhotel);exit;

       // $query=Products::with('ratings','item_hotel')->where('items.item_status','=',1)->where('items.drop_status','=','no');
         $query=Products::with('hasManysProducthotel')
       //  ->where('item_status','=',1)
         ->where('drop_status','=','no');
        // $query=$query->whereHas('hasManysProducthotel',function($query) use($itemhotel){
        //  	$query->whereIn('hotel_id',$itemhotel);
        // });
        $query = $query->where('tiem_ravybeexc','=','1')->orderBy('pro_id', 'desc')
       // ->take(2)
        ->get();

        $rvybehtml='';

          if(count($query) > 0){

        		foreach($query as $key=>$featured){

        		$price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);


               //  $rvybehtml.='<div class="col-md-6">';
               //  $rvybehtml.='<article class="event-default-wrap">';
               // 	$rvybehtml.='<div class="event-default">';
               //  $rvybehtml.='<figure class="event-default-image">';

               //  if($featured->item_preview!=''){

               //      	$atag=URL::to('/item/'.urlencode($featured->item_slug));
               //      	$imgname=url('/public/storage/items/'.$featured->item_preview);
               //      	$rvybehtml.='<a class="event-default-title" href="'.$atag.'">';
               //          $rvybehtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

               //  }else{
               //      	$atag=URL::to('/item/'.$featured->item_slug);
               //      	$rvybehtml.='<a class="event-default-title" href="'.$atag.'">';
               //      	$imgname=url('/public/img/no-image.png');;
               //      	$rvybehtml.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
               //  }
                           
                           

               // $rvybehtml.=' </figure>'; 
               // $rvybehtml.='</div>';
               // $rvybehtml.='<div class="event-default-inner">';
               // $hreg=URL::to('/item/'.urlencode($featured->item_slug));
               // $rvybehtml.=' <h5><a class="event-default-title" href="'.$hreg.'">f'.$featured->item_name.'</a></h5>';
               // $rvybehtml.=' </div>';
               // $rvybehtml.=' </article>';
               // $rvybehtml.=' </div>';



                $rvybehtml.='<div class="item">';
                $rvybehtml.='<article class="event-default-wrap">';
                $rvybehtml.='<div class="event-default">';
                $rvybehtml.='<figure class="event-default-image">';
                if($featured->item_preview!=''){

                    	$atag=URL::to('/item/'.urlencode($featured->item_slug));
                    	$imgname=url('/public/storage/items/'.$featured->item_preview);
                    	$rvybehtml.='<a class="event-default-title" href="'.$atag.'">';
                        $rvybehtml.='<img src="'.$imgname.'" alt="'.$featured->item_name.'" /> </a>';

                }else{
                    	$atag=URL::to('/item/'.urlencode($featured->item_slug));
                    	$rvybehtml.='<a class="event-default-title" href="'.$atag.'">';
                    	$imgname=url('/public/img/no-image.png');;
                    	$rvybehtml.=' <img src="'.$imgname.'" alt="'.$featured->item_name.'" /></a>';
                }
                     
                      
                           
                          
                    $rvybehtml.=' </figure>';
                    $rvybehtml.=' </div>';
                    $rvybehtml.='  <div class="event-default-inner">';
                    $hreg=URL::to('/item/'.urlencode($featured->item_slug));
                    $rvybehtml.='<h5><a class="event-default-title" href="'.$hreg.'">'.$featured->item_name.'</a></h5>';
                    $rvybehtml.='</div>';
                    $rvybehtml.='</article>';
                 	$rvybehtml.='</div>';



        	}

        }


	  	





        $data=array('hotels'=>$hotelhtml,'location'=>$location,'restaurant'=>$reshtml,'nearbyvybes'=>$nearbyvybes,'rvybe'=>$rvybehtml,'spas'=>$spahtml,'lat'=>$lat,'lng'=>$lng,'hotelid'=>$itemhotel);

        echo json_encode($data);exit;

  		 //	echo $location;exit;

        }

	}
	
	
	public function payment_cancel()
	{
	  return view('cancel');
	}
	

    public function user_verify($user_token)
    {
        $data = array('verified'=>'1');
		$user['user'] = Members::verifyuserData($user_token, $data);
		
		return redirect('login')->with('success','Your e-mail is verified. You can now login.');
    }
	
	public function view_forgot()
	{
	   return view('forgot');
	}
	
	public function view_contact()
	{
	   return view('contact');
	}
	
	
	public function view_reset($token)
	{
	  $data = array('token' => $token);
	  return view('reset')->with($data);
	}
	
	
	public function view_unfollow($unfollow,$my_id,$follow_id)
	{
	  Items::unFollow($my_id,$follow_id);
	  return redirect()->back();
	  
	}
	
	public function view_free_item($download,$item_token)
	{
	
	  $token = base64_decode($item_token);
	  $allsettings = Settings::allSettings();
	  $item['data'] = Items::edititemData($token);
	  $item_count = $item['data']->download_count + 1;
	  $data = array('download_count' => $item_count);
	  Items::updateitemData($token,$data);
	  
	  if($allsettings->site_s3_storage == 1)
	  {
	  $myFile = Storage::disk('s3')->url($item['data']->item_file);
	  $newName = uniqid().time().'.zip';
	  header("Cache-Control: public");
	  header("Content-Description: File Transfer");
	  header("Content-Disposition: attachment; filename=" . basename($newName));
	  header("Content-Type: application/octet-stream");
	  return readfile($myFile);	
	  }
	  else
	  {
	  $filename = public_path().'/storage/items/'.$item['data']->item_file;
	  $headers = ['Content-Type: application/octet-stream'];
      $new_name = uniqid().time().'.zip';
	  return response()->download($filename,$new_name,$headers);
	  }
	  
	 
	
	}
	
	
	
	
	public function view_follow($my_id,$follow_id)
	{
	   $user_id = $follow_id;
	   $followcheck = Items::getfollowuserCheck($user_id);
	   $data = array('follower_user_id' => $my_id, 'following_user_id' => $follow_id);
	   if($followcheck == 0)
	   {
	       Items::saveFollow($data);
	   }
	   else
	   {
	      return redirect()->back();
	   }
	   return redirect()->back();
	   
	}
	
	
	public function view_top_authors()
	{
	  
	  $user['user'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->leftJoin('item_order','item_order.item_user_id','users.id')->leftJoin('country','country.country_id','users.country')->where('users.drop_status','=','no')->where('users.id','!=',1)->orderByRaw('count(*) DESC')->groupBy('item_order.item_user_id')->get();
	  $count_items = Items::getgroupItems();
	  $count_sale = Items::getgroupSale();
	  $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	   $popular['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_views', 'desc')->take(5)->get();
	  $data = array('user' => $user,'count_items' => $count_items, 'count_sale' => $count_sale, 'badges' => $badges, 'category' => $category, 'popular' => $popular);
	  return view('top-authors')->with($data);
	}
	
	
	
	public function view_user_reviews($slug)
	{
	
	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		}
		else
		{
		 $followcheck = 0;
		}
		
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-reviews')->with($data);
	
	}
	
	
	public function view_user_followers($slug)
	{
	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		
		}
		else
		{
		 $followcheck = 0;
		 
		}
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$viewfollowing['view'] = Items::getfollowerView($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		//$viewfollowing['view'] = Follow::with('followers')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('follow.following_user_id','=',$user_id)->orderBy('follow.fid', 'desc')->get();
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'viewfollowing' => $viewfollowing, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-followers')->with($data); 
	  
	}
	
	
	
	public function view_user_following($slug){


	  $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	    $ratingview['list'] = Items::getreviewUser($user_id);
		$countreview = Items::getreviewCountUser($user_id);
		
		if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		
		}
		else
		{
		 $followcheck = 0;
		 
		}
		$followingcount = Items::getfollowingCount($user_id);
		
		$followercount = Items::getfollowerCount($user_id);
		
		$viewfollowing['view'] = Items::getfollowingView($user_id);
		
		$featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
		//$viewfollowing['view'] = Follow::with('followers')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('follow.following_user_id','=',$user_id)->orderBy('follow.fid', 'desc')->get();
		
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'ratingview' => $ratingview, 'countreview' => $countreview, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' =>  $followingcount, 'followercount' => $followercount, 'viewfollowing' => $viewfollowing, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user-following')->with($data); 
	  
	}
	
	
	
	
	
	public function view_user($slug)
	{
	   
	   $user['user'] = Members::getInuser($slug);
	   $user_id = $user['user']->id;
	   
	   /* badges */
	   $sid = 1;
	   $badges['setting'] = Settings::editBadges($sid);
	   $sold['item'] = Items::SoldAmount($user_id);
	   $sold_amount = 0;
	   foreach($sold['item'] as $iter)
	   {
			$sold_amount += $iter->total_price;
	   }
	   $country['view'] = Settings::editCountry($user['user']->country);
	   $membership = date('m/d/Y',strtotime($user['user']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	   $collect_amount = Items::CollectedAmount($user_id);
	   $referral_count = $user['user']->referral_count;
	   /* badges */
	   
	   
	   
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	   
	   
	   $since = date("F Y", strtotime($user['user']->created_at));
	   
	   $getitemcount = Items::getuseritemCount($user_id);
	   
	   $getsalecount = Items::getsaleitemCount($user_id);
	   
	   if (Auth::check())
		{
		$followcheck = Items::getfollowuserCheck($user_id);
		}
		else
		{
		 $followcheck = 0;
		}
	   
	   $followingcount = Items::getfollowingCount($user_id);
	   
	   $followercount = Items::getfollowerCount($user_id);
	   
		  $getreview  = Items::getreviewData($user_id);
		  if($getreview !=0)
		  {
			  $review['view'] = Items::getreviewRecord($user_id);
			  $top = 0;
			  $bottom = 0;
			  foreach($review['view'] as $review)
			  {
				 if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
				 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
				 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
				 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
				 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
				 
				 $top += $value1 + $value2 + $value3 + $value4 + $value5;
				 $bottom += $review->rating;
				 
			  }
			  if(!empty(round($top/$bottom)))
			  {
				$count_rating = round($top/$bottom);
			  }
			  else
			  {
				$count_rating = 0;
			  }
			  
			  
			  
		  }
		  else
		  {
			$count_rating = 0;
			$bottom = 0;
		  }
	   
	   $featured_count = Items::getfeaturedUser($user_id);
	   $free_count = Items::getfreeUser($user_id);
	   $tren_count = Items::getTrendUser($user_id);
	  
	   $data = array('user' => $user, 'since' => $since, 'itemData' => $itemData, 'getitemcount' => $getitemcount, 'getsalecount' => $getsalecount, 'count_rating' => $count_rating, 'bottom' => $bottom, 'getreview' => $getreview, 'followcheck' => $followcheck, 'followingcount' => $followingcount, 'followercount' => $followercount, 'badges' => $badges, 'sold_amount' => $sold_amount, 'country' => $country, 'year' => $year, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'featured_count' => $featured_count, 'free_count' => $free_count, 'tren_count' => $tren_count);
	   return view('user')->with($data);
	}
	
	
	public function send_message(Request $request)
	{
	  $message_text = $request->input('message');
	  $from_email = $request->input('from_email');
	  $from_name = $request->input('from_name');
	  $to_email = $request->input('to_email');
	  $to_name = $request->input('to_name');
	  		
		$record = array('message_text' => $message_text, 'from_name' => $from_name);
		Mail::send('user_mail', $record, function($message) use ($from_name, $from_email, $to_email, $to_name) {
			$message->to($to_email, $to_name)
					->subject('New message received');
			$message->from($from_email,$from_name);
		});
 
        return redirect()->back()->with('success','Your message has been sent successfully');     
		
	
	
	}
	
	
	
	public function update_reset(Request $request)
	{
	
	   $user_token = $request->input('user_token');
	   $password = bcrypt($request->input('password'));
	   $password_confirmation = $request->input('password_confirmation');
	   $data = array("user_token" => $user_token);
	   $value = Members::verifytokenData($data);
	   $user['user'] = Members::gettokenData($user_token);
	   if($value)
	   {
	   
	      $request->validate([
							'password' => 'required|confirmed|min:6',
							
           ]);
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
		   
		   $record = array('password' => $password);
           Members::updatepasswordData($user_token, $record);
           return redirect('login')->with('success','Your new password updated successfully. Please login now.');
		
		}
	   
	   
	   }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	   
	
	}
	
	
	
	public function update_forgot(Request $request)
	{
	   $email = $request->input('email');
	   
	   $data = array("email"=>$email);
 
       $value = Members::verifycheckData($data);
	   $user['user'] = Members::getemailData($email);
       
	   if($value)
	   {
			
		$user_token = $user['user']->user_token;
		$name = $user['user']->name;
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		
		$record = array('user_token' => $user_token);
		Mail::send('forgot_mail', $record, function($message) use ($from_name, $from_email, $email, $name, $user_token) {
			$message->to($email, $name)
					->subject('Forgot Password');
			$message->from($from_email,$from_name);
		});
 
         return redirect('forgot')->with('success','We have e-mailed your password reset link!');     
			  
       }
	   else
	   {
              
			  return redirect()->back()->with('error', 'These credentials do not match our records.');
       }
	   
	  
	   
	   
	   
	}
	
	/* shop */
	
	
	public function view_all_items()
	{
	  /*$itemData['item'] = Items::allitemData();*/
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	  $catData['item'] = Items::getitemcatData();
	  $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  
	  return view('shop',[ 'itemData' => $itemData, 'catData' => $catData, 'category' => $category]);
	  
	}

	public function view_all_items1(Request $request){
		//echo "<pre>";print_r($request->hotelid);
		//echo "<pre>";print_r($request->miles);

		$itemtype=$request->hotelid;
		$miles=$request->miles;
		$roomtypeid=$request->roomtype;
		$product_item=isset($request->product_item_top) ? $request->product_item_top : '';

		$request->vendorid;
		$location='';

		$ip=$request->ip();
        $location = \Location::get($ip);
        $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

    	//  $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
    	// 	$result_string = file_get_contents($url);
  		// $result = json_decode($result_string, true);
   		// $result['results'][0]['geometry']['location'];
		// echo "<pre>";print_r($result['results'][0]['geometry']);

		
        if(!empty($location)){

        	$latitude= $location->latitude;$longitude=$location->longitude;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);

			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;
  		 	$location =$json->results[0]->formatted_address;
        }



          $q= Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=',$itemtype);

        $q=$q->where(function($q)  use($product_item){
        	$q->where('items.item_name', 'LIKE', "%$product_item%")->orwhere('items.item_slug', 'LIKE', "%$product_item%")->orwhere('items.item_desc', 'LIKE', "%$product_item%")->orwhere('items.item_shortdesc', 'LIKE', "%$product_item%");
        });
        $itemData['item'] =$q->orderBy('item_id', 'desc')->get();


       // $query= Products::with('ratings')->where('item_status','=',1);


	 	// $itemData['item'] = $query->where(function($q){

	 	// $q->where('item_type','!=','hotel')->where('item_type','!=','restaurant');

	 	// })->where('drop_status','=','no')->orderBy('pro_id', 'asc')->get();

	  	/*$itemData['item'] = Items::allitemData();*/
	 	// $query= Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1);


	 	// $itemData['item'] = $query->where(function($q){

	 	// $q->where('item_type','!=','hotel')->where('item_type','!=','restaurant');

	 	// })->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();

		//echo "<pre>";print_r( $itemData['item']);exit;

		//  $catData['item'] = Items::getitemcatData();

	   	$roomtype = Roomtype::getRoomTypeData(array());
	   	$tagData = Tag::gettagData();
	    $catData['item'] = array();


	  	$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  	//$roomid=array(11,12,13,14,15,16,17);

	 	//  	$itemId=Items::with('hasManysItemroom','hasOneUser')->whereHas('hasManysItemroom',function($q) use($roomid){
		// 		$q->whereIn('item_loccate_id',$roomid);
		// })->get();


			//echo $roomtype;

		// //echo	$itemidstr=implode(",",$itemId);
		// echo "hi TEst TEST";

		// echo "<pre>";print_r($itemroom);exit;
	  
	  	return view('user.shop1',['itemData' => $itemData, 'catData' => $catData, 'category' => $category,'location'=>$location,'roomtype'=>$roomtype,'tagData'=>$tagData,'itemtype'=>$itemtype,'miles'=>$miles,'roomtypeid'=>$roomtypeid,'product_item'=>$product_item]);
	  
	}

	public function shopview_all_items1(Request $request){



		$vendorid= $request->vendorid;
		$location='';

		$ip=$request->ip();
        $location = \Location::get($ip);
        $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

    	//  $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
    	// 	$result_string = file_get_contents($url);
  		//  $result = json_decode($result_string, true);
   		//  $result['results'][0]['geometry']['location'];
		//  echo "<pre>";print_r($result['results'][0]['geometry']);

		
        if(!empty($location)){

        	$latitude= $location->latitude;$longitude=$location->longitude;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;
  		 	$location =$json->results[0]->formatted_address;

        }

	  	/*$itemData['item'] = Items::allitemData();*/
	 	$query= Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1);


		$q= $query->where(function($q){

	 		$q->where('item_type','!=','hotel')->where('item_type','!=','restaurant');

	 	})->where('items.drop_status','=','no');

		if($vendorid > 0){
		 	 $q=$q->where('user_id',$vendorid);
		}

	
	  	$itemData['item']=$q->orderBy('items.item_id', 'asc')->get();

			//echo "<pre>";print_r( $itemData['item']);exit;

	  	$catData['item'] = Items::getitemcatData();

	    $roomtype = Roomtype::getRoomTypeData(array());


	  	$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  	$roomid=array();

	 

	// echo "<pre>";print_r($roomtype);exit;
	  
return view('user.shop1',['itemData' => $itemData, 'catData' => $catData, 'category' => $category,'location'=>$location,'roomtype'=>$roomtype]);
	  
	}
	
	
	
	public function view_flash_items()
	{
	  
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.item_flash','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  
	  if($setting['setting']->site_flash_end_date < date("Y-m-d"))
	  {
	     $data = array('item_flash' => 0);
		 Items::updateFlash($data);
	  }
	  return view('flash-sale',[ 'itemData' => $itemData, 'setting' => $setting]);
	  
	}
	
	
	
	
	
	
	
	public function view_all_list_items(){

	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	  $catData['item'] = Items::getitemcatData();
	  
	  return view('shop-list',[ 'itemData' => $itemData, 'catData' => $catData]);
	  
	}
	
	
	
	
	public function view_category_types($type,$slug){


	  if($type == 'item-type')
	  {
		  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=',$slug)->orderBy('items.item_id', 'desc')->get();
	  }
	  else
	  {
	    if($type == 'category')
		{
		   $category_data = Category::getcategorysingle($slug);
		   $category_id = $category_data->cat_id;
		}
		else
		{
		  $category_data = Category::getsubcategorysingle($slug);
		  $category_id = $category_data->subcat_id;
		}
	    $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_category_type','=',$type)->where('items.item_category','=',$category_id)->orderBy('items.item_id', 'desc')->get();
	  }
	  
	  $catData['item'] = Items::getitemcatData();
	  $category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	  
	  return view('shop',[ 'itemData' => $itemData, 'catData' => $catData, 'category' => $category]);
	  
	}
	
	
	
	
	
	
	public function view_shop_items(Request $request){


		//echo "<pre>";print_r($request->all());exit;
	  	$product_item = $request->input('product_item');
	  	if(!empty($request->input('category_names'))){
	      
		  $category_no = "";
		  foreach($request->input('category_names') as $category_value)
		  {
		     $category_no .= $category_value.',';
		  }
		  $category_names = rtrim($category_no,",");
		  
	   }
	   else{
	     $category_names = "";
	   }
	  	if(!empty($request->input('item_type'))){
	      
		  $itemtype = "";
		  foreach($request->input('item_type') as $item_type)
		  {
		     $itemtype .= $item_type.',';
		  }
		  $item_types = rtrim($itemtype,",");
		  
	   }
	   else
	   {
	     $item_types = "";
	   } 
	  if(!empty($request->input('orderby')))
	  { 
	  $orderby = $request->input('orderby');
	  }
	  else
	  {
	  $orderby = "desc";
	  }
	  $min_price = $request->input('min_price');
	  $max_price = $request->input('max_price'); 
	  if($product_item != "" ||  $orderby != "" || $min_price != "" || $max_price != "")
	  {
	  $itemData['item'] = Items::with('ratings')
	                      ->leftjoin('users', 'users.id', '=', 'items.user_id')
	                      ->where('items.item_status','=',1)
						  ->where('items.drop_status','=','no')
						  ->where(function ($query) use ($product_item,$orderby,$min_price,$max_price,$item_types,$category_names) { 
						  $query->where('items.item_name', 'LIKE', "%$product_item%");
						  if ($min_price != "" || $max_price != "")
						  {
						  $query->where('items.regular_price', '>', $min_price);
						  $query->where('items.regular_price', '<', $max_price);
						  }
						  if ($item_types != "")
						  {
						  $query->whereRaw('FIND_IN_SET(items.item_type,"'.$item_types.'")');
						  }
						  if ($category_names != "")
						  {
						  $query->whereRaw('FIND_IN_SET(items.item_type_cat_id,"'.$category_names.'")');
						  }
						  })->orderBy('items.regular_price', $orderby)->get();
						  
						  
	  }
	  else
	  {
	   	   
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->get();
	   
	  }
	 	 
	 
	$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();
	$type = "";
	$meta_keyword = "";
	$meta_desc = "";
	
	return view('shop',[ 'itemData' => $itemData, 'category' => $category, 'type' => $type, 'meta_keyword' => $meta_keyword, 'meta_desc' => $meta_desc]);
	}
	
	
	
	
	
	/*public function view_shop_items(Request $request)
	{
	  
	 if(!empty($request->input('product_item')))
	 {
	 $product_item = $request->input('product_item');
	 
	 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_name', 'LIKE', "%$product_item%")->orderBy('items.item_id', 'desc')->get();
	   
	 } 
	 else if(!empty($request->input('category')))
	 {
	 
	 $category = $request->input('category');
	 $split = explode("_", $category);
	 $cat_id = $split[1];
	 $cat_name = $split[0];
	 
	 
	 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_category','=',$cat_id)->where('items.item_category_type','=',$cat_name)->orderBy('items.item_id', 'desc')->get();
	 }
	 else if(!empty($request->input('product_item')) && !empty($request->input('category')))
	 {
	    $product_item = $request->input('product_item');
		$category = $request->input('category');
		 $split = explode("_", $category);
		 $cat_id = $split[1];
		 $cat_name = $split[0];
		 $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_name', 'LIKE', "%$product_item%")->where('items.item_category','=',$cat_id)->where('items.item_category_type','=',$cat_name)->orderBy('items.item_id', 'desc')->get();
	 }
	 else
	 {
	   $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'desc')->get();;
	 }
	 
	 $catData['item'] = Items::getitemcatData();
	
	return view('shop',[ 'itemData' => $itemData, 'catData' => $catData]);
	}*/
	/* shop */
	
	
	/* item */
	
	
	public function view_single_item($item_slug)
	{
	  
	  $sid = 1;
	  $badges['setting'] = Settings::editBadges($sid);
	  
	  $item['item'] = Items::singleitemData($item_slug);
	  $view_count = $item['item']->item_views + 1;
	  $count_data = array('item_views' => $view_count);
	  $item_id = $item['item']->item_id;
	  Items::updatefavouriteData($item_id,$count_data);
	  $membership = date('m/d/Y',strtotime($item['item']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	  $token = $item['item']->item_token;
	  $trends = Items::trendsCount($token);
	  $item_cat_id = $item['item']->item_category;
	  $item_user_id = $item['item']->user_id;
	  $item_cat_type = $item['item']->item_category_type;
	  $country['view'] = Settings::editCountry($item['item']->country);
	  
	  $sold['item'] = Items::SoldAmount($item_user_id);
	  $sold_amount = 0;
	  foreach($sold['item'] as $iter)
	  {
	    $sold_amount += $iter->total_price;
	  }
	  $collect_amount = Items::CollectedAmount($item_user_id);
	  $referral_count = $item['item']->referral_count;
	  
	  
	  
	  if($item_cat_type == 'category')
	  {
	     $category['name'] = Category::getsinglecatData($item_cat_id);
		 $category_name = $category['name']->category_name;
	  }
	  else if($item_cat_type == 'subcategory')
	  {
	    $category['name'] = SubCategory::getsinglesubcatData($item_cat_id);
		$category_name = $category['name']->subcategory_name;
	  }
	  else
	  {
	    $category_name = "";
	  }
	  
	  $item_tags = explode(',',$item['item']->item_tags);
	  
	  $getcount  = Items::getimagesCount($token);
	  $item_image['item'] = Items::getsingleimagesData($token);
	  $item_allimage = Items::getimagesData($token);
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'asc')->take(3)->get();
	  
	  if (Auth::check()) 
	  {
	  $checkif_purchased = Items::ifpurchaseCount($token);
	  }
	  else
	  {
	    $checkif_purchased = 0;
	  }
	  
	  $getreview  = Items::getreviewCount($item_id);
	  if($getreview !=0)
	  {
	      $review['view'] = Items::getreviewView($item_id);
		  $top = 0;
		  $bottom = 0;
		  foreach($review['view'] as $review)
		  {
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom)))
		  {
		    $count_rating = round($top/$bottom);
		  }
		  else
		  {
		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else
	  {
	    $count_rating = 0;
	  }
	  
	  $getreviewdata['view']  = Items::getreviewItems($item_id);
	  
	  	  
	  $comment['view'] = Comment::with('ReplyComment')->leftjoin('users', 'users.id', '=', 'item_comments.comm_user_id')->where('item_comments.comm_item_id','=',$item_id)->orderBy('comm_id', 'asc')->get();
	  
	  $comment_count = $comment['view']->count();
	  
	   
	   $viewattribute['details'] = Attribute::getattributeViews($token);
	   $setting['setting'] = Settings::editGeneral($sid);
	  $page_slug = $setting['setting']->item_support_link;
	  $page['view'] = Pages::editpageData($page_slug);
	  
	  $related['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();
	  
	  $data = array('item' => $item, 'getcount' => $getcount, 'item_image' => $item_image, 'item_allimage' => $item_allimage, 'category_name' => $category_name, 'item_tags' => $item_tags, 'itemData' => $itemData, 'checkif_purchased' => $checkif_purchased, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata, 'comment' => $comment, 'comment_count' => $comment_count, 'badges' => $badges, 'country' => $country, 'trends' => $trends, 'year' => $year, 'sold_amount' => $sold_amount, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'viewattribute' => $viewattribute, 'item_slug' => $item_slug, 'page' => $page, 'related' => $related);
	  return view('item')->with($data);
	}


	public function view_single_item1($item_slug,Request $request)
	{

		$ip=$request->ip();
		$location='';
        $location = \Location::get($ip);
        $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

    	//  $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
    	// 	$result_string = file_get_contents($url);
  		// $result = json_decode($result_string, true);
   		// $result['results'][0]['geometry']['location'];
		//echo "<pre>";print_r($result['results'][0]['geometry']);

		
        if(!empty($location)){

        	$latitude= $location->latitude;$longitude=$location->longitude;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;
  		 	$location =$json->results[0]->formatted_address;
        }
	  
	  	$sid = 1;
	  	$badges['setting'] = Settings::editBadges($sid);
	  	//	echo $item_slug;
	  	$item['item'] = Items::singleitemData($item_slug);
	   	//echo "<pre>";print_r($item['item']);exit;
	  	//	$view_count = $item['item']->item_views + 1;
	  	//	$count_data = array('item_views' => $view_count);
	  	$item_id = $item['item']->item_id;
	 	// 	Items::updatefavouriteData($item_id,$count_data);
	  	$membership = date('m/d/Y',strtotime($item['item']->created_at));
	  	$membership_date = explode("/", $membership);
      	$year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	  	$token = $item['item']->item_token;
	 	$trends = Items::trendsCount($token);
	  	$item_cat_id = $item['item']->item_category;
	  	$item_user_id = $item['item']->user_id;
	  	$item_cat_type = $item['item']->item_category_type;
	  	$country['view'] = Settings::editCountry($item['item']->country);
	  
	  	$sold['item'] = Items::SoldAmount($item_user_id);
	  	$sold_amount = 0;
	  	foreach($sold['item'] as $iter){
	    		$sold_amount += $iter->total_price;
	  	}
	  	$collect_amount = Items::CollectedAmount($item_user_id);
	  	$referral_count = $item['item']->referral_count;
	  
	  
	  if($item_cat_type == 'category'){
	    $category['name'] = Category::getsinglecatData($item_cat_id);
		$category_name = @$category['name']->category_name;
	  }
	  else if($item_cat_type == 'subcategory'){

	    $category['name'] = SubCategory::getsinglesubcatData($item_cat_id);
		$category_name = @$category['name']->subcategory_name;
	  }
	  else{
	    $category_name = "";
	  }
	  
	  $item_tags = explode(',',$item['item']->item_tags);
	  
	  $getcount  = Items::getimagesCount($token);
	  $item_image['item'] = Items::getsingleimagesData($token);
	  $item_allimage = Items::getimagesData($token);
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'asc')->take(3)->get();
	  
	  if (Auth::check()) {
	      $checkif_purchased = Items::ifpurchaseCount($token);
	  }
	  else{
	    $checkif_purchased = 0;
	  }
	  
	  $getreview  = Items::getreviewCount($item_id);
	  if($getreview !=0){


	     $review['view'] = Items::getreviewView($item_id);
		$top = 0;
		$bottom = 0;
		foreach($review['view'] as $review){
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom))){

		    $count_rating = round($top/$bottom);
		  }
		  else{

		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else{

	    	$count_rating = 0;
	  }
	  
	  	$getreviewdata['view']  = Items::getreviewItems($item_id);
	  
	  	  
	  	$comment['view'] = Comment::with('ReplyComment')->leftjoin('users', 'users.id', '=', 'item_comments.comm_user_id')->where('item_comments.comm_item_id','=',$item_id)->orderBy('comm_id', 'asc')->get();
	  
	  	$comment_count = $comment['view']->count();
	  
	   
	   	$viewattribute['details'] = Attribute::getattributeViews($token);
	   	$setting['setting'] = Settings::editGeneral($sid);
	  	$page_slug = @$setting['setting']->item_support_link;
	  	$page['view'] = Pages::editpageData($page_slug);
	
	  	// $related['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();
	   	$allsettings=$setting['setting'];

	   	//echo "<pre>";print_r($item['item']);exit;



	  //  		$query= Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1);


			// $related['items']  = $query->where(function($q){
	 	// 		$q->where('item_type','!=','hotel')->where('item_type','!=','restaurant');

			// })->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->where('items.item_stafffav','=','yes')->inRandomOrder()->take(4)->get();


		$query= Products::with('ratings')->where('item_status','=',1);


		$related['items']  = $query->where(function($q){
	 		$q->where('item_type','!=','hotel')->where('item_type','!=','restaurant')->where('item_type','!=','spa');;

		})->where('drop_status','=','no')->where('pro_id','!=',$item_id)->where('item_stafffav','=','yes')->inRandomOrder()->take(4)->get();



		$item['item']->item_id;
		$item_room_id= Items::getLocationData($item['item']->item_id);


		//echo $item_id;
		$query= Products::with('ratings','hasManysProducthotel','hasManysProductroom')->where('item_status','=',1);



		$hotelRoomProduct  = $query->whereHas('hasManysProducthotel',function($q) use($item_id){
	 		$q->where('hotel_id','=',$item_id);
		})->whereHas('hasManysProductroom',function($q) use($item_room_id){
	 		$q->where('item_loccate_id','=',$item_room_id);
		})->where('drop_status','=','no')->where('pro_id','!=',$item_id)->get();






		//echo "<pre>";print_r($query );exit;

			
		$item_room= Roomtype::getRoomTypeData($item_room_id);
		//cho $item['item']->item_id;



		$shop_item_id=array($item['item']->item_id);

		$designshops=Items::with('hasOneDesignershop')->whereHas('hasOneDesignershop',function($q) use($shop_item_id){
                $q->where('shopitem_id',$shop_item_id);
        })->first();


		$designer=array();
        if(!empty($designshops)){

        	$designid=!empty($designshops->hasOneDesignershop) ? $designshops->hasOneDesignershop : array();

        	//echo "<pre>";print_r($designid);
        	if(!empty($designid)){

        		$designerId=$designid[0]['designer_id'];

        		$designer=Designer::where('id',$designerId)->get();

        	}
        }

		//$designer=Designer::getDesignerDetail(array($item['item']->item_id));

		//echo "<pre>";print_r($designer);exit;
		$itemUser=Users::find($item['item']->user_id);
			
		$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->get();

		$tagData = Tag::gettagData();

		//$mostSold=Productorder::with('hasManysProducts')->where('order_status','=','completed')->get();
		$mostSold=Productorder::withCount('hasManysProducts');
		$mostSold=$mostSold->whereHas('hasManysProducts',function($q){

			//$q->where('item_status','=','1')
			$q->where('drop_status','=','no');

		});

		$mostSold=$mostSold->where('order_status','=','completed')->select('*',\DB::raw('count(pro_id)'))->groupBy('pro_id')->orderBy(\DB::raw('count(pro_id)'),'DESC')->take(5)->get();
		//echo "<pre>";print_r($mostSold);exit;
	  	
	  	$data = array('item' => $item, 'getcount' => $getcount, 'item_image' => $item_image, 'item_allimage' => $item_allimage, 'category_name' => $category_name, 'item_tags' => $item_tags, 'itemData' => $itemData, 'checkif_purchased' => $checkif_purchased, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata, 'comment' => $comment, 'comment_count' => $comment_count, 'badges' => $badges, 'country' => $country, 'trends' => $trends, 'year' => $year, 'sold_amount' => $sold_amount, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'viewattribute' => $viewattribute, 'item_slug' => $item_slug, 'page' => $page, 'related' => $related,'allsettings'=>$allsettings,'item_room'=>$item_room,'designer'=>$designer,'itemuser'=>$itemUser,'hotelRoomProduct'=>$hotelRoomProduct,'category'=>$category,'mostSoldProduct'=>$mostSold,'tagData'=>$tagData);

	  	//	echo "<pre>";print_r($item_category);exit;

	  return view('user.shopstorepage')->with($data);
	}

	public function view_single_shopdesigner($item_slug,Request $request)
	{

		 $location='';
		$ip=$request->ip();
        $location = \Location::get($ip);
        $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

    //     $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
    // 	$result_string = file_get_contents($url);
  		// $result = json_decode($result_string, true);
   		// $result['results'][0]['geometry']['location'];
		//echo "<pre>";print_r($result['results'][0]['geometry']);

        if(!empty($location)){

        	$latitude= $location->latitude;$longitude=$location->longitude;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);

			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;

  		 	$location =$json->results[0]->formatted_address;



        }
	  
	  	$sid = 1;
	  	$badges['setting'] = Settings::editBadges($sid);
	  
	  	$item['item'] = Items::singleitemData($item_slug);

	  	//echo "<pre>";print_r( $item['item']);exit;
	  	$view_count = $item['item']->item_views + 1;
	  	$count_data = array('item_views' => $view_count);
	  	$item_id = $item['item']->item_id;
	  	Items::updatefavouriteData($item_id,$count_data);
	  	$membership = date('m/d/Y',strtotime($item['item']->created_at));
	  	$membership_date = explode("/", $membership);
      	$year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	  	$token = $item['item']->item_token;
	 	$trends = Items::trendsCount($token);
	  	$item_cat_id = $item['item']->item_category;
	  	$item_user_id = $item['item']->user_id;
	  	$item_cat_type = $item['item']->item_category_type;
	  	$country['view'] = Settings::editCountry($item['item']->country);
	  
	  	$sold['item'] = Items::SoldAmount($item_user_id);
	  	$sold_amount = 0;
	  	foreach($sold['item'] as $iter)
	  	{
	    	$sold_amount += $iter->total_price;
	  }
	  $collect_amount = Items::CollectedAmount($item_user_id);
	  $referral_count = $item['item']->referral_count;
	  
	  
	  
	  if($item_cat_type == 'category')
	  {
	     $category['name'] = Category::getsinglecatData($item_cat_id);
		 $category_name = @$category['name']->category_name;
	  }
	  else if($item_cat_type == 'subcategory')
	  {
	    $category['name'] = SubCategory::getsinglesubcatData($item_cat_id);
		$category_name = @$category['name']->subcategory_name;
	  }
	  else
	  {
	    $category_name = "";
	  }
	  
	  $item_tags = explode(',',$item['item']->item_tags);
	  
	  $getcount  = Items::getimagesCount($token);
	  $item_image['item'] = Items::getsingleimagesData($token);
	  $item_allimage = Items::getimagesData($token);
	  $itemData['item'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'asc')->take(3)->get();
	  
	  if (Auth::check()) 
	  {
	  $checkif_purchased = Items::ifpurchaseCount($token);
	  }
	  else
	  {
	    $checkif_purchased = 0;
	  }
	  
	  $getreview  = Items::getreviewCount($item_id);
	  if($getreview !=0)
	  {
	      $review['view'] = Items::getreviewView($item_id);
		  $top = 0;
		  $bottom = 0;
		  foreach($review['view'] as $review)
		  {
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom)))
		  {
		    $count_rating = round($top/$bottom);
		  }
		  else
		  {
		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else
	  {
	    $count_rating = 0;
	  }
	  
	  	$getreviewdata['view']  = Items::getreviewItems($item_id);
	  
	  	  
	  	$comment['view'] = Comment::with('ReplyComment')->leftjoin('users', 'users.id', '=', 'item_comments.comm_user_id')->where('item_comments.comm_item_id','=',$item_id)->orderBy('comm_id', 'asc')->get();
	  
	  	$comment_count = $comment['view']->count();
	  
	   
	   	$viewattribute['details'] = Attribute::getattributeViews($token);
	   	$setting['setting'] = Settings::editGeneral($sid);
	  	$page_slug = $setting['setting']->item_support_link;
	  	$page['view'] = Pages::editpageData($page_slug);
	
	  	// $related['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();
	   	$allsettings=$setting['setting'];



	   		$query= Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1);


			$related['items']  = $query->where(function($q){

	 		$q->where('item_type','!=','hotel')->orwhere('item_type','!=','restaurant');

		})->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->inRandomOrder()->take(4)->get();


			//echo "<pre>";print_r($item);exit;

				 $item_category= Items::getLocationData($item['item']->item_id);
			 $item_category= Items::getLocationDatawithName($item_category);

	  	
	  	$data = array('item' => $item, 'getcount' => $getcount, 'item_image' => $item_image, 'item_allimage' => $item_allimage, 'category_name' => $category_name, 'item_tags' => $item_tags, 'itemData' => $itemData, 'checkif_purchased' => $checkif_purchased, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata, 'comment' => $comment, 'comment_count' => $comment_count, 'badges' => $badges, 'country' => $country, 'trends' => $trends, 'year' => $year, 'sold_amount' => $sold_amount, 'collect_amount' => $collect_amount, 'referral_count' => $referral_count, 'viewattribute' => $viewattribute, 'item_slug' => $item_slug, 'page' => $page, 'related' => $related,'allsettings'=>$allsettings,'location'=>$location,'item_category'=>$item_category);

	  	//echo "<pre>";print_r($allsettings);exit;

	  	//echo "hii TEST";exit;
	  return view('user.shopdesignerpage')->with($data);
	}



	public function view_single_item_product($item_slug,Request $request){

		$ip=$request->ip();
		$location='';
        $location = \Location::get($ip);
        $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

        //  $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($zip).'&sensor=false&key='.$apiKey;
        // 	$result_string = file_get_contents($url);
  		// $result = json_decode($result_string, true);
   		// $result['results'][0]['geometry']['location'];
		// echo "<pre>";print_r($result['results'][0]['geometry']);

		
        if(!empty($location)){

        	$latitude= $location->latitude;$longitude=$location->longitude;
			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
			//echo $json->results[0]->formatted_address;exit;
			//echo "<pre>";print_r($json);exit;

  		 	$location =$json->results[0]->formatted_address;



        }


		$sid = 1;
	  	$badges['setting'] = Settings::editBadges($sid);
	  
	  	$item['item'] = Products::singleitemData($item_slug);

		 //echo "<pre>";print_r(  $item['item']);exit;

	  // $view_count = $item['item']->item_views + 1;
	  // $count_data = array('item_views' => $view_count);
	 $item_id = $item['item']->pro_id;
	  // Items::updatefavouriteData($item_id,$count_data);
	  $membership = date('m/d/Y',strtotime($item['item']->created_at));
	  $membership_date = explode("/", $membership);
      $year = (date("md", date("U", mktime(0, 0, 0, $membership_date[0], $membership_date[1], $membership_date[2]))) > date("md")
		? ((date("Y") - $membership_date[2]) - 1)
		: (date("Y") - $membership_date[2]));
	  
	  $token = $item['item']->item_token;
	  //$trends = Items::trendsCount($token);
	  $item_cat_id = $item['item']->item_category;
	//  $item_user_id = $item['item']->user_id;
	  $item_cat_type = $item['item']->item_category_type;
	 // $country['view'] = Settings::editCountry($item['item']->country);
	  
	//  $sold['item'] = Items::SoldAmount($item_user_id);
	  // $sold_amount = 0;
	  // foreach($sold['item'] as $iter){

	  //   $sold_amount+= $iter->total_price;
	  // }
	 // $collect_amount = Items::CollectedAmount($item_user_id);
	 // $referral_count = $item['item']->referral_count;
	  
	  
	  
	  if($item_cat_type == 'category')
	  {
	     $category['name'] = Category::getsinglecatData($item_cat_id);
		 $category_name = @$category['name']->category_name;
	  }
	  else if($item_cat_type == 'subcategory')
	  {
	    $category['name'] = SubCategory::getsinglesubcatData($item_cat_id);
		$category_name = @$category['name']->subcategory_name;
	  }
	  else
	  {
	    $category_name = "";
	  }
	  
	  $item_tags = explode(',',$item['item']->item_tags);
	  
	  $getcount  = Items::getimagesCount($token);
	  $item_image['item'] = Items::getsingleimagesData($token);
	  $item_allimage = Products::getimagesData($token);
	  $itemData['item'] = Products::with('ratings')->where('item_status','=',1)->where('drop_status','=','no')->where('pro_id','!=',$item_id)->orderBy('pro_id','asc')->take(3)->get();
	  
	  if (Auth::check()) {
	  $checkif_purchased = Items::ifpurchaseCount($token);
	  }
	  else
	  {
	    $checkif_purchased = 0;
	  }
	  
	  $getreview  = Items::getreviewCount($item_id);
	  if($getreview !=0)
	  {
	      $review['view'] = Items::getreviewView($item_id);
		  $top = 0;
		  $bottom = 0;
		  foreach($review['view'] as $review)
		  {
		     if($review->rating == 1) { $value1 = $review->rating*1; } else { $value1 = 0; }
			 if($review->rating == 2) { $value2 = $review->rating*2; } else { $value2 = 0; }
			 if($review->rating == 3) { $value3 = $review->rating*3; } else { $value3 = 0; }
			 if($review->rating == 4) { $value4 = $review->rating*4; } else { $value4 = 0; }
			 if($review->rating == 5) { $value5 = $review->rating*5; } else { $value5 = 0; }
			 
			 $top += $value1 + $value2 + $value3 + $value4 + $value5;
			 $bottom += $review->rating;
			 
		  }
		  if(!empty(round($top/$bottom)))
		  {
		    $count_rating = round($top/$bottom);
		  }
		  else
		  {
		    $count_rating = 0;
		  }
		  
		  
		  
	  }
	  else
	  {
	    $count_rating = 0;
	  }
	  
	  $getreviewdata['view']  = Items::getreviewItems($item_id);
	  
	  	  
	  $comment['view'] = Comment::with('ReplyComment')->leftjoin('users', 'users.id', '=', 'item_comments.comm_user_id')->where('item_comments.comm_item_id','=',$item_id)->orderBy('comm_id', 'asc')->get();
	  
	  $comment_count = $comment['view']->count();
	  
	   
	   $viewattribute['details'] = Attribute::getattributeViews($token);
	   $setting['setting'] = Settings::editGeneral($sid);
	  $page_slug = $setting['setting']->item_support_link;
	  $page['view'] = Pages::editpageData($page_slug);
	  
	  // $related['items'] = Items::with('ratings')->leftjoin('users', 'users.id', '=', 'items.user_id')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.user_id','=',$item_user_id)->where('items.item_id','!=',$item_id)->orderBy('items.item_id', 'desc')->inRandomOrder()->take(4)->get();


	  $query= Products::with('ratings');
	  //->where('item_status','=',1);


	$related['items']  = $query->where(function($q){

	 	$q->where('item_type','!=','hotel')->where('item_type','!=','restaurant');

	 })->where('drop_status','=','no')->where('pro_id','!=',$item_id)->inRandomOrder()->take(4)->get();


	//echo "<pre>";print_r($item_allimage);exit;

	  
	  $data = array('item' => $item, 'getcount' => $getcount, 'item_image' => $item_image, 'item_allimage' => $item_allimage, 'category_name' => $category_name, 'item_tags' => $item_tags, 'itemData' => $itemData, 'checkif_purchased' => $checkif_purchased, 'getreview' => $getreview, 'count_rating' => $count_rating, 'getreviewdata' => $getreviewdata, 'comment' => $comment, 'comment_count' => $comment_count, 'badges' => $badges,  'year' => $year, 'viewattribute' => $viewattribute, 'item_slug' => $item_slug, 'page' => $page, 'related' => $related,'location'=>$location);
	  return view('user.productitem')->with($data);

	}
	
	
	
	/* item */
	
	
	/* contact */
	
	public function update_contact(Request $request)
	{
	
	  $from_name = $request->input('from_name');
	  $from_email = $request->input('from_email');
	  $message_text = $request->input('message_text');
	  $sid = 1;
	  $setting['setting'] = Settings::editGeneral($sid);
	  $admin_name = $setting['setting']->sender_name;
	  $admin_email = $setting['setting']->sender_email;
	  
	  $record = array('from_name' => $from_name, 'from_email' => $from_email, 'message_text' => $message_text, 'contact_date' => date('Y-m-d'));
	  $contact_count = Items::getcontactCount($from_email);
	  if($contact_count == 0)
	  {
	  
	     $request->validate([
							'from_name' => 'required',
							'from_email' => 'required|email',
							'message_text' => 'required',
							'g-recaptcha-response' => 'required|captcha',
							
							
         ]);
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
	  
	  
			  Items::saveContact($record);
			  Mail::send('contact_mail', $record, function($message) use ($admin_name, $admin_email, $from_email, $from_name) {
						$message->to($admin_email, $admin_name)
								->subject('Contact');
						$message->from($from_email,$from_name);
					});
			  return redirect()->back()->with('success','Your message has been sent successfully');
			  
		}	  
			  
	  }
	  else
	  {
	  return redirect()->back()->with('error','Sorry! Your message already sent');
	  }
	  
	  
	
	}
	
	/* contact */
	
	
	/* newsletter */
	
	public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
	return $randomString;
    }
	
	
	public function activate_newsletter($token){
	   
	   $check = Members::checkNewsletter($token);
	   	if($check == 1){
	      
			  $data = array('news_status' => 1);
			  Members::updateNewsletter($token,$data);
			  return redirect('/newsletter')->with('success', 'Thank You! Your subscription has been confirmed!');
		  
	   	}
	   	else{
	       	return redirect('/newsletter')->with('error', 'This email address already subscribed');
	   	}
	
	}
	
	
	public function view_newsletter(){
	  	return view('newsletter');
	}
	
	
	public function update_newsletter(Request $request){
	
	   $news_email = $request->input('news_email');
	   $news_status = 0;
	   $news_token = $this->generateRandomString();
	   $request->validate([
							
							'news_email' => 'required|email',
         ]);
		 $rules = array(
		      'news_email' => ['required',  Rule::unique('newsletter') -> where(function($sql){ $sql->where('news_status','=',0);})],
	     );
		 
		 $messsages = array(
		      
	    );
		 
		$validator = Validator::make($request->all(), $rules,$messsages);
		
		if ($validator->fails()) 
		{
		 $failedRules = $validator->failed();
		 /*return back()->withErrors($validator);*/
		 return redirect()->back()->with('error', 'This email address already subscribed.');
		} 
		else
		{
		
		
		$data = array('news_email' => $news_email, 'news_token' => $news_token, 'news_status' => $news_status);
		
		Members::savenewsletterData($data);
		
		$sid = 1;
		$setting['setting'] = Settings::editGeneral($sid);
		
		$from_name = $setting['setting']->sender_name;
        $from_email = $setting['setting']->sender_email;
		$activate_url = URL::to('/newsletter').'/'.$news_token;
		
		$record = array('activate_url' => $activate_url);
		Mail::send('newsletter_mail', $record, function($message) use ($from_name, $from_email, $news_email) {
			$message->to($news_email)
					->subject('Newsletter');
			$message->from($from_email,$from_name);
		});
		
			   
		return redirect()->back()->with('success', 'Your email address subscribed. You will receive a confirmation email.');
		
		}
	   
	
	}

	 function fetchroomproducthotel(Request $request){

		$roomid=$request->roomid;
		$hotelid=$request->hotelid;

		$tag=isset($request->tag) ? $request->tag : array();

		$catid=isset($request->catid) ? $request->catid :  array();
		$product=isset($request->product)? $request->product :  array();

		// $hotelRoomProduct= Products::with('ratings','hasManysProducthotel','hasManysProductroom','hasManysProductsubcategory')->where('item_status','=',1);


		// $hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProducthotel',function($q) use($hotelid){
	 // 		$q->where('hotel_id','=',$hotelid);
		// });

		// if($roomid > 0){

		// 	$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductroom',function($q) use($roomid){
		// 	 		$q->where('item_loccate_id','=',$roomid);
		// 	});

		// }
	

		// $hotelRoomProduct=$hotelRoomProduct->where('drop_status','=','no');
		// //->where('pro_id','!=',$hotelid);

		// if(count($catid) > 0 && $catid[0] != ''){


		// 		$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductsubcategory',function($q) use($catid) {
	 // 					$q->whereIn('subcategory_id',$catid);
		// 		});

		// 		//$hotelRoomProduct=$hotelRoomProduct->where('item_category','=',$catid);
		// }


		// if(count($product) > 0 && $product[0] != ''){
		// 	$hotelRoomProduct  = $hotelRoomProduct->whereIn('pro_id',$product);
		// }
		// $hotelRoomProductsql=$hotelRoomProduct->tosql();



		$hotelRoomProduct= Products::with('ratings','hasManysProducthotel','hasManysProductroom','hasManysProductsubcategory');
		//->where('item_status','=',1);
		
		if($roomid > 0){
				$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductroom',function($q) use($roomid){
				 		$q->where('item_loccate_id','=',$roomid);
				});
		}
		$hotelRoomProduct=$hotelRoomProduct->where('drop_status','=','no');
		//->where('pro_id','!=',$hotelid);

		if(count($catid) > 0 && $catid[0] != ''){


				$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductsubcategory',function($q) use($catid) {
	 					$q->whereIn('subcategory_id',$catid);
				});

				//$hotelRoomProduct=$hotelRoomProduct->where('item_category','=',$catid);
		}

		if(count($tag) > 0 && $tag[0] != ''){
				$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProducttag',function($q) use($tag) {
	 					$q->whereIn('tag_id',$tag);
				});

				//$hotelRoomProduct=$hotelRoomProduct->where('item_category','=',$catid);
		}

		 if(count($product) > 0 && $product[0] != ''){

		$hotelRoomProduct  = $hotelRoomProduct->where(function($q) use($product,$hotelid){
				if(count($product) > 0 && $product[0] != ''){
					$q  =$q->whereIn('pro_id',$product);
				}
				$q  = $q->whereHas('hasManysProducthotel',function($q) use($hotelid){
					$q->orwhere('hotel_id','=',$hotelid);
		});
				

		});
	}else{
		$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProducthotel',function($q) use($hotelid){
	 		$q->where('hotel_id','=',$hotelid);
		 });

	}
		// if(count($product) > 0 && $product[0] != ''){
		// 	$hotelRoomProduct  = $hotelRoomProduct->whereIn('pro_id',$product);
		// }
		// $hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProducthotel',function($q) use($hotelid){
	 // 		$q->where('hotel_id','=',$hotelid);
		// });

		$hotelRoomProduct=$hotelRoomProduct->get();


		$html1='';
		$html2='';
		if(count($hotelRoomProduct) > 0){


		
       	// $html2.='<div class="section-title text-center mb-4">';
       	// $html2.='<h2>New Products</h2>';
       	//  	$html2.='</div>';
		

         
			foreach($hotelRoomProduct as $key=>$featured){

				$html2.='<div class="col-md-4">';

				 $html2.='<div class="product-card">';
	      		 $html2.='<div class="product-card-img">';
	      			$atag=URL::to('/item/'.urlencode($featured->item_slug));
	      			   if($featured->item_thumbnail!=''){

                            	$itmimg= url('/public/storage/items/'.$featured->item_thumbnail);
                             	$html2.='<a  href="'.$atag.'">';
                                $html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        } else { 

                           		$itmimg= url('/public/img/no-image.png');
                           		$html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        }
                        $html2.='</a>';
                        if(Auth::guest()){

                        	$loginurl=URL::to('/login');
	      					$html2.='<button class="product-card-fav"  onClick="window.location.href=\''.$loginurl.'\'"><i class="ti ti-heart"></i></button>';
	      				}

	      				if(Auth::check()){

	      					$favurl=url('/item').'/'.base64_encode($featured->pro_id).'/favorite/'.base64_encode($featured->item_liked);

	      					$html2.='<button class="product-card-fav"  onClick="addTofav(\''.$favurl.'\')"><i class="ti ti-heart"></i></button>';

	      				}
	      				$html2.='<div class="on-hov-btns">';
	                	$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-eye"></i></a>';

	                	if(Auth::guest()){

	                		$loginurl=URL::to('/login');
	                		$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$loginurl.'"><i class="ti ti-shopping-cart"></i></a>';
	                	}

	                	if (Auth::check()){

                                if(Auth::user()->id != 1){
                                	$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-shopping-cart"></i></a>';
                                }
                                            

	                	}
                                
	               		$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='<div class="product-card-name">';
		      			$html2.='<label><a href="'.$atag.'">'.$featured->item_name.'</a></label>';
		      			$html2.='<span><a href="'.$atag.'">'.$featured->item_slug.'</a></span>';
		      			$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='</div>';

			}
			
			
		}
//,'sql'=>$hotelRoomProductsql
		$data=array('html'=>$html2);
        echo json_encode($data);exit;

	
	}

	public function fetchroomproducthotelshop(Request $request){



		$latlng=explode(",",$request->input('latlng'));
		 $lat= $latlng[0];
		 $lng= $latlng[1];

		// echo "<pre>";print_r($latlng);

		$lat=$latlng[0] ;$lng=$latlng[1];

		$lat=$request->input('lat');
		$lng=$request->input('lng');

		$miles=$request->miles;
		$itemtype=$request->itemtype;
		$roomid=!empty($request->roomid) ? $request->roomid :array() ;




   		//	$lat= 40.3556714;$lng=-74.9505165;

		//$lat= 40.2902141;
		// $lng=-75.0743597;
     	//40.3556714,-74.9505165
        if(!empty($latlng)){
			$latitude=$lat; $longitude=$lng;
			$apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; 

			$geocode = file_get_contents("https://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false&key=".$apiKey);
			$json = json_decode($geocode);
  		 	$location =$json->results[0]->formatted_address;

  		 	$sid = 1;
			$setting['setting'] = Settings::editGeneral($sid);
			$max_distance = $miles;

		

			

			$itemroom=Itemroom::with('hasManyItems')->whereIn('item_loccate_id',$roomid)->pluck('item_room.item_id')->toArray();

			
        $query = Items::with('ratings','hasOneUser')->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('items.item_type','=',$itemtype);

        if(count($itemroom) > 0){
        	$query=$query->whereIn('items.item_id',$itemroom);
        }
        $popular['items']=$query->select("*"

        ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
        * cos(radians(latitude)) 
        * cos(radians(longitude) - radians(" . $lng . ")) 
        + sin(radians(" .$lat. ")) 
        * sin(radians(latitude))) AS distance"))
        ->havingRaw("distance < ".$max_distance)
        ->orderBy('items.item_id', 'desc')
     ->take($setting['setting']->site_item_per_page)
        ->get();

        $html2='';
        if(count($popular['items']) > 0){

        	$html2.='<div class="pprodctrommitem row"> '; 
        	foreach($popular['items'] as $key=>$featured){

        		$html2.='<div class="col-md-3">';

				$html2.='<div class="product-card">';
	      		$html2.='<div class="product-card-img">';
	      		$atag=URL::to('/shopstore/'.urlencode($featured->item_slug));

	      		  if($featured->item_thumbnail!=''){

                            	$itmimg= url('/public/storage/items/'.$featured->item_thumbnail);
                             	$html2.='<a  href="'.$atag.'">';
                                $html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        } else { 

                           		$itmimg= url('/public/img/no-image.png');
                           		$html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        }
                        $html2.='</a>';

                       


	      				$html2.='<div class="on-hov-btns">';

		      			//$aeyetag=url("/item/")
	                	$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-eye"></i></a>';
                                //<button class="like" type="button" onClick="window.location.href='{{ URL::to('/login') }}'"><i class="ti ti-heart"></i></button>
	                 	//$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-shopping-cart"></i></a>';
	               		$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='<div class="product-card-name">';
		      			$html2.='<label><a href="'.$atag.'">'.$featured->item_name.'</a></label>';
		      			$html2.='<span><a href="'.$atag.'">'.$featured->item_slug.'</a></span>';
		      			$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='</div>';

        	}


        }
        
				$html2.='</div>';



      

		}


		echo json_encode(array('rest'=>$html2));exit;


		       // roomid:roomid, //checkbox
         //            hotelid:hotelid,
         //            catid:catid, //checkbox
         //            product:product, //most sold
         //            tag:tag, // checkbox

			$roomid=$request->roomid;
			$hotelid=$request->hotelid;

			$catid=isset($request->catid) ? $request->catid :  array();
			$product=isset($request->product)? $request->product :  array();
			$tag=isset($request->tag)? $request->tag :  array();
		

		$hotelRoomProduct= Products::with('ratings','hasManysProducthotel','hasManysProductroom','hasManysProductsubcategory','hasManysProducttag')->where('item_status','=',1);
	
		if($roomid > 0){

			$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductroom',function($q) use($roomid){
			 		$q->whereIn('item_loccate_id',$roomid);
			});

		}
	

		$hotelRoomProduct=$hotelRoomProduct->where('drop_status','=','no');
		//->where('pro_id','!=',$hotelid);

		if(count($catid) > 0 && $catid[0] != ''){


				$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProductsubcategory',function($q) use($catid) {
	 					$q->whereIn('subcategory_id',$catid);
				});

				//$hotelRoomProduct=$hotelRoomProduct->where('item_category','=',$catid);
		}

		if(count($tag) > 0 && $tag[0] != ''){


				$hotelRoomProduct  = $hotelRoomProduct->whereHas('hasManysProducttag',function($q) use($tag) {
	 					$q->whereIn('tag_id',$tag);
				});

				//$hotelRoomProduct=$hotelRoomProduct->where('item_category','=',$catid);
		}

		// if(count($product) > 0 && $product[0] != ''){
		// 	$hotelRoomProduct  = $hotelRoomProduct->whereIn('pro_id',$product);
		// }
		$hotelRoomProduct=$hotelRoomProduct->get();

		$html1='';
		$html2='';
		if(count($hotelRoomProduct) > 0){

			$html2.='<div class="pprodctrommitem row"> '; 

			foreach($hotelRoomProduct as $key=>$featured){


				$html2.='<div class="col-md-3">';

				 $html2.='<div class="product-card">';
	      		 $html2.='<div class="product-card-img">';
	      			$atag=URL::to('/item/'.urlencode($featured->item_slug));
	      			   if($featured->item_thumbnail!=''){

                            	$itmimg= url('/public/storage/items/'.$featured->item_thumbnail);
                             	$html2.='<a  href="'.$atag.'">';
                                $html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        } else { 

                           		$itmimg= url('/public/img/no-image.png');
                           		$html2.='<img src="'.$itmimg.'" alt="'.$featured->item_name.'">';

                        }
                        $html2.='</a>';

                        if(Auth::guest()){

                        	$loginurl=URL::to('/login');

	      					//$html2.='<a class="product-card-fav" href="'.$loginurl.'"><i class="ti ti-heart"></i></a>';


	      					$html2.='<button class="product-card-fav"  onClick="window.location.href=\''.$loginurl.'\'"><i class="ti ti-heart"></i></button>';
	      				}

	      				if(Auth::check()){

	      					$favurl=url('/item').'/'.base64_encode($featured->pro_id).'/favorite/'.base64_encode($featured->item_liked);

	      					$html2.='<button class="product-card-fav"  onClick="addTofav(\''.$favurl.'\')"><i class="ti ti-heart"></i></button>';

	      				}


	      				$html2.='<div class="on-hov-btns">';

		      			//$aeyetag=url("/item/")
	                	$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-eye"></i></a>';

	                	if(Auth::guest()){

	                		$loginurl=URL::to('/login');
	                		//$html2.='<button class="like" type="button" onClick="window.location.href=\'.$loginurl.\'"><i class="ti ti-shopping-cart"></i></button>'.$loginurl;
	                		$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$loginurl.'"><i class="ti ti-shopping-cart"></i></a>';
	                	}

	                	if (Auth::check()){

	                			// $html2.='<input type="hidden" name="user_id" value="'.Auth::user()->id.'">
                    //             <input type="hidden" name="item_id" value="'.$featured->pro_id.'">
                    //             <input type="hidden" name="item_name" value="'.$featured->item_name.'">
                    //             <input type="hidden" name="item_user_id" value="'.$featured->user_id.'">
                    //             <input type="hidden" name="item_price" value="'.$featured->regular_price.'">
                    //             <input type="hidden" name="item_token" value="'.$featured->item_token.'">';

                                if(Auth::user()->id != 1){
                                	$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-shopping-cart"></i></a>';
                                }
                                            
                                        

	                	}
                                    //<button class="like" type="button" onClick="window.location.href='{{ URL::to('/login') }}'"><i class="ti ti-heart"></i></button>
                       

	                 	//$html2.='<a class="btn btn-light btn-icon btn-shadow font-size-base mx-2" href="'.$atag.'"><i class="ti ti-shopping-cart"></i></a>';
	               		$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='<div class="product-card-name">';
		      			$html2.='<label><a href="'.$atag.'">'.$featured->item_name.'</a></label>';
		      			$html2.='<span><a href="'.$atag.'">'.$featured->item_slug.'</a></span>';
		      			$html2.='</div>';
		      			$html2.='</div>';
		      			$html2.='</div>';


			}


				$html2.='</div>';

		}
		//,'sql'=>$hotelRoomProductsql
		$data=array('html'=>$html2);
        echo json_encode($data);exit;


	}
	
	
	
	
	/* newsletter */
	
	
	
	
}
