

$(document).ready(function(){

// $('.animate-clip').animatedHeadline({
//             animationType: 'clip'
//         });
// $('.others input:checkbox').change(function(){
//     if($(this).is(":checked")) {
//        $('.others-profession').addClass("show");
//     } else {
//         $('.others-profession').removeClass("show");
//     }
// });




  $('.hero-slider').owlCarousel({
  	 items: 1,
                // margin: 20,
                loop: true,
                autoplay: true,
                // autoplayTimeout: 6000,
                dots: false,
                nav: true,
                //lazyLoad: true,
                autoplayTimeout: 6000,
                 autoplaySpeed: 3000,
                
  });
  $('.blog-slider').owlCarousel({
               items: 3,
                margin: 20,
                loop: true,
                autoplay: true,
                // autoplayTimeout: 6000,
                dots: false,
                nav: true,
                //lazyLoad: true,
                // autoplayTimeout: 3000,
                //  autoplaySpeed: 3000,
                responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: true, 
                }
            }
  });
  // Counter Intrigated


  // Counter Intrigated


    $(".main-menu li").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".main-menu li").hasClass("active") )
      { 

        $(".main-menu li").removeClass("active");
      }
      else{
        $(".main-menu li").addClass("active");
      }

        }); 

    $(".header-trigger").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".header-trigger").hasClass("active") )
      { 

        $(".header-trigger").removeClass("active");
      }
      else{
        $(".header-trigger").addClass("active");
      }

        }); 

// Menu trigger Class
           $(".menu-close-trigger, .new-leftmenu-close").on('click', function(){

            $(".site-menu-2.mobile, .new-leftmenu").removeClass("active");
            $(".overlay-close").removeClass("active");
        }); 

           $(".mobile-menu-triger, .menu-trigger").on('click', function(){

            $(".site-menu-2.mobile, .new-leftmenu").addClass("active");
            $(".overlay-close").addClass("active");

        });
           $(".overlay-close").on('click', function(){

            $(".site-menu-2.mobile, .new-leftmenu").removeClass("active");
            $(".overlay-close").removeClass("active");

        }); 
// Menu trigger Class
// Menu NEW Class

$('.leftmenu-item').on('click', 'li', function() {
    $('.leftmenu-item li.active').removeClass('active');
    $(this).addClass('active');
});
  // $(".leftmenu-item li.active").on('click', function(){

  //           $(".leftmenu-item li.active").removeClass("active");
  //       }); 
// Menu NEw Class
// Menu NEW Class

$('.advance-btn').on('click', '.advance-btn', function() {
    $('.leftmenu-item li.show').removeClass('show');
    $(this).addClass('show');
});
  // $(".leftmenu-item li.active").on('click', function(){

  //           $(".leftmenu-item li.active").removeClass("active");
  //       }); 
// Menu NEw Class

// Location Advance Search Search 
    $(".advance-btn").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".advance-search-dorp").hasClass("show") )
      { 

        $(".advance-search-dorp").removeClass("show");
      }
      else{
        $(".advance-search-dorp").addClass("show");
      }
      
        

        }); 

// Location Search 
// Location Search 
    $(".search-location").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".range").hasClass("show") )
      { 

        $(".range").removeClass("show");
      }
      else{
        $(".range").addClass("show");
      }
      
        

        }); 

// Location Search 

$('.popup-inline').magnificPopup({
  type:'inline',
  midClick: true,
  removalDelay: 300,
  mainClass: 'mfp-fade' 
});





});
// manu 
// Range Item:

$(document).ready(function() {

  const $valueSpan = $('.valueSpan');
  const $value = $('#slider11');
  $valueSpan.html($value.val());
  $value.on('input change', () => {

    $valueSpan.html($value.val());
  });
});
// Range Item: