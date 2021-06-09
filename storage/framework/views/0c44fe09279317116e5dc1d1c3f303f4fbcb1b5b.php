
<?php $__env->startSection('content'); ?>

<section class="main-banner">   

<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">



          <!-- Content-->
          <?php if($cart_count != 0): ?>
          <section class="col-lg-8 pt-2 pt-lg-4 pb-4 mb-3">
          <form action="<?php echo e(route('procheckout')); ?>" class="needs-validation" id="checkout_form" method="post" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
             <input type="hidden" name="order_firstname" value="<?php echo e(Auth::user()->name); ?>"> 
             <input type="hidden" name="order_email" value="<?php echo e(Auth::user()->email); ?>">
             <div class="widget mb-3 d-lg-none">
                <h2 class="widget-title"><?php echo e(Helper::translation(2900,$translate)); ?></h2>
                <?php 
                $subtotal = 0;
                $order_id = '';
                $item_price = '';
                $item_userid = '';
                $item_user_type = '';
                $total_prices='';
                $commission = 0;
                $vendor_amount = 0;
                $single_price = 0;
                $coupon_code = ""; 
                $new_price = 0;
                ?>
                <?php $__currentLoopData = $cart['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $itemArray=(count($cart->hasManysProducts) > 0 ) ? $cart->hasManysProducts : array(); ?>
                <div class="media align-items-center pb-2 border-bottom">
                        <a class="d-block mr-2" href="<?php echo e(url('/item')); ?>/<?php echo e($cart->item_slug); ?>">
                        <?php if($cart->item_thumbnail!=''): ?>
                            <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($cart->item_thumbnail); ?>" alt="<?php echo e($cart->item_name); ?>" />
                        <?php else: ?>
                            <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($cart->item_name); ?>" />
                        <?php endif; ?>
                        </a>
                        <div class="media-body pl-1">
                            <h6 class="widget-product-title text-left"><a href="<?php echo e(url('/item')); ?>/<?php echo e($itemArray[0]->item_slug); ?>"><?php echo e($cart->item_name); ?></a></h6>
                            <div class="widget-product-meta"><span class="text-accent border-right pr-2 mr-2"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($cart->item_price); ?></span>
                              <span class="font-size-xs text-muted"><?php echo e($cart->license); ?><?php if($cart->license == 'regular'): ?> (<?php echo e(Helper::translation(2890,$translate)); ?>) <?php elseif($cart->license == 'extended'): ?> (<?php echo e(Helper::translation(2891,$translate)); ?>) <?php endif; ?></span>
                            </div>
                        </div>
                </div>
                <!-- item price is before that -->
                <?php 
                    $subtotal += $cart->total_price;   
               
                $order_id .= $cart->ord_id.',';
                $item_price .= $cart->item_price.','; 
                $total_prices.=$cart->total_price.','; 
                $item_userid .= $cart->item_user_id.','; 
                $item_user_type .= $cart->exclusive_author; 
                $amount_price = $subtotal;
                $single_price = $cart->item_price;
                if($cart->discount_price != 0){

                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else{

                   $price = $cart->item_price;
                   $new_price += $cart->item_price;
                   $coupon_code = "";
                }
              if($item_user_type == 1)
                {
                   $commission +=($price * $allsettings->site_exclusive_commission) / 100;
                }
                else
                {
                   $commission +=($price * $allsettings->site_non_exclusive_commission) / 100;
                }
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php 

                ?>
                <ul class="list-unstyled font-size-sm py-3">
                <?php if($allsettings->site_extra_fee != 0): ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(Helper::translation(2901,$translate)); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($allsettings->site_extra_fee); ?></span></li>
                  <?php endif; ?>
                  <?php if($coupon_code != ""): ?>
                  <?php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  ?>
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2"><?php echo e(Helper::translation(2895,$translate)); ?></span><span class="text-right"><?php echo e($coupon_discount); ?> <?php echo e($allsettings->site_currency); ?></span></li>
                  <?php else: ?>
                  <?php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  ?>
                  <?php endif; ?> 
                  <li class="d-flex justify-content-between align-items-center font-size-base"><span class="mr-2"><?php echo e(Helper::translation(2896,$translate)); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($final); ?></span></li>
                </ul>
                <?php
                $vendor_amount = $priceamount - $commission;
                ?>

                <?php 

              // echo $item_price;

              // echo $total_prices;
                ?>
                <input type="hidden" name="order_id" value="<?php echo e(rtrim($order_id,',')); ?>">
                <input type="hidden" name="item_prices" value="<?php echo e(base64_encode(rtrim($item_price,','))); ?>">
                <input type="hidden" name="total_prices" value="<?php echo e(base64_encode(rtrim($total_prices,','))); ?>">
                <input type="hidden" name="item_user_id" value="<?php echo e(rtrim($item_userid,',')); ?>">
                <input type="hidden" name="amount" value="<?php echo e(base64_encode($last_price)); ?>">
                <input type="hidden" name="processing_fee" value="<?php echo e(base64_encode($allsettings->site_extra_fee)); ?>">
                <input type="hidden" name="website_url" value="<?php echo e(url('/')); ?>">
                <input type="hidden" name="admin_amount" value="<?php echo e(base64_encode($commission)); ?>">
                <input type="hidden" name="vendor_amount" value="<?php echo e(base64_encode($vendor_amount)); ?>">
                <input type="hidden" name="token" class="token">
                <input type="hidden" name="reference" value="<?php echo e(Paystack::genTranxRef()); ?>">
               </div>
              <div class="accordion mb-2" id="payment-method" role="tablist">
                <?php $no = 1; ?>
                <?php $__currentLoopData = $get_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                if($payment == '2checkout')
                {
                $payment = 'twocheckout';
                }
                else
                {
                $payment = $payment;
                }
                ?>
                <div class="card">
                  <div class="card-header" role="tab">
                    <h3 class="accordion-heading"><a href="#<?php echo e($payment); ?>" id="<?php echo e($payment); ?>" data-toggle="collapse"><?php echo e(Helper::translation(4899,$translate)); ?> <?php if($payment == 'twocheckout'): ?> <?php echo e(Helper::translation(4902,$translate)); ?> <?php else: ?> <?php echo e($payment); ?> <?php endif; ?><span class="accordion-indicator"><i data-feather="chevron-up"></i></span></a></h3>
                  </div>
                  <div class="collapse <?php if($no == 1): ?> show <?php endif; ?>" id="<?php echo e($payment); ?>" data-parent="#payment-method" role="tabpanel">
                  <?php if($payment == 'paypal'): ?>
                        <div class="card-body font-size-sm custom-control">
                          <div class="custom-radio">
                            <span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"></span> <?php echo e(Helper::translation(5937,$translate)); ?> - <?php echo e(Helper::translation(4905,$translate)); ?>

                          </div>
                          <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4908,$translate)); ?></button>
                        </div>
                    <?php endif; ?>
                  <?php if($payment == 'stripe'): ?>
                        <div class="card-body font-size-sm custom-radio custom-control">
                              <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio"  value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(Helper::translation(5940,$translate)); ?></span> - <?php echo e(Helper::translation(2903,$translate)); ?></p>
                              <div class="stripebox mb-3" id="ifYes" >
                                <label for="card-element"><?php echo e(Helper::translation(2903,$translate)); ?></label>
                                <div id="card-element"></div>
                                <div id="card-errors" role="alert"></div>
                              </div>
                              <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4911,$translate)); ?></button>
                        </div> 
                    <?php endif; ?>
                    <?php if($payment == 'wallet'): ?>
                        <div class="card-body font-size-sm custom-control custom-radio">
                          <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(Helper::translation(5943,$translate)); ?></span> - (<?php echo e($allsettings->site_currency); ?> <?php echo e(Auth::user()->earnings); ?>)</p>
                          <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4914,$translate)); ?></button>
                        </div>
                    <?php endif; ?>
                    <?php if($payment == 'twocheckout'): ?>
                        <div class="card-body font-size-sm custom-control custom-radio">
                          <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(Helper::translation(4902,$translate)); ?></span></p>
                          <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4917,$translate)); ?></button>
                        </div>
                    <?php endif; ?>
                    <?php if($payment == 'paystack'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(Helper::translation(5946,$translate)); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4920,$translate)); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'localbank'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(Helper::translation(5949,$translate)); ?></span></p>
                      <button class="btn btn-primary" type="submit"><?php echo e(Helper::translation(4923,$translate)); ?></button>
                    </div>
                    <?php endif; ?>
                    <?php if($payment == 'razorpay'): ?>
                    <div class="card-body font-size-sm custom-control custom-radio">
                      <p><span class='font-weight-medium'><input id="opt1-<?php echo e($payment); ?>" name="payment_method" type="radio" class="custom_radio" value="<?php echo e($payment); ?>" <?php if($no == 1): ?> checked <?php endif; ?> data-bvalidator="required"> <?php echo e(__('Razorpay')); ?></span></p>
                      <button class="btn btn-primary" type="submit">Checkout with Razorpay</button>
                    </div>
                    <?php endif; ?> 
                  </div>
                </div>
                <?php $no++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
            </form>
          </section>


          <aside class="col-lg-4 d-none d-lg-block">
            <hr class="d-lg-none">
            <div class="cz-sidebar-static h-100 ml-auto border-left">
              <div class="widget mb-3">
                <h2 class="widget-title text-center"><?php echo e(Helper::translation(2900,$translate)); ?></h2>
                <?php 
                $subtotal = 0;
                $order_id = '';
                $item_price = '';
                $item_userid = '';
                $item_user_type = '';
                $commission = 0;
                $vendor_amount = 0;
                $single_price = 0;
                $coupon_code = ""; 
                $new_price = 0;
                ?>
                <?php $__currentLoopData = $mobile['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <?php $itemArray=(count($cart->hasManysProducts) > 0 ) ? $cart->hasManysProducts : array(); ?>
                <div class="media align-items-center pb-3 mb-3 border-bottom">
                <a class="d-block mr-2" href="<?php echo e(url('/item')); ?>/<?php echo e($cart->item_slug); ?>">
                <?php if($cart->item_thumbnail!=''): ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($cart->item_thumbnail); ?>" alt="<?php echo e($cart->item_name); ?>"/>
                <?php else: ?>
                <img class="rounded-sm" width="64" src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($cart->item_name); ?>"/>
                <?php endif; ?>
                </a>
                  <div class="media-body pl-1">
                    <h6 class="widget-product-title"><a href="<?php echo e(url('/item')); ?>/<?php echo e($itemArray[0]->item_slug); ?>"><?php echo e($cart->item_name); ?></a></h6>
                    <div class="widget-product-meta"><span class="text-accent border-right pr-2 mr-2"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($cart->total_price); ?></span><span class="font-size-xs text-muted"><?php echo e($cart->license); ?><?php if($cart->license == 'regular'): ?> (<?php echo e(Helper::translation(2890,$translate)); ?>) <?php elseif($cart->license == 'extended'): ?> (<?php echo e(Helper::translation(2891,$translate)); ?>) <?php endif; ?></span></div>
                  </div>
                </div>
                <?php 
                $subtotal += $cart->total_price;
                $order_id .= $cart->ord_id.',';
                $item_price .= $cart->item_price.','; 
                $item_userid .= $cart->item_user_id.','; 
                $item_user_type .= $cart->exclusive_author; 
                $amount_price = $subtotal;
                $single_price = $cart->item_price;
                if($cart->discount_price != 0)
                {
                    $price = $cart->discount_price;
                    $new_price += $cart->discount_price;
                    $coupon_code = $cart->coupon_code;
                }
                else
                {
                   $price = $cart->item_price;
                   $new_price += $cart->item_price;
                   $coupon_code = "";
                }
        if($item_user_type == 1)
                {
                   $commission +=($price * $allsettings->site_exclusive_commission) / 100;
                }
                else
                {
                   $commission +=($price * $allsettings->site_non_exclusive_commission) / 100;
                }
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <ul class="list-unstyled font-size-sm pt-3 pb-2 border-bottom">
                <?php if($allsettings->site_extra_fee != 0): ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(Helper::translation(2901,$translate)); ?></span><span class="text-right"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($allsettings->site_extra_fee); ?></span></li>
                  <?php endif; ?>
                  <?php if($coupon_code != ""): ?>
                  <?php 
                  $coupon_discount = $subtotal - $new_price;
                  $final = $new_price + $allsettings->site_extra_fee;
                  $last_price =  $new_price;
                  $priceamount = $new_price;
                  ?>
                  <li class="d-flex justify-content-between align-items-center"><span class="mr-2"><?php echo e(Helper::translation(2895,$translate)); ?></span><span class="text-right"><?php echo e($coupon_discount); ?> 
                    <?php echo e($allsettings->site_currency); ?></span></li>
                  <?php else: ?>
                  <?php 
                  $final = $subtotal+$allsettings->site_extra_fee; 
                  $last_price =  $subtotal;
                  $priceamount = $subtotal;
                  ?>
                  <?php endif; ?> 
                  <h3 class="font-weight-normal text-center my-4"><?php echo e($allsettings->site_currency_symbol); ?> <?php echo e($final); ?></h3>
                  </ul>
               </div>
            </div>
          </aside>
          <?php else: ?>
          <section class="col-lg-12 pt-2 pt-lg-4 pb-4 mb-3">
          <div class="pt-2 px-4 pr-lg-0 pl-xl-5">
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="font-size-md"><?php echo e(Helper::translation(2898,$translate)); ?></div>
          </div>
          </div>
          </section>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <script type="text/javascript">

 $("#locgeo").hide();


// $(document).ready(function(){
//     $('.toast').toast('show');    
// });





</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/checkout.blade.php ENDPATH**/ ?>