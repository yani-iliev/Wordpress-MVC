<?php
class ThePluginController{
	function __construct(){
		
	}
	
	function welcomePage(){
		global $the_options;
		require(THE_VIEWS_PATH."/welcome_page.php");
	}
}