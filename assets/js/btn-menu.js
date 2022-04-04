/**
 * Name file: BTN-MENU
 * Description:
 *
 * Version: 1.0
 * Author: Enza Lombardo
 */

// ANIMATION BTN BURGER
// jQuery(document).ready(function($){
//
//   $(document).ready(function() {
//     const btn_menu = document.getElementById("btn-menu");
//     const icon1 = document.getElementById("a");
//     const icon2 = document.getElementById("b");
//     const icon3 = document.getElementById("c");
//
//     btn_menu.addEventListener('click', function() {
//       icon1.classList.toggle('a');
//       icon2.classList.toggle('c');
//       icon3.classList.toggle('b');
//     });
//   });
//
// });

jQuery(document).ready(function ($) {

  // ToggleClass 'toggle'
  $(document).ready(function () {

    $('#btn-menu').click(function () {
      $('header').toggleClass('toggle');
    })
  });

  $(window).on('scroll load',function(){

    $('header').removeClass('toggle');
    // if($(window).scrollTop() > 0){
    //   $('.top').show();
    // }else{
    //   $('.top').hide();
    // }
  });

  // smooth scrolling
  $('a[href*="#"]').on('click',function(e){
    e.preventDefault();
    $('html, body').animate({
        scrollTop : $($(this).attr('href')).offset().top,
      }, 500, 'linear'
    );
  });

});