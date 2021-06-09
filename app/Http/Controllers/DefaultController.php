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

class DefaultController extends Controller
{
    
	
	public function autoComplete(Request $request) {
	    
        $query = $request->get('term','');
        $products=Products::autoSearch($query);
        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->item_name,'id'=>$product->item_id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
	


	public function view_shop_items(Request $request){


		//echo "<pre>";print_r($request->all());exit;
	  	$product_item = $request->input('product_item');
	  	$itemtype=$request->hotelid;
		$miles=$request->miles;
		$roomtypeid=$request->roomtype;

	  	// if(!empty($request->input('category_names'))){
	      
		  // $category_no = "";
		  // foreach($request->input('category_names') as $category_value)
		  // {
		  //    $category_no .= $category_value.',';
		  // }
		  // $category_names = rtrim($category_no,",");
		  
	   // }
	   // else{
	   //   $category_names = "";
	   // }
	  	// if(!empty($request->input('item_type'))){
	      
		  // $itemtype = "";
		  // foreach($request->input('item_type') as $item_type)
		  // {
		  //    $itemtype .= $item_type.',';
		  // }
		  // $item_types = rtrim($itemtype,",");
		  
	   // }
	   // else
	   // {
	   //   $item_types = "";
	   // } 
	  if(!empty($request->input('orderby')))
	  { 
	  $orderby = $request->input('orderby');
	  }
	  else
	  {
	  $orderby = "desc";
	  }
	//  $min_price = $request->input('min_price');
	//  $max_price = $request->input('max_price'); 
	  $min_price=0;
	  $max_price=0;
	  $itemtype='';
	 
	  $category_names	='';
	  if($product_item != "" ||  $orderby != "" )
	  {
	  					$itemData['item'] = Items::with('ratings')
	                      ->leftjoin('users', 'users.id', '=', 'items.user_id')
	                      ->where('items.item_status','=',1)
						  ->where('items.drop_status','=','no')
						  ->where(function($query) use($product_item){
						  	  $query->where('items.item_name', 'LIKE', "%$product_item%")->orwhere('items.item_slug', 'LIKE', "%$product_item%")->orwhere('items.item_desc', 'LIKE', "%$product_item%")->orwhere('items.item_shortdesc', 'LIKE', "%$product_item%");
						  })
						  ->where(function ($query) use ($product_item,$orderby,$min_price,$max_price,$itemtype,$category_names) { 
						
						  if ($min_price != "" || $max_price != "")
						  {
						 		// $query->where('items.regular_price', '>', $min_price);
								//  $query->where('items.regular_price', '<', $max_price);
						  }
						  if ($itemtype != "")
						  {
						  $query->whereRaw('FIND_IN_SET(items.item_type,"'.$itemtype.'")');
						  }
						  if ($category_names != "")
						  {
						  	$query->whereRaw('FIND_IN_SET(items.item_type_cat_id,"'.$category_names.'")');
						  }
						  })->orderBy('items.regular_price', $orderby)->get();
						  
						  
	  }
	  else
	  {
	   	   
	  $itemData['item'] = Items::with('ratings')->where('items.item_status','=',1)->where('items.drop_status','=','no')->orderBy('items.item_id', 'asc')->take(1)->get();
	   
	  }
	 	 

	 	$roomtype = Roomtype::getRoomTypeData(array());
	   	$tagData = Tag::gettagData();
	    $catData['item'] = array();
	 
		$category['view'] = Category::with('SubCategory')->where('category_status','=','1')->where('drop_status','=','no')->orderBy('menu_order','asc')->take(1)->get();
		$type = "";
		$meta_keyword = "";
		$meta_desc = "";
	
	return view('user.shop1',[ 'itemData' => $itemData, 'category' => $category, 'type' => $type, 'meta_keyword' => $meta_keyword, 'meta_desc' => $meta_desc,'roomtype'=>$roomtype,'tagData'=>$tagData,'itemtype'=>$itemtype,'product_item'=>$product_item,'roomtypeid'=>$roomtypeid]);
	}
	
	
	
	
	/* newsletter */
	
	
	
	
}
