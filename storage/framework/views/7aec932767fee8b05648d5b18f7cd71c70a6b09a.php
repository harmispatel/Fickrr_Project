
<?php $__env->startSection('content'); ?>

<!-- <?php // echo "<pre>";print_r( $related['items']); ?> -->

<section class="main-banner">    
  <?php if( $allsettings->site_banner != ''): ?>

                                            <?php @$sitebanner=explode(",", $allsettings->site_banner); ?>
      <?php $__currentLoopData = @$sitebanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               
    <div class="main-banner-inr owl-carousel owl-theme">
        <div class="main-banner-item" data-dot="<button>01</button>">
            <img src="<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($value); ?>"  alt="">
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

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                               
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
         <?php endif; ?>   
    </div>
</section>

<section class="bb-menu">
    <div class="container">
        <div class="bb-menu-inr">
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="<?php echo e(URL::to('/shopstore/'.@$item['item']->item_slug)); ?>" class="active">Designer</a></li>
                <li><a href="#">Venor</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Room</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php if(count(@$item_category)>0): ?>
                              <?php $__currentLoopData = @$item_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <a class="dropdown-item" href="#"><?php echo e(@$value->category_name); ?></a>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                             <a class="dropdown-item" href="#">Location ,please add from backend</a>
                            <?php endif; ?>
                      </div>
                </li>
            </ul>
        </div>
    </div>
</section>


<section class="vendor-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="vendor-about text-center mb-5">
          <div class="section-title mb-3">
            <h2>About Venor</h2>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="vendor-info">
          <a href="mailto:example@email.com"><i class="ti ti-mail"></i>example@email.com</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="vendor-info">
          <a href="#"><i class="ti ti-phone"></i>0123456789</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="vendor-info">
          <a href="#"><i class="ti ti-map"></i>123 dummy address</a>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="design-page">
    <div class="container">
        <div class="section-title with-sub mb-4">
            <h2>Name of Designer</h2>
            <div class="share-fav">
              <ul>
                <li><a class="ti ti-heart" href="#"></a></li>
              </ul>
              <ul class="with-outline">
                <li><a class="ti ti-brand-facebook" href="#"></a></li>
                <li><a class="ti ti-brand-twitter" href="#"></a></li>
                <li><a class="ti ti-brand-instagram" href="#"></a></li>
                <li><a class="ti ti-brand-linkedin" href="#"></a></li>
              </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="about-hotel">
                    <img src="<?php echo e(url('/resources/views/customtheme/assets/img/designer.jpg')); ?>" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-page-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="near-main bg-light-gray">
    <div class="container">
        <div class="section-title">
            <h2>Favorite Elements</h2>
        </div>
        <div class="near-box">
            <div class="nearslide owl-theme owl-carousel">
              <?php $__currentLoopData = $related['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                    <article class="event-default-wrap">
                        <div class="event-default">
                          <figure class="event-default-image">
                            <?php if($p->item_preview!=''): ?>
                              <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($p->item_preview); ?>" alt="<?php echo e($p->item_name); ?>">
                            <?php else: ?>
                              <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($p->item_name); ?>">
                            <?php endif; ?>
                          </figure>
                          <div class="heart-on-img">
                            <a class="ti ti-heart" href="#"></a>                              
                          </div>
                        </div>
                        <div class="event-default-inner-2 text-center mb-3">
                            <label class="m-0"><?php echo e($p->item_category_type); ?></label>
                            <h5 class="m-0"><a class="event-default-title" href="<?php echo e(URL::to('/item')); ?>/<?php echo e($p->item_slug); ?>"><?php echo e($p->item_name); ?></a></h5>
                            <span class="w-100 d-block">Brand Name</span>
                            <a href="#" class="btn btn-primary mt-2">Get Price</a>
                        </div>
                    </article>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>                
        </div>
    </div>
</section>

<section class="rvybe-text">
    <div class="container">
        <div class="section-title">
            <h2>Rvybe</h2>
        </div>
        <div class="rvybe-img">
          <img src="<?php echo e(url('/resources/views/customtheme/assets/img/fashion-trends-img.png')); ?>" class="img-fluid">
        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/shopdesignerpage.blade.php ENDPATH**/ ?>