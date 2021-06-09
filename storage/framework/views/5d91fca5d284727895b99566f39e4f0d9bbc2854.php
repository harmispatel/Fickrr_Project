<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    
    <?php echo $__env->make('admin.stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    
    <?php echo $__env->make('admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Right Panel -->
    <?php if(in_array('items',$avilable)): ?>
    <div id="right-panel" class="right-panel">

        
             <?php echo $__env->make('admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                       

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?php echo e(Helper::translation(2935,$translate)); ?> - <?php echo e(@$type_name->item_type_name); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    
                </div>
            </div>
        </div>
        
        <?php if(session('success')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="col-sm-12">
     <div class="alert  alert-danger alert-dismissible fade show" role="alert">
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
         <?php echo e($error); ?>

      
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
     </div>
    </div>   
 <?php endif; ?>
       
       <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                           <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                           <form action="<?php echo e(route('admin.edit-item')); ?>" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
                           <?php echo e(csrf_field()); ?>

                           <?php endif; ?>
                          
                           
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                   
                                        <div class="form-group">
                                                <label for="name" class="control-label mb-1">Item Type <span class="require">*</span></label>
                                               
                                                <select name="item_type" id="item_type" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                   <?php $__currentLoopData = $getWell['type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                    <option value="<?php echo e($value->item_type_slug); ?>" <?php if($edit['item']->item_type == $value->item_type_slug): ?> selected="selected" <?php endif; ?>><?php echo e($value->item_type_name); ?></option>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </select>
                                            </div>
                                            <!--  <input type="hidden" name="item_type" value="<?php echo e($edit['item']->item_type); ?>">
                                            <input type="hidden" name="type_id" value="<?php echo e($typer_id); ?>"> -->
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2938,$translate)); ?><span class="require">*</span></label>
                                               <input type="text" id="item_name" name="item_name" class="form-control" value="<?php echo e($edit['item']->item_name); ?>" data-bvalidator="required,maxlen[100]"> 
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2940,$translate)); ?><span class="require">*</span></label>
                                                <textarea name="item_shortdesc" rows="6"  class="form-control" data-bvalidator="required"><?php echo e($edit['item']->item_shortdesc); ?></textarea>
                                            
                                            </div>
                                            
                                             <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2941,$translate)); ?><span class="require">*</span></label>
                                                
                                            <textarea name="item_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required"><?php echo e(html_entity_decode($edit['item']->item_desc)); ?></textarea>
                                            </div>
                                                
                                            
                                        <!--     <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2943,$translate)); ?> <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_thumbnail" name="item_thumbnail" class="files"><small>(<?php echo e(Helper::translation(2946,$translate)); ?> : 80x80px)</small><br/>
                                                <?php if($edit['item']->item_thumbnail!=''): ?>
                                                <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_thumbnail); ?>" alt="<?php echo e($edit['item']->item_name); ?>" class="item-thumb">
                                                <?php else: ?>
                                                <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" class="item-thumb">
                                                <?php endif; ?>
                                           
                                            </div>
                                             -->
                                            
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">Home page <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_preview" name="item_preview" class="files"><small>(<?php echo e(Helper::translation(2946,$translate)); ?> : 180x180px)</small><br/>
                                                    <?php if($edit['item']->item_preview!=''): ?>
                                                    <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_preview); ?>" alt="<?php echo e($edit['item']->item_name); ?>" class="item-thumb">
                                                    <?php else: ?>
                                                    <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" class="item-thumb">
                                                    <?php endif; ?>
                                           
                                            </div>
                                            
                                            
                                            
                                          <!--    <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2947,$translate)); ?>  <span class="require">*</span> </label><br/>
                                                <input type="file" id="item_file" name="item_file" class="files"><small>(<?php echo e(Helper::translation(2948,$translate)); ?>)</small>
                                                   
                                                    <?php
                                                    if($allsettings->site_s3_storage == 1)
                                                    {
                                                    if(Storage::disk('s3')->exists($edit['item']->item_file))
				                                    {
                                                    $fileurl = Storage::disk('s3')->url($edit['item']->item_file);
                                                    }
                                                    else
                                                    {
                                                    $fileurl = "";
                                                    }
                                                    ?>
                                                    <br/><a href="<?php echo e($fileurl); ?>" class="blue-color" download><?php echo e($edit['item']->item_file); ?></a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <br/><?php if($edit['item']->item_file!=''): ?><a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_file); ?>" class="blue-color" download><?php echo e($edit['item']->item_file); ?></a><?php endif; ?>
                                                    <?php
                                                    }
                                                    ?>
                                                
                                           
                                            </div>   -->
                                            <?php 
                                                // echo "<pre>";print_r($item_image['item']);

                                            $old_item_image='';$old_room_image='';
                                            ?>
                                            <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1">About Images</label><br/>
                                                    <input type="file" id="item_screenshot" name="item_screenshot[]" class="files"><small>(<?php echo e(Helper::translation(2946,$translate)); ?> : 250x250px)</small><br/><br/><?php $__currentLoopData = $item_image['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        <div class="item-img"><img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_image); ?>" alt="<?php echo e($item->item_image); ?>" class="item-thumb">
                                                        <a href="<?php echo e(url('/admin/edit-item')); ?>/dropimg/<?php echo e(base64_encode($item->itm_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');" class="drop-icon"><span class="ti-trash drop-icon"></span></a>
                                                        </div>


                                                        <?php $old_item_image.=$item->item_image ."@"; ?>
                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="clearfix"></div>
                                            </div> 
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(5229,$translate)); ?> </label>
                                               <select name="video_preview_type" id="video_preview_type" class="form-control">
                                                <option value=""></option>
                                                    <option value="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5925,$translate)); ?></option>
                                                    <option value="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5928,$translate)); ?></option>
                                                </select>
                                            </div>
                                            
                                          

                                            <div id="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2967,$translate)); ?> <span class="require">*</span></label>
                                                
                                                <input type="text" id="video_url" name="video_url" class="form-control" value="<?php echo e($edit['item']->video_url); ?>" data-bvalidator="required">
                                                <small>(<?php echo e(Helper::translation(2968,$translate)); ?> : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                                            </div>
                                            
                                            <div id="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(5910,$translate)); ?> <span class="require">*</span></label><br/>
                                                <input type="file" id="video_file" name="video_file" class="files"><small>(<?php echo e(Helper::translation(5913,$translate)); ?>)</small>
                                                    <?php
                                                    if($allsettings->site_s3_storage == 1)
                                                    {
                                                    if(Storage::disk('s3')->exists($edit['item']->video_file))
				                                    {
                                                    $videofileurl = Storage::disk('s3')->url($edit['item']->video_file);
                                                    }
                                                    else
                                                    {
                                                    $videofileurl = "";
                                                    }
                                                    ?>
                                                    <br/><a href="<?php echo e($videofileurl); ?>" class="blue-color" download><?php echo e($edit['item']->video_file); ?></a>
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <br/><?php if($edit['item']->video_file!=''): ?><a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->video_file); ?>" class="blue-color" download><?php echo e($edit['item']->video_file); ?></a><?php endif; ?>
                                                    <?php
                                                    }
                                                    ?>
                                            </div>  
                                            
                                          <!--    <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2969,$translate)); ?>?<span class="require">*</span></label>
                                               <select name="free_download" id="free_download" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                    <option value="1" <?php if($edit['item']->free_download == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                                                    <option value="0" <?php if($edit['item']->free_download == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                                                </select>
                                            </div> -->
                                           
                                           
                                           <div class="form-group">
                                                <label for="site_desc" class="control-label mb-1"><?php echo e(Helper::translation(2974,$translate)); ?></label>
                                                <textarea name="item_tags" id="item_tags" class="form-control"><?php echo e($edit['item']->item_tags); ?></textarea>
                                                <small>(<?php echo e(Helper::translation(2975,$translate)); ?>)</small>
                                            
                                            </div> 
                                            
                                            
                                       
                                            
                                           
                                    </div>
                                </div>

                            </div>
                            </div>
                             
                            <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                      <!--   <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2952,$translate)); ?> <span class="require">*</span></label>
                                               <select name="item_category" id="item_category" class="form-control" data-bvalidator="required">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = $categories['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                <option value="category_<?php echo e($menu->cat_id); ?>" <?php if($cat_name == 'category'): ?> <?php if($menu->cat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>><?php echo e($menu->category_name); ?></option>
                                                <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="subcategory_<?php echo e($sub_category->subcat_id); ?>" <?php if($cat_name == 'subcategory'): ?> <?php if($sub_category->subcat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>> - <?php echo e($sub_category->subcategory_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                                
                                            </div> -->
                                          <!--  -->
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(trans('labels.storeurl')); ?></label>
                                                <input type="text" id="demo_url" name="demo_url" class="form-control" value="<?php echo e($edit['item']->demo_url); ?>" data-bvalidator="url"  data-bvalidator="required">
                                                
                                            </div>
                                            
                                        <!--     <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2979,$translate)); ?> </label>
                                                <input type="text" id="regular_price" name="regular_price"  class="form-control" value="<?php echo e($edit['item']->regular_price); ?>" data-bvalidator="digit,min[1],required">
                                                (<?php echo e($allsettings->site_currency); ?>)
                                            </div>  
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(Helper::translation(2980,$translate)); ?> </label>
                                                
                                                <input type="text" id="extended_price" name="extended_price" class="form-control" value="<?php if($edit['item']->extended_price==0): ?> <?php else: ?> <?php echo e($edit['item']->extended_price); ?> <?php endif; ?>" data-bvalidator="digit,min[1]">
                                                (<?php echo e($allsettings->site_currency); ?>)
                                            </div> 
                                             -->

                                            <div class="form-group">
                                                <label for="phonenumber" class="control-label mb-1"> <?php echo e(trans('labels.phonenumber')); ?> <span class="require">*</span></label>
                                                <input type="text" id="phonenumber" name="phonenumber" class="form-control" value="<?php echo e(@$edit['item']->phonenumber); ?>" >
                                                
                                            </div> 

                                              <div class="form-group">
                                                <label for="website" class="control-label mb-1"> <?php echo e(trans('labels.website')); ?> <span class="require">*</span></label>
                                                <input type="text" id="website" name="website" class="form-control" value="<?php echo e(@$edit['item']->website); ?>" >
                                                
                                            </div> 


                                             <div class="form-group">
                                                <label for="website" class="control-label mb-1"> <?php echo e(trans('labels.email')); ?> <span class="require">*</span></label>
                                                <input type="text" id="email" name="email" class="form-control" value="<?php echo e(@$edit['item']->email); ?>" >
                                                
                                            </div> 

                                            
                                             <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1"><?php echo e(trans('labels.socialmedialinksfacebook')); ?></label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control" value="<?php echo e(@$edit['item']->facebook); ?>"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1"><?php echo e(trans('labels.instagram')); ?></span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control" value="<?php echo e(@$edit['item']->instagram); ?>"/>
                                            
                                            </div>

                                             <div class="form-group">
                                                    <label for="instagram" class="control-label mb-1"><?php echo e(trans('labels.twitterurl')); ?></span></label>
                                                    <input name="twitterurl" id="twitterurl" type="text"  class="form-control" value="<?php echo e(@$edit['item']->twitterurl); ?>"/>
                                            </div>

                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1"><?php echo e(trans('labels.linkedin')); ?></span></label>
                                                <input name="linkedin" id="linkedin" type="text"  class="form-control" value="<?php echo e(@$edit['item']->linkedin); ?>"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1"><?php echo e(trans('labels.youtube')); ?></label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control" value="<?php echo e(@$edit['item']->youtube); ?>"/>
                                            
                                            </div>




                                            <?php if($edit['item']->item_flash_request == 1): ?>
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(2993,$translate)); ?> <span class="require">*</span></label>
                                                <select name="item_flash" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['item']->item_flash == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2874,$translate)); ?></option>
                                                <option value="0" <?php if($edit['item']->item_flash == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2875,$translate)); ?></option>
                                                
                                                </select>
                                                
                                            </div> 
                                            <?php else: ?>
                                            <input type="hidden" name="item_flash" value="0">
                                            <?php endif; ?>
                                            
                                                                                                                          
                                            
                                            <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(2873,$translate)); ?> <span class="require">*</span></label>
                                                <select name="item_status" class="form-control" data-bvalidator="required">
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['item']->item_status == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(5232,$translate)); ?></option>
                                                <option value="0" <?php if($edit['item']->item_status == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(3092,$translate)); ?></option>
                                                <option value="2" <?php if($edit['item']->item_status == 2): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(5235,$translate)); ?></option>
                                                </select>
                                                
                                            </div>   

                                            <div class="form-group">
                                                 <label for="site_title" class="control-label mb-1"><?php echo e(trans('labels.hotelgeolocation')); ?><span class="require">*</span></label>
                                                <input type="text" name="location" id="autocomplete" onFocus="geolocate()"  placeholder="Location" data-bvalidator="required"  value="<?php echo e($edit['item']->address); ?>" class="form-control"  >
                                                <span class="button-fetri" ><img src="<?php echo e(url('/')); ?>/public/storage/items/googlemaps.jpeg"  style="width: 20px;"/></span>
                                            </div> 

                                            <div class="form-group">
                                                <label for="designer" class="control-label mb-1"><?php echo e(trans('labels.designer')); ?></label>
                                               <select name="designer" id="designer" class="form-control">
                                                <option value=""></option>
                                                <?php $__currentLoopData = $designers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designerId=>$designer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($designerId); ?>" <?php if($designerId == $designershops->designer_id): ?> selected <?php endif; ?>><?php echo e($designer); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>



                                             <div class="form-group add-tags-main">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(trans('labels.roomtype')); ?><span class="require">*</span></label>
                                               <select name="room_type[]" id="room_type[]" class="form-control" data-bvalidator="required" multiple="multiple">
                                                    <?php $__currentLoopData = $itemWell['roomtype']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                       <option value="<?php echo e($item_type->item_type_id); ?>" <?php if(in_array($item_type->item_type_id,$item_room)): ?> selected="selected" <?php endif; ?>><?php echo e($item_type->item_type_name); ?></option>
                                       
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select> 
                                               <!--   <ul class="tagchecklist" role="list" id="tagul"> -->
                                                <!-- <li>
                                                    <button type="button" id="product_tag-check-num-0" class="ntdelbutton">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </button>&nbsp;tag1
                                                </li>
                                                <li>
                                                    <button type="button" id="product_tag-check-num-1" class="ntdelbutton">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </button>&nbsp;tag2
                                                </li>
                                                -->

                                            <?php 

                                            //$html1='';  
                                          //  if(count($itemWell['roomtype']) > 0){
                                                       // foreach($itemWell['roomtype'] as $key=>$value){


                                                            
                                                          
                                                              // if(in_array($value->item_type_id,@$item_room)) {

                                                                ?>

                                                                 <!--  <li  id="db_<?php echo e($value->item_type_id); ?>">

                                                                   <div class="roomtype-main">
                                                                <button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick="removeTagItem('<?php //echo $value->item_type_id; ?>','fa fa-times-circle','<?php // echo $value->item_type_name; ?>','fa fa-check')"><i class="fa fa-check" aria-hidden="true"></i></button>
                                                                <input type="file" name="room_images_<?php echo e($value->item_type_id); ?>" id="room_images">
                                                                  <label> &nbsp;<?php echo e($value->item_type_name); ?> </label>



                                                                 </div> -->

                                                                     <?php 
                                                                        // $roomimages=DB::table('item_room')->where('item_id',$edit['item']->item_id)->where('item_loccate_id',$value->item_type_id)->first();
                                                                        ?>
                                                                  <!--   <?php if(!empty($roomimages) && file_exists(public_path('storage/items/'.$roomimages->room_image ))): ?>
                                                                       <div class="roomtype-img">
                                                                            <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($roomimages->room_image); ?>" />
                                                                        </div>
                                                                     <?php endif; ?> -->

                                                                   <!-- <?php if(in_array($value->item_type_id,@$item_room)): ?>   -->
                                                                  <!--   <input type="hidden" name="room_type[]" id="tagstags" value="<?php echo e($value->item_type_id); ?>" /> <?php endif; ?>
                                                                    </li>
                                                               -->
                                                                
                                                                   <?php 

                                //                                } else{

                                //                                             $html1.='<li  id="db_'.$value->item_type_id.'">';
                                // $html1.='<button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick=removeTagItem('.$value->item_type_id.',"fa fa-check",\""'.$value->item_type_name.'"\",\""fa fa-times-circle"\")>'; 
                                //                                                      $html1.='<i class="fa fa-times-circle" aria-hidden="true"></i>'; 
                                //                                                     $html1.='<input type="file" name="room_images_'.$value->item_type_id.'" id="room_images" style="display:none;"/>';
                                                                                     

                                //                                             $html1.='</button>';

                                //                                              $html1.='<label> &nbsp;'.$value->item_type_name.'</label>
                                //                                             </li>';

                                //                                 }

                                //                                   } }


                                                                  ?>

                                           
                                                          
                                                        



                                             <?php 
                                           // echo $html1;
                                             ?>
                                                
                                     <!--    </ul> -->
                                            </div>

                                              <div class="form-group add-tags-main">
                                                <label for="site_title" class="control-label mb-1">Multiple Room Images<span class="require">*</span></label>
                                               <input type="file" class="form-control" name="room_img[]" id="room_img" multiple="multiple">
                                                    
                                             <?php $__currentLoopData = $item_room_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        
                                                        <div class="item-img"><img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_image); ?>" alt="<?php echo e($item->item_image); ?>" class="item-thumb">
                                                      <!--   <a href="<?php echo e(url('/admin/edit-item')); ?>/dropimg/<?php echo e(base64_encode($item->itm_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(5064,$translate)); ?>?');" class="drop-icon"><span class="ti-trash drop-icon"></span></a> -->
                                                        </div>


                                                        <?php $old_room_image.=$item->item_image ."@"; ?>
                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>



                                        <?php 
                                       // echo "<pre>";print_r($item_manfact);
                                        ?>

                                     

                                        <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">    
                                        <input type="hidden" name="save_file" value="<?php echo e($edit['item']->item_file); ?>">
                                        <input type="hidden" name="latitude" id="latitude" value="">    
                                        <input type="hidden" name="longitude" id="longitude" value="">
                                        <input type="hidden" name="old_item_image" id="old_item_image" value="<?php echo  $old_item_image; ?>">
                                        <input type="hidden" name="old_room_image" id="old_room_image" value="<?php echo  $old_room_image; ?>">

                                     <!--    <input type="hidden" name="save_thumbnail" value="<?php echo e($edit['item']->item_thumbnail); ?>"> -->
                                        <input type="hidden" name="save_preview" value="<?php echo e($edit['item']->item_preview); ?>">
                                        <input type="hidden" name="save_extended_price" value="<?php echo e($edit['item']->extended_price); ?>">
                                        <input type="hidden" name="item_token" value="<?php echo e($edit['item']->item_token); ?>">
                                        <input type="hidden" name="save_video_file" value="<?php echo e($edit['item']->video_file); ?>">
                                        <input type="hidden" name="item_id" value="<?php echo e($edit['item']->item_id); ?>">
                                          
                                           
                                    </div>
                                </div>

                            </div>
                            </div> 
                             
                             <div class="col-md-12 no-padding">
                             <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?></button>
                                 <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?> </button>
                             </div>
                             
                             </div>
                             
                            
                            </form>
                            
                                                    
                                                    
                                                 
                            
                        </div> 

                     
                    
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div>
        
        
        <!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


<?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">

   /* function removeTagItem(tagid,clsname,tagname,addclsname){
        

                    $("#db_"+tagid).remove();
                    $("#db_"+tagid).remove();
                    var htmlimage='';
                    var html='<li id="db_'+tagid+'">';
                    html=html+'<button type="button" id="product_tag-check-num-1" class="ntdelbutton" onClick="removeTagItem('+tagid+',\''+addclsname+'\',\''+tagname+'\',\''+clsname+'\')">';
                    html=html+'<i class="'+clsname+'" aria-hidden="true"></i>';
                    html=html+'</button>';

                    if(clsname == 'fa fa-check'){
                        html=html+'<input type="hidden" name="room_type[]" id="tagstags" value="'+tagid+'" />';  
                        html=html+'<input type="file" name="room_images_'+tagid+'" id="room_images" />';
                       // $("#roomImg_"+tagid).show();
                       // htmlimage=htmlimage +  '<input type="file" name="room_images[]" id="room_images" />';  
                    }
                    html=html+'&nbsp;'+tagname;
                    html=html+'</li>';
                    jQuery("#tagul").append(html);

    }*/


	$(document).ready(function()
	{
	$('#video_preview_type').on('change', function() {
      if ( this.value == 'youtube')
      
      {
	     $("#youtube").show();
		 $("#mp4").hide();
	  }	
	  else if ( this.value == 'mp4')
	  {
	     $("#mp4").show();
		 $("#youtube").hide();
	  }
	  else
	  {
	      $("#mp4").hide();
		  $("#youtube").hide();
	  }
	  
	 });
});
</script>
  <script>
        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };
        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {types: ['geocode']});
        
            autocomplete.setFields(['address_component']);
            autocomplete.addListener('place_changed', fillInAddress);
        }
    
        // function fillInAddress() {
        //     var place = autocomplete.getPlace();
        //     for (var component in componentForm) {
        //        document.getElementById(component).value = '';
        //        document.getElementById(component).disabled = false;
        //     }
        //     for (var i = 0; i < place.address_components.length; i++) {
        //         var addressType = place.address_components[i].types[0];
        //         if (componentForm[addressType]) {
        //             var val = place.address_components[i][componentForm[addressType]];
        //             document.getElementById(addressType).value = val;
        //         }
        //     }
        // }
    
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    document.getElementById('latitude').value=geolocation.lat;
                    document.getElementById('longitude').value=geolocation.lng;
                    
                });
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDXb_Mq0lK0KfNT-1l4NxdUEHDNmIcPmFE&libraries=places&callback=initAutocomplete" async defer></script>
    
</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/edit-item.blade.php ENDPATH**/ ?>