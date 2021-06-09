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
                        <span class="owl-slide-animated">{{ $allsettings->site_banner_heading }} </span>
                        <h1 class="owl-slide-animated">{{ $allsettings->site_banner_subheading }}</h1>
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


<div class="container py-4 py-lg-5 my-4">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div class="card py-2 mt-4">
            <form method="POST" action="{{ route('forgot') }}"  id="login_form" class="card-body needs-validation">
               @csrf 
              <div class="form-group">
                <label for="recover-email">{{ Helper::translation(3011,$translate) }}</label>
                <input class="form-control" type="text" id="recover-email" name="email" data-bvalidator="email,required">
                <div class="invalid-feedback">{{ Helper::translation(5955,$translate) }}</div>
              </div>
              <button class="btn btn-primary" type="submit">{{ Helper::translation(3012,$translate) }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection