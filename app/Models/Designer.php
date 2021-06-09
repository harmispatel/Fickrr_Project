<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Designer extends Model
{

    public $timestamps = false;
	// use Notifiable;
	protected $table = 'designer';
  
    protected $fillable = [
        
        'id',
        'name',
        'about',
        'facebook',
        'instagram',
        'linkedin',
        'youtube'
        
    ];


protected $visible = [''];

  
  


     public function hasManyDesignershops(){

           return $this->hasMany('Fickrr\Models\Designershops', 'designer_id', 'id');
    }

        // public function hasOneItems(){
        //     return $this->hasOne('Fickrr\Models\Items','id','shopitem_id');
        // }

        public function hasManyDesignerimages(){
               return $this->hasMany('Fickrr\Models\Designerimages', 'designer_id', 'id');
        }


    public static function getDesignerDetail($shop_item_id){


        // $designer=Designer::with('hasManyDesignershops')
        //     ->whereHas('hasManyDesignershops',function($q) use($shop_item_id){
        //         $q->whereIn('shopitem_id',$shop_item_id);
        //     })->tosql();

        //     echo "<pre>";print_r($designer);


        //echo "shopitemid".$shop_item_id;

       // echo "<pre>";print_r($shop_item_id);
        return  $designer=Designer::with('hasManyDesignershops')
            ->whereHas('hasManyDesignershops',function($q) use($shop_item_id){
                $q->whereIn('shopitem_id',$shop_item_id);
            })->get();

    }


    //  public function hasOneDesignershops(){

    //        return $this->hasMany('Fickrr\Models\Designershops', 'designer_id', 'id');
    // }

    


     public static function getvendorData()
  {

    $value=DB::table('users')->where('user_type','=','vendor')->where('drop_status','=','no')->orderBy('id', 'desc')->get(); 
    return $value;
	
  }
  
  
}
