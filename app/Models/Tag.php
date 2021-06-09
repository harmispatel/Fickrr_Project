<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Fickrr\Models\Settings;

class Tag extends Model
{
    
	/* tag */
	
	protected $table = 'tag';
	
	
   public static function gettagsingle($slug)
  {

    $value=DB::table('tag')->where('tag_slug','=',$slug)->first(); 
    return $value;
	
  }		
	
  
  public static function gettagData()
  {

    $value=DB::table('tag')->where('drop_status','=','no')->orderBy('tag_id', 'desc')->get(); 
    return $value;
	
  }
  
  
  
  public static function inserttagData($data){
   
     return DB::table('tag')->insertGetId($data);
     
 
    }
  
  public static function deleteTagdata($tag_id,$data){
 		
    DB::table('tag')
        ->where('tag_id', $tag_id)
        ->update($data);
	
  }
  
  
  public static function editTagData($tag_id){
    $value = DB::table('tag')
      ->where('tag_id', $tag_id)
      ->first();
	return $value;
  }
  
  
  public static function updateTag($tag_id,$data){
    DB::table('tag')
      ->where('tag_id', $tag_id)
      ->update($data);
  }
  
  
}
