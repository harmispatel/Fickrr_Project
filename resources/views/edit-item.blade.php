@if($allsettings->maintenance_mode == 0)
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>@if(Auth::user()->user_type == 'vendor') {{ Helper::translation(2935,$translate) }} @else {{ Helper::translation(2860,$translate) }} @endif - {{ $allsettings->site_title }}</title>
@include('meta')
@include('style')
</head>
<body>
@include('header')
@if(Auth::user()->user_type == 'vendor')
<div class="page-title-overlap pt-4" style="background-image: url('{{ url('/') }}/public/storage/settings/{{ $allsettings->site_banner }}');">
      <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
        <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-star">
              <li class="breadcrumb-item"><a class="text-nowrap" href="{{ URL::to('/') }}"><i class="dwg-home"></i>{{ Helper::translation(2862,$translate) }}</a></li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ Helper::translation(2935,$translate) }}</li>
              <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $type_name->item_type_name }}</li>
              </li>
             </ol>
          </nav>
        </div>
        <div class="order-lg-1 pr-lg-4 text-center text-lg-left">
          <h1 class="h3 mb-0 text-white">{{ Helper::translation(2935,$translate) }} <span class="dwg-arrow-right"></span> {{ $type_name->item_type_name }}</h1>
        </div>
      </div>
    </div>
<div class="container mb-5 pb-3">
      <div class="bg-light box-shadow-lg rounded-lg overflow-hidden">
        <div class="row">
          <!-- Sidebar-->
          <aside class="col-lg-4">
            <!-- Account menu toggler (hidden on screens larger 992px)-->
            <div class="d-block d-lg-none p-4">
            <a class="btn btn-outline-accent d-block" href="#account-menu" data-toggle="collapse"><i class="dwg-menu mr-2"></i>{{ Helper::translation(4878,$translate) }}</a></div>
            <!-- Actual menu-->
            @if(Auth::user()->id != 1)
            @include('dashboard-menu')
            @endif
          </aside>
          <!-- Content-->
          <section class="col-lg-8 pt-lg-4 pb-4 mb-3">
            <div class="pt-2 px-4 pl-lg-0 pr-xl-5">
              <!-- Product-->
            <form action="{{ route('edit-item') }}" class="setting_form" id="item_form" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
             <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div> <b>{{ Helper::translation(2986,$translate) }}</b><br/>{{ Helper::translation(2987,$translate) }} {{ Helper::translation(2988,$translate) }}
              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <div class="alert alert-info alert-with-icon font-size-sm mb-4" role="alert">
                <div class="alert-icon-box"><i class="alert-icon dwg-announcement"></i></div><b>{{ Helper::translation(2983,$translate) }} :</b> {{ Helper::translation(5961,$translate) }}<br/><b>{{ Helper::translation(2985,$translate) }} :</b> {{ Helper::translation(5964,$translate) }} 
              </div>
              </div>
              <div class="col-sm-12 mb-1">
              <h4>{{ Helper::translation(2936,$translate) }}</h4>
              </div>
              <input type="hidden" name="item_type" value="{{ $edit['item']->item_type }}">
              <input type="hidden" name="type_id" value="{{ $typer_id }}"> 
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2938,$translate) }} <span class="require">*</span> ({{ Helper::translation(2939,$translate) }})</label>
                  <input type="text" id="item_name" name="item_name" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->item_name }}">
                  @if ($errors->has('item_name'))
                  <span class="help-block">
                     <span class="red">{{ $errors->first('item_name') }}</span>
                  </span>
                 @endif
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2940,$translate) }}</label>
                  <textarea name="item_shortdesc" rows="6"  class="form-control">{{ $edit['item']->item_shortdesc }}</textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2941,$translate) }} <span class="require">*</span></label>
                  <textarea name="item_desc" id="summary-ckeditor" rows="6"  class="form-control" data-bvalidator="required">{{ html_entity_decode($edit['item']->item_desc) }}</textarea>
                  @if ($errors->has('item_desc'))
                  <span class="help-block">
                     <span class="red">{{ $errors->first('item_desc') }}</span>
                  </span>
                 @endif
                </div>
              </div>
              <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4">{{ Helper::translation(2942,$translate) }}</h4>
              </div>
             <!--  <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn">{{ Helper::translation(2943,$translate) }} <span class="require">*</span> ({{ Helper::translation(2946,$translate) }} : 80x80px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_thumbnail" name="item_thumbnail" class="files">
                      @if($edit['item']->item_thumbnail!='')
                      <img src="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_thumbnail }}" alt="{{ $edit['item']->item_name }}" width="80">
                      @else
                      <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $edit['item']->item_name }}" width="80">
                      @endif
                      </label>
                      @if ($errors->has('item_thumbnail'))
                      <span class="help-block">
                         <span class="red">{{ $errors->first('item_thumbnail') }}</span>
                      </span>
                     @endif
                 </div>
                </div>
              </div>  -->
              <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn">{{ Helper::translation(2945,$translate) }} <span class="require">*</span> ({{ Helper::translation(2946,$translate) }} : 361x230px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_preview" name="item_preview" class="files">
                      @if($edit['item']->item_preview!='')
                      <img src="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_preview }}" alt="{{ $edit['item']->item_name }}" width="80">
                      @else
                      <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $edit['item']->item_name }}" width="80">
                      @endif
                      </label>
                      @if ($errors->has('item_preview'))
                      <span class="help-block">
                         <span class="red">{{ $errors->first('item_preview') }}</span>
                      </span>
                     @endif
                 </div>
                </div>
              </div>
              <!-- <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn">{{ Helper::translation(2947,$translate) }} <span class="require">*</span> ({{ Helper::translation(2948,$translate) }})</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_file" name="item_file" class="files">
                      @if($allsettings->site_s3_storage == 1)
                      @php $fileurl = Storage::disk('s3')->url($edit['item']->item_file); @endphp
                      <a href="{{ $fileurl }}" download>{{ $edit['item']->item_file }}</a>
                      @else
                      @if($edit['item']->item_file!='')
                      <a href="{{ url('/') }}/public/storage/items/{{ $edit['item']->item_file }}" download>{{ $edit['item']->item_file }}</a>
                      @endif
                      @endif
                      </label>
                      @if ($errors->has('item_file'))
                      <span class="help-block">
                         <span class="red">{{ $errors->first('item_file') }}</span>
                      </span>
                     @endif
                 </div>
                </div>
              </div> -->
            <!--   <div class="col-sm-6">
                <div class="form-group upload_wrapper">
                  <label for="account-fn">{{ Helper::translation(2950,$translate) }} ({{ Helper::translation(2946,$translate) }} : 750x430px)</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="item_screenshot" name="item_screenshot[]" class="files">
                      @foreach($item_image['item'] as $item)
                      <span class="item-img"><img src="{{ url('/') }}/public/storage/items/{{ $item->item_image }}" alt="{{ $item->item_image }}" width="80">
                      <a href="{{ url('/edit-item') }}/dropimg/{{ base64_encode($item->itm_id) }}" onClick="return confirm('{{ Helper::translation(2892,$translate) }}');" class="drop-icon"><span class="dwg-trash drop-icon"></span></a>
                      </span>
                      @endforeach
                      </label>
                 </div>
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(5229,$translate) }}</label>
                  <select name="video_preview_type" id="video_preview_type" class="form-control">
                   <option value=""></option>
                   <option value="youtube" @if($edit['item']->video_preview_type == 'youtube') selected @endif>{{ Helper::translation(5925,$translate) }}</option>
                   <option value="mp4" @if($edit['item']->video_preview_type == 'mp4') selected @endif>{{ Helper::translation(5928,$translate) }}</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="youtube" @if($edit['item']->video_preview_type == 'youtube') class="form-group force-block" @else class="form-group force-none" @endif>
                  <label for="account-fn">{{ Helper::translation(2967,$translate) }} <span class="require">*</span></label>
                  <input type="text" id="video_url" name="video_url" class="form-control" data-bvalidator="required" value="{{ $edit['item']->video_url }}">
                  <small>({{ Helper::translation(2968,$translate) }} : https://www.youtube.com/watch?v=C0DPdy98e4c)</small>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="mp4" @if($edit['item']->video_preview_type == 'mp4') class="form-group force-block upload_wrapper" @else class="form-group force-none upload_wrapper" @endif>
                  <label for="account-fn">{{ Helper::translation(5910,$translate) }} <span class="require">*</span> ({{ Helper::translation(5913,$translate) }})</label>
                  <div class="custom_upload">
                    <label for="thumbnail">
                      <input type="file" id="video_file" name="video_file" class="text_field files">
                      @if($allsettings->site_s3_storage == 1)
                      @php $videofileurl = Storage::disk('s3')->url($edit['item']->video_file); @endphp
                      <a href="{{ $videofileurl }}" download>{{ $edit['item']->video_file }}</a>
                      @else
                      @if($edit['item']->video_file!='')
                      <a href="{{ url('/') }}/public/storage/items/{{ $edit['item']->video_file }}"  download>{{ $edit['item']->video_file }}</a>@endif
                      @endif
                      </label>
                      @if ($errors->has('video_file'))
                      <span class="help-block">
                         <span class="red">{{ $errors->first('video_file') }}</span>
                      </span>
                     @endif
                 </div>
                </div>
              </div>
              <!-- <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4">{{ Helper::translation(2951,$translate) }}</h4>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-email">{{ Helper::translation(2952,$translate) }} <span class="require">*</span></label>
                  <select name="item_category" id="item_category" class="form-control" data-bvalidator="required">
                  <option value="">{{ Helper::translation(5931,$translate) }}</option>
                  @foreach($categories['menu'] as $menu)
                  <option value="category_{{ $menu->cat_id }}" @if($cat_name == 'category') @if($menu->cat_id == $cat_id) selected="selected" @endif @endif>{{ $menu->category_name }}</option>
                  @foreach($menu->subcategory as $sub_category)
                  <option value="subcategory_{{$sub_category->subcat_id}}" @if($cat_name == 'subcategory') @if($sub_category->subcat_id == $cat_id) selected="selected" @endif @endif> - {{ $sub_category->subcategory_name }}</option>
                  @endforeach  
                  @endforeach
                  </select>
                </div>
              </div> -->
             
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2966,$translate) }}</label>
                  <input type="text" id="demo_url" name="demo_url" class="form-control"  value="{{ $edit['item']->demo_url }}">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ trans('labels.facebook') }} <span class="require">*</span></label>
                  <input type="text" id="socialmedialink" name="socialmedialink" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->facebook }}">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ trans('labels.instagram') }} <span class="require">*</span></label>
                  <input type="text" id="instagram" name="instagram" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->instagram }}">
                </div>
              </div>

                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn">{{ trans('labels.linkedin') }} <span class="require">*</span></label>
                      <input type="text" id="linkedin" name="linkedin" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->linkedin }}">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn">{{ trans('labels.website') }} <span class="require">*</span></label>
                      <input type="text" id="website" name="website" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->website }}">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn">{{ trans('labels.phonenumber') }} <span class="require">*</span></label>
                      <input type="text" id="phonenumber" name="phonenumber" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->phonenumber }}">
                    </div>
              </div>
              <div class="col-sm-6">
                    <div class="form-group">
                      <label for="account-fn">{{ trans('labels.email') }} <span class="require">*</span></label>
                      <input type="text" id="email" name="email" class="form-control" data-bvalidator="required,maxlen[100]" value="{{ $edit['item']->email }}">
                    </div>
              </div>
             <!--  <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2972,$translate) }}</label>
                  <select name="item_flash_request" id="item_flash_request" class="form-control">
                  <option value=""></option>
                  <option value="1" @if($edit['item']->item_flash_request == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                  <option value="0" @if($edit['item']->item_flash_request == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                  </select>
                  <small>({{ Helper::translation(2973,$translate) }})</small>
                </div>
              </div> -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2974,$translate) }}</label>
                  <textarea name="item_tags" id="item_tags" rows="6" class="form-control">{{ $edit['item']->item_tags }}</textarea>
                  <small>({{ Helper::translation(2975,$translate) }})</small>
                </div>
              </div>
            <!--   <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4">{{ Helper::translation(2976,$translate) }}</h4>
              </div> -->
             <!--  <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2977,$translate) }} <span class="require">*</span></label>
                  <select name="future_update" id="future_update" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" @if(@$edit['item']->future_update == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                  <option value="0" @if(@$edit['item']->future_update == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="account-fn">{{ Helper::translation(2978,$translate) }} <span class="require">*</span></label>
                  <select name="item_support" id="item_support" class="form-control" data-bvalidator="required">
                  <option value=""></option>
                  <option value="1" @if($edit['item']->item_support == 1) selected="selected" @endif>{{ Helper::translation(2970,$translate) }}</option>
                  <option value="0" @if($edit['item']->item_support == 0) selected="selected" @endif>{{ Helper::translation(2971,$translate) }}</option>
                  </select>
                </div>
              </div> -->
             <!--  <div class="col-sm-12 mt-4 mb-1">
              <h4 class="mt-4">{{ Helper::translation(2888,$translate) }}</h4>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price">{{ Helper::translation(2979,$translate) }} <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">{{ $allsettings->site_currency }}</span></div>
                      <input type="text" id="regular_price" name="regular_price" class="form-control" data-bvalidator="digit,min[1],required" value="{{ $edit['item']->regular_price }}">
                    </div>
              </div>
              <div class="col-sm-6 mb-1">
                    <label class="font-weight-medium" for="unp-standard-price">{{ Helper::translation(2980,$translate) }} <span class="require">*</span></label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text">{{ $allsettings->site_currency }}</span></div>
                      <input type="text" id="extended_price" name="extended_price" class="form-control" data-bvalidator="digit,min[1]" value="@if($edit['item']->extended_price==0) @else {{ $edit['item']->extended_price }} @endif">
                    </div>
              </div> -->
              <input type="hidden" name="save_file" value="{{ $edit['item']->item_file }}">
              <input type="hidden" name="save_thumbnail" value="{{ $edit['item']->item_thumbnail }}">
              <input type="hidden" name="save_preview" value="{{ $edit['item']->item_preview }}">
              <input type="hidden" name="save_extended_price" value="{{ $edit['item']->extended_price }}">
              <input type="hidden" name="item_token" value="{{ $edit['item']->item_token }}">
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="save_video_file" value="{{ $edit['item']->video_file }}">
              <div class="col-12 pt-3 mt-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                @if($allsettings->item_approval == 0)
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i>{{ Helper::translation(2981,$translate) }}</button>
                @else
                <button class="btn btn-primary btn-block" type="submit"><i class="dwg-cloud-upload font-size-lg mr-2"></i>{{ Helper::translation(2876,$translate) }}</button>
                @endif
                </div>
              </div>
            </div>
          </form>  
            </div>
          </section>
        </div>
      </div>
    </div>
    @else
    @include('not-found')
    @endif
@include('footer')
@include('script')
<script type="text/javascript">
	$(document).ready(function()
	{
	'use strict';
	$('#video_preview_type').on('change', function() {
      if ( this.value == 'youtube')
      
      {
	     $("#youtube").show();
		 $("#mp4").hide();
	  }	
	  else if ( this.value == 'mp4')
	  {
	     $("#mp4").show();
		 $("#youtube").hide();
	  }
	  else
	  {
	      $("#mp4").hide();
		  $("#youtube").hide();
	  }
	  
	 });
});
</script>
</body>
</html>
@else
@include('503')
@endif