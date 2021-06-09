<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Import;
use Fickrr\Models\Pimport;
use Fickrr\Models\Products;
// use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportProduct implements ToCollection
{
	
   public function collection(Collection $rows)
    {


    	foreach ($rows as $row) {
    	//echo "<pre>";print_r($row);exit;
	    
	    	if($row[0] != 'Type(simple)'){

	        $item_tocken=$this->generateRandomString();

	        $isExist=Manufacturers::viewManufacturerstype($row[41]);
	      //  echo "<pre>";print_r($isExist);exit;
	        $Manufacturers_id=0;
	        if(!empty($isExist)){

	        	$Manufacturers_id=$isExist->id;

	        }else{

	        	//$insert_Data=array('manufacturers_name'=>$row[41],'manufacturers_slug'=>$row[41]);
	        	//$insert_Data=array('name'=>$row[41],'username'=>$row[41]);

	        	//$Manufacturers_id=Manufacturers::insertManufacturers($insert_Data);
	        }

	        $hotel_location1=explode(",",$row[46]);

	        //echo "<pre>";print_r($hotel_location1);exit;
	        $hotel_location=array();
	        if(count($hotel_location1) > 0 && $hotel_location1[0] != ''){


	        	foreach($hotel_location1 as $key=>$value){
	        		$unsafe_str=$value;
	        		if (get_magic_quotes_gpc()){
        					$unsafe_str = mssql_escape(stripslashes($value));
        			}
        			//echo "insafestr".$unsafe_str;

        			$hotels=Items::where('item_name','=',$unsafe_str)->select('item_id')->toSql();
        			//echo $hotels;exit;
	        		$hotels=Items::where('item_name','=',$unsafe_str)->select('item_id')->first();
	        		//echo "<pre>";print_r($hotels);
	        		$hotel_location[]=!empty($hotels) ? $hotels->item_id : '';
	        	}

	        }
	     //  echo "<pre>";print_r($hotel_location);exit;

	        $subcategory1=explode(",",$row[24]);
	        $subcategory=array();

	        if(count($subcategory1) > 0 && $subcategory1[0] != ''){

	        	foreach($subcategory1 as $key=>$value){

	        			$subcategorys=SubCategory::where('subcategory_name','=',$value)->select('subcat_id')->first();
	        			$subcategory[]=!empty($subcategorys) ? $subcategorys->subcat_id : '';
	        	}

	        }




	        $room_type1=explode(",",$row[47]);
	        $room_type=array();
	        if(count($room_type1) > 0 && $room_type1[0] != ''){

	        	foreach($room_type1 as $key=>$value){

	        		$rooms=Roomtype::where('item_type_name','=',$value)->select('item_type_id')->first();
	        		$room_type[]=!empty($rooms) ? $rooms->item_type_id : '';
	        	}

	        }
	        
	        $tagarray1=explode(",",$row[25]);
	        $tagarray=array();
	         if(count($tagarray1) > 0 && $tagarray1[0] != ''){


	         	foreach($tagarray1 as $key=>$value){

	         		$tags=Tag::where('tag_name','=',$value)->select('tag_id')->first();
	         		$tagarray[]=!empty($tags) ? $tags->tag_id : '';
	         	}

	        	//$tagarray=Tag::whereIn('item_type_id',$room_type)->pluck('item_type_id')->toArray();

	        }
	        

	        // $isExist=Taxclass::viewTaxClass($row[11]); // taxclass
	        // $tax_id=0;
	        // if(!empty($isExist)){

	        // 	$tax_id=$isExist->tax_class_id;
	        // }else{
	        // 	$insert_Data=array('tax_class_title'=>$row[11]);
	        // 	$tax_id=Taxclass::insertTaxclass($insert_Data);
	        // }

	         $dropstatus='no';$itemstatus = 1;

	        	if($row[5] == 'yes' || $row[5] == 1){
					$dropstatus = 'yes';
	        	}elseif($row[5] == 'no' || $row[5] == 1){
	        		$dropstatus = 'no';
	        	}

				if($row[3] == 'published' || $row[3] == 1){
					$itemstatus = 1;

	        	}elseif($row[3] == 'unpublished' || $row[3] == 0){
					$itemstatus = 0;
	        	}
					   //

	
 
              $itemsIdd = DB::table('products')->insertGetId([
			//	'user_id'    =>$row[44],
				'sku'=>$row[1],
         		'item_token' =>  $this->generateRandomString(),
         		'item_name' => $row[2],
         		'item_slug' => $row[34],
         		'item_desc' => $row[7],
				'item_shortdesc' => $row[6],
				//'item_thumbnail' => $row[27],
				'item_preview' => $row[27],
				'item_type' => $row[0],
				'regular_price' => $row[23],
				'extended_price' => $row[22], //saleorice
				'demo_url' =>  $row[34],
			//	'item_tags' => $row[25],
				'weight'=>$row[16],
				'length'=>$row[17],
				'width'=>$row[18],
				'height'=>$row[19],
				'manufacturers_id'=>$Manufacturers_id,
				'instock'=>$row[12],
				'stock_quantity'=>$row[48],

				'item_stafffav' => $row[42],
				'tiem_ravybeexc' => $row[43],
				'drop_status' =>$dropstatus,
				'item_status' => $itemstatus,
				
				
				]);

               if(count($subcategory) > 0 && $subcategory[0] != ''){
                
                    //echo $itemdd_id;exit;
                    //$itemsIdd=$request->input('item_id');
                    Products::updateSubcategoryData($subcategory,$itemsIdd);
            	}
            	if(count($hotel_location) > 0 && $hotel_location[0] != ''){
                	//echo $itemdd_id;exit;
               		 //$item_id=$request->input('item_id');
                 	Products::updateProductHotelData($hotel_location,$itemsIdd);
            	}

	            if(count($room_type) > 0 && $room_type[0] != ''){
	                //echo $itemdd_id;exit;
	                //$itemsIdd=$request->input('item_id');
	                Products::updateProductData($room_type,$itemsIdd);
	            }
	            if(count($tagarray) > 0 && $tagarray[0] != ''){

	             		Products::updateProdcutTagData($tagarray,$itemsIdd);
	         	}





        }
    }

         
        
    }
    public function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
   
   
  
  
}
