<?php

namespace Fickrr\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{

    // use Notifiable;
    protected $table = 'manufacturers';
    protected $primaryKey = 'manufacturers_id';
    public $timestamps = false;

    protected $fillable = [
        'manufacturers_id',
       // 'manufacturers_name',
      //  'manufacturers_image',
       // 'date_added',
      //  'last_modified',
      //  'manufacturers_slug',
        'website',
        'street_address',
        'city',
        'state',
        'zip_code',
        'main_phone',
        'email',
        'key_contact_person',
        'key_contact_email',
        'order_method',
        'order_email',
    ];

    public static function getRoomtype()
    {

        return Roomtype::where('item_type_status', '=', 1)->where('item_type_drop_status', '=', 'no')->get();
    }

    public static function getManufactureData($manufacturers_id = array())
    {

        // $q=Roomtype::where('item_type_status','=',1)->where('item_type_drop_status','=','no');
        if (count($manufacturers_id) > 0) {
           // return $q = Manufacturers::whereIn('manufacturers_id', $manufacturers_id)->get();
              return $q = Users::where('user_type','=','manufacturers')->whereIn('id', $manufacturers_id)->get();
        } else {
            return $q = Users::where('user_type','=','manufacturers')->get();
        }

        //  return Roomtype::where('item_type_status','=',1)->where('item_type_drop_status','=','no')->whereIn('item_type_id',$item_type_id)->get();
    }

    public static function insertManufacturers($data)
    {

        $userid=Users::insertGetId($data);

        $insertarray=array('manufacturers_id'=>$userid);
        return Manufacturers::insertGetId($insertarray);

    }

    public static function viewManufacturerstype($manufacturers_slug)
    {

         return $q = Users::where(function($q) use($manufacturers_slug){

            $q->where('name','=',$manufacturers_slug)->orWhere('username','=',$manufacturers_slug);

         })->where('user_type','=','manufacturers')->select('id')->first();

       // return Manufacturers::where('manufacturers_slug', $manufacturers_slug)->first();
    }

    public static function editRoomtype($item_type_id, $data)
    {

        return Roomtype::where('item_type_id', $item_type_id)->update($data);

    }

    public static function deleteRoomtype($item_type_id, $data)
    {

        return Roomtype::where('item_type_id', $item_type_id)->update($data);

    }
}
