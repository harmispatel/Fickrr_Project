<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Itemsimages extends Model
{

	// use Notifiable;
	protected $table = 'items_images';

    public $timestamps=false;
  
    protected $fillable = [
        'item_token',
        'itm_id',
        'item_image'
       
    ];

    public function hasOneItems(){

        //return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Items', 'item_id', 'item_id');
    }

     public function hasManyItems(){

        //return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Items', 'item_id', 'item_id');
    }


   

  
  
  
}
