<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Itemroom extends Model
{

	// use Notifiable;
	protected $table = 'item_room';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'item_id',
        'item_loccate_id'
       
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
