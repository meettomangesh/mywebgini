var siteObjJs = siteObjJs || {};
$(document).ready(function(){
  $('.parallax').parallax();
  $(".owl-carousel").owlCarousel();
  $('select').material_select();
  new WOW().init();
});

$('.dev-sld').owlCarousel({
    loop:true,
	dots:true,
    margin:30,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$('.comp-sld').owlCarousel({
    loop:true,
	dots:true,
    margin:15,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
});
$('.scol-3').owlCarousel({
    loop:true,
	dots:true,
    margin:15,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
$('.search-chips').material_chip({
	data: [{
	  tag: 'Web Designer',
	}, {
	  tag: 'PHP Developer',
	}],
	placeholder: 'Type and search...',
	secondaryPlaceholder: 'Type and search...',
});
/*
var slider = document.getElementById('ps-slider');
  noUiSlider.create(slider, {
   start: [20, 80],
   connect: true,
   step: 1,
   orientation: 'horizontal', // 'horizontal' or 'vertical'
   range: {
     'min': 0,
     'max': 100
   },
   format: wNumb({
     decimals: 0
   })
});*/
