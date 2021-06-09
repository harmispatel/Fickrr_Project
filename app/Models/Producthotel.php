<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Producthotel extends Model
{

	// use Notifiable;
	protected $table = 'product_hotel';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'pro_id',
        'hotel_id'
       
    ];

       public function hasOneProducts(){

    	//return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Products', 'pro_id', 'hotel_id');
    }


  
  
  
}
