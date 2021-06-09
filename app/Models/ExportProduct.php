<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Items;
use Maatwebsite\Excel\Concerns\FromCollection;
/*use Maatwebsite\Excel\Concerns\WithHeadings;*/
/*class ExportProduct implements FromCollection, WithHeadings*/
use Illuminate\Support\Collection;
class ExportProduct implements FromCollection
{

   protected $table = 'items';
   
   public function collection()
    {
		$items = Items::GetAllProducts()->toArray();
			$header = array(
				'item_id' => 'Item id',
				'user_id' => 'User id',
				'item_token' => 'Item token',
				'item_name' => 'Item name',
				'item_slug' => 'Item slug',
				'item_desc' => 'Item desc',
				'item_shortdesc' => 'Item shortdesc',
				'item_thumbnail' => 'Item thumbnail',
				'item_preview' => 'Item preview',
				'item_file' => 'Item file',
				'item_category' => 'Item category',
				'item_category_type' => 'Item category type',
				'item_type_cat_id' => 'Item type cat id',
				'item_type' => 'Item type',
				'regular_price' => 'Regular price',
				'extended_price' => 'Extended price',
				'compatible_browsers' => 'Compatible browsers',
				'package_includes' => 'Package includes',
				'package_includes_two' => 'Package includes two',
				'columns' => 'Columns',
				'layout' => 'Layout',
				'package_includes_three' => 'Package includes three',
				'layered' => 'Layered',
				'cs_version' => 'CS version',
				'print_dimensions' => 'Print dimensions',
				'pixel_dimensions' => 'Pixel dimensions',
				'package_includes_four' => 'Package includes four',
				'demo_url' => 'Demo url',
				'video_preview_type' => 'Video preview type',
				'video_file' => 'Video file',
				'video_url' => 'Video url',
				'item_tags' => 'Item tags',
				'item_liked' => 'Item liked',
				'item_views' => 'Item views',
				'free_download' => 'Free download',
				'item_stafffav' => 'Item stafffav',
				'item_featured' => 'Item featured',
				'item_sold' => 'Item sold',
				'tiem_ravybeexc' => 'Tiem ravybeexc',
				'future_update' => 'Future update',
				'item_support' => 'Item support',
				'created_item' => 'Vreated item',
				'updated_item' => 'Updated item',
				'download_count' => 'Download count',
				'item_flash' => 'Item flash',
				'item_flash_request' => 'Item flash request',
				'item_allow_seo' => 'Item allow seo',
				'item_seo_keyword' => 'Item seo keyword',
				'item_seo_desc' => 'Item seo desc',
				'drop_status' => 'Drop status',
				'item_status' => 'Item status'
			);
			$items = Items::GetAllProducts()->toArray();
			array_unshift($items,(object) $header );
			return Collection::make($items);
    }
  
    public function headings(): array
    {
        return [
            'item_id',
            'user_id',
            'item_token',
            'item_name',
            'item_slug',
			'item_desc',
			'item_shortdesc',
			'item_thumbnail',
			'item_preview',
			'item_file',
			'item_category',
			'item_category_type',
			'item_type_cat_id',
			'item_type',
			'regular_price',
			'extended_price',
			'compatible_browsers',
			'package_includes',
			'package_includes_two',
			'columns',
			'layout',
			'package_includes_three',
			'layered',
			'cs_version',
			'print_dimensions',
			'pixel_dimensions',
			'package_includes_four',
			'demo_url',
			'video_preview_type',
			'video_file',
			'video_url',
			'item_tags',
			'item_liked',
			'item_views',
			'free_download',
				'item_stafffav',
			
			'item_featured',
			'item_sold',
			'tiem_ravybeexc',
			'future_update',
			'item_support',
			'created_item',
			'updated_item',
			'download_count',
			'item_flash',
			'item_flash_request',
			'item_allow_seo',
			'item_seo_keyword',
			'item_seo_desc',
			'drop_status',
			'item_status',

			
			
        ];
    }

  
}
