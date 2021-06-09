<div class="cz-sidebar-static rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0">
            <div class="px-4 mb-4">
              <div class="media align-items-center">
                <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                <?php if(!empty(Auth::user()->user_photo)): ?>
                <img class="rounded-circle" src="<?php echo e(url('/')); ?>/public/storage/users/<?php echo e(Auth::user()->user_photo); ?>" alt="<?php echo e(Auth::user()->name); ?>">
                <?php else: ?>
                <img class="rounded-circle" src="<?php echo e(url('/')); ?>/public/img/no-user.png" alt="<?php echo e(Auth::user()->name); ?>">
                <?php endif; ?>
                </div>
                <div class="media-body pl-3">
                  <h3 class="font-size-base mb-0"><?php echo e(Auth::user()->name); ?></h3><span class="text-accent font-size-sm"><?php echo e(Auth::user()->email); ?></span>
                </div>
              </div>
            </div>
            <div class=" px-4 py-3">
              <h3 class="font-size-sm mb-0 text-muted"><?php echo e(Helper::translation(3231,$translate)); ?></h3>
            </div>
            <ul class="list-unstyled mb-0 menudashboard">
            <?php if(Auth::user()->user_type == 'vendor'): ?>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/user')); ?>/<?php echo e(Auth::user()->username); ?>"><i class="dwg-home opacity-60 mr-2"></i><?php echo e(Helper::translation(2926,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/profile-settings')); ?>"><i class="dwg-settings opacity-60 mr-2"></i><?php echo e(Helper::translation(2927,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/purchases')); ?>"><i class="dwg-basket opacity-60 mr-2"></i><?php echo e(Helper::translation(2928,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/favourites')); ?>"><i class="dwg-heart opacity-60 mr-2"></i><?php echo e(Helper::translation(2929,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/coupon')); ?>"><i class="dwg-gift opacity-60 mr-2"></i><?php echo e(Helper::translation(2919,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/sales')); ?>"><i class="dwg-cart opacity-60 mr-2"></i><?php echo e(Helper::translation(2930,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/manage-item')); ?>"><i class="dwg-briefcase opacity-60 mr-2"></i><?php echo e(Helper::translation(2932,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/withdrawal')); ?>"><i class="dwg-currency-exchange opacity-60 mr-2"></i><?php echo e(Helper::translation(2933,$translate)); ?></a></li>
            <?php endif; ?>
            <?php if(Auth::user()->user_type == 'customer'): ?>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/user')); ?>/<?php echo e(Auth::user()->username); ?>"><i class="dwg-home opacity-60 mr-2"></i><?php echo e(Helper::translation(2926,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/profile-settings')); ?>"><i class="dwg-settings opacity-60 mr-2"></i><?php echo e(Helper::translation(2927,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/purchases')); ?>"><i class="dwg-basket opacity-60 mr-2"></i><?php echo e(Helper::translation(2928,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/favourites')); ?>"><i class="dwg-heart opacity-60 mr-2"></i><?php echo e(Helper::translation(2929,$translate)); ?></a></li>
            <li class="border-bottom mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(URL::to('/withdrawal')); ?>"><i class="dwg-currency-exchange opacity-60 mr-2"></i><?php echo e(Helper::translation(2933,$translate)); ?></a></li>
            <?php endif; ?>
            <li class="mb-0"><a class="nav-link-style d-flex align-items-center px-4 py-3" href="<?php echo e(url('/logout')); ?>"><i class="dwg-sign-out opacity-60 mr-2"></i><?php echo e(Helper::translation(3023,$translate)); ?></a></li>
                </ul>
           </div><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/dashboard-menu.blade.php ENDPATH**/ ?>