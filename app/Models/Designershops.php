<?php

namespace Fickrr\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;




class Designershops extends Model{

	// use Notifiable;
	protected $table = 'designer_shops';
    protected $fillable = [
    	'id',
    	'designer_id',
    	'shopitem_id',
    ];
      public $timestamps = false;

    // public function hasManyItems(){

    //        return $this->hasOne('Fickrr\Models\Items', 'item_id', 'shopitem_id');
    // }

  
}
