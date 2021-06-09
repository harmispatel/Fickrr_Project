
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
                        <span class="owl-slide-animated"></span>
                        <h1 class="owl-slide-animated"><br></h1>
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

<!-- <div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3"> -->
       <!--  <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(2932,$translate)); ?></li>
              </li>
             </ol>
          </nav>
        </div> -->
        <!-- <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(2932,$translate)); ?> </h1>
        </div> -->
      <!-- </div>
    </div> -->
<div class="container mb-5 pb-3">
      <div class="overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <!-- <aside class="col-lg-4"> -->
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <!-- <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i><?php echo e(Helper::translation(4878,$translate)); ?>  </a></div> -->
            <!-- Actual menu-->
         
          <!-- </aside> -->
          <!-- Content-->
          <section class="col-lg-12 pt-lg-12 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <div class="row border-bottom mb-4">
              <h2 class="h3 pt-2 pb-4 mb-0 col pull-left"> <?php echo e(trans('labels.Shophotelsresturantsspa')); ?><span class="badge badge-secondary font-size-sm text-body align-middle ml-2"><?php echo e(count($itemData['item'])); ?></span></h2> 
           <!--    <?php if(Auth::user()): ?>
            <div class="col pull-right">
               <a href="<?php echo e(url('/manage-allitem')); ?>" class="btn btn-primary btn-sm dropbtn"> <?php echo e(trans('labels.Viewallshops')); ?></a>
              <a href="<?php echo e(url('/manage-item')); ?>" class="btn btn-primary btn-sm dropbtn" > <?php echo e(trans('labels.OwnSHops')); ?></a>
                        
               </div>    
                <?php endif; ?>         --> 
              </div>
              <!-- Product-->
              <div class="row"> 
                  <?php $no = 1; ?>
                  <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                      $price = Helper::price_info($featured->item_flash,$featured->regular_price);
                  ?>
                  <div class="col-md-6 col-lg-4 mb-4">
                    <div class="media d-block p-3 bg-light box-shadow-lg rounded-lg">
                      <div class="cart-img-fixheight mb-3 position-relative">
                        <?php if($featured->item_preview!=''): ?>
                        <img class="rounded-lg cart-img" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_preview); ?>" alt="<?php echo e($featured->item_name); ?>">
                        <?php else: ?>
                        <img class="rounded-lg cart-img" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>">
                        <?php endif; ?>
                        <div class="on-img-text">
                          <div class="d-inline-block text-price"><?php echo e($allsettings->site_currency_symbol); ?><?php echo e($price); ?></div>
                          <span><?php echo e(ucwords(str_replace('-',' ',$featured->item_type))); ?></span>
                        </div>
                      </div>
                      <?php $encrypted = $encrypter->encrypt($featured->item_token); ?>
                      <span class="close-floating" data-toggle="tooltip" title="<?php echo e(Helper::translation(6036,$translate)); ?>"><i class="dwg-close"></i></span>
                        <div class="media-body text-center text-sm-left overflow-hidden">
                          <h3 class="h6 product-title product-title-respo mb-2">
                            <a href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(substr($featured->item_name,0,20).'...'); ?></a> 
                            <?php if($featured->item_status == 0): ?> 
                            <span class="badge badge-pill badge-danger pull-right">
                                <?php echo e(Helper::translation(3092,$translate)); ?>

                            </span> 
                            <?php endif; ?>
                        </h3>
                        <!--   <a class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2" href="<?php echo e(URL::to('/shop')); ?>/item-type/<?php echo e($featured->item_type); ?>"></a> -->
                        <div class="form-inline pt-2 w-100">
                          <?php echo e(substr($featured->item_shortdesc,0,60).'...'); ?>

                          <div class="d-flex mt-2 mt-md-0 w-100 justify-content-center d-md-inline-block">
                          <!--   <a href="<?php echo e(URL::to('/edit-item')); ?>/<?php echo e($featured->item_token); ?>" class="btn btn-success btn-sm my-2 mr-3"><i class="dwg-edit mr-1"></i><?php echo e(Helper::translation(2923,$translate)); ?></a>
                            <a class="btn btn-primary btn-sm mx-sm-0 my-2" href="<?php echo e(URL::to('/manage-item')); ?>/<?php echo e($encrypted); ?>" onClick="return confirm('<?php echo e(Helper::translation(2892,$translate)); ?>');"><i class="dwg-trash mr-1"></i><?php echo e(Helper::translation(2924,$translate)); ?></a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php $no++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/manage-allitem.blade.php ENDPATH**/ ?>