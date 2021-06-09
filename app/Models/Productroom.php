<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Productroom extends Model
{

	// use Notifiable;
	protected $table = 'product_room';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'pro_id',
        'item_loccate_id'
       
    ];

    public function hasOneProducts(){

    //return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Products', 'pro_id', 'pro_id');
    }


  
  
  
}
