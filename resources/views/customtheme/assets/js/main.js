

$(document).ready(function(){
  $(".navbar-toggler").click(function(){
    $(".main-header").toggleClass("show-header");
  });
});

$(document).ready(function(){
  $(".filter-cls").click(function(){
    $(".bb-menu-respo-full").addClass("show-filter");
    $("body").addClass("overflow-hidden");
  });
  $(".bb-menu-close").click(function(){
    $(".bb-menu-respo-full").removeClass("show-filter");
    $("body").removeClass("overflow-hidden");
  });
});

$(document).ready(function(){
  $(".leftsearchcls .search-icon").click(function(){
    $(".leftsearchcls > form").slideToggle();
  });
});



// owlCarousel with animation start

$(document).ready(function(){
    $(".main-banner-inr").on("initialized.owl.carousel", () => {
    setTimeout(() => {
        $(".owl-item.active .owl-slide-animated").addClass("is-transitioned");
        $("section").show();
      }, 500);
    });
    const $owlCarousel = $(".main-banner-inr").owlCarousel({
      loop:true,
        margin:0,
        lazyLoad: true,
        loop:true,
        navigation : false,
        dots:true,
        dotsData: true,
        autoplay:true,
        autoplayTimeout:5000,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false,
            },
            600:{
                items:1,
                nav:false,
            },
            1000:{
                items:1,
                nav:false,
            }
        }
    });
    $owlCarousel.on("changed.owl.carousel", e => {
      $(".owl-slide-animated").removeClass("is-transitioned");

      const $currentOwlItem = $(".owl-item").eq(e.item.index);
      $currentOwlItem.find(".owl-slide-animated").addClass("is-transitioned");

      const $target = $currentOwlItem.find(".owl-slide-text");
      doDotsCalculations($target);
    });

    $owlCarousel.on("resize.owl.carousel", () => {
      setTimeout(() => {
        setOwlDotsPosition();
      }, 50);
    });
    setOwlDotsPosition();

    function setOwlDotsPosition() {

        const $target = $(".owl-item.active .owl-slide-text");
        doDotsCalculations($target);

    }

    function doDotsCalculations(el) {
      const height = el.height();
      const {top, left} = el.position();
      const res = height + top + 20;

      $(".owl-carousel .owl-dots").css({
        top: `${res}px`,
        left: `${left}px`
      });
    }
});

// owlCarousel with animation end




 // $('.nearslide').owlCarousel({
 //                            loop:false,
 //                            margin:30,
 //                            lazyLoad: true,
 //                            navigation : false,
 //                            dots:false,
 //                            autoplay:true,
 //                            autoplayTimeout:1000,
 //                            responsiveClass:true,
 //                            responsive:{
 //                                0:{
 //                                    items:1,
 //                                    nav:false,
 //                                },
 //                                600:{

 //                                    items:3,
 //                                    nav:true,
 //                                },
 //                                1000:{

 //                                    items:4,
 //                                    nav:true,
 //                                }
                                
 //                            }

 //                });



$('.design-slide').owlCarousel({
    loop:false,
    margin:0,
    lazyLoad: true,
    autoHeight:true,
    navigation : false,
    dots:true,
    autoplay:false,
    autoplayTimeout:3000,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true,
        },
        600:{
            items:1,
            nav:true,
        },
        1000:{
            items:1,
            nav:true,
        }
    }
});

// $('.product-slide').owlCarousel({
//     loop:false,
//     margin:15,
//     lazyLoad: true,
//     autoHeight:true,
//     navigation : false,
//     dots:true,
//     autoplay:false,
//     autoplayTimeout:3000,
//     responsiveClass:true,
//     responsive:{
//         0:{
//             items:1,
//             nav:true,
//         },
//         600:{
//             items:3,
//             nav:true,
//         },
//         1000:{
//             items:5,
//             nav:true,
//         }
//     }
// });


$('#hotel-images').owlCarousel({
    loop:false,
    margin:15,
    lazyLoad: true,
    autoHeight:true,
    navigation : false,
    dots:true,
    autoplay:false,
    autoplayTimeout:3000,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
             nav:true,
           
        },
        600:{
            items:1,
             nav:true,
           
        },
        1000:{
            items:1,
             nav:true,
           
        }
    }
});

$( document ).ready( function() {

    $( '.input-range').each(function(){

        var value = $(this).attr('data-slider-value');
        var separator = value.indexOf(',');
        if( separator !== -1 ){
            value = value.split(',');
            value.forEach(function(item, i, arr) {
                arr[ i ] = parseFloat( item );
            });
        } else {
            value = parseFloat( value );
        }
        $( this ).slider({
            formatter: function(value) {
                console.log(value);
                return '$' + value;
            },
            min: parseFloat( $( this ).attr('data-slider-min') ),
            max: parseFloat( $( this ).attr('data-slider-max') ), 
            range: $( this ).attr('data-slider-range'),
            value: value,
            tooltip_split: $( this ).attr('data-slider-tooltip_split'),
            tooltip: $( this ).attr('data-slider-tooltip')
        });
    });
    
 } );





$(document).ready(function() {
  var bigimage = $("#big-images");
  var thumbs = $("#thumbs-images");

  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: false,
    autoplay: false,
    dots: false,
    autoHeight: true,
    loop: false,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 5,
    margin:15,
    dots: false,
    nav: false,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 1,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);




  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});





$(document).ready(function(){
  $(".advnsrch-btn").click(function(){
    $(".advnsrch-main").addClass("show");
  });
  $(".advnsrch-close-btn").click(function(){
    $(".advnsrch-main").removeClass("show");
  });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


