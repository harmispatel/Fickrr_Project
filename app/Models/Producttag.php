<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Producttag extends Model
{
    
	
	protected $table = 'product_tag';
	protected $fillable  =  
				[
                        'id',
                        'tag_id',
						'pro_id'
                ];
  
  
}
