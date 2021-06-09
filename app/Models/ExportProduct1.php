<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Items;
use Fickrr\Models\Products;
use Fickrr\Models\SubCategory;
use Fickrr\Models\Productroom;
use Maatwebsite\Excel\Concerns\FromCollection;
/*use Maatwebsite\Excel\Concerns\WithHeadings;*/
/*class ExportProduct implements FromCollection, WithHeadings*/
use Illuminate\Support\Collection;
class ExportProduct1 implements FromCollection
{

   protected $table = 'products';
   
   public function collection()
    {
        //return Products::GetAllProducts();

       // echo "<pre>";print_r(Products::GetAllProducts());exit;
    	$prod=Products::GetAllProducts()->toArray();


    	if(count($prod) > 0){
    		foreach($prod as $key=>$value){

    			$selcategoriesarray=Products::getSelectedCategory($value->pro_id);

    			if(count($selcategoriesarray) > 0){

    					$subcat=array();

    					//	foreach($selcategoriesarray as $key=>$value){
    						$subcat=SubCategory::whereIn('subcat_id',$selcategoriesarray)->pluck('subcategory_name')->toArray();
    						$value->item_category=implode(",",$subcat);
    					// }

    			}
    			$seltagarray=Products::getSelectedTag($value->pro_id);
    			if(count($seltagarray) > 0){

    					$tag=array();
    					$tag=Tag::whereIn('tag_id',$seltagarray)->pluck('tag_name')->toArray();
    					$value->item_tags=implode(",",$tag);

    			}

    			$item_manfact= Items::getItemManufactureData($value->pro_id);

    			if(count($item_manfact) > 0){

    					$manfact=array();
    					$manfact=Manufacturers::whereIn('manufacturers_id',$item_manfact)->pluck('manufacturers_name')->toArray();
    					$value->manufacturers_id=implode(",",$manfact);

    			}

    			$itemhotel=Producthotel::with('hasOneProducts')->where('pro_id',$value->pro_id)->pluck('hotel_id')->toArray();
    			$hotelname=array();
    			if(count($itemhotel) > 0){

    				$hotelname=Items::whereIn('item_id',$itemhotel)->pluck('item_name')->toArray();

    			}

    			$value->hotel=implode(",",$hotelname);


    			$itemhotel=Producthotel::with('hasOneProducts')->where('pro_id',$value->pro_id)->pluck('hotel_id')->toArray();
    			$hotelname=array();
    			if(count($itemhotel) > 0){

    				$hotelname=Items::whereIn('item_id',$itemhotel)->pluck('item_name')->toArray();

    			}

    			$value->hotel=implode(",",$hotelname);


    			$itemroom=Productroom::with('hasOneProducts')->where('pro_id',$value->pro_id)->pluck('item_loccate_id')->toArray();
    			$roomname=array();
    			if(count($itemroom) > 0){

    				$roomname=RoomType::whereIn('item_type_id',$itemroom)->pluck('item_type_name')->toArray();

    			}

    			$value->room=implode(",",$roomname);

    			$value->item_desc=html_entity_decode($value->item_desc);
    			$value->item_shortdesc=html_entity_decode($value->item_shortdesc);


    			//$value->pro_id=


    			//item_tags
    			//echo "<pre>";print_r($seltagarray);
    				//selcategoriesarray
    			//echo "<pre>";print_r($selcategoriesarray);exit;
    		}
    	}
	
	$queue = array('pro_id'=>'Product id',
	'item_token'=>'Item token',
	'item_name'=>'Item name',
	'item_slug'=>'Item slug',
	'item_desc'=>'Item description',
	'item_shortdesc'=>'Item short description',
	'item_thumbnail'=>'Item thumbnail',
	'item_preview'=>'Item preview', 
	'item_file'=>'Item file', 
	'item_category'=>'Item category', 
	'item_type'=>'Item Type', 
	'regular_price'=>'Regular price', 
	'extended_price'=>'Extended price', 
	'demo_url'=>'Demo URL', 
	'item_tags'=>'Item Tags', 
	'item_liked'=>'Item liked', 
	'item_views'=>'Item views', 
	'item_stafffav'=>'Item stafffav', 
	'tiem_ravybeexc'=>'Tiem ravybeexc', 
	'created_item'=>'Created item', 
	'updated_item'=>'Updated item', 
	'drop_status'=>'Drop status', 
	'item_status'=>'Item status');

	array_unshift($prod,(object) $queue );
	return Collection::make($prod);

    }
  
    public function headings(): array{




        return [
            'pro_id',
            'item_token',
            'item_name',
            'item_slug',
			'item_desc',
			'item_shortdesc',
			'item_thumbnail',
			'item_preview',
			'item_file',
			'item_category',
		//	'item_category_type',
		//	'item_type_cat_id',
			'item_type',
			'regular_price',
			'extended_price',
		//	'compatible_browsers',
		//	'package_includes',
		//	'package_includes_two',
		//	'columns',
		//	'layout',
		//	'package_includes_three',
		//	'layered',
		//	'cs_version',
		//	'print_dimensions',
		//	'pixel_dimensions',
		//	'package_includes_four',
			'demo_url',
		//	'video_preview_type',
		//	'video_file',
		//	'video_url',
			'item_tags',
			'item_liked',
			'item_views',
			//'free_download',
			'item_stafffav',
			
			//'item_featured',
			//'item_sold',
			'tiem_ravybeexc',
			//'future_update',
		//	'item_support',
			'created_item',
			'updated_item',
		//	'download_count',
		//	'item_flash',
		//	'item_flash_request',
		//	'item_allow_seo',
		//	'item_seo_keyword',
		//	'item_seo_desc',
			'drop_status',
			'item_status',

			
			
        ];
    }

  
}
