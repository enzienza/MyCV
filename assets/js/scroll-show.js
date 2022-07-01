/**
 * Name file: scroll-show
 * Description: to make jQuery scroll to different places of the document, you can use .scrollTo()
 *
 * @version: 1.0
 * @author: Enza Lombardo
 */

jQuery(document).ready(function ($) {

  window.sr = new ScrollReveal();

  /**
   * FADE.IN.UP
   * Add animation for all skill-group
   */
  sr.reveal('.fadeInUp', {
    origin: 'bottom',
    distance: '100px',
    duration: 1500,
    easing: "cubic-bezier(.215, .61, .355, 1)",
    interval: 600,
    delay: 500,
  });

});