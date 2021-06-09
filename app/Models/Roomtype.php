<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Roomtype extends Model
{

	// use Notifiable;
	protected $table = 'room_type';

    public $timestamps=false;
  
    protected $fillable = [
        'item_type_id',
        'item_type_name',
        'item_type_slug',
        'item_type_status',
        'item_type_drop_status'
       
    ];


    public static function getRoomtype(){

      return Roomtype::where('item_type_status','=',1)->where('item_type_drop_status','=','no')->get();
    }

        public static function getRoomTypeData($item_type_id){

            $q=Roomtype::where('item_type_status','=',1)->where('item_type_drop_status','=','no');
            if(count($item_type_id) > 0){
                $q=$q->whereIn('item_type_id',$item_type_id);
            }
            return $q=$q->get();

               

          //  return Roomtype::where('item_type_status','=',1)->where('item_type_drop_status','=','no')->whereIn('item_type_id',$item_type_id)->get();

        }

    public static function insertRoomtype($data){

      return  Roomtype::insertGetId($data);

    }


     public static function viewItemtype($typeid){
        return Roomtype::where('item_type_id',$typeid)->first();
     }


     public static function viewItemtypename($typeid){
        return Roomtype::where('item_type_name',$typeid)->first();
     }

     public static function editRoomtype($item_type_id, $data){

        return Roomtype::where('item_type_id',$item_type_id)->update($data);

     }

    public static function deleteRoomtype($item_type_id, $data){

           return Roomtype::where('item_type_id',$item_type_id)->update($data);



    }
     
 


  
  
}
