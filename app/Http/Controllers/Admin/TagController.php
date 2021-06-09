<?php

namespace Fickrr\Http\Controllers\Admin;

use Fickrr\Http\Controllers\Controller;
use Fickrr\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /* tag */

    public function tag()
    {

//         $to_email = 'harmistest@gmail.com';
//         $subject = "THis is first";
// //   $to_email = "to@example.com";
//   $to_fullname = "John Doe";
// //   $from_email = "harmistest@gmail.com";
//   $from_email = "info@ghaith.com";
//   $from_fullname = "Jane Doe from";
//   $headers  = "MIME-Version: 1.0";
//   $headers .= "Content-type: text/html; charset=utf-8";
//   // Additional headers
//   // This might look redundant but some services REALLY favor it being there.
//   $headers .= "To: $to_fullname <$to_email>";
//   $headers .= "From: $from_fullname <$from_email>";
//   $message = "<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en'>
//   <head>
//     <title>Hello Test</title>
//   </head>
//   <body>
//     <p></p>
//     <p style='color: #00CC66; font-weight:600; font-style: italic; font-size:14px; float:left; margin-left:7px;'>You have received an inquiry from your website.  Please review the contact information below.</p>
//   </body>
//   </html>";
//   if (!mail($to_email, $subject, $message, $headers)) { 
//     print_r(error_get_last());
//   }
//   else { 
//    echo '<h3 style="color:#d96922; font-weight:bold; height:0px; margin-top:1px;">Thank You For Contacting us!!</h3>';

//   }exit;

  
        $tagData['tagData'] = Tag::gettagData();
        return view('admin.tag', ['tagData' => $tagData]);
    }

    public function add_tag()
    {
        return view('admin.add-tag');
    }

    public function tag_slug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }

    public function save_tag(Request $request)
    {

        $tag_name = $request->input('tag_name');
        $tag_slug = $this->tag_slug($tag_name);
        $tag_status = $request->input('tag_status');
        if (!empty($request->input('menu_order'))) {
            $menu_order = $request->input('menu_order');
        } else {
            $menu_order = 0;
        }

        $request->validate([
            'tag_name' => 'required',
            'tag_status' => 'required',

        ]);
        $rules = array(
            'tag_name' => ['required', 'max:255', Rule::unique('tag')->where(function ($sql) {$sql->where('drop_status', '=', 'no');})],

        );

        $messsages = array(

        );

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {

            $data = array('tag_name' => $tag_name, 'tag_slug' => $tag_slug, 'tag_status' => $tag_status, 'menu_order' => $menu_order);
            Tag::inserttagData($data);
            return redirect('/admin/tag')->with('success', 'Insert successfully.');

        }

    }

    public function delete_tag($tag_id)
    {

        $data = array('drop_status' => 'yes');

        Tag::deleteTagdata($tag_id, $data);

        return redirect()->back()->with('success', 'Delete successfully.');

    }

    public function edit_tag($tag_id)
    {

        $edit['tag'] = Tag::editTagData($tag_id);
        return view('admin.edit-tag', ['edit' => $edit, 'tag_id' => $tag_id]);
    }

    public function update_tag(Request $request)
    {

        $tag_name = $request->input('tag_name');
        $tag_slug = $this->tag_slug($tag_name);
        $tag_status = $request->input('tag_status');
        if (!empty($request->input('menu_order'))) {
            $menu_order = $request->input('menu_order');
        } else {
            $menu_order = 0;
        }

        $tag_id = $request->input('tag_id');
        $request->validate([
            'tag_name' => 'required',
            'tag_status' => 'required',

        ]);
        $rules = array(
            'tag_name' => ['required', 'max:255', Rule::unique('tag')->ignore($tag_id, 'tag_id')->where(function ($sql) {$sql->where('drop_status', '=', 'no');})],

        );

        $messsages = array(

        );

        $validator = Validator::make($request->all(), $rules, $messsages);

        if ($validator->fails()) {
            $failedRules = $validator->failed();
            return back()->withErrors($validator);
        } else {

            $data = array('tag_name' => $tag_name, 'tag_slug' => $tag_slug, 'tag_status' => $tag_status, 'menu_order' => $menu_order);
            Tag::updateTag($tag_id, $data);
            return redirect('/admin/tag')->with('success', 'Update successfully.');
        }
    }

     public function save_tag_ajax(Request $request)
    {
 
    
        //echo "<pre>";print_r($request->all());exit;
         $item_tags = $request->input('item_tags');
         // $subcategory_name = $request->input('subcategory_name');
         // $subcategory_slug = $this->category_slug($subcategory_name);
         // $subcategory_status = $request->input('subcategory_status');
        
         
         
         
         $request->validate([
                            'item_tags' => 'required',
                          //  'subcategory_name' => 'required',
                          //  'subcategory_status' => 'required',
                            
         ]);
         $rules = array(
                /*'subcategory_name' => ['required', 'max:255', Rule::unique('subcategory') -> where(function($sql){ $sql->where('drop_status','=','no');})],*/
                
         );
         
         $messsages = array(
              
        );
         
        $validator = Validator::make($request->all(), $rules,$messsages);
        
        if ($validator->fails()) 
        {
         $failedRules = $validator->failed();
        //  return back()->withErrors($validator);
         $returnArray = array('success'=>1, 'message'=>$validator);
         echo json_encode($returnArray);
            exit;
        } 
        else
        {

            // $categories=explode("_",$cat_id);
            // if($categories[1] == 0){

            //     $subcatparent_id = 0;
            //     $cat_id=$categories[0];

            // }else{

            //     $subcatparent_id = $categories[0];
            //     $cat_id=$categories[1];

            // }
        //$categories=explode("_",$cat_id);
        
        
         
        $data = array('tag_name' => $item_tags, 'tag_slug' => $item_tags, 'tag_status' => 1);
        $lastId=Tag::inserttagData($data);
        $html='';
        $html.='<li id="db_'.$lastId.'">';
       // $html.='<a href="javascript:void(0)" role="button" class="tag-cloud-link" onclick="addTagItem(\'.$value->tag_name.\',\'.$lastId.\')">'.$tag_name.'</a>';
       
        $clsname='fa fa-check';
        $removeclasname='fa fa-times-circle';
        $html.='<button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick="removeTagItem(\''.$lastId.'\',\''.$clsname.'\',\''.$item_tags.'\',\''.$removeclasname.'\')">';
        $html.='<i class="fa fa-check" aria-hidden="true"></i>';
        $html.='</button>&nbsp;'.$item_tags.'<input type="hidden" name="tag_id[]" id="tagstags" value="'.$lastId.'" />';
        $html.='</li>';

        
        $returnArray = array('success'=>1, 'message'=>'Insert successfully.','html'=>$html);
        echo json_encode($returnArray);exit;
        // return redirect('/admin/sub-category')->with('success', );   
 
       } 
     
    
  }

}
