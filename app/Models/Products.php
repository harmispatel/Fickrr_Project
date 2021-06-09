<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Storage;
use Illuminate\Notifications\Notifiable;
class Products extends Model
{
    
	/* items */
    protected $table = 'products';
	
	public static function saveproductData($data){
        return DB::table('products')->insertGetId($data);
 
    }
    public static function updateitemData($item_token,$data){


    DB::table('products')
      ->where('item_token', $item_token)
      ->update($data);
  }


    public static function updateProductHotelData($data,$item_id){

        DB::table('product_hotel')->where('pro_id', '=', $item_id)->delete(); 
        foreach($data as $key=>$value){
                DB::table('product_hotel')->insert( array(
                    'hotel_id'    =>  $value,
                    'pro_id'   =>   $item_id
                ));
      
        }

    }
    public static function edititemData($token){

            $value = DB::table('products')
              ->where('item_token', $token)
              ->first();
            return $value;
  }

    public function hasManysProducthotel(){
        return $this->hasMany('Fickrr\Models\Producthotel', 'pro_id', 'pro_id');
    }

    public function hasManysProductroom(){
        return $this->hasMany('Fickrr\Models\Productroom', 'pro_id', 'pro_id');
    }

     public function hasManysProductsubcategory(){
        return $this->hasMany('Fickrr\Models\Productsubcategory', 'pro_id', 'pro_id');
    }

     public function hasManysProducttag(){

        return $this->hasMany('Fickrr\Models\Producttag', 'pro_id', 'pro_id');
    }

    public static function admindeleteData($token,$data){
        DB::table('products')
        ->where('item_token', $token)
        ->update($data);
    
  }

   public static function getProductItem(){
    
        $value=Products::with('hasManysProducthotel')->where('item_status','=',1);
        //  $value= $value->where(function( $value){
        $value=   $value->where('item_type','!=','hotel')->Where('item_type','!=','restaurant')
        // })
        ->orderBy('pro_id', 'desc')->get(); 

        return $value;
    
  } 
    public static function singleitemData($item_slug){

        // echo "youitemslug is ".$item_slug;
        $value=Products::with('hasManysProducthotel','hasManysProducthotel')
        ->where('item_status','=',1)
            ->where('drop_status','=','no')
        ->where('item_slug','=',$item_slug)->first(); 
        return $value;
    
    } 
   public function Ratings(){
        return $this->hasMany(Ratings::class, 'or_item_id', 'item_id');
    } 

    public static function  updateProductData($data,$item_id){


  

      DB::table('product_room')->where('pro_id', '=', $item_id)->delete(); 

      foreach($data as $key=>$value){



        DB::table('product_room')->insert( array(
              'pro_id'    =>  $item_id, 
              'item_loccate_id'   =>   $value
        ));
      
    }
     



  }

  public static function saveitemImages($imgdata)
  {
   
      DB::table('product_images')->insert($imgdata);
     
 
  }
   public static function getimagesData($token)
  {

    $value=DB::table('product_images')->where('item_token','=', $token)->orderBy('itm_id', 'desc')->get(); 
    return $value;
  
  }

   public static function deleteimgdata($token){
    
        $image = DB::table('product_images')->where('itm_id', '=', $token)->first();
        $file= $image->item_image;
        $filename = public_path().'/storage/items/'.$file;
        File::delete($filename);
  
        DB::table('product_images')->where('itm_id', '=', $token)->delete();  
  
  
  }

    public static function getorderCount($item_id,$user_id,$order_status){
            // $get=DB::table('item_order')->where('item_id','=', $item_id)->where('user_id','=', $user_id)->where('order_status','=', $order_status)->get();
            // $value = $get->count(); 
            // return $value;

            //$get=Productorder::where('pro_id','=',$item_id)->where('user_id','=', $user_id)->where('order_status','=', $order_status)->get();
            $get=Productorder::where('pro_id','=',$item_id)->where('user_id','=', $user_id)->where('order_status','=', $order_status)->get();
            $value = $get->count(); 
            return $value;


            /*** My Code *** */
            // $get=Productorder::where('user_id','=', $user_id)->where('order_status','=', $order_status)->get();
            // $value = $get->count(); 
            // return $value;

            /*** My Code *** */
  
    }

    public static function savecartData($savedata){


          //DB::table('product_order')->insert($savedata);
      return Productorder::insertGetId($savedata);
  }

   public static function updatecartData($item_id,$user_id,$order_status,$updatedata){



        Productorder::where('order_status', $order_status)->where('pro_id', $item_id)->where('user_id', $user_id)->update($updatedata);

   // Productorder::where('order_status', $order_status)->where('user_id', $user_id)->update($updatedata);
    
  }

  public static function getcartData(){


        $user_id = Auth::user()->id;
        // $value=DB::table('item_order')->join('users','users.id','item_order.item_user_id')->join('items','items.item_id','item_order.item_id')->where('item_order.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('item_order.order_status','=','pending')->orderBy('item_order.ord_id', 'desc')->get(); 
        $value= Productorder::with('hasOneUsers','hasManysProducts')->where('user_id','=',$user_id);
        $value=$value->whereHas('hasManysProducts',function($q){
              $q->where('item_status','=',1)->where('drop_status','=','no');
        })->where('order_status','=','pending')->orderBy('ord_id', 'desc')->get(); 

    // echo "<pre>";print_r($value);
    return $value;
    
  }

   public static function deletecartdata($ord_id){
    
    
    
    DB::table('product_order')->where('ord_id', '=', $ord_id)->delete();   
    
    
  }
   public static function getcartCount()
  {
    // $user_id = Auth::user()->id;
    // $get=DB::table('item_order')->join('users','users.id','item_order.item_user_id')->join('items','items.item_id','item_order.item_id')->where('item_order.user_id','=',$user_id)->where('items.item_status','=',1)->where('items.drop_status','=','no')->where('item_order.order_status','=','pending')->orderBy('item_order.ord_id', 'desc')->get(); 
    // $value = $get->count();
    // return $value;
    
  }

    public static function updateSubcategoryData($subcategorydata,$proid){

         DB::table('product_subcategory')->where('pro_id', '=', $proid)->delete(); 
            foreach($subcategorydata as $key=>$value){
                    DB::table('product_subcategory')->insert( array(
                        'subcategory_id'    =>  $value,
                        'pro_id'   =>   $proid
                    ));
          
            }

    }

     public static function getSelectedCategory($proid){

         return DB::table('product_subcategory')->where('pro_id','=',$proid)->pluck('subcategory_id')->toArray();


    }

    public static function updateProdcutTagData($subcategorydata,$proid){

         DB::table('product_tag')->where('pro_id', '=', $proid)->delete(); 
            foreach($subcategorydata as $key=>$value){
                    DB::table('product_tag')->insert( array(
                        'tag_id'    =>  $value,
                        'pro_id'   =>   $proid
                    ));
          
            }

    }

    public static function getSelectedTag($proid){

      return DB::table('product_tag')->where('pro_id','=',$proid)->pluck('tag_id')->toArray();


    }


   public static function autoSearch($query)
  {

    $value=DB::table('items')->where('item_name', 'LIKE', '%'. $query. '%')->where('drop_status','=','no')->where('item_status','=',1)->orderBy('item_name', 'asc')->get(); 
    return $value;
  
  }
  


  public static function getcheckoutCount($purchase_token,$user_id,$payment_status)
  {

    $get=DB::table('product_checkout')->where('purchase_token','=', $purchase_token)->where('user_id','=', $user_id)->where('payment_status','=', $payment_status)->get();
    $value = $get->count(); 
    return $value;
    
  }
 
   public static function savecheckoutData($savedata)
  {
   
      DB::table('product_checkout')->insert($savedata);
     
 
  }
    public static function singleorderupData($order,$orderdata)
  {
    DB::table('product_order')
      ->where('ord_id', $order)
      ->update($orderdata);
  }

    public static function singleordupdateData($purchased_token,$orderdata)
  {
    DB::table('product_order')
      ->where('purchase_token', $purchased_token)
      ->update($orderdata);
  }
  

  public static function singlecheckoutData($purchased_token,$checkoutdata)
  {
    DB::table('product_checkout')
      ->where('purchase_token', $purchased_token)
      ->update($checkoutdata);
  }
   public static function getcheckoutData($token)
  {

    $value=DB::table('product_checkout')->where('purchase_token','=',$token)->first(); 
    return $value;
    
  }

    public static function getorderData($order)
  {

    $value=DB::table('product_order')->where('ord_id','=',$order)->first(); 
    return $value;
    
  }
   public static function solditemData($token)
  {

    $value=DB::table('products')->where('item_token','=',$token)->first(); 
    return $value;
    
  }

  //  public static function updateitemData($item_token,$data)
  // {
  //   DB::table('products')
  //     ->where('item_token', $item_token)
  //     ->update($data);
  // }
  
  
  public static function singleorderData($order)
  {
    $value = DB::table('product_order')
      ->where('ord_id', $order)
      ->first();
    return $value;
  }


    public static function getfavouriteCount($item_id,$log_user){

        $get=DB::table('items_favorite')->where('item_id','=', $item_id)->where('user_id','=', $log_user)->get();
        $value = $get->count(); 
        return $value;
    
    }
    public static function savefavouriteData($data){
        DB::table('items_favorite')->insert($data);
    }

    public static function updatefavouriteData($item_id,$record){
    
                DB::table('items')
                ->where('item_id', $item_id)
                ->update($record);
    }


    public static function GetAllProducts(){
        $value=DB::table('products')->select('pro_id','item_token','item_name','item_slug','item_desc','item_shortdesc','item_preview','item_thumbnail','item_category','regular_price','extended_price','demo_url','item_tags','weight','length','height','width','backorders','low_stock_amount','sold_individually','manufacturers_id','instock','stock_quantity','sku','downloadable','item_stafffav','tiem_ravybeexc',
            'created_item','updated_item','drop_status','item_status')->get();
        return $value;
    }


  


	
  
  
}
