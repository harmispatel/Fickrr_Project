<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Vendorshop extends Model
{

	// use Notifiable;
	protected $table = 'vendor_shop';

    public $timestamps=false;
  
    protected $fillable = [
        'id',
        'item_id',
        'user_id'
       
    ];


    
  
  
}
