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
<?php 
//echo "<pre>";print_r($allsettings);exit;

?>
<section class="call-to-action">
    <div class="container">
        <div class="call-action">
            <!-- <div class="call-action-icon"><i class="ti ti-phone"></i></div>
            <a href="#">(+44) (0) 845 863 693</a> -->
            <div class="row align-items-center">
                <div class="col-md-9">
                    <p>
                        <?php if(!empty(@$allsettings)): ?>
                                <?php echo e(@$allsettings->calltoactiontext); ?>

                        <?php else: ?>

                         Get the interior design vybe from your favorite hotel, restaurant or spa delivered directly to your home.  Go to Rvybe.com to get started in these Pennsylvania 
                        <?php endif; ?>
                   <!-- towns:  New Hope, State College and Wayne.   Stay tuned for more towns and cities! 
<button id="find_btn">Find Me</button>
<div id="result"></div> -->

</p>
                </div>
                <div class="col-md-3 text-right">
                    <a href="#" class="btn btn-white">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="near-main">
    <div class="container">
        <div class="section-title">
            <h2>Hotels Near You</h2>
        </div>

      
        <!-- <div class="product-slide owl-carousel owl-theme">  
            <div class="product-card">
                <div class="product-card-img">
                    <a href="#">
                        <img src="https://static.toiimg.com/photo/72975551.cms">
                    </a>
                    <button class="product-card-fav"><i class="ti ti-heart"></i></button>
                </div>
                <div class="product-card-name">
                    <label><a href="#">Lable Name</a></label>
                    <span><a href="#">Second Lable Name</a></span>
                </div>
            </div>
             <div class="product-card">
                <div class="product-card-img">
                    <a href="#">
                        <img src="https://static.toiimg.com/photo/72975551.cms">
                    </a>
                    <button class="product-card-fav"><i class="ti ti-heart"></i></button>
                </div>
                <div class="product-card-name">
                    <label><a href="#">Lable Name</a></label>
                    <span><a href="#">Second Lable Name</a></span>
                </div>
            </div>
             <div class="product-card">
                <div class="product-card-img">
                    <a href="#">
                        <img src="https://static.toiimg.com/photo/72975551.cms">
                    </a>
                    <button class="product-card-fav"><i class="ti ti-heart"></i></button>
                </div>
                <div class="product-card-name">
                    <label><a href="#">Lable Name</a></label>
                    <span><a href="#">Second Lable Name</a></span>
                </div>
            </div>
             <div class="product-card">
                <div class="product-card-img">
                    <a href="#">
                        <img src="https://static.toiimg.com/photo/72975551.cms">
                    </a>
                    <button class="product-card-fav"><i class="ti ti-heart"></i></button>
                </div>
                <div class="product-card-name">
                    <label><a href="#">Lable Name</a></label>
                    <span><a href="#">Second Lable Name</a></span>
                </div>
            </div>

          </div> -->

        
                  <div class="near-box">
          <!--   <div class="nearslide owl-theme owl-carousel" id="hotel-near-you"> -->

                  <div class="nearslider owl-theme owl-carousel" id="hotel-near-you" >

                      <?php 

              //echo "<pre>RESSST";print_r($featured['items']);exit;
                 ?>
                  
               
              
            </div>                
        </div>
    </div>
    <div class="container">
        <div class="section-title">
            <h2>Restaurants Near You</h2>
        </div>
        <div class="near-box">
            <div class="restaurant owl-theme owl-carousel" id="restaurant-near-you">
            	<?php if(count($popular['items']) != 0): ?>
                <?php $no = 1; ?>
                <?php $__currentLoopData = $popular['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $price = Helper::price_info($featured->item_flash,$featured->regular_price);
                $count_rating = Helper::count_rating($featured->ratings);
                ?>
                <div class="item">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image">

                                 <?php if($featured->item_thumbnail!=''): ?>
                             <a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>">
                                <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_thumbnail); ?>" alt="<?php echo e($featured->item_name); ?>"></a>
                            <?php else: ?>
                           <a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>">  <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>"></a>
                            <?php endif; ?>

                           </figure>
                           </div>
                           <div class="event-default-inner">
                            <h5><a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(@$featured->item_name); ?></a></h5>
                            </div>
                            </article>
                            </div>
                          
              
                <?php $no++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

               
            </div>                    
        </div>
    </div>

     <div class="container">
        <div class="section-title">
            <h2>Spas Near You</h2>
        </div>
        <div class="near-box">
            <div class="spas owl-theme owl-carousel" id="spas-near-you">

              
               
            </div>                    
        </div>
    </div>

    <div class="container">
        <div class="section-title">
            <h2>Vybes Near You</h2>
        </div>
        <div class="near-box">
            <div class="vybesnear owl-theme owl-carousel" id="vybes-near-you">

            	<?php if(count($newest['items']) != 0): ?>
                <?php $no = 1; ?>
        <?php $__currentLoopData = $newest['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        ?>

                <div class="item">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image">

                                  <?php if($featured->item_thumbnail!=''): ?>
                              <a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>">
                            <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_thumbnail); ?>" alt="<?php echo e(@$featured->item_name); ?>"> </a>
                            <?php else: ?>

                            <a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>">
                            <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>"> </a>
                            <?php endif; ?>

                   </figure>
                  </div>
                            <div class="event-default-inner">
                                <h5><a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(@$featured->item_name); ?></a></h5>
                                </div>
                                </article>
                            </div>

                <?php $no++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
                <?php endif; ?>

            </div>                    
        </div>
    </div>

    <?php 
    //echo "<pre>";print_r($rvybe['exclusive']);
    ?>
    <div class="container">
        <div class="section-title">
            <h2>Rvybe Exclusives</h2>
        </div>
        <div class="near-box">
            <div class="rvybesexls owl-theme owl-carousel" id="rvybe-exc-you">
                <?php if(count($rvybe['exclusive']) > 0): ?>

                <?php $__currentLoopData = $rvybe['exclusive']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="item">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image">
                                   <a class="event-default-title" href="<?php echo e(URL::to('/item')); ?>/<?php echo e(@$value->item_slug); ?>">
                                         <?php if($value->item_thumbnail!=''): ?>
                                        <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($value->item_thumbnail); ?>" alt="<?php echo e(@$value->item_name); ?>">
                                        <?php else: ?>
                                        <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e(@$value->item_name); ?>">
                                        <?php endif; ?>
                                    </a>

                            </figure>
                        </div>
                        <div class="event-default-inner">
                            <h5><a class="event-default-title" href="<?php echo e(URL::to('/item')); ?>/<?php echo e(@$value->item_slug); ?>"><?php echo e(@$value->item_name); ?></a></h5>
                        </div>
                  </article>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

             
                  
               <!--  <div class="col-md-6">
                    <article class="event-default-wrap">
                        <div class="event-default">
                          <figure class="event-default-image"><img src="<?php echo e(URL::to('resources/views/customtheme/assets/img/hotel.jpg')); ?>" class="" alt="">
                          </figure>
                        </div>
                        <div class="event-default-inner">
                          <h5><a class="event-default-title" href="#">Name</a></h5>
                        </div>
                    </article>
                </div> -->
            </div>                    
        </div>
    </div>
</section>

<script type="text/javascript">

    function sliderseee(){


          $('.nearslider').owlCarousel({
                            loop:false,
                            margin:30,
                            lazyLoad: true,
                            navigation : false,
                            dots:false,
                            autoplay:false,
                            autoplayTimeout:1000,
                            responsiveClass:true,
                            responsive:{
                                0:{
                                    items:2,
                                    nav:false,
                                },
                                600:{

                                    items:3,
                                    nav:true,
                                },
                                768:{
                                    items:4,
                                    nav:true,
                                },
                                1000:{

                                    items:5,
                                    nav:true,
                                }
                                
                            }

                });


          console.log("INSLIDERSEEE ");

    }


    function restaurant(){

         $('.restaurant').owlCarousel({
                            loop:false,
                            margin:30,
                            lazyLoad: true,
                            navigation : false,
                            dots:false,
                            autoplay:false,
                            autoplayTimeout:1000,
                            responsiveClass:true,
                            responsive:{
                                0:{
                                    items:2,
                                    nav:false,
                                },
                                600:{

                                    items:3,
                                    nav:true,
                                },
                                768:{
                                    items:4,
                                    nav:true,
                                },
                                1000:{

                                    items:5,
                                    nav:true,
                                }
                                
                        }

        });

    }


    function vybesnear(){
        
          $('.vybesnear').owlCarousel({
                            loop:false,
                            margin:30,
                            lazyLoad: true,
                            navigation : false,
                            dots:false,
                            autoplay:false,
                            autoplayTimeout:1000,
                            responsiveClass:true,
                            responsive:{
                                0:{
                                    items:2,
                                    nav:false,
                                },
                                600:{

                                    items:3,
                                    nav:true,
                                },
                                768:{
                                    items:4,
                                    nav:true,
                                },
                                1000:{

                                    items:5,
                                    nav:true,
                                }
                                
                            }

                });


    }

        function rvybesexls(){
        
            $('.rvybesexls').owlCarousel({
                            loop:false,
                            margin:30,
                            lazyLoad: true,
                            navigation : false,
                            dots:false,
                            autoplay:false,
                            autoplayTimeout:1000,
                            responsiveClass:true,
                            responsive:{
                                0:{
                                    items:2,
                                    nav:false,
                                },
                                600:{

                                    items:3,
                                    nav:true,
                                },
                                768:{
                                    items:4,
                                    nav:true,
                                },
                                1000:{

                                    items:5,
                                    nav:true,
                                }
                        }

            });

        }


    function spas(){

         $('.spas').owlCarousel({

                loop:false,
                margin:30,
                lazyLoad: true,
                navigation : false,
                dots:false,
                autoplay:false,
                autoplayTimeout:1000,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                        nav:false,
                    },
                    600:{

                        items:3,
                        nav:true,
                    },
                    768:{
                        items:6,
                        nav:true,
                    },
                    1000:{

                        items:5,
                        nav:true,
                    }
                    
                }

        });


    }
    




    $(document).ready(function(){

        //  sliderseee();
        // restaurant();
        //  vybesnear();
              // rvybesexls();
        //         spas();
        rvybesexls();  
        $("#locgeo").show();

    if ("geolocation" in navigator){ //check geolocation available 
        
        navigator.geolocation.getCurrentPosition(function(position){ 
                //$("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
                $("#latlng").html(position.coords.latitude + " , "+position.coords.longitude);
                test();

        });

      
    }else{
          //

        console.log("Browser doesn't support geolocation!");

    }


    function test(){




        // console.log( $("#latlng").html());

        var str= $("#latlng").html();
        $("#latlng").html('');

        var lat1=str.split(",")[0];
        var lng1=str.split(",")[1];

        jQuery.ajax({

                url: "<?php echo e(url('/fetchlocation')); ?>",
                method: 'post',
                data: {

                    latlng:str,
                    lat:lat1,
                    lng:lng1,
                   
                    "_token": "<?php echo e(csrf_token()); ?>"
                    
                },
                dataType:"json",
                success: function(result){

                  console.log(result);

                console.log('helllooo');
                   // var t=JSON.parse(result);
                     var t=result;

                $("#locgeo").html('');
                $("#locgeo").html(t.location);


                $("#hotel-near-you").html();
                $("#hotel-near-you").html(t.hotels);
                sliderseee();


                $("#restaurant-near-you").html();
                $("#restaurant-near-you").html(t.restaurant);

                restaurant();
              

                $("#vybes-near-you").html();
                $("#vybes-near-you").html(t.nearbyvybes);
                vybesnear();
                // $("#rvybe-exc-you").html();
                //  $("#rvybe-exc-you").html(t.rvybe);

                $("#spas-near-you").html();
                $("#spas-near-you").html(t.spas);
                // rvybesexls();
                spas();
            

                }

        });




}


});


//});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/index1.blade.php ENDPATH**/ ?>