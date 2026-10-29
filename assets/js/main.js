
(function ($) {
  "use strict";



  // varifaction center:
  
  // varifaction center:

  $(document).ready(function () {


    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-indigo').addClass('btn-default');
            $item.addClass('btn-indigo');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepSteps = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

            prevStepSteps.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-indigo').trigger('click');



});


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

$(".prof-search-click").on('click', function(){
       if ($("#txtCountry").hasClass("typeahead")) {
        // alert('done');
        $("#txtCountry").focus();
      }else{
        window.location.href = "https://hostdivine.com/clients/directory-admin";
         function onload() {
          document.getElementById('txtCountry').focus();
          

        
          }
        
       //$(".main-menu ul li").removeClass("show");
      }
      //$(this).find(".dropdown-right-btn").addClass("show");
        // alert("done");

     
      }); 

$(".slogan_click").on('click', function(){
  // alert('done');
       if ($("#member_first_name").hasClass("box")) {
        // alert('done');
        $("#member_first_name").focus();
      }
      //$(this).find(".dropdown-right-btn").addClass("show");
        // alert("done");

     
      }); 

 // $('.cat-p-hero-slider').owlCarousel({
 //     items: 1,
 //                // margin: 20,
 //                loop: false,
 //                autoplay: false,
 //                // autoplayTimeout: 6000,
 //                dots: false,
 //                nav: true,
 //                //lazyLoad: true,
 //                autoplayTimeout: 6000,
 //                 autoplaySpeed: 3000,
 //                 animateOut: 'fadeOut',
                
 //  });
      
  $('.hero-content').owlCarousel({
                items: 1,
                // margin: 20,
                loop: true,
                autoplay: true,
                // autoplayTimeout: 6000,
                dots: true,
                nav: false,
                //lazyLoad: true,
                autoplayTimeout: 6000,
                 autoplaySpeed: 3000,
                 animateOut: 'fadeOut'
                
  });
  $('.hero-slider').owlCarousel({
                items: 1,
                // margin: 20,
                loop: true,
                autoplay: true,
                // autoplayTimeout: 6000,
                dots: false,
                nav: false,
                //lazyLoad: true,
                autoplayTimeout: 6000,
                 autoplaySpeed: 3000,
                 animateOut: 'fadeOut'
                
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
  $('.feedback-slider').owlCarousel({
               items: 1,
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
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    nav: true,
                    loop: true, 
                }
            }
  });
  // Counter Intrigated


  // Counter Intrigated
$('.member-tabs li label').on('click', function() {
    // $('.leftmenu-item li.active').removeClass('active');
    
    if ( $(this).hasClass("active") ) {  
        $(this).removeClass("active");
      }else{
        $(this).addClass('active');

        // $('.member-tabs li label').not($(this)).removeClass('active');
      }
});


    // $(".nav-item").on('click', function(){
       
    //    //$(".main-menu ul li").removeClass("show");
    //   //$(this).find(".dropdown-right-btn").addClass("show");
      
    //   if ( $(".nav-item").hasClass("active") )
    //   { 
    //     $(".nav-item").removeClass("active");
    //   }
    //   else{
    //     $(".nav-item").addClass("active");
    //   }

    // });

    $(".mobile-search-icon").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".mobile-search").hasClass("active") )
      { 

        $(".mobile-search").removeClass("active");
      }
      else{
        $(".mobile-search").addClass("active");
      }

        }); 

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



    // Chat Triger
    $(".card-active, minimize").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".publisher").hasClass("active") )
      { 

        $(".publisher").removeClass("active");
      }
      else{
        $(".publisher").addClass("active");
      }

        }); 
    $(".media-chat").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".single-chat").hasClass("active") )
      { 

        $(".single-chat").removeClass("active");
      }
      else{
        $(".single-chat").addClass("active");
      }

      }); 

    
    $(".card-active").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      // $('.publisher-input').keyup(function(e){
      //       alert('done');
      //       if(e.keyCode == 13)
      //       {
      //           alert('done');
                
      //       }
      //   });
      if ( $(".chat-content").hasClass("active") )
      { 

        $(".chat-content").removeClass("active");
      }
      else{
        $(".chat-content").addClass("active");
      }

      });  
       $('body').delegate('.chat-close', 'click', function () {

        $(this).parent().parent().remove();      
      });   
       $('body').delegate('.chat-header', 'click', function () {
      if ( $(".chat_history, .chat_publisher").hasClass("active") )
      { 

        $(".chat_history, .chat_publisher").removeClass("active");
      }
      else{
        $(".chat_history, .chat_publisher").addClass("active");
      }    
      }); 
    
    //  $(".chat-close").on('click', function(){

    //   $(".single-chat").addClass("chat-close");
    // }); 






// Menu trigger Class
  $(".menu-close-trigger, .new-leftmenu-close").on('click', function(){

        $(".site-menu-2.mobile, .new-leftmenu").removeClass("active");
        $(".overlay-close").removeClass("active");
        $("#menu").removeClass("active");
        $("#menu").removeClass("mm-menu_opened");
    }); 

     $(".mobile-menu-triger, .menu-trigger").on('click', function(){

      $(".site-menu-2.mobile, .new-leftmenu").addClass("active");
      // $(".overlay-close").addClass("active");
      $("#menu").addClass("active");

  });
// Filter trigger Class
  $(".mobile-filter-button").on('click', function(){

        $(".filter").removeClass("active");
        $(".overlay-close").removeClass("active");
    }); 

     $("#filter-mobile").on('click', function(){
      $(".filter").addClass("active");
      $(".overlay-close").addClass("active");

     });
     $(".overlay-close").on('click', function(){
      $(".filter").removeClass("active");
      $(".overlay-close").removeClass("active");

     });
  //    $(".overlay-close").on('click', function(){

  //     $(".site-menu-2.mobile, .new-leftmenu").removeClass("active");
  //     // $(".overlay-close").removeClass("active");
  //     $("#menu").addClass("active");

  // }); 
 $(".mm-wrapper__blocker").on('click', function(){

      $(".site-menu-2.mobile, .new-leftmenu").removeClass("active");
      // $(".overlay-close").removeClass("active");
      $("#menu").removeClass("active");
      $("#menu").removeClass("mm-menu_opened");

  }); 


// Menu trigger Class
// Menu NEW Class

$('.leftmenu-item').on('click', 'li', function() {
    // $('.leftmenu-item li.active').removeClass('active');
    
    if ( $(this).hasClass("active") ) {  
        $('.leftmenu-item li.active').removeClass('active');
      }else{
        $(this).addClass('active');

        $('.leftmenu-item li').not($(this)).removeClass('active');
      }
});
// Menu NEW Class

// $('.ctg-p-menu').on('click', '.ctg-p-mega-menu', function() {
//   alert();
//     // $('.leftmenu-item li.active').removeClass('active');
    
//     if ( $(this).hasClass("active") ) {  
//         $('.ctg-p-mega-menu.active').removeClass('active');
//       }else{
//         $(this).addClass('active');

//         $('.ctg-p-mega-menu').not($(this)).removeClass('active');
//       }
// });
$('body').delegate('.ctg-p-menu', 'click', function () {
  // alert();
    if ( $(".ctg-p-mega-menu").hasClass("active") )
    { 

      $(".ctg-p-mega-menu").removeClass("active");
    }
    else{
      $(".ctg-p-mega-menu").addClass("active");
    }    
});


// $(function() { $('[name="member_first_name"]').focus(); });
// Show hide popover
        // $(".leftmenu-item li").click(function(){
        //     $(this).find(".new-dropdown").addClass("active");
        // });

      //    $(document).on("click", function(event){
      //     var $trigger = $(".new-dropdown");
      //     if($trigger !== event.target && !$trigger.has(event.target).length){
      //         $(".leftmenu-item li").addClass("active");
      //     }            
      // });

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
    $(".search-location1").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".range1").hasClass("show") )
      { 

        $(".range1").removeClass("show");
      }
      else{
        $(".range1").addClass("show");
      }
      
        

        }); 
    $(".search-location2").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".range2").hasClass("show") )
      { 

        $(".range2").removeClass("show");
      }
      else{
        $(".range2").addClass("show");
      }
      
        

        });
    $(".search-location3").on('click', function(){
       
       //$(".main-menu ul li").removeClass("show");
      //$(this).find(".dropdown-right-btn").addClass("show");
      
      if ( $(".range3").hasClass("show") )
      { 

        $(".range3").removeClass("show");
      }
      else{
        $(".range3").addClass("show");
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

  const $valueSpan2 = $('.valueSpan2');
  const $value2 = $('#slider12');
  $valueSpan2.html($value2.val());
  $value2.on('input change', () => {

    $valueSpan2.html($value2.val());
  });

  const $valueSpan3 = $('.valueSpan3');
  const $value3 = $('#slider13');
  $valueSpan3.html($value3.val());
  $value3.on('input change', () => {

    $valueSpan3.html($value3.val());
  });



  // View Imagess:
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }

      $("#formFileSm").change(function() {
        readURL(this);
      });

  // View Imagess:

});
// Range Item:

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



// Range Item:

  // jQuery(window).load(function(){

  // });

}(jQuery));

