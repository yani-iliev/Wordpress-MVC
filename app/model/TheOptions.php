<?php
class TheOptions extends DataObject {
	var $welcome_page_id;
	var $welcome_page_id_str;
	
	function __construct(){
				//$this->registerIgnoreProps(array('dbAdapter', 'columns'));
        parent::__construct();
        $this->set_default_options();
	}
	
	function set_default_options(){
		if(!isset($this->welcome_page_id)) $this->welcome_page_id = 0;
		$this->welcome_page_id_str = 'welcome_page_id';
		
	}
	
	function auto_add_page($page_name){
		return wp_insert_post(array('post_title' => $page_name, 'post_type' => 'page', 'post_status' => 'publish', 'comment_status' => 'closed'));
	}
	
	function update($params){
		$this->update_page("welcome",$params);
	}
	
	function update_page($page, &$params){
		$page_name_id = $page."_page_id";
    	$page_name_str = $page."_page_id_str";
    	if( !is_numeric($params[$this->$page_name_str]) && preg_match("#^__auto_page:(.*?)$#",$params[$this->$page_name_str],$matches) )
    		$this->$page_name_id = $params[$this->$page_name_str] = $this->auto_add_page($matches[1]);
    	else
    		$this->$page_name_id = (int)$params[$this->$page_name_str];
	}
	
	function store(){
    	update_option( 'the_options', $this );
	}
	
}