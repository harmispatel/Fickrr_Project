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
                        <h1><?php echo e(trans('labels.editManufacturer')); ?></h1>
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
                        <?php if($demo_mode == 'on'): ?>
                           <?php echo $__env->make('admin.demo-mode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           <?php else: ?>
                       <form action="<?php echo e(route('admin.edit-manufacturers')); ?>" method="post" enctype="multipart/form-data" class="setting_form" id="item_form" >
                        
                        <?php echo e(csrf_field()); ?>

                        <?php endif; ?>
                        <div class="card">
                           
                           
                           
                           <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        
                                            
                                            <div class="form-group">
                                                <label for="name" class="control-label mb-1"><?php echo e(trans('labels.manufacturerName')); ?> <span class="require">*</span></label>
                                                <input id="name" name="name" type="text" class="form-control" value="<?php echo e($edit['users']->name ? $edit['users']->name : ''); ?>" required>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="website" class="control-label mb-1"><?php echo e(trans('labels.website')); ?></label>
                                                <input id="website" name="website" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->website ? $edit['manufacturers']->website : ''); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="street_address" class="control-label mb-1"><?php echo e(trans('labels.streetAddress')); ?></label>
                                                <input id="street_address" name="street_address" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->street_address ? $edit['manufacturers']->street_address : ''); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="city" class="control-label mb-1"><?php echo e(trans('labels.city')); ?></label>
                                                <input id="city" name="city" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->city ? $edit['manufacturers']->city : ''); ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="state" class="control-label mb-1"><?php echo e(trans('labels.state')); ?></label>
                                                <input id="state" name="state" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->state ? $edit['manufacturers']->state : ''); ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="zip_code" class="control-label mb-1"><?php echo e(trans('labels.zip')); ?></label>
                                                <input id="zip_code" name="zip_code" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->zip_code ? $edit['manufacturers']->zip_code : ''); ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="main_phone" class="control-label mb-1"><?php echo e(trans('labels.mainPhone')); ?> <span class="require">*</span></label>
                                                <input id="main_phone" name="main_phone" type="text" class="form-control" value="<?php echo e($edit['users']->phonenumber ? $edit['users']->phonenumber : ''); ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1"><?php echo e(trans('labels.email')); ?> <span class="require">*</span></label>
                                                <input id="email" name="email" type="text" class="form-control" value="<?php echo e($edit['users']->email ? $edit['users']->email : ''); ?>" required>
                                            </div>

                                              <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1"><?php echo e(trans('labels.socialmedialinksfacebook')); ?></label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control"  data-bvalidator="url" required value="<?php echo e($edit['users']->facebook_url); ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1"><?php echo e(trans('labels.instagram')); ?></span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control"  data-bvalidator="url" required value="<?php echo e($edit['users']->instagram); ?>"/>
                                            
                                            </div>

                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1"><?php echo e(trans('labels.twitterurl')); ?></span></label>
                                                <input name="twitterurl" id="twitterurl" type="text"  class="form-control"  data-bvalidator="url" required value="<?php echo e($edit['users']->twitter_url); ?>"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1"><?php echo e(trans('labels.youtube')); ?></label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control"  data-bvalidator="url" required value="<?php echo e($edit['users']->youtube); ?>"/>
                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="key_contact_person" class="control-label mb-1"><?php echo e(trans('labels.keyContactPerson')); ?></label>
                                                <input id="key_contact_person" name="key_contact_person" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->key_contact_person ? $edit['manufacturers']->key_contact_person : ''); ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="key_contact_email" class="control-label mb-1"><?php echo e(trans('labels.keyContactEmailAddress')); ?></label>
                                                <input id="key_contact_email" name="key_contact_email" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->key_contact_email ? $edit['manufacturers']->key_contact_email : ''); ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="order_method" class="control-label mb-1"><?php echo e(trans('labels.methodOfSendingPurchaseOrder')); ?> <span class="require">*</span></label>
                                                <input id="order_method" name="order_method" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->order_method ? $edit['manufacturers']->order_method : ''); ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="order_email" class="control-label mb-1"><?php echo e(trans('labels.emailForPurchaseOrder')); ?> <span class="require">*</span></label>
                                                <input id="order_email" name="order_email" type="text" class="form-control" value="<?php echo e($edit['manufacturers']->order_email ? $edit['manufacturers']->order_email : ''); ?>" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="manufacturers_image" class="control-label mb-1"><?php echo e(trans('labels.logo')); ?></label>
                                                <input id="manufacturers_image" name="manufacturers_image" type="file" class="thickbox">

                                                <?php if($edit['users']->user_photo != ''): ?>
                                                    <img src="<?php echo e(url('/')); ?>/public/storage/manufacturers/<?php echo e($edit['users']->user_photo); ?>"
                                                        alt="<?php echo e($edit['users']->name); ?>" class="item-thumb">
                                                <?php else: ?>
                                                    <img src="<?php echo e(url('/')); ?>/public/img/no-image.png"
                                                        alt="<?php echo e($edit['users']->name); ?>" class="item-thumb">
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                           <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"> <?php echo e(Helper::translation(2873,$translate)); ?> <span class="require">*</span></label>
                                                <select name="manufacturers_status" class="form-control" required>
                                                <option value=""></option>
                                                <option value="1" <?php if($edit['manufacturers']->manufacturers_status == 1): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2874,$translate)); ?></option>
                                                <option value="0" <?php if($edit['manufacturers']->manufacturers_status == 0): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2875,$translate)); ?></option>
                                                </select>
                                                
                                            </div> 
                                                
                                                <input type="hidden" name="manufacturers_id" value="<?php echo e($edit['manufacturers']->manufacturers_id); ?>">
                                                 <input type="hidden" name="old_manufacturers_image" value="<?php echo e($edit['users']->user_photo); ?>">
                                    </div>
                                </div>

                            </div>
                            </div>
                            
                            
                            
                             <div class="col-md-6">
                             
                             
                             
                             
                             </div>
                            
                            
                            <div class="card-footer">
                                                        <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-dot-circle-o"></i> <?php echo e(Helper::translation(2876,$translate)); ?>

                                                        </button>
                                                        <button type="reset" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-ban"></i> <?php echo e(Helper::translation(4962,$translate)); ?>

                                                        </button>
                                                    </div>
                                                    
                                                    
                                                 
                            
                        </div> 

                    
                    </form> 
                    
                    </div>
                    

                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
    <?php else: ?>
    <?php echo $__env->make('admin.denied', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <!-- Right Panel -->


   <?php echo $__env->make('admin.javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/edit-manufacturers.blade.php ENDPATH**/ ?>