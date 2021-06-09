<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Itemhotel extends Model
{

	// use Notifiable;
	protected $table = 'item_hotel';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'item_id',
        'hotel_id'
       
    ];

       public function hasOneItems(){

    	//return $this->hasOne(Users::class,'id', 'user_id');
       return $this->hasOne('Fickrr\Models\Items', 'item_id', 'hotel_id');
    }


  
  
  
}
