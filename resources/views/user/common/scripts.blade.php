<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
<script src="{{ URL::to('resources/views/customtheme/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script> 
 <script src="{{ URL::to('resources/views/customtheme/assets/vendor/OwlCarousel/owl.carousel.min.js') }}"></script> 

<script src="{{ URL::to('resources/views/customtheme/assets/js/main.js') }}"></script>

<!--  
  <script src="{{ asset('resources/views/theme/js/vendor.min.js') }}"></script> 
<script src="{{ asset('resources/views/theme/js/theme.min.js') }}"></script>  -->
<!-- 

 -->

<!-- <script src="{{ asset('resources/views/theme/print/jQuery.print.js') }}"></script> -->
<script src="{{ URL::to('resources/views/theme/pagination/pagination.js') }}"></script>
<script src="{{ URL::to('resources/views/theme/autosearch/jquery-ui.js') }}"></script>

<?php //echo $view_name;?>
<script type="text/javascript">
    $(document).ready(function() {

        console.log("gggg")
	'use strict';
      $(this).cPager({
            pageSize: '{{ $allsettings->site_post_per_page }}', 
            pageid: "post-pager", 
            itemClass: "li-item",
			pageIndex: 1
 
        });
	$(this).cPager({
            pageSize: '{{ $allsettings->site_comment_per_page }}', 
            pageid: "commpager", 
            itemClass: "commli-item",
			pageIndex: 1
 
        });	
		
	$(this).cPager({
            pageSize: '{{ $allsettings->site_review_per_page }}', 
            pageid: "reviewpager", 
            itemClass: "review-item",
			pageIndex: 1
 
        });	
		
	$(this).cPager({
            pageSize:  '{{ $allsettings->site_post_per_page }}', 
            pageid: "itempager", 
            itemClass: "prod-item",
			pageIndex: 1
 
        });	

     var src = "{{ route('searchajaxhotel') }}";
     $("#product_item_top").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {


                    console.log("AMY IS FINE");
                    response(data);
                   
                }
            });
        },
        minLength: 1,
       
    });
    

   
});


</script>

@if($view_name == 'user-checkout')

<script type="text/javascript">
    
        $(function () {
'use strict';
$("#ifstripe").hide();
$("#ifpaystack").hide();
$("#iflocalbank").hide();
        $("input[name='withdrawal']").click(function () {
        
            if ($("#withdrawal-paypal").is(":checked")) 
            {
               $("#ifpaypal").show();
               $("#ifstripe").hide();
               $("#ifpaystack").hide();
               $("#iflocalbank").hide();
            }
            else if ($("#withdrawal-stripe").is(":checked"))
            {
              $("#ifpaypal").hide();
              $("#ifstripe").show();
              $("#ifpaystack").hide();
              $("#iflocalbank").hide();
            }
            else if ($("#withdrawal-paystack").is(":checked"))
            {
              $("#ifpaypal").hide();
              $("#ifstripe").hide();
              $("#ifpaystack").show();
              $("#iflocalbank").hide();
            }
            else if ($("#withdrawal-localbank").is(":checked"))
            {
               $("#ifpaypal").hide();
               $("#ifstripe").hide();
               $("#ifpaystack").hide();
               $("#iflocalbank").show();
            }
            else
            {
            $("#ifpaypal").hide();
            $("#ifstripe").hide();
            $("#ifpaystack").hide();
            $("#iflocalbank").hide();
            }
        });
    });
</script>

<!-- stripe code -->
<script src="https://js.stripe.com/v3/"></script>
<script>
$(function () {
'use strict';
$("#ifYes").hide();
        $("input[name='payment_method']").click(function () {
            if ($("#opt1-stripe").is(":checked")) {
                $("#ifYes").show();
                
                /* stripe code */
                
                var stripe = Stripe('{{ $stripe_publish_key }}');
                var elements = stripe.elements();
                var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '14px',
                    '::placeholder': {
                    color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
                };
             
                
                var card = elements.create('card', {style: style, hidePostalCode: true});
             
                
                card.mount('#card-element');
             
               
                card.addEventListener('change', function(event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
             
                
                var form = document.getElementById('checkout_form');
                form.addEventListener('submit', function(event) {
                    /*event.preventDefault();*/
                    if ($("#opt1-stripe").is(":checked")) { event.preventDefault(); }
                    stripe.createToken(card).then(function(result) {
                    
                        if (result.error) {
                        
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        
                        
                        } else {
                            
                            document.querySelector('.token').value = result.token.id;
                             
                            document.getElementById('checkout_form').submit();
                        }
                        /*document.querySelector('.token').value = result.token.id;
                             
                            document.getElementById('checkout_form').submit();*/
                        
                    });
                });
                            
                        
            /* stripe code */   
                
                
                
            } else {
                $("#ifYes").hide();
            }
        });
    });
    

</script>

@endif
<!-- stripe code -->




<!-- <script src="{{ URL::to('resources/views/theme/validate/jquery.bvalidator.min.js') }}"></script>
<script src="{{ URL::to('resources/views/theme/validate/themes/presenters/default.min.js') }}"></script>
<script src="{{ URL::to('resources/views/theme/validate/themes/red/red.js') }}"></script>  -->