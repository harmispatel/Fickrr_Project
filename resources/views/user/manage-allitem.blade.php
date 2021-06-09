@extends('user.layout')
@section('content')

<section class="main-banner">    
  @if($allsettings->site_banner != '')

                                            <?php @$sitebanner=explode(",", $allsettings->site_banner); ?>

                                            @if(count(@$sitebanner) > 0 && @$sitebanner[0] != '' )
                                              <div class="main-banner-inr owl-carousel owl-theme">
      @foreach(@$sitebanner as $key=>$value)
                                               
  
        <div class="main-banner-item" data-dot="<button>01</button>">
            <img src="{{ url('/') }}/public/storage/settings/{{ $value }}"  alt="">
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

         @endforeach
     </div>
     @endif
    @else
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
         @endif   
  
</section>

<!-- <div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3"> -->
       <!--  <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2932,$translate) }}</li>
              </li>
             </ol>
          </nav>
        </div> -->
        <!-- <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2932,$translate) }} </h1>
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
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i>{{ Helper::translation(4878,$translate) }}  </a></div> -->
            <!-- Actual menu-->
         
          <!-- </aside> -->
          <!-- Content-->
          <section class="col-lg-12 pt-lg-12 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <div class="row border-bottom mb-4">
              <h2 class="h3 pt-2 pb-4 mb-0 col pull-left"> {{ trans('labels.Shophotelsresturantsspa')}}<span class="badge badge-secondary font-size-sm text-body align-middle ml-2">{{ count($itemData['item']) }}</span></h2> 
           <!--    @if(Auth::user())
            <div class="col pull-right">
               <a href="{{ url('/manage-allitem')}}" class="btn btn-primary btn-sm dropbtn"> {{ trans('labels.Viewallshops') }}</a>
              <a href="{{ url('/manage-item')}}" class="btn btn-primary btn-sm dropbtn" > {{ trans('labels.OwnSHops') }}</a>
                        
               </div>    
                @endif         --> 
              </div>
              <!-- Product-->
              <div class="row"> 
                  @php $no = 1; @endphp
                  @foreach($itemData['item'] as $featured)
                  @php
                      $price = Helper::price_info($featured->item_flash,$featured->regular_price);
                  @endphp
                  <div class="col-md-6 col-lg-4 mb-4">
                    <div class="media d-block p-3 bg-light box-shadow-lg rounded-lg">
                      <div class="cart-img-fixheight mb-3 position-relative">
                        @if($featured->item_preview!='')
                        <img class="rounded-lg cart-img" src="{{ url('/') }}/public/storage/items/{{ $featured->item_preview }}" alt="{{ $featured->item_name }}">
                        @else
                        <img class="rounded-lg cart-img" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $featured->item_name }}">
                        @endif
                        <div class="on-img-text">
                          <div class="d-inline-block text-price">{{ $allsettings->site_currency_symbol }}{{ $price }}</div>
                          <span>{{ ucwords(str_replace('-',' ',$featured->item_type)) }}</span>
                        </div>
                      </div>
                      @php $encrypted = $encrypter->encrypt($featured->item_token); @endphp
                      <span class="close-floating" data-toggle="tooltip" title="{{ Helper::translation(6036,$translate) }}"><i class="dwg-close"></i></span>
                        <div class="media-body text-center text-sm-left overflow-hidden">
                          <h3 class="h6 product-title product-title-respo mb-2">
                            <a href="{{ URL::to('/shopstore') }}/{{ $featured->item_slug }}">{{ substr($featured->item_name,0,20).'...' }}</a> 
                            @if($featured->item_status == 0) 
                            <span class="badge badge-pill badge-danger pull-right">
                                {{ Helper::translation(3092,$translate) }}
                            </span> 
                            @endif
                        </h3>
                        <!--   <a class="d-inline-block text-accent font-size-ms border-left ml-2 pl-2" href="{{ URL::to('/shop') }}/item-type/{{ $featured->item_type }}"></a> -->
                        <div class="form-inline pt-2 w-100">
                          {{ substr($featured->item_shortdesc,0,60).'...' }}
                          <div class="d-flex mt-2 mt-md-0 w-100 justify-content-center d-md-inline-block">
                          <!--   <a href="{{ URL::to('/edit-item') }}/{{ $featured->item_token }}" class="btn btn-success btn-sm my-2 mr-3"><i class="dwg-edit mr-1"></i>{{ Helper::translation(2923,$translate) }}</a>
                            <a class="btn btn-primary btn-sm mx-sm-0 my-2" href="{{ URL::to('/manage-item') }}/{{ $encrypted }}" onClick="return confirm('{{ Helper::translation(2892,$translate) }}');"><i class="dwg-trash mr-1"></i>{{ Helper::translation(2924,$translate) }}</a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @php $no++; @endphp
                @endforeach
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>



@endsection