	/* ===================================================================
	
	Author       	: Incognito Themes
	Template Name	: Chaos - Multi Purpose HTML5 Template
	Version      	: 1.0
	
	* ================================================================= */
	


	/* ===== LOADER OVERLAY ===== */
	
	 jQuery(function ($) {
	'use strict';
	
	jQuery(document).ready(function ($) {
		$('.counter').counterUp({
            delay: 20,
            time: 5000
        });
		
		mainSlider();
		testimonialSlider();
		testimonialSliderTwo();
		clientSlider();
		blogGridSlider();
		parallaxEffect();
		
	
   
	/* ===== PROGRESS BAR ===== */
	
	$(window).on('scroll', function(){
			progress_bars();
		
		var theta = $(window).scrollTop() / 200 % Math.PI;
		$('.hexagon-gradient-left, .triangle-light-blue, .polygon-box, .circle-box').css({ transform: 'rotate(' + theta + 'rad)' });
		
		
	
	});
	
	function progress_bars() {
		$(".progress .progress-bar:in-viewport").each(function() {
			if (!$(this).hasClass("animated")) {
				$(this).addClass("animated");
				$(this).width($(this).attr("data-width") + "%");
			}
			
		});
		
	}
		


    /* ===== Sliders ===== */
	
	/* ~~~ Hero Half Slider ~~~ */
	function mainSlider(){
	$(".default-slider").slick({
        dots: true,
        infinite: true,
        centerMode: true,
		autoplay: true,
        autoplaySpeed: 7000,
        slidesToShow: 1,
        slidesToScroll: 1,
		centerPadding: '0',
		arrows: false
      });
	}
	
	/* ~~~ Testimonials Slider ~~~ */
	function testimonialSlider(){
	$(".testimonial").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
		centerPadding: '0',
		arrows: false,
		responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
      });
	}
		
	/* ~~~ Testimonial Slider Two ~~~ */
	function testimonialSliderTwo(){
	$(".testimonial-two").slick({
        dots: true,
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
		centerPadding: '0',
		arrows: false,
		responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
      });
	}	
	
	/* ~~~ Client Slider ~~~ */
	function clientSlider() {
	$(".client-slider").slick({ 
		slidesToShow: 6,
        slidesToScroll: 1,
		autoplay: true,
        autoplaySpeed: 5000,
		dots:false,
		prevArrow: false,
    	nextArrow: false,
		responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
	});
	}
	
	/* ~~~ Blog Grid Slider ~~~ */
	function blogGridSlider() {
    $(".blog-grid-slider").slick({
		dots: false,
        infinite: true,
        centerMode: true,
		autoplay: true,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
		centerPadding: '0'
	});
	}
	
	/* ===== One page Scroller ===== */
	
	$('a.page-scroll').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 50
        }, 1000, 'easeInOutExpo');
        event.preventDefault();
    });

		
	
    /* ===== Parallax Effect===== */
	
	function parallaxEffect() {
    	$('.parallax-effect').parallax();
	}
	

   /* ===== Parallax Stellar ===== */


    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    jQuery(window).stellar({
        horizontalScrolling: false,
        hideDistantElements: true,
        verticalScrolling: !isMobile.any(),
        scrollProperty: 'scroll',
        responsive: true
    });
    	
	/* ===== Search Overlay ===== */
	
	  var wHeight = window.innerHeight;
	  //search bar middle alignment
	  $('#fullscreen-searchform').css('top', wHeight / 2);
	  //reform search bar
	  jQuery(window).resize(function() {
		wHeight = window.innerHeight;
		$('#fullscreen-searchform').css('top', wHeight / 2);
	  });
	  // Search
	  $('#search-button').on('click', function () {
	 	$("div.fullscreen-search-overlay").addClass("fullscreen-search-overlay-show");
	  });
	  $('a.fullscreen-close').on('click', function () {
		$("div.fullscreen-search-overlay").removeClass("fullscreen-search-overlay-show");
	  });
	


    /* ===== SKILLS BAR ===== */
	 
	 $('.skillbar').each(function(){
		$(this).find('.skillbar-bar').animate({
			width:jQuery(this).attr('data-percent')
			},6000);
	});

    /* ===== CONTACT FORM ===== */
	 
	$(function () {

    $('#contact-form').validator();

    $('#contact-form').on('submit', function (e) {

        if (!e.isDefaultPrevented()) {
            var url = "assets/php/contact.php";
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = data.class;
                    var messageText = data.message;

                    var alertBox = '<div class="' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#contact-form').find('.messages').html(alertBox);
                        $('#contact-form')[0].reset();
                    }
                }
            });
            return false;
        }
    	});
	});
	
	 /* ===== CBP PORTFOLIO ===== */
	 $(window).on('load', function(){
		 
		 var wow = new WOW({
				offset: 100,          
				mobile: false
			  }
			);
			wow.init();
		 
		$('#chaos-gallery').cubeportfolio({
			filters: '#chaos-gallery-filter',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'frontRow',
			gapHorizontal: 0,
			gapVertical: 0,
			gridAdjustment: '',
			mediaQueries: [{
				width: 1500,
				cols: 5
			}, {
				width: 1100,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 480,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'overlayBottomAlong',
			displayType: 'bottomToTop',
			displayTypeSpeed: 300,
		});		
		
		
	});

	
	/* === magnificPopup === */

		$('.image-lightbox').magnificPopup({
			type: 'image',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			fixedContentPos: false
			// other options
		});
		
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});
	
	});	
	
	/* ===== PRELOADER  ===== */
	
	$(window).on('load', function(){
        
        // Page loader
        $("#loader-overlay").delay(500).fadeOut();
        $(".loader").delay(1000).fadeOut("slow");
    
        
        
        $(window).trigger("scroll");
        $(window).trigger("resize");
        
        if (window.location.hash){
            
            var hash_offset = $(window.location.hash).offset().top;
            $("html, body").animate({
                scrollTop: hash_offset
            });
        }
        
    });
	
	
	
	/* ===== GOOGLE MAPS  ===== */
	
		/* ~~~ Default Map ~~~ */
		if($("#myMap").length>0){var $latitude=42.008315,$longitude=-88.163807,$map_zoom=12,$marker_url="assets/images/pin.png",style=[{featureType:"all",elementType:"geometry.fill",stylers:[{weight:"2.00"}]},{featureType:"all",elementType:"geometry.stroke",stylers:[{color:"#9c9c9c"}]},{featureType:"all",elementType:"labels.text",stylers:[{visibility:"on"}]},{featureType:"landscape",elementType:"all",stylers:[{color:"#f2f2f2"}]},{featureType:"landscape",elementType:"geometry.fill",stylers:[{color:"#ffffff"}]},{featureType:"landscape.man_made",elementType:"geometry.fill",stylers:[{color:"#ffffff"}]},{featureType:"poi",elementType:"all",stylers:[{visibility:"on"}]},{featureType:"road",elementType:"all",stylers:[{saturation:-100},{lightness:45}]},{featureType:"road",elementType:"geometry.fill",stylers:[{color:"#eeeeee"}]},{featureType:"road",elementType:"labels.text.fill",stylers:[{color:"#7b7b7b"}]},{featureType:"road",elementType:"labels.text.stroke",stylers:[{color:"#ffffff"}]},{featureType:"road.highway",elementType:"all",stylers:[{visibility:"simplified"}]},{featureType:"road.arterial",elementType:"labels.icon",stylers:[{visibility:"on"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"all",stylers:[{color:"#46bcec"},{visibility:"on"}]},{featureType:"water",elementType:"geometry.fill",stylers:[{color:"#c8d7d4"}]},{featureType:"water",elementType:"labels.text.fill",stylers:[{color:"#070707"}]},{featureType:"water",elementType:"labels.text.stroke",stylers:[{color:"#ffffff"}]}],map_options={center:new google.maps.LatLng($latitude,$longitude),zoom:$map_zoom,panControl:!0,zoomControl:!0,mapTypeControl:!0,streetViewControl:!0,mapTypeId:google.maps.MapTypeId.ROADMAP,scrollwheel:!1,styles:style},map=new google.maps.Map(document.getElementById("myMap"),map_options),marker=new google.maps.Marker({position:new google.maps.LatLng($latitude,$longitude),map:map,visible:!0,icon:$marker_url}),contentString='<div id="mapcontent"><p>Chaos</p></div>',infowindow=new google.maps.InfoWindow({maxWidth:320,content:contentString});google.maps.event.addListener(marker,"click",function(){infowindow.open(map,marker)})}

	});

/*End Jquery*/
