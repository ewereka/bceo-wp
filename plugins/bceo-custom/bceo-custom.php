<?php

/*
Plugin Name: BCEO Customizations
Plugin URI:
Description: WordPress Customizations for Butler County Engineer's Office
Version:     1.0.0-alpha1
Author:      Ewereka!
Author URI:  http://ewereka.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: com.ewereka.bceo.custom
*/

if (!defined("ABSPATH")) {
  exit();
} // Exit if accessed directly

define("BCEO_CUSTOMIZATIONS__VERSION", "1.0.0");
define("BCEO_CUSTOMIZATIONS__MINIMUM_WP_VERSION", "4.8");
define("BCEO_CUSTOMIZATIONS__PLUGIN_URL", plugin_dir_url(__FILE__));
define("BCEO_CUSTOMIZATIONS__PLUGIN_DIR", plugin_dir_path(__FILE__));

require_once BCEO_CUSTOMIZATIONS__PLUGIN_DIR . "class.BCEO_Customizations.php";

add_action("init", ["BCEO_Customizations", "init"]);
// register_activation_hook(__FILE__, ['BCEO_Customizations', 'activate']);
