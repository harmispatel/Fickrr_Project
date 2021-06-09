<?php

namespace Fickrr\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Fickrr\Http\Controllers\Controller;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Mail;
use Excel;
use Fickrr\Models\ExportProduct;
use Fickrr\Models\ExportProduct1;
use Fickrr\Models\ImportProduct;
use Fickrr\Models\ImportItem;
use Fickrr\Models\Products;
use Fickrr\Models\ExportVendor;
use Fickrr\Models\ImportVendor;

// "php": "^7.1.3",
//         "fideloper/proxy": "^4.0",
//         "laravel/framework": "5.7.*",
//         "laravel/tinker": "^1.0",
//         "maatwebsite/excel": "^3.1",
//         "predis/predis": "^1.1",
//         "uxweb/sweet-alert": "^2.0"
// Controller:

class ImportExportController extends Controller
{
   
    public function __construct(){
        $this->middleware('auth');
		
    }
	
	public function view_products_import_export()
    {
        
		return view('admin.products-import-export');
		
    }

    public function view_item_import_export(){
        return view('admin.items-import-export');
    }

    public function view_vendor_import_export(){

         return view('admin.vendor-import-export');

    }
	
	public function download_products_export($type)
    {
	   $filename = "vendorstore_".uniqid().'.'.$type;
	   return Excel::download(new ExportProduct, $filename);
		
    }



    public function download_products_export1($type1){
        $filename = "products_".uniqid().'.'.$type1;

      return Excel::download(new ExportProduct1, $filename);
    
    
            // $data = Products::get()->toArray();
        //        // echo "<pre>";print_r($data);exit;

                // return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

        //     $excel->sheet('mySheet', function($sheet) use ($data){
        //         $sheet->fromArray($data);
        //     });

        // })->download($type1);
    }

     public function download_vendor_export($type){

       $filename = "vendor_".uniqid().'.'.$type;
      return Excel::download(new ExportVendor, $filename);

      
    }

    public function items_import(Request $request){

        //   echo "abc" ; exit;

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::import(new ImportItem,$request->file('import_file'));

          //  Excel::import(new UsersImport, 'users.xlsx');
       //new ImportItem,$request->file('import_file')

      //  echo "<pre>";print_r($data);exit;
        return redirect()->back()->with('success', 'Imported successfully.'); 


    }

    public function vendor_import(Request $request){

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::import(new ImportVendor,$request->file('import_file'));
        return redirect()->back()->with('success', 'Imported successfully.'); 

    }
	
	public function products_import(Request $request){
        //echo "<pre>";print_r($request->file('import_file'));
        // Excel::import(new ImportProduct, $request->file('import_file'));exit;
        // return redirect()->back()->with('success', 'Imported successfully.');   

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::import(new ImportProduct,$request->file('import_file'));
        return redirect()->back()->with('success', 'Imported successfully.');   
        //exit;
        //      if($data->count()){
        //         foreach ($data as $key => $value) {

        //            // echo "<pre>";print_r($value);
        //            // $arr[] = ['name' => $value->name, 'details' => $value->details];
        //    }
        //         // if(!empty($arr)){
        //         //     DB::table('product')->insert($arr);
        //         //     dd('Insert Record successfully.');
        //         // }
        //     }
        // exit;

       // $item_name = ;
       // $item_slug =

       //  $item_type =;
       // $type_id = ;

       // $item_status= // published

       //   $drop_status= // item visiblity inc atalogur
       //   $item_shortdesc=; //
       //   $item_desc=;//

       //   $regularprice=//
       //   $saleprice=//
       //   $tags=//



        /*if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::import($path)->get();
            if($data->count()){
                foreach ($data as $key => $value) {
                    $arr[] = ['name' => $value->name, 'details' => $value->details];
                }
                if(!empty($arr)){
                    DB::table('product')->insert($arr);
                    dd('Insert Record successfully.');
                }
            }
        }
		
        dd('Request data does not have any files to import.');*/ 
		//Excel::import(new ImportProduct, $request->file('import_file'));
		//return redirect()->back()->with('success', 'Imported successfully.');   
    } 
	
	
	
}
