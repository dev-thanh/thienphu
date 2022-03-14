/*! Main */
jQuery(document).ready(function($) {
  $(window).scroll(function(){
  if($(this).scrollTop() > 200){
      $('.navbar').addClass('is-sticky')
  } else{
      $('.navbar').removeClass('is-sticky')
  }
});
});

/* Mobile Menu
---------------------------------------------------------------*/
jQuery(document).ready(function(){
  jQuery('#showmenu').click(function(){
    jQuery('#mobilenav').toggleClass('opened');
    jQuery('.panel-overlay').toggleClass('active');
    jQuery('.hamburger',this).toggleClass('is-active');
  });

  jQuery('.panel-overlay').click(function(){
    jQuery('#mobilenav').toggleClass('opened');
    jQuery(this).removeClass('active');
    jQuery('#showmenu .hamburger').removeClass('is-active');
  });

  jQuery('.menu_close').click(function(){
    jQuery('#mobilenav').toggleClass('opened');
    jQuery('.panel-overlay').removeClass('active');
    jQuery('#showmenu .hamburger').removeClass('is-active');
  });

  jQuery("#mobilenav ul.sub-menu").before('<span class="arrow"></span>');

  jQuery("body").on('click','#mobilenav .arrow', function(){
    jQuery(this).parent('li').toggleClass('open');
    jQuery(this).parent('li').find('ul.sub-menu').first().slideToggle( "normal" );
  });
});

/* sidebar Menu
---------------------------------------------------------------*/
jQuery(document).ready(function(){
  jQuery(".sidebar-archive_products ul.menu-categories ul.sub-menu").before('<span class="arrow"></span>');

  jQuery("body").on('click','.sidebar-archive_products ul.menu-categories .arrow', function(){
    jQuery(this).parent('li').toggleClass('open');
    jQuery(this).parent('li').find('ul.sub-menu').first().slideToggle( "normal" );
  });
});



jQuery(document).ready(function($) {
  var bannerslider = $('#banner-carousel');
  bannerslider.owlCarousel({
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    loop: true,
    nav: true,
    navText: ["<i class='fal fa-long-arrow-left'></i>","<i class='fal fa-long-arrow-right'></i>"],
    dots:true,
    lazyLoad: true,
    margin: 0,
    autoplayTimeout:5000,
    autoplayHoverPause: true,
    autoplay: true,
    video: true,
    responsive: {
      0: {
        items: 1,
      },
      500: {
        items: 1,
      },
      768: {
        items: 1,
      },
      992: {
        items: 1,
      },
      1200: {
        items: 1,
      }
    }
  });
// End Hero slider initialize code
// Start Reactivate css animation every time a slide is loaded
bannerslider.on("translate.owl.carousel", function(event){
// selecting the current active item
var item = event.item.index-2;
// first removing animation for all captions
$('.box-infor-banner').removeClass('fadeInUp');
$('.owl-item').not('.cloned').eq(item).find('.box-infor-banner').addClass(' fadeInUp');
})
});

jQuery(document).ready(function($) {
  $('#product-carousel').owlCarousel({
    loop: true,
    nav: true,
    navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
    dots:true,
    lazyLoad: true,
    margin: 20,
    autoplayTimeout:6000,
    autoplayHoverPause: true,
    autoplay: true,
    video: true,
    responsive: {
      0: {
        items: 1,
      },
      500: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      }
    }
  });
});

jQuery(document).ready(function($) {
  $('#project-carousel').owlCarousel({
    loop: true,
    nav: true,
    navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
    dots:true,
    lazyLoad: true,
    margin: 20,
    autoplayTimeout:6000,
    autoplayHoverPause: true,
    autoplay: true,
    video: true,
    responsive: {
      0: {
        items: 1,
      },
      500: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      }
    }
  });
});


jQuery(document).ready(function($){
  $('.image-popup-vertical-fit').magnificPopup({
    type: 'image',
    mainClass: 'mfp-with-zoom', 
    gallery:{
      enabled:true
    },
    zoom: {
      enabled: true, 
      duration: 300, // duration of the effect, in milliseconds
      easing: 'ease-in-out', // CSS transition easing function
      opener: function(openerElement) {
        return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }
  });
});

jQuery(document).ready(function($) {
  $('.popup-youtube').magnificPopup({
    type: 'iframe'
  });
});


jQuery(document).ready(function($) {
  var bigimage = $("#details_product_large");
  var thumbs = $("#details_product_thumb");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 3000,
    nav: true,
    autoplay: false,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
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
    responsive: {
      0: {
        items: 3,
      },
      500: {
        items: 3,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 5,
      }
    },
    dots: false,
    nav: false,
    margin: 15,
    navText: ["<i class='fal fa-chevron-left'></i>","<i class='fal fa-chevron-right'></i>"],
    smartSpeed: 200,
    slideSpeed: 3000,
    slideBy: 5,
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
  $('.popup-youtube').magnificPopup({
    type: 'iframe'
  });
});