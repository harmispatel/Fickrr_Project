
<?php $__env->startSection('content'); ?>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i><?php echo e(Helper::translation(4878,$translate)); ?></a></div>
            <!-- Actual menu-->
            <?php if(Auth::user()->id != 1): ?>
                <?php echo $__env->make('user.dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
          </aside>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <!-- Product-->
            <form action="<?php echo e(route('edit-item')); ?>" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row">
             <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div> <b><?php echo e(Helper::translation(2986,$translate)); ?></b><br/><?php echo e(Helper::translation(2987,$translate)); ?> <?php echo e(Helper::translation(2988,$translate)); ?>

              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div><b><?php echo e(Helper::translation(2983,$translate)); ?> :</b> <?php echo e(Helper::translation(5961,$translate)); ?><br/><b><?php echo e(Helper::translation(2985,$translate)); ?> :</b> <?php echo e(Helper::translation(5964,$translate)); ?> 
              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <h4><?php echo e(Helper::translation(2936,$translate)); ?></h4>
              </div>
              <input type="hidden" name="item_type" value="<?php echo e($edit['item']->item_type); ?>">
              <input type="hidden" name="type_id" value="<?php echo e($typer_id); ?>"> 
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2938,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2939,$translate)); ?>)</label>
                  <input type="text" id="item_name" name="item_name" class="form-control" data-bvalidator="required,maxlen[100]" value="<?php echo e($edit['item']->item_name); ?>">
                  <?php if($errors->has('item_name')): ?>
                  <span class="help-block">
                     <span class="red"><?php echo e($errors->first('item_name')); ?></span>
                  </span>
                 <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2940,$translate)); ?></label>
                  <textarea name="item_shortdesc" rows="6"  class="form-control"><?php echo e($edit['item']->item_shortdesc); ?></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2941,$translate)); ?> <span class="require">*</span></label>
                  <textarea name="item_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required"><?php echo e(html_entity_decode($edit['item']->item_desc)); ?></textarea>
                  <?php if($errors->has('item_desc')): ?>
                  <span class="help-block">
                     <span class="red"><?php echo e($errors->first('item_desc')); ?></span>
                  </span>
                 <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2942,$translate)); ?></h4>
              </div>
             <!--  <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2943,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2946,$translate)); ?> : 80x80px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_thumbnail" name="item_thumbnail" class="files">
                      <?php if($edit['item']->item_thumbnail!=''): ?>
                      <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_thumbnail); ?>" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php else: ?>
                      <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_thumbnail')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_thumbnail')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div>  -->
              <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2945,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2946,$translate)); ?> : 361x230px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_preview" name="item_preview" class="files">
                      <?php if($edit['item']->item_preview!=''): ?>
                      <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_preview); ?>" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php else: ?>
                      <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($edit['item']->item_name); ?>" width="80">
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_preview')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_preview')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div>
              <!-- <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2947,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(2948,$translate)); ?>)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_file" name="item_file" class="files">
                      <?php if($allsettings->site_s3_storage == 1): ?>
                      <?php $fileurl = Storage::disk('s3')->url($edit['item']->item_file); ?>
                      <a href="<?php echo e($fileurl); ?>" download><?php echo e($edit['item']->item_file); ?></a>
                      <?php else: ?>
                      <?php if($edit['item']->item_file!=''): ?>
                      <a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->item_file); ?>" download><?php echo e($edit['item']->item_file); ?></a>
                      <?php endif; ?>
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('item_file')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('item_file')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div> -->
            <!--   <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn"><?php echo e(Helper::translation(2950,$translate)); ?> (<?php echo e(Helper::translation(2946,$translate)); ?> : 750x430px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_screenshot" name="item_screenshot[]" class="files">
                      <?php $__currentLoopData = $item_image['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span class="item-img"><img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($item->item_image); ?>" alt="<?php echo e($item->item_image); ?>" width="80">
                      <a href="<?php echo e(url('/edit-item')); ?>/dropimg/<?php echo e(base64_encode($item->itm_id)); ?>" onClick="return confirm('<?php echo e(Helper::translation(2892,$translate)); ?>');" class="drop-icon"><span class="dwg-trash drop-icon"></span></a>
                      </span>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </label>
                 </div>
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(5229,$translate)); ?></label>
                  <select name="video_preview_type" id="video_preview_type" class="form-control">
                   <option value=""></option>
                   <option value="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5925,$translate)); ?></option>
                   <option value="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> selected <?php endif; ?>><?php echo e(Helper::translation(5928,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="youtube" <?php if($edit['item']->video_preview_type == 'youtube'): ?> class="form-group force-block" <?php else: ?> class="form-group force-none" <?php endif; ?>>
                  <label for="account-fn"><?php echo e(Helper::translation(2967,$translate)); ?> <span class="require">*</span></label>
                  <input type="text" id="video_url" name="video_url" class="form-control" data-bvalidator="required" value="<?php echo e($edit['item']->video_url); ?>">
                  <small>(<?php echo e(Helper::translation(2968,$translate)); ?> : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="mp4" <?php if($edit['item']->video_preview_type == 'mp4'): ?> class="form-group force-block upload_wrapper" <?php else: ?> class="form-group force-none upload_wrapper" <?php endif; ?>>
                  <label for="account-fn"><?php echo e(Helper::translation(5910,$translate)); ?> <span class="require">*</span> (<?php echo e(Helper::translation(5913,$translate)); ?>)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="video_file" name="video_file" class="text_field files">
                      <?php if($allsettings->site_s3_storage == 1): ?>
                      <?php $videofileurl = Storage::disk('s3')->url($edit['item']->video_file); ?>
                      <a href="<?php echo e($videofileurl); ?>" download><?php echo e($edit['item']->video_file); ?></a>
                      <?php else: ?>
                      <?php if($edit['item']->video_file!=''): ?>
                      <a href="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($edit['item']->video_file); ?>"  download><?php echo e($edit['item']->video_file); ?></a><?php endif; ?>
                      <?php endif; ?>
                      </label>
                      <?php if($errors->has('video_file')): ?>
                      <span class="help-block">
                         <span class="red"><?php echo e($errors->first('video_file')); ?></span>
                      </span>
                     <?php endif; ?>
                 </div>
                </div>
              </div>
              <!-- <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2951,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(2952,$translate)); ?> <span class="require">*</span></label>
                  <select name="item_category" id="item_category" class="form-control" data-bvalidator="required">
                  <option value=""><?php echo e(Helper::translation(5931,$translate)); ?></option>
                  <?php $__currentLoopData = $categories['menu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="category_<?php echo e($menu->cat_id); ?>" <?php if($cat_name == 'category'): ?> <?php if($menu->cat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>><?php echo e($menu->category_name); ?></option>
                  <?php $__currentLoopData = $menu->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="subcategory_<?php echo e($sub_category->subcat_id); ?>" <?php if($cat_name == 'subcategory'): ?> <?php if($sub_category->subcat_id == $cat_id): ?> selected="selected" <?php endif; ?> <?php endif; ?>> - <?php echo e($sub_category->subcategory_name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div> -->
             
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2966,$translate)); ?></label>
                  <input type="text" id="demo_url" name="demo_url" class="form-control"  value="<?php echo e($edit['item']->demo_url); ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(trans('labels.facebook')); ?> <span class="require">*</span></label>
                  <input type="text" id="socialmedialink" name="socialmedialink" class="form-control" data-bvalidator="required,maxlen[100]" value="<?php echo e($edit['item']->facebook); ?>">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(trans('labels.instagram')); ?> <span class="require">*</span></label>
                  <input type="text" id="instagram" name="instagram" class="form-control"  value="<?php echo e($edit['item']->instagram); ?>">
                </div>
              </div>

                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn"><?php echo e(trans('labels.linkedin')); ?> <span class="require">*</span></label>
                      <input type="text" id="linkedin" name="linkedin" class="form-control" value="<?php echo e($edit['item']->linkedin); ?>">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn"><?php echo e(trans('labels.website')); ?> <span class="require">*</span></label>
                      <input type="text" id="website" name="website" class="form-control"  value="<?php echo e($edit['item']->website); ?>">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn"><?php echo e(trans('labels.phonenumber')); ?> <span class="require">*</span></label>
                      <input type="text" id="phonenumber" name="phonenumber" class="form-control" value="<?php echo e($edit['item']->phonenumber); ?>">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn"><?php echo e(trans('labels.email')); ?> <span class="require">*</span></label>
                      <input type="text" id="email" name="email" class="form-control" value="<?php echo e($edit['item']->email); ?>">
                    </div>
              </div>
             <!--  <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2972,$translate)); ?></label>
                  <select name="item_flash_request" id="item_flash_request" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->item_flash_request == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->item_flash_request == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                  <small>(<?php echo e(Helper::translation(2973,$translate)); ?>)</small>
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2974,$translate)); ?></label>
                  <textarea name="item_tags" id="item_tags" rows="6" class="form-control"><?php echo e($edit['item']->item_tags); ?></textarea>
                  <small>(<?php echo e(Helper::translation(2975,$translate)); ?>)</small>
                </div>
              </div>
            <!--   <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2976,$translate)); ?></h4>
              </div> -->
             <!--  <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2977,$translate)); ?> <span class="require">*</span></label>
                  <select name="future_update" id="future_update" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if(@$edit['item']->future_update == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if(@$edit['item']->future_update == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2978,$translate)); ?> <span class="require">*</span></label>
                  <select name="item_support" id="item_support" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" <?php if($edit['item']->item_support == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                  <option value="0" <?php if($edit['item']->item_support == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>
                </div>
              </div> -->
             <!--  <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(2888,$translate)); ?></h4>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price"><?php echo e(Helper::translation(2979,$translate)); ?> <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency); ?></span></div>
                      <input type="text" id="regular_price" name="regular_price" class="form-control" data-bvalidator="digit,min[1],required" value="<?php echo e($edit['item']->regular_price); ?>">
                    </div>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price"><?php echo e(Helper::translation(2980,$translate)); ?> <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text"><?php echo e($allsettings->site_currency); ?></span></div>
                      <input type="text" id="extended_price" name="extended_price" class="form-control" data-bvalidator="digit,min[1]" value="<?php if($edit['item']->extended_price==0): ?> <?php else: ?> <?php echo e($edit['item']->extended_price); ?> <?php endif; ?>">
                    </div>
              </div> -->
              <input type="hidden" name="save_file" value="<?php echo e($edit['item']->item_file); ?>">
              <input type="hidden" name="save_thumbnail" value="<?php echo e($edit['item']->item_thumbnail); ?>">
              <input type="hidden" name="save_preview" value="<?php echo e($edit['item']->item_preview); ?>">
              <input type="hidden" name="save_extended_price" value="<?php echo e($edit['item']->extended_price); ?>">
              <input type="hidden" name="item_token" value="<?php echo e($edit['item']->item_token); ?>">
              <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
              <input type="hidden" name="save_video_file" value="<?php echo e($edit['item']->video_file); ?>">
              <div class="col-12 pt-3 mt-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                <?php if($allsettings->item_approval == 0): ?>
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i><?php echo e(Helper::translation(2981,$translate)); ?></button>
                <?php else: ?>
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i><?php echo e(Helper::translation(2876,$translate)); ?></button>
                <?php endif; ?>
                </div>
              </div>
            </div>
          </form>  
            </div>
          </section>
        </div>
      </div>
    </div>
  

<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
	$(document).ready(function()
	{
	'use strict';
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/edit-item.blade.php ENDPATH**/ ?>