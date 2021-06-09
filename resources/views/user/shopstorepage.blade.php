@extends('user.layout')
@section('content')
<?php use Fickrr\Models\Designer; ?>
<section class="main-banner">    
 

                                            <?php @$sitebanner=explode(",", $allsettings->site_banner); 

                                            if(count($items_roomimages) > 0){ ?>

                                            <div class="main-banner-inr owl-carousel owl-theme">
                                              <?php   foreach(@$items_roomimages as $key=>$value) { ?>
                                                 <div class="main-banner-item" data-dot="<button>01</button>">
            <img src="{{ url('/') }}/public/storage/items/{{ $value->item_image }}"  alt="">
            <div class="main-banner-info">
                <div class="container">
                    <div class="main-banner-content owl-slide-text">
                         <span class="owl-slide-animated"></span>
                        <h1 class="owl-slide-animated"></h1>
                        <a href="#get-start" class="scroll-down owl-slide-animated"></a>
                    </div>
                </div>
            </div>
        </div> 

                                                <?php } ?>
                                            </div>
                                                
                                            <?php } else if(count(@$sitebanner) > 0 && @$sitebanner[0] != ''){  ?>
                                            
                                              <div class="main-banner-inr owl-carousel owl-theme">
      <?php  foreach(@$sitebanner as $key=>$value){ ?>
                                               
  
        <div class="main-banner-item" data-dot="<button>01</button>">
            <img src="{{ url('/') }}/public/storage/settings/{{ $value }}"  alt="">
            <div class="main-banner-info">
                <div class="container">
                    <div class="main-banner-content owl-slide-text">
                         <span class="owl-slide-animated">{{ $allsettings->site_banner_heading }}</span>
                        <h1 class="owl-slide-animated">{{ $allsettings->site_banner_subheading }}</h1>
                        <a href="#get-start" class="scroll-down owl-slide-animated"></a>
                    </div>
                </div>
            </div>
        </div> 

          <?php } ?>
     </div>
    
    <?php } else { ?>
                                              <div class="main-banner-inr owl-carousel owl-theme">  
        <div class="main-banner-item" data-dot="<button>02</button>">
            <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}"  alt="">
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
         <?php } ?>
  
</section>



<section class="bb-menu">
    <div class="container">
        <div class="bb-menu-inr bb-menu-no-slct-btn">
             <nav>
            <ul class="nav" id="nav-tab" role="tablist">
                <li><a id="nav-about-tab"  href="{{ url('/')}} " role="tab" >{{ trans('labels.Home') }} </a></li>
                <li><a id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="true" class="active">{{ trans('labels.About') }} </a></li>
               

                <li><a id="nav-designer-tab" data-toggle="tab" href="#nav-designer" role="tab" aria-controls="nav-designer" aria-selected="false">{{ trans('labels.Designer')}}</a></li>

               <!--  <li><a id="nav-venor-tab" data-toggle="tab" href="#nav-vendor" role="tab" aria-controls="nav-vendor" aria-selected="false">{{ trans('labels.Vendor')}}</a></li> -->
                <!--   <li class="nav-item nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" href="#nav-room" role="tab" aria-controls="nav-room" aria-selected="false"><a >Room</a></li> -->
                <li class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a><!--  // it is cosnder like shop -->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @if(count(@$item_room)>0)
                                @foreach(@$item_room as $key=>$value)
                                        <a id="nav-test-tab" data-toggle="tab" href="#nav-test" class="dropdown-item" role="tab" aria-controls="nav-test" aria-selected="false" onClick="loadAllimages('{{ $value->item_type_id }}','{{ $item['item']->item_id }}',[],[],[])"> {{ @$value->item_type_name }}</a>
                                @endforeach
                                @else
                                    <a class="dropdown-item" href="#">Location ,please add from backend</a>
                                @endif
                               <!--  <a id="nav-test-tab" data-toggle="tab" href="#nav-test" class="dropdown-item" role="tab" aria-controls="nav-test" aria-selected="false">Test1</a> -->
                        </div>
                </li>
            </ul> 
                <input type="hidden" name="roomid" id="roomid"  value="" />

           </nav>
          

        </div>
    </div>
</section>

<!-- <section class="vendor-page">
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
</section> -->

<section class="about-page">

 <!--    <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="nav-about">About</div>
            <div class="tab-pane fade show active" id="Designer" role="tabpanel" aria-labelledby="nav-Designer">Desinger</div>
            <div class="tab-pane fade show active" id="room" role="tabpanel" aria-labelledby="nav-room">Room</div>
            <div class="tab-pane fade show active" id="location" role="tabpanel" aria-labelledby="nav-room">location</div>
    </div>

 -->

  <div class="tab-content container" id="nav-tabContent">
  

   <div class="tab-pane fade show active" id="nav-about" role="tabpanel" aria-labelledby="nav-about">
        <div class="section-title text-center mb-4">
            <h2>{{ $item['item']->item_name }} </h2>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="share-fav about-social">
                <ul class="with-outline">

                    <?php //echo "<pre>";print_r(parse_url($item['item']->facebook ));

                            $facevook =parse_url($item['item']->facebook);
                            $twitterurl=parse_url($item['item']->twitterurl); 
                            $instagram=parse_url($item['item']->instagram);
                            $linkedin=parse_url($item['item']->linkedin);
                            $youtube=parse_url($item['item']->youtube);
                    ?>

                    @if(count($facevook) > 0)
                            @if(isset($facevook['scheme']) && isset($facevook['host']))
                                  <li><a class="ti ti-brand-facebook" href="{{ $item['item']->facebook }}" target="_blank"></a></li>

                            @else

                                <li><a class="ti ti-brand-facebook" href="https://facebook.com/{{ $item['item']->facebook }}" target="_blank"></a></li>   

                            @endif

                    @endif


                    @if(count($twitterurl) > 0)
                            @if(isset($twitterurl['scheme']) && isset($twitterurl['host']))
                                 <li><a class="ti ti-brand-twitter" href="{{ $item['item']->twitterurl }}" target="_blank"></a></li>
                            @else
                                <li><a class="ti ti-brand-twitter" href="https://twitter.com/{{ $item['item']->twitterurl }}" target="_blank"></a></li>
                            @endif

                    @endif

                    @if(count($instagram) > 0)
                            @if(isset($instagram['scheme']) && isset($instagram['host']))
                                 <li><a class="ti ti-brand-instagram" href="{{ $item['item']->instagram }}" target="_blank"></a></li>
                            @else
                                <li><a class="ti ti-brand-instagram" href="https://instagram.com/{{ $item['item']->instagram }}" target="_blank"></a></li>
                            @endif

                    @endif


                     @if(count($linkedin) > 0)
                            @if(isset($linkedin['scheme']) && isset($linkedin['host']))
                                 <li><a class="ti ti-brand-linkedin" href="{{ $item['item']->linkedin }}" target="_blank"></a></li>
                            @else
                                    <li><a class="ti ti-brand-linkedin" href="https://in.linkedin.com/{{ $item['item']->linkedin }}" target="_blank"></a></li>
                            @endif

                    @endif

                     @if(count($youtube) > 0)
                            @if(isset($youtube['scheme']) && isset($youtube['host']))
                                  <li><a class="ti ti-brand-youtube" href="{{ $item['item']->youtube }}" target="_blank"></a></li>
                            @else
                                <li><a class="ti ti-brand-linkedin" href="https://www.youtube.com/{{ $item['item']->youtube }}" target="_blank"></a></li>
                            @endif

                    @endif

                 
                </ul>
              </div>
                <div class="about-page-text text-justify">
                   @php echo html_entity_decode($item['item']->item_desc); @endphp
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-hotel">

                      <?php 
                        // echo "<pre>";print_r($item['item']);exit;
                      ?>

                      @if($item['item']->video_preview_type!='')
                      @if($item['item']->video_preview_type == 'youtube')
                      @if($item['item']->video_url != '')
                      @php
                      $link = $item['item']->video_url;
                    
                       $video_id =array();
                        @endphp
                      @if(strpos($link, "?v=") !== false)
                      @php
                      $video_id = explode("?v=", $link);
                     @endphp
                      @endif
                      @php
                      $video_id = count($video_id) > 0 && !empty($video_id) ? $video_id[1] : '';
                      @endphp


                      <iframe width="100%" height="430" src="https://www.youtube.com/embed/{{ $video_id }}?rel=0&version=3&loop=1&playlist={{ $video_id }}" frameborder="0" allow="autoplay" scrolling="no"></iframe>        
                      @else
                      <img src="{{ url('/') }}/resources/views/assets/no-video.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
                      @if($item['item']->video_preview_type == 'mp4')
                      @if($item['item']->video_file != '')
                      @if($allsettings->site_s3_storage == 1)
                      @php $videofileurl = Storage::disk('s3')->url($item['item']->video_file); 
                      @endphp

                       <video width="100%" height="430" controls loop><source src="{{ $videofileurl }}" type="video/mp4">{{ Helper::translation(5979,$translate) }}</video>
                      @else
                      <video width="100%" height="430" controls loop><source src="{{ url('/') }}/public/storage/items/{{ $item['item']->video_file }}" type="video/mp4">{{ Helper::translation(5979,$translate) }}</video>                @endif
                      @else
                      <img src="{{ url('/') }}/resources/views/assets/no-video.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
                  @else  
                      @if($item['item']->item_preview!='')
                      <a class="gallery-item rounded-lg mb-grid-gutter text-center d-inline-block" href="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" data-sub-html="{{ $item['item']->item_name }}">
                      <img  class="w-100" src="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      <span class="gallery-item-caption mt-2 d-inline-block">{{ $item['item']->item_name }}</span>
                      </a>
                      @else
                      <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item['item']->item_name }}" class="single-thumbnail">
                      @endif
                      @endif
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-designer" role="tabpanel" aria-labelledby="nav-Designer">
         <div class="section-title text-center mb-4">
            <h2>{{ trans('labels.aboutdesigner')}}</h2>
          </div>
            @if(count(@$designer) > 0)
            <div class="">
              @foreach(@$designer as $key=>$value)              
                <div class="item">
                  <div class="section-title with-sub mb-4">
                    <h2>{{ @$value->name }}</h2>
                    <div class="share-fav">
                      <ul>
                        <li><a class="ti ti-heart" href="#"></a></li>
                      </ul>
                      <ul class="with-outline">

                        <?php //echo "<pre>";print_r(parse_url($item['item']->facebook ));

                            $vfacevook =parse_url($value->facebook);
                            $twitterurl=parse_url($item['item']->twitterurl); 
                            $instagram=parse_url($item['item']->instagram);
                            $linkedin=parse_url($item['item']->linkedin);
                            $youtube=parse_url($item['item']->youtube);
                    ?>

                        <li><a class="ti ti-brand-facebook" href="{{ $value->facebook}}"></a></li>
                        <li><a class="ti ti-brand-youtube" href="{{ $value->youtube }}"></a></li>
                        <li><a class="ti ti-brand-instagram" href="{{ $value->instagram }}"></a></li>
                        <li><a class="ti ti-brand-linkedin" href="{{ $value->linkedin }}"></a></li>
                        <li><a class="ti ti-brand-twitter" href="{{ $value->twitter_url }}"></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="about-hotel">

                                <?php 

                                $designerid=$value->id;
        //                        $designerImages=Designer::with('hasManyDesignerimages')->whereHas('hasManyDesignerimages',function($q) use($designerid){
        //         $q->where('designer_id',$designerid);
        // })->get();


                                $designerImages=DB::table('designer_images')->where('designer_id',$designerid)->get();
                              // echo "<pre>";print_r($designerImages);

                               if(count($designerImages) > 0){ ?>

                                <div class="cz-gallery preview-pic tab-content">


                                <div class="tab-pane active" id="pic-1">
                                <div id="" class="">


                                   <?php  foreach($designerImages as $key1=>$value1){ ?>

                                         <div class="item-designer">
                                                <a class="gallery-item rounded-lg mb-grid-gutter" >
                                                        @if($value1->images!='')
                                                            <img src="{{ url('/') }}/public/storage/items/{{ $value1->images }}" alt="{{ $item['item']->item_name }}">
                                                        @else
                                                            <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ @$value->name  }}">
                                                        @endif
                                                        <span class="gallery-item-caption"> {{ @$value->name  }}</span>
                                                </a>
                                        </div>
<!-- 
                                             <img src="{{ url('/') }}/public/storage/items/{{ $value1->images }}" class="img-fluid"> -->
                                   <?php  } ?>
                               </div>
                           </div>
                       </div>
                               <?php }
                                ?>
                              <!-- <img src="{{ url('/resources/views/customtheme/assets/img/designer.jpg') }}" class="img-fluid"> -->
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="about-page-text">
                            <p>@php echo html_entity_decode($value->about); @endphp</p>
                          </div>
                      </div>
                  </div>
                </div>
              @endforeach
            </div>
        @endif
        
    </div>

    <div class="tab-pane fade" id="nav-vendor" role="tabpanel" aria-labelledby="nav-vendor">
        <div class="vendor-page"> 
            <div class="row">
                  <div class="col-md-12">
                    <div class="vendor-about text-center mb-5">
                      <div class="section-title mb-3">
                        <h2>{{ trans('labes.aboutvendor')}}</h2>
                      </div>
                      <p>{{ @$itemuser->about}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="vendor-info">
                      <a href="mailto:example@email.com"><i class="ti ti-mail"></i>{{ @$itemuser->email }}</a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="vendor-info">
                      <a href="#"><i class="ti ti-phone"></i>{{ @$itemuser->email }}</a>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="vendor-info">
                      <a href="#"><i class="ti ti-map"></i>{{ @$itemuser->address }}</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-test" role="tabpanel" aria-labelledby="nav-test">
    	<div class="section-title text-center d-flex d-md-block justify-content-between align-items-center mb-4">
            <h2 class="m-0">Products</h2>
            <button class="filter-cls">
              <svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable" aria-hidden="true" data-hb-id="pl-icon"><path d="M12 23.58a.51.51 0 01-.52-.5v-9.47L5.15 7.27A.47.47 0 015 6.73a.5.5 0 01.46-.31h17a.5.5 0 01.46.31.47.47 0 01-.11.54l-6.31 6.34v5.49a.5.5 0 01-.14.35l-4 4a.49.49 0 01-.36.13zM6.71 7.42l5.64 5.63a.51.51 0 01.15.35v8.49l3-3V13.4a.51.51 0 01.15-.35l5.64-5.63z"></path></svg>
              Sort &amp; Filter
            </button>
        </div>


            <?php 
                //echo "<pre>";print_r($category);exit;
            ?>
    	   <!--  <div class="product-slide">  
    	      	<div class="product-card">
    	      		<div class="product-card-img">
    	      			<a href="#">
    	      				<img src="https://static.toiimg.com/photo/72975551.cms">
    	      			</a>
    	      			<button class="product-card-fav"><i class="ti ti-heart"></i></button>
                  <div class="on-hov-btns">
                    <button class="btn btn-light btn-icon btn-shadow font-size-base mx-2"><i class="ti ti-eye"></i></button>
                    <button class="btn btn-light btn-icon btn-shadow font-size-base mx-2"><i class="ti ti-shopping-cart"></i></button>
                  </div>
    	      		</div>
    	      		<div class="product-card-name">
    	      			<label><a href="#">Lable Name</a></label>
    	      			<span><a href="#">Second Lable Name</a></span>
    	      		</div>
    	      	</div>
    	    </div> -->
    
    <div class="row ">

                       <!--  <?php 
                               // echo "<pre>";print_r($category['view'] );
                        ?>  -->

     <div class="col-md-4 col-lg-3 bb-menu-respo-full">
                <div class="card mb-4">
                  <div class="bb-menu-inr-head">
                    <button class="bb-menu-close">
                      <svg focusable="false" viewBox="2 2 24 24" class="pl-BaseIcon BaseIcon pl-BaseIcon--scalable pl-CloseButton-icon pl-CloseButton-icon--default" aria-hidden="true" data-hb-id="pl-icon"><path d="M18 18.5a.47.47 0 01-.35-.15l-8-8a.49.49 0 01.7-.7l8 8a.48.48 0 010 .7.47.47 0 01-.35.15z"></path><path d="M10 18.5a.47.47 0 01-.35-.15.48.48 0 010-.7l8-8a.49.49 0 11.7.7l-8 8a.47.47 0 01-.35.15z"></path></svg>
                    </button>
                    <h2>Sort &amp; Filter</h2>
                  </div>
                    <div class="card-body">
                        <!-- <div class="widget widget-categories">
                            <h3 class="widget-title">{{ trans('labels.roomtype') }}</h3>
                            
                        </div>
                        <hr> -->
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Best Seller</h3>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1 m-0">

                                    @if(count($mostSoldProduct) > 0)
                                        @foreach($mostSoldProduct as $key=>$value)
                                                <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                                    <div class="custom-control custom-checkbox">
                                                      <input class="custom-control-input" type="checkbox"  name="mostsold[]" id="mostsold_{{ $value->pro_id }}" value="{{ $value->pro_id }}">
                                                      <label class="custom-control-label cz-filter-item-text" for="mostsold_{{ $value->pro_id }}">{{ $value->item_name}} </label>
                                                    </div>
                                                </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div> 
                        <hr>
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Category</h3>
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1 m-0">
                                        @if(count($category) > 0)

                                            @foreach($category['view'] as $key=>$value)

                                             <li class="widget-list-item cz-filter-item mb-1">
                                                  
                                                            <div class="catname"> {{ $value['category_name'] }}</div>
                                                       

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
                                                                                              <input class="custom-control-input" type="checkbox" id="{{ $value1->subcat_id }}" name="item_category[]" value="{{ $value1->subcat_id }}" >
                                                                                              <label class="custom-control-label cz-filter-item-text" for="{{ $value1->subcat_id }}">-{{ $value1->subcategory_name }}</label>
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
                                                                                                                <input class="custom-control-input" type="checkbox" id="{{ $subsubvalue->subcat_id }}" name="item_category[]" value="{{ $value1->subcat_id }}" >
                                                                                                                <label class="custom-control-label cz-filter-item-text" for="{{ $subsubvalue->subcat_id }}"> --
                                                                                                                {{ $subsubvalue->subcategory_name }} </label>
                                                                                                            </div>
                                                                                                        </li>

                                                                                                        <?php } ?>

                                                                                                     </ul>


                                                                                                <?php } ?>



                                                                                      

                                            

                                                                              <?php   } ?>
                                                                            </ul>
                                                                    <?php }
                                                               
      
                                                      


                                                        ?>
                                                </li>


                                        @endforeach
                                        @endif
                              
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="widget widget-categories">
                            <h3 class="widget-title">Trend</h3>
                            @if( count($tagData) > 0)
                            <div class="widget widget-links">
                                <ul class="widget-list cz-filter-list pt-1 m-0">

                                    @foreach($tagData as $key=>$value)

                                        <li class="widget-list-item cz-filter-item d-flex justify-content-between align-items-center mb-1">
                                            <div class="custom-control custom-checkbox">
                                              <input class="custom-control-input" type="checkbox" id="{{ $value->tag_id }}" name="tag_name[]" value="{{ $value->tag_id }}">
                                              <label class="custom-control-label cz-filter-item-text" for="{{ $value->tag_id }}">{{ $value->tag_name }}</label>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>


                            @endif

                            
                        </div>

                    </div>
                </div>
            </div>

              <div class="col-md-8 col-lg-9">
                <div class="near-box">
                    <div class="row" id="prohtml">
                    </div>
                </div>
            </div>
        </div>

  <!--   <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="nav-room">
         <div class="section-title text-center mb-4">
            <h2>Location</h2>
        </div>
    </div> -->

</div>


</section>


<section class="staf-fev bg-light-gray">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2>Staff Favorites</h2>
        </div>
        <div class="row">

           @foreach ($related['items'] as $p)
           <div class="col-md-6 col-lg-3">
              <div class="card card-5">
                 @if($p->item_thumbnail!='')
                  <img src="{{ url('/') }}/public/storage/items/{{ $p->item_thumbnail }}" alt="{{ $p->item_name }}">
                @else
                  <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $p->item_name }}">
                @endif
                 
                 <div class="card-name"><a href="{{ URL::to('/item') }}/{{ $p->item_slug }}"> <span>{{ $p->item_name }}</span><span> {{ $p->username }}</span></a></div>
                 <!-- <div class="card-name">Founder, <span>Director</span></div> -->
                 <div class="card-icons">
                  <a class="ti ti-brand-facebook" target="_blank" href="{{URL::To('/item/'.$p->item_slug.'/facebook')}}"></a>
                  <a class="ti ti-brand-twitter" target="_blank" href="{{URL::To('/item/'.$p->item_slug.'/twitter')}}"></a>
                  <a class="ti ti-brand-instagram" href="#"></a>
                  <a class="ti ti-brand-linkedin" target="_blank" href="{{URL::To('/item/'.$p->item_slug.'/linkedin')}}"></a>
                 </div>
              </div>
            </div>

           @endforeach

           
        </div>
    </div>
</section>

<section class="rvybe-text">
    <div class="container">
        <?php 
        $staff_fav_img= url('/').'/public/storage/settings/'.@$allsettings->stafffav_image;
        ?>
      <div class="rvybe-info-txt" style="background-image: url('{{  $staff_fav_img }}')">
        <h2>Rvybe</h2>        
        <p>{{ @$allsettings->staff_fav_content}}</p>
        <a href="{{  url('/') }}" class="site-btn">Learn more</a>
      </div>
    </div>
</section>

<script type="text/javascript">


    
//  $("#locgeo").hide();
   /*   $("input:checkbox").click(function () {
            if ($(this).is(":checked")) {

                console.log($(this).val());
                loadAllimages($("#roomid").val(),"<?php // echo $item['item']->item_id; ?>",$(this).val());
             
            } else {
             
            }
    });*/
     

    function checkboxevt(){
        var checked = []; var product=[];var tag=[];
        $("input[name='item_category[]']:checked").each(function (){
                checked.push(parseInt($(this).val()));
        });

         $("input[name='mostsold[]']:checked").each(function (){
                product.push(parseInt($(this).val()));
        });

        $("input[name='tag_name[]']:checked").each(function (){
                tag.push(parseInt($(this).val()));
        });

        console.log("product");
        console.log(product);
        console.log(tag);

         loadAllimages($("#roomid").val(),"<?php echo $item['item']->item_id; ?>",checked,product,tag);


    }

    function addTofav(url){

    window.location.href=url;

}


function callslider(value){

    console.log(value);

}


    $("input:checkbox").click(function (){
           // if ($(this).is(":checked")) {
                checkboxevt();
           // } else {
           // }
    });
     
   
    //console.log(checked);
    
    function loadAllimages(roomid,hotelid,catid,product,tag){

      //  console.log("roomid",roomid);
       // console.log("hotelid",hotelid);
      console.log("tagtag",tag);

        $("#roomid").val(roomid);
          jQuery.ajax({

                url: "{{ url('/fetchroomproducthotel') }}",
                method:'post',
                data:{

                    roomid:roomid,
                    hotelid:hotelid,
                    catid:catid,
                    product:product,
                    tag:tag,
                    "_token": "{{ csrf_token() }}"
                    
                },
               dataType:"json",
                success: function(result){
                    console.log(result);

                    $("#prohtml").html('');
                    $("#prohtml").html(result.html);

            



                }

            });

    }
</script>

@endsection