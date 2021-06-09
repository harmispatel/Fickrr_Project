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
                        <h1><?php echo e(trans('labels.aboutdesigner')); ?></h1>
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
                        <form action="<?php echo e(route('admin.edit-designer')); ?>" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <?php endif; ?>
                          
                           
                             <div class="col-md-6">
                           
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                       
                                        <input type="hidden" name="id" id="id" value="<?php echo e(@$edit['designer']->id); ?>" />
                                               
                                                <?php $shoparray=array();?>

                                                <?php if(!empty(@$edit['designer']->hasManyDesignershops)): ?>
                                                    <?php $__currentLoopData = @$edit['designer']->hasManyDesignershops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $shoparray[]=$value->shopitem_id; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>


                                            
                                            
                                              <div class="form-group">
                                                <label for="site_title" class="control-label mb-1"><?php echo e(trans('labels.designername')); ?><span class="require">*</span></label>
                                                 <input type="text" name="designername" id="designername"   placeholder="<?php echo e(trans('labels.designername')); ?>" required="true"  value="<?php echo e(@$edit['designer']->name); ?>" class="form-control" >
                                            </div> 
                                            
                                            <div class="form-group">
                                               <label for="about" class="control-label mb-1"><?php echo e(trans('labels.about')); ?><span class="require">*</span></label>
                                                <textarea name="about" id="about" rows="6"  class="form-control" data-bvalidator="required"><?php echo e(@$edit['designer']->about); ?></textarea>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1"><?php echo e(trans('labels.email')); ?><span class="require">*</span></label>
                                                <input name="email" id="email" type="email"  class="form-control" data-bvalidator="required" value="<?php echo e(@$edit['designer']->email); ?>"/>
                                            
                                            </div>

                                            

                                             <div class="form-group">
                                                <label for="socialmedialinks" class="control-label mb-1"><?php echo e(trans('labels.socialmedialinksfacebook')); ?></label>
                                                <input name="socialmedialinks" id="socialmedialinks" type="text"  class="form-control" value="<?php echo e(@$edit['designer']->facebook); ?>"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram" class="control-label mb-1"><?php echo e(trans('labels.instagram')); ?></span></label>
                                                <input name="instagram" id="instagram" type="text"  class="form-control" value="<?php echo e(@$edit['designer']->instagram); ?>"/>
                                            
                                            </div>

                                             <div class="form-group">
                                                <label for="linkedin" class="control-label mb-1"><?php echo e(trans('labels.linkedin')); ?></span></label>
                                                <input name="linkedin" id="linkedin" type="text"  class="form-control" value="<?php echo e(@$edit['designer']->linkedin); ?>"/>
                                            
                                            </div>

                                            <div class="form-group">
                                                <label for="youtube" class="control-label mb-1"><?php echo e(trans('labels.youtube')); ?></label>
                                                <input name="youtube" id="youtube" type="text"  class="form-control" value="<?php echo e(@$edit['designer']->youtube); ?>"/>
                                            
                                            </div>


                                        
                                             <div class="form-group">
                                                <label for="images" class="control-label mb-1"><?php echo e(trans('labels.images')); ?><span class="require">*</span></label>
                                                <input name="images[]" id="images[]" type="file"  class="form-control" multiple />
                                            
                                            </div>

                                           

                                                    
                                                    <?php if(!empty(@$edit['designer']->hasManyDesignerimages)): ?>

                                                        <?php $__currentLoopData = @$edit['designer']->hasManyDesignerimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         &nbsp; <div class="form-group" style="float:left;padding:20px;">
                                                        <img src="<?php echo e(url::to('public/storage/items/'.$value->images)); ?>" width="70px;" />

                                                        <input name="oldimages[]" id="oldimages[]" type="hidden"  value="<?php echo e($value->images); ?>" multiple />
 </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>


                                               
                                               
                                            
                                           
                                            
                                            
                                          
                                           
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



      
</body>

</html>
<?php /**PATH D:\xampp\htdocs\fickrr\resources\views/admin/edit-designer.blade.php ENDPATH**/ ?>