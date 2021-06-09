<?php @$session = Session::all(); ?>
@if ($message = Session::get('success'))
<div class="toast-container toast-top-center">
      <div class="toast mb-3" id="cart-toast-success" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white"><i class="dwg-check-circle mr-2"></i>
          <h6 class="font-size-sm text-white mb-0 mr-auto">{{ Helper::translation(5970,$translate) }}</h6>
          <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body">{{ $message }}</div>
      </div>
    </div>
@endif 
@if ($message = Session::get('error'))
<div class="toast-container toast-top-center">
      <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
          <h6 class="font-size-sm text-white mb-0 mr-auto">{{ Helper::translation(5973,$translate) }}</h6>
          <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body text-danger">{{ $message }}</div>
      </div>
</div>
@endif
@if (!$errors->isEmpty())
<div class="toast-container toast-top-center">
      <div class="toast mb-3" id="cart-toast-error" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white"><i class="dwg-close-circle mr-2"></i>
          <h6 class="font-size-sm text-white mb-0 mr-auto">{{ Helper::translation(5973,$translate) }}</h6>
          <button class="close text-white ml-2 mb-1" type="button" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        @foreach ($errors->all() as $error)
        <div class="toast-body text-danger">
        {{ $error }}
        </div>
        @endforeach
      </div>
</div>
@endif

<header class="main-header">
    <div class="head-top">
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <ul class="head-top menu-left">
                        @if(Auth::guest())
                        <li>
                            <a href="{{ URL::to('/register') }}">Sign Up</a>
                        </li>
                        <li>
                            <a href="{{ URL::to('/login') }}">Sign In</a>
                        </li>
                        @endif
                          @if (Auth::check())
                            <li class="dropdown">
                                <a class="navbar-tool-icon-box dropdown-toggle"  id="head_user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ URL::to('/user') }}/{{ Auth::user()->username }}" @endif>        
                                 @if(!empty(Auth::user()->user_photo))
                                <img width="32" src="{{ url('/') }}/public/storage/users/{{ Auth::user()->user_photo }}" alt="{{ Auth::user()->name }}"/>
                                @else
                                <img src="{{ url('/') }}/public/img/no-user.png" alt="{{ Auth::user()->name }}">
                                @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="head_user_dropdown" style="min-width: 14rem;">
                                    @if(@Auth::user()->user_type == 'vendor')
                                    <a class="dropdown-item" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/coupon') }}"><i class="dwg-gift opacity-60 mr-2"></i>{{ Helper::translation(2919,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/sales') }}"><i class="dwg-cart opacity-60 mr-2"></i>{{ Helper::translation(2930,$translate) }}</a>
                                      <a class="dropdown-item" href="{{ URL::to('/manage-item') }}"><i class="dwg-briefcase opacity-60 mr-2"></i>{{ trans('labels.shop') }} </a>
                                    <a class="dropdown-item" href="{{ URL::to('/shop') }}"><i class="dwg-briefcase opacity-60 mr-2"></i>{{ Helper::translation(2932,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                                    @endif
                                    @if(@Auth::user()->user_type == 'customer')
                                    <a class="dropdown-item" href="{{ URL::to('/user') }}/{{ Auth::user()->username }}"><i class="dwg-home opacity-60 mr-2"></i>{{ Helper::translation(2926,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/profile-settings') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(2927,$translate) }}</a> 
                                    <a class="dropdown-item" href="{{ URL::to('/purchases') }}"><i class="dwg-basket opacity-60 mr-2"></i>{{ Helper::translation(2928,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/favourites') }}"><i class="dwg-heart opacity-60 mr-2"></i>{{ Helper::translation(2929,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ URL::to('/withdrawal') }}"><i class="dwg-currency-exchange opacity-60 mr-2"></i>{{ Helper::translation(2933,$translate) }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                                    @endif
                                    @if(@Auth::user()->user_type == 'admin' || @Auth::user()->user_type == 'manufacturers')
                                    <a class="dropdown-item" href="{{ url('/admin') }}"><i class="dwg-settings opacity-60 mr-2"></i>{{ Helper::translation(3022,$translate) }}</a>
                                    <a class="dropdown-item" href="{{ url('/logout') }}"><i class="dwg-sign-out opacity-60 mr-2"></i>{{ Helper::translation(3023,$translate) }}</a>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <a class="navbar-tool-text ml-n1" @if(Auth::user()->id == 1) href="{{ url('/admin') }}" target="_blank" @else href="{{ URL::to('/user') }}/{{ Auth::user()->username }}" @endif>
                                <small>{{ Auth::user()->name }}</small>{{ $allsettings->site_currency_symbol }}{{ Auth::user()->earnings }}
                                </a>
                            </li>



                          @endif             
                          </li>
                    </ul>
                </div>
                <div class="col-5">
                    <ul class="head-top menu-right">
                        <li>
                            <a href="{{ url('/getrvybe')}}" target="_blank">App</a>
                        </li>
                        <li>
                            <a href="{{ url('/business')}}" target="_blank">Business</a> 

                            <!-- url('manage-allitem') -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <?php 
        // echo "<pre>";print_r($roompages);
        ?>
        <!-- <nav class="navbar navbar-expand-md navbar-light"> -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ url('/') }}/public/storage/settings/{{ $allsettings->site_logo }}" height="28" alt="Rvybe"> 
            </a>
            <div class="ml-auto">
                <div class="d-flex align-items-center">

                    <div class="searchboxcls">
                        <div class="leftsearchcls" >
                           <!--  <input type="text" name="searchbox" id="searchbox" value="" placeholder="Search" />
                           -->
                            <form action="{{ route('shop1') }}" id="search_form2" method="post" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                   <input class="form-control prepended-form-control" type="text" name="product_item" id="product_item_top" placeholder="Search">
                            </form>
                            <button class="search-icon" ><i class="ti ti-search"></i></button>
                        </div>
                    </div>
                    <div class="advancedsearchcls">
                        <button class="navbar-tool-icon-box cart-icon ml-3 advnsrch-btn" title="Advanced Search"> <i class="ti ti-chevron-down"></i>
                        </button>
                        <div class="advnsrch-main">
                            <div class="advnsrch">
                                <button class="advnsrch-close-btn close-pop"><i class="ti ti-x"></i></button>
                                <div class="advnsrch-content">
                                    <h3>Search for Rvybe partners and get professional interior design products delivered directly to your home!</h3>
                                    <div class="advnsrch-drops">
                                        <div class="advnsrch-box">
                                            <select class="" name="item_type" id="item_type">
                                                <option value="hotel">Hotel</option>
                                                <option value="spa">Spa</option>
                                                <option value="restaurant">Resturant</option>
                                            </select>
                                        </div>
                                        <div class="advnsrch-box">
                                            <select class="" name="miles" id="miles">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="50">50</option>
                                                <option value="100" selected='selected'>100</option>
                                            </select>
                                        </div>


                                        @if(count($roompages['room']) > 0)
                                            <div class="advnsrch-box">
                                                <select class="" name="roomtype" id="roomtype">
                                                @foreach($roompages['room'] as $key=>$value)
                                                            <option value="{{ $value->item_type_id }}">{{ $value->item_type_name }}</option>

                                                @endforeach
                                                </select>
                                            </div>
                                        @endif
                                      <!--  <div class="_2wKGvKhDH9gtqZPTCDLiIG _1vG8XZO5N5FVc9LTgi0dRX">
                                       <div class="Oa2E_s7W3FSyy8RkMWbLd" for="header-autocomplete-input" id="header-autocomplete-label" role="combobox" aria-expanded="false" aria-haspopup="listbox">
                                        <span class="_1hUZ3xV2F64jWhaNdNV8RZ _2s0tSXZYDlyYuStPli4zT8 _2jwys3rb5Vo5Lvo-U3nW8m" data-test="icSearch">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" focusable="false">
                                                <g fill="none" fill-rule="evenodd">
                                                    <path d="M13,15.9291111 L13,21.5 C13,21.7761424 12.7761424,22 12.5,22 L11.5,22 C11.2238576,22 11,21.7761424 11,21.5 L11,15.9291111 C7.60770586,15.4438815 5,12.5264719 5,9 C5,5.13400675 8.13400675,2 12,2 C15.8659932,2 19,5.13400675 19,9 C19,12.5264719 16.3922941,15.4438815 13,15.9291111 Z M12,4 C9.23857625,4 7,6.23857625 7,9 C7,11.7614237 9.23857625,14 12,14 C14.7614237,14 17,11.7614237 17,9 C17,6.23857625 14.7614237,4 12,4 Z" fill="#2D333F" fill-rule="nonzero" transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000)">
                                                        
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                        <input data-test="search-autocomplete-input" class="_1Q41kn2s8adMA56-Hgfbqn _3E4ZQkaXNTgwhWX5Ro2Hu2" aria-autocomplete="list" autocomplete="off" id="header-autocomplete-input" placeholder="Location, Restaurant or Cuisine" aria-label="Please input a Location, Restaurant or Cuisine" spellcheck="false" value=""></div>
                                    </div> -->
                                    <!--     <div class="advnsrch-box">
                                            <select class="">
                                                <option>Room1</option>
                                                <option>Room2</option>
                                                <option>Room3</option>
                                            </select>
                                        </div> -->
                                       
                                        <div class="advnsrch-box ml-0 ml-md-3">
                                            <button class="btn btn-primary w-100" onClick="redirecttoAdvanceFilter()">Let's go</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="navbar-tool dropdown ml-3">
                        <a class="navbar-tool-icon-box cart-icon" href="{{ url('/procart') }}"><span class="navbar-tool-label">{{ $cartcount }}</span><i class="navbar-tool-icon dwg-cart"></i></a>

                     @php $subtotall = 0;$vednorstoreid=''; @endphp
                           @if($cartcount != 0)
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="widget widget-cart px-3 pt-2 pb-3">

                                
                                @foreach($cartitem['item'] as $cart)
                                 <?php $itemArray=(count($cart->hasManysProducts) > 0 ) ? $cart->hasManysProducts : array(); ?>
                                <div style="max-height: 150px; overflow: auto;">
                                    <div class="simplebar-wrapper">
                                        <div class="simplebar-mask">
                                            <div class="simplebar-offset">
                                                <div class="simplebar-content-wrapper">
                                                    <div class="simplebar-content">
                                                        <div class="widget-cart-item pb-2 mb-2 border-bottom">
                                                           <!--  <a href="#" class="close text-danger">
                                                                <span aria-hidden="true">×</span>
                                                            </a> -->

                                                              <a href="{{ url('/procart') }}/{{ base64_encode($cart->ord_id) }}" class="close text-danger" onClick="return confirm('{{ Helper::translation(2892,$translate) }}');"><span aria-hidden="true">&times;</span></a>

                                                            <div class="media align-items-center">
                                                                <a class="d-block mr-2" href="#">
                                                                    @if($cart->item_thumbnail!='')
                                                                        <img width="64" src="{{ url('/') }}/public/storage/items/{{ $cart->item_thumbnail }}" alt="{{ $cart->item_name }}"/>
                                                                        @else
                                                                        <img width="64" src="{{ url('/') }}/public/img/no-image.png" alt="{{ $cart->item_name }}"/>
                                                                        @endif
                                                                </a>
                                                                <div class="media-body">
                                                                    <h6 class="widget-product-title"><a href="{{ url('/item') }}/{{ $itemArray[0]->item_slug }}">{{ substr($cart->item_name,0,20).'...' }}</a></h6>
                                                                    <div class="widget-product-meta"><span class="text-accent mr-2">{{ $allsettings->site_currency_symbol }} {{ $cart->item_price }} {{ $cart->vednorstoreid }}</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $subtotall += $cart->item_price * $cart->item_qunatity; 
                                $vednorstoreid.= $cart->vendorstoreid.",";
                                @endphp
                                @endforeach
                                <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                                    <div class="font-size-sm mr-2 py-2">
                                            <span class="text-muted">{{ Helper::translation(2896,$translate) }}:</span>
                                            <span class="text-accent font-size-base ml-1">{{ $allsettings->site_currency_symbol }} {{ $subtotall }}</span>
                                          
                                    </div>
                                    <a class="btn btn-outline-secondary btn-sm" href="{{ url('/procart') }}">View Cart<i class="dwg-arrow-right ml-1 mr-n1"></i></a>
                                </div>
                                <a class="btn btn-primary btn-sm btn-block" href="{{ url('/procheckout') }}"><i class="dwg-card mr-2 font-size-base align-middle"></i>{{ Helper::translation(2899,$translate) }}</a>
                            </div>
                        </div>
                        @endif
                          <input type="hidden" name="vendorstoerecarid" id="vendorstoerecarid" value="{{ $vednorstoreid}}" />
                    </div>

                 

                </div>
            </div>
        </nav>
    </div>
</header>
<script type="text/javascript">
$(document).ready(function(){

        $('.toast').toast('show'); 

         if ("geolocation" in navigator){ //check geolocation available 
        
       navigator.geolocation.getCurrentPosition(function(position){ 
                //$("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
                $("#latlng").html(position.coords.latitude + " , "+position.coords.longitude);
              test();

        });

      
    }else{

        console.log("Browser doesn't support geolocation!");

    }

     //   $("#inputspan").hide();
});

function test(){




        // console.log( $("#latlng").html());

        var str= $("#latlng").html();
        $("#latlng").html('');

        var lat1=str.split(",")[0];
        var lng1=str.split(",")[1];

            jQuery.ajax({

                url: "{{ url('/fetchlocation') }}",
                method: 'post',
                data: {

                    latlng:str,
                    lat:lat1,
                    lng:lng1,
                   
                    "_token": "{{ csrf_token() }}"
                    
                },
                dataType:"json",
                success: function(result){
                   // var t=JSON.parse(result);
                    var t=result;
                    $("#locgeo").html('');
                    $("#locgeo").html(t.location);


                }

        });




}


                                            
function redirecttoAdvanceFilter(){

        var itemtype=$("#item_type").val();
        var miles=$("#miles").val();
        var roomtype=$("#roomtype").val();
         var product_item_top=$("#product_item_top").val();
        window.location.href="{{ url('/shop')}}/"+itemtype+'/'+miles+'/'+roomtype+'/'+product_item_top;

}

// function showSearchinputbox(){


//     console.log("hellooo this show search input box");
//     // $("#inputspan").prop('display',true);
//     //$("#inputspan").show();
//     $("#inputspan").toggle();


// }
</script>






