
<?php $__env->startSection('content'); ?>


<section class="main-banner">    
  <?php if($allsettings->site_banner != ''): ?>

                                            <?php @$sitebanner=explode(",", $allsettings->site_banner); ?>

                                            <?php if(count(@$sitebanner) > 0 && @$sitebanner[0] != '' ): ?>
                                              <div class="main-banner-inr owl-carousel owl-theme">
      <?php $__currentLoopData = @$sitebanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
  
        <div class="main-banner-item" data-dot="<button>01</button>">
            <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($value); ?>"  alt="">
            <div class="main-banner-info">
                <div class="container">
                    <div class="main-banner-content owl-slide-text">
                        <span class="owl-slide-animated"><?php echo e($allsettings->site_banner_heading); ?> </span>
                        <h1 class="owl-slide-animated"><?php echo e($allsettings->site_banner_subheading); ?></h1>
                        <a href="#get-start" class="scroll-down owl-slide-animated"></a>
                    </div>
                </div>
            </div>
        </div> 

         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
     <?php endif; ?>
    <?php else: ?>
        <div class="main-banner-inr owl-carousel owl-theme">  
        <div class="main-banner-item" data-dot="<button>02</button>">
            <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>"  alt="">
            <div class="main-banner-info">
                <div class="container">
                    <div class="main-banner-content owl-slide-text">
                        <span class="owl-slide-animated">A Hiking guide</span>
                        <h1 class="owl-slide-animated">Be prepared for the<br> Mountains and beyond!</h1>
                        <a href="#get-start" class="scroll-down owl-slide-animated">scroll down</a>
                    </div>
                </div>
            </div>
        </div>  
       </div> 
         <?php endif; ?>   
  
</section>


<div class="container py-4 py-lg-5 my-4">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card py-2 mt-4">
            <form method="POST" action="<?php echo e(route('forgot')); ?>"  id="login_form" class="card-body needs-validation">
               <?php echo csrf_field(); ?> 
              <div class="form-group">
                <label for="recover-email"><?php echo e(Helper::translation(3011,$translate)); ?></label>
                <input class="form-control" type="text" id="recover-email" name="email" data-bvalidator="email,required">
                <div class="invalid-feedback"><?php echo e(Helper::translation(5955,$translate)); ?></div>
              </div>
              <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(3012,$translate)); ?></button>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/forgot.blade.php ENDPATH**/ ?>