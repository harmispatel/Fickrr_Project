<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Taxclass extends Model
{

	// use Notifiable;
	protected $table = 'tax_class';

    public $timestamps=false;
  
    protected $fillable = [
        'tax_class_id',
        'tax_class_title',
        'tax_class_description',
        'date_added',
        'last_modified'
       
    ];

    public static function viewTaxClass($taxclass){
            return Taxclass::where('tax_class_title',$taxclass)->first();
    }

    public static function insertTaxclass($data){

      return  Taxclass::insertGetId($data);

    }



 
     
 


  
  
}
