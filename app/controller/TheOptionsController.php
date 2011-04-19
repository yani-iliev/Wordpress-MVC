<?php

class TheOptionsController {
	function __construct(){
		
	}
	
	function routing(){
		$this->display_the_options_form();
	}
	
	function display_the_options_form(){
		global $the_options;
		$action = (isset($_POST['action'])?$_POST['action']:$_GET['action']);
		if($action=='process-form')
			return $this->process_form();
		else 
			require(THE_VIEWS_PATH."/options_form.php");
	}
	function process_form()
	{
		global $the_options;

		$the_options->update($_POST);
		$the_options->store();
		require(THE_VIEWS_PATH."/options_saved.php");
		
		require(THE_VIEWS_PATH."/options_form.php");
	}
}