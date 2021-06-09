<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Auth;
use Fickrr\Models\Import;
use Fickrr\Models\Items;
use Fickrr\Models\Itemtype;
//use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Fickrr\Models\Roomtype;

class ImportItem implements ToCollection
{


    public function collection(Collection $rows)
    {


    		

        	foreach ($rows as $row) {


        		if($row[0] != 'item_name'){

        		$apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE';
	    		$address=''; // Google maps now requires an API key.;
	    		$address=$row[5];
            	// Get JSON results from this request
	    		$latitude='';
            	$longitude='';
            	if(!empty($address)){


		            	$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
		            	$geo = json_decode($geo, true); // Convert the JSON to an array
	            	
			            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
			              $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
			              $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
			            }
	        	}
	        	 $item_tocken=$this->generateRandomString();

	        	 $roomType=array();
	        	 $roomType=explode(",",$row[15]);

	        	 if(count($roomType) > 0){


	        	 	$item_type_id=array();

	        	 	foreach($roomType as $key=>$value){

	        	 		$isExist=Roomtype::viewItemtypename($value);
				        
				        if(!empty($isExist)){

				        	$item_type_id[]=$isExist->item_type_id;

				        }else{
				        	$insert_Data=array('item_type_name'=>$value,'item_type_slug'=>$value,'item_type_status'=>1,'item_type_drop_status'=>'no');
				        	$item_type_id[]=Roomtype::insertGetId($insert_Data);

				        }

	        	 	}

	        	 }
	        	 $dropstatus='no';$itemstatus = 1;

	        	if($row[19] == 'yes' || $row[19] == 1){
					$dropstatus = 'yes';
	        	}elseif($row[19] == 'no' || $row[19] == 1){
	        		$dropstatus = 'no';
	        	}

				if($row[20] == 'published' || $row[20] == 1){
					$itemstatus = 1;

	        	}elseif($row[20] == 'unpublished' || $row[20] == 0){
					$itemstatus = 0;
	        	}
					   //


            $id = DB::table('items')->insertGetId([
                 'user_id'    => $row[14], 
					   'item_token' => $item_tocken,
					   'item_name' => $row[0],
					   'item_slug' => $row[1],
					   'item_desc' => $row[2],
					   'item_shortdesc' => $row[3],
					   'address'=>$address,
					  // 'item_thumbnail' => $row[7],
					   'item_preview' => $row[16],
					   'latitude'=>$latitude,
					   'longitude'=>$longitude,
					  // // 'item_file' => $row[9],
					  //  'item_category' => $row[10],
					  //  'item_category_type' => $row[11],
					  //  'item_type_cat_id' => $row[12],
					   'item_type' => $row[4],
					   // 'regular_price' => $row[14],
					   // 'extended_price' => $row[15],
					   // 'compatible_browsers' => $row[16],
					   // 'package_includes' => $row[17],
					   // 'package_includes_two' => $row[18],
					   // 'columns' => $row[19],
					   // 'layout' => $row[20],
					   // 'package_includes_three' => $row[21],
					   // 'layered' => $row[22],
					   // 'cs_version' => $row[23],
					   // 'print_dimensions' => $row[24],
					   // 'pixel_dimensions' => $row[25],
					   // 'package_includes_four' => $row[26],
					   'demo_url' => $row[13],
					   // 'video_preview_type' => $row[28],
					   // 'video_file' => $row[29],
					   // 'video_url' => $row[30],
					   // 'item_tags' => $row[31],
					   // 'item_liked' => $row[32],
					   'item_views' => 0,
					   'free_download' =>0,
					   // 'item_featured' => $row[35],
					   // 'item_sold' => $row[36],
					   // 'future_update' => $row[37],
					   // 'item_support' => $row[38],
					   'created_item' => date('Y-m-d H:i:s',strtotime($row[17])),
					   'updated_item' =>  date('Y-m-d H:i:s',strtotime($row[18])),
					   // 'download_count' => $download_count,
					   // 'item_flash' => $item_flash,
					   // 'item_flash_request' => $item_flash_request,
					   // 'item_allow_seo' => $row[44],
					   // 'item_seo_keyword' => $row[45],
					   // 'item_seo_desc' => $row[46],

					   'phonenumber'=>$row[6],
					   'website'=>$row[7],
					   'email'=>$row[8],
					   'facebook'=>$row[9],
					   'instagram'=>$row[10],
					   'linkedin'=>$row[11],
					   'youtube'=>$row[12],


					   'drop_status' => $dropstatus,
					   'item_status' => $itemstatus,
            ]);

            if(count($item_type_id) > 0 && $item_type_id[0] != ''){
		    		
		    		// Items::updateRoomtyp($item_type_id,$item_token);

		    		  // DB::table('item_room')->where('item_id', '=', $item_id)->delete(); 


			        foreach($item_type_id as $key=>$value){
			              DB::table('item_room')->insert( array(
			                    'item_id'    =>  $id, 
			                    'item_loccate_id'   =>   $value,
			                     'item_tocken'   =>   $item_tocken
			              ));
			      
			        }
		    }
        }
    }
    }
	
  /* public function model(array $row)
    {


    		// echo "<pre>";print_r($row);

    		// exit;

    		if($row[0] != 'item_name'){

    			$apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE';
	    		$address=''; // Google maps now requires an API key.;
	    		$address=$row[5];
            	// Get JSON results from this request
	    		$latitude='';
            	$longitude='';
            	if(!empty($address)){


		            	$geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
		            	$geo = json_decode($geo, true); // Convert the JSON to an array
	            	
			            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
			              $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
			              $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
			            }
	        	}
	        	 $item_tocken=$this->generateRandomString();

	        	 $roomType=array();
	        	 $roomType=explode(",",$row[15]);

	        	 if(count($roomType) > 0){


	        	 	$item_type_id=array();

	        	 	foreach($roomType as $key=>$value){

	        	 		$isExist=Roomtype::viewItemtypename($value);
				        
				        if(!empty($isExist)){

				        	$item_type_id[]=$isExist->item_type_id;

				        }else{
				        	$insert_Data=array('item_type_name'=>$value,'item_type_slug'=>$value,'item_type_status'=>1,'item_type_drop_status'=>'no');
				        	$item_type_id[]=Roomtype::insertGetId($insert_Data);

				        }

	        	 	}

	        	 }
	        	 $dropstatus='no';$itemstatus = 1;

	        	if($row[19] == 'yes' || $row[19] == 1){
					$dropstatus = 'yes';
	        	}elseif($row[19] == 'no' || $row[19] == 1){
	        		$dropstatus = 'no';
	        	}

				if($row[20] == 'published' || $row[20] == 1){
					$itemstatus = 1;

	        	}elseif($row[20] == 'unpublished' || $row[20] == 0){
					$itemstatus = 0;
	        	}
					   //'item_status' => $itemstatus,

	        	 $itemid=new Import([


	        	 	   'user_id'    => $row[14], 
					   'item_token' => $item_tocken,
					   'item_name' => $row[0],
					   'item_slug' => $row[1],
					   'item_desc' => $row[2],
					   'item_shortdesc' => $row[3],
					   'address'=>$address,
					  // 'item_thumbnail' => $row[7],
					   'item_preview' => $row[16],
					   'latitude'=>$latitude,
					   'longitude'=>$longitude,
					  // // 'item_file' => $row[9],
					  //  'item_category' => $row[10],
					  //  'item_category_type' => $row[11],
					  //  'item_type_cat_id' => $row[12],
					   'item_type' => $row[4],
					   // 'regular_price' => $row[14],
					   // 'extended_price' => $row[15],
					   // 'compatible_browsers' => $row[16],
					   // 'package_includes' => $row[17],
					   // 'package_includes_two' => $row[18],
					   // 'columns' => $row[19],
					   // 'layout' => $row[20],
					   // 'package_includes_three' => $row[21],
					   // 'layered' => $row[22],
					   // 'cs_version' => $row[23],
					   // 'print_dimensions' => $row[24],
					   // 'pixel_dimensions' => $row[25],
					   // 'package_includes_four' => $row[26],
					   'demo_url' => $row[13],
					   // 'video_preview_type' => $row[28],
					   // 'video_file' => $row[29],
					   // 'video_url' => $row[30],
					   // 'item_tags' => $row[31],
					   // 'item_liked' => $row[32],
					   'item_views' => 0,
					   'free_download' =>0,
					   // 'item_featured' => $row[35],
					   // 'item_sold' => $row[36],
					   // 'future_update' => $row[37],
					   // 'item_support' => $row[38],
					   'created_item' => date('Y-m-d H:i:s',strtotime($row[17])),
					   'updated_item' =>  date('Y-m-d H:i:s',strtotime($row[18])),
					   // 'download_count' => $download_count,
					   // 'item_flash' => $item_flash,
					   // 'item_flash_request' => $item_flash_request,
					   // 'item_allow_seo' => $row[44],
					   // 'item_seo_keyword' => $row[45],
					   // 'item_seo_desc' => $row[46],

					   'phonenumber'=>$row[6],
					   'website'=>$row[7],
					   'email'=>$row[8],
					   'facebook'=>$row[9],
					   'instagram'=>$row[10],
					   'linkedin'=>$row[11],
					   'youtube'=>$row[12],


					   'drop_status' => $dropstatus,
					   'item_status' => $itemstatus,
					

	        	 ]);

	        	if(count($item_type_id) > 0 && $item_type_id[0] != ''){
		    		
		    		// Items::updateRoomtyp($item_type_id,$item_token);

		    		  // DB::table('item_room')->where('item_id', '=', $item_id)->delete(); 


			        foreach($item_type_id as $key=>$value){
			              DB::table('item_room')->insert( array(
			                 //   'item_id'    =>  $item_id, 
			                    'item_loccate_id'   =>   $value,
			                     'item_tocken'   =>   $item_tocken
			              ));
			      
			        }
		    	}

		    	return $itemid;

	        	  	

    		}
	    
	    

           // echo "<pre>data";print_r($data );
           // echo "<pre>data";print_r($row);exit;
		   // if($row[33] == ""){ $item_views = 0; } else { $item_views = $row[33]; }
		   // if($row[34] == ""){ $free_download = 0; } else { $free_download = $row[34]; }
		   // if($row[41] == ""){ $download_count = 0; } else { $download_count = $row[41]; }
		   // if($row[42] == ""){ $item_flash = 0; } else { $item_flash = $row[42]; }
		   // if($row[43] == ""){ $item_flash_request = 0; } else { $item_flash_request = $row[43]; }
     //       if (empty($data)) {
          
					//   return new Import([
					//    'user_id'    => $row[1], 
					//    'item_token' => $row[2],
					//    'item_name' => $row[3],
					//    'item_slug' => $row[4],
					//    'item_desc' => $row[5],
					//    'item_shortdesc' => $row[6],
					//    'item_thumbnail' => $row[7],
					//    'item_preview' => $row[8],
					//    'item_file' => $row[9],
					//    'item_category' => $row[10],
					//    'item_category_type' => $row[11],
					//    'item_type_cat_id' => $row[12],
					//    'item_type' => $row[13],
					//    'regular_price' => $row[14],
					//    'extended_price' => $row[15],
					//    'compatible_browsers' => $row[16],
					//    'package_includes' => $row[17],
					//    'package_includes_two' => $row[18],
					//    'columns' => $row[19],
					//    'layout' => $row[20],
					//    'package_includes_three' => $row[21],
					//    'layered' => $row[22],
					//    'cs_version' => $row[23],
					//    'print_dimensions' => $row[24],
					//    'pixel_dimensions' => $row[25],
					//    'package_includes_four' => $row[26],
					//    'demo_url' => $row[27],
					//    'video_preview_type' => $row[28],
					//    'video_file' => $row[29],
					//    'video_url' => $row[30],
					//    'item_tags' => $row[31],
					//    'item_liked' => $row[32],
					//    'item_views' => $item_views,
					//    'free_download' => $free_download,
					//    'item_featured' => $row[35],
					//    'item_sold' => $row[36],
					//    'future_update' => $row[37],
					//    'item_support' => $row[38],
					//    'created_item' => $row[39],
					//    'updated_item' => $row[40],
					//    'download_count' => $download_count,
					//    'item_flash' => $item_flash,
					//    'item_flash_request' => $item_flash_request,
					//    'item_allow_seo' => $row[44],
					//    'item_seo_keyword' => $row[45],
					//    'item_seo_desc' => $row[46],
					//    'drop_status' => $row[47],
					//    'item_status' => $row[48],
					// ]);
		  
		  
     //          } 
     
	    
	
        
    }*/
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
