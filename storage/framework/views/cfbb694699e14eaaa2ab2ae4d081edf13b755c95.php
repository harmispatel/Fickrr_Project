<?php if($allsettings->maintenance_mode == 0): ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title><?php if(Auth::user()->id != 1): ?> <?php echo e(Helper::translation(3109,$translate)); ?> <?php else: ?> <?php echo e(Helper::translation(2860,$translate)); ?> <?php endif; ?>  - <?php echo e($allsettings->site_title); ?></title>
<?php echo $__env->make('meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(Auth::user()->id != 1): ?>
<div class="page-title-overlap pt-4" style="background-image: url('<?php echo e(url('/')); ?>/public/storage/settings/<?php echo e($allsettings->site_banner); ?>');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="<?php echo e(URL::to('/')); ?>"><i class="dwg-home"></i><?php echo e(Helper::translation(2862,$translate)); ?></a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page"><?php echo e(Helper::translation(3109,$translate)); ?></li>
            </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white"><?php echo e(Helper::translation(3109,$translate)); ?></h1>
        </div>
      </div>
    </div>
<div class="container pb-5 mb-2 mb-md-3">
      <div class="row">
        <!-- Sidebar-->
        <aside class="col-lg-4 pt-4 pt-lg-0">
          <?php echo $__env->make('dashboard-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </aside>
        <!-- Content  -->
        <section class="col-lg-8">
          <!-- Toolbar-->
          <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
            <h6 class="font-size-base text-light mb-0"><?php echo e(Helper::translation(4932,$translate)); ?></h6><a class="btn btn-primary btn-sm" href="<?php echo e(url('/logout')); ?>"><i class="dwg-sign-out mr-2"></i><?php echo e(Helper::translation(3023,$translate)); ?></a>
          </div>
          <!-- Profile form-->
          <form action="<?php echo e(route('profile-settings')); ?>" class="needs-validation" id="profile_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="row">
              <div class="col-sm-12 mb-1">
              <h4><?php echo e(Helper::translation(3110,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn"><?php echo e(Helper::translation(2917,$translate)); ?> <span class="require">*</span></label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo e(Helper::translation(2917,$translate)); ?>" value="<?php echo e(Auth::user()->name); ?>" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-ln"><?php echo e(Helper::translation(3111,$translate)); ?> <span class="require">*</span></label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="<?php echo e(Helper::translation(3111,$translate)); ?>" value="<?php echo e(Auth::user()->username); ?>" data-bvalidator="required">
                  <small><?php echo e(Helper::translation(3112,$translate)); ?>: <?php echo e(URL::to('/')); ?>/user/<span><?php echo e(Auth::user()->username); ?></span></small>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3011,$translate)); ?> <span class="require">*</span></label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="<?php echo e(Helper::translation(3011,$translate)); ?>" value="<?php echo e(Auth::user()->email); ?>" data-bvalidator="required,email">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-pass"><?php echo e(Helper::translation(3113,$translate)); ?></label>
                  <div class="password-toggle">
                    <input id="password" name="password" type="text" class="form-control" data-bvalidator="min[6]">
                    <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only"><?php echo e(Helper::translation(4866,$translate)); ?></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-pass"><?php echo e(Helper::translation(3114,$translate)); ?></label>
                  <div class="password-toggle">
                  <input type="password" name="password_confirmation" id="password-confirm" class="form-control" data-bvalidator="min[6]" placeholder="">
                   <label class="password-toggle-btn">
                      <input class="custom-control-input" type="checkbox"><i class="dwg-eye password-toggle-indicator"></i><span class="sr-only"><?php echo e(Helper::translation(4866,$translate)); ?></span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3115,$translate)); ?></label>
                  <input type="text" id="website" name="website" class="form-control" placeholder="" value="<?php echo e(Auth::user()->website); ?>">
                </div>
              </div>
              <?php if(Auth::user()->user_type == 'customer'): ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(4833,$translate)); ?></label><br/>
                  <input  type="checkbox" name="become-vendor" id="ch2" value="1">
                  <span class="become_vendor"><small>(<?php echo e(Helper::translation(4836,$translate)); ?>)</small></span>
                </div>
              </div>
              <?php endif; ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3116,$translate)); ?> <span class="require">*</span></label>
                  <select name="country" id="country" class="form-control" data-bvalidator="required">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $country['country']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->country_id); ?>" <?php if(Auth::user()->country == $country->country_id ): ?> selected="selected" <?php endif; ?>><?php echo e($country->country_name); ?></option>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>       
                </div>
              </div>
              <?php if(Auth::user()->user_type == 'vendor'): ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3117,$translate)); ?> <span class="require">*</span></label>
                  <select name="user_freelance" id="user_freelance" class="form-control" data-bvalidator="required">
                       <option value=""></option>
                       <option value="1" <?php if(Auth::user()->user_freelance == 1 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                       <option value="0" <?php if(Auth::user()->user_freelance == 0 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>       
                </div>
              </div>
              <?php endif; ?>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3118,$translate)); ?> <span class="require">*</span></label>
                  <select name="country_badge" id="country_badge" class="form-control" data-bvalidator="required">
                     <option value=""></option>
                     <option value="1" <?php if(Auth::user()->country_badge == 1 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                     <option value="0" <?php if(Auth::user()->country_badge == 0 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>       
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3119,$translate)); ?> <span class="require">*</span></label>
                  <select name="exclusive_author" id="exclusive_author" class="form-control" data-bvalidator="required">
                      <option value=""></option>
                      <option value="1" <?php if(Auth::user()->exclusive_author == 1 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2970,$translate)); ?></option>
                      <option value="0" <?php if(Auth::user()->exclusive_author == 0 ): ?> selected="selected" <?php endif; ?>><?php echo e(Helper::translation(2971,$translate)); ?></option>
                  </select>    
                  <small>(<?php echo e(Helper::translation(3120,$translate)); ?> <strong>"<?php echo e(Helper::translation(2970,$translate)); ?>"</strong> <?php echo e(Helper::translation(3121,$translate)); ?>)</small>   
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3122,$translate)); ?></label>
                  <input type="text" id="profile_heading" class="form-control" name="profile_heading" placeholder="<?php echo e(Helper::translation(3123,$translate)); ?>" value="<?php echo e(Auth::user()->profile_heading); ?>" data-bvalidator="required">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3124,$translate)); ?></label>
                  <textarea name="about" id="about" class="form-control" placeholder="<?php echo e(Helper::translation(3125,$translate)); ?>" data-bvalidator="required"><?php echo e(Auth::user()->about); ?></textarea>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(3126,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
              <div class="form-group pb-2">
                  <label for="account-confirm-pass"><?php echo e(Helper::translation(3127,$translate)); ?> (100x100 px)</label>
                  <div class="custom-file">
                  <input class="custom-file-input" type="file" id="unp-product-files" name="user_photo" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(2944,$translate)); ?>">
                  <label class="custom-file-label" for="unp-product-files"></label>
                  <?php if(Auth::user()->user_photo != ''): ?>
                  <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>" alt="<?php echo e(Auth::user()->name); ?>" width="50">
                  <?php else: ?>
                  <img src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e(Auth::user()->name); ?>" width="50">
                  <?php endif; ?>
                  </div>
                </div>
              </div> 
              <div class="col-sm-6">
              <div class="form-group pb-2">
                  <label for="account-confirm-pass"><?php echo e(Helper::translation(3128,$translate)); ?> (750x370 px)</label>
                  <div class="custom-file">
                  <input class="custom-file-input" type="file" id="unp-product-files" name="user_banner" data-bvalidator="extension[jpg:png:jpeg]" data-bvalidator-msg="<?php echo e(Helper::translation(2944,$translate)); ?>">
                  <label class="custom-file-label" for="unp-product-files"></label>
                  <?php if(Auth::user()->user_banner != ''): ?>
                  <img src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_banner); ?>" alt="<?php echo e(Auth::user()->name); ?>" width="100">
                  <?php else: ?>
                  <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e(Auth::user()->name); ?>" width="100">
                  <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(3129,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(4935,$translate)); ?></label>
                  <input type="text" class="form-control" name="facebook_url" value="<?php echo e(Auth::user()->facebook_url); ?>" placeholder="ex: https://www.facebook.com">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(4938,$translate)); ?></label>
                  <input type="text" class="form-control" name="twitter_url" value="<?php echo e(Auth::user()->twitter_url); ?>" placeholder="ex: https://www.twitter.com">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(4941,$translate)); ?></label>
                  <input type="text" class="form-control" name="gplus_url" value="<?php echo e(Auth::user()->gplus_url); ?>" placeholder="ex: https://www.google.com">
                </div>
              </div>
              <div class="col-sm-6">
              </div>
              <?php if(Auth::user()->user_type == 'vendor'): ?>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4"><?php echo e(Helper::translation(3130,$translate)); ?></h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3088,$translate)); ?></label><br/>
                  <input type="checkbox" id="opt2" class="" name="item_update_email" value="1" <?php if(Auth::user()->item_update_email == 1): ?> checked <?php endif; ?>>
                  <span class="become_vendor"><small><?php echo e(Helper::translation(3131,$translate)); ?></small></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3132,$translate)); ?></label><br/>
                  <input type="checkbox" id="opt3" class="" name="item_comment_email" value="1" <?php if(Auth::user()->item_comment_email == 1): ?> checked <?php endif; ?>>
                  <span class="become_vendor"><small><?php echo e(Helper::translation(3133,$translate)); ?></small></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3134,$translate)); ?></label><br/>
                  <input type="checkbox" id="opt4" class="" name="item_review_email" value="1" <?php if(Auth::user()->item_review_email == 1): ?> checked <?php endif; ?>>
                  <span class="become_vendor"><small><?php echo e(Helper::translation(3135,$translate)); ?></small></span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email"><?php echo e(Helper::translation(3136,$translate)); ?></label><br/>
                  <input type="checkbox" id="opt5" class="" name="buyer_review_email" value="1" <?php if(Auth::user()->buyer_review_email == 1): ?> checked <?php endif; ?>>
                  <span class="become_vendor"><small><?php echo e(Helper::translation(3137,$translate)); ?></small></span>
                </div>
              </div>
              <?php endif; ?>
              <input type="hidden" name="user_token" value="<?php echo e(Auth::user()->user_token); ?>">
              <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
              <input type="hidden" name="save_earnings" value="<?php echo e(Auth::user()->earnings); ?>">
              <input type="hidden" name="save_photo" value="<?php echo e(Auth::user()->user_photo); ?>">
              <input type="hidden" name="save_banner" value="<?php echo e(Auth::user()->user_banner); ?>">
              <input type="hidden" name="save_password" value="<?php echo e(Auth::user()->password); ?>">
              <div class="col-12">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit"><?php echo e(Helper::translation(3138,$translate)); ?></button>
                </div>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
    <?php else: ?>
    <?php echo $__env->make('not-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php else: ?>
<?php echo $__env->make('503', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/profile-settings.blade.php ENDPATH**/ ?>