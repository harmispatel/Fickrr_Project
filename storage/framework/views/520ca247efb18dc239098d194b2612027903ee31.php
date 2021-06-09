
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
                          <span class="owl-slide-animated"><?php echo e($allsettings->site_banner_heading); ?></span>
                        <h1 class="owl-slide-animated"><br><?php echo e($allsettings->site_banner_subheading); ?></h1>
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


<section class="bb-menu bb-menu-respo-full">
    <div class="container">

        <div class="bb-menu-inr">
          <div class="bb-menu-inr-head">
            <button class="bb-menu-close">
              <svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable pl-CloseButton-icon pl-CloseButton-icon--default" aria-hidden="true" data-hb-id="pl-icon"><path d="M18 18.5a.47.47 0 01-.35-.15l-8-8a.49.49 0 01.7-.7l8 8a.48.48 0 010 .7.47.47 0 01-.35.15z"></path><path d="M10 18.5a.47.47 0 01-.35-.15.48.48 0 010-.7l8-8a.49.49 0 11.7.7l-8 8a.47.47 0 01-.35.15z"></path></svg>
            </button>
            <h2>Sort & Filter</h2>
          </div>
            <ul>
                <!-- <li><a href="#">About</a></li>
                <li><a href="#">Designer</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Room</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php if(count($roomtype) > 0): ?>

                                        <?php $__currentLoopData = $roomtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a class="dropdown-item" href="#"> <?php echo e($value->item_type_name); ?> </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                   
                  </div>
                </li> -->
                <li>
                                            <select class="itemtye-box" name="itemtype" id="itemtype" onChange="callItemTypes(this)">
                                                <option value="hotel" <?php if(@$itemtype == 'hotel'): ?> selected='selected' <?php endif; ?>>Hotel</option>
                                                <option value="spa" <?php if(@$itemtype == 'spa'): ?> selected='selected' <?php endif; ?>>Spa</option>
                                                <option value="restaurant" <?php if(@$itemtype == 'restaurant'): ?> selected='selected' <?php endif; ?>>Resturant</option>
                                            </select>
                      
                    </li>
                  <li>   
                        <select class="itemtye-box" name="item_miles" id="item_miles" onChange="callmiles(this)">
                                <option value="100" <?php if(@$miles == '100'): ?> selected='selected' <?php endif; ?>>10</option>
                                <option value="20" <?php if(@$miles == '20'): ?> selected='selected' <?php endif; ?>>20</option>
                                 <option value="30" <?php if(@$miles == '30'): ?> selected='selected' <?php endif; ?>>30</option>
                                <option value="50" <?php if(@$miles == '50'): ?> selected='selected' <?php endif; ?>>50</option>
                                <option value="10" <?php if(@$miles == '10'): ?> selected='selected' <?php endif; ?>>100</option>
                        </select>
                                                </li>
                                            <li>
                                               <!--  <span id="latlng" style="display:none;"></span> -->
                        <?php if(count($roomtype) > 0): ?>
                                                    <select class="itemtye-box" name="room_type" id="room_type" onChange="callfn(this)">
                                                            <?php $__currentLoopData = $roomtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($value->item_type_id); ?>" <?php if(@$roomtypeid == (int)$value->item_type_id): ?> selected='selected' <?php endif; ?>><?php echo e($value->item_type_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                            <?php endif; ?>
                                        
                    </li>
            </ul>

          <!--   <nav>
            <ul class="nav" id="nav-tab" role="tablist">
                <li><a id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="true" class="active"><?php echo e(trans('labels.About')); ?> </a></li>
               

                <li><a id="nav-designer-tab" data-toggle="tab" href="#nav-designer" role="tab" aria-controls="nav-designer" aria-selected="false"><?php echo e(trans('labels.Designer')); ?></a></li>

               
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(trans('labels.Room')); ?></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

               
                      <a id="nav-test-tab" data-toggle="tab" href="#nav-test" class="dropdown-item" role="tab" aria-controls="nav-test" aria-selected="false">Test1</a>
                       <a class="dropdown-item" href="#">Test2</a>
                     
                  </div>
                </li>
            </ul> 

           </nav> -->
          

            
        </div>
    </div>
</section>


<section class="room-location">
    <div class="container">
        <div class="section-title d-flex justify-content-between align-items-center mb-3">
            <h2 class="m-0">Rvybe</h2>
            <button class="filter-cls">
              <svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable" aria-hidden="true" data-hb-id="pl-icon"><path d="M12 23.58a.51.51 0 01-.52-.5v-9.47L5.15 7.27A.47.47 0 015 6.73a.5.5 0 01.46-.31h17a.5.5 0 01.46.31.47.47 0 01-.11.54l-6.31 6.34v5.49a.5.5 0 01-.14.35l-4 4a.49.49 0 01-.36.13zM6.71 7.42l5.64 5.63a.51.51 0 01.15.35v8.49l3-3V13.4a.51.51 0 01.15-.35l5.64-5.63z"></path></svg>
              Sort & Filter
            </button>
        </div>
        <div class="row">
          <!--   <div class="col-md-4 col-lg-3">
                <div class="card mb-4">
                    <div class="card-body"> -->
                       <!--  <div class="widget widget-categories">
                            <h3 class="widget-title"><?php echo e(trans('labels.roomtype')); ?></h3>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1">
                                  
                                     <?php if(count($roomtype) > 0): ?>

                                      <?php $__currentLoopData = $roomtype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                        <div class="custom-control custom-checkbox">
                                          <input class="custom-control-input" type="checkbox" id="<?php echo e($value->item_type_name); ?>" name="item_type[]" value="<?php echo e($value->item_type_id); ?>">
                                          <label class="custom-control-label cz-filter-item-text" for="<?php echo e($value->item_type_name); ?>"><?php echo e($value->item_type_name); ?></label>
                                        </div>
                                      </li>

                                       
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>
                                  
                                </ul>
                            </div>
                        </div> -->
                       <!--  <hr> -->
                        <!-- <div class="rangeslider">
                            <h3 class="widget-title">Price</h3>
                            <div class="slider-wrapper">
                                <input class="input-range"  data-slider-id='ex12cSlider' type="text" data-slider-step="1" data-slider-value="15, 85" data-slider-min="0" data-slider-max="100" data-slider-range="true" data-slider-tooltip_split="true" />
                            </div>
                        </div>
                        <hr> -->
                       <!--  <div class="widget widget-categories">
                            <h3 class="widget-title"><?php echo e(Helper::translation(2879,$translate)); ?></h3>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1">
                                      <?php if(count($category) > 0): ?>

                                        <?php $__currentLoopData = $category['view']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                         <li class="widget-list-item cz-filter-item mb-1">
                                              
                                                <div class="catname"> <?php echo e($value['category_name']); ?></div>
                                                  

                                                   <?php 

                                                                $categoryId=$value['cat_id'];
                                                                $value=DB::table('subcategory')->where('drop_status','=','no')->where('subcategory_status','=','1')->where('cat_id','=',$categoryId);
                                                                $value= $value->where(function($q){
                                                                    $q->where('subcatparent_id','=',null)->orWhere('subcatparent_id','=',0);
                                                                });
                                                                $value= $value->orderBy('cat_id', 'desc')->get(); 

                                                                  if( count ($value) > 0 ){ ?>

                                                                     <ul>
                                                                           <?php  
                                                                                foreach($value as $key=>$value1) { ?>

                                                                                <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                          <input class="custom-control-input" type="checkbox" id="<?php echo e($value1->subcat_id); ?>" name="item_category[]" value="<?php echo e($value1->subcat_id); ?>" >
                                                                                          <label class="custom-control-label cz-filter-item-text" for="<?php echo e($value1->subcat_id); ?>">-<?php echo e($value1->subcategory_name); ?></label>
                                                                                        </div>
                                                                                </li>

                                                                                
                                                                               

                                                                                    <?php   $subcategoryId=$value1->subcat_id; 
                                                                                            $subsubvalue=DB::table('subcategory')->where('drop_status','=','no')->where('subcategory_status','=','1')->where('cat_id','=',$categoryId);
                                                                                          
                                                                                            $subsubvalue= $subsubvalue->where('subcatparent_id','=',$subcategoryId);
                                                                                          
                                                                                            $subsubvalue= $subsubvalue->orderBy('cat_id', 'desc')->get(); 

                                                                                        if( count ($subsubvalue) > 0 ){ ?>

                                                                                             <ul >
                                                                                                 <?php  
                                                                                                foreach($subsubvalue as $key=>$subsubvalue){ ?>
                                                                                

                                                                                                      <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                                                                                    <div class="custom-control custom-checkbox">
                                                                                                        <input class="custom-control-input" type="checkbox" id="<?php echo e($subsubvalue->subcat_id); ?>" name="item_category[]" value="<?php echo e($value1->subcat_id); ?>" >
                                                                                                        <label class="custom-control-label cz-filter-item-text" for="<?php echo e($subsubvalue->subcat_id); ?>"> --
                                                                                                        <?php echo e($subsubvalue->subcategory_name); ?> </label>
                                                                                                    </div>
                                                                                                </li>

                                                                                                <?php } ?>

                                                                                             </ul>


                                                                                        <?php } ?>



                                                                                  

                                                                                </li>

                                                                          <?php   } ?>
                                                                        </ul>
                                                                <?php }
                                                           
  
                                                  


                                                    ?>
                                            </li>


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                         </ul>
                   
                    
                

                               
                            </div>
                        </div> -->
                       <!--  <hr>
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Rvybe Exclusive</h3>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1 m-0">
                                  <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" type="checkbox"  name="item_type[]" value="hotel">
                                      <label class="custom-control-label cz-filter-item-text" >hotel</label>
                                    </div>
                                  </li>
                                  <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" type="checkbox" id="hotel4" name="item_type[]" value="hotel">
                                      <label class="custom-control-label cz-filter-item-text" for="hotel4">hotel</label>
                                    </div>
                                  </li>
                                  <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" type="checkbox" id="hotel5" name="item_type[]" value="hotel">
                                      <label class="custom-control-label cz-filter-item-text" for="hotel5">hotel</label>
                                    </div>
                                  </li>
                                  <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox">
                                      <input class="custom-control-input" type="checkbox" id="hotel6" name="item_type[]" value="hotel">
                                      <label class="custom-control-label cz-filter-item-text" for="hotel6">hotel</label>
                                    </div>
                                  </li>
                                </ul>
                            </div>
                        </div> -->
                       <!--  <hr>
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Trend</h3>
                            <?php if( count($tagData) > 0): ?>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1 m-0">

                                    <?php $__currentLoopData = $tagData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                            <div class="custom-control custom-checkbox">
                                              <input class="custom-control-input" type="checkbox" id="<?php echo e($value->tag_id); ?>" name="tag_name[]" value="<?php echo e($value->tag_id); ?>">
                                              <label class="custom-control-label cz-filter-item-text" for="<?php echo e($value->tag_id); ?>"><?php echo e($value->tag_name); ?></label>
                                            </div>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>


                            <?php endif; ?>

                            
                        </div> -->
                   <!--  </div>
                </div>
            </div> -->
            <div class="col-md-12 col-lg-12">
                <div class="near-box search-fltr-rslt" id="prohtml">
                    <div class="row row-respo">

                         <?php if(count($itemData['item']) != 0): ?>
        <?php $no = 1; ?>
        <?php $__currentLoopData = $itemData['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featured): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $price = Helper::price_info($featured->item_flash,$featured->regular_price);
        $count_rating = Helper::count_rating($featured->ratings);
        ?>

                             <div class="col-sm-6 col-md-4 col-lg-3 prod-item">
                            <article class="event-default-wrap">
                                <div class="event-default">
                                  <figure class="event-default-image">
                                     <?php if($featured->item_thumbnail!=''): ?>
                                    <img src="<?php echo e(url('/')); ?>/public/storage/items/<?php echo e($featured->item_thumbnail); ?>" alt="<?php echo e($featured->item_name); ?>">
                                    <?php else: ?>
                                    <img src="<?php echo e(url('/')); ?>/public/img/no-image.png" alt="<?php echo e($featured->item_name); ?>">
                                    <?php endif; ?>

                                  </figure>
                                 <!--  <div class="hotel-social">
                                    <ul>
                                      <li><a href="#"><i class="ti ti-brand-facebook"></i></a></li>
                                      <li><a href="#"><i class="ti ti-brand-instagram"></i></a></li>
                                      <li><a href="#"><i class="ti ti-brand-youtube"></i></a></li>
                                      <li><a href="#"><i class="ti ti-brand-linkedin"></i></a></li>
                                    </ul>
                                  </div> -->
                                </div>
                                <div class="event-default-info">
                                  <h5><a class="event-default-title" href="<?php echo e(URL::to('/shopstore')); ?>/<?php echo e($featured->item_slug); ?>"><?php echo e(substr($featured->item_name,0,20).'...'); ?></a></h5>
                                  <!-- <span><?php if($featured->item_flash == 1): ?> <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($featured->regular_price); ?> <?php endif; ?>
                                    <?php echo e($allsettings->site_currency_symbol); ?><?php echo e($price); ?></span> -->
                                    <div class="htl-detail-with-icon">
                                      <i class="ti ti-map-pin"></i>
                                      <?php echo e(substr($featured->item_shortdesc,0,20)); ?>

                                    </div>
                                    <div class="htl-detail-with-icon">
                                      <a href="#">
                                        <i class="ti ti-world"></i>
                                        <?php echo e($featured->website); ?>

                                      </a>
                                    </div>
                                    <div class="htl-detail-with-icon">
                                      <a href="#">
                                        <i class="ti ti-phone"></i>
                                      <?php echo e($featured->phonenumber); ?>

                                      </a>
                                    </div>
                                </div>
                                           </article>
                        </div>


                       <?php $no++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php else: ?>
       <div class="col-md-6 col-lg-4"><?php echo e(Helper::translation(6072,$translate)); ?></div>
       <?php endif; ?>

                     
                    </div>                    
                </div>
 <div class="text-right">
            <div class="turn-page" id="itempager">


            </div>
       </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">


    

   /*   $("input:checkbox").click(function () {
            if ($(this).is(":checked")) {

                console.log($(this).val());
                loadAllimages($("#roomid").val(),"<?php // echo $item['item']->item_id; ?>",$(this).val());
             
            } else {
             
            }
    });*/
     

     function callItemTypes(obj){
         var itemtype=obj.value;
         checkboxevt($("#item_miles").val(),itemtype,$("#room_type").val());


     }

   

     function callmiles(obj){


        var miles=obj.value;
         checkboxevt(miles,$("#itemtype").val(),$("#room_type").val());






     }

     function callfn(obj){


        console.log("roomtypevalue"+obj.value);
             var roomtype=obj.value;
         checkboxevt($("#item_miles").val(),$("#itemtype").val(),roomtype);

     }

    function checkboxevt(miles,itemtype,roomtype){


        console.log('hiii');
        var checked = []; var product=[]; var room=[];var tag=[];
        room.push(roomtype);
        // $("input[name='item_category[]']:checked").each(function (){
        //         checked.push(parseInt($(this).val()));
        // });

        //  $("input[name='item_type[]']:checked").each(function (){
        //         room.push(parseInt($(this).val()));
        // });

        // $("input[name='tag_name[]']:checked").each(function (){
        //         tag.push(parseInt($(this).val()));
        // });

        console.log("product");
        console.log(product);

        var hotelid=[];

         loadAllimages(room,hotelid,checked,product,tag,miles,itemtype);


    }

    function addTofav(url){

    window.location.href=url;

}


function callslider(value){

    console.log(value);

}


    $("input:checkbox").click(function (){
           // if ($(this).is(":checked")) {
                checkboxevt($("#item_miles").val(),$("#itemtype").val());
           // } else {
           // }
    });
     
   
    //console.log(checked);
    
    function loadAllimages(roomid,hotelid,catid,product,tag,miles,itemtype){


         var str= $("#latlng").html();
        //$("#latlng").html('');

var lat1=str.split(",")[0];
var lng1=str.split(",")[1];


        console.log("roomid",roomid);
       // console.log("hotelid",hotelid);
       // console.log("catid",catid);

       // $("#roomid").val(roomid);
          jQuery.ajax({

                url: "<?php echo e(url('/fetchroomproducthotelshop')); ?>",
                method: 'post',
                data: {

                    roomid:roomid,
                    hotelid:hotelid,
                    catid:catid,
                    product:product,
                    tag:tag,
                    miles:miles,
                    itemtype:itemtype,
                      latlng:str,
                       product_item:'<?php echo e($product_item); ?>',
                    lat:lat1,
                    lng:lng1,
                    "_token": "<?php echo e(csrf_token()); ?>"
                    
                },
               dataType:"json",
                success: function(result){
                    console.log(result);

                    $("#prohtml").html('');
                    $("#prohtml").html(result.rest);

            



                }

            });

    }

     $(document).ready(function(){

      $("#product_item_top").val('');
      $("#product_item_top").val('<?php echo e($product_item); ?>');


   // $("#find_btn").click(function () { //user clicks button
    if ("geolocation" in navigator){ //check geolocation available 
        //try to get user current location using getCurrentPosition() method
       navigator.geolocation.getCurrentPosition(function(position){ 
          $("#latlng").html();
                //$("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
                $("#latlng").html(position.coords.latitude + " , "+position.coords.longitude);
                checkboxevt($("#item_miles").val(),$("#itemtype").val(),$("#room_type").val());

        });

       // alert(lat,lng);
    }else{

        console.log("Browser doesn't support geolocation!");

    }

  

 $("#locgeo").hide();


});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\fickrr\resources\views/user/shop1.blade.php ENDPATH**/ ?>