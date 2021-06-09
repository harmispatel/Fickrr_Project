<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Productsuborder extends Model
{

	// use Notifiable;
	protected $table = 'product_suborder';

    public $timestamps=false;
  
    protected $fillable = [
        'ord_id',
        'order_id',
        'user_id',
        'pro_id',
        'item_name',
        'item_user_id',
        'item_token',
        'purchase_token',
        'purchase_code',
        'payment_token',
        'payment_type',
        'license',
        'start_date',
        'end_date',
        'coupon_key',
        'coupon_id',
        'coupon_code',
        'coupon_type',
        'coupon_value',
        'discount_price',
        'item_price',
        'vendor_amount',
        'admin_amount',
        'total_price',
        'order_status ',
        'drop_status',
        'approval_status'
       
    ];

     public function hasOneUsers(){

  
       return $this->hasOne('Fickrr\Models\Users', 'id', 'user_id');
    }

     public function hasManysProducts(){
        
        //return $this->hasOne(Users::class,'id', 'user_id');
        return $this->hasMany('Fickrr\Models\Products', 'pro_id', 'pro_id');
    }


    public static function savesubordercartData($savedata){


          //DB::table('product_order')->insert($savedata);
      return Productsuborder::insertGetId($savedata);
  }


    //    public function hasOneItems(){

    // 	//return $this->hasOne(Users::class,'id', 'user_id');
    //    return $this->hasOne('Fickrr\Models\Items', 'item_id', 'hotel_id');
    // }


  
  
  
}
