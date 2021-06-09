<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Productsubcategory extends Model
{
    
	/* category */
	
	protected $table = 'product_subcategory';
	protected $fillable     =   [
                                    'id',
                                    'subcategory_id',
									'pro_id'
                                ];
  
  
 
  
}
