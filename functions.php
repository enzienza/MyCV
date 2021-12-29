<?php
/**
 * Name file: functions
 * Description: includes all functions
 *
 * @package WordPress
 * @subpackage MyCV
 * @since 1.0.0
 */




/**
 * Table of Contents:
 *
 * 1 - Customize
 * 2 - Metaboxes
 * 3 - Options-Theme
 * 4 - Post-Type
 * 5 - Taxonomies
 */

/** =====================================================
 *  1 - CUSTOMIZE
 */
/* customize customtheme */
require_once('inc/customize/config-theme.php');

/* customize back-end */
require_once ('inc/customize/config-admin.php');
require_once ('inc/customize/custom-dashboard.php');


/* customize front-end */


/** =====================================================
 *  2 - METABOXES
 */


/** =====================================================
 *  3 - OPTIONS-THEME
 */
require_once('inc/options-theme/op_aboutme/01-personalDetails.php');
require_once('inc/options-theme/op_aboutme/02-media.php');
require_once('inc/options-theme/op_aboutme/03-network.php');

/** =====================================================
 *  4 - POST-TYPE
 */


/** =====================================================
 *  5 - TAXONOMIES
 */

