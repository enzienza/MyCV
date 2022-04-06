/**
 * Name file: Current Menu Ancestor
 * Description: This script will allow you to add if the menu item is active.
 *              This script is only possible on a wordpress onepage site
 *
 * Version: 1.0
 * Author: Enza Lombardo
 */

jQuery(document).ready(function ($) {

  // Add Class WordPress CURRENT-MENU-ANCESTOR
  $(document).ready(function () {
    let menu_ascend = $(".sidebar-content li a");

    menu_ascend.each(function () {
      if ($(this).is('[href*="#"')) {
        $(this).parent().removeClass('current-menu-item current_page_item current-menu-ancestor');

        $(this).click(function () {
          let current_index  = $(this).parent().index();
          let parent_element = $(this).closest('ul');

          parent_element.find('li').not(':eq(' + current_index + ')').removeClass('current-menu-item current_page_item current-menu-ancestor');
          $(this).parent().addClass('current-menu-item current_page_item current-menu-ancestor');
        })
      }
    })
  })
});