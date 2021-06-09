<?php

namespace Fickrr\Helpers;
use Cookie;
use Illuminate\Support\Facades\Crypt;
use Fickrr\Models\Languages;

class Helper {
    
    public static function translation($id,$code) 
    {
	
	    if($code == 'en')
		{
         
		   $tran_value['view'] = Languages::en_Translate($id,$code);
		}
		else
		{
            
		  $tran_value['view'] = Languages::other_Translate($id,$code);
		}
       
		return $tran_value['view']->keyword_text;
        
    }
	
	public static function count_rating($rate_var) 
    {
	   
	    if(count($rate_var) != 0){

           $top = 0;
           $bottom = 0;
           foreach($rate_var as $view)
           { 
              if($view->rating == 1){ $value1 = $view->rating*1; } else { $value1 = 0; }
              if($view->rating == 2){ $value2 = $view->rating*2; } else { $value2 = 0; }
              if($view->rating == 3){ $value3 = $view->rating*3; } else { $value3 = 0; }
              if($view->rating == 4){ $value4 = $view->rating*4; } else { $value4 = 0; }
              if($view->rating == 5){ $value5 = $view->rating*5; } else { $value5 = 0; }
              $top += $value1 + $value2 + $value3 + $value4 + $value5;
              $bottom += $view->rating;
           }
           if(!empty(round($top/$bottom))){

             $count_rating = round($top/$bottom);

           }
           else{

              $count_rating = 0;

            }
        }
        else{
            $count_rating = 0;
        }  
		return $count_rating;
        
    }
	
	public static function price_info($flash_var,$price_var) {
	    if($flash_var == 1)
        {
        $price = round($price_var/2);
        }
        else
        {
        $price = $price_var;
        }
		return $price;

	}


    public static function get_user_info(Request $request){

        echo "<pre>";print_r($request->ip());exit;

        $json = file_get_contents("https://www.geoip-db.com/json");
        $data = json_decode($json);


        $location=array();
        $location['country']=isset($data->country_code) ? $data->country_code : '';
        $location['country_name']=isset($data->country_name) ? $data->country_name : '';
        $location['state']=isset($data->state) ? $data->state : '';
        $location['city']=isset($data->city) ? $data->city : '';
        $location['postal']=isset($data->postal) ? $data->postal : '';
        $location['latitude']= isset($data->latitude) ? $data->latitude : '';
        $location['longitude']= isset($data->longitude) ? $data->longitude : '';
        $location['IPv4']=isset($data->IPv4) ? $data->IPv4 : '';

      echo  $ip=$request->ip();
        $data = \Location::get($ip);

        return $data;
      //  return $location;
       

    }



}