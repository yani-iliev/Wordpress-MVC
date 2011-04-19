<?php

class TheAppController {
	function __construct(){
		register_activation_hook(THE_PATH."pluginName.php", array( &$this, 'install' ));
		add_action('init', array(&$this,'parse_standalone_request'));
		add_filter('the_content', array( &$this, 'routing' ));
	}
	
	function install(){
	}
	
	function setup_menus(){
		add_action('admin_menu', array( &$this, 'menu' ));
	}
	
	function menu(){
		global $the_options_controller;
		add_menu_page(__('pluginName', 'pluginname'), 
					  __('pluginName', 'pluginname'),
					  8,
					  'pluginname-options',
					  array(&$the_options_controller, 'routing')
		);
	}
	
	function parse_standalone_request(){
		global $the_example_controller;
		
		// get the plugin name
		$plugin     = $this->get_param('plugin');
		// get the action
    $action     = $this->get_param('action');
		// get the controller
    $controller = $this->get_param('controller');

		// route the request
		if(!empty($plugin) && $plugin == 'pluginName' && !empty($controller) && !empty($action)){
			// controller = someController
			if($controller == "exampleController"){
				// action = doAction
				if($action == "doAction"){
					// call doAction
					$the_example_controller->doAction();
				}
			}
		}
	}
	
	function routing($content){
		global $post,
			   $the_options,
				 $the_plugin_controller;

		switch($post->ID){
			case $the_options->welcome_page_id:
				ob_start();
				$the_plugin_controller->welcomePage();
				$content = ob_get_contents();
				ob_end_clean();
				break;
		}
		return $content;
	}
	
	function get_param($param, $default=''){
    return (isset($_POST[$param])?$_POST[$param]:(isset($_GET[$param])?$_GET[$param]:$default));
  }
  
  function get_param_delimiter_char($link){ 
    return ((preg_match("#\?#",$link))?'&':'?');
  }
}
