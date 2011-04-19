<?php

class TheExampleController {
	function doAction(){
		echo json_encode(array("error_flag" => 0, "message" => "Some message"));
		exit(0);
	}
}
