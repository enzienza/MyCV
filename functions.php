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
require_once('inc/customize/config-assets.php');

/* customize back-end */
require_once ('inc/customize/config-admin.php');
require_once ('inc/customize/custom-dashboard.php');
require_once ('inc/customize/columns/admin-experiences.php');
require_once ('inc/customize/columns/admin-formations.php');
require_once ('inc/customize/columns/admin-competences.php');


/* customize front-end */


/** =====================================================
 *  2 - METABOXES
 */
require_once('inc/metaboxes/MB_year.php');
require_once('inc/metaboxes/MB_company.php');
require_once('inc/metaboxes/MB_info_resume.php');
require_once('inc/metaboxes/MB_info_formation.php');
require_once('inc/metaboxes/MB_skills.php');

/** =====================================================
 *  3 - OPTIONS-THEME
 */
// OP -> MyProfil
require_once('inc/options-theme/op_myprofil/01-personalDetails.php');
require_once('inc/options-theme/op_myprofil/02-media.php');
require_once('inc/options-theme/op_myprofil/03-network.php');
require_once('inc/options-theme/op_myprofil/04-aboutme.php');
require_once('inc/options-theme/op_myprofil/05-curriculum.php');

// OP -> CustomTheme
require_once('inc/options-theme/op_customtheme/01-custometheme.php');
require_once('inc/options-theme/op_customtheme/02-header.php');
require_once('inc/options-theme/op_customtheme/03-home.php');
require_once('inc/options-theme/op_customtheme/04-about.php');
require_once('inc/options-theme/op_customtheme/05-resume.php');
require_once('inc/options-theme/op_customtheme/07-skills.php');
require_once('inc/options-theme/op_customtheme/08-contact.php');
require_once('inc/options-theme/op_customtheme/09-errorpage.php');

// OP ->CPT_competence
require_once('inc/options-theme/op_skills/01-languages.php');

/** =====================================================
 *  4 - POST-TYPE
 */

require_once('inc/post-type/cpt_experience.php');
require_once('inc/post-type/cpt_formation.php');
require_once('inc/post-type/cpt_competences.php');


/** =====================================================
 *  5 - TAXONOMIES
 */

