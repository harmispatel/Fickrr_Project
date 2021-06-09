<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Productimages extends Model
{

	// use Notifiable;
	protected $table = 'product_images';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'item_token',
        'item_image'
       
    ];

       public function hasOneItems(){

    	//return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Items', 'item_id', 'hotel_id');
    }


  
  
  
}
