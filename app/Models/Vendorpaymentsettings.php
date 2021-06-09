<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Vendorpaymentsettings extends Model
{
    
	
	

	  public static function editGeneral($userId){

			$value = DB::table('vendorpaymentsettings')
			  ->where('vendorstoreId', $userId)
			  ->first();

			//  echo "Dd".$userId;echo "<pre>";print_r($value);
			return $value;
	  }

	  public static function updatemailData($sid,$data){
    	DB::table('vendorpaymentsettings')
      ->where('sid', $sid)
      ->update($data);
  }
	  
	
  

  
  /* email settings */
  
}
