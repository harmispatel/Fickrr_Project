<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;

class Pimport extends Model
{

   protected $table = 'products';
   public $timestamps = false;
   protected $fillable = [
            'pro_id',
            'item_token',
            'item_name',
            
            'item_slug',
			'item_desc',
			'item_shortdesc',
			//'item_thumbnail',
			'item_preview',
			//'item_file',
			'item_category',
			'item_category_type',
			'item_type_cat_id',
			'item_type',
			//'latitude',
			//'longitude',
			//'address',
			'regular_price',
			'extended_price',
		//	'compatible_browsers',
		//	'package_includes',
		//	'package_includes_two',
		//	'columns',
			//'layout',
		//	'package_includes_three',
			//'layered',
			//'cs_version',
			//'print_dimensions',
			//'pixel_dimensions',
			//'package_includes_four',
			'demo_url',
			'item_tags',

			'video_preview_type',
			'video_file',
			'video_url',
			'item_tags',
			'item_liked',
			'item_views',
			'free_download',
			'item_featured',
			'weight',
			'length',
			'width',
			'height',
			'manufacturers_id',
			'products_tax_class_id',
			'instock',
			'stock_quantity',
			'sku',
			'virtualp',
			'downloadable',
			
			'item_stafffav',
			'item_sold',
			'tiem_ravybeexc',
			
			'created_item',
			'updated_item',
			
			'drop_status',
			'item_status'
			
      
    ];
   
   
  
  
  
}
