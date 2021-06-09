<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Models\Settings;
use Fickrr\Models\Members;
use Fickrr\Models\Items;
use Fickrr\Models\Itemroom;
use Fickrr\Models\Itemhotel;
use Fickrr\Models\Attribute;
use Fickrr\Models\Designer;
use Fickrr\Models\Category;
use Fickrr\Models\Designerimages;
use Fickrr\Models\Designershops;
use Fickrr\Models\Roomtype;
use Fickrr\Models\Manufacturers;
use Fickrr\Models\Products;
use Fickrr\Models\Productroom;
use Fickrr\Models\resizeclass;
use Fickrr\Models\Producthotel;
use Fickrr\Models\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
/*use Intervention\Image\Image;*/
use Illuminate\Support\Facades\File;
use Fickrr\Http\Controllers\Controller;
use Auth;
use Mail;
use URL;
use Image;
use Storage;
use Illuminate\Support\Str;

use DB;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function edit_item($token){

        //$resizeObj = new resize(getcwd().'/'. "170326_LokalHotel_Pt2-9-1-1.jpg");

      


        //   $sel_hotel=array('95');

        //   $q=Items::with('hasManysItemroom');
        //   //->where('user_id','=',$user_id);
        //    $q=$q->where(function($q){
        //         $q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
        //   })
        //                ->whereHas('hasManysItemroom',function($q) use($sel_hotel){
        //                $q->whereIn('item_id',$sel_hotel);
        //            })
        //                 ->whereIn('item_id',$sel_hotel)->get();

        // echo "<pre>";print_r($q);exit;
        $edit['item'] = Products::edititemData($token);
        $type_id = @$edit['item']->item_type;
        $cat_name = @$edit['item']->item_category_type; 
        $cat_id = @$edit['item']->item_category;
      //  $getvendor['view'] = Members::getvendorData();
        $type_name = Items::slugItemtype($type_id);
        $typer_id = @$type_name->item_type_id;

        $itemroom=Productroom::with('hasOneProducts')->where('pro_id',$edit['item']->pro_id)->pluck('item_loccate_id')->toArray();
        //echo "<pre>";print_r( $itemroom);exit;

        $itemhotel=Producthotel::with('hasOneProducts')->where('pro_id',$edit['item']->pro_id)->pluck('hotel_id')->toArray();
        //echo "<pre>";print_r($itemhotel);exit;

        $hotels=Items::with('hasOneUser')->select('item_id','item_name','user_id')->where('item_status','=',1);
                $hotels=$hotels->where(function($hotels){
                $hotels->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
        })->get();

                //echo "<pre>";print_r($hotels);exit;
        
        $item_room= Items::getLocationData($edit['item']->pro_id);

        $itemWell['roomtype'] = Roomtype::getRoomtype();  

        $manufacturer=Manufacturers::getManufactureData(); 
        $item_manfact= Items::getItemManufactureData($edit['item']->pro_id);

        $item_image['item'] = Products::getimagesData($token);



        // $catgoriesd['menu']=Category::allcategoryData();
        $catgoriesd['menu']=Category::allcategoryData();
        $catgoriesd['tag']=Tag::gettagData();

        // echo "<pre>";
        // print_r($catgoriesd['menu']);
        // exit;
        $selcategoriesarray=Products::getSelectedCategory($edit['item']->pro_id);
        $seltagarray=Products::getSelectedTag($edit['item']->pro_id);
        // echo "<pre>";print_r($seltagarray);exit;



       //$getvendor['view'] = Members::getvendorData();
         // echo "<pre>";print_r(  $edit['item'] );exit;
        $data = array('edit' => $edit,'token' => $token, 'cat_id' => $cat_id, 'cat_name' => $cat_name,'type_name' => $type_name, 'typer_id' => $typer_id,'item_room'=>$item_room,'itemWell'=>$itemWell,'itemroom'=>$itemroom,'itemhotel'=>$itemhotel,'manufacturer'=>$manufacturer,'item_manfact'=>$item_manfact,'hotels'=>$hotels,'item_image' => $item_image,'catgoriesd'=>$catgoriesd,'selcategoriesarray'=>$selcategoriesarray,'seltagarray'=>$seltagarray);
      
       return view('admin.product.edit-item')->with($data);
        
    }
	
	
    public function upload_item(){


       // echo "rest rest ";

        $itemWell['type'] = Items::gettypeItem();    
        $manufacturer=Manufacturers::getManufactureData();  
       // $manufacturerUser=Manufacturers::getManufactureData();    
        $getvendor['view'] = Members::getvendorData();

       $q=Items::with('hasOneUser')->select('item_id','item_name','user_id')->where('item_status','=',1);
        $q=$q->where(function($q){
                $q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
        })->get();

        $shops=$q;

        $catgoriesd['menu']=Category::allcategoryData();
        $catgoriesd['tag']=Tag::gettagData();


       //echo "<pre>";print_r($manufacturer);exit;


        $data = array('itemWell'=>$itemWell,'manufacturer'=>$manufacturer ,'getvendor' => $getvendor,'shops'=>$q,'catgoriesd'=>$catgoriesd); 

          //echo "<pre>";print_r($itemWell['type']);exit;
    	return view('admin.product.upload-item')->with($data);

    }
    public function save_items(Request $request){

  
       //  var_dump($request->input('downloadable'));
       // var_dump($request->input('virtual'));
      // exit;
        $item_name = $request->input('item_name');
        //   $item_slug = $this->item_slug($item_name);
         $demo_url = $request->input('demo_url');
         $item_slug =   $demo_url == '' ? $this->item_slug($item_name) :  $this->item_slug($demo_url);
        //     $item_slug =   $this->item_slug($item_name);
        //  $item_desc = htmlentities($request->input('item_desc'));
        //  $item_shortdesc = $request->input('item_desc');

        $item_desc = htmlentities($request->input('item_desc'));
        $item_shortdesc = htmlentities($request->input('item_shortdesc'));
        $item_category = $request->input('item_category');
        $manufacturer=$request->input('manufacturer');
        $sku=$request->input('sku');
        $instock=$request->input('instock');
        $stock_quantity=$request->input('stock_quantity');
        $downloadable=$request->input('downloadable');
        $virtual=$request->input('virtual');

        $room_type=array();
        $room_type=$request->room_type ? $request->room_type :array();;

        $subcategory=array();
        $subcategory=isset($request->subcategory) ? $request->subcategory : array();


        $low_stock_amount=$request->input('low_stock_amount');
        $sold_individually=$request->input('sold_individually');
        $backorders=$request->input('backorders');
        $tagarray=isset($request->tag_id) ? $request->tag_id : array();


        // $rules = array(
                
        //         'item_name' => ['required', 'max:100', Rule::unique('items') -> where(function($sql){ $sql->where('drop_status','=','no');})],
                
                
        //  );
         
        //  $messsages = array(
              
        // );
         
        // $validator = Validator::make($request->all(), $rules,$messsages);
        
        // if ($validator->fails()) 
        // {
        //  $failedRules = $validator->failed();
        //  return back()->withErrors($validator);
        // } 




        // $rules = array(
                
        //         'item_name' => ['required', 'max:100', Rule::unique('items') -> where(function($sql){ $sql->where('drop_status','=','no');})],
                
                
        //  );
         
        // $messsages = array(
              
        // );
         
        // $validator = Validator::make($request->all(), $rules,$messsages);
        
        // if ($validator->fails()) 
        // {
        //     $failedRules = $validator->failed();
        //     return back()->withErrors($validator);
        // } 



       // $address =$request->input('location');;

       //  $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; // Google maps now requires an API key.
       //      // Get JSON results from this request
       //      $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
       //      $geo = json_decode($geo, true); // Convert the JSON to an array
       //      $latitude='';$longitude='';
       //      if (isset($geo['status']) && ($geo['status'] == 'OK')) 
       //      {
       //        $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
       //        $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
       //      }
       

       // $split = explode("_", $item_category);
         
    //   $cat_id = $split[1];
     //  $cat_name =$split[0];

     //   $cat_id= $request->input('subcategory');
        // $cat_name= 'subcategory';
       

       // $item_type = $request->input('item_type'); // remain
        $item_type = 'product'; // remain
        $type_id = $request->input('type_id'); // remain

       
        $item_tags = $request->input('item_tags');

        $regular_price = $request->input('regular_price_');
        $extended_price = $request->input('extended_price');
        $hotel_location=isset($request->hotels) ? $request->hotels :  array();



        $created_item = date('Y-m-d H:i:s');
        $updated_item = date('Y-m-d H:i:s');

        $item_token = $this->generateRandomString();
        $allsettings = Settings::allSettings();

        $item_status=$request->input('item_status');
        $item_drop_status=$request->input('item_drop_status');

        $drop_status=$request->input('drop_status');;

        $drop_status= $drop_status == 'yes' ? 'no' : 'yes';
        $item_status= $item_status ==  'Published' ? 1 : 0;

        $weight=$request->input('weight');
        $length=$request->input('length');
        $width=$request->input('width');
        $height=$request->input('height');

        $user_id=39;
        if ($request->hasFile('item_preview')) {
            if($allsettings->watermark_option == 1){

                    $image = $request->file('item_preview');
                    $img_name = time() . '252.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/items');
                    $imagePath = $destinationPath. "/".  $img_name;
                    $image->move($destinationPath, $img_name);
                    /* new code */      
                    $watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
                    $img=Image::make($url.'/public/storage/items/'.$img_name);
                    $wmarkWidth=$watermarkImg->width();
                    $wmarkHeight=$watermarkImg->height();

                    $imgWidth=$img->width();
                    $imgHeight=$img->height();

                    $x=0;
                    $y=0;
                    while($y<=$imgHeight){
                        $img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
                        $x+=$wmarkWidth;
                        if($x>=$imgWidth){
                            $x=0;
                            $y+=$wmarkHeight;
                        }
                    }
                    $img->save(base_path('public/storage/items/'.$img_name));

                    $item_preview = $img_name;
                    /* new code */
            }
            else{

                   $image = $request->file('item_preview');
                   $img_name = time() . '252.'.$image->getClientOriginalExtension();
                   $destinationPath = public_path('/storage/items');
                   $imagePath = $destinationPath. "/".  $img_name;
                   $image->move($destinationPath, $img_name);
                   $item_preview = $img_name;
            }
            //$this->resize_crop_image(300, 300, public_path('storage/items/'.$img_name), public_path('storage/items/thumb_'.$img_name));
            $item_thumbnail='thumb_'.$img_name;

            $filename=public_path('storage/items/'.$img_name);

              //echo public_path('storage/items/thumb_');exit;
            $obj=new resizeclass();
            $obj->initial($filename);
     
            $obj->resizeImage(250, 200, 'crop');
 

            $obj->saveImage(public_path('storage/items/thumb_'.$img_name), 100);
            $item_thumbnail='thumb_'.$img_name;
          }
          else{
                $item_preview = "";
                $item_thumbnail='';
          }
         

        $data = array('item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_preview' => $item_preview,
                    // 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 
                    'item_type' => $item_type,'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'item_slug' => $item_slug, 'created_item' => $created_item, 'updated_item' => $updated_item,'drop_status'=>$drop_status,'regular_price' => $regular_price, 'extended_price' => $extended_price,'manufacturers_id'=>$manufacturer,'weight'=>$weight,'length'=>$length,'width'=>$width,'height'=>$height,'sku'=>$sku,'instock'=>$instock,'stock_quantity'=>$stock_quantity,'virtualp'=>$virtual,'downloadable'=>$downloadable,'item_thumbnail'=>$item_thumbnail,'backorders'=> $backorders,'sold_individually' => $sold_individually,'low_stock_amount'=>$low_stock_amount);

                $itemsIdd= Products::saveproductData($data);


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

            if(count($subcategory) > 0 && $subcategory[0] != ''){
                
                    //echo $itemdd_id;exit;
                    //$itemsIdd=$request->input('item_id');
                    Products::updateSubcategoryData($subcategory,$itemsIdd);
            }


            Products::updateProdcutTagData($tagarray,$itemsIdd);

            if ($request->hasFile('item_screenshot')) 
            {
                if($allsettings->watermark_option == 1)
                {
                    $files = $request->file('item_screenshot');
                    foreach($files as $file)
                    {
                        $extension = $file->getClientOriginalExtension();
                        $fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
                        $folderpath  = public_path('/storage/items');
                        $file->move($folderpath , $fileName);
                        /* new code */      
                        $watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
                        $img=Image::make($url.'/public/storage/items/'.$fileName);
                        $wmarkWidth=$watermarkImg->width();
                        $wmarkHeight=$watermarkImg->height();
            
                        $imgWidth=$img->width();
                        $imgHeight=$img->height();
            
                        $x=0;
                        $y=0;
                        while($y<=$imgHeight){
                            $img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
                            $x+=$wmarkWidth;
                            if($x>=$imgWidth){
                                $x=0;
                                $y+=$wmarkHeight;
                            }
                        }
                        $img->save(base_path('public/storage/items/'.$fileName));
                        /* new code */
                        $imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
                        Products::saveitemImages($imgdata);
                    }
                }
                else
                {
                   $files = $request->file('item_screenshot');
                    foreach($files as $file)
                    {
                        $extension = $file->getClientOriginalExtension();
                        $fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
                        $folderpath  = public_path('/storage/items');
                        $file->move($folderpath , $fileName);
                        $imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
                        Products::saveitemImages($imgdata);
                    }
                }
         }
       
              
            


            //   $data = array('user_id' => $user_id, 'item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_preview' => $item_preview, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type,'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'item_slug' => $item_slug, 'created_item' => $created_item, 'updated_item' => $updated_item,'drop_status'=>$drop_status,'regular_price' => $regular_price, 'extended_price' => $extended_price,'manufacturers_id'=>$manufacturer,'weight'=>$weight,'length'=>$length,'width'=>$width,'height'=>$height,'sku'=>$sku,'instock'=>$instock,'stock_quantity'=>$stock_quantity);
            // //echo "<pre>";print_r($s);exit;
            
            // $itemsIdd= Items::saveitemData($data);


            //  if(count($hotel_location) > 0 && $hotel_location[0] != ''){

            //     //echo $itemdd_id;exit;

            //     //$item_id=$request->input('item_id');
            //      Items::updateitemHotelData($hotel_location,$itemsIdd);
            // }
        





        //          if(count($manufacturer) > 0 && $manufacturer[0] != ''){
                            
        //                     Items::updatemanufacttyp($manufacturer,$itemsIdd);
        // }
        $item_approve_status="Product has been added with new ui";

        return redirect('/admin/upload-newitems')->with('success', $item_approve_status);
          
          

    }

         public function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){


    // $w=$max_width;
    //  $h= $max_height;
    //           list($width, $height) = getimagesize($source_file);
    // $r = $width / $height;
    // if ($crop) {
    //     if ($width > $height) {
    //         $width = ceil($width-($width*abs($r-$w/$h)));
    //     } else {
    //         $height = ceil($height-($height*abs($r-$w/$h)));
    //     }
    //     $newwidth = $w;
    //     $newheight = $h;
    // } else {
    //     if ($w/$h > $r) {
    //         $newwidth = $h*$r;
    //         $newheight = $h;
    //     } else {
    //         $newheight = $w/$r;
    //         $newwidth = $w;
    //     }
    // }
    // $src = imagecreatefromjpeg($file);
    // $dst = imagecreatetruecolor($newwidth, $newheight);
    // imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // return $dst;



//              $filename = $source_file;
//              $percent = 0.5;

//         // // Content type
//         //header('Content-Type: image/jpeg');



//         // Get new sizes
//       list($width, $height) = getimagesize($filename);
//            //  $width=$max_width;
//              //  $height=$max_height;
//           $imgsize = getimagesize($source_file);
//             $mime = $imgsize['mime'];

//              switch($mime){
//                 case 'image/gif':
//                     $image_create = "imagecreatefromgif";
//                     $image = "imagegif";
//                     break;

//                 case 'image/png':
//                     $image_create = "imagecreatefrompng";
//                     $image = "imagepng";
//                     $quality = 7;
//                     break;

//                 case 'image/jpeg':
//                     $image_create = "imagecreatefromjpeg";
//                     $image = "imagejpeg";
//                     $quality = 80;
//                     break;

//                 default:
//                     return false;
//                     break;
//             }

// $newwidth = $width * $percent;
// $newheight = $height * $percent;


// $thumb = imagecreatetruecolor($newwidth, $newheight);
// $source = $image_create($filename);


// imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);



// $image($thumb, $dst_dir, $quality);

// return;


         









        $max_width=300; $max_height=300;
        $percent = 0.5;

        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;

    //   $width_new =$width * $percent;
    //   $height_new =$height * $percent;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            //$w_point = (($width - $width_new) / 1);
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
}


    public function view_newitems(){

          $itemData['item'] = Products::getProductItem();
          $viewitem['type'] = Items::gettypeItem();
          $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

            //echo "<pre>";print_r($itemData['item']);exit;


            $q=Products::with('hasManysProducthotel')->where('item_status','=',1);
            $q=$q->where(function($q){
               // $q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant');
            })->select('pro_id','item_name')->get();


           // echo "<pre>";print_r($q);exit;


        $data = array('itemData' => $itemData, 'viewitem' => $viewitem, 'encrypter' => $encrypter,'shops'=>$q);
         return view('admin.product.shopitems')->with($data);


    }

    public function update_items(Request $request){

     // echo "<pre>";print_r($request->all());exit;



        $item_name = $request->input('item_name');

        $demo_url = $request->input('demo_url');
        $item_slug =   $demo_url == '' ? $this->item_slug($item_name) :  $this->item_slug($demo_url);
         //  $item_slug =   $this->item_slug($item_name);
        $item_desc = htmlentities($request->input('item_desc'));
        $item_shortdesc = htmlentities($request->input('item_shortdesc'));
        $item_category = $request->input('item_category');
        $item_id = $request->input('item_id');
         
        $regular_price = $request->input('regular_price_');
         
        $extended_price = $request->input('extended_price');
        $sku=$request->input('sku');
        $instock=$request->input('instock');
        $stock_quantity=$request->input('stock_quantity');


        $low_stock_amount=$request->input('low_stock_amount');
        $sold_individually=$request->input('sold_individually');
        $backorders=$request->input('backorders');

        $tagarray=isset($request->tag_id) ? $request->tag_id : array();

        $downloadable=$request->input('downloadable');
        $virtual=$request->input('virtual');


        $subcategory=array();
        $subcategory=isset($request->subcategory) ? $request->subcategory : array();
        
        // $split = explode("_", $item_category);
         
        // $cat_id = $split[1];
        // $cat_name =$split[0];

        // $cat_id= $request->input('subcategory');
        //  $cat_name= 'subcategory';
       

        // $item_type = $request->input('item_type'); // remain
        $item_type = 'product'; // remain
        $type_id = $request->input('type_id'); // remain

       
        $item_tags = $request->input('item_tags');


        $created_item = date('Y-m-d H:i:s');
        $updated_item = date('Y-m-d H:i:s');

        $item_token = $request->input('item_token');
        $allsettings = Settings::allSettings();

        $item_status=$request->input('item_status');
        $item_drop_status=$request->input('item_drop_status');
        $manufacturer=$request->input('manufacturer');
         $hotel_location=isset($request->hotels) ? $request->hotels :  array();


         $room_type=array();
        $room_type=$request->room_type ? $request->room_type :array();;



        $item_status=$request->input('item_status');
        $item_drop_status=$request->input('item_drop_status');

        $drop_status=$request->input('drop_status');;

        $drop_status= $drop_status == 'yes' ? 'no' : 'yes';
        $item_status= $item_status ==  'Published' ? 1 : 0;
        
        $weight=$request->input('weight');
        $length=$request->input('length');
        $width=$request->input('width');
        $height=$request->input('height');

        //  $address =$request->input('location');;
        //  $drop_status=$request->input('drop_status');;
      
       
         // $latitude ='';
         // $longitude ='';
         //       $apiKey = 'AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE'; // Google maps now requires an API key.
         //            // Get JSON results from this request
         //            $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey);
         //            $geo = json_decode($geo, true); // Convert the JSON to an array

         //            if (isset($geo['status']) && ($geo['status'] == 'OK')) 
         //            {
         //              $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
         //              $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
         //            }
       


        $user_id=39;
        if ($request->hasFile('item_preview')) 
        {
            if($allsettings->watermark_option == 1){
                    $image = $request->file('item_preview');
                    $img_name = time() . '252.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/items');
                    $imagePath = $destinationPath. "/".  $img_name;
                    $image->move($destinationPath, $img_name);
                    /* new code */      
                    $watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
                    $img=Image::make($url.'/public/storage/items/'.$img_name);
                    $wmarkWidth=$watermarkImg->width();
                    $wmarkHeight=$watermarkImg->height();

                    $imgWidth=$img->width();
                    $imgHeight=$img->height();

                    $x=0;
                    $y=0;
                    while($y<=$imgHeight){
                        $img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
                        $x+=$wmarkWidth;
                        if($x>=$imgWidth){
                            $x=0;
                            $y+=$wmarkHeight;
                        }
                    }
                    $img->save(base_path('public/storage/items/'.$img_name));
                    $item_preview = $img_name;
                    /* new code */
            }
            else{

                   $image = $request->file('item_preview');
                   $img_name = time() . '252.'.$image->getClientOriginalExtension();
                   $destinationPath = public_path('/storage/items');
                   $imagePath = $destinationPath. "/".  $img_name;
                   $image->move($destinationPath, $img_name);
                   $item_preview = $img_name;
            }
           // $this->resize_crop_image(300, 300, public_path('storage/items/'.$img_name), public_path('storage/items/thumb_'.$img_name));


              $filename=URL::to('public/storage/items/'.$img_name);


        //echo public_path('storage/items/thumb_');exit;
        $obj=new resizeclass();
        $obj->initial($filename);
 
        $obj->resizeImage(250, 200, 'crop');
 

         $obj->saveImage(public_path('storage/items/thumb_'.$img_name), 100);
            $item_thumbnail='thumb_'.$img_name;
            
            
          }
          else{
             $item_preview = $request->input('save_preview');
            //  $this->resize_crop_image(300, 300, public_path('storage/items/'.$item_preview), public_path('storage/items/thumb_'.$item_preview));
            // $item_thumbnail='thumb_'.$item_preview;


            $filename=URL::to('public/storage/items/'.$item_preview);


       //echo public_path('storage/items/thumb_');exit;
       $obj=new resizeclass();
        $obj->initial($filename);
 
        $obj->resizeImage(250, 200, 'crop');
 

         $obj->saveImage(public_path('storage/items/thumb_'.$item_preview), 100);
          $item_thumbnail='thumb_'.$item_preview;
            


        }

//            if(count($manufacturer) > 0 && $manufacturer[0] != ''){
                    
//                     Items::updatemanufacttyp($manufacturer,$item_id);
// }

        // $data = array('user_id' => $user_id, 'item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_preview' => $item_preview, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type,'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'item_slug' => $item_slug, 'created_item' => $created_item, 'updated_item' => $updated_item,'drop_status'=>$drop_status,'regular_price' => $regular_price, 'extended_price' => $extended_price,'manufacturers_id'=>$manufacturer,'weight'=>$weight,'length'=>$length,'width'=>$width,'height'=>$height);


        //     //echo "<pre>";print_r($s);exit;
            
        // Items::updateitemData($item_token,$data);
        // Products::updateitemData($item_token,$data);

            if(count($hotel_location) > 0 && $hotel_location[0] != ''){

                //echo $itemdd_id;exit;

                //$item_id=$request->input('item_id');
                Products::updateProductHotelData($hotel_location,$item_id);
            }

          if(count($room_type) > 0 && $room_type[0] != ''){
                //echo $itemdd_id;exit;
                //$itemsIdd=$request->input('item_id');
                Products::updateProductData($room_type,$item_id);
            }

            if(count($subcategory) > 0 && $subcategory[0] != ''){
                    //echo $itemdd_id;exit;
                    //$itemsIdd=$request->input('item_id');
                    Products::updateSubcategoryData($subcategory,$item_id);
            }
             Products::updateProdcutTagData($tagarray,$item_id);

            $data = array('item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_preview' => $item_preview,
                //   'item_category' =>$cat_id, 
                //   'item_category_type' => $cat_name,
                 'item_type' => $item_type,'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'item_slug' => $item_slug, 'created_item' => $created_item, 'updated_item' => $updated_item,'drop_status'=>$drop_status,'regular_price' => $regular_price, 'extended_price' => $extended_price,'manufacturers_id'=>$manufacturer,'weight'=>$weight,'length'=>$length,'width'=>$width,'height'=>$height,'sku'=>$sku,'instock'=>$instock,'stock_quantity'=>$stock_quantity,'virtualp'=>$virtual,'downloadable'=>$downloadable ,'item_thumbnail'=>$item_thumbnail,'backorders'=> $backorders,'sold_individually' => $sold_individually,'low_stock_amount'=>$low_stock_amount);

            $itemsIdd= Products::updateitemData($item_token,$data);

            if ($request->hasFile('item_screenshot')) 
            {
                if($allsettings->watermark_option == 1)
                {
                    $files = $request->file('item_screenshot');
                    foreach($files as $file)
                    {
                        $extension = $file->getClientOriginalExtension();
                        $fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
                        $folderpath  = public_path('/storage/items');
                        $file->move($folderpath , $fileName);
                        /* new code */      
                        $watermarkImg=Image::make($url.'/public/storage/settings/'.$watermark);
                        $img=Image::make($url.'/public/storage/items/'.$fileName);
                        $wmarkWidth=$watermarkImg->width();
                        $wmarkHeight=$watermarkImg->height();
            
                        $imgWidth=$img->width();
                        $imgHeight=$img->height();
            
                        $x=0;
                        $y=0;
                        while($y<=$imgHeight){
                            $img->insert($url.'/public/storage/settings/'.$watermark,'top-left',$x,$y);
                            $x+=$wmarkWidth;
                            if($x>=$imgWidth){
                                $x=0;
                                $y+=$wmarkHeight;
                            }
                        }
                        $img->save(base_path('public/storage/items/'.$fileName));
                        /* new code */
                        $imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
                        Products::saveitemImages($imgdata);

                    }
                }
                else
                {
                    $files = $request->file('item_screenshot');
                    foreach($files as $file){
                        
                        $extension = $file->getClientOriginalExtension();
                        $fileName = Str::random(5)."-".date('his')."-".Str::random(3).".".$extension;
                        $folderpath  = public_path('/storage/items');
                        $file->move($folderpath , $fileName);
                        $imgdata = array('item_token' => $item_token, 'item_image' => $fileName);
                        Products::saveitemImages($imgdata);

                    }
                }
           }

        //   $data = array('user_id' => $user_id, 'item_token' => $item_token, 'item_name' => $item_name, 'item_desc' => $item_desc, 'item_preview' => $item_preview, 'item_category' =>$cat_id, 'item_category_type' => $cat_name, 'item_type' => $item_type,'demo_url' => $demo_url, 'item_tags' => $item_tags, 'item_status' => $item_status, 'item_shortdesc' => $item_shortdesc, 'item_slug' => $item_slug, 'created_item' => $created_item, 'updated_item' => $updated_item,'drop_status'=>$drop_status,'regular_price' => $regular_price, 'extended_price' => $extended_price,'manufacturers_id'=>$manufacturer,'weight'=>$weight,'length'=>$length,'width'=>$width,'height'=>$height);
        //     //echo "<pre>";print_r($s);exit;
            
        // $itemsIdd= Items::updateitemData($item_token,$data);

        $item_approve_status="Product has been updated with new ui";

        return redirect('/admin/upload-newitems')->with('success', $item_approve_status);



    }

    public function item_slug($string){
           $slug=strtolower(str_replace(' ', '-', $string));
           return $slug;
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

    public function delete_item_request($token)
    {
    
      $data = array('drop_status'=>'yes', 'item_status' => 0);
      
      Products::admindeleteData($token,$data);
      
      return redirect()->back()->with('success', 'Product Deleted Successfully.');
    
    }
  public function rvybe_item_request($tiem_ravybeexc,$item_token) // RvybeExclusive
    {
       if($tiem_ravybeexc == '1')
       {
         $tiem_ravybeexc_text = '0';
       }
       else
       {
         $tiem_ravybeexc_text = '1';
       }
       $data = array('tiem_ravybeexc'=> $tiem_ravybeexc_text);
       
       Products::admindeleteData($item_token,$data);
       
       return redirect()->back();
    
    }
    public function featured_item_request($item_stafffav,$item_token) // staf fave 
    {
       if($item_stafffav == 'yes')
       {
         $item_stafffav_text = 'no';
       }
       else
       {
         $item_stafffav_text = 'yes';
       }
       $data = array('item_stafffav'=> $item_stafffav_text);
       
       Products::admindeleteData($item_token,$data);
       
       return redirect()->back();
    
    }



    public function fetch_vendor_hotel_room(Request $request){

        $user_id=$request->user_id;

       // $sel_hotel=implode(",",$request->sel_hotel);
         
         $sel_hotel=$request->sel_hotel;
         $sel_room=$request->sel_room;

        
        $q=Items::with('hasManysItemroom');
        //->where('user_id','=',$user_id);
                $q=$q->where(function($q){
                $q->where('item_type','=','hotel')->orWhere('item_type','=','restaurant')->orWhere('item_type','=','spa');
            })->whereHas('hasManysItemroom',function($q) use($sel_hotel){
                $q->whereIn('item_id',$sel_hotel);
            })->whereIn('item_id',$sel_hotel)->get();
        //echo "<pre>";print_r($q);exit;
    
        $hotel_html='';$room_html='';$html='';


        
          $room_html.='<div class="options_group testtest" id="removerhtml">';
           $room_html.=' <p class="form-field">';
             $room_html.='  <label>Room Type</label>';
        if(count($q) > 0){
          
            $room_html.='<select name="room_type[]" id="room_type"  multiple="multiple" class="form-control">';
            foreach($q as $key=>$value){


                $itemroom=$value->hasManysItemroom ? $value->hasManysItemroom : '';

                if(!empty($itemroom)){
                    
                    foreach($itemroom as $key1=>$value1){

                        $roomname=Roomtype::viewItemtype($value1->item_loccate_id);

                        //echo "<pre>";print_r($roomname);exit;
                        $html.=$value1->item_loccate_id.",";
                        if(!empty($roomname)){
                            $sel1='';
                            if(in_array($value1->item_loccate_id,$sel_room)){
                                $sel1="selected='selected'";
                            }
                            $room_html.='<option value="'.$roomname->item_type_id.'" '.$sel1.'>'.$roomname->item_type_name.'</option>';

                        }

                    

                    }
                    
                }
                // $sel='';
                // if(in_array($value->item_id,$sel_hotel)){
                //     $sel="selected='selected'";
                // }
          //  $hotel_html.='<option value="'.$value->item_id.'" '.$sel.'>'.$value->item_name.'</option>';

            }

           // $hotel_html.='</select>';
        }
      //   $hotel_html.='</div>';
        $room_html.='</select>';
         $room_html.='</p>';
        $room_html.='</div>';


        echo $room_html;
        exit;



    }

    public function drop_image_item($dropimg,$token){
       
        $token = base64_decode($token); 
        Products::deleteimgdata($token);
        return redirect()->back()->with('success', 'Delete successfully.');
    
    }
    

	
}
