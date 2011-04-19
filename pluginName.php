<?php
/*
Plugin Name: pluginName
Plugin URI: URL of the plugin
Description: Description of the plugin
Version: Version of the plugin
Author: Author name
Author URL: Author URL
*/

// Type the plugin name here
define("THE_PLUGIN_NAME", "WordPress MVC");

$the_script_url = get_option('home') . '/index.php?plugin=' . THE_PLUGIN_NAME;
define('THE_PATH',WP_PLUGIN_DIR.'/'.THE_PLUGIN_NAME);
define('THE_IMAGES_PATH',THE_PATH.'/img');
define('THE_CSS_PATH',THE_PATH.'/css');
define('THE_JS_PATH',THE_PATH.'/js');
define('THE_MODELS_PATH',THE_PATH.'/app/model');
define('THE_CONTROLLERS_PATH',THE_PATH.'/app/controller');
define('THE_VIEWS_PATH',THE_PATH.'/app/view');
define('THE_HELPERS_PATH',THE_PATH.'/app/helper');
define('THE_EXCEPTIONS_PATH',THE_PATH.'/app/exception');
define('THE_LIBS_PATH',THE_PATH.'/lib');
define('THE_URL',plugins_url($path = '/'.THE_PLUGIN_NAME));
define('THE_IMAGES_URL',THE_URL.'/img');
define('THE_CSS_URL',THE_URL.'/css');
define('THE_JS_URL',THE_URL.'/js');
define('THE_SCRIPT_URL',$the_script_url);

function __autoload($class_name) {
	if(file_exists(THE_CONTROLLERS_PATH."/".$class_name.".php")) require_once(THE_CONTROLLERS_PATH."/".$class_name.".php");
	
	if(file_exists(THE_MODELS_PATH."/".$class_name.".php")) require_once(THE_MODELS_PATH."/".$class_name.".php");
	
	if(file_exists(THE_HELPERS_PATH."/".$class_name.".php")) require_once(THE_HELPERS_PATH."/".$class_name.".php");
	
	if(file_exists(THE_EXCEPTIONS_PATH."/".$class_name.".php")) require_once(THE_EXCEPTIONS_PATH."/".$class_name.".php");
	
	if(file_exists(THE_LIBS_PATH."/".$class_name.".php")) require_once(THE_LIBS_PATH."/".$class_name.".php");
}

// CONTROLLERS (globalize all controllers and initialize a new instance)
global $the_app_controller,
			 $the_example_controller,
			 $the_options_controller,
			 $the_plugin_controller;

$the_app_controller = new TheAppController();
$the_example_controller = new TheExampleController();
$the_options_controller = new TheOptionsController();
$the_plugin_controller = new ThePluginController();

// MODELS (globalize all models and initialize a new instance)
global $the_options;

$the_options = get_option('the_options');

if(!$the_options){
  $the_options = new TheOptions();

  delete_option('the_options');
  add_option('the_options',$the_options);
}else{
	$the_options->set_default_options(); // Sets defaults for unset options
}

// HELPERS (globalize all helpers and initialize a new instance)
global $the_options_helper;

$the_options_helper = new TheOptionsHelper();

// INIT ADMIN MENU
$the_app_controller->setup_menus();