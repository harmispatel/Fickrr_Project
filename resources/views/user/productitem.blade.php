@extends('user.layout')
@if (!empty($shareItemDetail)) 
  @section('metashare')
	<meta property="og:url"           content="{{$shareItemDetail['url']}}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{$shareItemDetail['title']}}" />
	<meta property="og:description"   content="{{$shareItemDetail['title']}}" />
	<meta property="og:image"         content="{{$shareItemDetail['image']}}" />
  @endsection
@endif
@section('content')


<style>

</style>


<div class="toast-container toast-top-center" id="csttoas">
      <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
          <h6 class="font-size-sm text-white mb-0 mr-auto">{{ Helper::translation(5973,$translate) }}</h6>
          <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body text-danger">You can only purchase same vendor product</div>
      </div>
</div>


<!-- <?php // echo "<pre>";print_r( $related['items']);?> -->
<!-- <?php // echo "<pre>";print_r( $item['item']);?> -->
<section class="product-details-sec">
  <div class="container">
	<div class="product-details">
		<div class="container-fliud">
			<div class="wrapper row">
				<div class="preview-main col-md-6">

					

				  <div class="preview">
					<!-- <div class="preview-pic tab-content">

						<div class="tab-pane active" id="pic-1">
						  @if($item['item']->item_preview!='')
							<img src="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" alt="{{ $item['item']->item_name }}">
						  @else
							<img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item['item']->item_name }}">
						  @endif
						</div>
					</div>
 -->
					 <div class="cz-gallery preview-pic tab-content">


					 		<div class="tab-pane active" id="pic-1">
					 			<div id="hotel-images" class="owl-carousel owl-theme">

					 			<?php 

								 	$item_allimages=array();
								 	$item_allimages['itm_id']=$item['item']->pro_id;
								 	$item_allimages['item_token']=$item['item']->item_token;
								 	$item_allimages['item_image']=$item['item']->item_preview;
								 	$item_allimages=(object)$item_allimages;
					 				//echo "<pre>";print_r($item_allimages);
					 				$item_allimage[]=$item_allimages;
					 				//echo "<pre>";print_r($item_allimage);
					 			?>
						 @foreach($item_allimage as $image)
						 <div class="item">
					 			 <a class="gallery-item rounded-lg mb-grid-gutter" >
						  @if($image->item_image!='')
							<img src="{{ url('/') }}/public/storage/items/{{ $image->item_image }}" alt="{{ $item['item']->item_name }}">
						  @else
							<img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item['item']->item_name }}">
						  @endif
						  <span class="gallery-item-caption"> {{ $item['item']->item_name }}</span>
						</a>
					</div>
						@endforeach
						</div>
					</div>
					 </div>

					
					

					 	
				  	<!--   <ul class="preview-thumbnail nav nav-tabs">
						<li class="active">
						  <a data-target="#pic-1" data-toggle="tab">
							@if($item['item']->item_preview!='')
							  <img src="{{ url('/') }}/public/storage/items/{{ $item['item']->item_preview }}" alt="{{ $item['item']->item_name }}">
							@else
							  <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $item['item']->item_name }}">
							@endif
						  </a>
						</li>


						</ul> 
					-->

					<?php 
						//echo "<pre>";print_r($item_allimage);exit;
					?>
						<ul  class="preview-thumbnail nav nav-tabs"><li class="active"></li></ul>

						@if(count($item_allimage) > 0)
						 <div class="cz-gallery" lg-uid="lg0">
							<div id="thumbs-images" class="owl-carousel">
								 @foreach($item_allimage as $image)
							
									<div class="item">
											<a class="gallery-item rounded-lg mb-grid-gutter thumber" href="{{ url('/') }}/public/storage/items/{{ $image->item_image }}" data-sub-html="{{ $item['item']->item_name }}">
												<img src="{{ url('/') }}/public/storage/items/{{ $image->item_image }}" alt="{{ $image->item_image }}" class="single-thumbnail"/>
												<span class="gallery-item-caption">{{ $item['item']->item_name }}</span>
											</a>
									</div>
							 
								@endforeach 
			   
							</div>

					   </div>
					   @endif




				  </div>
				</div>
				<div class="details col-md-6">
					<h3 class="product-title">{{ $item['item']->item_name }}</h3>
					<div class="product-owner">
					  See More by <a href="#">{{ $item['item']->username }}</a>
					</div>
					<div class="rating">
						<div class="stars">
							<span class="ti ti-star"></span>
							<span class="ti ti-star"></span>
							<span class="ti ti-star"></span>
							<span class="ti ti-star"></span>
							<span class="ti ti-star-half"></span>
						</div>
						<span class="rating-review">4.5</span>
						<span class="review-no"><a href="#">52 Reviews</a></span>
					</div>
					<h4 class="price">${{ $item['item']->regular_price }}<del>${{ $item['item']->extended_price }}</del></h4>
					<div class="product-dscnt">
					  This is an Rvybe Exclusive.
					</div>
					<div class="shipping">
					  <span>Free Shipping</span>
					  <span>Get it by Fri, Mar 5</span>
					  <div class="shipping-zip">
						<div class="mb-2"><span>Ship To : </span><label>012345 - City Name</label></div>
						<div class="d-block">
						  <div class="enter-zip">
							<input type="text" name="" placeholder="Zip Code">
							<button class="zip-btn">Update</button>
						  </div>
						</div>

						<div class="d-block">
						  <div class="enter-zipvendorstore">
						  	<span id="vendorstore">Vendor Store</span>
						  <?php 
						   	$hotel=array();
						  	$hotel=(count($item['item']->hasManysProducthotel) > 0) ? $item['item']->hasManysProducthotel : array();

						  ?>

						  @if(count($hotel) > 0)

						  	@foreach($hotel as $key=>$value)
						  	<div class="vendorstoreselection">

						  		<?php $item_name=DB::table('items')->where('item_id',$value->hotel_id)->select('item_name','item_slug')->first();?>
						  		<input type="radio" name="hotel" id="hotel" value="{{ $value->hotel_id }}" checked="checked"><a href="shopstore/{{ $item_name->item_slug }}"> {{  $item_name->item_name }} </a>
						  </div>
						  	@endforeach
						  @endif
							
						  </div>
						</div>
					  </div>



					<div class="product-action mb-2">
					  <div class="quantity-selecter">
						<div class="number-input">
						  <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"><i class="ti ti-minus"></i></button>
						  	<input class="quantity" min="0" name="quantity" id="quantity" value="1" type="number">
						  <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"><i class="ti ti-plus"></i></button>
						</div>
					  </div>
					 
					  <div class="cart-wish w-100">
						 <form action="{{ route('procart') }}" class="setting_form" method="post" id="order_form" enctype="multipart/form-data">
						  <div class="d-flex w-100 add-crt-respo">
							 {{ csrf_field() }} 

							 @if(Auth::guest())
									<button class="like" type="button" onClick="window.location.href='{{ URL::to('/login') }}'"><i class="ti ti-heart"></i></button>
							@endif
				  @if (Auth::check())
				  @if($item['item']->user_id != Auth::user()->id)
				   <!--  <a class="btn btn-outline-accent btn-sm" href="{{ url('/item') }}/{{ base64_encode($item['item']->pro_id) }}/favorite/{{ base64_encode($item['item']->item_liked) }}">
						<i class="dwg-heart font-size-lg mr-2"></i></a> -->

						<?php  
						
							// echo "terererer";
							// echo "<pre>";print_r($item['item']);
							//  echo $item['item']->item_liked;
							//  echo $item['item']->pro_id;
						$favurl=url('/item').'/'.base64_encode($item['item']->pro_id).'/favorite/'.base64_encode($item['item']->item_liked);
						?>

						<button class="like" type="button" onClick="addTofav('<?php echo $favurl ?>')"><i class="ti ti-heart"></i></button>
				  @endif
				  @endif
						<!--   <button class="like" type="button"><i class="ti ti-heart"></i></button> -->
						<!--   <button class="btn btn-primary w-100" type="button">add to cart</button> -->
						@if(Auth::guest())
							 <a class="btn btn-primary btn-shadow btn-block" href="{{ URL::to('/login') }}"> <i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(3074,$translate) }} </a>
						@endif

						 @if (Auth::check())
					   <?php 
								/*  @if($item['item']->user_id == Auth::user()->id)
							<a href="{{ URL::to('/edit-item') }}/{{ $item['item']->item_token }}" class="btn btn-primary btn-shadow btn-block mt-4"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(2935,$translate) }} </a>
						@else */ ?>
								<input type="hidden" name="vendorstoreid" id="vendorstoreid" value="">
								<input type="hidden" name="item_quantity" id="item_quantity" value="">
								<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
								<input type="hidden" name="item_id" value="{{ $item['item']->pro_id }}">
								<input type="hidden" name="item_name" value="{{ $item['item']->item_name }}">
								<input type="hidden" name="item_user_id" value="{{ $item['item']->user_id }}">
								<input type="hidden" name="item_price" value="{{ $item['item']->regular_price }}">
								<input type="hidden" name="item_token" value="{{ $item['item']->item_token }}">
								@if($checkif_purchased == 0)

										@if(Auth::user()->id != 1)
											<!-- <button type="submit" class="btn btn-primary btn-shadow btn-block"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(3074,$translate) }}</button> -->
												 <button type="button" class="btn btn-primary btn-shadow btn-block" onClick="checkhotelselection();"><i class="dwg-cart font-size-lg mr-2"></i>{{ Helper::translation(3074,$translate) }}
												 </button>
										@endif 
							   @endif   
						 <?php 
					  /*  @endif */ ?>
					@endif 
				 <?php 
					  /*  <!--   @if(@$item['item']->item_featured == 'yes')
					<div class="bg-secondary rounded p-3 mt-4">
					<span class="d-inline-block font-size-sm mb-0 mr-1"><img src="{{ url('/') }}/public/storage/badges/{{ $badges['setting']->featured_item_icon }}" border="0" class="single-badges" title="{{ Helper::translation(5466,$translate) }}"> {{ Helper::translation(3075,$translate) }} {{ $allsettings->site_title }}</span>
					</div>
					@endif -->
					@endif*/ ?>
				  </div>

					 </form>

					  </div>
					</div>

					<hr>

					<div id="accordion" class="accordion mt-2">
					  <div class="card">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="card-link collapsed" aria-expanded="true">Description <i class="ti ti-chevron-down"></i></a>
						<div id="collapseOne" class="collapse show" style="">
						  <div class="card-body">
							<div class="card-desc-accordion collapse" id="collapseExample" aria-expanded="false">
							  <p>@php echo html_entity_decode($item['item']->item_desc); @endphp</p> 
							</div>
							<div class="showmore">
							  <button role="button" class="showmore-btn collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></button>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="card">
						<a class="card-link collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">Weights & Dimensions <i class="ti ti-chevron-down"></i></a>
						<div id="collapseTwo" class="collapse" style="">
						  <div class="card-body">
							<table class="table">
							  <tr>
								<td>Overall</td>
								<td>{{ $item['item']->width }}'' W * {{ $item['item']->length }} '' L</td>
							  </tr>
							  <tr>
								<td>Capacity</td>
								<td>{{  $item['item']->weight }} - {{  $item['item']->height }} </td>
							  </tr>
							</table>
						  </div>
						</div>
					  </div>
					  <div class="card">
						<a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">Specifications <i class="ti ti-chevron-down"></i></a>
						<div id="collapseThree" class="collapse" style="">
						  <div class="card-body">
							<h5>Features</h5>
							<table class="table">
							  <tr>
								<td>Set Type</td>
								<td>Stemware Set</td>
							  </tr>
							  <tr>
								<td>Set Size</td>
								<td>4</td>
							  </tr>
							  <tr>
								<td>Product Type</td>
								<td>Red Wine Glass</td>
							  </tr>
							  <tr>
								<td>Primary Material</td>
								<td>Glass</td>
							  </tr>
							  <tr>
								<td>Product Care & Cleaning</td>
								<td>Hand Wash Only</td>
							  </tr>
							  <tr>
								<td>Color</td>
								<td>Clear</td>
							  </tr>
							  <tr>
								<td>BPA Free</td>
								<td>Yes</td>
							  </tr>
							  <tr>
								<td>Lead Free</td>
								<td>Yes</td>
							  </tr>
							  <tr>
								<td>Country of Origin</td>
								<td>Slovakia</td>
							  </tr>
							</table>
							<h5>Warranty</h5>
							<table class="table">
							  <tr>
								<td>Product Warranty</td>
								<td>Yes</td>
							  </tr>
							  <tr>
								<td>Warranty Length</td>
								<td>10 Years</td>
							  </tr>
							  <tr>
								<td>Full or Limited Warranty</td>
								<td>Limited</td>
							  </tr>
							</table>
							<h5>About The Brand</h5>
							<p>{{ $item['item']->about }}</p>
						  </div>
						</div>
					  </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
  </div>
</section>

<section class="related-product">
  <div class="container">
	<div class="row">
	  <div class="col-md-12">
		<h3 class="sec-header">Similar Items</h3>
	  </div>
	  @foreach ($related['items'] as $p)
		<div class="col-md-3">
		  <figure class="card card-product">
			  <div class="img-wrap">
				@if($p->item_thumbnail!='')
				  <img src="{{ url('/') }}/public/storage/items/{{ $p->item_thumbnail }}" alt="{{ $p->item_name }}">
				@else
				  <img src="{{ url('/') }}/public/img/no-image.png" alt="{{ $p->item_name }}">
				@endif
			  </div>

			  <figcaption class="info-wrap">
				<a href="{{ URL::to('/item') }}/{{ $p->item_slug }}">
				  <h4 class="title">{{ $p->item_name }}</h4>
				  <p class="oener-prod">by {{ $p->username }}</p>
				</a>
				<div class="rating-wrap">
				  <div class="rating">
					<div class="stars">
					  <?php $ratnum = 0; ?>
					  @if(count($p->ratings) >0)
						@foreach ($p->ratings as $rating)
						  <span class="ti ti-star"></span>
						  <?php $ratnum++; ?>
						@endforeach
					  @endif
					</div>
					<span class="rating-review">{{ $ratnum }}</span>
					
				  </div>
				</div> <!-- rating-wrap.// -->
			  </figcaption>
			  <div class="bottom-wrap">
				  <div class="price-wrap h5">
					  <span class="price-new">${{ $p->regular_price }}</span> <del class="price-old">${{ $p->extended_price }}</del>
				  </div> <!-- price-wrap.// -->
				 <a href="" class="btn btn-primary"><i class="ti ti-shopping-cart"></i> Add</a>

					
			  </div> <!-- bottom-wrap.// -->
		  </figure>
		</div>
	  @endforeach
	</div>
  </div>
</section>



<!-- 
<script src="http://192.168.1.69/fickrr/resources/views/theme/print/jQuery.print.js"></script>
<script src="http://192.168.1.69/fickrr/resources/views/theme/animate/aos.js"></script> -->
<!-- <script>
	  AOS.init({
		easing: 'ease-in-out-sine'
	  });
</script> -->

@if (!empty($shareItemDetail)) 
  <script>


  
    //  alert("Hello");
      $(document).ready(function(){
        var shareType = "{{$shareItemDetail['shareType']}}";
        var url = "{{$shareItemDetail['url']}}";
        if(shareType == 'facebook'){
          return window.open('http://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url), 'facebook_share', 'height=320, width=640, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no');
          // window.location = url;
        }
        else if(shareType == 'twitter'){
          var currentTitle="{{$shareItemDetail['title']}}";
          return window.open("https://twitter.com/share?url="+url+"&text="+currentTitle,"","height=260,width=500,left=100,top=100,menubar=0"); 
        }
        else if(shareType == 'linkedin'){
          var title = "{{$shareItemDetail['title']}}";
          // var description = '';
          return window.open("https://www.linkedin.com/shareArticle?mini=true&url="+url+"&title="+title,"","height=260,width=500,left=100,top=100,menubar=0"); 

        }
      });

  </script>
@endif

<script type="text/javascript">
function addTofav(url){

	window.location.href=url;

}
$("#csttoas").hide();
	function checkhotelselection(){

  
  		var cartvendorstorrid=[]=
  		cartvendorstorrid=($('#vendorstoerecarid').val()).split(",");

  			//alert(cartvendorstorrid.length );	alert(cartvendorstorrid[0]);
		$('#item_quantity').val($('#quantity').val());
		var vendorstored=$('input[name="hotel"]:checked').val();

		var isok=0;
		if(cartvendorstorrid.length > 0){

			for(var i = 0;i < cartvendorstorrid.length; i++){
				if(cartvendorstorrid[i] == vendorstored){
					isok=1;
				}
			}

		}

		if(isok == 1 && cartvendorstorrid.length > 1 && cartvendorstorrid[0] != ''){
				$('#vendorstoreid').val(vendorstored);
				$('#order_form').submit();
		}else if(cartvendorstorrid.length == 1 && cartvendorstorrid[0] == ''){
			$('#vendorstoreid').val(vendorstored);
			$('#order_form').submit();
		}else if(cartvendorstorrid.length > 1 && cartvendorstorrid[0] != ''){
			$("#csttoas").show();
			  $('.toast').toast('show');    
		}

	


  	}
 //$("#locgeo").hide();


// $(document).ready(function(){
//     $('.toast').toast('show');    
// });





</script>

@endsection


