<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Itemtype extends Model
{

	// use Notifiable;
	protected $table = 'item_type';

    public $timestamps=false;
  
    protected $fillable = [
        'item_type_id',
        'item_type_name',
        'item_type_slug',
        'item_type_status',
        'item_type_drop_status'
       
    ];

   

 
     
 


  
  
}
